<?php


$method = $_SERVER['REQUEST_METHOD'];


//process only when method id post

if($method == 'POST')
{
	/*//use PHPMailer\PHPMailer\PHPMailer;
	//use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
	//require '../vendor/autoload.php';
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	    
	$Email = $json->queryResult->parameters->Email;	     
	if (strlen($Email) >1){
	
 	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPsecure = 'tls';
	$mail->HOST = 'gmail.smtp.com';
	$mail->port = '587';
	$mail->isHTML();
	$mail->Username = 'rachnarke@gmail.com';
	$mail->Password = 'av!k2010';
	//Set who the message is to be sent from
	$mail->setFrom($Email, 'Rachna Bhatnagar');
	$mail-Subject = 'Hello World';
	$mail->Body = 'A test mail';
	$mail->AddAddress = 'rachnaggn@yahoo.com';
	$mail->send();
		
 
	mail($to, $subject, $message);
   	$speech = 'I have summarized the details and sent an email.. please check your inbox';

    
    }
	$response = new \stdClass();
    	$response->fulfillmentText = $speech;
    	$response->source = "webhook";
	echo json_encode($response);*/
	
	$smtpUsername = 'rachnarke@gmail.com';
	$smtpPassword =	'avik17jan';
	$emailFrom = 'rachnarke@gmail.com';
	$emailFromName = 'Rachna Bhatnagar';
	$emailToName = 'Rachna Bhatnagar';
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$Email = $json->queryResult->parameters->Email;	 
	//use PHPMailer\PHPMailer\PHPMailer;
	//use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	$mail = new PHPMailer;
	$mail->isSMTP(); 
	$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
	$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
	$mail->Port = 587; // TLS only
	$mail->SMTPSecure = 'tls'; // ssl is depracated
	$mail->SMTPAuth = true;
	$mail->Username = $smtpUsername;
	$mail->Password = $smtpPassword;
	$mail->setFrom($emailFrom, $emailFromName);
	$mail->addAddress($Email, $emailToName);
	$mail->Subject = 'PHPMailer GMail SMTP test';
	$mail->msgHTML("test body"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
	$mail->AltBody = 'HTML messaging not supported';
	// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

	if(!$mail->send()){ echo "Mailer Error: " . $mail->ErrorInfo;}
	else{ echo "Message sent!";}

}
else
{
	echo "Method not allowed";
}

	
	
?>

