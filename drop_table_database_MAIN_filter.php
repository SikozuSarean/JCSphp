<?php


include "db.php";
include "secu_data.php";

$mysqli = $conn;

   if (!$mysqli) { 
      die('Could not connect'); 
  } 
  echo 'Connected successfully to mySQL. <BR>'; 

 $mysqli->select_db($db_name_toni);
   Echo ("Selected the $db_name_toni database ");

$query = " drop table MAIN_filter";
//echo "<p>***********</p>";
//echo $query ;
//echo "<p>***********</p>";
if ($mysqli->query($query) === TRUE) 
{
    echo "Database table 'MAIN_filter' deleted</P>";
}
else
{
    echo "<p>Error: </p>" . $mysqli->error;
}




$mysqli->close();

?>
