<?php
session_start();
header('Location: ../participantforms.php');
error_reporting(0); 
require ('../includes/db_connect.php');
require ('../includes/functions.php');

foreach($_POST as $key => $my_var)
{
	echo $key.' => '.$my_var.'<br/>';
}
//printf($_POST);

/**/
if(isset($_SESSION['participantid']))
	$participantid = $_SESSION['participantid'];
else
	$participantid = 1;
$nocomments = array();
$comments   = array();

//build sql to see if record exist
$sql_check = 'select * from lsresult where PARTICIPANTID ='.$participantid.' and LSDATE ="'.$date.'"';
//run check query
$result_check = mysql_query($sql_check);
//count how many rows are brought back
$num_rows = mysql_num_rows($result_check);

$i = 1;
//build sql to get iteration number from participant
$sql_iteration = 'select ITERATION from participant where PARTICIPANTID = '.$participantid;
//run sql to get iteration number from participant
$result_iteration = mysql_query($sql_iteration);
//catch iteration number from database
$row_iteration = mysql_fetch_row($result_iteration);
$iteration = $row_iteration[0];

//***************************
$actcount = 1;
$actdate = '';
$placeholder = 56;
//***************************

if(isset($_POST['partid']) && isset($_POST['itnum'])) //Updating data
{
	foreach($_POST as $key=>$value)
	{
		if($key == 'partid')
		{
			$partid = $value;
			continue;
		}
		if($key == 'itnum')
		{
			$itnum = $value;
			continue;
		}
		
		$questionid = $i;
		if($key == 'date')
		{	
			$date = $value;
			if($date == '')
				$date = 'CURDATE()';
			else
				$date = '"'.$date.'"';
			$actdate = $date;
			continue;
		}
		
		if($key == 'currentdate')
		{
			continue;
		}
		
		$exploded = explode('aaa', $key);
		$qid = $exploded[0];
		$questionid = str_replace("group", "", $qid);
		if(count($exploded) > 1)
			$answerid = $exploded[1];
		else
			$answerid = $value;
		//************************************
		if($questionid == 800 || $questionid == 900)
		{
			$questionid = 14;
		}
		//************************************
			
		$sql = 'select LSCATEGORYID from lsquestion where LSQUESTIONID = '.$questionid;

		$result = mysql_query($sql);
		$categoryid = mysql_result($result, 0, 'LSCATEGORYID');
		$comment= $_POST[$key];
		if($comment == $answerid)
			$comment = '';
		//************************************
		if($questionid == 14)
		{
			$comment = $actcount;
			$actcount++;
		}
		//************************************
		$i++;
		$escapecomment = cleanData($comment);
			
		if($questionid == 19 and $answerid == '')
			$answerid = 1;
		//************************************
		if($questionid == 14)
		{
			$sql_update = 'UPDATE lsresult SET LSANSWERID = '.$answerid.', LSDATE = '.$date.' WHERE PARTICIPANTID = '.$partid.' AND ITERATION = '.$itnum.' AND LSQUESTIONID = '.$questionid.' AND LSCOMMENT = '.$escapecomment;
		}
		else
		{
			$sql_update = 'UPDATE lsresult SET LSCOMMENT = "'.$escapecomment.'", LSANSWERID = '.$answerid.', LSDATE = '.$date.' WHERE PARTICIPANTID = '.$partid.' AND ITERATION = '.$itnum.' AND LSQUESTIONID = '.$questionid;
		}
		//************************************
		$result = mysql_query($sql_update);
		
	}
		
	while($actcount < 4)
	{
		$comment = $actcount;
		$sql_update = 'UPDATE lsresult SET LSANSWERID = '.$placeholder.', LSDATE = '.$actdate.' WHERE PARTICIPANTID = '.$partid.' AND ITERATION = '.$itnum.' AND LSQUESTIONID = 14 AND LSCOMMENT = '.$comment;
		$result = mysql_query($sql_update);
		$actcount++;		
	}
	
}
else // Inserting data
{	
	if($num_rows == 0){		
		foreach($_POST as $key=>$value)
		{		
			$questionid = $i;
			if($key == 'date')
			{	
				$date = $value;
				if($date == '')
					$date = 'CURDATE()';
				else
					$date = '"'.$date.'"';
				$actdate = $date;
				continue;
			}
			if($key == 'currentdate')
			{
				continue;
			}
			
			$exploded = explode('aaa', $key);
			$qid = $exploded[0];
			$questionid = str_replace("group", "", $qid);
			if(count($exploded) > 1)
				$answerid = $exploded[1];
			else
				$answerid = $value;
			
			//************************************				
			if($questionid == 800 || $questionid == 900)
			{
				$questionid = 14;
			}
			//************************************	
				
			$sql = 'select LSCATEGORYID from lsquestion where LSQUESTIONID = '.$questionid;

			$result = mysql_query($sql);
			$categoryid = mysql_result($result, 0, 'LSCATEGORYID');
			$comment= $_POST[$key];
			if($comment == $answerid)
				$comment = '';
			//************************************
			if($questionid == 14)
			{
				$comment = $actcount;
				$actcount++;
			}
			//************************************
			$i++;
			$escapecomment = cleanData($comment);
				
			if($questionid == 19 and $answerid == '')
				$answerid = 1;
				
			$sql_date = 'select LSDATE from lsresult where LSDATE = "'.$date.'"';
			$check_date = mysql_query($sql_date);
			$num_rows = mysql_num_rows($check_date);
			
			if($num_rows == 0){				
				$sql_insert = 'insert into lsresult VALUES(Null, '.$participantid.', '.$questionid.', "'.$escapecomment.'", '.$answerid.', '.$categoryid.', '.$iteration.', '.$date.')';
				$result = mysql_query($sql_insert);		
			}
		}
	}
	
	
	while($actcount < 4)
	{
		$comment = $actcount;
		$sql_insert = 'insert into lsresult VALUES(Null, '.$participantid.', 14, "'.$comment.'", '.$placeholder.', 4, '.$iteration.', '.$actdate.')';
		$result = mysql_query($sql_insert);
		$actcount++;
	}
}
?>