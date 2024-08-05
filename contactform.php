<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validate form data
    if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'All fields are required and the email must be valid.';
        exit;
    }

    // Email details
    $to = 'hr@symtechnologies.in';  // Change this to your email address
    $email_subject = "Contact Form: $subject";
    $email_body = "
    <h2>Contact Request</h2>
    <p><strong>Name:</strong> {$name}</p>
    <p><strong>Email:</strong> {$email}</p>
    <p><strong>Subject:</strong> {$subject}</p>
    <p><strong>Message:</strong><br>{$message}</p>
    ";

    // Email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@symtechnologies.in" . "\r\n"; // Your domain email
    $headers .= "Cc: another-email@example.com" . "\r\n"; // Optional

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo 'OK';
    } else {
        echo 'Email sending failed.';
    }
} else {
    echo 'Invalid request.';
}
?>
