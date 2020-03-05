<?php
    session_start();
    error_reporting(1);
    ini_set('display_errors',1); 
    include("module/function.php");
    if(empty($_SESSION['name']))
    {
        header("location:login.php");
    }
    else if($_POST['destination'] != ''){
    	header('location:detailAV.php?code='.$_POST['destination'].'&adult='.$_POST['txtAdult'].'&child='.$_POST['txtChild'].'&checkIn='.$_POST['txtCheckIn']);
    }
    else if($_POST['txtClass'] == ''){
        header("location:indexAV.php");
    }
    else
    {
    	if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $username = $_SESSION['username'];
            $password = $_SESSION['password'];
            $category = $_POST['txtCategory'];
            $class = $_POST['txtClass'];
            $checkIn = $_POST['txtCheckIn'];
            $adult = $_POST['txtAdult'];
            $child = $_POST['txtChild'];
            $checkInFix = date('Y-m-d', strtotime($checkIn));
            $dateFrom = $checkInFix;
            $location = $_POST['txtLocation'];

            if($location == '')
            {
	            $xml_request = '<?xml version="1.0"?>'
	            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
	            .'<Request CompressReply="Y">'
	            .'<OptionInfoRequest>'
	            .'<AgentID>'.$username.'</AgentID>'
	            .'<Password>'.$password.'</Password>'
	            .'<Opt>???AV????????????</Opt>'
	            .'<Info>GMFTDS</Info>'
	            .'<DateFrom>'.$dateFrom.'</DateFrom>'
	            .'<RoomConfigs><RoomConfig>'
	            .'<Adults>'.$adult.'</Adults>'
	            .'</RoomConfig></RoomConfigs>'
	            .'</OptionInfoRequest>'
	            .'</Request>';
	        }
	        else
	        {
	        	$xml_request = '<?xml version="1.0"?>'
	            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
	            .'<Request CompressReply="Y">'
	            .'<OptionInfoRequest>'
	            .'<AgentID>'.$username.'</AgentID>'
	            .'<Password>'.$password.'</Password>'
	            .'<Opt>'.$location.'AV????????????</Opt>'
	            .'<Info>GMFTDS</Info>'
	            .'<DateFrom>'.$dateFrom.'</DateFrom>'
	            .'<RoomConfigs><RoomConfig>'
	            .'<Adults>'.$adult.'</Adults>'
	            .'</RoomConfig></RoomConfigs>'
	            .'</OptionInfoRequest>'
	            .'</Request>';
	        }

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
                CURLOPT_RETURNTRANSFER => TRUE,                         // return web page
                CURLOPT_HEADER => FALSE,                                // don't return header
                CURLOPT_POSTFIELDS => $xml_request,                     // POST XML Request
                CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),  // Sent HEADER XML
                CURLOPT_URL => $urls
                );

            //open connection
            $ch = curl_init();
            curl_setopt_array($ch, $option);
            
            $data = curl_exec($ch);

            $uncompressed = gzdecode($data);

            $xml = simplexml_load_string($uncompressed);
            $optionProduct = $xml->OptionInfoReply;
            $optXml = $xml->OptionInfoReply->xpath("//Option");
        }
        else {
        	$username = $_SESSION['username'];
            $password = $_SESSION['password'];
            $class = $_POST['txtClass'];
            $checkIn = $_POST['txtCheckIn'];
            $adult = $_POST['txtAdult'];
            $child = $_POST['txtChild'];
            $checkInFix = date('Y-m-d', strtotime($checkIn));
            $dateFrom = $checkInFix;
            $location = $_POST['txtLocation'];

            if($location == '')
            {
	            $xml_request = '<?xml version="1.0"?>'
	            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
	            .'<Request CompressReply="Y">'
	            .'<OptionInfoRequest>'
	            .'<AgentID>'.$username.'</AgentID>'
	            .'<Password>'.$password.'</Password>'
	            .'<Opt>???AV????????????</Opt>'
	            .'<Info>GMFTDS</Info>'
	            .'<DateFrom>'.$dateFrom.'</DateFrom>'
	            .'<RoomConfigs><RoomConfig>'
	            .'<Adults>'.$adult.'</Adults>'
	            .'</RoomConfig></RoomConfigs>'
	            .'</OptionInfoRequest>'
	            .'</Request>';
	        }
	        else
	        {
	        	$xml_request = '<?xml version="1.0"?>'
	            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
	            .'<Request CompressReply="Y">'
	            .'<OptionInfoRequest>'
	            .'<AgentID>'.$username.'</AgentID>'
	            .'<Password>'.$password.'</Password>'
	            .'<Opt>'.$location.'AV????????????</Opt>'
	            .'<Info>GMFTDS</Info>'
	            .'<DateFrom>'.$dateFrom.'</DateFrom>'
	            .'<RoomConfigs><RoomConfig>'
	            .'<Adults>'.$adult.'</Adults>'
	            .'</RoomConfig></RoomConfigs>'
	            .'</OptionInfoRequest>'
	            .'</Request>';
	        }

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
                CURLOPT_RETURNTRANSFER => TRUE,                         // return web page
                CURLOPT_HEADER => FALSE,                                // don't return header
                CURLOPT_POSTFIELDS => $xml_request,                     // POST XML Request
                CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),  // Sent HEADER XML
                CURLOPT_URL => $urls
                );

            //open connection
            $ch = curl_init();
            curl_setopt_array($ch, $option);
            
            $data = curl_exec($ch);

            $uncompressed = gzdecode($data);

            $xml = simplexml_load_string($uncompressed);
            $optionProduct = $xml->OptionInfoReply;
            $optXml = $xml->OptionInfoReply->xpath("//Option");
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
                                    <a href="#">
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
                        <li><a href="index.php">Accommodation</a></li>
                        <li class="active"><a href="indexAV.php">Activities</a></li>
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
                        <div id="logoutContainer"><a href="logout.php" id="logoutButton"><span>Logout</span></a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!--//header
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
	-->
    <!-- banner-bottom -->
    <div class="banner-bottom">
        <!-- container -->
        <div class="container">
            <div class="faqs-top-grids">
                <div class="product-grids">
                    <div class="col-md-3 product-left">
                        <div class="h-class">
                            <h5>Activities Category</h5>
                            <div class="hotel-price">
                            	<form method="POST" action="">
                            	<input type="text" name="txtClass" hidden="hidden" value="<?php echo $class; ?>">
                            	<input type="text" name="txtCheckIn" hidden="hidden" value="<?php echo $checkIn; ?>">
                            	<input type="text" name="txtChild" hidden="hidden" value="<?php echo $child; ?>">
                            	<input type="text" name="txtAdult" hidden="hidden" value="<?php echo $adult; ?>">
                            	<input type="text" name="txtLocation" hidden="hidden" value="<?php echo $location; ?>">
                                <select class="form-control" name="txtCategory">
                                    <option value="">Choose Category</option>
                                        <?php
                                            if(!empty($optXml))
                                            {
                                                $jumlahRoom = count($optXml);
                                                for($k = 0; $k < $jumlahRoom; $k++)
                                                {
                                                    $nameDescription[] = $optionProduct->Option[$k]->OptGeneral->DBAnalysisDescription1;
                                                }
												$nameDescriptionFix = array_unique($nameDescription);
                                                
                                                // Fungsi untuk menghapus elemen array yang kosong
                                                function array_empty_remover($array, $remove_null_number = true) {
                                                    $new_array = array();
                                                    $null_exceptions = array();
                                                    foreach ($array as $key => $value) {
                                                        $value = trim($value);
                                                        if($remove_null_number) {
                                                            $null_exceptions[] = '0';
                                                        }
                                                        if(!in_array($value, $null_exceptions) && $value != "") {
                                                            $new_array[] = $value;
                                                        }
                                                    }
                                                    return $new_array;
                                                }
                                                
                                                $remove_null_number = true;
                                                $new_array = array_empty_remover($nameDescriptionFix, $remove_null_number);
                                                for($i = 0; $i < count($new_array); $i++)
                                                {
                                        ?>
                                                    <option><?php echo $new_array[$i]; ?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                </select>
                                <div class="date_btn" style="margin-top: 10px;">
                                	<input type="submit" value="submit" name="submit" class="date_btn">
                                </div>
                           		</form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 product-right">
                   	<!-- SUPPLIER EACH -->
                   		<?php
		                    $jumlahRoom = count($optXml);
		                    for($k = 0; $k < $jumlahRoom; $k++)
		                    {
		                      	if($optionProduct->Option[$k]->OptGeneral->Class == $class){
		                      		if(!empty($category)){
		                        		if($optionProduct->Option[$k]->OptGeneral->DBAnalysisDescription1 == $category){
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
                                        <a href="detailAV.php?opt=<?php echo $optionProduct->Option[$k]->Opt; ?>&adult=<?php echo $adult; ?>&child=<?php echo $child; ?>&checkIn=<?php echo $checkIn; ?>"><?php echo $optionProduct->Option[$k]->OptGeneral->SupplierName; ?></a>
                                        <div class="p-right-price">
                                        	<?php echo $optionProduct->Option[$k]->OptGeneral->Description; ?>
                                        </div>
                                        <p><?php echo $optionProduct->Option[$k]->OptGeneral->Comment; ?></p>
                                        <p><?php echo $optionProduct->Option[$k]->OptGeneral->Description; ?></p>
                                    </div>
                                    <div class="col-md-6 p-right-right">
                                        <p><i class="fa fa-info-circle" aria-hidden="true"></i>Price</p>
                                        <span class="p-offer">
                                        	<p><?php echo $optionProduct->Option[$k]->OptStayResults->Currency.' '.convertMoney($optionProduct->Option[$k]->OptStayResults->TotalPrice); ?></p>
                                        </span>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                    <?php
                    			}
                    		} else {
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
                                        <a href="detailAV.php?opt=<?php echo $optionProduct->Option[$k]->Opt; ?>&adult=<?php echo $adult; ?>&child=<?php echo $child; ?>&checkIn=<?php echo $checkIn; ?>"><?php echo $optionProduct->Option[$k]->OptGeneral->SupplierName; ?></a>
                                        <div class="p-right-price">
                                        	<?php
                                        		echo $optionProduct->Option[$k]->OptGeneral->ClassDescription;
											?>
                                        </div>
                                        <p><?php echo $optionProduct->Option[$k]->OptGeneral->Address1.', '.$$optionProduct->Option[$k]->OptGeneral->Address2.', '.$optionProduct->Option[$k]->OptGeneral->Address3.', '.$optionProduct->Option[$k]->OptGeneral->Address4.', '.$optionProduct->Option[$k]->OptGeneral->Address5; ?></p>
                                        <p><?php echo $optionProduct->Option[$k]->OptGeneral->PostCode; ?></p>
                                        <p><?php echo $optionProduct->Option[$k]->OptGeneral->DBAnalysisDescription1; ?></p>
                                        <p><?php echo $optionProduct->Option[$k]->OptGeneral->ClassDescription; ?></p>
                                    </div>
                                    <div class="col-md-6 p-right-right">
                                        <p><i class="fa fa-info-circle" aria-hidden="true"></i>Price</p>
                                        <span class="p-offer">
                                        	<p><?php echo $optionProduct->Option[$k]->OptStayResults->Currency.' '.convertMoney($optionProduct->Option[$k]->OptStayResults->TotalPrice); ?></p>
                                        </span>
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
                   	<!-- END SUPPLIER EACH -->
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