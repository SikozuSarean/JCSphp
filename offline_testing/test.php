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
echo $test_var;

$elements_pattern = "/(?<=>).*(?=<)/";

preg_match_all($elements_pattern,$test_var,$matches,PREG_PATTERN_ORDER);
//$Id = $matches[0][0];
//echo $Id;
$OLT = $matches[0][1];
echo $OLT;
//$Index = $matches[0][2];
//echo $Index;
$GCOB = $matches[0][3];
echo $GCOB;
$PON = $matches[0][4];
echo $PON;
$Position = $matches[0][5];
echo $Position;
$Status = $matches[0][6];
echo $Status;
$MAC_ONU = $matches[0][7];
echo $MAC_ONU;
$Transmit = $matches[0][8];
echo $Transmit;
$Receive = $matches[0][9];
echo $Receive;
$Down_speed = $matches[0][10];
echo $Down_speed;
$Up_speed = $matches[0][11];
echo $Up_speed;
$Distance = $matches[0][12];
echo $Distance;
$Temperature = $matches[0][13];
echo $Temperature;
?>