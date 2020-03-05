<?php
	session_start();
	include("module/function.php");
    //error_reporting(0);
    //ini_set('display_errors',0);
    
    //$timeout = 360;
    //$logout_redirect_url = "login.php";
    //$timeout = $timeout*10;
    if(empty($_SESSION['name']))
    {
        header("location:login.php");
    }
    else
    {
    	$username = $_SESSION['username'];
        $password = $_SESSION['password'];
		$key = $_GET['key'];
		$type = $_GET['type'];

		// SENT REQUEST PRODUCT
		$opt = $key.$type.'????????????';
		$dateFrom = date('Y-m-d');
		$xml_requestOption = '<?xml version="1.0"?>'
		.'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
		.'<Request CompressReply="Y">'
		.'<OptionInfoRequest>'
		.'<AgentID>'.$username.'</AgentID>'
		.'<Password>'.$password.'</Password>'
		.'<Opt>'.$opt.'</Opt>'
		.'<Info>GMFTD</Info>'
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
			CURLOPT_POSTFIELDS => $xml_requestOption,						// POST XML Request
			CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),	// Sent HEADER XML
			CURLOPT_URL => $urls
			);

		//open connection
		$chs = curl_init();
		curl_setopt_array($chs, $option);
		
		$datas = curl_exec($chs);

	    $uncompresseds = gzdecode($datas);

		
		$xmls = simplexml_load_string($uncompresseds);
        $option = $xmls->OptionInfoReply;
        $as = $xmls->xpath("//Opt");
	} // End of Session
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
    
    <!-- banner-bottom -->
    <div class="banner-bottom">
        <!-- container -->
        <div class="container">
            <div class="faqs-top-grids">
                <div class="product-grids">
                    <div class="col-md-3 product-left">
                        <div class="h-class">
                            <h5>Hotel Class</h5>
                            <div class="hotel-price">
                                <label class="check" name="star">
                                    <input type="checkbox">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="starTextLabel">5 Stars</span>
                                </label>
                            </div>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox" name="star">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="starTextLabel">4 Stars</span>
                                </label>
                            </div>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox" name="star">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="starTextLabel">3 Stars </span>
                                </label>
                            </div>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox" name="star">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="starTextLabel">2 Stars</span>
                                </label>
                            </div>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox" name="star">
                                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                    <span class="starTextLabel">1 Stars</span>
                                </label>
                            </div>
                        </div>
                       
                        <div class="h-class p-day">
                            <h5>Price per day</h5>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox">
                                    <span class="p-day-grid">Less than $100
                                    </span>
                                </label>
                            </div>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox">
                                    <span class="p-day-grid">$100 to $200</span>
                                </label>
                            </div>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox">
                                    <span class="p-day-grid">$300 to $300</span>
                                </label>
                            </div>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox">
                                    <span class="p-day-grid">$300 to $400</span>
                                </label>
                            </div>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox">
                                    <span class="p-day-grid">More than $500</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 product-right">
                    	<?php
                    		for($i = 0; $i < count($as); $i++){
                    		if(!empty($option->Option[$i]->OptDateRanges->OptDateRange->RateSets->RateSet->OptRate->RoomRates->SingleRate)){
                    			$optEach[$i] = $option->Option[$i]->Opt;
            					$optFix[$i] = substr($optEach[$i], 5, 6);
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
                                        <a href="detailRoom.php?key=<?php echo $optFix[$i];?>"><?php echo $option->Option[$i]->OptGeneral->SupplierName; ?></a>
                                        <div class="p-right-price">
                                        	<?php
                                        		$star = $option->Option[$i]->OptGeneral->ClassDescription;
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
                                        <p><?php echo $option->Option[$i]->OptGeneral->Description; ?></p>
                                        <p><?php echo $option->Option[$i]->OptGeneral->Address1.', '.$option->Option[$i]->OptGeneral->Address2.', '.$option->Option[$i]->OptGeneral->Address3.', '.$option->Option[$i]->OptGeneral->Address4.$option->Option[$i]->OptGeneral->Address5; ?></p>
                                    </div>
                                    <div class="col-md-6 p-right-right">
                                        <p><i class="fa fa-info-circle" aria-hidden="true"></i> Nightly rates as below as</p>
                                        <span class="p-offer"><?php echo $option->Option[$i]->OptDateRanges->OptDateRange->Currency.' '.convertMoney($option->Option[$i]->OptDateRanges->OptDateRange->RateSets->RateSet->OptRate->RoomRates->SingleRate); ?></span>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                        <?php
	                        }
	                    }
                        ?>
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