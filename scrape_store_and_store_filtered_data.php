<?php
include "login_for_scrape.php";
include ("functions.php");

$myfile = $answer;

store_scrape($myfile);

include_once('database_filters/MAIN_filter_save_and_store_latest_report.php');

?>
