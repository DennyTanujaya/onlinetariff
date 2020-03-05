<?php
	session_start();
    error_reporting(0);
    ini_set('display_errors',0); 
    if(empty($_SESSION['name']))
    {
        header("location:login.php");
    }
    else
    {
		include("module/function.php");
		$adult = $_POST['txtAdult'];
        $children = $_POST['txtChild'];
        $checkin = $_POST['txtCheckIn'];
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];

		$supplierCode = $_POST['destination'];
		//$supplierCode = 'PANBAL';

		if($supplierCode == 'PANBAL')
		{
			$opt = '???PKPANBAL??????';
		}
		else if($supplierCode == 'PANJAK')
		{
			$opt = '???PKPANJAK??????';
		}
		else if($supplierCode == 'PANJOG')
		{
			$opt = '???PKPANJOG??????';
		}
		else if($supplierCode == 'PANLAB')
		{
			$opt = '???PKPANLAB??????';
		}
		else if($supplierCode == 'PANLOM')
		{
			$opt = '???PKPANLOM??????';
		}
		else if($supplierCode == 'PANMAK')
		{
			$opt = '???PKPANMAK??????';
		}
		else if($supplierCode == 'PANMED')
		{
			$opt = '???PKPANMED??????';
		}

		$xml_requestOption = '<?xml version="1.0"?>'
		.'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
		.'<Request CompressReply="Y">'
		.'<OptionInfoRequest>'
		.'<AgentID>'.$username.'</AgentID>'
		.'<Password>'.$password.'</Password>'
		.'<Opt>'.$opt.'</Opt>'
		.'<Info>GMFTD</Info>'
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


		$xmls = new DOMDocument();
		$xmls -> loadXML($uncompresseds);

		$xmls = simplexml_load_string($uncompresseds);
        $option = $xmls->OptionInfoReply;
        $as = $xmls->xpath("//Opt");
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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
    <link type="text/css" rel="stylesheet" href="css/JFFormStyle-1.css" />
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
                        <li><a href="indexAV">Activities</a></li>
                        <li><a href="indexTA.php">Arrival Transfer</a></li>
                        <li><a href="#">Cruises</a></li>
                        <li><a href="indexPT.php">Day Tours</a></li>
                        <li><a href="indexTD.php">Departure Transfer</a></li>
                        <li><a href="#">Golf</a></li>
                        <li><a href="indexTP.php">Ground Transport</a></li>
                        <li class="active"><a href="indexPK.php">Packages</a></li>
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
    <!--//header-->
    <!-- banner-bottom -->
    <div class="banner-bottom">
        <!-- container -->
        <div class="container">
            <div class="faqs-top-grids">
                <div class="product-grids">
                    <!--
                    <div class="col-md-3 product-left">
                        <div class="h-class p-day">
                            <h5>Price per day</h5>
                            <div class="hotel-price">
                                <label class="check">
                                    <input type="checkbox">
                                    <span class="p-day-grid">Less than $100</span>
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
                    -->
                    <div class="col-md-9 product-right">
                   		<?php
                   				for($i = 0; $i < count($as); $i++){
                    				$jumlahPrice = count($option->Option->OptDateRanges->OptDateRange->RateSets->RateSet->OptRate->PersonRates->AdultRate);
                    				if(!empty($option->Option[$i]->OptDateRanges->OptDateRange->RateSets->RateSet->OptRate->PersonRates->AdultRate) AND $option->Option[$i]->OptDateRanges->OptDateRange->RateSets->RateSet->OptRate->PersonRates->AdultRate != 0 ){
                    	?>
                   		<div class="product-right-grids" id="q">
                            <div class="product-right-top">
                                <div class="p-left">
                                    <div class="p-right-img" style="background: url(images/rafting.jpg) no-repeat 0px 0px; /*buat ganti gambar, ganti URLnya aja*/
                                        background-size: cover;
										display: block;">
                                        <a href="detailPackage.php?key=<?php echo $option->Option[$i]->Opt;?>&adult=<?php echo $adult;?>&children=<?php echo $children;?>&checkin=<?php echo $checkin;?>"></a>
                                    </div>
                                </div>
                                <div class="p-right">
                                    <div class="col-md-6 p-right-left">
                                        <a href="detailPackage.php?key=<?php echo $option->Option[$i]->Opt;?>&adult=<?php echo $adult;?>&children=<?php echo $children;?>&checkin=<?php echo $checkin;?>"><?php echo $option->Option[$i]->OptGeneral->Description.'<br />'.$option->Option[$i]->OptGeneral->Comment; ?></a>
                                        <div class="p-right-price">
                                        </div>
                                        <p><?php echo $option->Option[$i]->OptGeneral->Address1.', '.$option->Option[$i]->OptGeneral->Address3.', '.$option->Option[$i]->OptGeneral->Address4.', '.$option->Option[$i]->OptGeneral->Address5; ?></p>
                                    </div>
                                    <div class="col-md-6 p-right-right">
                                        <p><i class="fa fa-info-circle" aria-hidden="true"></i> Nightly rates as below as</p>
                                        <span class="p-offer">
                                        	<?php
                                        		echo $option->Option->OptDateRanges->OptDateRange->Currency.' '.convertMoney($option->Option[$i]->OptDateRanges->OptDateRange->RateSets->RateSet->OptRate->PersonRates->AdultRate);
                                        	?>
                                        </span>
                                        /pax
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>

                                <!-- tab baru start    

                                <div id="tabvanilla">
                                    <ul class="tabnav">
                                        <li><a href="#tab1">Map</a></li>
                                        <li><a href="#tab2">Images</a></li>
                                        <li><a href="#tab3">Description</a></li>
                                    </ul>
                                    <div id="tab1">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.6771856236505!2d106.80134931535885!3d-6.173955995530167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f6631a9ee469%3A0x634c03fe9ede6ad7!2sPanorama+JTB+(Head+Office)!5e0!3m2!1sen!2sid!4v1513311705597" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                                    </div>
                                     div#tab1
                                    <div id="tab2">
                                        <div class="flexslider">
                                            <ul class="slides">
                                                <li data-thumb="images/p1.jpg">
                                                    <img src="images/p1.jpg" alt="" />
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
                                            </ul>
                                        </div>
                                        FlexSlider
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
                                     div#tab2
                                    <div id="tab3">
                                        <div class="col-md-6 p-table-grid">
                                            <div class="p-table-grad-heading2">
                                                <h6>Overview</h6>
                                                <p>Situated in the center of Bali’s fantastic shopping, bars, cafes, restaurants, and beach area, Asana Agung Putra Hotel provides the perfect combination of bustling urban life and relaxed seaside living. Just a few meters down a driveway in Poppies Lane, you can escape from the bustle of everyday life as you lie back on a sun lounger, sip a tropical cocktail from the Pool Bar and bask under cloudless skies. Keep active with a swim in the pool or a workout in the fitness center. There is even a full size Billiard Table if you feel you need a challenge. Asana Agung Putra Hotel offers fine dining, music and cocktails in our Restaurant or you can spoil yourself by ordering your meal and drinks to be served to you as you enjoy sitting by either our Tranquility Pool (by the Restaurant) or around the larger Fun Pool.</p>
                                                <h6>Group Policy</h6>
                                                <p>For every 15 paying rooms, is entitled to get 1 room based on free of charge.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-table-grid">
                                            <div class="p-table-grad-heading2">
                                                <h6>Honeymoon benefit</h6>
                                                <div class="rate-features2">
                                                    <ul>
                                                        <li>Guarantee double bed</li>
                                                        <li>Fruit basket</li>
                                                        <li>Honeymoon cake</li>
                                                        <li></li>
                                                        <li>Sed ut urna id metus</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="p-table-grad-heading2">
                                                <h6>Child Policy</h6>
                                                <div class="rate-features2">
                                                    <ul>
                                                        <li>Guarantee double bed</li>
                                                        <ol type="1">
                                                            <li>
                                                                asdasdas
                                                            </li>
                                                        </ol>
                                                        <li>Fruit basket</li>
                                                        <li>Honeymoon cake</li>
                                                        <li></li>
                                                        <li>Sed ut urna id metus</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"> </div>
                                    </div>
                                    <div#tab3
                                </div>
                                div#tabvanilla
                                <script type="text/javascript">
                                $(document).ready(function() {
                                    $.effects.effect.heightFade = function(o, done) {
                                        var el = $(this),
                                            mode = $.effects.setMode(el, o.mode || "show");
                                        el.animate({
                                            height: mode,
                                            opacity: mode
                                        }, {
                                            queue: false,
                                            complete: done
                                        });
                                    };
                                    $('#tabvanilla').tabs({
                                        hide: "heightFade",
                                        show: "heightFade",
                                        collapsible: true
                                    });  
                                });
                                </script>  
                                tab baru end -->

                                <div class="clearfix"> </div>
                            </div>
                        </div>
                        <?php }
                        }?>
                       
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
        $(window).load(function() {
            $(".loading").fadeOut("slow");
        });
    </script>
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