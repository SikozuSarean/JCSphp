<?php

//opening and reading the offline document
include "my_text.php";
include ("../functions.php");


$myfile_location = "all_activated_onus_for_test.txt";
$myfile = fopen($myfile_location,"r")or die("Unable to open the document");
$myfile_open = fread($myfile,filesize($myfile_location));

store_scrape($myfile_open);

?>