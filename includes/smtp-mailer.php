<?php

function smtpReadResponse($socket)
{
    $response = '';

    while (($line = fgets($socket, 515)) !== false) {
        $response .= $line;

        if (strlen($line) >= 4 && $line[3] === ' ') {
            break;
        }
    }

    return $response;
}

function smtpExpect($socket, array $expectedCodes)
{
    $response = smtpReadResponse($socket);
    $code = (int) substr($response, 0, 3);

    if (!in_array($code, $expectedCodes, true)) {
        throw new RuntimeException('SMTP error: ' . trim($response));
    }

    return $response;
}

function smtpCommand($socket, $command, array $expectedCodes)
{
    fwrite($socket, $command . "\r\n");
    return smtpExpect($socket, $expectedCodes);
}

function smtpAddress($email, $name = '')
{
    $email = trim($email);
    $name = trim((string) $name);

    if ($name === '') {
        return '<' . $email . '>';
    }

    $name = addcslashes($name, "\\\"");
    return '"' . $name . '" <' . $email . '>';
}

function smtpEncodeHeader($value)
{
    if (preg_match('/[^\x20-\x7E]/', $value)) {
        return '=?UTF-8?B?' . base64_encode($value) . '?=';
    }

    return $value;
}

function smtpNormalizeBody($value)
{
    $value = str_replace(["\r\n", "\r"], "\n", $value);
    return str_replace("\n", "\r\n", $value);
}

function sendSmtpMail($to, $subject, $body, $replyTo = '', $replyToName = '', $htmlBody = '', $cc = '')
{
    $host = defined('SMTP_HOST') ? SMTP_HOST : '';
    $port = defined('SMTP_PORT') ? SMTP_PORT : 465;
    $secure = defined('SMTP_SECURE') ? SMTP_SECURE : 'ssl';
    $username = defined('SMTP_USERNAME') ? SMTP_USERNAME : '';
    $password = defined('SMTP_PASSWORD') ? SMTP_PASSWORD : '';
    $fromEmail = defined('SMTP_FROM_EMAIL') ? SMTP_FROM_EMAIL : $username;
    $fromName = $replyToName !== '' ? $replyToName : (defined('SMTP_FROM_NAME') ? SMTP_FROM_NAME : SITE_NAME);
    $heloDomain = defined('SMTP_HELO_DOMAIN') ? SMTP_HELO_DOMAIN : 'mftgindia.com';

    if ($host === '' || $username === '' || $password === '' || $fromEmail === '') {
        throw new RuntimeException('SMTP is not configured.');
    }

    $transport = $secure === 'ssl' ? 'ssl://' : '';
    $context = stream_context_create([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ],
    ]);

    $socket = stream_socket_client(
        $transport . $host . ':' . $port,
        $errno,
        $errstr,
        20,
        STREAM_CLIENT_CONNECT,
        $context
    );

    if (!$socket) {
        throw new RuntimeException('SMTP connection failed: ' . $errstr . ' (' . $errno . ')');
    }

    stream_set_timeout($socket, 20);

    try {
        smtpExpect($socket, [220]);
        smtpCommand($socket, 'EHLO ' . $heloDomain, [250]);

        if ($secure === 'tls') {
            smtpCommand($socket, 'STARTTLS', [220]);

            if (!stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                throw new RuntimeException('SMTP STARTTLS failed.');
            }

            smtpCommand($socket, 'EHLO ' . $heloDomain, [250]);
        }

        smtpCommand($socket, 'AUTH LOGIN', [334]);
        smtpCommand($socket, base64_encode($username), [334]);
        smtpCommand($socket, base64_encode($password), [235]);
        smtpCommand($socket, 'MAIL FROM:<' . $fromEmail . '>', [250]);
        smtpCommand($socket, 'RCPT TO:<' . $to . '>', [250, 251]);

        if ($cc !== '') {
            smtpCommand($socket, 'RCPT TO:<' . $cc . '>', [250, 251]);
        }

        smtpCommand($socket, 'DATA', [354]);

        $isHtml = trim($htmlBody) !== '';
        $headers = [
            'Date: ' . date(DATE_RFC2822),
            'From: ' . smtpAddress($fromEmail, $fromName),
            'To: ' . smtpAddress($to),
            'Subject: ' . smtpEncodeHeader($subject),
            'Message-ID: <' . bin2hex(random_bytes(16)) . '@' . $heloDomain . '>',
            'MIME-Version: 1.0',
            'X-Mailer: MFTG Contact Form',
        ];

        if ($cc !== '') {
            $headers[] = 'Cc: ' . smtpAddress($cc);
        }

        if ($isHtml) {
            $headers[] = 'Content-Type: text/html; charset=UTF-8';
            $headers[] = 'Content-Transfer-Encoding: 8bit';
        } else {
            $headers[] = 'Content-Type: text/plain; charset=UTF-8';
            $headers[] = 'Content-Transfer-Encoding: 8bit';
        }

        if ($replyTo !== '') {
            $headers[] = 'Reply-To: ' . smtpAddress($replyTo, $replyToName);
        }

        if ($isHtml) {
            $messageBody = smtpNormalizeBody($htmlBody);
        } else {
            $messageBody = smtpNormalizeBody($body);
        }

        $message = implode("\r\n", $headers) . "\r\n\r\n" . $messageBody;
        $message = preg_replace('/(^|\r\n)\./', '$1..', $message);

        fwrite($socket, $message . "\r\n.\r\n");
        smtpExpect($socket, [250]);
        smtpCommand($socket, 'QUIT', [221]);
    } finally {
        fclose($socket);
    }

    return true;
}
