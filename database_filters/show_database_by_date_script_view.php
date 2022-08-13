<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>example-count-with-distinct- php mysql examples | w3resource</title>
<meta name="description" content="example-count-with-distinct- php mysql examples | w3resource">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<h2>Show All Database Table Grouped by Date Time Stamp</h2>
<table class='table table-bordered'>
<tr>
<th>DATE TIME STAMP</th>
<th>COUNT DISTINCT ONU IN EACH DATE TIME STAMP</th>
<th>COUNT EACH DATE TIME STAMP</th>
<th>NUMBER OF DUPLICATES IN EACH REPORT</th>
<th>Full report with onu status 0 and 4</th>
<th>Full report with onu with bad power</th>
</tr>

<html>
<body>

 <?php
include "../secu_data.php";
$counter = 0;

$mysqli = new PDO("mysql:host=$hostname_name_toni;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);

foreach($mysqli->query('SELECT Time_stamp,
    COUNT(DISTINCT(MAC_ONU)),
    COUNT(Time_stamp) 
    FROM attenuation_report 
    GROUP BY Time_stamp
    ORDER BY Time_stamp DESC') as $row) { //sort by date time stamp descendent
    $counter++;
    echo "<tr>";
    $time_date_stamp = $row['Time_stamp'];
    echo "<td> 
    <a href = 'show_full_date_time_report.php?Time_stamp=".$row['Time_stamp']."'> $time_date_stamp </a>
    </td>";
    echo "<td>" . $row['COUNT(DISTINCT(MAC_ONU))'] . "</td>";
    echo "<td>" . $row['COUNT(Time_stamp)'] . "</td>";
    
    $duplicates = number_format($row[2]-$row[1],0,"","");
    if ($duplicates > 0) {
        echo "<td>
        <a href = 'detailed_duplicates.php?Time_stamp=".$row['Time_stamp']."'>Detailed $duplicates duplicates report </a>
        </td>";
    }  
        else {
            echo "<td>" . "" . "</td>";
        }
    echo "<td> 
    <a href = 'onu_status_0_4.php?Time_stamp=".$row['Time_stamp']."'> Show full report status 0 and 4</a>
    </td>";
    echo "<td> 
    <a href = 'onu_status_power_smallest.php?Time_stamp=".$row['Time_stamp']."'> Show full report power < 27.00 </a>
    </td>";
    echo "</tr>";
}
echo "$counter Individual reports in total in the data base table";

?>
</tbody></table>
</div>
</div>
</div>
</body>
</html>