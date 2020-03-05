<?php
	error_reporting(0);
	ini_set('display_errors',0);
	
	$username = "TESTWX";
	$password = "TESTWX";
	//$supplierCode = $_POST['destination'];
	$supplierCode = 'AAPDPS';
	$loc = substr($supplierCode, 3, 3);
	$supplierCodes = '???'.$loc;
	
	$date1 = $_POST['txtCheckIn'];
	$date2 = $_POST['txtCheckOut'];
	$adult = $_POST['txtAdult'];
	$child = $_POST['txtChild'];
	
	$date1 = '2017-08-01';
	$date2 = '2017-08-03';

	$adult = '2';
	$child = '0';

	$dateFrom = date('Y-m-d', strtotime($date1));
	$dateTo = date('Y-m-d', strtotime($date2));

	$selisih = strtotime($dateTo) - strtotime($dateFrom);
	$SCUqty = $selisih/(60*60*24);

	$xml_request = '<?xml version="1.0"?>'
	.'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
	.'<Request CompressReply="Y">'
	.'<SupplierInfoRequest>'
	.'<AgentID>'.$username.'</AgentID>'
	.'<Password>'.$password.'</Password>'
	.'<SupplierCode>'.$supplierCodes.'</SupplierCode>'
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
		CURLOPT_POSTFIELDS => $xml_request,						// POST XML Request
		CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),	// Sent HEADER XML
		CURLOPT_URL => $url
		);

	//open connection
	$ch = curl_init();
	curl_setopt_array($ch, $option);
	
	$data = curl_exec($ch);

    $uncompressed = gzdecode($data);


	$xml = new DOMDocument();
	$xml -> loadXML($uncompressed);


	$searchNode = $xml->getElementsByTagName("SupplierInfoReply");

	$jumlahSupplier = ($xml->getElementsByTagName("SupplierId")->length);

	
	
	foreach( $searchNode as $searchNode)
	{
		for($i=0; $i<$jumlahSupplier; $i++)
		{
			$xmlSupplierId[$i] = $searchNode->getElementsByTagName("SupplierId");
			$valueSupplierId[$i] = $xmlSupplierId[$i]->item($i)->nodeValue;
			$xmlSupplierName[$i] = $searchNode->getElementsByTagName("Name");
			$valueSupplierName[$i] = $xmlSupplierName[$i]->item($i)->nodeValue;
			$xmlSupplierCode[$i] = $searchNode->getElementsByTagName("SupplierCode");
			$valueSupplierCode[$i] = $xmlSupplierCode[$i]->item($i)->nodeValue;
			$xmlSupplierAnalysis2[$i] = $searchNode->getElementsByTagName("SupplierAnalysis2");
			$valueSupplierAnalysis2[$i] = $xmlSupplierAnalysis2[$i]->item($i)->nodeValue;
			$xmlAddress1[$i] = $searchNode->getElementsByTagName("Address1");
			$valueAddress1[$i] = $xmlAddress1[$i]->item($i)->nodeValue;
			$xmlAddress2[$i] = $searchNode->getElementsByTagName("Address2");
			$valueAddress2[$i] = $xmlAddress2[$i]->item($i)->nodeValue;
			$xmlAddress3[$i] = $searchNode->getElementsByTagName("Address3");
			$valueAddress3[$i] = $xmlAddress3[$i]->item($i)->nodeValue;
			$xmlAddress4[$i] = $searchNode->getElementsByTagName("Address4");
			$valueAddress4[$i] = $xmlAddress4[$i]->item($i)->nodeValue;
			$xmlAddress5[$i] = $searchNode->getElementsByTagName("Address5");
			$valueAddress5[$i] = $xmlAddress5[$i]->item($i)->nodeValue;

			$supplier = array($valueSupplierID[$i], $valueSupplierName[$i], $valueSupplierCode[$i], $valueSupplierAnalysis2[$i], $valueAddress1[$i], $valueAddress2[$i], $valueAddress3[$i], $valueAddress4[$i], $valueAddress5[$i]);
		}
	}

	$xml_requestEachSupplier = '<?xml version="1.0"?>'
	.'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
	.'<Request CompressReply="Y">'
	.'<SupplierInfoRequest>'
	.'<AgentID>'.$username.'</AgentID>'
	.'<Password>'.$password.'</Password>'
	.'<SupplierCode>'.$supplierCode.'</SupplierCode>'
	.'</SupplierInfoRequest>'
	.'</Request>';

	$urlss = "http://59.153.23.26:8080/iComLive/servlet/conn";
	
	$option = array(
		CURLOPT_RETURNTRANSFER => TRUE,							// return web page
		CURLOPT_HEADER => FALSE,								// don't return header
		CURLOPT_POSTFIELDS => $xml_requestEachSupplier,			// POST XML Request
		CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),	// Sent HEADER XML
		CURLOPT_URL => $urlss
		);

	//open connection
	$chSupplier = curl_init();
	curl_setopt_array($chSupplier, $option);
	
	$dataSupplier = curl_exec($chSupplier);

    $uncompressedSupplier = gzdecode($dataSupplier);


	$xmlSupplier = new DOMDocument();
	$xmlSupplier -> loadXML($uncompressedSupplier);


	$searchNodeSupplier = $xmlSupplier->getElementsByTagName("SupplierInfoReply");
	
	foreach( $searchNodeSupplier as $searchNodeSupplier)
	{
		$xmlSupplierIdEach = $searchNodeSupplier->getElementsByTagName("SupplierId");
		$valueSupplierIdEach = $xmlSupplierIdEach->item(0)->nodeValue;

		$xmlSupplierNameEach = $searchNodeSupplier->getElementsByTagName("Name");
		$valueSupplierNameEach = $xmlSupplierNameEach->item(0)->nodeValue;
		
		$xmlSupplierCodeEach = $searchNodeSupplier->getElementsByTagName("SupplierCode");
		$valueSupplierCodeEach = $xmlSupplierCodeEach->item(0)->nodeValue;
		
		$xmlSupplierAnalysis2Each = $searchNodeSupplier->getElementsByTagName("SupplierAnalysis2");
		$valueSupplierAnalysis2Each = $xmlSupplierAnalysis2Each->item(0)->nodeValue;
		
		$xmlAddress1Each = $searchNodeSupplier->getElementsByTagName("Address1");
		$valueAddress1Each = $xmlAddress1Each->item(0)->nodeValue;
		
		$xmlAddress2Each = $searchNodeSupplier->getElementsByTagName("Address2");
		$valueAddress2Each = $xmlAddress2Each->item(0)->nodeValue;
		
		$xmlAddress3Each = $searchNodeSupplier->getElementsByTagName("Address3");
		$valueAddress3Each = $xmlAddress3Each->item(0)->nodeValue;
		
		$xmlAddress4Each = $searchNodeSupplier->getElementsByTagName("Address4");
		$valueAddress4Each = $xmlAddress4Each->item(0)->nodeValue;
		
		$xmlAddress5Each = $searchNodeSupplier->getElementsByTagName("Address5");
		$valueAddress5Each = $xmlAddress5Each->item(0)->nodeValue;

		$supplierEachArray = array($valueSupplierIdEach, $valueSupplierNameEach, $valueSupplierCodeEach, $valueSupplierAnalysis2Each, $valueAddress1Each, $valueAddress2Each, $valueAddress3Each, $valueAddress4Each, $valueAddress5Each);
	}

	// SENT REQUEST PRODUCT
	$opt = $loc.'AC????????????';
	/*if(isset($dateFrom))
	{
		$dateFrom = $_POST['txtCheckIn'];
	}
	else
	{
		$dateFrom = date('Y-m-d');
	}*/
	$xml_requestOption = '<?xml version="1.0"?>'
	.'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
	.'<Request CompressReply="Y">'
	.'<OptionInfoRequest>'
	.'<AgentID>'.$username.'</AgentID>'
	.'<Password>'.$password.'</Password>'
	.'<Opt>'.$opt.'</Opt>'
	.'<Info>GMFTD</Info>'
	.'<DateFrom>'.$dateFrom.'</DateFrom>'
	.'<SCUqty>'.$SCUqty.'</SCUqty>'
	.'<RoomConfigs><RoomConfig>'
	.'<Adults>'.$adult.'</Adults>'
	.'<RoomType>SG</RoomType>'
	.'</RoomConfig></RoomConfigs>'
	.'</OptionInfoRequest>'
	.'</Request>';

	$urls = "http://59.153.23.26:8080/iComLive/servlet/conn";
	
	$option = array(
		CURLOPT_RETURNTRANSFER => TRUE,							// return web page
		CURLOPT_HEADER => FALSE,								// don't return header
		CURLOPT_POSTFIELDS => $xml_requestOption,						// POST XML Request
		CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),	// Sent HEADER XML
		CURLOPT_URL => $urls
		);

	//open connection
	$chs = curl_init();
	curl_setopt_array($chs, $option);
	
	$datas = curl_exec($chs);

    $uncompresseds = gzdecode($datas);


	$xmls = new DOMDocument();
	$xmls -> loadXML($uncompresseds);

	//echo $xml->saveXML();

	$searchNodes = $xmls->getElementsByTagName("OptionInfoReply");
	$jumlahOption = ($xmls->getElementsByTagName("SupplierId")->length);

	foreach( $searchNodes AS $searchNodes)
	{
		for($i=0; $i<$jumlahOption; $i++)
		{
			$xmlOptionSupplierId[$i] = $searchNodes->getElementsByTagName("SupplierId");
			$valueOptionSupplierId[$i] = $xmlOptionSupplierId[$i]->item($i)->nodeValue;

			$xmlClass[$i] = $searchNodes->getElementsByTagName("ClassDescription");
			$valueClass[$i] = $xmlClass[$i]->item($i)->nodeValue;

			$xmlSingleRate[$i] = $searchNodes->getElementsByTagName("SingleRate");
			$valueSingleRate[$i] = $xmlSingleRate[$i]->item($i)->nodeValue;

			$xmlCurrency[$i] = $searchNodes->getElementsByTagName("Currency");
			$valueCurrency[$i] = $xmlCurrency[$i]->item($i)->nodeValue;

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
			$OptionArray = array($valueOptionSupplierId[$i], $valueClass[$i], $valueCurrency[$i], $pisahSingleRateFix[$i]);
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
    <!-- fonts -->

    <!-- //fonts -->
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
                                    <a href="member.php">
                                        <div class="center">
                                            Hello, <?php echo $_SESSION['name']; ?></div>
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
                        <li class="active"><a href="index.php">Accommodation</a></li>
                        <li><a href="indexAV.php">Activities</a></li>
                        <li><a href="indexTA.php">Arrival Transfer</a></li>
                        <li><a href="#">Cruises</a></li>
                        <li><a href="indexPT.php">Day Tours</a></li>
                        <li><a href="indexTD.php">Departure Transfer</a></li>
                        <li><a href="#">Golf</a></li>
                        <li><a href="indexTP.php">Ground Transport</a></li>
                        <li><a href="indexPK.php">Packages</a></li>
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
    <div class="banner-bottom">
        <!-- container -->
        <div class="container">
            <div class="faqs-top-grids">
                <div class="product-grids">
                    <div class="col-md-3 product-left">
                        <div class="h-class">
                        <?php
                        	$jumlahData = count($valueSupplierName);
                    		
                    		for($i = 0; $i < $jumlahData; $i++)
                    		{
                    			if($valueSupplierAnalysis2[$i] == 'AC')
                    			{
                    				$supplierID = $valueSupplierId[$i];
                                    $index = array_search($supplierID, $valueOptionSupplierId);
                                    if(!empty($valueSingleRate[$index]) && !empty($index)){
                       					$star = $valueClass[$index];
                        				for($s=0; $s<count($star); $s++)
                        				{
			                        		if(strpos($star,"1 Star") !== false)
											{
												$oneStar = $oneStar+1;
											}
											else if(strpos($star,"2 Star") !== false)
											{
												$twoStar = $twoStar+1;
											}
											else if(strpos($star,"3 Star") !== false)
											{
												$threeStar = $threeStar+1;
											}
											else if(strpos($star,"4 Star") !== false)
											{
												$fourStar = $fourStar+1;
											}
											else if(strpos($star,"5 Star") !== false)
											{
												$fiveStar = $fiveStar+1;
											}
                        				}
                        			}
                        		}
                        	}
                        ?>
                            <h5>Hotel Class</h5>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox" name="star5">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="starTextLabel">5 Stars 
	                                    <?php
	                                    	if($fiveStar > 0)
	                                    	{
	                                    		echo '('.$fiveStar.')';
	                                    	}
	                                    	else
	                                    	{
	                                    		echo "(0)";
	                                    	}
	                                    ?>
                                    </span>
                                </label>
                            </div>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox" name="4star">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="starTextLabel">4 Stars 
                                    <?php
                                    	if($fourStar > 0)
                                    	{
                                    		echo '('.$fourStar.')';
                                    	}
                                    	else{
                                    		echo "(0)";
                                    	}
                                    ?>
                                    </span>
                                </label>
                            </div>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox" name="3star">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="starTextLabel">3 Stars
                                    <?php
                                    	if($threeStar > 0)
                                    	{
                                    		echo '('.$threeStar.')';
                                    	}
                                    	else{
                                    		echo "(0)";
                                    	}
                                    ?>
                                    </span>
                                </label>
                            </div>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox" name="2star">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="starTextLabel">2 Stars
                                    <?php
                                    	if($twoStar > 0)
                                    	{
                                    		echo '('.$twoStar.')';
                                    	}
                                    	else{
                                    		echo "(0)";
                                    	}
                                    ?>
                                    </span>
                                </label>
                            </div>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox" name="1star">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="starTextLabel">1 Stars
                                    <?php
                                    	if($oneStar > 0)
                                    	{
                                    		echo '('.$oneStar.')';
                                    	}
                                    	else{
                                    		echo "(0)";
                                    	}
                                    ?>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <?php
                        	$jumlahData = count($valueSupplierName);
                    		
                    		for($i = 0; $i < $jumlahData; $i++)
                    		{
                    			if($valueSupplierAnalysis2[$i] == 'AC')
                    			{
                    				$supplierID = $valueSupplierId[$i];
                                    $index = array_search($supplierID, $valueOptionSupplierId);
                                    if(!empty($valueSingleRate[$index]) && !empty($index)){
                       					$rates = $valueSingleRate[$index];
                        				for($s=0; $s<count($rates); $s++)
                        				{
			                        		if($rates < "10000")
											{
												$oneHundred = $oneHundred+1;
											}
											else if($rates > "10000" AND $rates < "20000")
											{
												$twoHundred = $twoHundred+1;
											}
											else if($rates > "20000" AND $rates < "30000")
											{
												$threeHundred = $threeHundred+1;
											}
											else if($rates > "30000" AND $rates < "40000")
											{
												$fourHundred = $fourHundred+1;
											}
											else if($rates > "40000")
											{
												$fiveHundred = $fiveHundred+1;
											}
                        				}
                        			}
                        		}
                        	}
                        ?>
                        <div class="h-class p-day">
                            <h5>Price per day</h5>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox">
                                    <span class="p-day-grid">Less than $100
                                    <?php
                                    	if($oneHundred > 0)
                                    	{
                                    		echo '('.$oneHundred.')';
                                    	}
                                    	else{
                                    		echo "(0)";
                                    	}
                                    ?>
                                    </span>
                                </label>
                            </div>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox">
                                    <span class="p-day-grid">$100 to $200
                                    <?php
                                    	if($twoHundred > 0)
                                    	{
                                    		echo '('.$twoHundred.')';
                                    	}
                                    	else{
                                    		echo "(0)";
                                    	}
                                    ?>
                                    </span>
                                </label>
                            </div>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox">
                                    <span class="p-day-grid">$300 to $300
                                    <?php
                                    	if($threeHundred > 0)
                                    	{
                                    		echo '('.$threeHundred.')';
                                    	}
                                    	else{
                                    		echo "(0)";
                                    	}
                                    ?>
                                    </span>
                                </label>
                            </div>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox">
                                    <span class="p-day-grid">$300 to $400
                                    <?php
                                    	if($fourHundred > 0)
                                    	{
                                    		echo '('.$fourHundred.')';
                                    	}
                                    	else{
                                    		echo "(0)";
                                    	}
                                    ?>
                                    </span>
                                </label>
                            </div>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox">
                                    <span class="p-day-grid">More than $500
                                    <?php
                                    	if($fiveHundred > 0)
                                    	{
                                    		echo '('.$fiveHundred.')';
                                    	}
                                    	else{
                                    		echo "(0)";
                                    	}
                                    ?>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 product-right">
                   	<!-- SUPPLIER EACH -->
                   		<?php
                   				$jumlahDataEach = count($valueOptionSupplierId);
                   				for($c = 0; $c < $jumlahDataEach; $c++)
                    			{
                    				$supplierIDeach = $valueSupplierIdEach;
                                    $indexEach = array_search($supplierIDeach, $valueOptionSupplierId);
                                }
                                    if(!empty($valueSingleRate[$indexEach]) && !empty($indexEach)){
                                		//echo 'SupplierID: '.$valueSupplierIdEach.'<br />Option SupplierId: '.$valueOptionSupplierId[$indexEach];
                    	?>
                   		<div class="product-right-grids" id="q">
                            <div class="product-right-top">
                                <div class="p-left">
                                    <div class="p-right-img" style="background: url(images/rafting.jpg) no-repeat 0px 0px; /*buat ganti gambar, ganti URLnya aja*/
                                        background-size: cover;
										display: block;">
                                        <a href="p-single.html"> </a>
                                    </div>
                                </div>
                                <div class="p-right">
                                    <div class="col-md-6 p-right-left">
                                        <a href="detailRoom.php?key=<?php echo $valueSupplierCodeEach;?>"><?php echo $valueSupplierNameEach; ?></a>
                                        <div class="p-right-price">
                                        	<?php
                                        		/*
                                        		echo 'Supplier id :'.$valueSupplierIdEach.'<br />';
                                        		echo 'loc ID :'.$index;
                                        		echo '<br />=============================================<br />';
                                        		echo 'Supplier Option ID: '.$valueOptionSupplierId[$index];
                                        		echo '<br />';
                                        		*/

												$star = $valueClass[$indexEach];
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
                                        </div>
                                        <p><?php echo $valueAddress3Each; ?></p>
                                    </div>
                                    <div class="col-md-6 p-right-right">
                                        <p><i class="fa fa-info-circle" aria-hidden="true"></i> Nightly rates as below as</p>
                                        <span class="p-offer"><?php echo $valueCurrency[$indexEach].' '.$pisahSingleRateFix[$indexEach]; ?></span>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>

                   	<!-- END SUPPLIER EACH -->

                   	<!-- Related -->
                    	<?php
                    		
                    	}

                    		$jumlahData = count($valueSupplierName);
                    		
                    		for($i = 0; $i < $jumlahData; $i++)
                    		{
                    			if($valueSupplierAnalysis2[$i] == 'AC')
                    			{
                    				$supplierID = $valueSupplierId[$i];
                                    $index = array_search($supplierID, $valueOptionSupplierId);
                                    if(!empty($valueSingleRate[$index]) && !empty($index)){
                    	?>
                        <div class="product-right-grids" id="q">
                            <div class="product-right-top">
                                <div class="p-left">
                                    <div class="p-right-img" style="background: url(images/rafting.jpg) no-repeat 0px 0px; /*buat ganti gambar, ganti URLnya aja*/
                                        background-size: cover;
										display: block;">
                                        <a href="p-single.html"> </a>
                                    </div>
                                </div>
                                <div class="p-right">
                                    <div class="col-md-6 p-right-left">
                                        <a href="detailRoom.php?key=<?php echo $valueSupplierCode[$i];?>"><?php echo $valueSupplierName[$i]; ?></a>
                                        <div class="p-right-price">
                                        	<?php
                                        		/*
                                        		echo 'Supplier id :'.$valueSupplierId[$i].'<br />';
                                        		echo 'loc ID :'.$index;
                                        		echo '<br />=============================================<br />';
                                        		echo 'Supplier Option ID: '.$valueOptionSupplierId[$index];
                                        		echo '<br />';
                                        		*/

												$star = $valueClass[$index];
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
                                        </div>
                                        <p><?php echo $valueAddress3[$i]; ?></p>
                                    </div>
                                    <div class="col-md-6 p-right-right">
                                        <p><i class="fa fa-info-circle" aria-hidden="true"></i> Nightly rates as below as</p>
                                        <span class="p-offer"><?php echo $valueCurrency[$index].' '.$pisahSingleRateFix[$index]; ?></span>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                        <?php
                        		}
                        	}
                        }
                        ?>
                        <!-- END RELATED -->
                        <!-- PAGINATION -->
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
        <!-- //container -->
    </div>
    <!-- //banner-bottom -->
    <!-- footer -->
    <?php include("footer.php"); ?>
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
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script>
	  	$(window).load(function() {
	   		$(".loading").fadeOut("slow");
	  	});
	</script>
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
            jQuery("#dt1").datepicker({
                minDate: 0,
                dateFormat: "dd-M-yy",
                onSelect: function(date) {
	                //alert("none"); 
	                var date1 = jQuery('#dt1').datepicker('getDate');
	                var date = new Date(Date.parse(date1));
	                date.setDate(date.getDate() + 1);
	                var newDate = date.toDateString();
	                newDate = new Date(Date.parse(newDate));
	                jQuery('#dt2').datepicker("option", "minDate", newDate);
            	}
			});
            jQuery("#dt2").datepicker({
                minDate: '+1d',
                dateFormat: "dd-M-yy"
            });
			$("#dt1").datepicker('setDate', '+0');
           	$("#dt2").datepicker('setDate', '+1');
        });
    </script>
    <!--End-date-piker-->
</body>

</html>