<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // SMTP Server Settings
    $mail->isSMTP();
    $mail->Host = 'smtp.guide2cars.co.za'; // Correct SMTP server
    $mail->SMTPAuth = true; // Enable authentication
    $mail->Username = ''; // Your full email address
    $mail->Password = ''; // Your email password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SSL
    $mail->Port = 465; // SMTP port for SSL

    // Email Details
    $mail->setFrom('francois@guide2cars.co.za', 'Guide2Cars Contact');
    $mail->addAddress('francois@guide2cars.co.za'); // Recipient email
    $mail->Subject = 'New Contact Form Submission';
    
    // Email Body Content
    $firstname = htmlspecialchars($_POST['firstname']);
    $surname = htmlspecialchars($_POST['surname']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);
    
    $mail->Body = "You have received a new message from the contact form:\n\n" .
                  "First Name: $firstname\n" .
                  "Surname: $surname\n" .
                  "Email: $email\n\n" .
                  "Message:\n$message\n";

    // Send Email
    $mail->send();
    echo "<p>Thank you! Your message has been sent successfully.</p>";
} catch (Exception $e) {
    echo "<p>Mailer Error: {$mail->ErrorInfo}</p>";
}
?>


