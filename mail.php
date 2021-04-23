<?php

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';

function sendEmail ($link, $toEmail, $fromEmail, $password){



		$mail = new PHPMailer(true);
		try {
		   $mail->setFrom($fromEmail, 'NU Store');
		   $mail->addAddress($toEmail,$toEmail);
		   $mail->Subject = 'Reset your password';
		   $mail->Body = "Click is link to reset your password:  $link ";

		   /* SMTP parameters. */
		   $mail->isSMTP();
		   $mail->Host = 'smtp.gmail.com';
		   $mail->SMTPAuth = TRUE;
		   $mail->SMTPSecure = 'TLS';
		   $mail->Username = $fromEmail;
		   $mail->Password = $password;
		   $mail->Port = 587;

		   /* Disable some SSL checks. */
		   $mail->SMTPOptions = array(
			  'ssl' => array(
			  'verify_peer' => false,
			  'verify_peer_name' => false,
			  'allow_self_signed' => true
			  )
		   );
		   /* Finally send the mail. */
		   $mail->send();
		   return true;
		}
		catch (Exception $e)
		{
		   echo $e->errorMessage();
		    return false;
		}
		catch (\Exception $e)
		{
		   echo $e->getMessage();
		    return false;
		}
}
