<?php
// Prevent direct access
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: index.html');
    exit;
}

// ⭐⭐⭐ ENTER YOUR GMAIL ADDRESS HERE ⭐⭐⭐
$to_email = "yeshoyeswanth420@gmail.com"; // 👈 CHANGE THIS TO YOUR REAL EMAIL!
// ⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐

// Get form data and sanitize
$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$subject = htmlspecialchars(trim($_POST['subject']));
$message = htmlspecialchars(trim($_POST['message']));

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

// Email subject
$email_subject = "New Portfolio Contact: $subject";

// Email body
$email_body = "You have received a new message from your portfolio website.\n\n";
$email_body .= "====================================\n";
$email_body .= "Contact Details:\n";
$email_body .= "====================================\n";
$email_body .= "Name: $name\n";
$email_body .= "Email: $email\n";
$email_body .= "Subject: $subject\n\n";
$email_body .= "====================================\n";
$email_body .= "Message:\n";
$email_body .= "====================================\n";
$email_body .= "$message\n\n";
$email_body .= "====================================\n";
$email_body .= "Sent from: Portfolio Website\n";
$email_body .= "Date: " . date('Y-m-d H:i:s') . "\n";

// Email headers
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Send email
if(mail($to_email, $email_subject, $email_body, $headers)) {
    echo json_encode([
        'success' => true, 
        'message' => 'Thank you! Your message has been sent successfully. I will get back to you soon.'
    ]);
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Oops! Something went wrong. Please try again later or email me directly.'
    ]);
}
?>
