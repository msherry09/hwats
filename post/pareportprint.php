<?php
	require ('../includes/db_connect.php');
	session_start();	
	header('Location: ../participantforms.php');
	//grabs the participant id
	if(isset($_SESSION['participantid']))
		$participantid = $_SESSION['participantid'];
	else
		$participantid = 1;
	
	//sets the print date in the participant table
	$sql_paprint = 'UPDATE participant SET PAFORMPRINTDATE = SYSDATE() WHERE PARTICIPANTID = '.$participantid;
	$result = mysql_query($sql_paprint);
	
	echo 'Page Submitted <br />';
?>