<?php


$method = $_SERVER['REQUEST_METHOD'];


//process only when method id post

if($method == 'POST')
{
	//use PHPMailer\PHPMailer\PHPMailer;
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
	echo json_encode($response);

}
else
{
	echo "Method not allowed";
}

?>

