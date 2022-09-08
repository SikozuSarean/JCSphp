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

$query1 = " CREATE TABLE `MAIN_filter` 
( `Crt` INT(255) PRIMARY KEY AUTO_INCREMENT,
    `Time_stamp` DATETIME UNIQUE,
    `Status_0` varchar(5),
    `Status_4` varchar(5),
    `Status_2` INT(5),
    `Status_3` INT(5),
    `Status_abnormal` INT(5),
    `Recieve_smallest` INT(5),
    `MAC_ONU_duplicates` INT(5),
    `MAC_ONU_abnormal` INT(5), 
    `MAC_ONU_distinct` INT(5),
    `Time_stamp_distinct` INT(5)
)";
//echo "<p>***********</p>";
//echo $query ;
//echo "<p>***********</p>";
if ($mysqli->query($query1) === TRUE) 
{
    echo "Database table 'MAIN_filter' created</P>";
}
else
{
    echo "<p>Error: </p>" . $mysqli->error;
}




$mysqli->close();

?>
