<?php
	session_start();
	error_reporting(1);
	ini_set('display_errors',1); 
	include("module/function.php");
	if(empty($_SESSION['name']))
    {
        header("location:login.php");
    }
    else
    {
    	if($_SERVER['REQUEST_METHOD'] == "POST")
    	{
		// ------------------------------------------------------------------------ If no form filled --------------------------------------------------------------
			$username = $_SESSION['username'];
			$password = $_SESSION['password'];
			$loc = $_SESSION['loc'];
			$destination = $_POST['destination'];

			$checkIn = $_POST['txtCheckIn'];
			$checkOut = $_POST['txtCheckOut'];
			$adult = $_POST['txtAdult'];
			$children = $_POST['txtChild'];
			$checkInFix = date('Y-m-d', strtotime($checkIn));
			$checkOutFix = date('Y-m-d', strtotime($checkOut));
			$dateFrom = $checkInFix;
			$selisih = strtotime($checkOutFix) - strtotime($checkInFix);

			$supplierCode = substr($destination,3,3);
			//$opt = "DPSACAAPDPS??????";
			$opt = '???TA'.$destination.'??????';
			$code = substr($opt, 5, 6);//supplier code
			$service = substr($opt, 11, 6);//option code
			$pax = $adult+$children;

			//echo 'username: '.$username.'<br />password: '.$password.'<br />destination: '.$destination.'<br />dateFrom: '.$dateFrom.'<br />date to: '.$dateTo.'<br />room: '.$rooms.'<br />Children: '.$children.'<br />Adult: '.$adults.'<br />SCU: '.$interval.'<br />locCOde: '.$locCOde.'<br />Code: '.$code.'<br />Address: '.$address.'<br />service: '.$service.'';

			$xml_request = '<?xml version="1.0"?>'
			.'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
			.'<Request CompressReply="Y">'
			.'<OptionInfoRequest>'
			.'<AgentID>'.$username.'</AgentID>'
			.'<Password>'.$password.'</Password>'
			.'<Opt>'.$opt.'</Opt>'
			.'<Info>GMFTDS</Info>'
			.'<DateFrom>'.$dateFrom.'</DateFrom>'
			.'<RoomConfigs><RoomConfig>'
			.'<Adults>'.$adult.'</Adults>'
			.'<Children>'.$children.'</Children>'
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
				CURLOPT_URL => $urls
				);

			//open connection
			$ch = curl_init();
			curl_setopt_array($ch, $option);
			
			$data = curl_exec($ch);

		    $uncompressed = gzdecode($data);


			$xml = simplexml_load_string($uncompressed);
	        $optionProduct = $xml->OptionInfoReply;
	        $optXml = $xml->xpath("//Opt");

			$xml_requestPrices = '<?xml version="1.0"?>'
			.'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
			.'<Request CompressReply="Y">'
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

		    $uncompresseds = gzdecode($datas);


			$xmls = simplexml_load_string($uncompresseds);
	        $option = $xmls->SupplierInfoReply->Suppliers;
	        $as = $xmls->xpath("//SupplierCode");
	    }
	    else
	    {
	    	$username = $_SESSION['username'];
			$password = $_SESSION['password'];
			$loc = $_SESSION['loc'];
			$destination = $_POST['destination'];

			$checkIn = $_POST['txtCheckIn'];
			$checkOut = $_POST['txtCheckOut'];
			$adult = $_POST['txtAdult'];
			$children = $_POST['txtChild'];
			$checkInFix = date('Y-m-d', strtotime($checkIn));
			$checkOutFix = date('Y-m-d', strtotime($checkOut));
			$dateFrom = $checkInFix;
			$selisih = strtotime($checkOutFix) - strtotime($checkInFix);

			$supplierCode = substr($destination,3,3);
			//$opt = "DPSACAAPDPS??????";
			$opt = '???TA'.$destination.'??????';
			$code = substr($opt, 5, 6);//supplier code
			$service = substr($opt, 11, 6);//option code
			$pax = $adult+$children;

			//echo 'username: '.$username.'<br />password: '.$password.'<br />destination: '.$destination.'<br />dateFrom: '.$dateFrom.'<br />date to: '.$dateTo.'<br />room: '.$rooms.'<br />Children: '.$children.'<br />Adult: '.$adults.'<br />SCU: '.$interval.'<br />locCOde: '.$locCOde.'<br />Code: '.$code.'<br />Address: '.$address.'<br />service: '.$service.'';

			$xml_request = '<?xml version="1.0"?>'
			.'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
			.'<Request CompressReply="Y">'
			.'<OptionInfoRequest>'
			.'<AgentID>'.$username.'</AgentID>'
			.'<Password>'.$password.'</Password>'
			.'<Opt>'.$opt.'</Opt>'
			.'<Info>GMFTDS</Info>'
			.'<DateFrom>'.$dateFrom.'</DateFrom>'
			.'<RoomConfigs><RoomConfig>'
			.'<Adults>'.$adult.'</Adults>'
			.'<Children>'.$children.'</Children>'
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
				CURLOPT_URL => $urls
				);

			//open connection
			$ch = curl_init();
			curl_setopt_array($ch, $option);
			
			$data = curl_exec($ch);

		    $uncompressed = gzdecode($data);

			$xml = simplexml_load_string($uncompressed);
	        $optionProduct = $xml->OptionInfoReply;
	        $optXml = $xml->xpath("//Opt");
			
			

			$xml_requestPrices = '<?xml version="1.0"?>'
			.'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
			.'<Request CompressReply="Y">'
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

		    $uncompresseds = gzdecode($datas);


			$xmls = simplexml_load_string($uncompresseds);
	        $option = $xmls->SupplierInfoReply->Suppliers;
	        $as = $xmls->xpath("//SupplierCode");
	    }
	} // END SESSION

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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
    <!-- <link type="text/css" rel="stylesheet" href="css/JFFormStyle-1.css" /> -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <!-- js -->
    <script src="js/modernizr.custom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- //js -->
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

  		/* jwpopup box style */
		.jwpopup {
		    display: none;
		    position: fixed;
		    z-index: 1;
		    padding-top: 110px;
		    left: 0;
		    top: 0;
		    width: 100%;
		    height: 100%;
		    overflow: auto;
		    background-color: rgb(0,0,0);
		    background-color: rgba(0,0,0,0.7);
		}
		.jwpopup-content {
		    position: relative;
		    background-color: #fefefe;
		    margin: auto;
		    padding: 0;
		    max-width: 500px;
		    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
		    -webkit-animation-name: animatetop;
		    -webkit-animation-duration: 0.4s;
		    animation-name: animatetop;
		    animation-duration: 0.4s
		}

		.jwpopup-head {
			font-size: 11px;
		    padding: 1px 16px;
		    color: white;
		    background: #006faa; /* For browsers that do not support gradients */
		    background: -webkit-linear-gradient(#006faa, #002c44); /* For Safari 5.1 to 6.0 */
		    background: -o-linear-gradient(#006faa, #002c44); /* For Opera 11.1 to 12.0 */
		    background: -moz-linear-gradient(#006faa, #002c44); /* For Firefox 3.6 to 15 */
		    background: linear-gradient(#006faa, #002c44); /* Standard syntax */
		}
		.jwpopup-main {padding: 5px 16px;}
		.jwpopup-foot {
			font-size: 12px;
		    padding: .5px 16px;
		    color: #ffffff;
		    background: #006faa; /* For browsers that do not support gradients */
		    background: -webkit-linear-gradient(#006faa, #002c44); /* For Safari 5.1 to 6.0 */
		    background: -o-linear-gradient(#006faa, #002c44); /* For Opera 11.1 to 12.0 */
		    background: -moz-linear-gradient(#006faa, #002c44); /* For Firefox 3.6 to 15 */
		    background: linear-gradient(#006faa, #002c44); /* Standard syntax */
		}

		/* tambahkan efek animasi */
		@-webkit-keyframes animatetop {
		    from {top:-300px; opacity:0}
		    to {top:0; opacity:1}
		}

		@keyframes animatetop {
		    from {top:-300px; opacity:0}
		    to {top:0; opacity:1}
		}

		/* style untuk tombol close */
		.close {
			margin-top: 7px;
		    color: white;
		    float: right;
		    font-size: 28px;
		    font-weight: bold;
		}
		.close:hover, .close:focus {
		    color: #999999;
		    text-decoration: none;
		    cursor: pointer;
		}
  	</style>
</head>

<body>
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
                        <div id="logoutContainer"><a href="logout.php"><span>Logout</span></a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!--//header-->
    <!-- banner-bottom -->
    <div class="banner-bottom" id="overview">
        <!-- container -->
        <div class="container">
            <div class="faqs-top-grids">
                <!--single-page-->
                <div class="single-page">
                    <div class="col-md-4 single-gd-rt">
                        <div class="single-pg-hdr">
                            <h2><?php echo $option->Supplier->Name; ?></h2>
                            <?php echo '<p>'.$option->Supplier->Address1.', '.$option->Supplier->Address2.', '.$option->Supplier->Address3.', '.$option->Supplier->Address4.$option->Supplier->Address5.', '.$option->Supplier->PostCode.'</p>'; ?>
                            <p align="justify">
                            	<?php
                            		
								?>
                            </p>
                            <p><a href="factsheet/factsheetAC.php?opt=<?php echo $opt;?>">Download</a></p>
                        </div>
                    </div><!-- 
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
                    </div>FlexSlider -->
                    <div class="clearfix"></div>
                </div>
                <!--//single-page-->
            </div>
            <!-- room choices -->
            <div class="banner-bottom-info" style="margin-top: 2em;">
                <h3>Transport choices</h3>
            </div> 
            <!--
            <div style="margin: 2em 0 0 0;">
                <div class="searchBar">
			        <div class="kameha">
			            <div class="container">
			                <div class="col-md-12 col-md-offset-1">
			                    <div class="reservation">
			                        <div class="online_reservation">
			                            <div class="b_room">
			                                <div class="booking_room">
			                                	<form action="" method="POST">
			                                    <div class="reservation">
			                                    	<input type="text" name="destination" value="<?php echo $option->Supplier->SupplierCode; ?>" hidden>
			                                        <ul>
			                                            <li class="span1_of_1">
			                                                        <h5>Check in</h5>
			                                                        <div class="book_date">
			                                                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
			                                                                <input type="text" id="dt1" name="dt1" style="cursor: pointer;" value="<?php echo $checkIn; ?>" required>
			                                                        </div>
			                                                    </li>
			                                                    <li class="span1_of_1 left">
			                                                        <h5>Check out</h5>
			                                                        <div class="book_date">
			                                                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
			                                                                <input type="text" id="dt2" name="dt2" style="cursor: pointer;" value="<?php echo $checkOut; ?>" required>
			                                                        </div>
			                                                    </li>
			                                                    <li class="span1_of_1 left adult">
			                                                        <h5>Adults</h5>
			                                                        <div class="section_room">
			                                                            <select class="form-control" name="adult" required>
			                                                            	<option>0</option>
			                                                                <option>1</option>
			                                                                <option>2</option>
			                                                                <option>3</option>
			                                                                <option>4</option>
			                                                                <option>5</option>
			                                                            </select>
			                                                        </div>
			                                                    </li>
			                                                    <li class="span1_of_1 left h-child">
			                                                        <h5>Children</h5>
			                                                        <div class="section_room">
			                                                            <select class="form-control" name="children">
			                                                            	<option>0</option>
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
			                                                        <div class="section_room">
			                                                            <select class="form-control" name="roomtype" required>
			                                                                <option value="SG">Single</option>
			                                                                <option value="DB">Double</option>
			                                                                <option value="TW">Twin</option>
			                                                                <option value="TR">Triple</option>
			                                                            </select>
			                                                        </div>
			                                                    </li>
			                                            <li class="span1_of_3">
			                                                <div class="date_btn">
			                                                        <input type="submit" value="Search" name="submit" />
			                                                </div>
			                                            </li>
			                                            </form>
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
        	-->
            <div class="c-rooms" id="room" style="margin: 0;">
            	<?php
            		if(!empty($optXml))
            		{
            		$jumlahRoom = count($optXml);
            			for($k = 0; $k < $jumlahRoom; $k++)
            			{
            	?>
                <div class="p-table">
                    <div class="p-table-grids">
                        <div class="col-md-3 p-table-grid">
                            <div class="p-table-grad-heading">
                                <h6>Transport type</h6>
                            </div>
                            <div class="p-right-img" style="background: url(images/rafting.jpg) no-repeat 0px 0px; /*buat ganti gambar, ganti URLnya aja*/
                                        background-size: cover;
                                        display: block;margin: 1em 1em 0 1em;">
                                <a href="#">  </a>
                            </div>

                            <div class="p-table-grid-info">
                                <div class="room-basic-info">
                                    <?php echo $optionProduct->Option[$k]->OptGeneral->Description; ?>
                                    <h6><?php echo $optionProduct->Option[$k]->OptGeneral->Comment; ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 p-table-grid">
                            <div class="p-table-grad-heading">
                                <h6>Avg rate per night</h6>
                            </div>
                            <div class="avg-rate">
                                <h5>Recommended for you</h5>
                                <p>Price is now:</p>
                                <span class="p-offer">
                                	<?php 
                                		echo $optionProduct->Option[$k]->OptStayResults->Currency.' '.convertMoney($optionProduct->Option[$k]->OptStayResults->TotalPrice);
                                	?>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3 p-table-grid">
                            <div class="p-table-grad-heading">
                                <h6>Book</h6>
                            </div>
                            <div class="book-button-column">
                                <a href="detailBook.php?key=<?php echo $optionProduct->Option[$k]->Opt; ?>&adult=<?php echo $adult; ?>&children=<?php echo $children; ?>&date=<?php echo $dateFrom; ?>&scuqty=<?php echo $SCUqty; ?>&room=<?php echo $roomType; ?>&checkIn=<?php echo $checkInFix; ?>&checkOut=<?php echo $checkOutFix; ?>" class="open-modal">Book</a>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <?php
            		}
            	}
                ?>
            
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
    <!--strat-date-piker-->
    
    <!--End-date-piker-->

	<script>
	  	$(window).load(function() {
	   		$(".loading").fadeOut("slow");
	  	});
	</script>
</body>

</html>