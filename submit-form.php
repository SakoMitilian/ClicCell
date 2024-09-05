<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true); // Pass `true` to enable exceptions

    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.mailersend.net'; // Your SMTP host
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'MS_V9PnqE@trial-v69oxl5k2dkl785k.mlsender.net'; // Your SMTP username
    $mail->Password = 'oYdicFRbcGPDPAkb'; // Your SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption
    $mail->Port = 587; // Set the SMTP port

    $mail->setFrom('sako@trial-v69oxl5k2dkl785k.mlsender.net', $name);// Set the sender's email and name
    $mail->addAddress('sakosixguns@hotmail.com', 'Sako'); // Add recipient email address

    $emailBody = "<p><strong>Name:</strong> $name</p>";
    $emailBody .= "<p><strong>Email:</strong> $email</p>";
    $emailBody .= "<p><strong>Subject:</strong> $subject</p>"; // Fixed this line to append instead of overwrite
    $emailBody .= "<p><strong>Message:</strong> $message</p>";

    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = $emailBody;
    //$mail->SMTPDebug = 2; // Enable verbose debug output

    try {
        $mail->send();
        echo 'OK';
    } catch (Exception $e) {
        echo 'Error sending email: ' . $e->getMessage();
    }
} else {
    echo 'Error: Request method is not POST';
}