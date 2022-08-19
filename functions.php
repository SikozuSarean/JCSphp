<?php


function scrape_function($scrape_target) {
    //the regex patterns
    $line_pattern = '/<tr>.*?<\/tr>/s'; //regex pattern for isolating the line 
    $elements_pattern = "/(?<=>).*(?=<)/"; //regex pattern for isolating the elements within the line 
    $Time_stamp = date("Y.m.d H:i",time());
    preg_match_all($line_pattern,$scrape_target,$matches1,PREG_PATTERN_ORDER);
    for ($i = 1; $i < count($matches1[0]) ; $i++) {
        $line = $matches1[0][$i];
        preg_match_all($elements_pattern,$line ,$line_matches,PREG_PATTERN_ORDER);
        ///echo ($line_matches[0][1]);
        //$Id = $line_matches[0][0];
        ////echo $Id;
        $OLT = $line_matches[0][1];
        //echo $OLT;
        //$Index = $line_matches[0][2];
        ////echo $Index;
        $GCOB = $line_matches[0][3];
        //echo $GCOB;
        $PON = $line_matches[0][4];
        $PON_formated = sprintf('%02d',$PON);
        //echo $PON_formated;
        $Position = $line_matches[0][5];
        $Position_formated = sprintf('%03d',$Position);
        //echo $Position_formated;
        $Status = $line_matches[0][6];
        //echo $Status;
        $MAC_ONU = $line_matches[0][7];
        //echo $MAC_ONU;
        $Transmit = $line_matches[0][8];
        $Transmit = str_replace("<span class='error'>","",$Transmit);
        //echo $Transmit;
        $Receive = $line_matches[0][9];
        $Receive = str_replace("<span class='error'>","",$Receive);
        //echo $Receive;
        $Down_speed = $line_matches[0][10];
        //echo $Down_speed;
        $Up_speed = $line_matches[0][11];
        //echo $Up_speed;
        $Distance = $line_matches[0][12];
        //echo $Distance;
        $Temperature = $line_matches[0][13];
        $Temperature_cleaned = str_replace("&deg;C","",$Temperature);
        //echo $Temperature;

        $delimiter = "_"; //delimiter used for join

        $line_sequences_array = array(
            $OLT,
            $GCOB,
            $PON_formated,
            $Position_formated,
            $Status,
            $MAC_ONU,
            $Transmit,
            $Receive,
            $Down_speed,
            $Up_speed,
            $Distance,
            $Temperature_cleaned,
            $Time_stamp ); //array of my elements

        //$error_cleanup = str_replace("<span class='error'>","",$line_sequences_array);
        
        $my_join = implode($delimiter,$line_sequences_array);
        echo ($my_join."<br>");
        //}
        //echo $line;
    }
}

function store_scrape($scrape_target){
    include "db.php";
    include "secu_data.php";
    $mysqli = $conn;
    //echo 'Connected successfully to mySQL. <BR>'; 

    $mysqli->select_db($db_name_toni);
    //echo ("Selected the $db_name_toni database ");
    //echo 'Connected successfully to mySQL. <BR>'; 
    if (!$mysqli) { 
        die('Could not connect'); 
    } 
    //the regex patterns
    $line_pattern = '/<tr>.*?<\/tr>/s'; //regex pattern for isolating the line 
    $elements_pattern = "/(?<=>).*(?=<)/"; //regex pattern for isolating the elements within the line 
    $Time_stamp = date("Y.m.d H:i",time());
    preg_match_all($line_pattern,$scrape_target,$matches1,PREG_PATTERN_ORDER);
    for ($i = 1; $i < count($matches1[0]) ; $i++) {
        $line = $matches1[0][$i];
        preg_match_all($elements_pattern,$line ,$line_matches,PREG_PATTERN_ORDER);
        ///echo ($line_matches[0][1]);
        //$Id = $line_matches[0][0];
        ////echo $Id;
        $OLT = $line_matches[0][1];
        //echo $OLT;
        //$Index = $line_matches[0][2];
        ////echo $Index;
        $GCOB = $line_matches[0][3];
        //echo $GCOB;
        $PON = $line_matches[0][4];
        $PON = sprintf('%02d',$PON);
        //echo $PON_formated;
        $Position = $line_matches[0][5];
        $Position = sprintf('%03d',$Position);
        //echo $Position_formated;
        $Status = $line_matches[0][6];
        //echo $Status;
        $MAC_ONU = $line_matches[0][7];
        //echo $MAC_ONU;
        $Transmit = $line_matches[0][8];
        $Transmit = str_replace("<span class='error'>","",$Transmit);
        //echo $Transmit;
        $Receive = $line_matches[0][9];
        $Receive = str_replace("<span class='error'>","",$Receive);
        //echo $Receive;
        $Down_speed = $line_matches[0][10];
        //echo $Down_speed;
        $Up_speed = $line_matches[0][11];
        //echo $Up_speed;
        $Distance = $line_matches[0][12];
        if (empty($Distance)) {
            $Distance = 0;
          }  else {
                $Distance;
            }
        //echo $Distance;
        $Temperature = $line_matches[0][13];
        $Temperature = str_replace("&deg;C","",$Temperature);
        //echo $Temperature;

        $query = "INSERT INTO `attenuation_report` (
            `OLT`, `GCOB`, `PON`, `Position`, `Status`, `MAC_ONU`, `Transmit`, `Receive`,
            `Down_speed`, `Up_Speed`, `Distance`, `Temperature`, `Time_stamp`)
        VALUES (
            '$OLT', '$GCOB', '$PON', '$Position', '$Status', '$MAC_ONU', '$Transmit', '$Receive', 
            '$Down_speed', '$Up_speed', '$Distance', '$Temperature', '$Time_stamp'
            )";
        $qq = array($OLT, $GCOB, $PON, $Position, $Status, $MAC_ONU, $Transmit, $Receive, $Down_speed, $Up_Speed, $Distance, $Temperature, $Time_stamp);

        if ($result = $mysqli->query($query)) {
            // echo "<p>You have successfully entered $qq[5] and all the asociated data into the database.</P>";
        }
        else
        {
            echo "Error entering $qq into database: " . $mysqli->error."<br>";
        }

    }
$mysqli->close();
echo "The attenuation report marked with $Time_stamp have been successfully runned and stored into the database. <br>
To vew $Time_stamp and all the other reports, please click on the fallowing link: <br>
<h1><a href='database_filters/show_database_by_date_script_view.php'>show_database_by_date_script </a></h1>";
}
?>