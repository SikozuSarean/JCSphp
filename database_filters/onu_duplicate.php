<?php
include "../header.php";
?>
<h2>Duplicates</h2>
<table class='blueTable'>
    <thead>
        <tr>
            <th>Crt</th>
            <th>OLT</th>
            <th>GCOB</th>
            <th>PON</th>
            <th>Position</th>
            <th>Status</th>
            <th>MAC_ONU</th>
            <th>Transmit</th>
            <th>Receive</th>
            <th>Down_speed</th>
            <th>Up_Speed</th>
            <th>Distance</th>
            <th>Temperature</th>
            <th>Time_stamp</th>
        </tr>
    </thead>
    <tbody>
 <?php
include "../secu_data.php";

$mysqli = new PDO("mysql:host=$hostname_name_toni;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);
$row1 = $_GET['Time_stamp'];
$counter = 0;

foreach($mysqli->query("SELECT ar1.*
FROM
	attenuation_report ar1
WHERE ar1.MAC_ONU IN (
	SELECT
    ar2.MAC_ONU
	FROM
		attenuation_report ar2
	WHERE ar2.Time_stamp = '$row1'
	GROUP BY 
    ar2.MAC_ONU
	HAVING
		COUNT(*) > 1
)
	AND ar1.Time_stamp = '$row1'
ORDER BY ar1.MAC_ONU;") as $row) 
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
echo "<tr>$counter Duplicate onu rows found in $row1 report</tr>";
include "../footer.php";
?>

