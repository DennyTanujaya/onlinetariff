<?php
//session_start();
error_reporting(0);
ini_set('display_errors',0); 
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		if(isset($_POST["submit"]))
		{
			$checkIn = $_POST['txtCheckIn'];
			$checkOut = $_POST['txtCheckOut'];
			$single = $_POST['txtSingle'];
			$double = $_POST['txtDouble'];
			$twin = $_POST['txtTwin'];
			$triple = $_POST['txtTriple'];
			$checkInFix = date('Y-m-d', strtotime($checkIn));
			$checkOutFix = date('Y-m-d', strtotime($checkOut));
			$username = $_SESSION["username"];
			$password = $_SESSION["password"];
			
		$key = $_GET['key'];
		//$username = "TESTWX";
		//$password = "TESTWX";
		//$key = "DPSACAAPDPSDLXABF";
		$dateFrom = $checkInFix;
		$selisih = strtotime($checkOutFix) - strtotime($checkInFix);
		$SCUqty = $selisih/(60*60*24);
		$roomType = "TW";
		$adult = "2";
		$code = substr($key, 5, 6);
		$service = substr($key, 11, 6);


	//echo 'username: '.$username.'<br />password: '.$password.'<br />destination: '.$destination.'<br />dateFrom: '.$dateFrom.'<br />date to: '.$dateTo.'<br />room: '.$rooms.'<br />Children: '.$children.'<br />Adult: '.$adults.'<br />SCU: '.$interval.'<br />locCOde: '.$locCOde.'<br />Code: '.$code.'<br />Address: '.$address.'<br />service: '.$service.'';

	$xml_request = '<?xml version="1.0"?>'
	.'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
	.'<Request>'
	.'<OptionInfoRequest>'
	.'<AgentID>'.$username.'</AgentID>'
	.'<Password>'.$password.'</Password>'
	.'<Opt>'.$key.'</Opt>'
	.'<Info>GMFTDS</Info>'
	.'<DateFrom>'.$dateFrom.'</DateFrom>'
	.'<SCUqty>'.$SCUqty.'</SCUqty>'
	.'<RoomConfigs><RoomConfig>'
	.'<Adults>'.$adult.'</Adults>'
	.'<RoomType>'.$roomType.'</RoomType>'
	.'</RoomConfig></RoomConfigs>'
	.'</OptionInfoRequest>'
	.'</Request>';

	$loc = $_SESSION['loc'];

	if($loc == 'Thailand')
    {
        $urls = "http://59.153.23.26:8080/iComLive_Thailand/servlet/conn";
    }
    else if($loc == 'Indonesia')
    {
        $urls = "http://59.153.23.26:8080/iComLive/servlet/conn";
    }
    else if($loc == 'Test')
    {
        $urls = "http://59.153.23.26:8080/iComTest/servlet/conn";
    }
	
	$option = array(
		CURLOPT_RETURNTRANSFER => TRUE,							// return web page
		CURLOPT_HEADER => FALSE,								// don't return header
		CURLOPT_POSTFIELDS => $xml_request,						// POST XML Request
		CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),	// Sent HEADER XML
		CURLOPT_URL => $url
		);

	//open connection
	$ch = curl_init();
	curl_setopt_array($ch, $option);
	
	$data = curl_exec($ch);


	$xml = new DOMDocument();
	$xml -> loadXML($data);


	$searchNode = $xml->getElementsByTagName("OptionInfoReply");
	
	foreach( $searchNode as $searchNode)
	{
		$i=0;
			$xmlOpt = $searchNode->getElementsByTagName("Opt");
			$valueOpt = $xmlOpt->item($i)->nodeValue;

			$xmlSupplierName = $searchNode->getElementsByTagName("SupplierName");
			$valueSupplierName = $xmlSupplierName->item($i)->nodeValue;

			$xmlDescription = $searchNode->getElementsByTagName("Description");
			$valueDescription = $xmlDescription->item($i)->nodeValue;

			$xmlComment = $searchNode->getElementsByTagName("Comment");
			$valueComment = $xmlComment->item($i)->nodeValue;

			$xmlLocality = $searchNode->getElementsByTagName("LocalityDescription");
			$valueLocality = $xmlLocality->item($i)->nodeValue;

			$xmlClass = $searchNode->getElementsByTagName("ClassDescription");
			$valueClass = $xmlClass->item($i)->nodeValue;

			$xmlAddress = $searchNode->getElementsByTagName("Address1");
			$valueAddress = $xmlAddress->item($i)->nodeValue;

			$xmlAddress2 = $searchNode->getElementsByTagName("Address2");
			$valueAddress2 = $xmlAddress2->item($i)->nodeValue;

			$xmlAddress3 = $searchNode->getElementsByTagName("Address3");
			$valueAddress3 = $xmlAddress3->item($i)->nodeValue;

			$xmlAddress4 = $searchNode->getElementsByTagName("Address4");
			$valueAddress4 = $xmlAddress4->item($i)->nodeValue;

			$xmlAddress5 = $searchNode->getElementsByTagName("Address5");
			$valueAddress5 = $xmlAddress5->item($i)->nodeValue;

			$xmlPostCode = $searchNode->getElementsByTagName("PostCode");
			$valuePostCode = $xmlPostCode->item($i)->nodeValue;
			
			$xmlButtonName = $searchNode->getElementsByTagName("ButtonName");
			$valueButtonName = $xmlButtonName->item($i)->nodeValue;

			$xmlNoteText = $searchNode->getElementsByTagName("NoteText");
			$valueNoteText = $xmlNoteText->item($i)->nodeValue;

			$pisah = explode("ROOM FEATURES:",$valueNoteText);
			$pisah1 = str_replace("ROOM DESCRIPTION:", "", $pisah[0]);

			$xmlAvailability = $searchNode->getElementsByTagName("Availability");
			$valueAvailability = $xmlAvailability->item($i)->nodeValue;

			$xmlCurrency = $searchNode->getElementsByTagName("Currency");
			$valueCurrency = $xmlCurrency->item($i)->nodeValue;

			$xmlAgentPrice = $searchNode->getElementsByTagName("AgentPrice");
			$valueAgentPrice = $xmlAgentPrice->item($i)->nodeValue;

			//RATE
			$xmlDateFrom = $searchNode->getElementsByTagName("DateFrom");
			$valueDateFrom = $xmlDateFrom->item($i)->nodeValue;
			$xmlDateTo = $searchNode->getElementsByTagName("DateTo");
			$valueDateTo = $xmlDateTo->item($i)->nodeValue;
		}

	$xml_requestPrices = '<?xml version="1.0"?>'
	.'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
	.'<Request>'
	.'<OptionInfoRequest>'
	.'<AgentID>'.$username.'</AgentID>'
	.'<Password>'.$password.'</Password>'
	.'<Opt>'.$key.'</Opt>'
	.'<Info>D</Info>'
	.'<DateFrom>'.$dateFrom.'</DateFrom>'
	.'</OptionInfoRequest>'
	.'</Request>';

	$loc = $_SESSION['loc'];
            
    if($loc == 'Thailand')
    {
        $urls = "http://59.153.23.26:8080/iComLive_Thailand/servlet/conn";
    }
    else if($loc == 'Indonesia')
    {
        $urls = "http://59.153.23.26:8080/iComLive/servlet/conn";
    }
    else if($loc == 'Test')
    {
        $urls = "http://59.153.23.26:8080/iComTest/servlet/conn";
    }
	
	$option = array(
		CURLOPT_RETURNTRANSFER => TRUE,							// return web page
		CURLOPT_HEADER => FALSE,								// don't return header
		CURLOPT_POSTFIELDS => $xml_requestPrices,						// POST XML Request
		CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),	// Sent HEADER XML
		CURLOPT_URL => $urls
		);

	//open connection
	$chs = curl_init();
	curl_setopt_array($chs, $option);
	
	$datas = curl_exec($chs);


	$xmls = new DOMDocument();
	$xmls -> loadXML($datas);


	$searchNodes = $xmls->getElementsByTagName("OptionInfoReply");

	foreach( $searchNodes as $searchNodes)
	{
		$i=0;
		$xmlSingleRate = $searchNodes->getElementsByTagName("SingleRate");
		$valueSingleRate = $xmlSingleRate->item($i)->nodeValue;
		$xmlDoubleRate = $searchNodes->getElementsByTagName("DoubleRate");
		$valueDoubleRate = $xmlDoubleRate->item($i)->nodeValue;
		$xmlTwinRate = $searchNodes->getElementsByTagName("TwinRate");
		$valueTwinRate = $xmlTwinRate->item($i)->nodeValue;
		$xmlTripleRate = $searchNodes->getElementsByTagName("TripleRate");
		$valueTripleRate = $xmlTripleRate->item($i)->nodeValue;
		$xmlExtraAdultRate = $searchNodes->getElementsByTagName("ExtraAdultRate");
		$valueExtraAdultRate = $xmlExtraAdultRate->item($i)->nodeValue;
		$xmlExtraChildRate = $searchNodes->getElementsByTagName("ExtraChildRate");
		$valueExtraChildRate = $xmlExtraChildRate->item($i)->nodeValue;


			if(mb_strlen($valueSingleRate) == 3)
			{
				$pisahSingleRate = substr($valueSingleRate, 0,1);
				$pisahSingleRateDesimal = substr($valueSingleRate, 1);
				$pisahSingleRateFix = $pisahSingleRate.'.'.$pisahSingleRateDesimal.'';
			}
			else if(mb_strlen($valueSingleRate) == 4)
			{
				$pisahSingleRate = substr($valueSingleRate,0,2);
				$pisahSingleRateDesimal = substr($valueSingleRate,2);
				$pisahSingleRateFix = $pisahSingleRate.'.'.$pisahSingleRateDesimal.'';
			}
			else if(mb_strlen($valueSingleRate) == 5)
			{
				$pisahSingleRate = substr($valueSingleRate,0,3);
				$pisahSingleRateDesimal = substr($valueSingleRate,3);
				$pisahSingleRateFix = $pisahSingleRate.'.'.$pisahSingleRateDesimal.'';
			}
			else if(mb_strlen($valueSingleRate) == 6)
			{
				$pisahSingleRate = substr($valueSingleRate,0,1);
				$pisahSingleRateMid = substr($valueSingleRate, 1, 3);
				$pisahSingleRateDesimal = substr($valueSingleRate, 4);
				$pisahSingleRateFix = $pisahSingleRate.','.$pisahSingleRateMid.'.'.$pisahSingleRateDesimal.'';
			}
			else if(mb_strlen($valueSingleRate) == 7)
			{
				$pisahSingleRate = substr($valueSingleRate,0,2);
				$pisahSingleRateMid = substr($valueSingleRate, 2, 3);
				$pisahSingleRateDesimal = substr($valueSingleRate, 5);
				$pisahSingleRateFix = $pisahSingleRate.','.$pisahSingleRateMid.'.'.$pisahSingleRateDesimal.'';
			}
			else if(mb_strlen($valueSingleRate) == 8)
			{
				$pisahSingleRate = substr($valueSingleRate, 0, 3);
				$pisahSingleRateMid = substr($valueSingleRate, 3, 3);
				$pisahSingleRateDesimal = substr($valueSingleRate, 6);
				$pisahSingleRateFix = $pisahSingleRate.','.$pisahSingleRateMid.'.'.$pisahSingleRateDesimal.'';
			}
			else if(mb_strlen($valueSingleRate) == 9)
			{
				$pisahSingleRate = substr($valueSingleRate, 0, 1);
				$pisahSingleRateMid = substr($valueSingleRate, 1,3);
				$pisahSingleRateMid1 = substr($valueSingleRate, 4, 3);
				$pisahSingleRateDesimal = substr($valueSingleRate, 7);
				$pisahSingleRateFix = $pisahSingleRate.','.$pisahSingleRateMid.','.$pisahSingleRateMid1.'.'.$pisahSingleRateDesimal.'';
			}
			else if(mb_strlen($valueSingleRate) == 10)
			{
				$pisahSingleRate = substr($valueSingleRate, 0, 2);
				$pisahSingleRateMid = substr($valueSingleRate, 2,3);
				$pisahSingleRateMid1 = substr($valueSingleRate, 5,3);
				$pisahSingleRateDesimal = substr($valueSingleRate, 8);
				$pisahSingleRateFix = $pisahSingleRate.','.$pisahSingleRateMid.','.$pisahSingleRateMid1.'.'.$pisahSingleRateDesimal.'';
			}
			else if(mb_strlen($valueSingleRate) == 11)
			{
				$pisahSingleRate = substr($valueSingleRate, 0, 3);
				$pisahSingleRateMid = substr($valueSingleRate, 3,3);
				$pisahSingleRateMid1 = substr($valueSingleRate, 6,3);
				$pisahSingleRateDesimal = substr($valueSingleRate, 9);
				$pisahSingleRateFix = $pisahSingleRate.','.$pisahSingleRateMid.','.$pisahSingleRateMid1.'.'.$pisahSingleRateDesimal.'';
			}
			else if(mb_strlen($valueSingleRate) == 12)
			{
				$pisahSingleRate = substr($valueSingleRate, 0, 1);
				$pisahSingleRateMid = substr($valueSingleRate, 1,3);
				$pisahSingleRateMid1 = substr($valueSingleRate, 4,3);
				$pisahSingleRateMid2 = substr($valueSingleRate, 7, 3);
				$pisahSingleRateDesimal = substr($valueSingleRate, 10);
				$pisahSingleRateFix = $pisahSingleRate.','.$pisahSingleRateMid.','.$pisahSingleRateMid1.','.$pisahSingleRateMid2.'.'.$pisahSingleRateDesimal.'';
			}



			// DOUBLE

			if(mb_strlen($valueDoubleRate) == 3)
			{
				$pisahDoubleRate = substr($valueDoubleRate, 0,1);
				$pisahDoubleRateDesimal = substr($valueDoubleRate, 1);
				$pisahDoubleRateFix = $pisahDoubleRate.'.'.$pisahDoubleRateDesimal.'';
			}
			else if(mb_strlen($valueDoubleRate) == 4)
			{
				$pisahDoubleRate = substr($valueDoubleRate,0,2);
				$pisahDoubleRateDesimal = substr($valueDoubleRate,2);
				$pisahDoubleRateFix = $pisahDoubleRate.'.'.$pisahDoubleRateDesimal.'';
			}
			else if(mb_strlen($valueDoubleRate) == 5)
			{
				$pisahDoubleRate = substr($valueDoubleRate,0,3);
				$pisahDoubleRateDesimal = substr($valueDoubleRate,3);
				$pisahDoubleRateFix = $pisahSingleRate.'.'.$pisahSingleRateDesimal.'';
			}
			else if(mb_strlen($valueDoubleRate) == 6)
			{
				$pisahDoubleRate = substr($valueDoubleRate,0,1);
				$pisahDoubleRateMid = substr($valueDoubleRate, 1, 3);
				$pisahDoubleRateDesimal = substr($valueDoubleRate, 4);
				$pisahDoubleRateFix = $pisahDoubleRate.','.$pisahDoubleRateMid.'.'.$pisahDoubleRateDesimal.'';
			}
			else if(mb_strlen($valueDoubleRate) == 7)
			{
				$pisahDoubleRate = substr($valueDoubleRate,0,2);
				$pisahDoubleRateMid = substr($valueDoubleRate, 2, 3);
				$pisahDoubleRateDesimal = substr($valueDoubleRate, 5);
				$pisahDoubleRateFix = $pisahDoubleRate.','.$pisahDoubleRateMid.'.'.$pisahDoubleRateDesimal.'';
			}
			else if(mb_strlen($valueDoubleRate) == 8)
			{
				$pisahDoubleRate = substr($valueDoubleRate, 0, 3);
				$pisahDoubleRateMid = substr($valueDoubleRate, 3, 3);
				$pisahDoubleRateDesimal = substr($valueDoubleRate, 6);
				$pisahDoubleRateFix = $pisahDoubleRate.','.$pisahDoubleRateMid.'.'.$pisahDoubleRateDesimal.'';
			}
			else if(mb_strlen($valueDoubleRate) == 9)
			{
				$pisahDoubleRate = substr($valueDoubleRate, 0, 1);
				$pisahDoubleRateMid = substr($valueDoubleRate, 1,3);
				$pisahDoubleRateMid1 = substr($valueDoubleRate, 4, 3);
				$pisahDoubleRateDesimal = substr($valueDoubleRate, 7);
				$pisahDoubleRateFix = $pisahDoubleRate.','.$pisahDoubleRateMid.','.$pisahDoubleRateMid1.'.'.$pisahDoubleRateDesimal.'';
			}
			else if(mb_strlen($valueDoubleRate) == 10)
			{
				$pisahDoubleRate = substr($valueDoubleRate, 0, 2);
				$pisahDoubleRateMid = substr($valueDoubleRate, 2,3);
				$pisahDoubleRateMid1 = substr($valueDoubleRate, 5,3);
				$pisahDoubleRateDesimal = substr($valueDoubleRate, 8);
				$pisahDoubleRateFix = $pisahDoubleRate.','.$pisahDoubleRateMid.','.$pisahDoubleRateMid1.'.'.$pisahDoubleRateDesimal.'';
			}
			else if(mb_strlen($valueDoubleRate) == 11)
			{
				$pisahDoubleRate = substr($valueDoubleRate, 0, 3);
				$pisahDoubleRateMid = substr($valueDoubleRate, 3,3);
				$pisahDoubleRateMid1 = substr($valueDoubleRate, 6,3);
				$pisahDoubleRateDesimal = substr($valueDoubleRate, 9);
				$pisahDoubleRateFix = $pisahDoubleRate.','.$pisahDoubleRateMid.','.$pisahDoubleRateMid1.'.'.$pisahDoubleRateDesimal.'';
			}
			else if(mb_strlen($valueDoubleRate) == 12)
			{
				$pisahDoubleRate = substr($valueDoubleRate, 0, 1);
				$pisahDoubleRateMid = substr($valueDoubleRate, 1,3);
				$pisahDoubleRateMid1 = substr($valueDoubleRate, 4,3);
				$pisahDoubleRateMid2 = substr($valueDoubleRate, 7, 3);
				$pisahDoubleRateDesimal = substr($valueDoubleRate, 10);
				$pisahDoubleRateFix = $pisahDoubleRate.','.$pisahDoubleRateMid.','.$pisahDoubleRateMid1.','.$pisahDoubleRateMid2.'.'.$pisahDoubleRateDesimal.'';
			}

			// TWIN 

			if(mb_strlen($valueTwinRate) == 3)
			{
				$pisahTwinRate = substr($valueTwinRate, 0,1);
				$pisahTwinRateDesimal = substr($valueTwinRate, 1);
				$pisahTwinRateFix = $pisahTwinRate.'.'.$pisahTwinRateDesimal.'';
			}
			else if(mb_strlen($valueTwinRate) == 4)
			{
				$pisahTwinRate = substr($valueTwinRate,0,2);
				$pisahTwinRateDesimal = substr($valueTwinRate,2);
				$pisahTwinRateFix = $pisahTwinRate.'.'.$pisahTwinRateDesimal.'';
			}
			else if(mb_strlen($valueTwinRate) == 5)
			{
				$pisahTwinRate = substr($valueTwinRate,0,3);
				$pisahTwinRateDesimal = substr($valueTwinRate,3);
				$pisahTwinRateFix = $pisahTwinRate.'.'.$pisahTwinRateDesimal.'';
			}
			else if(mb_strlen($valueTwinRate) == 6)
			{
				$pisahTwinRate = substr($valueTwinRate,0,1);
				$pisahTwinRateMid = substr($valueTwinRate, 1, 3);
				$pisahTwinRateDesimal = substr($valueTwinRate, 4);
				$pisahTwinRateFix = $pisahTwinRate.','.$pisahTwinRateMid.'.'.$pisahTwinRateDesimal.'';
			}
			else if(mb_strlen($valueTwinRate) == 7)
			{
				$pisahTwinRate = substr($valueTwinRate,0,2);
				$pisahTwinRateMid = substr($valueTwinRate, 2, 3);
				$pisahTwinRateDesimal = substr($valueTwinRate, 5);
				$pisahTwinRateFix = $pisahTwinRate.','.$pisahTwinRateMid.'.'.$pisahTwinRateDesimal.'';
			}
			else if(mb_strlen($valueTwinRate) == 8)
			{
				$pisahTwinRate = substr($valueTwinRate, 0, 3);
				$pisahTwinRateMid = substr($valueTwinRate, 3, 3);
				$pisahTwinRateDesimal = substr($valueTwinRate, 6);
				$pisahTwinRateFix = $pisahTwinRate.','.$pisahTwinRateMid.'.'.$pisahTwinRateDesimal.'';
			}
			else if(mb_strlen($valueTwinRate) == 9)
			{
				$pisahTwinRate = substr($valueTwinRate, 0, 1);
				$pisahTwinRateMid = substr($valueTwinRate, 1,3);
				$pisahTwinRateMid1 = substr($valueTwinRate, 4, 3);
				$pisahTwinRateDesimal = substr($valueTwinRate, 7);
				$pisahTwinRateFix = $pisahTwinRate.','.$pisahTwinRateMid.','.$pisahTwinRateMid1.'.'.$pisahTwinRateDesimal.'';
			}
			else if(mb_strlen($valueTwinRate) == 10)
			{
				$pisahTwinRate = substr($valueTwinRate, 0, 2);
				$pisahTwinRateMid = substr($valueTwinRate, 2,3);
				$pisahTwinRateMid1 = substr($valueTwinRate, 5,3);
				$pisahTwinRateDesimal = substr($valueTwinRate, 8);
				$pisahTwinRateFix = $pisahTwinRate.','.$pisahTwinRateMid.','.$pisahTwinRateMid1.'.'.$pisahTwinRateDesimal.'';
			}
			else if(mb_strlen($valueTwinRate) == 11)
			{
				$pisahTwinRate = substr($valueTwinRate, 0, 3);
				$pisahTwinRateMid = substr($valueTwinRate, 3,3);
				$pisahTwinRateMid1 = substr($valueTwinRate, 6,3);
				$pisahTwinRateDesimal = substr($valueTwinRate, 9);
				$pisahTwinRateFix = $pisahTwinRate.','.$pisahTwinRateMid.','.$pisahTwinRateMid1.'.'.$pisahTwinRateDesimal.'';
			}
			else if(mb_strlen($valueTwinRate) == 12)
			{
				$pisahTwinRate = substr($valueTwinRate, 0, 1);
				$pisahTwinRateMid = substr($valueTwinRate, 1,3);
				$pisahTwinRateMid1 = substr($valueTwinRate, 4,3);
				$pisahTwinRateMid2 = substr($valueTwinRate, 7, 3);
				$pisahTwinRateDesimal = substr($valueTwinRate, 10);
				$pisahTwinRateFix = $pisahTwinRate.','.$pisahTwinRateMid.','.$pisahTwinRateMid1.','.$pisahTwinRateMid2.'.'.$pisahTwinRateDesimal.'';
			}


			// TRIPLE

			if(mb_strlen($valueTripleRate) == 3)
			{
				$pisahTripleRate = substr($valueTripleRate, 0,1);
				$pisahTripleRateDesimal = substr($valueTripleRate, 1);
				$pisahTripleRateFix = $pisahTripleRate.'.'.$pisahTripleRateDesimal.'';
			}
			else if(mb_strlen($valueTripleRate) == 4)
			{
				$pisahTripleRate = substr($valueTripleRate,0,2);
				$pisahTripleRateDesimal = substr($valueTripleRate,2);
				$pisahTripleRateFix = $pisahTripleRate.'.'.$pisahTripleRateDesimal.'';
			}
			else if(mb_strlen($valueTripleRate) == 5)
			{
				$pisahTripleRate = substr($valueTripleRate,0,3);
				$pisahTripleRateDesimal = substr($valueTripleRate,3);
				$pisahTripleRateFix = $pisahTripleRate.'.'.$pisahTripleRateDesimal.'';
			}
			else if(mb_strlen($valueTripleRate) == 6)
			{
				$pisahTripleRate = substr($valueTripleRate,0,1);
				$pisahTripleRateMid = substr($valueTripleRate, 1, 3);
				$pisahTripleRateDesimal = substr($valueTripleRate, 4);
				$pisahTripleRateFix = $pisahTripleRate.','.$pisahTripleRateMid.'.'.$pisahTripleRateDesimal.'';
			}
			else if(mb_strlen($valueTripleRate) == 7)
			{
				$pisahTripleRate = substr($valueTripleRate,0,2);
				$pisahTripleRateMid = substr($valueTripleRate, 2, 3);
				$pisahTripleRateDesimal = substr($valueTripleRate, 5);
				$pisahTripleRateFix = $pisahTripleRate.','.$pisahTripleateMid.'.'.$pisahTripleRateDesimal.'';
			}
			else if(mb_strlen($valueTripleRate) == 8)
			{
				$pisahTripleRate = substr($valueTripleRate, 0, 3);
				$pisahTripleRateMid = substr($valueTripleRate, 3, 3);
				$pisahTripleRateDesimal = substr($valueTripleRate, 6);
				$pisahTripleRateFix = $pisahTripleRate.','.$pisahTripleRateMid.'.'.$pisahTripleRateDesimal.'';
			}
			else if(mb_strlen($valueTripleRate) == 9)
			{
				$pisahTripleRate = substr($valueTripleRate, 0, 1);
				$pisahTripleRateMid = substr($valueTripleRate, 1,3);
				$pisahTripleRateMid1 = substr($valueTripleRate, 4, 3);
				$pisahTripleRateDesimal = substr($valueTripleRate, 7);
				$pisahTripleRateFix = $pisahTripleRate.','.$pisahTripleRateMid.','.$pisahTripleRateMid1.'.'.$pisahTripleRateDesimal.'';
			}
			else if(mb_strlen($valueTripleRate) == 10)
			{
				$pisahTripleRate = substr($valueTripleRate, 0, 2);
				$pisahTripleRateMid = substr($valueTripleRate, 2,3);
				$pisahTripleRateMid1 = substr($valueTripleRate, 5,3);
				$pisahTripleRateDesimal = substr($valueTripleRate, 8);
				$pisahTripleRateFix = $pisahTripleRate.','.$pisahTripleRateMid.','.$pisahTripleRateMid1.'.'.$pisahTripleRateDesimal.'';
			}
			else if(mb_strlen($valueTripleRate) == 11)
			{
				$pisahTripleRate = substr($valueTripleRate, 0, 3);
				$pisahTripleRateMid = substr($valueTripleRate, 3,3);
				$pisahTripleRateMid1 = substr($valueTripleRate, 6,3);
				$pisahTripleRateDesimal = substr($valueTripleRate, 9);
				$pisahTripleRateFix = $pisahTripleRate.','.$pisahTripleRateMid.','.$pisahTripleRateMid1.'.'.$pisahTripleRateDesimal.'';
			}
			else if(mb_strlen($valueTripleRate) == 12)
			{
				$pisahTripleRate = substr($valueTripleRate, 0, 1);
				$pisahTripleRateMid = substr($valueTripleRate, 1,3);
				$pisahTripleRateMid1 = substr($valueTripleRate, 4,3);
				$pisahTripleRateMid2 = substr($valueTripleRate, 7, 3);
				$pisahTripleRateDesimal = substr($valueTripleRate, 10);
				$pisahTripleRateFix = $pisahTripleRate.','.$pisahTripleRateMid.','.$pisahTripleRateMid1.','.$pisahTripleRateMid2.'.'.$pisahTripleRateDesimal.'';
			}



			// CHILD RATE
			if(mb_strlen($valueExtraChildRate) == 3)
			{
				$pisahExtraChildRate = substr($valueExtraChildRate, 0,1);
				$pisahExtraChildRateDesimal = substr($valueExtraChildRate, 1);
				$pisahExtraChildRateFix = $pisahExtraChildRate.'.'.$pisahExtraChildRateDesimal.'';
			}
			else if(mb_strlen($valueExtraChildRate) == 4)
			{
				$pisahExtraChildRate = substr($valueExtraChildRate,0,2);
				$pisahExtraChildRateDesimal = substr($valueExtraChildRate,2);
				$pisahExtraChildRateFix = $pisahExtraChildRate.'.'.$pisahExtraChildRateDesimal.'';
			}
			else if(mb_strlen($valueExtraChildRate) == 5)
			{
				$pisahExtraChildRate = substr($valueExtraChildRate,0,3);
				$pisahExtraChildRateDesimal = substr($valueExtraChildRate,3);
				$pisahExtraChildRateFix = $pisahExtraChildRate.'.'.$pisahExtraChildDesimal.'';
			}
			else if(mb_strlen($valueExtraChildRate) == 6)
			{
				$pisahExtraChildRate = substr($valueExtraChildRate,0,1);
				$pisahExtraChildRateMid = substr($valueExtraChildRate, 1, 3);
				$pisahExtraChildRateDesimal = substr($valueExtraChildRate, 4);
				$pisahExtraChildRateFix = $pisahExtraChildRate.','.$pisahExtraChildRateMid.'.'.$pisahExtraChildRateDesimal.'';
			}
			else if(mb_strlen($valueExtraChildRate) == 7)
			{
				$pisahExtraChildRate = substr($valueExtraChildRate,0,2);
				$pisahExtraChildRateMid = substr($valueExtraChildRate, 2, 3);
				$pisahExtraChildRateDesimal = substr($valueExtraChildRate, 5);
				$pisahExtraChildRateFix = $pisahExtraChildRate.','.$pisahExtraChildRateMid.'.'.$pisahExtraChildRateDesimal.'';
			}
			else if(mb_strlen($valueExtraChildRate) == 8)
			{
				$pisahExtraChildRate = substr($valueExtraChildRate, 0, 3);
				$pisahExtraChildRateMid = substr($valueExtraChildRate, 3, 3);
				$pisahExtraChildRateDesimal = substr($valueExtraChildRate, 6);
				$pisahExtraChildRateFix = $pisahExtraChildRate.','.$pisahExtraChildRateMid.'.'.$pisahExtraChildRateDesimal.'';
			}
			else if(mb_strlen($valueExtraChildRate) == 9)
			{
				$pisahExtraChildRate = substr($valueExtraChildRate, 0, 1);
				$pisahExtraChildRateMid = substr($valueExtraChildRate, 1,3);
				$pisahExtraChildRateMid1 = substr($valueExtraChildRate, 4, 3);
				$pisahExtraChildRateDesimal = substr($valueExtraChildRate, 7);
				$pisahExtraChildRateFix = $pisahExtraChildRate.','.$pisahExtraChildRateMid.','.$pisahExtraChildRateMid1.'.'.$pisahExtraChildRateDesimal.'';
			}
			else if(mb_strlen($valueExtraChildRate) == 10)
			{
				$pisahExtraChildRate = substr($valueExtraChildRate, 0, 2);
				$pisahExtraChildRateMid = substr($valueExtraChildRate, 2,3);
				$pisahExtraChildRateMid1 = substr($valueExtraChildRate, 5,3);
				$pisahExtraChildRateDesimal = substr($valueExtraChildRate, 8);
				$pisahExtraChildRateFix = $pisahExtraChildRate.','.$pisahExtraChildRateMid.','.$pisahExtraChildRateMid1.'.'.$pisahExtraChildRateDesimal.'';
			}
			else if(mb_strlen($valueExtraChildRate) == 11)
			{
				$pisahExtraChildRate = substr($valueExtraChildRate, 0, 3);
				$pisahExtraChildRateMid = substr($valueExtraChildRate, 3,3);
				$pisahExtraChildRateMid1 = substr($valueExtraChildRate, 6,3);
				$pisahExtraChildRateDesimal = substr($valueExtraChildRate, 9);
				$pisahExtraChildRateFix = $pisahExtraChildRate.','.$pisahExtraChildRateMid.','.$pisahExtraChildRateMid1.'.'.$pisahExtraChildRateDesimal.'';
			}
			else if(mb_strlen($valueExtraChildRate) == 12)
			{
				$pisahExtraChildRate = substr($valueExtraChildRate, 0, 1);
				$pisahExtraChildRateMid = substr($valueExtraChildRate, 1,3);
				$pisahExtraChildRateMid1 = substr($valueExtraChildRate, 4,3);
				$pisahExtraChildRateMid2 = substr($valueExtraChildRate, 7, 3);
				$pisahExtraChildRateDesimal = substr($valueExtraChildRate, 10);
				$pisahExtraChildRateFix = $pisahExtraChildRate.','.$pisahExtraChildRateMid.','.$pisahExtraChildRateMid1.','.$pisahExtraChildRateMid2.'.'.$pisahExtraChildRateDesimal.'';
			}



			// ADULT RATE
			if(mb_strlen($valueExtraAdultRate) == 3)
			{
				$pisahExtraAdultRate = substr($valueExtraAdultRate, 0,1);
				$pisahExtraAdultRateDesimal = substr($valueExtraAdultRate, 1);
				$pisahExtraAdultRateFix = $pisahExtraAdultRate.'.'.$pisahExtraAdultRateDesimal.'';
			}
			else if(mb_strlen($valueExtraAdultRate) == 4)
			{
				$pisahExtraAdultRate = substr($valueExtraAdultRate,0,2);
				$pisahExtraAdultRateDesimal = substr($valueExtraAdultRate,2);
				$pisahExtraAdultRateFix = $pisahExtraAdultRate.'.'.$pisahExtraAdultRateDesimal.'';
			}
			else if(mb_strlen($valueExtraAdultRate) == 5)
			{
				$pisahExtraAdultRate = substr($valueExtraAdultRate,0,3);
				$pisahExtraAdultRateDesimal = substr($valueExtraAdultRate,3);
				$pisahExtraAdultRateFix = $pisahExtraAdultRate.'.'.$pisahExtraAdultRateDesimal.'';
			}
			else if(mb_strlen($valueExtraAdultRate) == 6)
			{
				$pisahExtraAdultRate = substr($valueExtraAdultRate,0,1);
				$pisahExtraAdultRateMid = substr($valueExtraAdultRate, 1, 3);
				$pisahExtraAdultRateDesimal = substr($valueExtraAdultRate, 4);
				$pisahExtraAdultRateFix = $pisahExtraAdultRate.','.$pisahExtraAdultRateMid.'.'.$pisahExtraAdultRateDesimal.'';
			}
			else if(mb_strlen($valueExtraAdultRate) == 7)
			{
				$pisahExtraAdultRate = substr($valueExtraAdultRate,0,2);
				$pisahExtraAdultRateMid = substr($valueExtraAdultRate, 2, 3);
				$pisahExtraAdultRateDesimal = substr($valueExtraAdultRate, 5);
				$pisahExtraAdultRateFix = $pisahExtraAdultRate.','.$pisahExtraAdultRateMid.'.'.$pisahExtraAdultRateDesimal.'';
			}
			else if(mb_strlen($valueExtraAdultRate) == 8)
			{
				$pisahExtraAdultRate = substr($valueExtraAdultRate, 0, 3);
				$pisahExtraAdultRateMid = substr($valueExtraAdultRate, 3, 3);
				$pisahExtraAdultRateDesimal = substr($valueExtraAdultRate, 6);
				$pisahExtraAdultRateFix = $pisahExtraAdultRate.','.$pisahExtraAdultRateMid.'.'.$pisahExtraAdultRateDesimal.'';
			}
			else if(mb_strlen($valueExtraAdultRate) == 9)
			{
				$pisahExtraAdultRate = substr($valueExtraAdultRate, 0, 1);
				$pisahExtraAdultRateMid = substr($valueExtraAdultRate, 1,3);
				$pisahExtraAdultRateMid1 = substr($valueExtraAdultRate, 4, 3);
				$pisahExtraAdultRateDesimal = substr($valueExtraAdultRate, 7);
				$pisahExtraAdultRateFix = $pisahExtraAdultRate.','.$pisahExtraAdultRateMid.','.$pisahExtraAdultRateMid1.'.'.$pisahExtraAdultRateDesimal.'';
			}
			else if(mb_strlen($valueExtraAdultRate) == 10)
			{
				$pisahExtraAdultRate = substr($valueExtraAdultRate, 0, 2);
				$pisahExtraAdultRateMid = substr($valueExtraAdultRate, 2,3);
				$pisahExtraAdultRateMid1 = substr($valueExtraAdultRate, 5,3);
				$pisahExtraAdultRateDesimal = substr($valueExtraAdultRate, 8);
				$pisahExtraAdultRateFix = $pisahExtraAdultRate.','.$pisahExtraAdultRateMid.','.$pisahExtraAdultRateMid1.'.'.$pisahExtraAdultRateDesimal.'';
			}
			else if(mb_strlen($valueExtraAdultRate) == 11)
			{
				$pisahExtraAdultRate = substr($valueExtraAdultRate, 0, 3);
				$pisahExtraAdultRateMid = substr($valueExtraAdultRate, 3,3);
				$pisahExtraAdultRateMid1 = substr($valueExtraAdultRate, 6,3);
				$pisahExtraAdultRateDesimal = substr($valueExtraAdultRate, 9);
				$pisahExtraAdultRateFix = $pisahExtraAdultRate.','.$pisahExtraAdultRateMid.','.$pisahExtraAdultRateMid1.'.'.$pisahExtraAdultRateDesimal.'';
			}
			else if(mb_strlen($valueExtraAdultRate) == 12)
			{
				$pisahExtraAdultRate = substr($valueExtraAdultRate, 0, 1);
				$pisahExtraAdultRateMid = substr($valueExtraAdultRate, 1,3);
				$pisahExtraAdultRateMid1 = substr($valueExtraAdultRate, 4,3);
				$pisahExtraAdultRateMid2 = substr($valueExtraAdultRate, 7, 3);
				$pisahExtraAdultRateDesimal = substr($valueExtraAdultRate, 10);
				$pisahExtraAdultRateFix = $pisahExtraAdultRate.','.$pisahExtraAdultRateMid.','.$pisahExtraAdultRateMid1.','.$pisahExtraAdultRateMid2.'.'.$pisahExtraAdultRateDesimal.'';
			}
		}
		if(!empty($single))
		{
			$jumlahSingle = $single * $valueSingleRate;
		}
		else
		{
			$jumlahSingle = 0;
		}
		if(!empty($double))
		{
			$jumlahDouble = $double * $valueDoubleRate;
		}
		else
		{
			$jumlahDouble = 0;
		}
		if(!empty($twin))
		{
			$jumlahTwin = $twin * $valueTwinRate;
		}
		else
		{
			$jumlahTwin = 0;
		}
		if(!empty($triple))
		{
			$jumlahTriple = $triple * $valueTripleRate;
		}
		else
		{
			$jumlahTriple = 0;
		}

		$valueTotalPrice = ($jumlahSingle+$jumlahTwin+$jumlahDouble+$jumlahTriple)*$SCUqty;
		if(mb_strlen($valueTotalPrice) == 3)
			{
				$pisahTotalPrice = substr($valueTotalPrice, 0,1);
				$pisahTotalPriceDesimal = substr($valueTotalPrice, 1);
				$pisahTotalPriceFix = $pisahTotalPrice.'.'.$pisahTotalPriceDesimal.'';
			}
			else if(mb_strlen($valueTotalPrice) == 4)
			{
				$pisahTotalPrice = substr($valueTotalPrice,0,2);
				$pisahTotalPriceDesimal = substr($valueTotalPrice,2);
				$pisahTotalPriceFix = $pisahTotalPrice.'.'.$pisahTotalPriceDesimal.'';
			}
			else if(mb_strlen($valueTotalPrice) == 5)
			{
				$pisahTotalPrice = substr($valueTotalPrice,0,3);
				$pisahTotalPriceDesimal = substr($valueTotalPrice,3);
				$pisahTotalPriceFix = $pisahTotalPrice.'.'.$pisahTotalPriceDesimal.'';
			}
			else if(mb_strlen($valueTotalPrice) == 6)
			{
				$pisahTotalPrice = substr($valueTotalPrice,0,1);
				$pisahTotalPriceMid = substr($valueTotalPrice, 1, 3);
				$pisahTotalPriceDesimal = substr($valueTotalPrice, 4);
				$pisahTotalPriceFix = $pisahTotalPrice.','.$pisahTotalPriceMid.'.'.$pisahTotalPriceDesimal.'';
			}
			else if(mb_strlen($valueTotalPrice) == 7)
			{
				$pisahTotalPrice = substr($valueTotalPrice,0,2);
				$pisahTotalPriceMid = substr($valueTotalPrice, 2, 3);
				$pisahTotalPriceDesimal = substr($valueTotalPrice, 5);
				$pisahTotalPriceFix = $pisahTotalPrice.','.$pisahTotalPriceMid.'.'.$pisahTotalPriceDesimal.'';
			}
			else if(mb_strlen($valueTotalPrice) == 8)
			{
				$pisahTotalPrice = substr($valueTotalPrice, 0, 3);
				$pisahTotalPriceMid = substr($valueTotalPrice, 3, 3);
				$pisahTotalPriceDesimal = substr($valueTotalPrice, 6);
				$pisahTotalPriceFix = $pisahTotalPrice.','.$pisahTotalPriceMid.'.'.$pisahTotalPriceDesimal.'';
			}
			else if(mb_strlen($valueTotalPrice) == 9)
			{
				$pisahTotalPrice = substr($valueTotalPrice, 0, 1);
				$pisahTotalPriceMid = substr($valueTotalPrice, 1,3);
				$pisahTotalPriceMid1 = substr($valueTotalPrice, 4, 3);
				$pisahTotalPriceDesimal = substr($valueTotalPrice, 7);
				$pisahTotalPriceFix = $pisahTotalPrice.','.$pisahTotalPriceMid.','.$pisahTotalPriceMid1.'.'.$pisahTotalPriceDesimal.'';
			}
			else if(mb_strlen($valueTotalPrice) == 10)
			{
				$pisahTotalPrice = substr($valueTotalPrice, 0, 2);
				$pisahTotalPriceMid = substr($valueTotalPrice, 2,3);
				$pisahTotalPriceMid1 = substr($valueTotalPrice, 5,3);
				$pisahTotalPriceDesimal = substr($valueTotalPrice, 8);
				$pisahTotalPriceFix = $pisahTotalPrice.','.$pisahTotalPriceMid.','.$pisahTotalPriceMid1.'.'.$pisahTotalPriceDesimal.'';
			}
			else if(mb_strlen($valueTotalPrice) == 11)
			{
				$pisahTotalPrice = substr($valueTotalPrice, 0, 3);
				$pisahTotalPriceMid = substr($valueTotalPrice, 3,3);
				$pisahTotalPriceMid1 = substr($valueTotalPrice, 6,3);
				$pisahTotalPriceDesimal = substr($valueTotalPrice, 9);
				$pisahTotalPriceFix = $pisahTotalPrice.','.$pisahTotalPriceMid.','.$pisahTotalPriceMid1.'.'.$pisahTotalPriceDesimal.'';
			}
			else if(mb_strlen($valueTotalPrice) == 12)
			{
				$pisahTotalPrice = substr($valueTotalPrice, 0, 1);
				$pisahTotalPriceMid = substr($valueTotalPrice, 1,3);
				$pisahTotalPriceMid1 = substr($valueTotalPrice, 4,3);
				$pisahTotalPriceMid2 = substr($valueTotalPrice, 7, 3);
				$pisahTotalPriceDesimal = substr($valueTotalPrice, 10);
				$pisahTotalPriceFix = $pisahTotalPrice.','.$pisahTotalPriceMid.','.$pisahTotalPriceMid1.','.$pisahTotalPriceMid2.'.'.$pisahTotalPriceDesimal.'';
			}
		}
	}
	else
	{
	
	//$username = $_SESSION["username"];
	//$password = $_SESSION["password"];
	$username = "TESTWX";
	$password = "TESTWX";
	//$key = $_GET['key'];
	//$username = "TESTWX";
	//$password = "TESTWX";
	$key = "DPSACAAPDPS??????";
	$dateFrom = date('Y-m-d');
	$SCUqty = "1";
	$roomType = "TW";
	$adult = "2";
	$code = substr($key, 5, 6);//supplier code
	$service = substr($key, 11, 6);//option code


	//echo 'username: '.$username.'<br />password: '.$password.'<br />destination: '.$destination.'<br />dateFrom: '.$dateFrom.'<br />date to: '.$dateTo.'<br />room: '.$rooms.'<br />Children: '.$children.'<br />Adult: '.$adults.'<br />SCU: '.$interval.'<br />locCOde: '.$locCOde.'<br />Code: '.$code.'<br />Address: '.$address.'<br />service: '.$service.'';

	$xml_request = '<?xml version="1.0"?>'
	.'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
	.'<Request>'
	.'<OptionInfoRequest>'
	.'<AgentID>'.$username.'</AgentID>'
	.'<Password>'.$password.'</Password>'
	.'<Opt>'.$key.'</Opt>'
	.'<Info>GMFTD</Info>'
	.'<DateFrom>'.$dateFrom.'</DateFrom>'
	.'<SCUqty>'.$SCUqty.'</SCUqty>'
	.'<RoomConfigs><RoomConfig>'
	.'<Adults>'.$adult.'</Adults>'
	.'<RoomType>'.$roomType.'</RoomType>'
	.'</RoomConfig></RoomConfigs>'
	.'</OptionInfoRequest>'
	.'</Request>';

	$loc = $_SESSION['loc'];
            
    if($loc == 'Thailand')
    {
        $urls = "http://59.153.23.26:8080/iComLive_Thailand/servlet/conn";
    }
    else if($loc == 'Indonesia')
    {
        $urls = "http://59.153.23.26:8080/iComLive/servlet/conn";
    }
    else if($loc == 'Test')
    {
        $urls = "http://59.153.23.26:8080/iComTest/servlet/conn";
    }
	
	$option = array(
		CURLOPT_RETURNTRANSFER => TRUE,							// return web page
		CURLOPT_HEADER => FALSE,								// don't return header
		CURLOPT_POSTFIELDS => $xml_request,						// POST XML Request
		CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),	// Sent HEADER XML
		CURLOPT_URL => $url
		);

	//open connection
	$ch = curl_init();
	curl_setopt_array($ch, $option);
	
	$data = curl_exec($ch);


	$xml = new DOMDocument();
	$xml -> loadXML($data);


	$searchNode = $xml->getElementsByTagName("OptionInfoReply");
	$jumlahOpt = ($xml->getElementsByTagName("Opt")->length);
	
	foreach( $searchNode as $searchNode)
	{
		for($i=0; $i<$jumlahOpt; $i++)
		{
			$xmlOpt[$i] = $searchNode->getElementsByTagName("Opt");
			$valueOpt[$i] = $xmlOpt[$i]->item($i)->nodeValue;

			$xmlSupplierName[$i] = $searchNode->getElementsByTagName("SupplierName");
			$valueSupplierName[$i] = $xmlSupplierName[$i]->item($i)->nodeValue;

			$xmlDescription[$i] = $searchNode->getElementsByTagName("Description");
			$valueDescription[$i] = $xmlDescription[$i]->item($i)->nodeValue;

			$xmlComment[$i] = $searchNode->getElementsByTagName("Comment");
			$valueComment[$i] = $xmlComment[$i]->item($i)->nodeValue;

			$xmlLocality[$i] = $searchNode->getElementsByTagName("LocalityDescription");
			$valueLocality[$i] = $xmlLocality[$i]->item($i)->nodeValue;

			$xmlClass[$i] = $searchNode->getElementsByTagName("ClassDescription");
			$valueClass[$i] = $xmlClass[$i]->item($i)->nodeValue;
			
			$xmlButtonName[$i] = $searchNode->getElementsByTagName("ButtonName");
			$valueButtonName[$i] = $xmlButtonName[$i]->item($i)->nodeValue;

			$xmlNoteText[$i] = $searchNode->getElementsByTagName("NoteText");
			$valueNoteText[$i] = $xmlNoteText[$i]->item($i)->nodeValue;

			$pisah = explode("ROOM FEATURES:",$valueNoteText[$i]);
			$pisah1[$i] = str_replace("ROOM DESCRIPTION:", "", $pisah[0]);

			$xmlAvailability[$i] = $searchNode->getElementsByTagName("Availability");
			$valueAvailability[$i] = $xmlAvailability[$i]->item($i)->nodeValue;

			$xmlCurrency[$i] = $searchNode->getElementsByTagName("Currency");
			$valueCurrency[$i] = $xmlCurrency[$i]->item($i)->nodeValue;

			$xmlTotalPrice[$i] = $searchNode->getElementsByTagName("TotalPrice");
			$valueTotalPrice[$i] = $xmlTotalPrice[$i]->item($i)->nodeValue;

			$xmlAgentPrice[$i] = $searchNode->getElementsByTagName("AgentPrice");
			$valueAgentPrice[$i] = $xmlAgentPrice[$i]->item($i)->nodeValue;

			//RATE
			$xmlDateFrom[$i] = $searchNode->getElementsByTagName("DateFrom");
			$valueDateFrom[$i] = $xmlDateFrom[$i]->item($i)->nodeValue;
			$xmlDateTo[$i] = $searchNode->getElementsByTagName("DateTo");
			$valueDateTo[$i] = $xmlDateTo[$i]->item($i)->nodeValue;

			$xmlSingleRate[$i] = $searchNode->getElementsByTagName("SingleRate");
			$valueSingleRate[$i] = $xmlSingleRate[$i]->item($i)->nodeValue;
			$xmlDoubleRate[$i] = $searchNode->getElementsByTagName("DoubleRate");
			$valueDoubleRate[$i] = $xmlDoubleRate[$i]->item($i)->nodeValue;
			$xmlTwinRate[$i] = $searchNode->getElementsByTagName("TwinRate");
			$valueTwinRate[$i] = $xmlTwinRate[$i]->item($i)->nodeValue;
			$xmlTripleRate[$i] = $searchNode->getElementsByTagName("TripleRate");
			$valueTripleRate[$i] = $xmlTripleRate[$i]->item($i)->nodeValue;
			$xmlExtraAdultRate[$i] = $searchNode->getElementsByTagName("ExtraAdultRate");
			$valueExtraAdultRate[$i] = $xmlExtraAdultRate[$i]->item($i)->nodeValue;
			$xmlExtraChildRate[$i] = $searchNode->getElementsByTagName("ExtraChildRate");
			$valueExtraChildRate[$i] = $xmlExtraChildRate[$i]->item($i)->nodeValue;

			// SINGLE RATE
			if(mb_strlen($valueSingleRate[$i]) == 3)
			{
				$pisahSingleRate[$i] = substr($valueSingleRate[$i], 0,1);
				$pisahSingleRateDesimal[$i] = substr($valueSingleRate[$i], 1);
				$pisahSingleRateFix[$i] = $pisahSingleRate[$i].'.'.$pisahSingleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueSingleRate[$i]) == 4)
			{
				$pisahSingleRate[$i] = substr($valueSingleRate[$i],0,2);
				$pisahSingleRateDesimal[$i] = substr($valueSingleRate[$i],2);
				$pisahSingleRateFix[$i] = $pisahSingleRate[$i].'.'.$pisahSingleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueSingleRate[$i]) == 5)
			{
				$pisahSingleRate[$i] = substr($valueSingleRate[$i],0,3);
				$pisahSingleRateDesimal[$i] = substr($valueSingleRate[$i],3);
				$pisahSingleRateFix[$i] = $pisahSingleRate[$i].'.'.$pisahSingleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueSingleRate[$i]) == 6)
			{
				$pisahSingleRate[$i] = substr($valueSingleRate[$i],0,1);
				$pisahSingleRateMid[$i] = substr($valueSingleRate[$i], 1, 3);
				$pisahSingleRateDesimal[$i] = substr($valueSingleRate[$i], 4);
				$pisahSingleRateFix[$i] = $pisahSingleRate[$i].','.$pisahSingleRateMid[$i].'.'.$pisahSingleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueSingleRate[$i]) == 7)
			{
				$pisahSingleRate[$i] = substr($valueSingleRate[$i],0,2);
				$pisahSingleRateMid[$i] = substr($valueSingleRate[$i], 2, 3);
				$pisahSingleRateDesimal[$i] = substr($valueSingleRate[$i], 5);
				$pisahSingleRateFix[$i] = $pisahSingleRate[$i].','.$pisahSingleRateMid[$i].'.'.$pisahSingleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueSingleRate[$i]) == 8)
			{
				$pisahSingleRate[$i] = substr($valueSingleRate[$i], 0, 3);
				$pisahSingleRateMid[$i] = substr($valueSingleRate[$i], 3, 3);
				$pisahSingleRateDesimal[$i] = substr($valueSingleRate[$i], 6);
				$pisahSingleRateFix[$i] = $pisahSingleRate[$i].','.$pisahSingleRateMid[$i].'.'.$pisahSingleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueSingleRate[$i]) == 9)
			{
				$pisahSingleRate[$i] = substr($valueSingleRate[$i], 0, 1);
				$pisahSingleRateMid[$i] = substr($valueSingleRate[$i], 1,3);
				$pisahSingleRateMid1[$i] = substr($valueSingleRate[$i], 4, 3);
				$pisahSingleRateDesimal[$i] = substr($valueSingleRate[$i], 7);
				$pisahSingleRateFix[$i] = $pisahSingleRate[$i].','.$pisahSingleRateMid[$i].','.$pisahSingleRateMid1[$i].'.'.$pisahSingleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueSingleRate[$i]) == 10)
			{
				$pisahSingleRate[$i] = substr($valueSingleRate[$i], 0, 2);
				$pisahSingleRateMid[$i] = substr($valueSingleRate[$i], 2,3);
				$pisahSingleRateMid1[$i] = substr($valueSingleRate[$i], 5,3);
				$pisahSingleRateDesimal[$i] = substr($valueSingleRate[$i], 8);
				$pisahSingleRateFix[$i] = $pisahSingleRate[$i].','.$pisahSingleRateMid[$i].','.$pisahSingleRateMid1[$i].'.'.$pisahSingleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueSingleRate[$i]) == 11)
			{
				$pisahSingleRate[$i] = substr($valueSingleRate[$i], 0, 3);
				$pisahSingleRateMid[$i] = substr($valueSingleRate[$i], 3,3);
				$pisahSingleRateMid1[$i] = substr($valueSingleRate[$i], 6,3);
				$pisahSingleRateDesimal[$i] = substr($valueSingleRate[$i], 9);
				$pisahSingleRateFix[$i] = $pisahSingleRate[$i].','.$pisahSingleRateMid[$i].','.$pisahSingleRateMid1[$i].'.'.$pisahSingleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueSingleRate[$i]) == 12)
			{
				$pisahSingleRate[$i] = substr($valueSingleRate[$i], 0, 1);
				$pisahSingleRateMid[$i] = substr($valueSingleRate[$i], 1,3);
				$pisahSingleRateMid1[$i] = substr($valueSingleRate[$i], 4,3);
				$pisahSingleRateMid2[$i] = substr($valueSingleRate[$i], 7, 3);
				$pisahSingleRateDesimal[$i] = substr($valueSingleRate[$i], 10);
				$pisahSingleRateFix[$i] = $pisahSingleRate[$i].','.$pisahSingleRateMid[$i].','.$pisahSingleRateMid1[$i].','.$pisahSingleRateMid2[$i].'.'.$pisahSingleRateDesimal[$i].'';
			}



			// DOUBLE

			if(mb_strlen($valueDoubleRate[$i]) == 3)
			{
				$pisahDoubleRate[$i] = substr($valueDoubleRate[$i], 0,1);
				$pisahDoubleRateDesimal[$i] = substr($valueDoubleRate[$i], 1);
				$pisahDoubleRateFix[$i] = $pisahDoubleRate[$i].'.'.$pisahDoubleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueDoubleRate[$i]) == 4)
			{
				$pisahDoubleRate[$i] = substr($valueDoubleRate[$i],0,2);
				$pisahDoubleRateDesimal[$i] = substr($valueDoubleRate[$i],2);
				$pisahDoubleRateFix[$i] = $pisahDoubleRate[$i].'.'.$pisahDoubleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueDoubleRate[$i]) == 5)
			{
				$pisahDoubleRate[$i] = substr($valueDoubleRate[$i],0,3);
				$pisahDoubleRateDesimal[$i] = substr($valueDoubleRate[$i],3);
				$pisahDoubleRateFix[$i] = $pisahSingleRate[$i].'.'.$pisahSingleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueDoubleRate[$i]) == 6)
			{
				$pisahDoubleRate[$i] = substr($valueDoubleRate[$i],0,1);
				$pisahDoubleRateMid[$i] = substr($valueDoubleRate[$i], 1, 3);
				$pisahDoubleRateDesimal[$i] = substr($valueDoubleRate[$i], 4);
				$pisahDoubleRateFix[$i] = $pisahDoubleRate[$i].','.$pisahDoubleRateMid[$i].'.'.$pisahDoubleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueDoubleRate[$i]) == 7)
			{
				$pisahDoubleRate[$i] = substr($valueDoubleRate[$i],0,2);
				$pisahDoubleRateMid[$i] = substr($valueDoubleRate[$i], 2, 3);
				$pisahDoubleRateDesimal[$i] = substr($valueDoubleRate[$i], 5);
				$pisahDoubleRateFix[$i] = $pisahDoubleRate[$i].','.$pisahDoubleRateMid[$i].'.'.$pisahDoubleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueDoubleRate[$i]) == 8)
			{
				$pisahDoubleRate[$i] = substr($valueDoubleRate[$i], 0, 3);
				$pisahDoubleRateMid[$i] = substr($valueDoubleRate[$i], 3, 3);
				$pisahDoubleRateDesimal[$i] = substr($valueDoubleRate[$i], 6);
				$pisahDoubleRateFix[$i] = $pisahDoubleRate[$i].','.$pisahDoubleRateMid[$i].'.'.$pisahDoubleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueDoubleRate[$i]) == 9)
			{
				$pisahDoubleRate[$i] = substr($valueDoubleRate[$i], 0, 1);
				$pisahDoubleRateMid[$i] = substr($valueDoubleRate[$i], 1,3);
				$pisahDoubleRateMid1[$i] = substr($valueDoubleRate[$i], 4, 3);
				$pisahDoubleRateDesimal[$i] = substr($valueDoubleRate[$i], 7);
				$pisahDoubleRateFix[$i] = $pisahDoubleRate[$i].','.$pisahDoubleRateMid[$i].','.$pisahDoubleRateMid1[$i].'.'.$pisahDoubleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueDoubleRate[$i]) == 10)
			{
				$pisahDoubleRate[$i] = substr($valueDoubleRate[$i], 0, 2);
				$pisahDoubleRateMid[$i] = substr($valueDoubleRate[$i], 2,3);
				$pisahDoubleRateMid1[$i] = substr($valueDoubleRate[$i], 5,3);
				$pisahDoubleRateDesimal[$i] = substr($valueDoubleRate[$i], 8);
				$pisahDoubleRateFix[$i] = $pisahDoubleRate[$i].','.$pisahDoubleRateMid[$i].','.$pisahDoubleRateMid1[$i].'.'.$pisahDoubleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueDoubleRate[$i]) == 11)
			{
				$pisahDoubleRate[$i] = substr($valueDoubleRate[$i], 0, 3);
				$pisahDoubleRateMid[$i] = substr($valueDoubleRate[$i], 3,3);
				$pisahDoubleRateMid1[$i] = substr($valueDoubleRate[$i], 6,3);
				$pisahDoubleRateDesimal[$i] = substr($valueDoubleRate[$i], 9);
				$pisahDoubleRateFix[$i] = $pisahDoubleRate[$i].','.$pisahDoubleRateMid[$i].','.$pisahDoubleRateMid1[$i].'.'.$pisahDoubleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueDoubleRate[$i]) == 12)
			{
				$pisahDoubleRate[$i] = substr($valueDoubleRate[$i], 0, 1);
				$pisahDoubleRateMid[$i] = substr($valueDoubleRate[$i], 1,3);
				$pisahDoubleRateMid1[$i] = substr($valueDoubleRate[$i], 4,3);
				$pisahDoubleRateMid2[$i] = substr($valueDoubleRate[$i], 7, 3);
				$pisahDoubleRateDesimal[$i] = substr($valueDoubleRate[$i], 10);
				$pisahDoubleRateFix[$i] = $pisahDoubleRate[$i].','.$pisahDoubleRateMid[$i].','.$pisahDoubleRateMid1[$i].','.$pisahDoubleRateMid2[$i].'.'.$pisahDoubleRateDesimal[$i].'';
			}

			// TWIN 

			if(mb_strlen($valueTwinRate[$i]) == 3)
			{
				$pisahTwinRate[$i] = substr($valueTwinRate[$i], 0,1);
				$pisahTwinRateDesimal[$i] = substr($valueTwinRate[$i], 1);
				$pisahTwinRateFix[$i] = $pisahTwinRate[$i].'.'.$pisahTwinRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTwinRate[$i]) == 4)
			{
				$pisahTwinRate[$i] = substr($valueTwinRate[$i],0,2);
				$pisahTwinRateDesimal[$i] = substr($valueTwinRate[$i],2);
				$pisahTwinRateFix[$i] = $pisahTwinRate[$i].'.'.$pisahTwinRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTwinRate[$i]) == 5)
			{
				$pisahTwinRate[$i] = substr($valueTwinRate[$i],0,3);
				$pisahTwinRateDesimal[$i] = substr($valueTwinRate[$i],3);
				$pisahTwinRateFix[$i] = $pisahTwinRate[$i].'.'.$pisahTwinRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTwinRate[$i]) == 6)
			{
				$pisahTwinRate[$i] = substr($valueTwinRate[$i],0,1);
				$pisahTwinRateMid[$i] = substr($valueTwinRate[$i], 1, 3);
				$pisahTwinRateDesimal[$i] = substr($valueTwinRate[$i], 4);
				$pisahTwinRateFix[$i] = $pisahTwinRate[$i].','.$pisahTwinRateMid[$i].'.'.$pisahTwinRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTwinRate[$i]) == 7)
			{
				$pisahTwinRate[$i] = substr($valueTwinRate[$i],0,2);
				$pisahTwinRateMid[$i] = substr($valueTwinRate[$i], 2, 3);
				$pisahTwinRateDesimal[$i] = substr($valueTwinRate[$i], 5);
				$pisahTwinRateFix[$i] = $pisahTwinRate[$i].','.$pisahTwinRateMid[$i].'.'.$pisahTwinRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTwinRate[$i]) == 8)
			{
				$pisahTwinRate[$i] = substr($valueTwinRate[$i], 0, 3);
				$pisahTwinRateMid[$i] = substr($valueTwinRate[$i], 3, 3);
				$pisahTwinRateDesimal[$i] = substr($valueTwinRate[$i], 6);
				$pisahTwinRateFix[$i] = $pisahTwinRate[$i].','.$pisahTwinRateMid[$i].'.'.$pisahTwinRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTwinRate[$i]) == 9)
			{
				$pisahTwinRate[$i] = substr($valueTwinRate[$i], 0, 1);
				$pisahTwinRateMid[$i] = substr($valueTwinRate[$i], 1,3);
				$pisahTwinRateMid1[$i] = substr($valueTwinRate[$i], 4, 3);
				$pisahTwinRateDesimal[$i] = substr($valueTwinRate[$i], 7);
				$pisahTwinRateFix[$i] = $pisahTwinRate[$i].','.$pisahTwinRateMid[$i].','.$pisahTwinRateMid1[$i].'.'.$pisahTwinRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTwinRate[$i]) == 10)
			{
				$pisahTwinRate[$i] = substr($valueTwinRate[$i], 0, 2);
				$pisahTwinRateMid[$i] = substr($valueTwinRate[$i], 2,3);
				$pisahTwinRateMid1[$i] = substr($valueTwinRate[$i], 5,3);
				$pisahTwinRateDesimal[$i] = substr($valueTwinRate[$i], 8);
				$pisahTwinRateFix[$i] = $pisahTwinRate[$i].','.$pisahTwinRateMid[$i].','.$pisahTwinRateMid1[$i].'.'.$pisahTwinRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTwinRate[$i]) == 11)
			{
				$pisahTwinRate[$i] = substr($valueTwinRate[$i], 0, 3);
				$pisahTwinRateMid[$i] = substr($valueTwinRate[$i], 3,3);
				$pisahTwinRateMid1[$i] = substr($valueTwinRate[$i], 6,3);
				$pisahTwinRateDesimal[$i] = substr($valueTwinRate[$i], 9);
				$pisahTwinRateFix[$i] = $pisahTwinRate[$i].','.$pisahTwinRateMid[$i].','.$pisahTwinRateMid1[$i].'.'.$pisahTwinRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTwinRate[$i]) == 12)
			{
				$pisahTwinRate[$i] = substr($valueTwinRate[$i], 0, 1);
				$pisahTwinRateMid[$i] = substr($valueTwinRate[$i], 1,3);
				$pisahTwinRateMid1[$i] = substr($valueTwinRate[$i], 4,3);
				$pisahTwinRateMid2[$i] = substr($valueTwinRate[$i], 7, 3);
				$pisahTwinRateDesimal[$i] = substr($valueTwinRate[$i], 10);
				$pisahTwinRateFix[$i] = $pisahTwinRate[$i].','.$pisahTwinRateMid[$i].','.$pisahTwinRateMid1[$i].','.$pisahTwinRateMid2[$i].'.'.$pisahTwinRateDesimal[$i].'';
			}


			// TRIPLE

			if(mb_strlen($valueTripleRate[$i]) == 3)
			{
				$pisahTripleRate[$i] = substr($valueTripleRate[$i], 0,1);
				$pisahTripleRateDesimal[$i] = substr($valueTripleRate[$i], 1);
				$pisahTripleRateFix[$i] = $pisahTripleRate[$i].'.'.$pisahTripleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTripleRate[$i]) == 4)
			{
				$pisahTripleRate[$i] = substr($valueTripleRate[$i],0,2);
				$pisahTripleRateDesimal[$i] = substr($valueTripleRate[$i],2);
				$pisahTripleRateFix[$i] = $pisahTripleRate[$i].'.'.$pisahTripleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTripleRate[$i]) == 5)
			{
				$pisahTripleRate[$i] = substr($valueTripleRate[$i],0,3);
				$pisahTripleRateDesimal[$i] = substr($valueTripleRate[$i],3);
				$pisahTripleRateFix[$i] = $pisahTripleRate[$i].'.'.$pisahTripleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTripleRate[$i]) == 6)
			{
				$pisahTripleRate[$i] = substr($valueTripleRate[$i],0,1);
				$pisahTripleRateMid[$i] = substr($valueTripleRate[$i], 1, 3);
				$pisahTripleRateDesimal[$i] = substr($valueTripleRate[$i], 4);
				$pisahTripleRateFix[$i] = $pisahTripleRate[$i].','.$pisahTripleRateMid[$i].'.'.$pisahTripleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTripleRate[$i]) == 7)
			{
				$pisahTripleRate[$i] = substr($valueTripleRate[$i],0,2);
				$pisahTripleRateMid[$i] = substr($valueTripleRate[$i], 2, 3);
				$pisahTripleRateDesimal[$i] = substr($valueTripleRate[$i], 5);
				$pisahTripleRateFix[$i] = $pisahTripleRate[$i].','.$pisahTripleateMid[$i].'.'.$pisahTripleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTripleRate[$i]) == 8)
			{
				$pisahTripleRate[$i] = substr($valueTripleRate[$i], 0, 3);
				$pisahTripleRateMid[$i] = substr($valueTripleRate[$i], 3, 3);
				$pisahTripleRateDesimal[$i] = substr($valueTripleRate[$i], 6);
				$pisahTripleRateFix[$i] = $pisahTripleRate[$i].','.$pisahTripleRateMid[$i].'.'.$pisahTripleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTripleRate[$i]) == 9)
			{
				$pisahTripleRate[$i] = substr($valueTripleRate[$i], 0, 1);
				$pisahTripleRateMid[$i] = substr($valueTripleRate[$i], 1,3);
				$pisahTripleRateMid1[$i] = substr($valueTripleRate[$i], 4, 3);
				$pisahTripleRateDesimal[$i] = substr($valueTripleRate[$i], 7);
				$pisahTripleRateFix[$i] = $pisahTripleRate[$i].','.$pisahTripleRateMid[$i].','.$pisahTripleRateMid1[$i].'.'.$pisahTripleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTripleRate[$i]) == 10)
			{
				$pisahTripleRate[$i] = substr($valueTripleRate[$i], 0, 2);
				$pisahTripleRateMid[$i] = substr($valueTripleRate[$i], 2,3);
				$pisahTripleRateMid1[$i] = substr($valueTripleRate[$i], 5,3);
				$pisahTripleRateDesimal[$i] = substr($valueTripleRate[$i], 8);
				$pisahTripleRateFix[$i] = $pisahTripleRate[$i].','.$pisahTripleRateMid[$i].','.$pisahTripleRateMid1[$i].'.'.$pisahTripleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTripleRate[$i]) == 11)
			{
				$pisahTripleRate[$i] = substr($valueTripleRate[$i], 0, 3);
				$pisahTripleRateMid[$i] = substr($valueTripleRate[$i], 3,3);
				$pisahTripleRateMid1[$i] = substr($valueTripleRate[$i], 6,3);
				$pisahTripleRateDesimal[$i] = substr($valueTripleRate[$i], 9);
				$pisahTripleRateFix[$i] = $pisahTripleRate[$i].','.$pisahTripleRateMid[$i].','.$pisahTripleRateMid1[$i].'.'.$pisahTripleRateDesimal[$i].'';
			}
			else if(mb_strlen($valueTripleRate[$i]) == 12)
			{
				$pisahTripleRate[$i] = substr($valueTripleRate[$i], 0, 1);
				$pisahTripleRateMid[$i] = substr($valueTripleRate[$i], 1,3);
				$pisahTripleRateMid1[$i] = substr($valueTripleRate[$i], 4,3);
				$pisahTripleRateMid2[$i] = substr($valueTripleRate[$i], 7, 3);
				$pisahTripleRateDesimal[$i] = substr($valueTripleRate[$i], 10);
				$pisahTripleRateFix[$i] = $pisahTripleRate[$i].','.$pisahTripleRateMid[$i].','.$pisahTripleRateMid1[$i].','.$pisahTripleRateMid2[$i].'.'.$pisahTripleRateDesimal[$i].'';
			}



			// CHILD RATE
			if(mb_strlen($valueExtraChildRate[$i]) == 3)
			{
				$pisahExtraChildRate[$i] = substr($valueExtraChildRate[$i], 0,1);
				$pisahExtraChildRateDesimal[$i] = substr($valueExtraChildRate[$i], 1);
				$pisahExtraChildRateFix[$i] = $pisahExtraChildRate[$i].'.'.$pisahExtraChildRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraChildRate[$i]) == 4)
			{
				$pisahExtraChildRate[$i] = substr($valueExtraChildRate[$i],0,2);
				$pisahExtraChildRateDesimal[$i] = substr($valueExtraChildRate[$i],2);
				$pisahExtraChildRateFix[$i] = $pisahExtraChildRate[$i].'.'.$pisahExtraChildRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraChildRate[$i]) == 5)
			{
				$pisahExtraChildRate[$i] = substr($valueExtraChildRate[$i],0,3);
				$pisahExtraChildRateDesimal[$i] = substr($valueExtraChildRate[$i],3);
				$pisahExtraChildRateFix[$i] = $pisahExtraChildRate[$i].'.'.$pisahExtraChildDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraChildRate[$i]) == 6)
			{
				$pisahExtraChildRate[$i] = substr($valueExtraChildRate[$i],0,1);
				$pisahExtraChildRateMid[$i] = substr($valueExtraChildRate[$i], 1, 3);
				$pisahExtraChildRateDesimal[$i] = substr($valueExtraChildRate[$i], 4);
				$pisahExtraChildRateFix[$i] = $pisahExtraChildRate[$i].','.$pisahExtraChildRateMid[$i].'.'.$pisahExtraChildRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraChildRate[$i]) == 7)
			{
				$pisahExtraChildRate[$i] = substr($valueExtraChildRate[$i],0,2);
				$pisahExtraChildRateMid[$i] = substr($valueExtraChildRate[$i], 2, 3);
				$pisahExtraChildRateDesimal[$i] = substr($valueExtraChildRate[$i], 5);
				$pisahExtraChildRateFix[$i] = $pisahExtraChildRate[$i].','.$pisahExtraChildRateMid[$i].'.'.$pisahExtraChildRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraChildRate[$i]) == 8)
			{
				$pisahExtraChildRate[$i] = substr($valueExtraChildRate[$i], 0, 3);
				$pisahExtraChildRateMid[$i] = substr($valueExtraChildRate[$i], 3, 3);
				$pisahExtraChildRateDesimal[$i] = substr($valueExtraChildRate[$i], 6);
				$pisahExtraChildRateFix[$i] = $pisahExtraChildRate[$i].','.$pisahExtraChildRateMid[$i].'.'.$pisahExtraChildRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraChildRate[$i]) == 9)
			{
				$pisahExtraChildRate[$i] = substr($valueExtraChildRate[$i], 0, 1);
				$pisahExtraChildRateMid[$i] = substr($valueExtraChildRate[$i], 1,3);
				$pisahExtraChildRateMid1[$i] = substr($valueExtraChildRate[$i], 4, 3);
				$pisahExtraChildRateDesimal[$i] = substr($valueExtraChildRate[$i], 7);
				$pisahExtraChildRateFix[$i] = $pisahExtraChildRate[$i].','.$pisahExtraChildRateMid[$i].','.$pisahExtraChildRateMid1[$i].'.'.$pisahExtraChildRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraChildRate[$i]) == 10)
			{
				$pisahExtraChildRate[$i] = substr($valueExtraChildRate[$i], 0, 2);
				$pisahExtraChildRateMid[$i] = substr($valueExtraChildRate[$i], 2,3);
				$pisahExtraChildRateMid1[$i] = substr($valueExtraChildRate[$i], 5,3);
				$pisahExtraChildRateDesimal[$i] = substr($valueExtraChildRate[$i], 8);
				$pisahExtraChildRateFix[$i] = $pisahExtraChildRate[$i].','.$pisahExtraChildRateMid[$i].','.$pisahExtraChildRateMid1[$i].'.'.$pisahExtraChildRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraChildRate[$i]) == 11)
			{
				$pisahExtraChildRate[$i] = substr($valueExtraChildRate[$i], 0, 3);
				$pisahExtraChildRateMid[$i] = substr($valueExtraChildRate[$i], 3,3);
				$pisahExtraChildRateMid1[$i] = substr($valueExtraChildRate[$i], 6,3);
				$pisahExtraChildRateDesimal[$i] = substr($valueExtraChildRate[$i], 9);
				$pisahExtraChildRateFix[$i] = $pisahExtraChildRate[$i].','.$pisahExtraChildRateMid[$i].','.$pisahExtraChildRateMid1[$i].'.'.$pisahExtraChildRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraChildRate[$i]) == 12)
			{
				$pisahExtraChildRate[$i] = substr($valueExtraChildRate[$i], 0, 1);
				$pisahExtraChildRateMid[$i] = substr($valueExtraChildRate[$i], 1,3);
				$pisahExtraChildRateMid1[$i] = substr($valueExtraChildRate[$i], 4,3);
				$pisahExtraChildRateMid2[$i] = substr($valueExtraChildRate[$i], 7, 3);
				$pisahExtraChildRateDesimal[$i] = substr($valueExtraChildRate[$i], 10);
				$pisahExtraChildRateFix[$i] = $pisahExtraChildRate[$i].','.$pisahExtraChildRateMid[$i].','.$pisahExtraChildRateMid1[$i].','.$pisahExtraChildRateMid2[$i].'.'.$pisahExtraChildRateDesimal[$i].'';
			}



			// ADULT RATE
			if(mb_strlen($valueExtraAdultRate[$i]) == 3)
			{
				$pisahExtraAdultRate[$i] = substr($valueExtraAdultRate[$i], 0,1);
				$pisahExtraAdultRateDesimal[$i] = substr($valueExtraAdultRate[$i], 1);
				$pisahExtraAdultRateFix[$i] = $pisahExtraAdultRate[$i].'.'.$pisahExtraAdultRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraAdultRate[$i]) == 4)
			{
				$pisahExtraAdultRate[$i] = substr($valueExtraAdultRate[$i],0,2);
				$pisahExtraAdultRateDesimal[$i] = substr($valueExtraAdultRate[$i],2);
				$pisahExtraAdultRateFix[$i] = $pisahExtraAdultRate[$i].'.'.$pisahExtraAdultRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraAdultRate[$i]) == 5)
			{
				$pisahExtraAdultRate[$i] = substr($valueExtraAdultRate[$i],0,3);
				$pisahExtraAdultRateDesimal[$i] = substr($valueExtraAdultRate[$i],3);
				$pisahExtraAdultRateFix[$i] = $pisahExtraAdultRate[$i].'.'.$pisahExtraAdultRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraAdultRate[$i]) == 6)
			{
				$pisahExtraAdultRate[$i] = substr($valueExtraAdultRate[$i],0,1);
				$pisahExtraAdultRateMid[$i] = substr($valueExtraAdultRate[$i], 1, 3);
				$pisahExtraAdultRateDesimal[$i] = substr($valueExtraAdultRate[$i], 4);
				$pisahExtraAdultRateFix[$i] = $pisahExtraAdultRate[$i].','.$pisahExtraAdultRateMid[$i].'.'.$pisahExtraAdultRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraAdultRate[$i]) == 7)
			{
				$pisahExtraAdultRate[$i] = substr($valueExtraAdultRate[$i],0,2);
				$pisahExtraAdultRateMid[$i] = substr($valueExtraAdultRate[$i], 2, 3);
				$pisahExtraAdultRateDesimal[$i] = substr($valueExtraAdultRate[$i], 5);
				$pisahExtraAdultRateFix[$i] = $pisahExtraAdultRate[$i].','.$pisahExtraAdultRateMid[$i].'.'.$pisahExtraAdultRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraAdultRate[$i]) == 8)
			{
				$pisahExtraAdultRate[$i] = substr($valueExtraAdultRate[$i], 0, 3);
				$pisahExtraAdultRateMid[$i] = substr($valueExtraAdultRate[$i], 3, 3);
				$pisahExtraAdultRateDesimal[$i] = substr($valueExtraAdultRate[$i], 6);
				$pisahExtraAdultRateFix[$i] = $pisahExtraAdultRate[$i].','.$pisahExtraAdultRateMid[$i].'.'.$pisahExtraAdultRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraAdultRate[$i]) == 9)
			{
				$pisahExtraAdultRate[$i] = substr($valueExtraAdultRate[$i], 0, 1);
				$pisahExtraAdultRateMid[$i] = substr($valueExtraAdultRate[$i], 1,3);
				$pisahExtraAdultRateMid1[$i] = substr($valueExtraAdultRate[$i], 4, 3);
				$pisahExtraAdultRateDesimal[$i] = substr($valueExtraAdultRate[$i], 7);
				$pisahExtraAdultRateFix[$i] = $pisahExtraAdultRate[$i].','.$pisahExtraAdultRateMid[$i].','.$pisahExtraAdultRateMid1[$i].'.'.$pisahExtraAdultRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraAdultRate[$i]) == 10)
			{
				$pisahExtraAdultRate[$i] = substr($valueExtraAdultRate[$i], 0, 2);
				$pisahExtraAdultRateMid[$i] = substr($valueExtraAdultRate[$i], 2,3);
				$pisahExtraAdultRateMid1[$i] = substr($valueExtraAdultRate[$i], 5,3);
				$pisahExtraAdultRateDesimal[$i] = substr($valueExtraAdultRate[$i], 8);
				$pisahExtraAdultRateFix[$i] = $pisahExtraAdultRate[$i].','.$pisahExtraAdultRateMid[$i].','.$pisahExtraAdultRateMid1[$i].'.'.$pisahExtraAdultRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraAdultRate[$i]) == 11)
			{
				$pisahExtraAdultRate[$i] = substr($valueExtraAdultRate[$i], 0, 3);
				$pisahExtraAdultRateMid[$i] = substr($valueExtraAdultRate[$i], 3,3);
				$pisahExtraAdultRateMid1[$i] = substr($valueExtraAdultRate[$i], 6,3);
				$pisahExtraAdultRateDesimal[$i] = substr($valueExtraAdultRate[$i], 9);
				$pisahExtraAdultRateFix[$i] = $pisahExtraAdultRate[$i].','.$pisahExtraAdultRateMid[$i].','.$pisahExtraAdultRateMid1[$i].'.'.$pisahExtraAdultRateDesimal[$i].'';
			}
			else if(mb_strlen($valueExtraAdultRate[$i]) == 12)
			{
				$pisahExtraAdultRate[$i] = substr($valueExtraAdultRate[$i], 0, 1);
				$pisahExtraAdultRateMid[$i] = substr($valueExtraAdultRate[$i], 1,3);
				$pisahExtraAdultRateMid1[$i] = substr($valueExtraAdultRate[$i], 4,3);
				$pisahExtraAdultRateMid2[$i] = substr($valueExtraAdultRate[$i], 7, 3);
				$pisahExtraAdultRateDesimal[$i] = substr($valueExtraAdultRate[$i], 10);
				$pisahExtraAdultRateFix[$i] = $pisahExtraAdultRate[$i].','.$pisahExtraAdultRateMid[$i].','.$pisahExtraAdultRateMid1[$i].','.$pisahExtraAdultRateMid2[$i].'.'.$pisahExtraAdultRateDesimal[$i].'';
			}
			
		}
	}

	$xml_requestPrices = '<?xml version="1.0"?>'
	.'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
	.'<Request>'
	.'<SupplierInfoRequest>'
	.'<AgentID>'.$username.'</AgentID>'
	.'<Password>'.$password.'</Password>'
	.'<SupplierCode>'.$code.'</SupplierCode>'
	.'</SupplierInfoRequest>'
	.'</Request>';

	$loc = $_SESSION['loc'];
            
    if($loc == 'Thailand')
    {
        $urls = "http://59.153.23.26:8080/iComLive_Thailand/servlet/conn";
    }
    else if($loc == 'Indonesia')
    {
        $urls = "http://59.153.23.26:8080/iComLive/servlet/conn";
    }
    else if($loc == 'Test')
    {
        $urls = "http://59.153.23.26:8080/iComTest/servlet/conn";
    }
	
	$option = array(
		CURLOPT_RETURNTRANSFER => TRUE,							// return web page
		CURLOPT_HEADER => FALSE,								// don't return header
		CURLOPT_POSTFIELDS => $xml_requestPrices,						// POST XML Request
		CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),	// Sent HEADER XML
		CURLOPT_URL => $urls
		);

	//open connection
	$chs = curl_init();
	curl_setopt_array($chs, $option);
	
	$datas = curl_exec($chs);


	$xmls = new DOMDocument();
	$xmls -> loadXML($datas);


	$searchNodes = $xmls->getElementsByTagName("SupplierInfoReply");

	foreach( $searchNodes as $searchNodes)
	{
		$xmlName = $searchNodes->getElementsByTagName("Name");
		$valueName = $xmlName->item(0)->nodeValue;

		$xmlAddress = $searchNodes->getElementsByTagName("Address1");
		$valueAddress = $xmlAddress->item(0)->nodeValue;

		$xmlAddress2 = $searchNodes->getElementsByTagName("Address2");
		$valueAddress2 = $xmlAddress2->item(0)->nodeValue;

		$xmlAddress3 = $searchNodes->getElementsByTagName("Address3");
		$valueAddress3 = $xmlAddress3->item(0)->nodeValue;

		$xmlAddress4 = $searchNodes->getElementsByTagName("Address4");
		$valueAddress4 = $xmlAddress4->item(0)->nodeValue;

		$xmlAddress5 = $searchNodes->getElementsByTagName("Address5");
		$valueAddress5 = $xmlAddress5->item(0)->nodeValue;

		$xmlPostCode = $searchNodes->getElementsByTagName("PostCode");
		$valuePostCode = $xmlPostCode->item(0)->nodeValue;

		$xmlNoteTextChild = $searchNodes->getElementsByTagName("NoteText");
		$valueNoteTextChild = $xmlNoteTextChild->item(0)->nodeValue;

		$xmlNoteTextCancellation = $searchNodes->getElementsByTagName("NoteText");
		$valueNoteTextCancellation = $xmlNoteTextCancellation->item(1)->nodeValue;

		$xmlNoteTextOverview = $searchNodes->getElementsByTagName("NoteText");
		$valueNoteTextOverview = $xmlNoteTextOverview->item(2)->nodeValue;

		$xmlNoteTextGrup = $searchNodes->getElementsByTagName("NoteText");
		$valueNoteTextGrup = $xmlNoteTextGrup->item(3)->nodeValue;

		$xmlNoteTextHoneymoon = $searchNodes->getElementsByTagName("NoteText");
		$valueNoteTextHoneymoon = $xmlNoteTextHoneymoon->item(4)->nodeValue;

		$xmlAmenity = $searchNodes->getElementsByTagName("AmenityDescription");
		$valueAmenity = $xmlAmenity->item(0)->nodeValue;

		$xmlAmenity1 = $searchNodes->getElementsByTagName("AmenityDescription");
		$valueAmenity1 = $xmlAmenity1->item(1)->nodeValue;

		$xmlAmenity2 = $searchNodes->getElementsByTagName("AmenityDescription");
		$valueAmenity2 = $xmlAmenity2->item(2)->nodeValue;

		$xmlAmenity3 = $searchNodes->getElementsByTagName("AmenityDescription");
		$valueAmenity3 = $xmlAmenity3->item(3)->nodeValue;

		$xmlAmenity4 = $searchNodes->getElementsByTagName("AmenityDescription");
		$valueAmenity4 = $xmlAmenity4->item(4)->nodeValue;

		$xmlAmenity5 = $searchNodes->getElementsByTagName("AmenityDescription");
		$valueAmenity5 = $xmlAmenity5->item(5)->nodeValue;

		$xmlAmenity6 = $searchNodes->getElementsByTagName("AmenityDescription");
		$valueAmenity6 = $xmlAmenity6->item(6)->nodeValue;

		$xmlAmenity7 = $searchNodes->getElementsByTagName("AmenityDescription");
		$valueAmenity7 = $xmlAmenity7->item(7)->nodeValue;

		$xmlAmenity8 = $searchNodes->getElementsByTagName("AmenityDescription");
		$valueAmenity8 = $xmlAmenity8->item(8)->nodeValue;

		$xmlAmenity9 = $searchNodes->getElementsByTagName("AmenityDescription");
		$valueAmenity9 = $xmlAmenity9->item(9)->nodeValue;
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Online Tariff</title>
    <link rel="icon" href="http://www.panorama-destination.com/wp-content/uploads/2017/07/favico.png">
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
    <link type="text/css" rel="stylesheet" href="css/JFFormStyle-1.css" />
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <!-- js -->
    <script src="js/jquery.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <!-- //js --> 
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <!-- 
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png"> -->
	<style>
  		.loading {
   			position: fixed;
	   		left: 0px;
	   		top: 0px;
	   		width: 100%;
	   		height: 100%;
	   		z-index: 9999;
	   		background: url(images/giphy.gif) center no-repeat #fff;
  		}
  	</style>
</head>

<body>
	<div class="loading"></div>
    <!--header-->
    <div class="header">
        <div class="container">
            <div class="header-middle">
                <!--header-middle-->
                <div class="container">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="index.html"><img src="images/logo.png" alt="" /></a>
                        </div>
                    </div>
                    <div class="col-sm-8" style="padding-right: 2.5%;">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="#">
                                        <div class="center">
                                            Hello, <?php echo $username; ?></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-top">
                <div class="top-nav">
                    <span class="menu"><img src="images/menu.png" alt="" /></span>
                    <ul class="nav1">
                        <li class="active"><a href="index.html">Accommodation</a></li>
                        <li><a href="#">Activities</a></li>
                        <li><a href="#">Arrival Transfer</a></li>
                        <li><a href="#">Cruises</a></li>
                        <li><a href="#">Day Tours</a></li>
                        <li><a href="#">Departure Transfer</a></li>
                        <li><a href="#">Golf</a></li>
                        <li><a href="#">Ground Transport</a></li>
                        <li><a href="#">Packages</a></li>
                        <li><a href="#">Shocking Offers</a></li>
                        <li><a href="#">Spa</a></li>
                        <li><a href="#">Special Interest</a></li>
                        <li><a href="#">Water Transport</a></li>
                        <li><a href="#">Wedding & Honeymoon</a></li>
                    </ul>
                    <div class="clearfix"> </div>
                    <!-- script-for-menu -->
                    <script>
                    $("span.menu").click(function() {
                        $("ul.nav1").slideToggle(300, function() {
                            // Animation complete.
                        });
                    });
                    </script>
                    <!-- /script-for-menu -->
                </div>
                <div class="dropdown-grids">
                    <div class="dropdown-grids">
                        <div id="logoutContainer"><a href="#" id="logoutButton"><span>Logout</span></a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!--//header-->
    <div class="searchBar">
        <div class="kameha">
            <div class="container">
                <div class="col-md-12 col-md-offset-1">
                    <div class="reservation">
                        <div class="online_reservation">
                            <div class="b_room">
                                <div class="booking_room">
                                    <div class="reservation">
                                        <ul>
                                            <li class="span1_of_1 desti">
                                                <h5>Destination, zone or hotel name</h5>
                                                <div class="book_date">
                                                    <form>
                                                        <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                                                        <input type="text" placeholder="City, Area or Hotel Name" class="typeahead1 input-md form-control tt-input" required="">
                                                    </form>
                                                </div>
                                            </li>
                                            <li class="span1_of_1 left">
                                                <h5>Check In</h5>
                                                <div class="book_date">
                                                    <form>
                                                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                                        <input type="text" id="dt1" style="cursor: pointer;">
                                                    </form>
                                                </div>
                                            </li>
                                            <li class="span1_of_1 left">
                                                <h5>Check out</h5>
                                                <div class="book_date">
                                                    <form>
                                                        <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                                        <input type="text" id="dt2" style="cursor: pointer;">
                                                    </form>
                                                </div>
                                            </li>
                                            <li class="span1_of_3">
                                                <div class="date_btn">
                                                    <form>
                                                        <input type="submit" value="Search" />
                                                    </form>
                                                </div>
                                            </li>
                                            <div class="clearfix"></div>
                                        </ul>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- banner-bottom -->
    <div class="banner-bottom" id="overview">
        <!-- container -->
        <div class="container">
            <div class="faqs-top-grids">
                <!--single-page-->
                <div class="single-page">
                    <div class="col-md-4 single-gd-rt">
                        <div class="single-pg-hdr">
                            <h2><?php echo $valueName; ?></h2>
                            <?php
                            	$star = $valueClass[0];
								if(strpos($star,"1 Star") !== false)
								{
									echo '<span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
								}
								else if(strpos($star,"2 Star") !== false)
								{
									echo '<span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
								}
								else if(strpos($star,"3 Star") !== false)
								{
									echo '<span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
								}
								else if(strpos($star,"4 Star") !== false)
								{
									echo '<span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
								}
								else if(strpos($star,"5 Star") !== false)
								{
									echo '<span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
								}
                            ?>
                            <?php echo '<p>'.$valueAddress.' , '.$valueAddress3.' , '.$valueAddress4.' - '.$valueAddress5.' , '.$valuePostCode.'</p>'; ?>
                            <p align="justify">
                            	<?php
	                            	if(!empty($valueNoteTextOverview))
									{
										$overview = explode("OVERVIEW:",$valueNoteTextOverview);
										echo $overview[1];
									}
								?>
                            </p>
                            <p>Jump to: <a href="#overview">Overview</a>|<a href="#room">Room Choices</a>|<a href="#info">Hotel Information</a></p>
                        </div>
                    </div>
                    <div class="col-md-8 single-gd-lt">
                        <div class="flexslider">
                            <ul class="slides">
                                <li data-thumb="images/rafting.jpg">
                                    <img src="images/rafting.jpg" alt="" />
                                </li>
                                <li data-thumb="images/p2.jpg">
                                    <img src="images/p2.jpg" alt="" />
                                </li>
                                <li data-thumb="images/p3.jpg">
                                    <img src="images/p3.jpg" alt="" />
                                </li>
                                <li data-thumb="images/p4.jpg">
                                    <img src="images/p4.jpg" alt="" />
                                </li>
                                 <li data-thumb="images/rafting.jpg">
                                    <img src="images/rafting.jpg" alt="" />
                                </li>
                                 <li data-thumb="images/rafting.jpg">
                                    <img src="images/rafting.jpg" alt="" />
                                </li>
                                 <li data-thumb="images/rafting.jpg">
                                    <img src="images/rafting.jpg" alt="" />
                                </li>
                                 <li data-thumb="images/rafting.jpg">
                                    <img src="images/rafting.jpg" alt="" />
                                </li>
                                 <li data-thumb="images/rafting.jpg">
                                    <img src="images/rafting.jpg" alt="" />
                                </li>
                                 <li data-thumb="images/rafting.jpg">
                                    <img src="images/rafting.jpg" alt="" />
                                </li>
                                <li data-thumb="images/p4.jpg">
                                    <img src="images/p4.jpg" alt="" />
                                </li>
                                <li data-thumb="images/p4.jpg">
                                    <img src="images/p4.jpg" alt="" />
                                </li>
                                <li data-thumb="images/p4.jpg">
                                    <img src="images/p4.jpg" alt="" />
                                </li>
                            </ul>
                        </div>
                        <!-- FlexSlider -->
                        <script defer src="js/jquery.flexslider.js"></script>
                        <script>
                        // Can also be used with $(document).ready()
                        $(window).load(function() {
                            $('.flexslider').flexslider({
                                animation: "fade",
                                controlNav: "thumbnails"
                            });
                        });
                        </script>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!--//single-page-->
            </div>
            <!-- room choices -->
            <div class="banner-bottom-info" style="margin-top: 2em;">
                <h3>Room choices</h3>
            </div> 

            <div style="margin: 2em 0 0 0;">
                <div class="searchBar">
        <div class="kameha">
            <div class="container">
                <div class="col-md-12 col-md-offset-1">
                    <div class="reservation">
                        <div class="online_reservation">
                            <div class="b_room">
                                <div class="booking_room">
                                    <div class="reservation">
                                        <ul>
                                            <li class="span1_of_1">
                                                        <h5>Check in</h5>
                                                        <div class="book_date">
                                                            <form>
                                                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                                                <input type="text" id="dt3" style="cursor: pointer;">
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li class="span1_of_1 left">
                                                        <h5>Check out</h5>
                                                        <div class="book_date">
                                                            <form>
                                                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                                                <input type="text" id="dt4" style="cursor: pointer;">
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <li class="span1_of_1 left adult">
                                                        <h5>Adults (18+)</h5>
                                                        <!--start section_room-->
                                                        <div class="section_room">
                                                            <select class="form-control">
                                                                <option>1</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="span1_of_1 left h-child">
                                                        <h5>Children (0-17)</h5>
                                                        <!--start section_room-->
                                                        <div class="section_room">
                                                            <select class="form-control">
                                                                <option>1</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="span1_of_1 h-rooms">
                                                        <h5>Rooms</h5>
                                                        <!--start section_room-->
                                                        <div class="section_room">
                                                            <select class="form-control">
                                                                <option value="SG">Single</option>
                                                                <option value="DB">Double</option>
                                                                <option value="TW">Twin</option>
                                                                <option value-"">Triple</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                     <li class="span1_of_1 h-rooms">
                                                        <h5>Rooms</h5>
                                                        <!--start section_room-->
                                                        <div class="section_room">
                                                            <select class="form-control">
                                                                <option value="SG">Single</option>
                                                                <option value="DB">Double</option>
                                                                <option value="TW">Twin</option>
                                                                <option value-"">Triple</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                            <li class="span1_of_3">
                                                <div class="date_btn">
                                                    <form>
                                                        <input type="submit" value="Search" />
                                                    </form>
                                                </div>
                                            </li>
                                            <div class="clearfix"></div>
                                        </ul>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>

            <div class="c-rooms" id="room" style="margin: 0;">
            	<?php
            		$jumlahRoom = count($valueOpt);
            		for($k = 0; $k < $jumlahRoom; $k++)
            		{
            	?>
                <div class="p-table">
                    <div class="p-table-grids">
                        <div class="col-md-3 p-table-grid">
                            <div class="p-table-grad-heading">
                                <h6>Room type</h6>
                            </div>
                            <div class="p-right-img" style="background: url(images/rafting.jpg) no-repeat 0px 0px; /*buat ganti gambar, ganti URLnya aja*/
                                        background-size: cover;
                                        display: block;margin: 1em 1em 0 1em;">
                                <a href="#">  </a>
                            </div>
                            <div class="p-table-grid-info">
                                <div class="room-basic-info">
                                    <a href="#"><?php echo $valueDescription[$k]; ?></a>
                                    <h6><?php echo $valueComment[$k]; ?></h6>
                                    <p>Vestibulum ullamcorper(condimentum luctus)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 p-table-grid">
                            <div class="p-table-grad-heading">
                                <h6>Amenities</h6>
                            </div>
                            <div class="rate-features">
                                <ul>
                                	<?php
                                		if(!empty($valueAmenity))
                                		{
                                			echo '<li>'.$valueAmenity.'</li>';
                                		}
                                		if(!empty($valueAmenity1))
                                		{
                                			echo '<li>'.$valueAmenity1.'</li>';
                                		}
                                		if(!empty($valueAmenity2))
                                		{
                                			echo '<li>'.$valueAmenity2.'</li>';
                                		}
                                		if(!empty($valueAmenity3))
                                		{
                                			echo '<li>'.$valueAmenity3.'</li>';
                                		}
                                		if(!empty($valueAmenity4))
                                		{
                                			echo '<li>'.$valueAmenity4.'</li>';
                                		}
                                		if(!empty($valueAmenity5))
                                		{
                                			echo '<li>'.$valueAmenity5.'</li>';
                                		}
                                		if(!empty($valueAmenity6))
                                		{
                                			echo '<li>'.$valueAmenity6.'</li>';
                                		}
                                		if(!empty($valueAmenity7))
                                		{
                                			echo '<li>'.$valueAmenity7.'</li>';
                                		}
                                		if(!empty($valueAmenity8))
                                		{
                                			echo '<li>'.$valueAmenity8.'</li>';
                                		}
                                		if(!empty($valueAmenity9))
                                		{
                                			echo '<li>'.$valueAmenity9.'</li>';
                                		}
                                	?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 p-table-grid">
                            <div class="p-table-grad-heading">
                                <h6>Avg rate per night</h6>
                            </div>
                            <div class="avg-rate">
                                <h5>Recommended for you</h5>
                                <p>Price is now:</p>
                                <span class="p-offer"><?php echo $valueCurrency[$k].' '.$pisahSingleRateFix[$k]; ?></span>
                            </div>
                        </div>
                        <div class="col-md-3 p-table-grid">
                            <div class="p-table-grad-heading">
                                <h6>Book</h6>
                            </div>
                            <div class="book-button-column">
                                <a href="#">Book</a>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <?php
            	}
                ?>
            </div>
            <!-- hotel information -->
            <div id="info">
                <div class="banner-bottom-info" style="margin: 2em 0;">
                    <h3>More about <?php echo $valueName; ?></h3>
                </div>
                <div class="p-table">
                    <div class="p-table-grids">
                        <div class="col-md-6 p-table-grid">
                            <div class="p-table-grad-heading2">
                                <h6>Overview</h6>
                                 <?php
									if(!empty($valueNoteTextOverview))
									{
										$overview = explode("OVERVIEW:",$valueNoteTextOverview);
										echo '<p>'.$overview[1].'</p>';
									}
								?>
                                <h6>Group Policy</h6>
                                <?php
									if(!empty($valueNoteTextGrup))
									{
										$grup = explode("GROUP POLICY:",$valueNoteTextGrup);
										echo '<p>'.$grup[1].'</p>';
									}
								?>
                            </div>
                        </div>
                        <div class="col-md-6 p-table-grid">
                            <?php
                        		if(!empty($valueNoteTextChild))
								{
							?>
                            <div class="p-table-grad-heading2">
                                <h6>Child benefit</h6>
                                <div class="rate-features2">
                                    <ul>
                                    	<?php
                                    		$child = explode("CHILD POLICY:",$valueNoteTextChild);
											$childLi = explode("·	",$child[1]);
											$jumlah = count($childLi);
											for($i=1;$i<$jumlah;$i++)
											{
												echo '<li>'.$childLi[$i].'</li>';
											}
                                    	?>
                                    </ul>
                                </div>
                            </div>
                            <?php
                            	}

                            	if(!empty($valueNoteTextHoneymoon))
								{
                            ?>
                            <div class="p-table-grad-heading2">
                                <h6>Honeymoon Policy</h6>
                                <div class="rate-features2">
                                    <ul>
                                        <?php
											$Honeymoon = explode("HONEYMOON BENEFIT:",$valueNoteTextHoneymoon);
											$HoneymoonLi = explode("·	", $Honeymoon[1]);
											$jumlah = count($HoneymoonLi);
											for($i=1;$i<$jumlah;$i++)
											{
												echo '<li>'.$HoneymoonLi[$i].'</li>';
											}
										?>
                                    </ul>
                                </div>
                            </div>
                           	<?php
                           		}

                           		if(!empty($valueNoteTextCancellation))
								{
                            ?>
                            <div class="p-table-grad-heading2">
                                <h6>Cancellation Policy</h6>
                                <div class="rate-features2">
                                    <ul>
                                        <?php
											$cancel = explode("Cancellation Policy:",$valueNoteTextCancellation);
											$cancelLi = explode("·	", $cancel[1]);
											$jumlah = count($cancelLi);
											for($i=1;$i<$jumlah;$i++)
											{
												echo '<li>'.$cancelLi[$i].'</li>';
											}
										?>
                                    </ul>
                                </div>
                            </div>
                           	<?php
                           		}
                           	?>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //container -->
    </div>
    <!-- //banner-bottom -->
    <!-- footer -->
    <div class="footer">
        <!-- container -->
        <div class="container">
            <div class="footer-top-grids">
                <div class="footer-grids">
                    <div class="col-md-4 footer-grid">
                        <h4>Our Products</h4>
                        <ul>
                            <li><a href="#">Activities</a></li>
                            <li><a href="#">Arrival Transfer</a></li>
                            <li><a href="#">Cruises</a></li>
                            <li><a href="#">Day Tours</a></li>
                            <li><a href="#">Departure Transfer</a></li>
                            <li><a href="#">Golf</a></li>
                            <li><a href="#">Ground Transport</a></li>
                            <li><a href="#">Packages</a></li>
                            <li><a href="#">Shocking Offers</a></li>
                            <li><a href="#">Spa</a></li>
                            <li><a href="#">Special Interest</a></li>
                            <li><a href="#">Water Transport</a></li>
                            <li><a href="#">Wedding & Honeymoon</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 footer-grid">
                        <h4>Administration</h4>
                        <ul>
                            <li><a href="#">Media Library</a></li>
                            <li><a href="#">Library</a></li>
                            <li><a href="#">Product Tariff</a></li>
                            <li><a href="#">Privacy </a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 footer-grid">
                        <h4>Customer Support</h4>
                        <ul>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                        <h4 style="margin-top: 20px;">Follow Us</h4>
                        <div class="social">
                            <ul>
                                <li><a href="#" class="facebook"> </a></li>
                                <li><a href="#" class="facebook twitter"> </a></li>
                                <li><a href="#" class="facebook chrome"> </a></li>
                                <li><a href="#" class="facebook dribbble"> </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <!-- news-letter -->
                <div class="news-letter">
                    <div class="news-letter-grids">
                        <div class="col-md-4 news-letter-grid">
                            <p>Toll Free No : <span>+62 21 5695 8585</span></p>
                        </div>
                        <div class="col-md-4 news-letter-grid">
                            <p class="mail">Email : <a href="mailto:info@example.com">info@panorama-destination.com</a></p>
                        </div>
                        <div class="col-md-4 news-letter-grid">
                            <form>
                                <input type="text" value="Email" required="">
                                <input type="submit" value="Subscribe">
                            </form>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <!-- //news-letter -->
            </div>
        </div>
        <!-- //container -->
    </div>
    <!-- //footer -->
    <div class="footer-bottom-grids">
        <!-- container -->
        <div class="container">
            <div class="copyright">
                <p>Copyright © 2017 Panorama Destination, Tbk. All rights reserved.</p>
            </div>
        </div>
    </div>
    <script defer src="js/jquery.flexslider.js"></script>
    <script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
    <script src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true // 100% fit in a container
        });
    });
    </script>
    <!--pop-up-->
    <script src="js/menu_jquery.js"></script>
    <!--//pop-up-->
    <!--strat-date-piker-->
    <script>
        jQuery(function() {
            jQuery("#dt1, #dt3").datepicker({
                minDate: 0,
                dateFormat: "dd-M-yy",
                onSelect: function(date) {
	                //alert("none"); 
	                var date1 = jQuery('#dt1, #dt3').datepicker('getDate');
	                var date = new Date(Date.parse(date1));
	                date.setDate(date.getDate() + 1);
	                var newDate = date.toDateString();
	                newDate = new Date(Date.parse(newDate));
	                jQuery('#dt2, #dt4').datepicker("option", "minDate", newDate);
            	}
			});
            jQuery("#dt2, #dt4").datepicker({
                minDate: '+1d',
                dateFormat: "dd-M-yy"
            });
			$("#dt1, #dt3").datepicker('setDate', '+0');
           	$("#dt2, #dt4").datepicker('setDate', '+1');
        });
    </script>
    <!--End-date-piker-->

    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	  <script>
	  $(window).load(function() {
	   $(".loading").fadeOut("slow");
	  });
	  </script>
    
</body>

</html>