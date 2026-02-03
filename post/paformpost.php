<?php
	header('Location: ../participantforms.php');
	require ('../includes/db_connect.php');
	session_start();
	//grabs the participant id
	if(isset($_SESSION['participantid']))
	$participantid = $_SESSION['participantid'];
	else
	$participantid = 1;
	//echo $participantid;
	
	//if part is set, it is an update
	if(isset($_POST['partid']))
	{
		$partid = $_POST['partid'];
	}
	else //else, it is insert
	{
		$partid = 0;
	}
	
	if($partid == 0){
		$sql_question = "select * from paquestion";
		$result_question = mysql_query($sql_question);
		//insert into the result table with the default value of False
		while($row_question = mysql_fetch_array($result_question))
		{
			$paquestion = $row_question['PAQUESTIONDESC'];
			$paquestionid = $row_question['PAQUESTIONID'];
			$sql_insert = "INSERT INTO paresult VALUES(NULL, ".$paquestionid.", ".$participantid.", 'False', NULL)";
			$result_insert = mysql_query($sql_insert);
		}
		
		foreach($_POST as $key=>$value)
		{
			//if the key is partid, go to the next iteration
			if($key == 'partid')
			{
				continue;
			}
			//grabs the question id
			$questionid = str_replace("group", "", $key);
			//grabs the answer id
			$answerid = $value;		
			//set the update
			$sql_update = 'UPDATE paresult SET ANSWER = "'.$answerid.'", ACCEPTDATE = SYSDATE() WHERE PARTICIPANTID = '.$participantid.' AND PAQUESTIONID = '.$questionid;
			//run the update
			$result = mysql_query($sql_update);
			//echo $sql_update.'<br />';
		}
		//update the participant table to NULL the print date
		$sql_paprint = 'UPDATE participant SET PAFORMPRINTDATE = NULL WHERE PARTICIPANTID = '.$participantid;
		$result = mysql_query($sql_paprint);
	}
	else
	{
		$nullDate = 0;
		foreach($_POST as $key=>$value)
		{
			//if the key is partid, go to the next iteration
			if($key == 'partid')
			{
				continue;
			}
			//grabs the question id
			$questionid = str_replace("group", "", $key);
			//grabs the answer id
			$answerid = $value;	
			//set up statement to determine if the data in the result is False for that particular question			
			$sql = 'SELECT ANSWER FROM paresult WHERE PARTICIPANTID = '.$participantid.' AND PAQUESTIONID = '.$questionid;
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			//if it is false, update to true and add a date			
			if($row[0] == 'False')
			{			
				//set the update
				$sql_update = 'UPDATE paresult SET ANSWER = "'.$answerid.'", ACCEPTDATE = SYSDATE() WHERE PARTICIPANTID = '.	$participantid.' AND PAQUESTIONID = '.$questionid;
				//run the update
				$result = mysql_query($sql_update);
				$nullDate = 1;
			}
		}
		if($nullDate > 0)
		{
			//update the participant table to NULL the print date
			$sql_paprint = 'UPDATE participant SET PAFORMPRINTDATE = NULL WHERE PARTICIPANTID = '.$participantid;
			$result = mysql_query($sql_paprint);
		}
	}
?>