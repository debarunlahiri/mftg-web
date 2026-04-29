<?php

function emailEscape($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function emailNl2br($value)
{
    return nl2br(emailEscape($value));
}

function buildEmailRows(array $rows)
{
    $html = '';

    foreach ($rows as $label => $value) {
        $value = trim((string) $value);

        if ($value === '') {
            $value = 'Not provided';
        }

        $html .= '<tr>';
        $html .= '<td style="padding:12px 14px;color:#6b7280;font-size:13px;border-bottom:1px solid #e5e7eb;width:38%;">' . emailEscape($label) . '</td>';
        $html .= '<td style="padding:12px 14px;color:#111827;font-size:14px;font-weight:600;border-bottom:1px solid #e5e7eb;">' . emailEscape($value) . '</td>';
        $html .= '</tr>';
    }

    return $html;
}

function buildSubmissionEmail($title, $subtitle, array $rows, $messageLabel, $message, $submittedAt)
{
    return '<!doctype html>
<html>
<body style="margin:0;padding:0;background:#f3f4f6;font-family:Arial,Helvetica,sans-serif;color:#111827;">
    <div style="display:none;max-height:0;overflow:hidden;color:transparent;">' . emailEscape($subtitle) . '</div>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f3f4f6;padding:28px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:680px;background:#ffffff;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;">
                    <tr>
                        <td style="background:#0f172a;padding:26px 30px;">
                            <div style="font-size:12px;line-height:1.4;text-transform:uppercase;letter-spacing:.08em;color:#93c5fd;font-weight:700;">' . emailEscape(SITE_NAME) . '</div>
                            <h1 style="margin:8px 0 0;font-size:24px;line-height:1.25;color:#ffffff;">' . emailEscape($title) . '</h1>
                            <p style="margin:10px 0 0;font-size:14px;line-height:1.6;color:#cbd5e1;">' . emailEscape($subtitle) . '</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px 30px 8px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;border-collapse:separate;">
                                ' . buildEmailRows($rows) . '
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:18px 30px 8px;">
                            <div style="font-size:13px;text-transform:uppercase;letter-spacing:.06em;color:#64748b;font-weight:700;margin-bottom:8px;">' . emailEscape($messageLabel) . '</div>
                            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:16px 18px;color:#1f2937;font-size:15px;line-height:1.7;">' . emailNl2br($message) . '</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:18px 30px 30px;">
                            <div style="background:#ecfdf5;border:1px solid #bbf7d0;border-radius:8px;padding:12px 14px;color:#065f46;font-size:13px;line-height:1.5;">
                                <strong>Submitted At:</strong> ' . emailEscape($submittedAt) . '
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';
}
