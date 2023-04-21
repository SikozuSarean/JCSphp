<?php

include "secu_data.php";

$mysqli = new PDO("mysql:host=$hostname_name_toni;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);

$random_id = rand(230,170844);
$random_contract = rand(123000321,999000999);
$random_terminated = rand(0,1);
$package_array = array("FIBERLINK NET 200 - 6 MONTHS COMMITMENT", 
"FIBERLINK NET 100 - 1 YEAR COMMITMENT", "FIBERLINK NET 100 - 6 MONTHS COMMITMENT", 
"FIBERLINK NET 600 - 6 MONTHS COMMITMENT", "FIBERLINK NET 200 - 1 YEAR COMMITMENT", 
"FIBERLINK NET 400 - 6 MONTH COMMITMENT", "FIBERLINK NET 600 - 1 YEAR COMMITMENT", 
"FIBER LINK 2 M", "FIBERLINK NET 400 - 1 YEAR COMMITMENT", "FIBER LINK 2 YEARLY", 
"FIBERLINK NET 1000 - 6 MONTHS COMMITMENT", "BUSINESS - FIBERLINK NET 200 - 1 YEAR COMMITMENT", 
"BUSINESS - FIBERLINK NET 600 - 1 YEAR COMMITMENT", "FIBERLINK NET 1000 -PAYD- 2 YEAR", 
"FIBERLINK NET 400 - 1 YEAR COMMITMEN", "FIBERLINK NET 400 - 6 MONTHS COMMITMENT", 
"FIBERLINK NET 1000 - 6 MONTH COMMITMENT", "BUSINESS - FIBERLINK NET 100 - 1 YEAR COMMITMENT", 
"FIBERLINK NET 1000 - 1 YEAR COMMITMENT", "TRC 100 YEARLY", "VIP 50 M", "VIP 1000M", 
"FIBER LINK 5 YEARLY", "TRC 400 YEARLY", "VIP 100M", "FIBERLINK NET 1000 - 1 YEAR COMMITMEN", 
"FIBERLINK NET 100 -PAYD- 2 YEAR", "FIBERLINK NET 400 -PAYD- 2 YEAR", "KHCC 600 M", 
"BUSINESS - FIBERLINK NET 200- 6 MONTHS COMMITMENT", "BUSINESS - FIBERLINK NET 1000 - 1 YEAR COMMITMENT", 
"BUSINESS - FIBERLINK NET 400 - 1 YEAR COMMITMENT", "VIP 2 M", "FIBERLINK NET 100 - 3 MONTHS COMMITMENT", 
"BUSINESS - FIBERLINK NET 1000 - 6 MONTHS COMMITMENT", "FIBERLINK NET 200 -PAYD- 2 YEAR", 
"FIBERLINK NET 200 - 3 MONTHS COMMITMENT", "BUSINESS - FIBERLINK NET 400- 6 MONTHS COMMITMENT", 
"KHCC 200 M", "BUSINESS - FIBERLINK NET 100- 6 MONTHS COMMITMENT", "KHCC 400 M");
$random_package = array_rand($package_array,3);
$random_package_result = $package_array[$random_package[0]]; //sa imi bag pl daca inteleg cum functioneaza array_Rand in php
$random_location = rand(101001000001,107007999999);
$random_onu_id = rand(1234,99999);
$random_mac = strtoupper(implode(':', str_split(substr(md5(mt_rand()), 0, 12), 2)));
$random_mac_onu = "FH:TT:" . strtoupper(substr(implode(':', str_split(substr(md5(mt_rand()), 0, 12), 2)),6));
$random_ip = long2ip(rand(0,4294967295));
$Time_stamp = date("Y.m.d H:i",time());

$query = "INSERT INTO `apartments_report` (
    `id`, `contract_nummber`, `is_terminated`, `package`, `location_code`, `onu_id`, `MAC`,
    `MAC_ONU`, `IP`, `bridge`, `IP_fix`, `ONU_status`, `port`, `frontend_pon`, `odf_port`, `link`, `Time_stamp`)
VALUES (
    '$random_id', '$random_contract', '$random_terminated', '$random_package_result', '$random_location',
    '$random_onu_id', '$random_mac', '$random_mac_onu', '$random_ip',
    '0', '0', 'activated', '99', 'FH5-13-15', '101R01L06 50', 'None', '$Time_stamp'
    )";


if ($result = $mysqli->query($query)) {
    echo "Succes entering $query";
}
else
{
    echo "Error entering $query into database: " . $mysqli->error."<br>";
}

$mysqli->close();
//include 'footer.php';
?>