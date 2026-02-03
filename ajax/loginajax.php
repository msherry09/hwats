<?php	
	require ('../includes/db_connect.php');
	require ('../includes/functions.php');
	$catch = $_GET['password'];
	$password = md5($catch);
	$sql = "select * from user where USERNAME = '".cleanData($_GET['user'])."' and PASSWORD = '".$password."'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	//echo $sql;
	echo $count;
?>