<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$mail = new PHPMailer(true); // Passing `true` Enables Exceptions

try {
  //Server Settings
  $mail->isSMTP(); // Set Mailer To Use SMTP
  $mail->Host = 'smtp.gmail.com'; // Namecheap SMTP Server
  $mail->SMTPAuth = true; // Enable SMTP Authentication
  $mail->Username = 'abd.alrahman.olabi@gmail.com'; // SMTP Username
  $mail->Password = '*************'; // SMTP Password
  $mail->SMTPSecure = 'tls'; // Enable TLS Encryption, `ssl` Also Accepted
  $mail->Port = 587; // TCP Port To Connect

  // Get Form Data For The Meeting Form
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = "BestHomePlus - " . $_POST['subject'];
  $message = $_POST['message'];

  //Recipients
  $mail->setFrom('abd.alrahman.olabi@gmail.com', $name);
  $mail->addAddress('abd.alrahman.olabi@gmail.com'); // Add a Recipient

  // Content
  $mail->isHTML(true); // Set Email Format To HTML
  $mail->Subject = $subject;

  // Styling for the email content
  $email_content = '<div style="font-family: Arial, sans-serif; background-color: #f9f9f9; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); padding: 20px;">';
  $email_content .= '<h2 style="color: #333; border-bottom: 2px solid #ddd; padding-bottom: 10px;">Message Details</h2>';
  $email_content .= '<ul style="list-style-type: none; padding: 0;">';
  $email_content .= "<li style='margin-bottom: 10px;'><strong>Name:</strong> $name</li>";
  $email_content .= "<li style='margin-bottom: 10px;'><strong>Email:</strong> $email</li>";
  $email_content .= "<li style='margin-bottom: 10px;'><strong>Subject:</strong> $subject</li>";
  $email_content .= "<li style='margin-bottom: 10px;'><strong>Message:</strong> $message</li>";

  $email_content .= '</ul>';
  $email_content .= '</div>';

  $mail->Body = $email_content;

  // Attempt To Send Email
  $mail->send();
  echo "<script>
    alert('Your Message Has Been Successfully Sent.');
    window.location.replace('Home');</script>";
} catch (Exception $e) {
  echo "<script>    alert('Sorry, There Was an Error While Sending Your Message. Please Try Again Later.');
  window.location.replace('Home');</script>";
}
