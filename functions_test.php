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

// $Time_stamp = date("Y.m.d H:i",time()); //global variable used in 2 functions store_scrape and store_scrape_store_filter


function store_scrape($scrape_target,$Time_stamp){
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
    // global $Time_stamp;
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
            header("Location: database_filters/MAIN_filter.php"); //redirects to the filter page
        }
        else
        {
            echo "Error entering $qq into database: " . $mysqli->error."<br>";
        }

    }
// echo "
// The attenuation report marked with $Time_stamp was successfully run and stored in the database. 
// To view $Time_stamp and all the other reports, please click on the following link: <br>
// <h1><a href='database_filters/MAIN_filter.php'>Back to the main page, click me! </a></h1>";
}

function store_scrape_store_filter($Time_stamp){
    include "../secu_data.php";
    $mysqli = new PDO("mysql:host=$hostname_name_toni;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);
    // global $Time_stamp;
    $query = "INSERT IGNORE INTO `MAIN_filter`
    (
        `Time_stamp`,
        `Status_0`,
        `Status_4`,
        `Recieve_smallest`,
        `MAC_ONU_duplicates`,
        `MAC_ONU_distinct`,
        `Time_stamp_distinct`,
        `Status_2`,
        `Status_3`,
        `Status_abnormal`
    ) WITH CTE_all as
    (SELECT *
    FROM attenuation_report
    WHERE Time_stamp = '$Time_stamp'
    )
    SELECT ar.Time_stamp,
    COUNT(zero_status.Status) AS zero_status,
    COUNT(four_status.Status) AS four_status,
    COUNT(smallest_power.Receive) AS smallest_power,
    COUNT(ar.MAC_ONU)- COUNT(DISTINCT ar.MAC_ONU) AS count_duplicates,
    COUNT(DISTINCT(ar.MAC_ONU)) AS count_distinct_mac_onu,
    COUNT(ar.Time_stamp) AS count_time_stamp,
    COUNT(two_status.Status) AS two_status,
    COUNT(three_status.Status) AS three_status,
    COUNT(other_status.Status) AS other_status
    FROM CTE_all ar 
    LEFT JOIN (
      SELECT ar2.Crt, ar2.Time_stamp, Status
      FROM CTE_all ar2 
      WHERE ar2.Status = 0
    ) zero_status ON zero_status.Crt = ar.Crt
    LEFT JOIN (
      SELECT ar3.Crt, ar3.Time_stamp, ar3.Status
      FROM CTE_all ar3 
      WHERE ar3.Status = 4
    ) four_status ON four_status.Crt = ar.Crt
    LEFT JOIN (
      SELECT ar4.Crt, ar4.Time_stamp, ar4.Receive
      FROM CTE_all ar4 
      WHERE ar4.Receive < -27.00
    ) smallest_power ON smallest_power.Crt = ar.Crt
    LEFT JOIN (
      SELECT ar5.Crt, ar5.Time_stamp, ar5.Status
      FROM CTE_all ar5
      WHERE ar5.Status = 2
    ) two_status ON two_status.Crt = ar.Crt
    LEFT JOIN (
      SELECT ar6.Crt, ar6.Time_stamp, ar6.Status
      FROM CTE_all ar6
      WHERE ar6.Status = 3
    ) three_status ON three_status.Crt = ar.Crt
    LEFT JOIN (
      SELECT ar7.Crt, ar7.Time_stamp, ar7.Status
      FROM CTE_all ar7
      WHERE ar7.Status NOT IN (0,1,2,3,4)
    ) other_status ON other_status.Crt = ar.Crt
    GROUP BY ar.Time_stamp
    ORDER BY ar.Time_stamp DESC;";
    
    if ($result = $mysqli->query($query)) {
      header("Location: MAIN_filter_new.php"); //redirects to the filter page
    }
    else
    {
      echo "<p>Error </p>" . printf("Errormessage: %s\n", $mysqli->error);
      echo $query;
    }
}
//  this fallowing function logs in to the main table
//  and filters all its content
//  then saves in to the filter table, ignores duplicates entry

// function test1($my_target){
//   $another_variable = $my_target + 1;
//   if ($another_variable = 2)
//     return true;
//     echo "another_variable = $another_variable"; 
// }

?>