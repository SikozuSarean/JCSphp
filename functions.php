<?php

include "secu_data.php";

// CREATE DB CONNECTION AND TEST IF SUCCESFULL
function db_connect($db_host, $db_user, $db_word, $db_name, $db_port) {

  // OPEN A CONNECTION TO THE DATA BASE SERVER AND SELECT THE DB
  $mysqlptr = new mysqli($db_host, $db_user, $db_word, $db_name, $db_port);

  // DID THE CONNECT/SELECT WORK OR FAIL?
  if ($mysqlptr->connect_errno)
  {
    $err
    = "CONNECT FAIL: "
    . $mysqlptr->connect_errno
    . ' '
    . $mysqlptr->connect_error
    ;
    trigger_error($err, E_USER_ERROR);
  }

  return $mysqlptr;

}

// QUERY DB AND TEST IF SUCCESFULL
function db_query($mysqlptr, $sql) {

  $res = $mysqlptr->query($sql);

  // IF mysqli_query() RETURNS FALSE, LOG AND SHOW THE ERROR
  if (!$res)
  {
    $err
    = "QUERY FAIL: "
    . ' ERRNO: '
    . $mysqlptr->errno
    . ' ERROR: '
    . $mysqlptr->error
    . 'Query: '
    . $sql
    ;
    trigger_error($err, E_USER_ERROR);
  }

  return $res;

}

// paranoid sanitization -- only let the alphanumeric set and dashes through
function sanitize_paranoid_string($string, $min='', $max='')
{
  $string = preg_replace("/[^a-zA-Z0-9-_: ]/", "", $string);
  $len = strlen($string);
  if((($min != '') && ($len < $min)) || (($max != '') && ($len > $max)))
    return FALSE;
  return $string;
}

function elapsed_time($time_start) {
    $time_end = microtime(true);
    return $time_end - $time_start;
}

function read_snmp_values($ip, $community, array $oids) {
    $output = [];

    $session = new SNMP(SNMP::VERSION_2C, $ip, $community);
    $session->quick_print = TRUE;
    $session->valueretrieval = SNMP_VALUE_PLAIN;
    foreach ($oids as $key => $value) {
        $output["$key"] = $session->get($value, TRUE);
    }
    $session->close();
    return $output;
}

function calculate_onu_id($gcob, $pon, $position) {
    return $gcob * pow(2, 25) + $pon * pow(2, 19) + $position * pow(2, 8);
}

?>