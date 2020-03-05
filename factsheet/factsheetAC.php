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
        $optionProduct = $xml->OptionInfoReply;
        $optXml = $xml->xpath("//Opt");

        $xml_requestPrices = '<?xml version="1.0"?>'
            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
            .'<Request CompressReply="Y">'
            .'<SupplierInfoRequest>'
            .'<AgentID>'.$username.'</AgentID>'
            .'<Password>'.$password.'</Password>'
            .'<SupplierCode>'.$code.'</SupplierCode>'
            .'</SupplierInfoRequest>'
            .'</Request>';

        $urls = "http://59.153.23.26:8080/iComLive/servlet/conn";
            
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
                echo $option->Supplier->Name; echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                $star = $optionProduct->Option->OptGeneral->ClassDescription;
                if(strpos($star,"3 Star") !== false)
                {
                    echo '<img src="../image/3-star.jpg">';
                }
                else if(strpos($star,"4 Star") !== false)
                {
                    echo '<img src="../image/4-star.jpg">';
                }
                else if(strpos($star,"5 Star") !== false)
                {
                    echo '<img src="../image/5-star.jpg">';
                }
                echo '<br />'.$option->Supplier->Address1.', '.$option->Supplier->Address2.', '.$option->Supplier->Address3.', '.$option->Supplier->Address4.', '.$option->Supplier->Address5.', '.$option->Supplier->PostCode;
            ?>
        </div>
        <div style="padding-left: 30px; width: 700px;padding-top: 10px;">
            <div style="width: 200px">
                <img width="200" src="../images/rafting.jpg" alt="" />
            </div>
            <?php
                    for($j = 0; $j < 6; $j++)
                    {
                        if($option->Supplier->SupplierNotes->SupplierNote[$j]->NoteCategory == 'FSS')
                        {
            ?>
            <div style="width: 700px;">
                <h3>Overview</h3>
                <?php
                            $overview = explode("OVERVIEW:",$option->Supplier->SupplierNotes->SupplierNote[$j]->NoteText);
                            echo $overview[1];
                        }
                    }
                ?>
            </div>
        </div>
        <div style="padding-left:30px;width: 700px;padding-top: 10px;">
            <div style="float: left; width: 700px;">
                <h3>Amenities</h3>
                <ul>
                    <?php
                        $amenity = count($option->Supplier->Amenities->Amenity);
                        for($j = 0; $j < $amenity; $j++)
                        {
                            echo '<li>'.$option->Supplier->Amenities->Amenity[$j]->AmenityDescription.'</li>';
                        }
                    ?>
                </ul>
            </div>
            <?php
                for($j = 0; $j < 6; $j++)
                {
                    if($option->Supplier->SupplierNotes->SupplierNote[$j]->NoteCategory == 'GPO')
                    {
            ?>
            <div style="float: right; width: 700px; padding-top: 10px;">
                <h3>Group Policy</h3>
                <ul>
                    <?php
                        $grup = explode("GROUP POLICY:",$option->Supplier->SupplierNotes->SupplierNote[$j]->NoteText);
                        $grupLi = explode("· ",$grup[1]);
                        for($i=0;$i<count($grupLi);$i++)
                        {
                            echo '<li>'.$grupLi[$i].'</li>';
                        }
                    }
                }
                    ?>
                </ul>
            </div>
        </div>
        <div style="padding-left: 30px;width: 700px; padding-top: 10px;">
            <?php
                for($j = 0; $j < 6; $j++)
                {
                    if($option->Supplier->SupplierNotes->SupplierNote[$j]->NoteCategory == 'HNB')
                    {
            ?>
            <div style="float: left;width: 700px;padding-top: 10px;">
                <h3>Honeymoon Policy</h3>
                <ul>
                    <?php
                        $Honeymoon = explode("HONEYMOON BENEFIT:",$option->Supplier->SupplierNotes->SupplierNote[$j]->NoteText);
                        $HoneymoonLi = explode("·  ", $Honeymoon[1]);
                        for($i=0;$i<count($HoneymoonLi);$i++)
                        {
                            echo '<li>'.$HoneymoonLi[$i].'</li>';
                        }
                    }
                }
                    ?>
                </ul>
            </div>
            <?php
                for($j = 0; $j < 6; $j++)
                {
                    if($option->Supplier->SupplierNotes->SupplierNote[$j]->NoteCategory == 'GCP')
                    {
            ?>
            <div style="width: 500px;padding-top: 10px;">
                <h3>Cancelation Policy</h3>
                    <?php
                        $pisah = str_replace("CANCELLATION POLICY: Low Season : ", " ", $option->Supplier->SupplierNotes->SupplierNote[$j]->NoteText);
                        $cancelHigh = explode("High Season :",$pisah);
                        $cancelPeak = explode("Peak Season :",$cancelHigh[1]);
                        $cancelLiLow = explode("·   ", $cancelHigh[0]);
                        $cancelLiHigh = explode("·  ", $cancelPeak[0]);
                        $cancelLiPeak = explode("·  ", $cancelPeak[1]);
                                                            
                        echo '<div style="width: 500px;padding-top: 10px;"><b>Low Season</b>';
                        for($i=0;$i<count($cancelLiLow);$i++)
                        {
                            echo '<ul><li>'.$cancelLiLow[$i].'</li></ul>';
                        }
                        echo '</div><div style="width: 500px;padding-top: 10px;"><b>High Season</b>';
                        for($i=0;$i<count($cancelLiHigh);$i++)
                        {
                            echo '<ul><li>'.$cancelLiHigh[$i].'</li></ul>';
                        }
                        echo '</div><div style="width: 500px;padding-top: 10px;"><b>Peak Season</b>';
                        for($i=0;$i<count($cancelLiPeak);$i++)
                        {
                            echo '<ul><li>'.$cancelLiPeak[$i].'</li></ul>';
                        }
                        echo '</div>';
                    }
                }
                    ?>
            </div>
        </div>
        <div style="padding-left: 30px;width: 700px;height: 400px; padding-top: 10px;">
            <?php echo $option->Supplier->Address1.', '.$option->Supplier->Address2.', '.$option->Supplier->Address3.', '.$option->Supplier->Address4.', '.$option->Supplier->Address5.', '.$option->Supplier->PostCode; ?>
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
$pdf->Output('Factsheet.pdf', 'D');
?>