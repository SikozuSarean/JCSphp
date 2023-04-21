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

$query = " CREATE TABLE `apartments_report` 
( `Crt` INT(255) PRIMARY KEY AUTO_INCREMENT, `id` INT(15), `contract_nummber` INT(15),
`is_terminated` INT (1), `package` varchar (100), `location_code` varchar(20), `onu_id` int(10),
`MAC` varchar (20), `MAC_ONU` varchar (20), `IP` varchar (20),`bridge` INT (1),
`IP_fix` INT (1), `ONU_status` varchar(20), `port` int (10), `frontend_pon` varchar (15),
`odf_port` varchar (20), `link` varchar (20), `Time_stamp` DATETIME)";
//echo "<p>***********</p>";
//echo $query ;
//echo "<p>***********</p>";
if ($mysqli->query($query) === TRUE) 
{
    echo "Database table 'apartments_report' created</P>";
}
else
{
    echo "<p>Error: </p>" . $mysqli->error;
}




$mysqli->close();

?>
