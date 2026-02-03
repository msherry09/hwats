<?php
    require ('../includes/db_connect.php');
	require ('../includes/functions.php');
	session_start();
	if(isset($_SESSION['participantid']))
		$participantid = $_SESSION['participantid'];
	else
		$participantid = 1;
    
    $sql = 'SELECT COUNT(DATE) FROM hwaresult WHERE PARTICIPANTID = '.$participantid.' and DATE = "'.$_GET['tempDate'].'"';
    $result = mysql_query($sql);
    $count = mysql_result($result, 0, 'COUNT(DATE)');
    echo $count;
?>
