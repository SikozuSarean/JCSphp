<?php
include "../header.php";
?>
<h2>Full report for one onu or a list of onu separated by ", " or by a new line (like copy paste from an excel column)</h2>
<?php
include "../standard_table_head.php";
?>
    <tbody>
 <?php
include "onu_search_view.php";
include "../secu_data.php";
$mysqli = new PDO("mysql:host=$hostname_name_toni;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);

$row1 = $_REQUEST['MAC_ONU'];
// echo $row1;
$replace_new_line = preg_replace("/\n+/", ",",$row1); //add "," instead of new line
$replace_white_space = preg_replace("/\s+/", "",$replace_new_line); // remove white space
$substitute_ha_with_fh = str_replace("HA:LN", "FH:TT",$replace_white_space); //replace halny with fhtt
$substitute_coma = str_replace(",", "','",$substitute_ha_with_fh); //add quote marks
$make_array = array($substitute_coma); //transform it in to an array because i am a nub
$the_result = "'" . implode ("', '", $make_array) . "'"; //use the only way found to make this worke lol
// echo $the_result;

//echo $row;
$counter = 0;


foreach($mysqli->query("SELECT * 
FROM attenuation_report 
WHERE MAC_ONU IN ($the_result)
ORDER BY Time_stamp DESC
;") as $row) 
    {
    $counter++;
    echo "<tr>";
    echo "<td>" . $row[0] . "</td>";
    echo "<td>" . $row[1] . "</td>";
    echo "<td>" . $row[2] . "</td>";
    echo "<td>" . $row[3] . "</td>";
    echo "<td>" . $row[4] . "</td>";
    echo "<td>" . $row[5] . "</td>";
    echo "<td>" . $row[6] . "</td>";
    echo "<td>" . $row[7] . "</td>";
    echo "<td>" . $row[8] . "</td>";
    echo "<td>" . $row[9] . "</td>";
    echo "<td>" . $row[10] . "</td>";
    echo "<td>" . $row[11] . "</td>";
    echo "<td>" . $row[12] . "</td>";
    echo "<td>" . $row[13] . "</td>";
    echo "</tr>";
}
echo "$counter reports for MAC_ONU $row1";
include "../footer.php";
?>