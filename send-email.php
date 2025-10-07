<?php
// Prevent direct access
if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: index.html');
    exit;
}

// Configure your email here
$to_email = "yeshoyeswanth420@gmail.com"; // ?? CHANGE THIS TO YOUR EMAIL

// Get form data
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
$email_subject = "New Contact Form Message: $subject";

// Email body
$email_body = "You have received a new message from your portfolio contact form.\n\n";
$email_body .= "Name: $name\n";
$email_body .= "Email: $email\n";
$email_body .= "Subject: $subject\n\n";
$email_body .= "Message:\n$message\n";

// Email headers
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Send email
if(mail($to_email, $email_subject, $email_body, $headers)) {
    echo json_encode(['success' => true, 'message' => 'Message sent successfully! I will get back to you 

soon.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to send message. Please try again 

later.']);
}
?>
