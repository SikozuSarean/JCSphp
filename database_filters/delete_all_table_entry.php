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
<h2>Delete all table entry for a single report </h2>
<html>
<body>

 <?php
include "../secu_data.php";
$mysqli = new PDO("mysql:host=$hostname_name_toni;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);

$row1 = $_GET['Time_stamp'];
//echo $row;

$mysqli = $mysqli->query("DELETE FROM attenuation_report WHERE Time_stamp='$row1'");

echo "$query <BR>";
/* Try to query the database */
if ($result = $mysqli) {
   Echo "All table entry with Time_stamp $row1 have been deleted.";
}
else
{
    echo "Sorry, entry with Time_stamp $row1 cannot be found " . mysqli_error($query)."<br>";
}

?>
</tbody></table>
</div>
</div>
</div>
</body>
</html>