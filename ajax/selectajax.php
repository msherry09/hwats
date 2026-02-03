<?php	
	require ('../includes/db_connect.php');
	require ('../includes/functions.php');
	$first = 0;
	$second = 0;
	if(isset($_GET['first']))
		$first = $_GET['first'];
	if(isset($_GET['second']))
		$second = $_GET['second'];
	$sql = 'SELECT * FROM physicalactivitylookup WHERE`PHYSICALID` NOT IN (1,7,11,'.$first.','.$second.')';
	$result = mysql_query($sql);
	echo "obj.options[obj.options.length] = new Option('None','1');\n";
	while($row = mysql_fetch_array($result))
	{
		echo "obj.options[obj.options.length] = new Option('".$row['PHYSICALDESC']."','".$row['PHYSICALID']."');\n";				
	}	
?>