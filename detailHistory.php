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
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $bookingID = $_GET['id'];

        $xml_request = '<?xml version="1.0"?>'
        .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
        .'<Request CompressReply="Y">'
        .'<GetBookingRequest>'
            .'<AgentID>'.$username.'</AgentID>'
            .'<Password>'.$password.'</Password>'
            .'<BookingId>'.$bookingID.'</BookingId>'
        .'</GetBookingRequest>'
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
        $getBooking = $xml->GetBookingReply;
        $jumlahData = $xml->xpath("//Service");


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
    <!--     <link type="text/css" rel="stylesheet" href="css/JFFormStyle-1.css" /> -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.css" />
    <!-- js -->
    <script src="js/modernizr.custom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                            <a href="index.php"><img src="images/logo.png" alt="" /></a>
                        </div>
                    </div>
                    <div class="col-sm-8" style="padding-right: 2.5%;">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="member.php">
                                        <div class="center">
                                            <?php echo $_SESSION['name']; ?></div>
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
                        <div id="loginContainer"><a href="logout.php"><span>Logout</span></a>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="faqs-top-grids">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="footer-grid">
                                    <h3>Booking Refference : <span class="code-book">#<?php echo $getBooking->Ref; ?></span></h3>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="footer-grid">
                                    <h3>Booking Code : <span class="code-book">#<?php echo $getBooking->BookingId; ?></span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                                if(count($jumlahData) > 0){
                                    for($i=0; $i<count($jumlahData); $i++){
                                        $Opt = $getBooking->Services->Service[$i]->Opt;
                                        if(strpos($Opt, "AC"))
                                        {
                            ?>
                            <div class="col-md-7">
                                <div class="box-traveler">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h2>Booking Name</h2>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-1">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-xs-10">
                                                    <?php echo $getBooking->Name; ?>
                                                </div>
                                            </div>   
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h2>Agent Reference</h2>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-1">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-xs-10">
                                                    <?php
                                                        if(!empty($getBooking->AgentRef))
                                                        {
                                                            echo $getBooking->AgentRef;
                                                        }
                                                        else
                                                        {
                                                            echo "-";
                                                        }
                                                    ?>
                                                </div>
                                            </div>   
                                        </div> 
                                    </div> 
                                </div>
                                <div class="box-traveler">
                                    <div class="row">
                                        <div class="col-xs-12 mt20">
                                            <h2>Remarks</h2>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-xs-12">
                                             <p>
                                                 <?php
                                                    if(!empty($getBooking->Remarks))
                                                    { 
                                                        echo $getBooking->Remarks;
                                                    }
                                                    else{
                                                        echo "-";
                                                    }
                                                 ?>
                                             </p> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="box-traveler">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h2>Hotel Choice</h2>
                                            <h3><?php echo $getBooking->Services->Service[$i]->SupplierName; ?></h3>
                                            <div class="image">
                                                <img src="http://ptc.xoloni.com/40/assets/images/pict-rincian-pemesanan.jpg" alt="Panorama Destination">
                                            </div> 
                                            <ul class="rincian-pemesanan">
                                                <?php
                                                    $jumlahDay = $getBooking->Services->Service[$i]->SCUqty;
                                                    $serviceDate = date('Y-m-d', strtotime($getBooking->Services->Service[$i]->Date));
                                                    $checkout = date('Y-m-d', strtotime("+".$jumlahDay." Days", strtotime($serviceDate)));
                                                    $checkIn = date('l, d F Y', strtotime($getBooking->Services->Service[$i]->Date));
                                                    $checkOut = date('l, d F Y', strtotime($checkout));
                                                ?>
                                                <li>Check-in
                                                    <div class="pull-right"><?php echo $checkIn;?></div>
                                                </li>
                                                <li>Check-out
                                                    <div class="pull-right"><?php echo $checkOut;?></div>
                                                </li>
                                                <li>Description
                                                    <div class="pull-right"><?php echo $getBooking->Services->Service[$i]->Description; ?></div>
                                                </li>
                                                <li>Room Type
                                                    <div class="pull-right">
                                                        <?php
                                                            if($getBooking->Services->Service[$i]->RoomType == "SG")
                                                            {
                                                                echo "Single Room Type";
                                                            }
                                                            else if($getBooking->Services->Service[$i]->RoomType == "DB")
                                                            {
                                                                echo "Double Room Type";
                                                            }
                                                            else if($getBooking->Services->Service[$i]->RoomType == "TW")
                                                            {
                                                                echo "Twin Room Type";
                                                            }
                                                            else if($getBooking->Services->Service[$i]->RoomType == "TR")
                                                            {
                                                                echo "Triple Room Type";
                                                            }
                                                        ?>
                                                    </div>
                                                </li>
                                                <li>Lodging
                                                    <div class="pull-right">Adults: <?php echo $getBooking->Services->Service[$i]->Adults;?> Children: <?php echo $getBooking->Services->Service[$i]->Children;?></div>
                                                </li>
                                                <li>Duration
                                                    <div class="pull-right"><?php echo $getBooking->Services->Service[$i]->SCUqty;?> Nights</div>
                                                </li>
                                                <li class="totalpricee">Total price
                                                    <div class="pull-right"><span class="totalPrice"><?php echo $getBooking->Currency.' '.convertMoney($getBooking->Services->Service[$i]->LinePrice); ?></span></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                        }
                                        else if(strpos($Opt, "TP") OR strpos($Opt, "TD") OR strpos($Opt, "TA") OR strpos($Opt, "PK")){
                            ?>
                            <div class="col-md-7">
                                <div class="box-traveler">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h2>Booking Name</h2>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-1">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-xs-10">
                                                    <?php echo $getBooking->Name; ?>
                                                </div>
                                            </div>   
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h2>Agent Reference</h2>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-1">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-xs-10">
                                                    <?php
                                                        if(!empty($getBooking->AgentRef))
                                                        {
                                                            echo $getBooking->AgentRef;
                                                        }
                                                        else
                                                        {
                                                            echo "-";
                                                        }
                                                    ?>
                                                </div>
                                            </div>   
                                        </div> 
                                    </div> 
                                </div>
                                <div class="box-traveler">
                                    <div class="row">
                                        <div class="col-xs-12 mt20">
                                            <h2>Remarks</h2>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-xs-12">
                                             <p>
                                                 <?php
                                                    if(!empty($getBooking->Remarks))
                                                    { 
                                                        echo $getBooking->Remarks;
                                                    }
                                                    else{
                                                        echo "-";
                                                    }
                                                 ?>
                                             </p> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="box-traveler">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h2>Ground Transport</h2>
                                            <h3><?php echo $getBooking->Services->Service[$i]->SupplierName; ?></h3>
                                            <div class="image">
                                                <img src="http://ptc.xoloni.com/40/assets/images/pict-rincian-pemesanan.jpg" alt="Panorama Destination">
                                            </div> 
                                            <ul class="rincian-pemesanan">
                                                <?php
                                                    $checkIn = date('l, d F Y', strtotime($getBooking->Services->Service[$i]->Date));
                                                ?>
                                                <li>Date
                                                    <div class="pull-right"><?php echo $checkIn;?></div>
                                                </li>
                                                <li>Description
                                                    <div class="pull-right"><?php echo $getBooking->Services->Service[$i]->Description;?></div>
                                                </li>
                                                <li>Comment
                                                    <div class="pull-right"><?php echo $getBooking->Services->Service[$i]->Comment;?></div>
                                                </li>
                                                <li>Room Type
                                                    <div class="pull-right">
                                                        <?php
                                                            if($getBooking->Services->Service[$i]->RoomType == "SG")
                                                            {
                                                                echo "Single Room Type";
                                                            }
                                                            else if($getBooking->Services->Service[$i]->RoomType == "DB")
                                                            {
                                                                echo "Double Room Type";
                                                            }
                                                            else if($getBooking->Services->Service[$i]->RoomType == "TW")
                                                            {
                                                                echo "Twin Room Type";
                                                            }
                                                            else if($getBooking->Services->Service[$i]->RoomType == "TR")
                                                            {
                                                                echo "Triple Room Type";
                                                            }
                                                        ?>
                                                    </div>
                                                </li>
                                                <li>Lodging
                                                    <div class="pull-right">Adults: <?php echo $getBooking->Services->Service[$i]->Adults;?> Children: <?php echo $getBooking->Services->Service[$i]->Children;?>
                                                    </div>
                                                </li>
                                                <li>Pickup Time
                                                    <div class="pull-right">
                                                        <?php
                                                            if(!empty($getBooking->Services->Service[$i]->puTime) AND $getBooking->Services->Service[$i]->puTime != "0000")
                                                            {
                                                                echo convertTime($getBooking->Services->Service[$i]->puTime);
                                                            }
                                                            else
                                                            {
                                                                echo "-";
                                                            }
                                                        ?>
                                                    </div>
                                                </li>
                                                <li>Pickup Remark :
                                                    <div class="pull-right">
                                                        <?php
                                                            if(!empty($getBooking->Services->Service[$i]->puRemark))
                                                            {
                                                        ?>
                                                                <p style="border: 1px solid #a6a6a6;padding: .5em;text-align: justify;line-height: 22px;">
                                                        <?php
                                                                echo $getBooking->Services->Service[$i]->puRemark;
                                                            }
                                                            else
                                                            {
                                                                echo "-";
                                                            }
                                                        ?></p>
                                                    </div>
                                                </li>
                                                <li>Dropoff Time
                                                    <div class="pull-right">
                                                        <?php
                                                            if(!empty($getBooking->Services->Service[$i]->doTime) AND $getBooking->Services->Service[$i]->doTime != "0000" )
                                                            {
                                                                echo $getBooking->Services->Service[$i]->doTime;
                                                            }
                                                            else{
                                                                echo "-";
                                                            }
                                                        ?>
                                                    </div>
                                                </li>
                                                <li>Dropoff Remark
                                                    <div class="pull-right">
                                                        <?php
                                                            if(!empty($getBooking->Services->Service[$i]->doRemark)){
                                                        ?>
                                                                <p style="border: 1px solid #a6a6a6;padding: .5em;text-align: justify;line-height: 22px;">
                                                        <?php
                                                                echo $getBooking->Services->Service[$i]->doRemark;
                                                            }
                                                            else{
                                                                echo "-";
                                                            }
                                                        ?>
                                                    </div>
                                                </li>
                                                <li>Remarks
                                                    <div class="pull-right">
                                                        <?php
                                                            if(!empty($getBooking->Services->Service[$i]->Remarks)){
                                                                echo $getBooking->Services->Service[$i]->Remarks;
                                                            }
                                                            else{
                                                                echo "-";
                                                            }
                                                        ?>
                                                    </div>
                                                </li>

                                                <li>Duration
                                                    <div class="pull-right"><?php echo $getBooking->Services->Service[$i]->SCUqty;?> Days</div>
                                                </li>
                                                <li class="totalpricee">Total price
                                                    <div class="pull-right"><span class="totalPrice"><?php echo $getBooking->Currency.' '.convertMoney($getBooking->Services->Service[$i]->LinePrice); ?></span></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                        }
                                        else{
                            ?>
                                            <div class="col-md-7">
                                <div class="box-traveler">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h2>Booking Name</h2>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-1">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-xs-10">
                                                    <?php echo $getBooking->Name; ?>
                                                </div>
                                            </div>   
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h2>Agent Reference</h2>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-1">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-xs-10">
                                                    <?php
                                                        if(!empty($getBooking->AgentRef))
                                                        {
                                                            echo $getBooking->AgentRef;
                                                        }
                                                        else
                                                        {
                                                            echo "-";
                                                        }
                                                    ?>
                                                </div>
                                            </div>   
                                        </div> 
                                    </div> 
                                </div>
                                <div class="box-traveler">
                                    <div class="row">
                                        <div class="col-xs-12 mt20">
                                            <h2>Remarks</h2>
                                        </div>
                                    </div>
                                    <div class="row"> 
                                        <div class="col-xs-12">
                                             <p>
                                                 <?php
                                                    if(!empty($getBooking->Remarks))
                                                    { 
                                                        echo $getBooking->Remarks;
                                                    }
                                                    else{
                                                        echo "-";
                                                    }
                                                 ?>
                                             </p> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="box-traveler">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h2>Ground Transport</h2>
                                            <h3><?php echo $getBooking->Services->Service[$i]->SupplierName; ?></h3>
                                            <div class="image">
                                                <img src="http://ptc.xoloni.com/40/assets/images/pict-rincian-pemesanan.jpg" alt="Panorama Destination">
                                            </div> 
                                            <ul class="rincian-pemesanan">
                                                <?php
                                                    $checkIn = date('l, d F Y', strtotime($getBooking->Services->Service[$i]->Date));
                                                ?>
                                                <li>Date
                                                    <div class="pull-right"><?php echo $checkIn;?></div>
                                                </li>
                                                <li>Description
                                                    <div class="pull-right"><?php echo $getBooking->Services->Service[$i]->Description;?></div>
                                                </li>
                                                <li>Comment
                                                    <div class="pull-right"><?php echo $getBooking->Services->Service[$i]->Comment;?></div>
                                                </li>
                                                <li>Room Type
                                                    <div class="pull-right">
                                                        <?php
                                                            if($getBooking->Services->Service[$i]->RoomType == "SG")
                                                            {
                                                                echo "Single Room Type";
                                                            }
                                                            else if($getBooking->Services->Service[$i]->RoomType == "DB")
                                                            {
                                                                echo "Double Room Type";
                                                            }
                                                            else if($getBooking->Services->Service[$i]->RoomType == "TW")
                                                            {
                                                                echo "Twin Room Type";
                                                            }
                                                            else if($getBooking->Services->Service[$i]->RoomType == "TR")
                                                            {
                                                                echo "Triple Room Type";
                                                            }
                                                        ?>
                                                    </div>
                                                </li>
                                                <li>Lodging
                                                    <div class="pull-right">Adults: <?php echo $getBooking->Services->Service[$i]->Adults;?> Children: <?php echo $getBooking->Services->Service[$i]->Children;?>
                                                    </div>
                                                </li>
                                                <li>Pickup Time
                                                    <div class="pull-right">
                                                        <?php
                                                            if(!empty($getBooking->Services->Service[$i]->puTime) AND $getBooking->Services->Service[$i]->puTime != "0000")
                                                            {
                                                                echo convertTime($getBooking->Services->Service[$i]->puTime);
                                                            }
                                                            else
                                                            {
                                                                echo "-";
                                                            }
                                                        ?>
                                                    </div>
                                                </li>
                                                <li>Pickup Remark :
                                                    <div class="pull-right">
                                                        <?php
                                                            if(!empty($getBooking->Services->Service[$i]->puRemark))
                                                            {
                                                        ?>
                                                                <p style="border: 1px solid #a6a6a6;padding: .5em;text-align: justify;line-height: 22px;">
                                                        <?php
                                                                echo $getBooking->Services->Service[$i]->puRemark;
                                                            }
                                                            else
                                                            {
                                                                echo "-";
                                                            }
                                                        ?></p>
                                                    </div>
                                                </li>
                                                <li>Dropoff Time
                                                    <div class="pull-right">
                                                        <?php
                                                            if(!empty($getBooking->Services->Service[$i]->doTime) AND $getBooking->Services->Service[$i]->doTime != "0000" )
                                                            {
                                                                echo $getBooking->Services->Service[$i]->doTime;
                                                            }
                                                            else{
                                                                echo "-";
                                                            }
                                                        ?>
                                                    </div>
                                                </li>
                                                <li>Dropoff Remark
                                                    <div class="pull-right">
                                                        <?php
                                                            if(!empty($getBooking->Services->Service[$i]->doRemark)){
                                                        ?>
                                                                <p style="border: 1px solid #a6a6a6;padding: .5em;text-align: justify;line-height: 22px;">
                                                        <?php
                                                                echo $getBooking->Services->Service[$i]->doRemark;
                                                            }
                                                            else{
                                                                echo "-";
                                                            }
                                                        ?>
                                                    </div>
                                                </li>
                                                <li>Remarks
                                                    <div class="pull-right">
                                                        <?php
                                                            if(!empty($getBooking->Services->Service[$i]->Remarks)){
                                                                echo $getBooking->Services->Service[$i]->Remarks;
                                                            }
                                                            else{
                                                                echo "-";
                                                            }
                                                        ?>
                                                    </div>
                                                </li>

                                                <li>Duration
                                                    <div class="pull-right"><?php echo $getBooking->Services->Service[$i]->SCUqty;?> Days</div>
                                                </li>
                                                <li class="totalpricee">Total price
                                                    <div class="pull-right"><span class="totalPrice"><?php echo $getBooking->Currency.' '.convertMoney($getBooking->Services->Service[$i]->LinePrice); ?></span></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                        }
                                    }
                                }
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="news-letter-grid">
                                       <a href="member.php">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
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