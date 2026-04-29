<?php
require_once 'config.php';
require_once 'includes/flash.php';
require_once 'includes/smtp-mailer.php';
require_once 'includes/email-template.php';

function redirectContact($type, $message)
{
    setFlashMessage($type, $message);
    header('Location: contact.php');
    exit;
}

function isValidPhoneNumber($phone)
{
    $digits = preg_replace('/\D/', '', $phone);

    if (!preg_match('/^\+?[0-9\s\-\(\)]+$/', $phone)) {
        return false;
    }

    if (strlen($digits) < 10 || strlen($digits) > 15) {
        return false;
    }

    return !(strpos(trim($phone), '+') === 0 && strlen($digits) < 11);
}

function appendContactSubmissionLog($content)
{
    $localPath = __DIR__ . '/contact-submissions.log';
    $logPath = (!file_exists($localPath) && is_writable(__DIR__)) || is_writable($localPath)
        ? $localPath
        : rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'mftg-contact-submissions.log';

    $logged = @file_put_contents($logPath, "-----\n" . $content, FILE_APPEND | LOCK_EX);

    if ($logged === false) {
        error_log('Contact form backup log could not be written.');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? 'Contact Form Submission');
    $message = trim($_POST['message'] ?? '');
    
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        redirectContact('error', 'Please fill in all required fields.');
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirectContact('error', 'Please enter a valid email address.');
    }

    if (!isValidPhoneNumber($phone)) {
        redirectContact('error', 'Please enter a valid contact number with 10 to 15 digits.');
    }
    
    // Prepare email content
    $to = CONTACT_EMAIL;
    $cc = defined('CONTACT_CC_EMAIL') ? CONTACT_CC_EMAIL : '';
    $email_subject = "Contact Form: " . $subject;
    $submitted_at = date('Y-m-d H:i:s');
    $email_body = "You have received a new message from the contact form.\n\n";
    $email_body .= "Name: " . $name . "\n";
    $email_body .= "Email: " . $email . "\n";
    $email_body .= "Phone: " . $phone . "\n";
    $email_body .= "Subject: " . $subject . "\n\n";
    $email_body .= "Message:\n" . $message . "\n";
    $email_body .= "\nSubmitted At: " . $submitted_at . "\n";
    $email_html = buildSubmissionEmail(
        'New Contact Message',
        'A visitor submitted a message through the Contact Us form.',
        [
            'Name' => $name,
            'Email Address' => $email,
            'Contact Number' => $phone,
            'Subject' => $subject,
        ],
        'Message',
        $message,
        $submitted_at
    );

    appendContactSubmissionLog($email_body);
    
    try {
        sendSmtpMail($to, $email_subject, $email_body, $email, $name, $email_html, $cc);
        redirectContact('success', 'Thank you! Your message has been sent successfully. We will get back to you soon.');
    } catch (Throwable $exception) {
        error_log('Contact form SMTP failed. Recipient: ' . $to . '; Error: ' . $exception->getMessage());
        redirectContact('error', 'Failed to send message. Please try again or contact us directly.');
    }
} else {
    header('Location: contact.php');
    exit;
}
?>
