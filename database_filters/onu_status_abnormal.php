<?php
include "../header.php";
?>
<h2>Full report ONU status abnormal</h2>
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
//echo $row;
$counter = 0;


foreach($mysqli->query("SELECT * 
FROM attenuation_report 
WHERE Time_stamp = '$row1'
AND Status NOT IN (0,1,2,3,4)
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
echo "<tr>$counter ONU with status abnormal (not 0,1,2,3,4) in total in the $row1 report</tr>";
include "../footer.php";
?>
