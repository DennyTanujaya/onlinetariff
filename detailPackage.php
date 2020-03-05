<?php
    session_start();
    error_reporting(1);
    include ("module/function.php"); 
    if(empty($_SESSION['name']))
    {
        header("location:login.php");
    }
    else
    {
        $username = $_SESSION["username"];
        $password = $_SESSION["password"];
        $opt = $_GET['key'];
        $adult = $_GET['adult'];
        $children = $_GET['children'];
        $checkin = $_GET['checkin'];
        $checkIn = date('Y-m-d', strtotime($checkin));
        if(!isset($children) OR $children == 0)
        {
            $children = 0;
        }


        $xml_request = '<?xml version="1.0"?>'
        .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
        .'<Request CompressReply="Y">'
        .'<OptionInfoRequest>'
        .'<AgentID>'.$username.'</AgentID>'
        .'<Password>'.$password.'</Password>'
        .'<Opt>'.$opt.'</Opt>'
        .'<Info>GMFTDS</Info>'
        .'<DateFrom>'.$checkIn.'</DateFrom>'
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


        $xmls = simplexml_load_string($uncompressed);
        $option = $xmls->OptionInfoReply;

        $pisahHighLight = str_replace("Highlights:", "", $option->Option->OptionNotes->OptionNote[0]->NoteText);
        $highlight = explode("·", $pisahHighLight);

    	$pisah = str_replace("What to Expect:", "", $option->Option->OptionNotes->OptionNote[1]->NoteText);
    	$pisah1 = explode("What You Will Do:",$option->Option->OptionNotes->OptionNote[1]->NoteText);
    	$pisah2 = explode("- END OF PANORAMA DESTINATION’S SERVICE -",$pisah1[1]);
    	$pisah3 = explode("includes:",$pisah2[1]);
    	$pisah3i = explode("Our ‘", $pisah3[1]);
    	$pisah5 = explode("does NOT include:", $pisah3[1]);
    	$pisah5e = explode("Good to know:", $pisah5[1]);
    	$pisah10 = explode("Terms & Conditions:", $pisah5e[1]);
    	$pisah6 = explode("·	", $pisah5[1]);
    	$pisah4 = explode("·	", $pisah3i[0]);
    	$pisah8 = explode("·	", $pisah5e[0]);
    	$pisah7 = explode("·	", $pisah10[0]);
    	$pisah9 = explode("·	", $pisah10[1]);
    	$dayPisah = explode("Day", $pisah2[0]);
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
                        <li><a href="index.php">Accommodation</a></li>
                        <li><a href="indexAV.php">Activities</a></li>
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
                    <div id="loginContainer"><a href="logout.php" id="loginButton"><span>Logout</span></a>
                         
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!--//header-->
    <!-- ===================================================================================================================================================================== -->
    <!-- banner-bottom -->
    <div class="banner-bottom" id="overview">
        <!-- container -->
        <div class="container">
            <div class="faqs-top-grids">
                <!--single-page-->
                <div class="single-page">
                    <div class="col-md-4 single-gd-rt">
                        <div class="single-pg-hdr">
                            <h2><?php echo $option->Option->OptGeneral->Description; ?></h2>
                            <p><?php echo $option->Option->OptGeneral->Address1.'<br />'.$option->Option->OptGeneral->Address3.','.$option->Option->OptGeneral->Address5.','.$option->Option->OptGeneral->PostCode; ?></p>
                            <p align="justify">
                            <?php
                                for($i = 1; $i < count($highlight); $i++)
                                {
                            ?>
                                <ul>
                                    <li><?php echo $highlight[$i]; ?></li>
                                </ul>
                            <?php } ?>
                            </p>
                            <div class="avg-rate" style="padding: 0px !important;">
                                <p style="font-size: 1em !important;">Price is now:</p>
                                <span class="p-offer"><?php echo $option->Option->OptStayResults->Currency.' '.convertMoney($option->Option->OptStayResults->TotalPrice); ?></span>
                                <!-- <span class="p-last-price">$230</span> -->
                            </div>
                            <div class="date_btn news-letter-grid">
                                <a href="detailBookPackage.php?key=<?php echo $opt;?>&adult=<?php echo $adult;?>&children=<?php echo $children;?>&checkin=<?php echo $checkin;?>">Book</a>|<a href="factsheet/factsheet.php?opt=<?php echo $opt;?>">Download</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 single-gd-lt">
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
                                <li data-thumb="images/p1.jpg">
                                    <img src="images/p1.jpg" alt="" />
                                </li>
                                <li data-thumb="images/p2.jpg">
                                    <img src="images/p2.jpg" alt="" />
                                </li>
                                <li data-thumb="images/p3.jpg">
                                    <img src="images/p3.jpg" alt="" />
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
    <!-- ===================================================================================================================================================================== -->
    <!-- banner-bottom -->
    <div class="banner-bottom" id="overview">
        <!-- container -->
        <div class="container">
            <div class="faqs-top-grids">
                <!--single-page-->
                <div class="single-page">
                    <div class="row example-basic">
                        <div class="col-md-12 single-gd-rt what-to-expect">
                        <?php
                            if(!empty($pisah1[0]))
                            {
                        ?>
                            <h2>What to expect</h2>
                            <p align="justify"><?php echo $pisah1[0];?></p>
                        <?php } ?>
                        </div>
                        <?php 
                            if(!empty($dayPisah))
                            {
                        ?>
                        <div class="col-md-12 what-to-expect">
                            <h2>What you will do</h2>
                        </div>
                        <?php
                        $jumlah = 0;
                        for($j=1; $j<15; $j++)
                        {
                            if(preg_match('/Day '.$j.':/', $pisah2[0])) {
                              $jumlah = $jumlah + 1;
                            }
                        }

                        for($i=1;$i<=$jumlah;$i++)
                        {
                            $day3 = $i.': ';
                            $day2 = explode($day3, $dayPisah[$i]);
                        ?>
                        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
                            <ul class="timeline">
                                <li class="timeline-item">
                                    <div class="timeline-info">
                                        <span>Day <?php echo $i;?></span>
                                    </div>
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <!--<h3 class="timeline-title">Bla bla bla bla bla</h3> -->
                                        <p><?php echo $day2[1]; ?></p>
                                    </div>
                                </li>
                                <li class="timeline-item period">
                                    <div class="timeline-info"></div>
                                    <div class="timeline-marker"></div> 
                                </li>
                            </ul>
                        </div>
                        <?php }
                        } ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!--//single-page-->
            </div>
            <!-- hotel information -->
            <div id="info">
                <div class="banner-bottom-info" style="margin: 2em 0;">
                    <h3>End Of Panorama Destination's Service</h3>
                </div>
                <div class="p-table">
                    <div class="p-table-grids">
                        <div class="col-md-6 p-table-grid">
                            <div class="p-table-grad-heading2">
                            <?php
                                if(!empty($pisah4))
                                { 
                            ?>
                                <h6><?php echo "Our '".$option->Option->OptGeneral->Description."' package includes:"; ?></h6>
                                <div class="rate-features2">
                                <?php
                                    $jumlahPackageInclusive = count($pisah4);   
                                    for($i=1;$i<$jumlahPackageInclusive;$i++)
                                    {
                                ?>

                                <ul>
                                    <li><?php echo $pisah4[$i]; ?></li>
                                </ul>
                                <?php } 
                                }?>
                                </div>
                                <?php
                                    if(!empty($pisah8))
                                    {
                                ?>
                                <h6><?php echo "Our '".$option->Option->OptGeneral->Description."' package does NOT includes:"; ?></h6>
                                <div class="rate-features2">
                                <?php
                                    $jumlahPackageExclusive = count($pisah8);   
                                    for($i=1;$i<$jumlahPackageExclusive;$i++)
                                    {
                                ?>
                                    <ul>
                                        <li><?php echo $pisah8[$i]; ?></li>
                                    </ul>
                                <?php }
                                }?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-table-grid">
                            <div class="p-table-grad-heading2">
                                <?php
                                    if(!empty($pisah7))
                                    {
                                ?>
                                <h6>Good to know</h6>
                                <div class="rate-features2">
                                <?php 
                                    $jumlahPackageGoodToKnow = count($pisah7);  
                                    for($i=1;$i<$jumlahPackageGoodToKnow;$i++)
                                    {
                                ?>
                                    <ul>
                                        <li><?php echo $pisah7[$i]; ?></li>
                                    </ul>
                                <?php }
                                }?>
                                </div>
                            </div>
                            <div class="p-table-grad-heading2">
                                <?php
                                    if(!empty($pisah9))
                                    {
                                ?>
                                <h6>Terms & Conditions</h6>
                                <div class="rate-features2">
                                <?php
                                    $jumlahPackagetc = count($pisah9);  
                                    for($i=1;$i<$jumlahPackagetc;$i++)
                                    {
                                ?>
                                    <ul>
                                        <li><?php echo $pisah9[$i]; ?></li>
                                    </ul>
                                <?php }
                                }?>
                                </div>
                            </div>
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
    <?php include("footer.php") ?>
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


        $("#dt1").datepicker('setDate', '+0');
        $("#dt2").datepicker('setDate', '+1');

        jQuery("#dt1, #dt3").datepicker({
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
        jQuery("#dt2, #dt4").datepicker({
            minDate: '+1d',
            dateFormat: "dd-M-yy"
        });
    });
    </script>
    <!--End-date-piker-->
</body>

</html>