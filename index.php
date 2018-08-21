<?php


$method = $_SERVER['REQUEST_METHOD'];


//process only when method id post

if($method == 'POST')
{
	
	
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$Emailid = $json->queryResult->parameters->Emailid;
	$rooms = $json->queryResult->parameters->rooms;
	$builtyear = $json->queryResult->parameters->builtyear;
	$name = $json->queryResult->parameters->name;
	$area_num = $json->queryResult->parameters->area_num;
	$com = $json->queryResult->parameters->command;
	if($com == 'closedeal')
	{
		$username    = "SANYAM_K";
    		$password    = "Welcome@123";
    		$json_url    = "http://74.201.240.43:8000/ChatBot/Sample_chatbot/deal_info.xsjs?COMMAND=$com&EMAIL=$Emailid&CUST_NAME=$name&AREA_NUM=$area_num&ROOMS=$rooms&BUILT_YEAR=$builtyear";
		$ch      = curl_init( $json_url );
    		$options = array(
        	CURLOPT_SSL_VERIFYPEER => false,
        	CURLOPT_RETURNTRANSFER => true,
        	CURLOPT_USERPWD        => "{$username}:{$password}",
        	CURLOPT_HTTPHEADER     => array( "Accept: application/json" ),
    		);
    		curl_setopt_array( $ch, $options );
		$json = curl_exec( $ch );
		$someobj = json_decode($json,true);
		
		foreach ($someobj["results"] as $value) 
		{
			//$speech .= $value["DEAL_NO"]. "  ".$value["EMAIL"]."  ".$value["CUST_NAME"]. "  ".$value["AREA_NUM"]. "  ".$value["ROOMS"]. "  ".$value["BUILT_YEAR"];
			//$speech .= "\r\n";
			$speech = $value["CUST_NAME"].", Your ".$value["ROOMS"]." BHK house has booked with booking id ".$value["DEAL_NO"].
				$speech .= "\r\n";
			
			
       		}	
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

