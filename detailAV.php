<?php
    session_start();
    error_reporting(0);
    ini_set('display_errors',0); 
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
            $destination = $_POST['destination'];
            $category = $_POST['txtCategory'];

            $checkIn = $_POST['txtCheckIn'];
            $adult = $_POST['txtAdult'];
            $children = $_POST['txtChild'];
            $checkInFix = date('Y-m-d', strtotime($checkIn));
            $dateFrom = $checkInFix;
            $supplierCode = substr($destination,3,3);
            //$opt = "DPSACAAPDPS??????";
            $opt = $supplierCode.'AV'.$destination.'??????';
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
            $optXml = $xml->$optionProduct->xpath("//Option");

            $xml_requestPrices = '<?xml version="1.0"?>'
            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
            .'<Request CompressReply="Y">'
            .'<SupplierInfoRequest>'
            .'<AgentID>'.$username.'</AgentID>'
            .'<Password>'.$password.'</Password>'
            .'<SupplierCode>'.$destination.'</SupplierCode>'
            .'</SupplierInfoRequest>'
            .'</Request>';
            
            $option = array(
                CURLOPT_RETURNTRANSFER => TRUE,                         // return web page
                CURLOPT_HEADER => FALSE,                                // don't return header
                CURLOPT_POSTFIELDS => $xml_requestPrices,                       // POST XML Request
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
            $amenity = $xmls->xpath("//Amenity");
        }
        else
        {
            $username = $_SESSION['username'];
            $password = $_SESSION['password'];
            if(isset($_GET['opt']))
            {
                $opt = $_GET['opt'];
                $destination = substr($opt,5,6);
                $checkIn = $_GET['checkIn'];
                $adult = $_GET['adult'];
                $children = $_GET['child'];
                $checkInFix = date('Y-m-d', strtotime($checkIn));
                $dateFrom = $checkInFix;
            }
            else
            {
                $destination = $_GET['code'];
                $checkIn = $_GET['checkIn'];
                $adult = $_GET['adult'];
                $children = $_GET['child'];
                $checkInFix = date('Y-m-d', strtotime($checkIn));
                $dateFrom = $checkInFix;
                $supplierCode = substr($destination,3,3);
                $opt = $supplierCode.'AV'.$destination.'??????';
            }
            

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
            $optXml = $xml->$optionProduct->xpath("//Option");
            
            

            $xml_requestPrices = '<?xml version="1.0"?>'
            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
            .'<Request CompressReply="Y">'
            .'<SupplierInfoRequest>'
            .'<AgentID>'.$username.'</AgentID>'
            .'<Password>'.$password.'</Password>'
            .'<SupplierCode>'.$destination.'</SupplierCode>'
            .'</SupplierInfoRequest>'
            .'</Request>';
            
            $option = array(
                CURLOPT_RETURNTRANSFER => TRUE,                         // return web page
                CURLOPT_HEADER => FALSE,                                // don't return header
                CURLOPT_POSTFIELDS => $xml_requestPrices,                       // POST XML Request
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
            $amenity = $xmls->xpath("//Amenity");
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
                                    for($j = 0; $j < 6; $j++)
                                    {
                                        if($option->Supplier->SupplierNotes->SupplierNote[$j]->NoteCategory == 'FSS')
                                        {
                                            $overview = explode("OVERVIEW:",$option->Supplier->SupplierNotes->SupplierNote[$j]->NoteText);
                                            echo $overview[1];
                                        }
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-8 single-gd-lt">
                        <div class="flexslider">
                            <ul class="slides">
                                <li data-thumb="images/rafting.jpg">
                                    <img src="images/rafting.jpg" alt="" />
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
                <h3>Activity choices</h3>
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
                                    <form action="" method="POST">
                                    <div class="reservation">
                                        <input type="text" name="destination" value="<?php echo $option->Supplier->SupplierCode; ?>" hidden>
                                        <ul>
                                            <li class="span1_of_1">
                                                <h5>Category</h5>
                                                <div class="section_room">
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
                                                </div>
                                            </li>
                                            <li class="span1_of_1 left ">
                                                <h5>Check in</h5>
                                                <div class="book_date">
                                                    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                                    <input type="text" id="dt1" name="txtCheckIn" style="cursor: pointer;" value="<?php echo $checkIn; ?>" required>
                                                </div>
                                            </li>
                                            <li class="span1_of_1 left adult">
                                                <h5>Adults</h5>
                                                <!--start section_room-->
                                                <div class="section_room">
                                                    <select class="form-control" name="txtAdult" required>
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

            <div class="c-rooms" id="room" style="margin: 0;">
                <?php
                    if(!empty($optXml))
                    {
                        $jumlahRoom = count($optXml);
                        for($k = 0; $k < $jumlahRoom; $k++)
                        {
                            if($optionProduct->Option[$k]->OptGeneral->DBAnalysisDescription1 == $category)
                            {
                ?>
                <div class="p-table">
                    <div class="p-table-grids">
                        <div class="col-md-3 p-table-grid">
                            <div class="p-table-grad-heading">
                                <h6>Activities Type</h6>
                            </div>
                            <div class="p-right-img" style="background: url(images/rafting.jpg) no-repeat 0px 0px; /*buat ganti gambar, ganti URLnya aja*/
                                        background-size: cover;
                                        display: block;margin: 1em 1em 0 1em;">
                                <a href="#">  </a>
                            </div>

                            <div class="p-table-grid-info">
                                <div class="room-basic-info">
                                    <a href="#modal1" data-toggle="modal"><?php echo $optionProduct->Option[$k]->OptGeneral->Description; ?></a>
                                    <h6><?php echo $optionProduct->Option[$k]->OptGeneral->Comment; ?></h6>
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
                                        $amenity = count($option->Supplier->Amenities->Amenity);
                                        for($j = 0; $j < $amenity; $j++)
                                        {
                                           echo '<li>'.$option->Supplier->Amenities->Amenity[$j]->AmenityDescription.'<li>';
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
                                <a href="detailBook.php?key=<?php echo $optionProduct->Option[$k]->Opt; ?>&adult=<?php echo $adult; ?>&children=<?php echo $children; ?>&date=<?php echo $dateFrom; ?>&checkIn=<?php echo $checkInFix; ?>" class="open-modal">Book</a>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <?php
                        }
                        else if($category == ""){
                ?>
                            <div class="p-table">
                                <div class="p-table-grids">
                                    <div class="col-md-3 p-table-grid">
                                        <div class="p-table-grad-heading">
                                            <h6>Activities Type</h6>
                                        </div>
                                        <div class="p-right-img" style="background: url(images/rafting.jpg) no-repeat 0px 0px; /*buat ganti gambar, ganti URLnya aja*/
                                                    background-size: cover;
                                                    display: block;margin: 1em 1em 0 1em;">
                                            <a href="#">  </a>
                                        </div>

                                        <div class="p-table-grid-info">
                                            <div class="room-basic-info">
                                                <a href="#modal1" data-toggle="modal"><?php echo $optionProduct->Option[$k]->OptGeneral->Description; ?></a>
                                                <h6><?php echo $optionProduct->Option[$k]->OptGeneral->Comment; ?></h6>
                                                <h6><?php echo $optionProduct->Option[$k]->OptGeneral->DBAnalysisDescription1; ?></h6>
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
                                                    $amenity = count($option->Supplier->Amenities->Amenity);
                                                    for($j = 0; $j < $amenity; $j++)
                                                    {
                                                       echo '<li>'.$option->Supplier->Amenities->Amenity[$j]->AmenityDescription.'<li>';
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
                                            <a href="detailBook.php?key=<?php echo $optionProduct->Option[$k]->Opt; ?>&adult=<?php echo $adult; ?>&children=<?php echo $children; ?>&date=<?php echo $dateFrom; ?>&checkIn=<?php echo $checkInFix; ?>" class="open-modal">Book</a>
                                        </div>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                            </div>
                <?php
                        }
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
    <script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal").click(function(e) {
      var m = $(this).attr("id");
     $.ajax({
          url: "detailRoom.php",
          type: "GET",
          data : {modal_id: m,},
          success: function (ajaxData){
            $("#ModalEdit").html(ajaxData);
            $("#ModalEdit").modal('show',{backdrop: 'true'});
           }
         });
        });
      });
</script>
</body>

</html>