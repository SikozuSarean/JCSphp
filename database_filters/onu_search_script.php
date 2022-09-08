<?php
include "../header.php";
?>
<h2>Full report for one onu</h2>
<?php
include "../standard_table_head.php";
?>
    <tbody>
 <?php
include "onu_search_view.php";
include "../secu_data.php";
$mysqli = new PDO("mysql:host=$hostname_name_toni;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);

$row1 = $_REQUEST['MAC_ONU'];
//echo $row;
$counter = 0;


foreach($mysqli->query("SELECT * 
FROM attenuation_report 
WHERE MAC_ONU = '$row1'
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