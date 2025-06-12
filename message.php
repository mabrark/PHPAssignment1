<?php
require './PHPMailer/PHPMailerAutoload.php';

function send_email($to_address, $to_name, $from_address, $from_name
      $subject, $body, $is_body_html = false)
 {
  if (!valid_email($to_address))
  {
    throw new Exception('This To address is invalid: ' . htmlspecialchars($to_address));
  }

  if (!valid_email($from_address))
  {
    throw new Exception('This from address is invalid: ' . htmlspecialchars($from_address));
  }

  $mail = new PHPMailer();

  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;
  $mail->SMTPAuth = true;
  $mail->Username = 'YOUR_USERNAME@gmail.com';
  $mail->Password = 'YOUR_APP_PASSWORD';
  $mail->setFrom($from_address, $from_name);
  $mail->addAddress($to_address, $to_name);
  $mail->Subject = $subject;
  $mail->Body = $body;
  $mail->AltBody = strip_tags($body);

  if ($is_body_html)
  {
    $mail->isHTML(true);
  }

  if(!$mail->send())
  {
    throw new Exception('Error sending email: ' . htmlspecialchars($mail->ErrorInfo));
  }
 }     

 function valid_email($email)
 {
  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
  {
    return false;
  }
  else
  {
    return true;
  }
 }

 ?>