<?php
include "login_for_scrape.php";

$onus = array();

//match onu line
preg_match_all('/<tr>.*?<\/tr>/s',$answer,$match);
$onus['Line'] = $match[1];
print_r($onus['Line']);die;

$OLT = "";
$GCOB = "";
$PON = "";
$Position = "";
$Status = "";
$MAC_ONU = "";
$Transmit = "";
$Receive = "";
$Down_speed = "";
$Up_speed = "";
$Distance = "";
$Temperature = "";
?>
$answer