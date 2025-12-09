<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $subject = htmlspecialchars(trim($_POST['subject'] ?? 'Contact Form Submission'));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));
    
    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        header('Location: contact.php?error=missing_fields');
        exit;
    }
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: contact.php?error=invalid_email');
        exit;
    }
    
    // Prepare email content
    $to = SITE_EMAIL;
    $email_subject = "Contact Form: " . $subject;
    $email_body = "You have received a new message from the contact form.\n\n";
    $email_body .= "Name: " . $name . "\n";
    $email_body .= "Email: " . $email . "\n";
    $email_body .= "Phone: " . $phone . "\n";
    $email_body .= "Subject: " . $subject . "\n\n";
    $email_body .= "Message:\n" . $message . "\n";
    
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // Send email
    if (mail($to, $email_subject, $email_body, $headers)) {
        header('Location: contact.php?success=1');
    } else {
        header('Location: contact.php?error=send_failed');
    }
    exit;
} else {
    header('Location: contact.php');
    exit;
}
?>

