
<!-- work in progress -->

<?php
include "../secu_data.php";

$mysqli = new PDO("mysql:host=$hostname_name_toni;dbname=$db_name_toni",$db_user_toni,$db_pwd_toni);

$query = 'INSERT IGNORE INTO `MAIN_filter`
(
    `Time_stamp`,
    `Status_0`,
    `Status_4`,
    `Recieve_smallest`,
    `MAC_ONU_duplicates`,
    `MAC_ONU_distinct`,
    `Time_stamp_distinct`,
    `Status_2`,
    `Status_3`,
    `Status_abnormal`
) WITH CTE_all as
(SELECT *
FROM attenuation_report
WHERE Time_stamp = "2022-08-25 15:01:00"
)
SELECT ar.Time_stamp,
COUNT(zero_status.Status) AS zero_status,
COUNT(four_status.Status) AS four_status,
COUNT(smallest_power.Receive) AS smallest_power,
COUNT(ar.MAC_ONU)- COUNT(DISTINCT ar.MAC_ONU) AS count_duplicates,
COUNT(DISTINCT(ar.MAC_ONU)) AS count_distinct_mac_onu,
COUNT(ar.Time_stamp) AS count_time_stamp,
COUNT(two_status.Status) AS two_status,
COUNT(three_status.Status) AS three_status,
COUNT(other_status.Status) AS other_status
FROM CTE_all ar 
LEFT JOIN (
  SELECT ar2.Crt, ar2.Time_stamp, Status
  FROM CTE_all ar2 
  WHERE ar2.Status = 0
) zero_status ON zero_status.Crt = ar.Crt
LEFT JOIN (
  SELECT ar3.Crt, ar3.Time_stamp, ar3.Status
  FROM CTE_all ar3 
  WHERE ar3.Status = 4
) four_status ON four_status.Crt = ar.Crt
LEFT JOIN (
  SELECT ar4.Crt, ar4.Time_stamp, ar4.Receive
  FROM CTE_all ar4 
  WHERE ar4.Receive < -27.00
) smallest_power ON smallest_power.Crt = ar.Crt
LEFT JOIN (
  SELECT ar5.Crt, ar5.Time_stamp, ar5.Status
  FROM CTE_all ar5
  WHERE ar5.Status = 2
) two_status ON two_status.Crt = ar.Crt
LEFT JOIN (
  SELECT ar6.Crt, ar6.Time_stamp, ar6.Status
  FROM CTE_all ar6
  WHERE ar6.Status = 3
) three_status ON three_status.Crt = ar.Crt
LEFT JOIN (
  SELECT ar7.Crt, ar7.Time_stamp, ar7.Status
  FROM CTE_all ar7
  WHERE ar7.Status NOT IN (0,1,2,3,4)
) other_status ON other_status.Crt = ar.Crt
GROUP BY ar.Time_stamp
ORDER BY ar.Time_stamp DESC;';

if ($result = $mysqli->query($query)) {
  header("Location: MAIN_filter_new.php"); //redirects to the filter page
}
else
{
  echo "<p>Error </p>" . printf("Errormessage: %s\n", $mysqli->error);
  echo $query;
}
?>
