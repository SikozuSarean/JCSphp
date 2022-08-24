<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Antonio JCS</title>
<link rel="stylesheet" href="../styles.css">

<a class="button" href="../scrape_and_store.php" target="_blank">Generate a new report</a>

</head>
<body>
<?php
include "onu_search_view.php";
?>
<h2>Show All Database Table Grouped by Date Time Stamp</h2>

<table class="blueTable">
  <thead>
    <tr>
      <th colspan="1">DATE TIME</th>
      <th colspan="4">Status</th>
      <th colspan="1">Receive</th>
      <th colspan="3">MAC_ONU</th>
      <th colspan="1">Time_stamp</th>
    </tr>
    <tr>
      <th>STAMP</th>
      <th>0 and 4</th>
      <th>2</th>
      <th>3</th>
      <th>abnormal</th>
      <th>< -27.00</th>
      <th>Duplicates</th>
      <th>Abnormal</th>
      <th>Distinct</th>
      <th>Distinct</th>
    </tr>
  </thead>
<tbody>

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
COUNT(ar.Time_stamp) AS count_time_stamp,
COUNT(two_status.Status) AS two_status,
COUNT(three_status.Status) AS three_status,
COUNT(other_status.Status) AS other_status
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
LEFT JOIN (
  SELECT ar5.Crt, ar5.Time_stamp, ar5.Status
  FROM CTE_all ar5
  WHERE ar5.Status = 2
) two_status ON two_status.Crt = ar.Crt
LEFT JOIN (
  SELECT ar6.Crt, ar6.Time_stamp, ar6.Status
  FROM CTE_all ar6
  WHERE ar6.Status = 3
) three_status ON three_status.Crt = ar.Crt
LEFT JOIN (
  SELECT ar7.Crt, ar7.Time_stamp, ar7.Status
  FROM CTE_all ar7
  WHERE ar7.Status NOT IN (0,1,2,3,4)
) other_status ON other_status.Crt = ar.Crt
GROUP BY ar.Time_stamp
ORDER BY ar.Time_stamp DESC') as $row) { //sort by date time stamp descendent
    $counter++;
    echo "<tr>";
    $time_date_stamp = $row['Time_stamp'];
    echo "<td> 
    <a href = 'onu_status_all.php?Time_stamp=".$row['Time_stamp']."'>$time_date_stamp </a>
    </td>";
    $status_0 = $row[1];
    $status_4 = $row[2];
    echo "<td> 
    <a href = 'onu_status_0_4.php?Time_stamp=".$row['Time_stamp']."'>$status_0 $status_4</a>
    </td>";
    $status_2 = $row[7];
    echo "<td> 
    <a href = 'onu_status_2.php?Time_stamp=".$row['Time_stamp']."'>$status_2</a>
    </td>";
    $status_3 = $row[8];
    echo "<td> 
    <a href = 'onu_status_3.php?Time_stamp=".$row['Time_stamp']."'>$status_3</a>
    </td>";
    $status_abnormal = $row[9];
    echo "<td> 
    <a href = 'onu_status_abnormal.php?Time_stamp=".$row['Time_stamp']."'>$status_abnormal</a>
    </td>";
    $Recieve_low = $row[3];
    echo "<td> 
    <a href = 'onu_status_power_smallest.php?Time_stamp=".$row['Time_stamp']."'>$Recieve_low</a>
    </td>";
    $Duplicates = $row[4];
    echo "<td> 
    <a href = 'onu_duplicate.php?Time_stamp=".$row['Time_stamp']."'>$Duplicates</a>
    </td>";
    $AbnormalMAC_ONU = $qq;
    echo "<td> 
    <a href = 'qq.php?Time_stamp=".$row['qq']."'>$AbnormalMAC_ONU</a>
    </td>";
    echo "<td>" . $row[5] . "</td>";
    echo "<td>" . $row[6] . "</td>";
    echo "<td>" . $row[10] . "</td>";
    echo "<td>" . $row[11] . "</td>";
    echo "<td>" . $row[12] . "</td>";
    echo "<td>" . $row[13] . "</td>";
    echo "</tr>";
}
echo "$counter Individual reports in total in the data base table";

include "../footer.php";
?>