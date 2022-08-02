<?php
include "my_text.php";
$myfile_location = "all_activated_onus_for_test.txt";
$myfile = fopen($myfile_location,"r")or die("Unable to open the document");
$line_pattern = '/<tr>.*?<\/tr>/s';
$elements_pattern = '(?<=>).*(?=<)';

//echo fread($myfile,filesize($myfile_location));
//match onu line


preg_match_all($line_pattern,$mytext,$matches,PREG_PATTERN_ORDER);
for ($i = 0; $i < count($matches[0]) ; $i++) {
    $line = $matches[0][1];
    /* preg_match_all($elements_pattern,$line,$line_matches,PREG_PATTERN_ORDER);
    for ($y = 0; $y < count($line_matches[0]) ; $y++) {
        echo $line_matches;
        $element1 = $line_matches[0][1];
        echo $element1;
    } */
    echo $line;
}

//fclose($myfile);


?>
