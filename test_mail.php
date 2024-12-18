<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.xneelo.co.za';
    $mail->SMTPAuth = true;
    $mail->Username = 'francois@guide2cars.co.za';
    $mail->Password = 'YOUR_EMAIL_PASSWORD';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Email content
    $mail->setFrom('francois@guide2cars.co.za', 'Guide2Cars');
    $mail->addAddress('francois@guide2cars.co.za'); // Test recipient

    $mail->Subject = 'SMTP Test Email';
    $mail->Body = 'This is a test email sent using PHPMailer.';

    // Send email
    $mail->send();
    echo "Test email sent successfully!";
} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}
?>
