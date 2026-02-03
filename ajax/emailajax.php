<?php	
		require ('../includes/db_connect.php');
		$email = $_GET['email'];
		$sql = "select * from participant where EMAIL = '".$email."'";
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);
		//echo $sql;
		echo $count;
?>