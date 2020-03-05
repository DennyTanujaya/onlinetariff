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
                        <li><a href="index.html">Accommodation</a></li>
                        <li class="active"><a href="#">Activities</a></li>
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
                        <div id="loginContainer"><a href="#" id="loginButton"><span>Logout</span></a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!--//header-->
    <!-- contact -->
    <div class="contact" style="margin: 4em 0;">
        <div class="container">
            <div class="map">
                <div class="banner-bottom-info" style="margin-bottom: 4em;text-align: center;">
                    <h3>How to find us</h3>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63466.83510656192!2d106.76851824346396!3d-6.173954855680067!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f6631a9ee469%3A0x634c03fe9ede6ad7!2sPanorama+Tours!5e0!3m2!1sen!2sid!4v1463036057537"></iframe>
            </div>
            <div class="contact-agileinfo">
                <div class="col-md-7 contact-right">
                    <form action="#" method="post">
                        <input type="text" name="Name" placeholder="Name" required="">
                        <input type="email" name="Email" placeholder="Email" required="">
                        <input type="text" name="Telephone" placeholder="Telephone" required="">
                        <textarea name="Message" placeholder="Message..." required=""></textarea>
                        <input type="submit" value="Submit">
                    </form>
                </div>
                <div class="col-md-5 contact-left">
                    <ul>
                        <li><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Jl. Tomang Raya no. 63 Jakarta, Indonesia
                        </li>
                        <li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> +62 21 5695 8585 // +62 21 5695 8586
                        </li>
                        <li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                            <a href="mailto:example@mail.com">info@panorama-destination.com</a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //contact -->
    <!-- footer -->
    <div class="footer">
        <!-- container -->
        <div class="container">
            <div class="footer-top-grids">
                <div class="footer-grids">
                    <div class="col-md-4 footer-grid">
                        <h4>Our Products</h4>
                        <ul>
                            <li><a href="service.php?type=AC">Activities</a></li>
                            <li><a href="service.php?type=TA">Arrival Transfer</a></li>
                            <li><a href="service.php?type=CR">Cruises</a></li>
                            <li><a href="service.php?type=PT">Day Tours</a></li>
                            <li><a href="service.php?type=TD">Departure Transfer</a></li>
                            <li><a href="service.php?type=GO">Golf</a></li>
                            <li><a href="service.php?type=TP">Ground Transport</a></li>
                            <li><a href="service.php?type=PK">Packages</a></li>
                            <li><a href="service.php?type=SO">Shocking Offers</a></li>
                            <li><a href="service.php?type=SP">Spa</a></li>
                            <li><a href="service.php?type=SI">Special Interest</a></li>
                            <li><a href="service.php?type=TW">Water Transport</a></li>
                            <li><a href="service.php?type=WH">Wedding & Honeymoon</a></li>
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
                            <li><a href="contact.php">Contact Us</a></li>
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