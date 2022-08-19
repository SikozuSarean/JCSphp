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
<th>COUNT status 0 and 4</th>
<th>COUNT Recieve < -27.00</th>
<th>COUNT Duplicates</th>
<th>COUNT distinct MAC_ONU</th>
<th>COUNT distinct Time_stamp</th>



</tr>

<html>
<body>

 <?php
include "../secu_data.php";
$counter = 0;

$mysqli = new PDO("mysql:host=$hostname_name_toni;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);

foreach($mysqli->query('WITH CTE_all as
(SELECT *
FROM attenuation_report
)
SELECT ar.Time_stamp,
COUNT(zero_status.Status) AS zero_status,
COUNT(four_status.Status) AS four_status,
COUNT(smallest_power.Receive) AS smallest_power,
COUNT(ar.MAC_ONU)- COUNT(DISTINCT ar.MAC_ONU) AS count_duplicates,
COUNT(DISTINCT(ar.MAC_ONU)) AS count_distinct_mac_onu,
COUNT(ar.Time_stamp) AS count_time_stamp 
FROM CTE_all ar 
LEFT JOIN (
  SELECT ar2.Crt, ar2.Time_stamp, Status
  FROM CTE_all ar2 
  WHERE ar2.Status = 0
) zero_status ON zero_status.Crt = ar.Crt
LEFT JOIN (
  SELECT ar3.Crt, ar3.Time_stamp, ar3.Status
  FROM CTE_all ar3 
  WHERE ar3.Status = 4
) four_status ON four_status.Crt = ar.Crt
LEFT JOIN (
  SELECT ar4.Crt, ar4.Time_stamp, ar4.Receive
  FROM CTE_all ar4 
  WHERE ar4.Receive < -27.00
) smallest_power ON smallest_power.Crt = ar.Crt
GROUP BY ar.Time_stamp
ORDER BY ar.Time_stamp DESC') as $row) { //sort by date time stamp descendent
    $counter++;
    echo "<tr>";
    $time_date_stamp = $row['Time_stamp'];
    echo "<td> 
    <a href = 'show_full_date_time_report.php?Time_stamp=".$row['Time_stamp']."'>$time_date_stamp </a>
    </td>";
    $status_0 = $row[1];
    $status_4 = $row[2];
    echo "<td> 
    <a href = 'onu_status_0_4.php?Time_stamp=".$row['Time_stamp']."'>$status_0 $status_4</a>
    </td>";
    $Recieve_low = $row[3];
    echo "<td> 
    <a href = 'onu_status_power_smallest.php?Time_stamp=".$row['Time_stamp']."'>$Recieve_low</a>
    </td>";
    $Duplicates = $row[4];
    echo "<td> 
    <a href = 'DUPLICATE_ONU.php?Time_stamp=".$row['Time_stamp']."'>$Duplicates</a>
    </td>";
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
echo "$counter Individual reports in total in the data base table";

?>
</tbody></table>
</div>
</div>
</div>
</body>
</html>