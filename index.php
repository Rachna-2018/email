<?php


$method = $_SERVER['REQUEST_METHOD'];


//process only when method id post

if($method == 'POST')
{
	
	
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$to = $json->queryResult->parameters->Email;	 
	/*$smtpUsername = "rachnarke@gmail.com";
	$smtpPassword =	"avik17jan";
	$emailFrom = "rachnarke@gmail.com";
	$emailFromName = "Rachna Bhatnagar";
	$emailToName = "Rachna Bhatnagar";
	
	//echo $Email; echo $smtpUsername; echo $smtpPassword; echo $emailFrom; echo $emailFromName; echo $emailToName;
	/*use \PHPMailer\PHPMailer;
	use \PHPMailer\Exception;

	require 'Exception.php';
	require 'PHPMailer.php';
	require 'SMTP.php';
	// require("./class.phpmailer.php");
    	//require("./class.smtp.php");
	//require_once('class.phpmailer.php');
	//require_once('class.smtp.php');
	$mail = new PHPMailer;
	$mail->isSMTP(); 
	//echo $mail->isSMTP(); 
	//$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
	$mail->Host = "smtp.gmail.com";
	//echo $mail->Host ; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
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
	$mail->send();*/
	
	require_once "Mail.php";
$from = 'rachnarke@gmail.com';
//$to = 'rachnarke@gmail.com';
$username = "rachnarke@gmail";
$password = "avik17jan";
$subject = 'Hi!';

$body = "Hi,\n\nHow are you?";

$headers = array(
					'From' => $from,
					'To' => $to,
					'Subject' => $subject
				);

$smtp = & Mail::factory("smtp",array(
				'host' => 'smtp.gmail.com',
				'auth' => true,
				'port' = '587',
				'username' => $username,
				'password' =>  $password));

$smtp->send($to,$headers,$body);

	
	
	$speech =  "Message sent!";

	$response = new \stdClass();
    	$response->fulfillmentText = $speech;
    	$response->source = "webhook";
	echo json_encode($response);
}
else
{
	echo "Method not allowed";
}

	
	
?>

