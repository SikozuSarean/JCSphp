<a class="button" href="../MAIN_filter_save_and_store_latest_report.php" target="_blank">Generate a new fresh report</a>

<?php
include "../header.php";
include "onu_search_view.php";
?>
<h2>Show All Database Table Grouped by Date Time Stamp</h2>

<table class="blueTable">
  <thead>
    <tr class="o-clasa-mai-frumoasa">
      <th colspan="2">DATE TIME</th>
      <th colspan="4">Status</th>
      <th colspan="1">Receive</th>
      <th colspan="3">MAC_ONU</th>
      <th colspan="1">Time_stamp</th>
    </tr>
    <tr class="o-clasa-mai-frumoasa2">
      <th >Full Report</th>
      <th >Delete</th>
      <th >0 and 4</th>
      <th >2</th>
      <th >3</th>
      <th >Abnormal</th>
      <th >< -27.00</th>
      <th >Duplicates</th>
      <th >Abnormal</th>
      <th >Distinct</th>
      <th >Distinct</th>
    </tr>
  </thead>
<tbody>

 <?php
include "../secu_data.php";
$counter = 0;

$mysqli = new PDO("mysql:host=$hostname_name_toni;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);

foreach($mysqli->query('SELECT *
FROM MAIN_filter
ORDER BY Time_stamp DESC;') as $row) { //sort by date time stamp descendent
    $counter++;
    echo "<tr>";
    $time_date_stamp = $row['Time_stamp'];
    echo "<td> 
    <a href = 'onu_status_all.php?Time_stamp=".$row['Time_stamp']."'>$time_date_stamp </a>
    </td>";
    echo " <td>
    <a onClick=\"javascript: return confirm('Are you sure you want to delete the report for $time_date_stamp ?');\" 
    href='delete_time_stamp.php?Time_stamp=".$row['Time_stamp']."' 
    style='color: red;''>Delete</a>
    </td>";
    $status_0 = $row['Status_0'];
    $status_4 = $row['Status_4'];
    echo "<td> 
    <a href = 'onu_status_0_4.php?Time_stamp=".$row['Time_stamp']."'>$status_0 $status_4</a>
    </td>";
    $status_2 = $row['Status_2'];
    echo "<td> 
    <a href = 'onu_status_2.php?Time_stamp=".$row['Time_stamp']."'>$status_2</a>
    </td>";
    $status_3 = $row['Status_3'];
    echo "<td> 
    <a href = 'onu_status_3.php?Time_stamp=".$row['Time_stamp']."'>$status_3</a>
    </td>";
    $status_abnormal = $row['Status_abnormal'];
    echo "<td> 
    <a href = 'onu_status_abnormal.php?Time_stamp=".$row['Time_stamp']."'>$status_abnormal</a>
    </td>";
    $Recieve_low = $row['Recieve_smallest'];
    echo "<td> 
    <a href = 'onu_status_power_smallest.php?Time_stamp=".$row['Time_stamp']."'>$Recieve_low</a>
    </td>";
    $Duplicates = $row['MAC_ONU_duplicates'];
    if ($Duplicates != 0){
    echo "<td> 
    <a href = 'onu_duplicate.php?Time_stamp=".$row['Time_stamp']."'
    style='color: red;''>$Duplicates</a>
    </td>";
    } else {
      echo "<td> 
      </td>";
    }
    $AbnormalMAC_ONU = $qq;
    echo "<td> 
    <a href = 'qq.php?Time_stamp=".$row['qq']."'>$AbnormalMAC_ONU</a>
    </td>";
    echo "<td>" . $row[10] . "</td>";
    echo "<td>" . $row[11] . "</td>";
    echo "</tr>";
}
echo "<tr>$counter Individual reports in total in the data base table</tr>";
include "../footer.php";
?>
