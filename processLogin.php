<?php
	libxml_use_internal_errors(true);
	
	$user = $_POST["txtUsername"];
	$pass = $_POST["txtPassword"];
	$loc = $_POST["loc"];

	$xml_requestAgent = '<?xml version="1.0"?>'
	.'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
	.'<Request>'
	.'<AgentInfoRequest>'
	.'<AgentID>'.$user.'</AgentID>'
	.'<Password>'.$pass.'</Password>'
	.'<ReturnAccountInfo>Y</ReturnAccountInfo>'
	.'</AgentInfoRequest>'
	.'</Request>';
	
	if($loc == 'Thailand')
	{
		$url = "http://59.153.23.26:8080/iComLive_Thailand/servlet/conn";
	}
	else if($loc == 'Indonesia')
	{
		$url = "http://59.153.23.26:8080/iComLive/servlet/conn";
	}
	else if($loc == 'Test')
    {
        $url = "http://59.153.23.26:8080/iComTest/servlet/conn";
    }
	
	
	$option = array(
		CURLOPT_RETURNTRANSFER => TRUE,							// return web page
		CURLOPT_HEADER => FALSE,								// don't return header
		CURLOPT_POSTFIELDS => $xml_requestAgent,				// POST XML Request
		CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),	// Sent HEADER XML
		CURLOPT_URL => $url
		);

	//open connection
	$ch = curl_init();
	curl_setopt_array($ch, $option);
	
	$data = curl_exec($ch);


	$xml = new DOMDocument();
	$xml -> loadXML($data);

	//echo $xml->saveXML();

	$searchNode = $xml->getElementsByTagName("AgentInfoReply");

	foreach( $searchNode AS $searchNode)
	{
		$xmlName = $searchNode->getElementsByTagName("Name");
		$valueName = $xmlName->item(0)->nodeValue;

		$xmlCurrency = $searchNode->getElementsByTagName("Currency");
		$valueCurrency = $xmlCurrency->item(0)->nodeValue;

		$xmlEmail = $searchNode->getElementsByTagName("Email");
		$valueEmail = $xmlEmail->item(0)->nodeValue;

		$xmlPriceCode = $searchNode->getElementsByTagName("PriceCodes");
		$valuePriceCode = $xmlPriceCode->item(0)->nodeValue;

		$xmlIsSubLogin = $searchNode->getElementsByTagName("IsSubLogin");
		$valueIsSubLogin = $xmlIsSubLogin->item(0)->nodeValue;

		$xmlHasBookingRights = $searchNode->getElementsByTagName("HasBookingRights");
		$valueHasBookingRigths = $xmlHasBookingRights->item(0)->nodeValue;

		$xmlCurrentBalance = $searchNode->getElementsByTagName("CurrentBalance");
		$valueCurrentBalance = $xmlCurrentBalance->item(0)->nodeValue;

		$xmlOverdue = $searchNode->getElementsByTagName("Overdue4");
		$valueOverdue = $xmlOverdue->item(0)->nodeValue;
	}

	if(empty($valueName))
	{
		header("location:login.php");
	}
	else
	{
		session_start();
		$_SESSION['name'] = $valueName;
		$_SESSION['username'] = $user;
		$_SESSION['password'] = $pass;
		$_SESSION['loc'] = $loc;
		$_SESSION['bookingID'] = '';
		header("location:index.php");
	}
?>