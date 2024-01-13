<?php
require_once 'vendor/autoload.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';



$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
  //Server settings
  $mail->SMTPDebug = 0;                                 // Enable verbose debug output
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'smtp.titan.email';                  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'system@1-xactimate.com';             // SMTP username
  $mail->Password = 'F0rmul4r10_';                           // SMTP password
  $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 465
  $mail->Port = 465;                                    // TCP port to connect to

  //Recipients
  $mail->setFrom('system@1-xactimate.com', 'No-Reply');          //This is the email your form sends From
  $mail->addAddress('octavior128@gmail.com', 'Octavio'); // Add a recipient address
  $mail->addAddress('nunezjuliot@gmail.com', 'Juliot'); // Add a recipient address
  //$mail->addAddress('contact@example.com');               // Name is optional
  //$mail->addReplyTo('info@example.com', 'Information');
  //$mail->addCC('cc@example.com');
  //$mail->addBCC('bcc@example.com');

  // Attachments
  $mail->addAttachment($filename);         // Add attachments
  //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

  //Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'Form Filled';
  $mail->Body    = '
Hello, attached to this email is a PDF file with the completed form results.

Please do not reply to this email, as it was sent by an automated system and there will be no response. For questions and/or clarifications, please contact us at josemarcomg@gmail.com or octavior128@gmail.com';
  //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  $mail->send();
  echo 'Message has been sent';
  var_dump($html);
} catch (Exception $e) {
  echo 'Message could not be sent.';
  echo 'Mailer Error: ' . $mail->ErrorInfo;
}
