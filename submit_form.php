<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data
    $firstname = htmlspecialchars($_POST['firstname']);
    $surname = htmlspecialchars($_POST['surname']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);
    
    // Recipient email (your hosting email)
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
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "<p>Thank you! Your message has been sent successfully.</p>";
    } else {
        echo "<p>Sorry, there was an error sending your message. Please try again later.</p>";
    }
} else {
    echo "<p>Invalid request. Please fill out the form.</p>";
}
?>