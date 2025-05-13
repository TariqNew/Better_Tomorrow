<?php

// DEBUG: Show all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '/opt/lampp/htdocs/Better_Tomorrow/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize form inputs
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $subject = htmlspecialchars($_POST['subject']);
  $message = htmlspecialchars($_POST['message']);

  $mail = new PHPMailer(true);
  try {
    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // SMTP host for Gmail
    $mail->SMTPAuth = true;
    $mail->Username = 'info@bettertomorrow.rootgis.org'; // Sender email address (replace with your email)
    $mail->Password = 'Antidius@12345'; // Replace with your email password or app-specific password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
    $mail->Port = 465; // SMTP port for SSL

    // Email Details
    $mail->setFrom('info@bettertomorrow.rootgis.org', 'Better Tomorrow Website'); // Sender details (replace with your email)
    $mail->addAddress('marandumashaka78@gmail.com', 'Tariq'); // Replace with your recipient email address

    $mail->Subject = $subject;
    $mail->Body = "From: " . $name . "\nEmail: " . $email . "\n\nMessage:\n" . $message;

    // Send email
    if ($mail->send()) {
      echo '<p style="color: green; font-weight: bold;">Your message has been sent successfully.</p>';
    } else {
      echo '<p style="color: red; font-weight: bold;">Message could not be sent.</p>';
    }
  } catch (Exception $e) {
    echo '<p style="color: red; font-weight: bold;">Mailer Error: ' . htmlspecialchars($mail->ErrorInfo) . '</p>';
  }
} else {
  echo '<p style="color: red; font-weight: bold;">Invalid form submission.</p>';
}
