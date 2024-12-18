<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start(); // Start session for success/error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $surname = htmlspecialchars(trim($_POST['surname']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message_status'] = "<p style='color: red;'>Invalid email address. Please enter a valid email.</p>";
    } else {
        try {
            // Initialize PHPMailer
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.xneelo.co.za'; // Xneelo SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'francois@guide2cars.co.za'; // Your full email address
            $mail->Password = 'Francois@751218!';       // Your email account password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
            $mail->Port = 587; // Port for TLS

            // Email settings
            $mail->setFrom('francois@guide2cars.co.za', 'Guide2Cars');
            $mail->addAddress('francois@guide2cars.co.za'); // Recipient email
            $mail->addReplyTo($email, "$firstname $surname");

            $mail->Subject = "New Contact Form Submission from $firstname $surname";
            $mail->Body = "You have received a new message from the contact form:\n\n" .
                          "First Name: $firstname\n" .
                          "Surname: $surname\n" .
                          "Email: $email\n\n" .
                          "Message:\n$message";

            // Send the email
            $mail->send();
            $_SESSION['message_status'] = "<p style='color: green;'>Thank you, $firstname! Your message has been sent successfully.</p>";
        } catch (Exception $e) {
            $_SESSION['message_status'] = "<p style='color: red;'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</p>";
        }
    }

    header("Location: contact.html"); // Redirect back to the contact page
    exit;
}
?>

