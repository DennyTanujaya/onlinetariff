<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Online Tariff</title>
    <link rel="icon" href="http://www.panorama-destination.com/wp-content/uploads/2017/07/favico.png">
    <link href="css/login.css" type="text/css" rel="stylesheet" media="all">
    <!-- fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,700,500italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
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
</head>

<body>
    <div class="main">
        <h1><img src="images/logo.png" alt="" /></h1>
        <div class="main-w3lsrow">
            <!-- login form -->
            <div class="login-form login-form-left">
                <div class="agile-row">
                    <h2>Online Tariff Login Form</h2>
                    <div class="login-agileits-top">
                        <form action="processLogin.php" method="post">
                            <p>Location</p>
                            <select name="loc" required="">
                                <option value="Indonesia">Indonesia</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Test">Test</option>
                            </select>
                            <p>User Name </p>
                            <input type="text" class="name" name="txtUsername" required="" />
                            <p>Password</p>
                            <input type="password" class="password" name="txtPassword" required="" />
                            <label class="anim">
                                <input type="checkbox" class="checkbox">
                                <span> Remember me ?</span>
                            </label>
                            <input type="submit" value="Login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- copyright -->
        <div class="copyright">
            <p>Copyright © 2017 Panorama Destination, Tbk. All rights reserved.</p>
        </div>
        <!-- //copyright -->
    </div>
    <!-- //main -->
</body>

</html>