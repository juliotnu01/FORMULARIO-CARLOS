<?php

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

//Incluimos la librería
require_once './html2pdf/src/Html2Pdf.php';

//Recogemos el contenido de la vista
// ob_start();

$html = $_POST['json-field'];

//Pasamos esa vista a PDF

//Le indicamos el tipo de hoja y la codificación de caracteres
$mipdf = new HTML2PDF('L', 'A4', 'es', 'true', 'UTF-8');
$mipdf->pdf->SetDisplayMode('fullpage');

/*$mipdf->writeHTML('<link rel="stylesheet" href="estilos.css">');*/
// $mipdf->writeHTML('<style>
//     body {
//       font-family: Arial, sans-serif;
//     }

//     form {
//       margin: 20px auto;
//     }

//     label {
//       display: inline;
//       margin-bottom: 5px;
//     }

//     input,
//     select {
//       width: 50mm;
//       padding: 8px;
//       margin-bottom: 10px;
//       box-sizing: border-box;
//     }

//     input[type=radio]{
//       width: 10px;
//       padding: 8px;
//       margin-bottom: 10px;
//       box-sizing: border-box;
//     }

//     fieldset {
//       margin-bottom: 20px;
//       padding: 10px;
//     }

//     .form-line {
//       display: flex;
//       align-items: center;
//       margin-bottom: 10px;
//     }

//     .form-line label {
// /*      margin-right: 10px;
//     }

//     .form-line {
//       margin-bottom: 10px;
//     }

//     .form-line input[type="text"] {
//       width: 50mm;
//       border: none;
//       border-bottom: 1px solid #000;
//       padding: 5px;
//       box-sizing: border-box;
//     }

//     .form-line span {
//       margin: 0 5px;
//     }
//   </style>');

//Escribimos el contenido en el PDF
$mipdf->writeHTML($html);

$currentDateTime = date("Ymd_His");
$filename = 'D:\FORMULARIO CARLOS/pdfs/file_' . $currentDateTime . '.pdf';
//Generamos el PDF
$mipdf->Output($filename, 'F');

// exit();

/*$tmp = json_decode($_POST['json-field'], false);
$toPrint = "";

foreach($tmp as $i){
	$toPrint .= "<p><strong>$i->text</strong> $i->value</p>";
}*/

// echo $toPrint;
// $data = $_POST['json-field'];
// $b64 = $data;

// // var_dump($_POST);
// // exit();

// # Decode the Base64 string, making sure that it contains only valid characters
// $bin = base64_decode($b64, true);

// # Perform a basic validation to make sure that the result is a valid PDF file
// # Be aware! The magic number (file signature) is not 100% reliable solution to validate PDF files
// # Moreover, if you get Base64 from an untrusted source, you must sanitize the PDF contents
// if (strpos($bin, '%PDF') !== 0) {
//     throw new Exception('Missing the PDF file signature');
// }

// # Generate a datetime signature for the filename
// $currentDateTime = date("Ymd_His");

// # Append the datetime signature to the original filename
// $filename = 'pdfs/file_' . $currentDateTime . '.pdf';

// # Write the PDF contents to a local file with the new filename
// file_put_contents($filename, $bin);


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
  $mail->addAddress('josemarcomg@gmail.com', 'Marco Moncada'); // Add a recipient address
  $mail->addAddress('octavior128@gmail.com', 'Octavio'); // Add a recipient address
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
