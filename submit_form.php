<?php
session_start(); // Start a session to store success/error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $surname = htmlspecialchars(trim($_POST['surname']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    // Email recipient
    $to = "francois@guide2cars.co.za";
    $subject = "New Contact Form Submission from $firstname $surname";

    // Email body
    $body = "You have received a new message from the contact form:\n\n";
    $body .= "First Name: $firstname\n";
    $body .= "Surname: $surname\n";
    $body .= "Email: $email\n\n";
    $body .= "Message:\n$message\n";

    // Email headers
    $headers = "From: noreply@guide2cars.co.za\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Check email validity
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message_status'] = "<p style='color: red;'>Invalid email address. Please enter a valid email.</p>";
    } else {
        // Attempt to send the email
        if (mail($to, $subject, $body, $headers)) {
            $_SESSION['message_status'] = "<p style='color: green;'>Thank you, $firstname! Your message has been sent successfully.</p>";
        } else {
            $_SESSION['message_status'] = "<p style='color: red;'>Sorry, there was an error sending your message. Please try again later.</p>";
        }
    }
    header("Location: contact.html"); // Redirect back to the contact page
    exit;
}
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Start session for success/error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Form submitted!"; // Debug to see if the POST request is received
} else {
    echo "Invalid request method.";
}
?>

