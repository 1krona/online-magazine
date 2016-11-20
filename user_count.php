<?php

// ** Begin userCount.php **//

$timestamp=time();
$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];

// 10 minutes of timeout
$timeout=$timestamp-6000;

// REPLACE instead of INSERT
mysql_query("REPLACE INTO online (time,ip) VALUES
('$timestamp','$REMOTE_ADDR')
WHERE ip = '$REMOTE_ADDR'");

// purge all old users
mysql_query("DELETE FROM online WHERE time < $timeout");

// delete my own ip adress from statistic

$result = mysql_query("SELECT COUNT(ip) AS ip FROM online");
$user = mysql_fetch_assoc($result);
echo $user['ip'];

// ** End userCount.php **//

?>