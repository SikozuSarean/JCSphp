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
<th>DATE TIME STAMP</th><th>COUNT DISTINCT ONU IN EACH DATE TIME STAMP</th><th>COUNT EACH DATE TIME STAMP</th>
</tr>

<html>
<body>

 <?php
 include "secu_data.php";
$hostname = "localhost";
$db_name_toni = "JCS";
$db_user_toni = "jcs";
$db_pwd_toni = "b";
$mysqli = new PDO("mysql:host=$hostname;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);

foreach($mysqli->query('SELECT Time_stamp,
    COUNT(DISTINCT(MAC_ONU)),
    COUNT(Time_stamp) 
    FROM attenuation_report 
    GROUP BY Time_stamp
    ORDER BY Time_stamp DESC') as $row) {
    echo "<tr>";
    echo "<td>" . $row['Time_stamp'] . "</td>";
    echo "<td>" . $row['COUNT(DISTINCT(MAC_ONU))'] . "</td>";
    echo "<td>" . $row['COUNT(Time_stamp)'] . "</td>";
    echo "</tr>";
}

?>
</tbody></table>
</div>
</div>
</div>
</body>
</html>