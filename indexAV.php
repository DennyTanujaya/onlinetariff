<?php
    session_start();
    error_reporting(1);
    ini_set('display_errors',1); 
    if(empty($_SESSION['name']))
    {
        header("location:login.php");
    }
    else
    {
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    $opt = '???AV????????????';

    $xml_requestOption = '<?xml version="1.0"?>'
        .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
        .'<Request CompressReply="Y">'
        .'<OptionInfoRequest>'
        .'<AgentID>'.$username.'</AgentID>'
        .'<Password>'.$password.'</Password>'
        .'<Opt>'.$opt.'</Opt>'
        .'<Info>G</Info>'
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
            CURLOPT_POSTFIELDS => $xml_requestOption,               // POST XML Request
            CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),  // Sent HEADER XML
            CURLOPT_URL => $urls
            );

        //open connection
        $chs = curl_init();
        curl_setopt_array($chs, $option);
        
        $datas = curl_exec($chs);

        $uncompresseds = gzdecode($datas);


        $xmls = simplexml_load_string($uncompresseds);
        $option = $xmls->OptionInfoReply;
        $optXml = $xmls->xpath("//Option");
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
                    <div id="loginContainer"><a href="#" id="loginButton"><span>Logout</span></a>
                         
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!--//header-->
      
    <!-- banner -->
    <div class="banner" style="background-image: url(images/package-bg.jpg);">
        <!-- container -->
        <div class="container">
            <div class="col-md-12  ">
                <div class="sap_tabs">
                    <div class="booking-info about-booking-info">
                        <h2>Activities</h2>
                    </div>
                    <form method="POST" action="productSearchAV.php">
                    <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                        <!---->
                        <div class="facts about-facts train-facts">
                            <div class="booking-form train-form">
                                <!--strat-date-piker-->
                                <script>
                                jQuery(function() {
                                    
                                    
                                    $("#dt1").datepicker('setDate', '+0');
                                    $("#dt2").datepicker('setDate', '+1');
                                    
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
                                            <!--
                                            <div class="reservation">
                                                <ul>
                                                    <li class="span1_of_1 desti about-desti">
                                                        <h5>Activities Supplier</h5>
                                                        <div class="book_date">
                                                            <select class="form-control" id="myselect" style="z-index: 9999!important;" name="destination" tabindex="1">
                                                            <option selected value="">Choose Activities</option>              
                                                                <?php
                                                                        for($k = 0; $k < count($optXml); $k++){
                                                                            $nameDescription[] = $option->Option[$k]->OptGeneral->SupplierName;
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
                                                                    
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            -->
                                            <div class="reservation">
                                                <ul>
                                                    <li class="span1_of_1">
                                                        <h5>Check In</h5>
                                                        <div class="book_date">
                                                            
                                                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                                                <input type="text" id="dt1" style="cursor: pointer;" name="txtCheckIn" required>
                                                            
                                                        </div>
                                                    </li>
                                                    <li class="span1_of_1 left adult">
                                                        <h5>Adults</h5>
                                                        <!--start section_room-->
                                                        <div class="section_room">
                                                            <select class="form-control" name="txtAdult" required="">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                                <option value="17">17</option>
                                                                <option value="18">18</option>
                                                                <option value="19">19</option>
                                                                <option value="20">20</option>
                                                                <option value="21">21</option>
                                                                <option value="22">22</option>
                                                                <option value="23">23</option>
                                                                <option value="24">24</option>
                                                                <option value="25">25</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="span1_of_1 left h-child">
                                                        <h5>Children</h5>
                                                        <!--start section_room-->
                                                        <div class="section_room">
                                                            <select class="form-control" name="txtChild">
                                                                <option value="0">0</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                                <option value="17">17</option>
                                                                <option value="18">18</option>
                                                                <option value="19">19</option>
                                                                <option value="20">20</option>
                                                                <option value="21">21</option>
                                                                <option value="22">22</option>
                                                                <option value="23">23</option>
                                                                <option value="24">24</option>
                                                                <option value="25">25</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="span1_of_1">
                                                        <h5>Category Avtivities</h5>
                                                        <!--start section_room-->
                                                        <div class="section_room">
                                                            <select class="form-control" name="txtClass">
                                                                <option value="">Please Choose category</option>
                                                                <option value="WSP">Water Sports</option>
                                                                <option value="SAA">Sports & Adventure</option>
                                                            </select>
                                                        </div>
                                                    </li>
                                                    <li class="span1_of_1">
                                                        <h5>Category Location</h5>
                                                        <!--start section_room-->
                                                        <div class="section_room">
                                                            <select class="form-control" name="txtLocation">
                                                                <option value="">Please Choose location</option>
                                                                <option value="DPS">Bali</option>
                                                                <option value="CGK">Jakarta</option>
                                                                <option value="JOG">Yogyakarta</option>
                                                                <option value="BOG">Bogor</option>
                                                                <option value="MAK">Makassar</option>
                                                                <option value="LOM"></option>
                                                                <option value="BDO">Bandung</option>
                                                                <option value="WJA">West Java</option>
                                                                <option value="EJA">East Java</option>
                                                                <option value="CJA">Central Java</option>
                                                                <option value="MES">Medan</option>
                                                                <option value="LOP">Lombok</option>
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
                                                        <div class="date_btn news-letter-grid">
                                                                <input type="submit" value="Search" name="submit" />
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