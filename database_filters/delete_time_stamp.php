<?php
include "../header.php";

include "../secu_data.php";

$mysqli = new PDO("mysql:host=$hostname_name_toni;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);
$row1 = $_GET['Time_stamp'];
$query = "DELETE FROM attenuation_report WHERE Time_stamp='$row1'";
echo "$query <BR>";
/* Try to query the database */
if ($result = $mysqli->query($query)) {
   Echo "The report with the Time_stamp $row1 has been deleted from attenuation_report"."<br>";
}
else
{
    echo "Sorry, the report with Time_stamp $row1 cannot be found in attenuation_report"."<br>";
}

$mysqli2 = new PDO("mysql:host=$hostname_name_toni;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);
$query2 = "DELETE FROM MAIN_filter WHERE Time_stamp='$row1'";
if ($result = $mysqli2->query($query2)) {
    Echo "The report with the Time_stamp $row1 has been deleted from MAIN_filter"."<br>";
}
else
{
    echo "Sorry, the report with Time_stamp $row1 cannot be found in MAIN_filter"."<br>";
}
include "../footer.php";

?>

<h1><a href="MAIN_filter_new.php ">new main filter</a></h1>
