<?php

$method = $_SERVER['REQUEST_METHOD'];


//process only when method id post

if($method == 'POST')
{
	
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	    
	$Email = $json->queryResult->parameters->Email;	     
	if (strlen($Email) >1){
 
 
	$to      = $Email;
	$subject = 'Chatbot - Backlog Summary';
	$message = 'We have 43,234 Backlogs, 5400 Exceptions and 50 Escalations effecting the total revenue of 5 billion';
	$headers = 'From: rachnarke@gmail.com' . "\r\n" .
    'Reply-To: rachnarke@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);
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

