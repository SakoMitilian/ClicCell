<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    $to = 'sakosixguns@hotmail.com'; // Recipient email address
    $subject = 'New Form Submission';
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    $emailBody = "<p><strong>Name:</strong> $name</p>";
    $emailBody .= "<p><strong>Email:</strong> $email</p>";
    $emailBody .= "<p><strong>Message:</strong> $message</p>";
    
    if (mail($to, $subject, $emailBody, $headers)) {
        echo 'OK';
    } else {
        echo 'Error sending email';
    }
} else {
    echo 'Error: Request method is not POST';
}

