<?php
include "../header.php";
?>
<h2>Full report ONU status 0 and 4</h2>
<?php
include "../standard_table_head.php";
?>
    <tbody>
 <?php
include "../secu_data.php";
$mysqli = new PDO("mysql:host=$hostname_name_toni;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);

$row1 = $_GET['Time_stamp'];
//echo $row;
$counter = 0;


foreach($mysqli->query("SELECT * 
FROM attenuation_report 
WHERE Time_stamp = '$row1'
AND Status in (0,4)
ORDER BY Status ASC
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
echo "<tr>$counter ONU with status 0 and 4 in total in the $row1 report</tr>";
include "../footer.php";
?>