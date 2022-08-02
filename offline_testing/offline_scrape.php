<?php
include "my_text.php";
$myfile_location = "all_activated_onus_for_test.txt";
$myfile = fopen($myfile_location,"r")or die("Unable to open the document");
$myfile_open = fread($myfile,filesize($myfile_location));
$line_pattern = '/<tr>.*?<\/tr>/s'; //regex pattern for isolating the line 
$elements_pattern = "/(?<=>).*(?=<)/"; //regex pattern for isolating the elements within the line 

//echo fread($myfile,filesize($myfile_location));



preg_match_all($line_pattern,$myfile_open,$matches1,PREG_PATTERN_ORDER);
for ($i = 0; $i < count($matches1[0]) ; $i++) {
    $line = $matches1[0][$i];
    preg_match_all($elements_pattern,$line ,$line_matches,PREG_PATTERN_ORDER);
    //for ($y = 0; $y < count($line_matches[0]) ; $y++) {
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
        //echo $PON;
        $Position = $line_matches[0][5];
        //echo $Position;
        $Status = $line_matches[0][6];
        //echo $Status;
        $MAC_ONU = $line_matches[0][7];
        //echo $MAC_ONU;
        $Transmit = $line_matches[0][8];
        //echo $Transmit;
        $Receive = $line_matches[0][9];
        //echo $Receive;
        $Down_speed = $line_matches[0][10];
        //echo $Down_speed;
        $Up_speed = $line_matches[0][11];
        //echo $Up_speed;
        $Distance = $line_matches[0][12];
        //echo $Distance;
        $Temperature = $line_matches[0][13];
        //echo $Temperature;

        $delimiter = "_"; //delimiter used for join

        $line_sequences_array = array($OLT,$GCOB,$PON,$Position,$Status,
        $MAC_ONU,$Transmit,$Receive,$Down_speed,
        $Up_speed,$Distance,$Temperature ); //array of my elements

        $my_join = implode($delimiter,$line_sequences_array);

        echo ($my_join."\r\n");
    //}
    //echo $line;
}

//fclose($myfile);


?>
