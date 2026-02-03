<?php
	session_start();
	header('Location: ../participantforms.php');
	require ('../includes/db_connect.php');
	require ('../includes/functions.php');
	if(isset($_SESSION['demoViews'])){
		$_SESSION['demoViews'] = 1;
	}
	//populate variables based on form fields
	$partid=$_POST['partid'];
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$dob=$_POST['date'];
	$address=$_POST['address'];
	$city=$_POST['city'];
	$zipcode=$_POST['zipcode'];
	$stateid=$_POST['stateid'];
	$raceid=$_POST['raceid'];
	$email=$_POST['email'];
	$home=$_POST['home'];
	if(!isset($home))
		$home ='NULL';
	$work=$_POST['work'];
	if(!isset($work))
		$work ='NULL';
	$cell=$_POST['cell'];
	if(!isset($cell))
		$cell ='NULL';
	$havephysician=$_POST['havephysician'];
	$diabetesquestion=$_POST['diabetesquestion'];
	$diabetesconfirmation=$_POST['diabetesconfirmation'];
	if(!isset($diabetesconfirmation))
		$diabetesconfirmation ='NULL';
	$diabeteseducation=$_POST['diabeteseducation'];
	$diabetes=$_POST['diabetes'];
	$thyroid=$_POST['thyroid'];
	$asthma=$_POST['asthma'];
	$depression=$_POST['depression'];
	$pain=$_POST['pain'];
	$heart=$_POST['heart'];
	$blood=$_POST['blood'];
	$cholesterol=$_POST['cholesterol'];
	$other=$_POST['other'];
	$othertext=$_POST['othertext'];
	$wwid=$_POST['weightwatchers'];
	$firstname= cleanData($firstname);
	$lastname= cleanData($lastname);
	$dob= cleanData($dob);
	$address= cleanData($address);
	$city= cleanData($city);
	$zipcode= cleanData($zipcode);
	$stateid= cleanData($stateid);
	$home= cleanData($home);
	$work= cleanData($work);
	$cell= cleanData($cell);
	$email= cleanData($email);
	$othertext=cleanData($othertext);
	
	$sql_participant = 'select * from participant where EMAIL ="'.$email.'"';
	//run sql for category
	$result_participant = mysql_query($sql_participant);
	$found = 0;
	while($row_participant = mysql_fetch_array($result_participant))
	{							
		$participant_email = $row_participant['EMAIL'];
		if($email == $participant_email)
			$found = 1;							
	}

	//will insert or update based on the partid hidden field
	if($partid == 0)
	{
		if($found == 0)
		{
			//Check if the Other medication checkbox is checked
			if($other == 1){
				//Select how many records are in the othermed table to get a new OTHERMEDID
				$other_last = 'select MAX(othermedid) from othermed';
				$other_result = mysql_query($other_last);
				$row = mysql_fetch_array($other_result);
				$othermedid = $row[0] + 1;				
			} else{
				//If the other medication checkbox is not checked a zero will
				//be inserted into the othermedid column of the participant table
				$othermedid = 0;
			}
			
			//Insert new record into participant table
			$sql_insert = ('INSERT INTO participant VALUES(NULL, "'.$firstname.'","'.$lastname.'","'.$dob.'","'.$address.'","'.$city.'",'.$zipcode.',"'.$stateid.'",'.$raceid.',"'.$email.'","'.$home.'","'.$work.'","'.$cell.'",NULL,'.$havephysician.','.$diabetesquestion.','.$diabetesconfirmation.','.$diabeteseducation.',"'.$diabetes.'","'.$thyroid.'","'.$asthma.'","'.$depression.'","'.$pain.'","'.$heart.'","'.$blood.'","'.$cholesterol.'","'.$othermedid.'",1,1)');
			$result = mysql_query($sql_insert);
			
			//Checking again for the Other Medication checkbox
			if($other == 1){
				//This time we insert a new record into the othermed table
				//with the new participant id
				$sql_end = 'select MAX(participantid) from participant';
				$result_end = mysql_query($sql_end);
				$id = mysql_result($result_end, 0, 'MAX(participantid)');
				
				//Then the new othermed row is inserted
				$insert_other = 'INSERT INTO othermed VALUES(NULL, '.$id.', "'.$othertext.'")';
				$result_other = mysql_query($insert_other);
			}			
		}
		else
		{
			echo "<br />".$email.' '."already exists";
		}
}
	else
	{
		//Update
		
		//Check if the Other medication checkbox is checked
		if($other == 1){
			//check to see if there are any rows in the othermed table
			//that have the same participantid as the participant that is being updated
			$select_othermed = 'select * from othermed where PARTICIPANTID = '.$partid;
			$othermed_rows_result = mysql_query($select_othermed);
			$othermed_found = 0;
			while($row_othermed = mysql_fetch_array($othermed_rows_result))
			{	
				$temp_participant = $row_othermed['PARTICIPANTID'];
				if($partid == $temp_participant)
					$othermed_found = 1;							
			}
			
			//If there are any rows from the othermed table that match the participant being updated
			if($othermed_found == 1){
				//update the othermed table according to the participantid
				$update_other = 'UPDATE othermed SET MEDICATION = "'.$othertext.'" WHERE PARTICIPANTID = '.$partid;
				$result_other = mysql_query($update_other);
				
				$select_othermed = 'select OTHERMEDID from othermed WHERE PARTICIPANTID = '.$partid;
				$othermed_result = mysql_query($select_othermed);
				$othermedid = mysql_result($othermed_result, 0, 'OTHERMEDID');
			} else{
				//otherwise insert a new row into the othermed table for the participant being updated
				$insert_other = 'INSERT INTO othermed VALUES(NULL, '.$partid.', "'.$othertext.'")';
				$result_other = mysql_query($insert_other);
				
				$select_othermed = 'select MAX(othermedid) from othermed';
				$othermed_result = mysql_query($select_othermed);
				$othermedid = mysql_result($othermed_result, 0, 'MAX(othermedid)');
			}			
		} else{
			//if the other medication checkbox is not checked then we have to check to see if
			//there are any rows in the othermed table that match the participantid of the
			//participant being updated
			$select_othermed = 'select * from othermed where PARTICIPANTID = '.$partid;
			$othermed_rows_result = mysql_query($select_othermed);
			$othermed_found = 0;
			while($row_othermed = mysql_fetch_array($othermed_rows_result))
			{	
				$temp_participant = $row_othermed['PARTICIPANTID'];
				if($partid == $temp_participant)
					$othermed_found = 1;							
			}
			
			//if the othermed table has a record then the MEDICATION column will be set to NULL
			if($othermed_found == 1){
				$update_other = 'UPDATE othermed SET MEDICATION = NULL WHERE PARTICIPANTID = '.$partid;
				$result_other = mysql_query($update_other);
			}
			$othermedid = 0;
		}
		
		//Update statement on the participant table
		$sql_update = 'UPDATE participant SET FIRSTNAME = "'.$firstname.'", LASTNAME = "'.$lastname.'", DOB = "'.$dob.'", ADDRESS = "'.$address.'", CITY = "'.$city.'", ZIPCODE = '.$zipcode.', STATEID = "'.$stateid.'", RACEID = '.$raceid.', EMAIL = "'.$email.'", HOME = "'.$home.'", WORK ="'.$work.'", CELL = "'.$cell.'", HAVEPHYSICIAN = '.$havephysician.', DIABETIC = '.$diabetesquestion.', IFDIABETIC = '.$diabetesconfirmation.', DIABETESEEDUCATION = '.$diabeteseducation.', DIABETESMED = "'.$diabetes.'", THYROIDMED = "'.$thyroid.'", ASTHMABREATHINGMED = "'.$asthma.'", MOODMED = "'.$depression.'", PAINMED = "'.$pain.'", HEARTMED = "'.$heart.'", BLOODMED = "'.$blood.'", CHOLESTEROLMED = "'.$cholesterol.'", OTHERMEDID = "'.$othermedid.'", WWID = "'.$wwid.'" WHERE PARTICIPANTID = '.$partid;
		$result = mysql_query($sql_update);		
		
	}
	if($partid == 0)
	{
		$sql_end = 'select MAX(participantid) from participant';
		$result_end = mysql_query($sql_end);
		$id = mysql_result($result_end, 0, 'MAX(participantid)');
		$_SESSION['participantid'] = $id;
	}
	else
	{
		$_SESSION['participantid'] = $partid;
	}
?>
