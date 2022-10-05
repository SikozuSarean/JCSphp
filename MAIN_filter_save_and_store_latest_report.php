#!/usr/bin/php -q
<?php
include "login_for_scrape.php";
$myfile = $answer;
include "functions_test.php";
$Time_stamp = date("Y.m.d H:i",time());

function main($myfile,$Time_stamp){
    store_scrape($myfile,$Time_stamp);
    store_scrape_store_filter($Time_stamp);
  }

main($myfile,$Time_stamp);
header("Location: database_filters/MAIN_filter_new.php"); //redirects to the filter page

?>
