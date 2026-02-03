<?php
	require ('../includes/db_connect.php');
	session_start();	
	header('Location: ../participantforms.php');	
	//grabs the participant id
	if(isset($_SESSION['participantid']))
		$participantid = $_SESSION['participantid'];
	else
		$participantid = 1;
	
	//run the query to see if there already records or not
	$sql = 'SELECT * from wdbresults where PARTICIPANTID = '.$participantid;
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	
	//if there are no records, it is an insert
	if($count == 0)
	{
		foreach($_POST as $key=>$value)
		{
			//grabs the question id
			$questionid = str_replace("group", "", $key);
			//grabs the answer id
			$answerid = $value;
			//set the insert
			$sql_insert = 'INSERT INTO wdbresults VALUES(NULL, '.$answerid.', '.$questionid.', '.$participantid.')';		
			//run the insert
			$result = mysql_query($sql_insert);
			//echo $sql_insert."<br />";
		}
	}
	else //else, it is an update
	{
		foreach($_POST  as $key=>$value)
		{
			//grabs the question id
			$questionid = str_replace("group", "", $key);
			//grabs the answer id
			$answerid = $value;
			//set the update
			$sql = 'UPDATE wdbresults SET WDBANSWERID = '.$answerid.' WHERE WDBQUESTIONID = '.$questionid.' AND PARTICIPANTID = '.$participantid;
			//run the update
			$result = mysql_query($sql);
		}
	}
?>