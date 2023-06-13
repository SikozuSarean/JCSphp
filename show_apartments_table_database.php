<?php
include "header.php";

echo '<a href="index.htm">index</a><br>';

echo '<a href="insert_apartments_table_database.php">insert_apartments_table_database</a><br>';
?>
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<?php
include "apartments_table_head.php";
?>
    <tbody>
 <?php
include "secu_data.php";

$mysqli = new PDO("mysql:host=$hostname_name_toni;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);

foreach($mysqli->query('SELECT * 
FROM apartments_report 
ORDER BY
Crt DESC,
Time_stamp DESC
LIMIT 300
 ;') as $row) 
    {
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
    echo "<td>" . $row[14] . "</td>";
    echo "<td>" . $row[15] . "</td>";
    echo "<td>" . $row[16] . "</td>";
    echo "<td>" . $row[17] . "</td>";



    echo "</tr>";
}
include "footer.php";
?>
