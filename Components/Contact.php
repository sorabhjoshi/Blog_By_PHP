<?php

include 'headfile.php';
require 'Includes/PHPMailer.php';
require 'Includes/SMTP.php';
require 'Includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->Username = "sorabhj2312@gmail.com";
$mail->Password = "uxyn lffa lwpj gbgt";
$mail->Subject = "User Request";
$mail->isHTML(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail->setFrom("sorabhj2312@gmail.com", "Website Contact Form"); 
    $mail->addAddress('sorabhj2312@gmail.com');
    $mail->addReplyTo($email, $name); 
    $mail->Body = "
        <h2>Contact Request from Website</h2>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Message:</strong><br>{$message}</p>
    ";

    if ($mail->send()) {
       
    } else {
        echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
    }

    $mail->smtpClose();
}
?>

<head>
  <link rel="stylesheet" href="Contact.css">
</head>

<div class="wrapper">
<?php
include 'leftsidebar.php';
include 'navbar.php';
?>
<main>

<div class="contact-form-container">
    <div class="contact">
    <h1>Contact Us</h1>
    <form action="contact.php" method="POST">
        <input type="text" id="name" name="name" placeholder="Name" required>
        <input type="email" id="email" name="email" placeholder="E-mail" required>
        <textarea id="message" name="message" rows="5" placeholder="Message" required></textarea>
        <button id='send' type="submit">Send</button>
    </form>
    </div>
</div>
</main>
<?php
include 'footer.php';
?>
</div>
