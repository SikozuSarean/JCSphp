<?php
include "../functions_test.php";
include "../login_for_scrape.php";
$Time_stamp = date("Y.m.d H:i",time());
$myfile = $answer;
function main($myfile,$Time_stamp){
    store_scrape($myfile,$Time_stamp);
    store_scrape_store_filter($Time_stamp);
    
  }

main($myfile,$Time_stamp);
?>
