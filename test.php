<?php
include "db.php";
$mysqli = $conn;

   if (!$mysqli) { 
      die('Could not connect'); 
  } 
  echo 'Connected successfully to mySQL. <BR>'; 

  $mysqli->select_db("JCS");
  Echo ("Selected the JCS database");
  $OLT = "FH5";
  $GCOB = 11;
  $PON = 1;
  $Position = 2;
  $Status = 1;
  $MAC_ONU = "FH:TT:05:85:ed:40";
  $Transmit = 2.82;
  $Receive = -22.82;
  $Down_speed = 500;
  $Up_speed = 501;
  $Distance = "";
  if (empty($Distance)) {
    $Distance = 0;
  }  else {
        $Distance;
    }

  $Temperature = "55.99";
  $Time_stamp = date("Y.m.d H:i",time());


 $mysqli->select_db("JCS");
   Echo ("Selected the JCS database");
   $query3 = "INSERT INTO `attenuation_report` (
    `OLT`, `GCOB`, `PON`, `Position`, `Status`, `MAC_ONU`, `Transmit`, `Receive`,
    `Down_speed`, `Up_Speed`, `Distance`, `Temperature`, `Time_stamp`)
VALUES (
    '$OLT', '$GCOB', '$PON', '$Position', '$Status', '$MAC_ONU', '$Transmit', '$Receive', 
    '$Down_speed', '$Up_speed', '$Distance', '$Temperature', '$Time_stamp'
    )";
if ($mysqli->query($query3) === TRUE) {
    echo "<p>data inserted into inventory table.</p>";
}
else
{
echo mysqli_error($mysqli);
    echo "<p>Error Inserting data: </p>" . printf("Errormessage: %s\n", $mysqli->error);
    echo "<p>***********</p>";
    echo $query3;
    echo "<p>***********</p>";
}

$mysqli->close();
?>