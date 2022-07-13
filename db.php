<?php

include "secu_data.php";

$conn = new mysqli('localhost', $db_user_toni, $db_pwd_toni );
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
//$conn->select_db("registration");
?>