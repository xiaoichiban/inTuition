<?php
require_once './vendor/autoload.php';
 
try {
	
	$username = $_GET["username"];
	$email = $_GET["email"];
	
	// Works !
	// echo $username;
	// echo $email;
	
    // Create the SMTP Transport
    $transport = (new Swift_SmtpTransport('ssl://smtp.gmail.com', 465))
        ->setUsername('noreplyapollo888@gmail.com')
        ->setPassword('IS3106!!!');
 
    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);
 
    // Create a message
    $message = new Swift_Message();
 
    // Set a "subject"
    $message->setSubject('Registration Successful');
 
    // Set the "From address"
    $message->setFrom(['noreplyapollo888@gmail.com' => 'Admin from Pets App']);
 
    // Set the "To address" [Use setTo method for multiple recipients, argument should be array]
    $message->addTo($email,'you');
 
    // Add "CC" address [Use setCc method for multiple recipients, argument should be array]
    //$message->addCc('recipient@gmail.com', 'recipient name');
    // Add "BCC" address [Use setBcc method for multiple recipients, argument should be array]
    //$message->addBcc('recipient@gmail.com', 'recipient name');
    // Add an "Attachment" (Also, the dynamic data can be attached)
    //$attachment = Swift_Attachment::fromPath('example.xls');
    //$attachment->setFilename('report.xls');
    //$message->attach($attachment);
    // Add inline "Image"
    //$inline_attachment = Swift_Image::fromPath('pepe.jpg');
    //$cid = $message->embed($inline_attachment);
    // Set the plain-text "Body"
    //$message->setBody("This is the plain text body of the msg blah blah blah.\n ty bye,\n Admin from Pets App");
    // Set a "Body"
    //$message->addPart('<br><img src="'.$cid.'" ><br>Thanks,<br>Admin', 'text/html');
	//$message->addPart('the message.<br>Example of inline image:<br><img src="'.$cid.'" ><br>Thanks,<br>Admin', 'text/html');
 
	// Set the body
	$message->setBody(
	'<html><body>
	Thank You For Registering ! <b>'. $username .
	'</b> <br> <br> 
	 <img src="' .$message->embed(Swift_Image::fromPath('doge_1.jpg')).'" alt="Image" />
	 <br> <br>
	 Regards, Admin
	</body></html>','text/html'
	);
 
 
    // Send the message
    $result = $mailer->send($message);
} catch (Exception $e) {
  echo $e->getMessage();
}