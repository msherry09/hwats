<?php
require ('../includes/db_connect.php');
require ('../includes/functions.php');

$sql = "CREATE TABLE IF NOT EXISTS `othermed` (`OTHERMEDID` int(12) NOT NULL AUTO_INCREMENT, `PARTICIPANTID` int(12) NOT NULL, `MEDICATION` varchar(50) DEFAULT NULL, PRIMARY KEY (`OTHERMEDID`)) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysql_query($sql);
$sql = "ALTER TABLE participant ADD HEARTMED INT(1) DEFAULT 0 AFTER PAINMED"; 
mysql_query($sql);
$sql = "ALTER TABLE participant ADD BLOODMED INT(1) DEFAULT 0 AFTER HEARTMED"; 
mysql_query($sql);
$sql = "ALTER TABLE participant ADD CHOLESTEROLMED INT(1) DEFAULT 0 AFTER BLOODMED"; 
mysql_query($sql);
$sql = "ALTER TABLE participant ADD OTHERMEDID INT(12) DEFAULT 0 AFTER CHOLESTEROLMED"; 
mysql_query($sql);

echo '<h1>Script run.</h1>'
?>