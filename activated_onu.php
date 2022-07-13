<html>
<head>
<title>All activated ONUs</title>

<style>

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
}
.error {
    color: red;
}
</style>
    </head>
<body>
    <h1>test</h1>
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errrors', 1);
error_reporting(E_ALL);

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

$time_start = microtime(true);

$timeout = 5000000;
$rx_errors = 0;
$tx_errors = 0;
$community    = "public";
$snmpversion  = "2c";
$onuid_oid    = "1.3.6.1.4.1.5875.800.3.101.2.1.1";
$gcob_oid     = "1.3.6.1.4.1.5875.800.3.10.1.1.2";
$pon_oid      = "1.3.6.1.4.1.5875.800.3.10.1.1.3";
$position_oid = "1.3.6.1.4.1.5875.800.3.10.1.1.4";
$status_oid   = "1.3.6.1.4.1.5875.800.3.10.1.1.11";
$mac_oid      = "1.3.6.1.4.1.5875.800.3.10.1.1.10";
$tx_oid       = "1.3.6.1.4.1.5875.800.3.9.3.3.1.7";
$rx_oid       = "1.3.6.1.4.1.5875.800.3.9.3.3.1.6";
$uspeed_oid   = "1.3.6.1.4.1.5875.800.3.19.1.1.1";
$dspeed_oid   = "1.3.6.1.4.1.5875.800.3.19.1.1.2";
$distance_oid = "1.3.6.1.4.1.5875.800.3.9.6.1.1.1";
$temperature_oid = "1.3.6.1.4.1.5875.800.3.9.3.3.1.10";
$olts  = array(
//               "FH1" => "192.168.100.100",
//               "FH2" => "192.168.100.101",
//               "FH3" => "192.168.100.102",
//               "FH4" => "192.168.100.103",
               "FH5" => "192.168.100.105",
               "FH6" => "192.168.100.106",
               "FH7" => "192.168.100.107",
//               "FH8" => "192.168.100.108",
               "FH9" => "192.168.100.109",
               "FH10" => "192.168.100.110",
               "FH11" => "192.168.100.111",
               "FH12" => "192.168.100.112",
               "FH13" => "192.168.100.113",
             );
$olts = array("FH9" => "192.168.100.109");
?>
<table style="border: 1;">
    <tr>
        <td>Id</td>
        <td>OLT</td>
        <td>Index</td>
        <td>GCOB</td>
        <td>PON</td>
        <td>Position</td>
        <td>Status</td>
        <td>MAC ONU</td>
	      <td>Transmit</td>
        <td>Receive</td>
        <td>Down speed</td>
        <td>Up speed</td>
        <td>Distance</td>
        <td>Temperature</td>
    </tr>

<?php
$i = 1;
foreach ($olts as $oltname => $oltip) {

    $session = new SNMP(SNMP::VERSION_2C, $oltip, $community, $timeout);
    $session->quick_print = TRUE;
    $session->valueretrieval = SNMP_VALUE_PLAIN;
    $ids = $session->walk($onuid_oid, TRUE);
    $gcobs = $session->walk($gcob_oid, TRUE);
    $pons = $session->walk($pon_oid, TRUE);
    $positions = $session->walk($position_oid, TRUE);
    $statuses = $session->walk($status_oid, TRUE);
    $macs = $session->walk($mac_oid, TRUE);
    $txs = $session->walk($tx_oid, TRUE);
    $rxs = $session->walk($rx_oid, TRUE);
    $uspeeds = $session->walk($uspeed_oid, TRUE);
    $dspeeds = $session->walk($dspeed_oid, TRUE);
    $distances = $session->walk($distance_oid, TRUE);
    $temperatures = $session->walk($temperature_oid, TRUE);
    $session->close();

    foreach ($ids as $id) {
        $pon = $pons[$id];
        $gcob = $gcobs[$id];
        $position = $positions[$id];
        $status = $statuses[$id];
        $mac = join(":", str_split($macs[$id], 2));
        $tx = $txs[$id] / 100;
        $rx = $rxs[$id] / 100;
        $uspeed = $uspeeds[$id] / 1000;
        $dspeed = $dspeeds[$id] / 1000;
        $temperature = $temperatures[$id] / 100;
        $distance = $distances[$id];

        echo "<tr>\n";
        echo "<td>$i</td>\n";
        echo "<td>$oltname</td>\n";
        echo "<td>$id</td>\n";
        echo "<td>$gcob</td>\n";
        echo "<td>$pon</td>\n";
        echo "<td>$position</td>\n";
        echo "<td>$status</td>\n";
        echo "<td>$mac</td>\n";
        if ($tx > 2.5 && $tx < 3.5) echo "<td>$tx</td>\n";
        else {
            echo "<td><span class='error'>$tx</td>\n";
            $tx_errors++;
        };
        if ($rx > -27 && $rx < -11) echo "<td>$rx</td>\n";
        else {
            echo "<td><span class='error'>$rx</td>\n";
            $rx_errors++;
        };
        echo "<td>$dspeed</td>\n";
        echo "<td>$uspeed</td>\n";
        echo "<td>$distance</td>\n";
        echo "<td>$temperature&deg;C</td>\n";
        echo "</tr>";
        $i++;
    }
}

echo "</table>";
echo "Transmit errors: $tx_errors<br>\n";
echo "Receive errors: $rx_errors<br>\n";
echo elapsed_time($time_start);
?>
</body>
</html>
