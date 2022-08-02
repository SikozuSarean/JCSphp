<?php

$test_var = "<tr>
<td>1</td>
<td>FH5</td>
<td>369623552</td>
<td>11</td>
<td>1</td>
<td>2</td>
<td>1</td>
<td>FH:TT:05:85:ed:40</td>
<td>2.57</td>
<td>-24.81</td>
<td>400</td>
<td>75</td>
<td>5055</td>
<td>48.92&deg;C</td>
</tr>";
//echo $test_var;

$elements_pattern = "/(?<=>).*(?=<)/"; //regex pattern for isolating the elements within the line 

preg_match_all($elements_pattern,$test_var,$line_matches,PREG_PATTERN_ORDER);
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

echo implode($delimiter,$line_sequences_array);
?>