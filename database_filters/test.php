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
<h2>COUNTING STUFF</h2>
<table class='table table-bordered'>
<tr>
<th>DATE TIME STAMP</th>
<th>COUNT DISTINCT ONU IN EACH DATE TIME STAMP</th>
<th>COUNT EACH DATE TIME STAMP</th>
<th>NUMBER OF DUPLICATES IN EACH REPORT</th>
</tr>

<html>
<body>

 <?php
include "../secu_data.php";

$mysqli = new PDO("mysql:host=$hostname_name_toni;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);

foreach($mysqli->query('SELECT * 
FROM attenuation_report 
WHERE "FH:TT:10:79:fe:e8" IN (MAC_ONU) AND "2022-08-08 16:22:00" IN (Time_stamp)
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

    echo "</tr>";
}
//SELECT MAC_ONU, COUNT(MAC_ONU) AS cnt FROM attenuation_report GROUP BY `MAC_ONU` HAVING cnt > 1 ORDER BY cnt DESC;
//SELECT MAC_ONU, COUNT( MAC_ONU ) total_duplicates FROM attenuation_report GROUP BY MAC_ONU HAVING total_duplicates > 1;
?>
</tbody></table>
</div>
</div>
</div>
</body>
</html>