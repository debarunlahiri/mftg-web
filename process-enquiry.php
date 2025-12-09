<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $contact = htmlspecialchars(trim($_POST['contact'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $address = htmlspecialchars(trim($_POST['address'] ?? ''));
    $service = htmlspecialchars(trim($_POST['service'] ?? ''));
    $quantity = htmlspecialchars(trim($_POST['quantity'] ?? ''));
    $timeline = htmlspecialchars(trim($_POST['timeline'] ?? ''));
    $enquiry = htmlspecialchars(trim($_POST['enquiry'] ?? ''));
    
    // Validate required fields
    if (empty($name) || empty($contact) || empty($email) || empty($service) || empty($enquiry)) {
        header('Location: enquiry.php?error=missing_fields');
        exit;
    }
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: enquiry.php?error=invalid_email');
        exit;
    }
    
    // Prepare email content
    $to = SITE_EMAIL;
    $email_subject = "New Enquiry: " . $service;
    $email_body = "You have received a new enquiry.\n\n";
    $email_body .= "Name: " . $name . "\n";
    $email_body .= "Contact No.: " . $contact . "\n";
    $email_body .= "Email: " . $email . "\n";
    $email_body .= "Address: " . $address . "\n";
    $email_body .= "Service Required: " . $service . "\n";
    $email_body .= "Estimated Quantity: " . $quantity . "\n";
    $email_body .= "Required Timeline: " . $timeline . "\n\n";
    $email_body .= "Enquiry Details:\n" . $enquiry . "\n";
    
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // Send email
    if (mail($to, $email_subject, $email_body, $headers)) {
        header('Location: enquiry.php?success=1');
    } else {
        header('Location: enquiry.php?error=send_failed');
    }
    exit;
} else {
    header('Location: enquiry.php');
    exit;
}
?>

