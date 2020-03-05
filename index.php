<?php
    session_start();

    ini_set('display_errors', 1);
    
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
        $loc = $_SESSION['loc'];
    	$opt = '??????';

    	$xml_requestOption = '<?xml version="1.0"?>'
        .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
        .'<Request CompressReply="Y">'
        .'<SupplierInfoRequest>'
        .'<AgentID>'.$username.'</AgentID>'
        .'<Password>'.$password.'</Password>'
        .'<SupplierCode>'.$opt.'</SupplierCode>'
        .'</SupplierInfoRequest>'
        .'</Request>';
            
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
            CURLOPT_POSTFIELDS => $xml_requestOption,                       // POST XML Request
            CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),  // Sent HEADER XML
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
    <!-- js -->

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
                    <div id="loginContainer">
                        <a href="logout.php"><span>Logout</span></a>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!--//header-->
      
    <!-- banner -->
    <div class="banner" style="background-image: url(images/mulia.jpg);">
        <!-- container -->
        <div class="container">
            <div class="col-md-12  ">
                <div class="sap_tabs">
                    <div class="booking-info about-booking-info">
                        <h2>Book Hotels</h2>
                    </div>
                    
                    <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                        <!---->
                        <div class="facts about-facts train-facts">
                            <div class="booking-form train-form">
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
                                    });
                                </script>
                                <!--End-date-piker-->
                                <div class="online_reservation">
                                    <div class="b_room">
                                        <div class="booking_room">
                                        <form method="POST" action="detailRoom.php">
                                            <div class="reservation">
                                                <ul>
                                                    <li class="span1_of_1 desti about-desti">
                                                        <h5>Destination, zone or hotel name</h5>
                                                        <div class="book_date">
                                                                <select class="form-control" id="myselect" style="z-index: 9999!important;" name="destination" tabindex="1">
							                                	<option selected disabled>Choose Destination</option>              
								                          			<?php

								                          				for($i = 0; $i < count($as); $i++){
								                          					if($option->Supplier[$i]->SupplierAnalysis2 == 'AC')
								                          					{
                                                                    ?>
								                          						<option value="<?php echo $option->Supplier[$i]->SupplierCode;?>"><?php echo $option->Supplier[$i]->Name; ?> </option>;
                                                                    <?php
								                          					}
								                          				}
								                          			?>
							                          			</select>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="reservation">
                                                <ul>
                                                    <li class="span1_of_1">
                                                        <h5>Check in</h5>
                                                        <div class="book_date">
                                                            
                                                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                                                <input type="text" id="dt1" style="cursor: pointer;" name="dt1" required>
                                                            
                                                        </div>
                                                    </li>
                                                    <li class="span1_of_1 left">
                                                        <h5>Check out</h5>
                                                        <div class="book_date">
                                                           
                                                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                                                <input type="text" id="dt2" style="cursor: pointer;" name="dt2" required>
                                                            
                                                        </div>
                                                    </li>
                                                    <li class="span1_of_1 left adult">
                                                        <h5>Adults</h5>
                                                        <!--start section_room-->
                                                        <div class="section_room">
                                                            <select class="form-control" name="adult" required>
                                                                <option value="">0</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="span1_of_1 left h-child">
                                                        <h5>Children</h5>
                                                        <!--start section_room-->
                                                        <div class="section_room">
                                                            <select class="form-control" name="children">
                                                                <option value="0">0</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="span1_of_1 h-rooms">
                                                        <h5>Rooms</h5>
                                                        <div class="section_room">
                                                            <select class="form-control" name="roomtype" required>
                                                                <option value="">Select Room Type</option>
                                                                <option value="SG">Single</option>
                                                                <option value="DB">Double</option>
                                                                <option value="TW">Twin</option>
                                                                <option value="TR">Triple</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <div class="clearfix"></div>
                                                </ul>
                                            </div>
                                            <div class="reservation">
                                                <ul>
                                                    <div class="clearfix"></div>
                                                </ul>
                                            </div>
                                            <div class="reservation">
                                                <ul>
                                                    <li class="span1_of_3">
                                                        <div class="date_btn">
                                                            <form>
                                                                <input type="submit" value="Search" name="submit" />
                                                            </form>
                                                        </div>
                                                    </li>
                                                    <div class="clearfix"></div>
                                                </ul>
                                            </div>
                                            </form>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <!---->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //container -->
    </div>
    <!-- //banner -->
    <!-- banner-bottom -->
    <div class="banner-bottom">
        <!-- container -->
        <div class="container">
            <div class="banner-bottom-info" style="margin-bottom: 4em;text-align: center;">
                <h3>Top Destination</h3>
            </div>
        </div>
        <section id="hot-tours" class="section-gray">
            <div class="image-zoom-container">
                <div class="zoom-container">
                    <a href="product.php?key=MED&type=AC">
                    <span class="zoom-caption">
                                    <h3>Medan</h3>
                                    <p>Melayu Deli City</p>
                                    <div >READ MORE</div>
                                </span>
                    <img src="images/travel1.jpg" />
                </a>
                </div>
                <div class="zoom-container">
                    <a href="product.php?key=DPS&type=AC">
                    <span class="zoom-caption">
                                    <h3>Bali</h3>
                                    <p>The Island of Gods</p>
                                    <div >READ MORE</div>
                                </span>
                    <img src="images/travel2.jpg" />
                </a>
                </div>
                <div class="zoom-container">
                    <a href="product.php?key=NTT&type=AC">
                    <span class="zoom-caption">
                                    <h3>Flores</h3>
                                    <p>The Island of Dragons</p>
                                    <div >READ MORE</div>
                                </span>
                    <img src="images/travel3.jpg" />
                </a>
                </div>
                <div class="zoom-container">
                    <a href="product.php?key=CGK&type=AC">
                    <span class="zoom-caption">
                                    <h3>Jakarta</h3>
                                    <p>Metropolis City</p>
                                    <div >READ MORE</div>
                                </span>
                    <img src="images/travel4.jpg" />
                </a>
                </div>
                <div class="zoom-container">
                    <a href="product.php?key=KAL&type=AC">
                    <span class="zoom-caption">
                                    <h3>Kalimantan</h3>
                                    <p>Land of The Equator</p>
                                    <div >READ MORE</div>
                                </span>
                    <img src="images/travel5.jpg" />
                </a>
                </div>
                <div class="zoom-container">
                    <a href="product.php?key=SUM&type=AC">
                    <span class="zoom-caption">
                                    <h3>Sumatra</h3>
                                    <p>The Island of Golds</p>
                                    <div >READ MORE</div>
                                </span>
                    <img src="images/travel6.jpg" />
                </a>
                </div>
            </div>
        </section>
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
	<script type="text/javascript" src="http://jsearchdropdown.sourceforge.net//jquery.searchabledropdown.js"></script>
	
	<script type="text/javascript">
	    $(document).ready(function() {
		    $('#myselect').searchable();

	    	$('#myselect').change(function() {
	        	$(this).autocomplete('search', '');
	      	});
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
    <!--  <script type="text/javascript">
    $(function() {
        SyntaxHighlighter.all();
    });
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider) {
                $('body').removeClass('loading');
            }
        });
    });
    </script> -->

    <!-- Loading script -->
	  <script>
	  $(window).load(function() {
	   $(".loading").fadeOut("slow");
	  });
	  </script>
</body>

</html>