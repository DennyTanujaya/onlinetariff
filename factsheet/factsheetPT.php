<?php
    session_start();
    ob_start();
    error_reporting(1);
    ini_set('display_errors',1);
    
    if(empty($_SESSION['name']))
    {
        header("location:../login.php");
    }
    else
    {
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];

        $opt = $_GET['opt'];
        $code = substr($opt, 5, 6);//supplier code

        $xml_request = '<?xml version="1.0"?>'
            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
            .'<Request CompressReply="Y">'
            .'<OptionInfoRequest>'
                .'<AgentID>'.$username.'</AgentID>'
                .'<Password>'.$password.'</Password>'
                .'<Opt>'.$opt.'</Opt>'
                .'<Info>GMFT</Info>'
            .'</OptionInfoRequest>'
            .'</Request>';

        $url = "http://59.153.23.26:8080/iComLive/servlet/conn";
            
        $option = array(
            CURLOPT_RETURNTRANSFER => TRUE,                         // return web page
            CURLOPT_HEADER => FALSE,                                // don't return header
            CURLOPT_POSTFIELDS => $xml_request,                     // POST XML Request
            CURLOPT_HTTPHEADER => array('Content-Type: text/xml'),  // Sent HEADER XML
            CURLOPT_URL => $url
        );

        //open connection
        $ch = curl_init();
        curl_setopt_array($ch, $option);
            
        $data = curl_exec($ch);

        $uncompressed = gzdecode($data);


        $xml = simplexml_load_string($uncompressed);
        $option = $xml->OptionInfoReply;

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
        $pisah6 = explode("·   ", $pisah5[1]);
        $pisah4 = explode("·   ", $pisah3i[0]);
        $pisah8 = explode("·   ", $pisah5e[0]);
        $pisah7 = explode("·   ", $pisah10[0]);
        $pisah9 = explode("·   ", $pisah10[1]);
        $dayPisah = explode("Day", $pisah2[0]);
    }
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
    <div style="background-color:#ffffff;width: 700px; height: 800px;"> 
        <div style="padding-left: 30px;"> 
            <img style="display:block;" width="230" height="64" src="http://www.panorama-destination.com/wp-content/uploads/2016/08/Logo-Panorama.png" alt="" />
        </div>
        <div style="padding-left: 30px;padding-top: 10px;">
            <?php
                echo '<b>'.$option->Option->OptGeneral->Description.'</b>';
                echo '<br />'.$option->Option->OptGeneral->Address1.','.$option->Option->OptGeneral->Address3.','.$option->Option->OptGeneral->Address5.','.$option->Option->OptGeneral->PostCode;
            ?>
        </div>
        <div style="padding-left: 30px; width: 700px;padding-top: 10px;">
            <div style="width: 200px">
                <img width="200" src="../images/rafting.jpg" alt="" />
            </div>
            <?php
                if($highlight == ''){
                    echo '<h2>Highlight</h2>';
                    for($i = 1; $i < count($highlight); $i++)
                    {
            ?>
                        <ul>
                            <li><?php echo $highlight[$i]; ?></li>
                        </ul>
            <?php   }
                }  
                if(!empty($pisah1[0]))
                {
            ?>
            <div style="width: 700px;">
                <h3>What to expect</h3>
                <p align="justify"><?php echo $pisah1[0];?></p>
            </div>
            <?php 
                }
                if(!empty($dayPisah))
                {
            ?>
            <div style="width: 700px;">
                <h3>What you will do</h3>
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
                <span><b>Day <?php echo $i;?></b></span>
                <p><?php echo $day2[1]; ?></p>
                <?php }
                } ?>
            </div>

            
        </div>
        <!--
        <div style="padding-left:30px;width: 700px;">
            <div style="float: left; width: 700px;">
                <h3>End Of Panorama Destination's Service</h3>
                <?php
                    if(count($pisah4) > 0)
                    { 
                ?>
                <h4><?php echo "Our '".$option->Option->OptGeneral->Description."' package includes:"; ?></h4>
                <ul>
                <?php
                    $jumlahPackageInclusive = count($pisah4);   
                    for($i=1;$i<$jumlahPackageInclusive;$i++)
                    {
                        echo '<li>'.$pisah4[$i].'</li>';
                 
                    }
                    echo '</ul>';
                    }
                    if(count($pisah8) > 0)
                    {
                ?>
                        <h6><?php echo "Our '".$option->Option->OptGeneral->Description."' package does NOT includes:"; ?></h6>
                        <ul>
                <?php
                        $jumlahPackageExclusive = count($pisah8);   
                        for($i=1;$i<$jumlahPackageExclusive;$i++)
                        {
                ?>
                            <li><?php echo $pisah8[$i]; ?></li>
                <?php }
                    echo '</ul>';
                }?>
            </div>
            <?php
                if(count($pisah7) > 0)
                {
            ?>
            <div style="float: right; width: 700px; padding-top: 10px;">
                <h3>Good to know</h3>
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
        <div style="padding-left: 30px;width: 700px; padding-top: 10px;">
            <?php
                if(count($pisah9) > 0)
                {
            ?>
            <div style="float: left;width: 700px;padding-top: 10px;">
                <h3>Terms & Conditions</h3>
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
    -->
        <div style="padding-left: 30px;width: 700px;height: 400px; padding-top: 10px;">
            <?php echo $option->Option->OptGeneral->Address1.', '.$option->Option->OptGeneral->Address3.','.$option->Option->OptGeneral->Address5.','.$option->Option->OptGeneral->PostCode; ?>
            Google Maps
        </div>
    </div>
</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();
        
require_once('html2pdf/html2pdf.class.php');
$pdf = new HTML2PDF('P','A4');
$pdf->WriteHTML($html);
$pdf->Output('FactsheetPackages.pdf', 'D');
?>