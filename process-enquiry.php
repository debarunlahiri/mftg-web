<?php
require_once 'config.php';
require_once 'includes/flash.php';
require_once 'includes/smtp-mailer.php';
require_once 'includes/email-template.php';

function redirectEnquiry($type, $message)
{
    setFlashMessage($type, $message);
    header('Location: enquiry.php');
    exit;
}

function isValidEnquiryPhoneNumber($phone)
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

function appendEnquirySubmissionLog($content)
{
    $localPath = __DIR__ . '/enquiry-submissions.log';
    $logPath = (!file_exists($localPath) && is_writable(__DIR__)) || is_writable($localPath)
        ? $localPath
        : rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'mftg-enquiry-submissions.log';

    $logged = @file_put_contents($logPath, "-----\n" . $content, FILE_APPEND | LOCK_EX);

    if ($logged === false) {
        error_log('Enquiry form backup log could not be written.');
    }
}

function getServiceLabel($service)
{
    $services = [
        'bed_covers' => 'Bed Covers, Pillows & Cushions',
        'ladies_kurti' => 'Ladies Kurti & Other Garments',
        'home_furnishing' => 'Home Furnishing Materials',
        'sports_wear' => 'Track Suits & Sports Wear',
        'tshirts' => 'T-Shirts, Tops & Tie',
        'sequins' => 'Sequins Prints',
        'flags' => 'Flags & Promotion Items',
        'other' => 'Other',
    ];

    return $services[$service] ?? ucwords(str_replace('_', ' ', $service));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $contact = trim($_POST['contact'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $quantity = trim($_POST['quantity'] ?? '');
    $timeline = trim($_POST['timeline'] ?? '');
    $enquiry = trim($_POST['enquiry'] ?? '');
    
    if (empty($name) || empty($contact) || empty($email) || empty($service) || empty($enquiry)) {
        redirectEnquiry('error', 'Please fill in all required fields.');
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirectEnquiry('error', 'Please enter a valid email address.');
    }

    if (!isValidEnquiryPhoneNumber($contact)) {
        redirectEnquiry('error', 'Please enter a valid contact number with 10 to 15 digits.');
    }
    
    // Prepare email content
    $to = CONTACT_EMAIL;
    $cc = defined('CONTACT_CC_EMAIL') ? CONTACT_CC_EMAIL : '';
    $service_label = getServiceLabel($service);
    $email_subject = "New Enquiry: " . $service_label;
    $submitted_at = date('Y-m-d H:i:s');
    $email_body = "You have received a new enquiry.\n\n";
    $email_body .= "Name: " . $name . "\n";
    $email_body .= "Contact No.: " . $contact . "\n";
    $email_body .= "Email: " . $email . "\n";
    $email_body .= "Address: " . $address . "\n";
    $email_body .= "Service Required: " . $service_label . "\n";
    $email_body .= "Estimated Quantity: " . $quantity . "\n";
    $email_body .= "Required Timeline: " . $timeline . "\n\n";
    $email_body .= "Enquiry Details:\n" . $enquiry . "\n";
    $email_body .= "\nSubmitted At: " . $submitted_at . "\n";
    $email_html = buildSubmissionEmail(
        'New Enquiry Request',
        'A visitor submitted a quote request through the enquiry form.',
        [
            'Name' => $name,
            'Contact Number' => $contact,
            'Email Address' => $email,
            'Address' => $address,
            'Service Required' => $service_label,
            'Estimated Quantity' => $quantity,
            'Required Timeline' => $timeline,
        ],
        'Enquiry Details',
        $enquiry,
        $submitted_at
    );
    
    appendEnquirySubmissionLog($email_body);
    
    try {
        sendSmtpMail($to, $email_subject, $email_body, $email, $name, $email_html, $cc);
        redirectEnquiry('success', 'Thank you! Your enquiry has been sent successfully. We will get back to you soon.');
    } catch (Throwable $exception) {
        error_log('Enquiry form SMTP failed. Recipient: ' . $to . '; Error: ' . $exception->getMessage());
        redirectEnquiry('error', 'Failed to send enquiry. Please try again or contact us directly.');
    }
} else {
    header('Location: enquiry.php');
    exit;
}
?>
