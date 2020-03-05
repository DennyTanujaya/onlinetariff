<?php
    session_start();

    if(empty($_SESSION['name']))
    {
        header("location:login.php");
    }
    else
    {
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];

        $adult = $_POST['txtadult'];
        $children = $_POST['txtchildren'];
        $dateFrom = $_POST['txtdateFrom'];
        $roomType = $_POST['txtroomType'];
        $SCUqty = $_POST['txtscuQty'];
        $Opt = $_POST['txtOpt'];
        $total = $_POST['txtTotal'];
        $checkIN = $_POST['txtcheckIn'];
        $checkOut = $_POST['txtcheckOut'];
        $hotelName = $_POST['txtNameHotel'];
        $stars = $_POST['txtStar'];

        $title = $_POST['title'];
        $forename = $_POST['forename'];
        $surname = $_POST['surname'];
        $jumlah = count($title);

        if($children > 0 )
        {
            $titleC = $_POST['titleC'];
            $forenameC = $_POST['forenameC'];
            $surnameC = $_POST['surnameC'];
            $jumlahC = count($titleC);
        }

        if($adult == 1)
        {

        $xml_request = '<?xml version="1.0"?>'
            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
            .'<Request CompressReply="Y">'
            .'<AddServiceRequest>'
            .'<AgentID>'.$username.'</AgentID>'
            .'<Password>'.$password.'</Password>'
            .'<NewBookingInfo>'
            .'<Name>'.$title[0].' '.$forename[0].' '.$surname[0].'</Name>'
            .'<QB>B</QB>'
            .'</NewBookingInfo>'
            .'<Opt>'.$Opt.'</Opt>'
            .'<RateId>Default</RateId>'
            .'<DateFrom>'.$dateFrom.'</DateFrom>'
            .'<RoomConfigs><RoomConfig>'
            .'<Adults>'.$adult.'</Adults>'
            .'<RoomType>'.$roomType.'</RoomType>'
            .'<PaxList>'
                .'<PaxDetails>'
                .'<Title>'.$title[0].'</Title>'
                .'<Forename>'.$forename[0].'</Forename>'
                .'<Surname>'.$surname[0].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
            .'</PaxList></RoomConfig>'
            .'</RoomConfigs>'
            .'<SCUqty>'.$SCUqty.'</SCUqty>'
            .'</AddServiceRequest>'
            .'</Request>';
        }
        else if($adult == 2)
        {
            $xml_request = '<?xml version="1.0"?>'
            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
            .'<Request CompressReply="Y">'
            .'<AddServiceRequest>'
            .'<AgentID>'.$username.'</AgentID>'
            .'<Password>'.$password.'</Password>'
            .'<NewBookingInfo>'
            .'<Name>'.$title[0].' '.$forename[0].' '.$surname[0].'</Name>'
            .'<QB>B</QB>'
            .'</NewBookingInfo>'
            .'<Opt>'.$Opt.'</Opt>'
            .'<RateId>Default</RateId>'
            .'<DateFrom>'.$dateFrom.'</DateFrom>'
            .'<RoomConfigs><RoomConfig>'
            .'<Adults>'.$adult.'</Adults>'
            .'<RoomType>'.$roomType.'</RoomType>'
            .'<PaxList>'
                .'<PaxDetails>'
                .'<Title>'.$title[0].'</Title>'
                .'<Forename>'.$forename[0].'</Forename>'
                .'<Surname>'.$surname[0].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
                .'<PaxDetails>'
                .'<Title>'.$title[1].'</Title>'
                .'<Forename>'.$forename[1].'</Forename>'
                .'<Surname>'.$surname[1].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
            .'</PaxList></RoomConfig>'
            .'</RoomConfigs>'
            .'<SCUqty>'.$SCUqty.'</SCUqty>'
            .'</AddServiceRequest>'
            .'</Request>';
        }
        else if($adult == 3)
        {
            $xml_request = '<?xml version="1.0"?>'
            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
            .'<Request CompressReply="Y">'
            .'<AddServiceRequest>'
            .'<AgentID>'.$username.'</AgentID>'
            .'<Password>'.$password.'</Password>'
            .'<NewBookingInfo>'
            .'<Name>'.$title[0].' '.$forename[0].' '.$surname[0].'</Name>'
            .'<QB>B</QB>'
            .'</NewBookingInfo>'
            .'<Opt>'.$Opt.'</Opt>'
            .'<RateId>Default</RateId>'
            .'<DateFrom>'.$dateFrom.'</DateFrom>'
            .'<RoomConfigs><RoomConfig>'
            .'<Adults>'.$adult.'</Adults>'
            .'<RoomType>'.$roomType.'</RoomType>'
            .'<PaxList>'
                .'<PaxDetails>'
                .'<Title>'.$title[0].'</Title>'
                .'<Forename>'.$forename[0].'</Forename>'
                .'<Surname>'.$surname[0].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
                .'<PaxDetails>'
                .'<Title>'.$title[1].'</Title>'
                .'<Forename>'.$forename[1].'</Forename>'
                .'<Surname>'.$surname[1].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
                .'<PaxDetails>'
                .'<Title>'.$title[2].'</Title>'
                .'<Forename>'.$forename[2].'</Forename>'
                .'<Surname>'.$surname[2].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
            .'</PaxList></RoomConfig>'
            .'</RoomConfigs>'
            .'<SCUqty>'.$SCUqty.'</SCUqty>'
            .'</AddServiceRequest>'
            .'</Request>';
        }
        else if($adult == 1 AND $children == 1)
        {
            $xml_request = '<?xml version="1.0"?>'
            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
            .'<Request CompressReply="Y">'
            .'<AddServiceRequest>'
            .'<AgentID>'.$username.'</AgentID>'
            .'<Password>'.$password.'</Password>'
            .'<NewBookingInfo>'
            .'<Name>'.$title[0].' '.$forename[0].' '.$surname[0].'</Name>'
            .'<QB>B</QB>'
            .'</NewBookingInfo>'
            .'<Opt>'.$Opt.'</Opt>'
            .'<RateId>Default</RateId>'
            .'<DateFrom>'.$dateFrom.'</DateFrom>'
            .'<RoomConfigs><RoomConfig>'
            .'<Adults>'.$adult.'</Adults>'
            .'<RoomType>'.$roomType.'</RoomType>'
            .'<PaxList>'
                .'<PaxDetails>'
                .'<Title>'.$title[0].'</Title>'
                .'<Forename>'.$forename[0].'</Forename>'
                .'<Surname>'.$surname[0].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
            .'</PaxList></RoomConfig>'
                .'<RoomConfig>'
                .'<Adults>0</Adults>'
                .'<Children>'.$children.'</Children>'
                .'<RoomType>'.$RoomType.'</RoomType>'
                .'<PaxList>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[0].'</Title>'
                    .'<Forename>'.$forenameC[0].'</Forename>'
                    .'<Surname>'.$surnameC[0].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                .'</PaxList></RoomConfig>'
            .'</RoomConfigs>'
            .'<SCUqty>'.$SCUqty.'</SCUqty>'
            .'</AddServiceRequest>'
            .'</Request>';
        }
        else if($adult == 1 AND $children == 2)
        {
            $xml_request = '<?xml version="1.0"?>'
            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
            .'<Request CompressReply="Y">'
            .'<AddServiceRequest>'
            .'<AgentID>'.$username.'</AgentID>'
            .'<Password>'.$password.'</Password>'
            .'<NewBookingInfo>'
            .'<Name>'.$title[0].' '.$forename[0].' '.$surname[0].'</Name>'
            .'<QB>B</QB>'
            .'</NewBookingInfo>'
            .'<Opt>'.$Opt.'</Opt>'
            .'<RateId>Default</RateId>'
            .'<DateFrom>'.$dateFrom.'</DateFrom>'
            .'<RoomConfigs><RoomConfig>'
            .'<Adults>'.$adult.'</Adults>'
            .'<RoomType>'.$roomType.'</RoomType>'
            .'<PaxList>'
                .'<PaxDetails>'
                .'<Title>'.$title[0].'</Title>'
                .'<Forename>'.$forename[0].'</Forename>'
                .'<Surname>'.$surname[0].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
            .'</PaxList></RoomConfig>'
                .'<RoomConfig>'
                .'<Adults>0</Adults>'
                .'<Children>'.$children.'</Children>'
                .'<RoomType>'.$RoomType.'</RoomType>'
                .'<PaxList>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[0].'</Title>'
                    .'<Forename>'.$forenameC[0].'</Forename>'
                    .'<Surname>'.$surnameC[0].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[1].'</Title>'
                    .'<Forename>'.$forenameC[1].'</Forename>'
                    .'<Surname>'.$surnameC[1].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                .'</PaxList></RoomConfig>'
            .'</RoomConfigs>'
            .'<SCUqty>'.$SCUqty.'</SCUqty>'
            .'</AddServiceRequest>'
            .'</Request>';
        }
        else if($adult == 1 AND $children == 3)
        {
            $xml_request = '<?xml version="1.0"?>'
            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
            .'<Request CompressReply="Y">'
            .'<AddServiceRequest>'
            .'<AgentID>'.$username.'</AgentID>'
            .'<Password>'.$password.'</Password>'
            .'<NewBookingInfo>'
            .'<Name>'.$title[0].' '.$forename[0].' '.$surname[0].'</Name>'
            .'<QB>B</QB>'
            .'</NewBookingInfo>'
            .'<Opt>'.$Opt.'</Opt>'
            .'<RateId>Default</RateId>'
            .'<DateFrom>'.$dateFrom.'</DateFrom>'
            .'<RoomConfigs><RoomConfig>'
            .'<Adults>'.$adult.'</Adults>'
            .'<RoomType>'.$roomType.'</RoomType>'
            .'<PaxList>'
                .'<PaxDetails>'
                .'<Title>'.$title[0].'</Title>'
                .'<Forename>'.$forename[0].'</Forename>'
                .'<Surname>'.$surname[0].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
            .'</PaxList></RoomConfig>'
                .'<RoomConfig>'
                .'<Adults>0</Adults>'
                .'<Children>'.$children.'</Children>'
                .'<RoomType>'.$RoomType.'</RoomType>'
                .'<PaxList>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[0].'</Title>'
                    .'<Forename>'.$forenameC[0].'</Forename>'
                    .'<Surname>'.$surnameC[0].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[1].'</Title>'
                    .'<Forename>'.$forenameC[1].'</Forename>'
                    .'<Surname>'.$surnameC[1].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[2].'</Title>'
                    .'<Forename>'.$forenameC[2].'</Forename>'
                    .'<Surname>'.$surnameC[2].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                .'</PaxList></RoomConfig>'
            .'</RoomConfigs>'
            .'<SCUqty>'.$SCUqty.'</SCUqty>'
            .'</AddServiceRequest>'
            .'</Request>';
        }
        else if($adult == 2 && $children == 1)
        {
            $xml_request = '<?xml version="1.0"?>'
            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
            .'<Request CompressReply="Y">'
            .'<AddServiceRequest>'
            .'<AgentID>'.$username.'</AgentID>'
            .'<Password>'.$password.'</Password>'
            .'<NewBookingInfo>'
            .'<Name>'.$title[0].' '.$forename[0].' '.$surname[0].'</Name>'
            .'<QB>B</QB>'
            .'</NewBookingInfo>'
            .'<Opt>'.$Opt.'</Opt>'
            .'<RateId>Default</RateId>'
            .'<DateFrom>'.$dateFrom.'</DateFrom>'
            .'<RoomConfigs><RoomConfig>'
            .'<Adults>'.$adult.'</Adults>'
            .'<RoomType>'.$roomType.'</RoomType>'
            .'<PaxList>'
                .'<PaxDetails>'
                .'<Title>'.$title[0].'</Title>'
                .'<Forename>'.$forename[0].'</Forename>'
                .'<Surname>'.$surname[0].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
                .'<PaxDetails>'
                .'<Title>'.$title[1].'</Title>'
                .'<Forename>'.$forename[1].'</Forename>'
                .'<Surname>'.$surname[1].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
            .'</PaxList></RoomConfig>'
                .'<RoomConfig>'
                .'<Adults>0</Adults>'
                .'<Children>'.$children.'</Children>'
                .'<RoomType>'.$RoomType.'</RoomType>'
                .'<PaxList>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[0].'</Title>'
                    .'<Forename>'.$forenameC[0].'</Forename>'
                    .'<Surname>'.$surnameC[0].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                .'</PaxList></RoomConfig>'
            .'</RoomConfigs>'
            .'<SCUqty>'.$SCUqty.'</SCUqty>'
            .'</AddServiceRequest>'
            .'</Request>';
        }
        else if ($adult == 2 AND $children == 2) {
            $xml_request = '<?xml version="1.0"?>'
            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
            .'<Request CompressReply="Y">'
            .'<AddServiceRequest>'
            .'<AgentID>'.$username.'</AgentID>'
            .'<Password>'.$password.'</Password>'
            .'<NewBookingInfo>'
            .'<Name>'.$title[0].' '.$forename[0].' '.$surname[0].'</Name>'
            .'<QB>B</QB>'
            .'</NewBookingInfo>'
            .'<Opt>'.$Opt.'</Opt>'
            .'<RateId>Default</RateId>'
            .'<DateFrom>'.$dateFrom.'</DateFrom>'
            .'<RoomConfigs><RoomConfig>'
            .'<Adults>'.$adult.'</Adults>'
            .'<RoomType>'.$roomType.'</RoomType>'
            .'<PaxList>'
                .'<PaxDetails>'
                .'<Title>'.$title[0].'</Title>'
                .'<Forename>'.$forename[0].'</Forename>'
                .'<Surname>'.$surname[0].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
                .'<PaxDetails>'
                .'<Title>'.$title[1].'</Title>'
                .'<Forename>'.$forename[1].'</Forename>'
                .'<Surname>'.$surname[1].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
            .'</PaxList></RoomConfig>'
                .'<RoomConfig>'
                .'<Adults>0</Adults>'
                .'<Children>'.$children.'</Children>'
                .'<RoomType>'.$RoomType.'</RoomType>'
                .'<PaxList>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[0].'</Title>'
                    .'<Forename>'.$forenameC[0].'</Forename>'
                    .'<Surname>'.$surnameC[0].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[1].'</Title>'
                    .'<Forename>'.$forenameC[1].'</Forename>'
                    .'<Surname>'.$surnameC[1].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                .'</PaxList></RoomConfig>'
            .'</RoomConfigs>'
            .'<SCUqty>'.$SCUqty.'</SCUqty>'
            .'</AddServiceRequest>'
            .'</Request>';
        }
        else if ($adult == 2 AND $children == 3) {
            $xml_request = '<?xml version="1.0"?>'
            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
            .'<Request CompressReply="Y">'
            .'<AddServiceRequest>'
            .'<AgentID>'.$username.'</AgentID>'
            .'<Password>'.$password.'</Password>'
            .'<NewBookingInfo>'
            .'<Name>'.$title[0].' '.$forename[0].' '.$surname[0].'</Name>'
            .'<QB>B</QB>'
            .'</NewBookingInfo>'
            .'<Opt>'.$Opt.'</Opt>'
            .'<RateId>Default</RateId>'
            .'<DateFrom>'.$dateFrom.'</DateFrom>'
            .'<RoomConfigs><RoomConfig>'
            .'<Adults>'.$adult.'</Adults>'
            .'<RoomType>'.$roomType.'</RoomType>'
            .'<PaxList>'
                .'<PaxDetails>'
                .'<Title>'.$title[0].'</Title>'
                .'<Forename>'.$forename[0].'</Forename>'
                .'<Surname>'.$surname[0].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
                .'<PaxDetails>'
                .'<Title>'.$title[1].'</Title>'
                .'<Forename>'.$forename[1].'</Forename>'
                .'<Surname>'.$surname[1].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
            .'</PaxList></RoomConfig>'
                .'<RoomConfig>'
                .'<Adults>0</Adults>'
                .'<Children>'.$children.'</Children>'
                .'<RoomType>'.$RoomType.'</RoomType>'
                .'<PaxList>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[0].'</Title>'
                    .'<Forename>'.$forenameC[0].'</Forename>'
                    .'<Surname>'.$surnameC[0].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[1].'</Title>'
                    .'<Forename>'.$forenameC[1].'</Forename>'
                    .'<Surname>'.$surnameC[1].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[2].'</Title>'
                    .'<Forename>'.$forenameC[2].'</Forename>'
                    .'<Surname>'.$surnameC[2].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                .'</PaxList></RoomConfig>'
            .'</RoomConfigs>'
            .'<SCUqty>'.$SCUqty.'</SCUqty>'
            .'</AddServiceRequest>'
            .'</Request>';
        }
        else if ($adult == 3 AND $children == 1) {
            $xml_request = '<?xml version="1.0"?>'
            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
            .'<Request CompressReply="Y">'
            .'<AddServiceRequest>'
            .'<AgentID>'.$username.'</AgentID>'
            .'<Password>'.$password.'</Password>'
            .'<NewBookingInfo>'
            .'<Name>'.$title[0].' '.$forename[0].' '.$surname[0].'</Name>'
            .'<QB>B</QB>'
            .'</NewBookingInfo>'
            .'<Opt>'.$Opt.'</Opt>'
            .'<RateId>Default</RateId>'
            .'<DateFrom>'.$dateFrom.'</DateFrom>'
            .'<RoomConfigs><RoomConfig>'
            .'<Adults>'.$adult.'</Adults>'
            .'<RoomType>'.$roomType.'</RoomType>'
            .'<PaxList>'
                .'<PaxDetails>'
                .'<Title>'.$title[0].'</Title>'
                .'<Forename>'.$forename[0].'</Forename>'
                .'<Surname>'.$surname[0].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
                .'<PaxDetails>'
                .'<Title>'.$title[1].'</Title>'
                .'<Forename>'.$forename[1].'</Forename>'
                .'<Surname>'.$surname[1].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
                .'<PaxDetails>'
                .'<Title>'.$title[2].'</Title>'
                .'<Forename>'.$forename[2].'</Forename>'
                .'<Surname>'.$surname[2].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
            .'</PaxList></RoomConfig>'
                .'<RoomConfig>'
                .'<Adults>0</Adults>'
                .'<Children>'.$children.'</Children>'
                .'<RoomType>'.$RoomType.'</RoomType>'
                .'<PaxList>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[0].'</Title>'
                    .'<Forename>'.$forenameC[0].'</Forename>'
                    .'<Surname>'.$surnameC[0].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                .'</PaxList></RoomConfig>'
            .'</RoomConfigs>'
            .'<SCUqty>'.$SCUqty.'</SCUqty>'
            .'</AddServiceRequest>'
            .'</Request>';
        }
        else if ($adult == 3 AND $children == 2) {
            $xml_request = '<?xml version="1.0"?>'
            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
            .'<Request CompressReply="Y">'
            .'<AddServiceRequest>'
            .'<AgentID>'.$username.'</AgentID>'
            .'<Password>'.$password.'</Password>'
            .'<NewBookingInfo>'
            .'<Name>'.$title[0].' '.$forename[0].' '.$surname[0].'</Name>'
            .'<QB>B</QB>'
            .'</NewBookingInfo>'
            .'<Opt>'.$Opt.'</Opt>'
            .'<RateId>Default</RateId>'
            .'<DateFrom>'.$dateFrom.'</DateFrom>'
            .'<RoomConfigs><RoomConfig>'
            .'<Adults>'.$adult.'</Adults>'
            .'<RoomType>'.$roomType.'</RoomType>'
            .'<PaxList>'
                .'<PaxDetails>'
                .'<Title>'.$title[0].'</Title>'
                .'<Forename>'.$forename[0].'</Forename>'
                .'<Surname>'.$surname[0].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
                .'<PaxDetails>'
                .'<Title>'.$title[1].'</Title>'
                .'<Forename>'.$forename[1].'</Forename>'
                .'<Surname>'.$surname[1].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
                .'<PaxDetails>'
                .'<Title>'.$title[2].'</Title>'
                .'<Forename>'.$forename[2].'</Forename>'
                .'<Surname>'.$surname[2].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
            .'</PaxList></RoomConfig>'
                .'<RoomConfig>'
                .'<Adults>0</Adults>'
                .'<Children>'.$children.'</Children>'
                .'<RoomType>'.$RoomType.'</RoomType>'
                .'<PaxList>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[0].'</Title>'
                    .'<Forename>'.$forenameC[0].'</Forename>'
                    .'<Surname>'.$surnameC[0].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[1].'</Title>'
                    .'<Forename>'.$forenameC[1].'</Forename>'
                    .'<Surname>'.$surnameC[1].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                .'</PaxList></RoomConfig>'
            .'</RoomConfigs>'
            .'<SCUqty>'.$SCUqty.'</SCUqty>'
            .'</AddServiceRequest>'
            .'</Request>';
        }
        else if ($adult == 3 AND $children == 3) {
            $xml_request = '<?xml version="1.0"?>'
            .'<!DOCTYPE Request SYSTEM "hostConnect_3_10_480.dtd">'
            .'<Request CompressReply="Y">'
            .'<AddServiceRequest>'
            .'<AgentID>'.$username.'</AgentID>'
            .'<Password>'.$password.'</Password>'
            .'<NewBookingInfo>'
            .'<Name>'.$title[0].' '.$forename[0].' '.$surname[0].'</Name>'
            .'<QB>B</QB>'
            .'</NewBookingInfo>'
            .'<Opt>'.$Opt.'</Opt>'
            .'<RateId>Default</RateId>'
            .'<DateFrom>'.$dateFrom.'</DateFrom>'
            .'<RoomConfigs><RoomConfig>'
            .'<Adults>'.$adult.'</Adults>'
            .'<RoomType>'.$roomType.'</RoomType>'
            .'<PaxList>'
                .'<PaxDetails>'
                .'<Title>'.$title[0].'</Title>'
                .'<Forename>'.$forename[0].'</Forename>'
                .'<Surname>'.$surname[0].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
                .'<PaxDetails>'
                .'<Title>'.$title[1].'</Title>'
                .'<Forename>'.$forename[1].'</Forename>'
                .'<Surname>'.$surname[1].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
                .'<PaxDetails>'
                .'<Title>'.$title[2].'</Title>'
                .'<Forename>'.$forename[2].'</Forename>'
                .'<Surname>'.$surname[2].'</Surname>'
                .'<PaxType>A</PaxType>'
                .'</PaxDetails>'
            .'</PaxList></RoomConfig>'
                .'<RoomConfig>'
                .'<Adults>0</Adults>'
                .'<Children>'.$children.'</Children>'
                .'<RoomType>'.$RoomType.'</RoomType>'
                .'<PaxList>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[0].'</Title>'
                    .'<Forename>'.$forenameC[0].'</Forename>'
                    .'<Surname>'.$surnameC[0].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[1].'</Title>'
                    .'<Forename>'.$forenameC[1].'</Forename>'
                    .'<Surname>'.$surnameC[1].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                    .'<PaxDetails>'
                    .'<Title>'.$titleC[2].'</Title>'
                    .'<Forename>'.$forenameC[2].'</Forename>'
                    .'<Surname>'.$surnameC[2].'</Surname>'
                    .'<PaxType>C</PaxType>'
                    .'</PaxDetails>'
                .'</PaxList></RoomConfig>'
            .'</RoomConfigs>'
            .'<SCUqty>'.$SCUqty.'</SCUqty>'
            .'</AddServiceRequest>'
            .'</Request>';
        }

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
        $serviceProduct = $xml->AddServiceReply;
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
                                    <h3>Booking Refference : <span class="code-book"><?php echo $serviceProduct->Ref; ?></span></h3>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="footer-grid">
                                    <h3>Booking Code : <span class="code-book"><?php echo $serviceProduct->BookingId; ?></span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="box-traveler">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h2>Traveler Details</h2>
                                                </div>
                                            </div>
                                            <?php 
                                                for($i = 0; $i < $jumlah; $i++)
                                                {
                                            ?>
                                            <div class="row">
                                                <div class="col-xs-1">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-xs-10">
                                                    <?php echo $title[$i].' '.$forename[$i].' '.$surname[$i]; ?>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                                for($i = 0; $i < $jumlahC; $i++)
                                                {
                                            ?>
                                            <div class="row">
                                                <div class="col-xs-1">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-xs-10">
                                                    <?php echo $titleC[$i].' '.$forenameC[$i].' '.$surnameC[$i]; ?>
                                                </div>
                                            </div>
                                            <?php
                                                }
                                            ?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        <div class="col-md-5">
                                            <div class="box-traveler">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <h2>Hotel Choice</h2>
                                                        <h3><?php echo $hotelName; ?></h3>
                                                        <div class="p-right-price" style="padding: 1em 0;">
                                                            <?php
                                                                if(strpos($stars,"1 Star") !== false)
                                                                {
                                                                    echo '<span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
                                                                }
                                                                else if(strpos($stars,"2 Star") !== false)
                                                                {
                                                                    echo '<span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
                                                                }
                                                                else if(strpos($stars,"3 Star") !== false)
                                                                {
                                                                    echo '<span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
                                                                }
                                                                else if(strpos($stars,"4 Star") !== false)
                                                                {
                                                                    echo '<span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
                                                                }
                                                                else if(strpos($stars,"5 Star") !== false)
                                                                {
                                                                    echo '<span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
                                                                }
                                                            ?>
                                                        </div>
                                                        <img src="http://ptc.xoloni.com/40/assets/images/pict-rincian-pemesanan.jpg" alt="Panorama Destination">
                                                        <ul class="rincian-pemesanan">
                                                            <li>Check-in
                                                                <div class="pull-right"><?php echo $checkIN; ?></div>
                                                            </li>
                                                            <li>Check-out
                                                                <div class="pull-right"><?php echo $checkOut; ?></div>
                                                            </li>
                                                            <li>Room Type
                                                                <div class="pull-right"><?php echo $roomType; ?></div>
                                                            </li>
                                                            <li>Lodging
                                                                <div class="pull-right">Adults: <?php echo $adult;?> Children: <?php echo $children; ?></div>
                                                            </li>
                                                            <li>Duration
                                                                <div class="pull-right"><?php echo $SCUqty; ?> Nights</div>
                                                            </li>
                                                            <li class="totalpricee">Total price
                                                                <div class="pull-right"><span class="totalPrice"><?php echo $total; ?></span></div>
                                                            </li>
                                                        </ul>
                                                    </div>
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