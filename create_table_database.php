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

$query = " CREATE TABLE `attenuation_report` 
( `Crt` INT(255) PRIMARY KEY AUTO_INCREMENT, `OLT` varchar(5) , `GCOB` INT (3), `PON` INT (3), `Position` INT(3), 
`Status` int(3), `MAC_ONU` varchar (20), `Transmit` DECIMAL (5,2), `Receive` DECIMAL (5,2), 
`Down_speed` INT (5), `Up_Speed` INT (5), `Distance` INT(10), `Temperature` DECIMAL (5,2), 
`Time_stamp` DATETIME)";
//echo "<p>***********</p>";
//echo $query ;
//echo "<p>***********</p>";
if ($mysqli->query($query) === TRUE) 
{
    echo "Database table 'attenuation_report' created</P>";
}
else
{
    echo "<p>Error: </p>" . $mysqli->error;
}




$mysqli->close();

?>
