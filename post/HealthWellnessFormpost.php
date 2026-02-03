<?php
header('Location: ../participantforms.php');
session_start();
require ('../includes/db_connect.php');
require ('../includes/functions.php');
//populate participantid either from session variable or with 1
if(isset($_SESSION['participantid']))
	$participantid = $_SESSION['participantid'];
else
	$participantid = 1;

//populate other variables from form fields
$hwid=$_POST['hwid'];
$date = $_POST['date'];
$height = $_POST['feet']. "' " .$_POST['inches']."'";
$heightshoes = $_POST['heightshoes'];
$weight = $_POST['weight'];
$weightshoes = $_POST['weightshoes'];
$bmi = $_POST['bmi'];
$waist = $_POST['waist'];
$a1c = $_POST['a1c'];
$completedby = $_POST['completedby'];
//make sure all entered data is cleaned to prevent sql injection and XSS attacks
$date = cleanData($date);
$weight = cleanData($weight);
$bmi = cleanData($bmi);
$a1c = cleanData($a1c);
$completedby = cleanData($completedby);

//build query to get the current iteration number from the participant table
$sql_iteration = 'select ITERATION from participant where PARTICIPANTID = '.$participantid;
//run query
$result_iteration = mysql_query($sql_iteration);
//retrieve iteration number and place into variable
$row_iteration = mysql_fetch_row($result_iteration);
$iteration = $row_iteration[0];

if($hwid == 0){
	//build sql to see if record exist
	$sql_check = 'select * from hwaresult where PARTICIPANTID ='.$participantid.' and DATE ="'.$date.'"';
	//run check query
	$result_check = mysql_query($sql_check);
	//count how many rows are brought back
	$num_rows = mysql_num_rows($result_check);

	//If the record does not already exist
	if($num_rows == 0){
		//build sql query for insert on the hwaresult table
		$sql_insert = 'insert into hwaresult VALUES(Null,'.$participantid.',"'.$height.'",'.$heightshoes.','.$weight.','.$weightshoes.','.$bmi.','.$waist.','.$a1c.',"'.$completedby.'","'.$date.'",'.$iteration.')';
		//run query
		$result = mysql_query($sql_insert);

		//check if the insert query fails
		if(!$result){
			//if the query fails it will not execute
			echo "Insert failed! <br />";
			echo "Please check your query.";
			echo $sql_insert."<br />";
		}
		else{
			//if the query runs with no errors it will increase the iteration variable
			$iteration++;
			//and then update the participant table with the new iteration number
			$sql_update = 'update participant set ITERATION ='.$iteration.' where PARTICIPANTID = '.$participantid;
			$update_result = mysql_query($sql_update);
		}
	}
}
else{
	//build update query
	$sql_update = 'UPDATE hwaresult SET HEIGHT ="'.$height.'", HEIGHTWSHOES = '.$heightshoes.', WEIGHT ='.$weight.', WEIGHTWSHOES = '.$weightshoes.', BMI = '.$bmi.', WAIST ='.$waist.', A1C ='.$a1c.', COMPLETEDBY ="'.$completedby.'", DATE ="'.$date.'" WHERE HWARESULTID = '.$hwid;
	//run query
	$result = mysql_query($sql_update);
}
?>