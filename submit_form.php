<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $surname = htmlspecialchars(trim($_POST['surname']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    // Email address where the form data will be sent
    $to = "francois@guide2cars.co.za"; // Replace with your hosting email

    // Email subject
    $subject = "New Contact Form Submission from $firstname $surname";

    // Email body content
    $body = "You have received a new message from the contact form:\n\n";
    $body .= "First Name: $firstname\n";
    $body .= "Surname: $surname\n";
    $body .= "Email: $email\n\n";
    $body .= "Message:\n$message\n";

    // Email headers
    $headers = "From: noreply@guide2cars.co.za\r\n"; // Use a domain email for better deliverability
    $headers .= "Reply-To: $email\r\n";

    // Check for valid email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p>Invalid email address. Please enter a valid email.</p>";
        exit;
    }

    // Attempt to send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "<p>Thank you, $firstname! Your message has been sent successfully.</p>";
    } else {
        echo "<p>Sorry, there was an error sending your message. Please try again later.</p>";
    }
} else {
    // Display error message for invalid form submissions
    echo "<p>Invalid request. Please submit the form properly.</p>";
}
?>
