<?php
include "../header.php";
?>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<h2>COUNTING STUFF</h2>
<?php
include "../standard_table_head.php";
?>
    <tbody>
 <?php
include "../secu_data.php";

$mysqli = new PDO("mysql:host=$hostname_name_toni;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);

foreach($mysqli->query('SELECT * 
FROM attenuation_report 
WHERE MAC_ONU like "FH:TT:10:79:fe:e8"
ORDER BY Time_stamp ASC 
 ;') as $row) 
    {
    echo "<tr>";
    echo "<td>" . $row[0] . "</td>";
    echo "<td>" . $row[1] . "-" . $row[2] . "-" . $row[3] . "-" . $row[4] . "</td>";
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
include "../footer.php";
?>
