<?php
$message_status = ""; // Message to display on success/error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $surname = htmlspecialchars(trim($_POST['surname']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    // Recipient email
    $to = "francois@guide2cars.co.za";

    // Subject line
    $subject = "New Contact Form Submission from $firstname $surname";

    // Email content
    $body = "You have received a new message from the contact form:\n\n";
    $body .= "First Name: $firstname\n";
    $body .= "Surname: $surname\n";
    $body .= "Email: $email\n\n";
    $body .= "Message:\n$message\n";

    // Email headers
    $headers = "From: noreply@guide2cars.co.za\r\n"; // Ensure this email matches your domain
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Check email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message_status = "<p style='color: red;'>Invalid email address. Please enter a valid email.</p>";
    } else {
        // Attempt to send the email
        if (mail($to, $subject, $body, $headers)) {
            $message_status = "<p style='color: green;'>Thank you, $firstname! Your message has been sent successfully.</p>";
        } else {
            $message_status = "<p style='color: red;'>Error: Your message could not be sent. Please try again later.</p>";
        }
    }
}
?>

