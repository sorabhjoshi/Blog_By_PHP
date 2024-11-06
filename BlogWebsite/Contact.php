
<?php
require '../Components/Includes/PHPMailer.php';
require '../Components/Includes/SMTP.php';
require '../Components/Includes/Exception.php';

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
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail->setFrom("sorabhj2312@gmail.com", "Website Contact Form"); 
    $mail->addAddress('sorabhj2312@gmail.com');
    $mail->addReplyTo($email, $name); 
    $mail->Body = "
        <h2>Contact Request from Blog</h2>
        <h3><strong>Subject:</strong> {$subject}</h3>
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Website</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="contact.css">
</head>

<body>
    <header>
        <div class="container1">
            <a href="http://localhost/practise/BlogWebsite/Home.php" class="logo">Blog Website</a>
            <div class="tags">
                <a href="http://localhost/practise/BlogWebsite/Home.php">Home</a>
                <a href="http://localhost/practise/BlogWebsite/About.php">About</a>
                <a href="http://localhost/practise/BlogWebsite/Contact.php">Contact</a>
                <a href="http://localhost/practise/BlogWebsite/News.php">News</a>
            </div>
        </div>
    </header>

    <main class="container">
        <h1 class="contact-title">Contact Us</h1>
        <div class="form-container">
            <form  method="POST" class="contact-form">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required placeholder="Enter your name">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">

                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required placeholder="Subject">

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="3" required placeholder="Your message"></textarea>

                <button type="submit" class="submit-btn">Send</button>
            </form>
        </div>
    </main>
    <footer>
        <div class="footer-container">
            <div class="footer-links">
                <a href="http://localhost/practise/BlogWebsite/Home.php">Home</a>
                <a href="http://localhost/practise/BlogWebsite/About.php">About</a>
                <a href="http://localhost/practise/BlogWebsite/Contact.php">Contact</a>
                <a href="http://localhost/practise/BlogWebsite/News.php">News</a>
            </div>
            <p>&copy; 2024 Blog Website. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
