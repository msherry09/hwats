    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php 
		//Get Database
				require ('includes/db_connect.php');
				
		//Star Session for base security
				session_start();				
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		
		<!-- Link to 960.css stylesheet & main.css stylesheet --> 
			<link rel="stylesheet" href="css/960_16.css" type="text/css" />
			<link href="css/main.css" rel="stylesheet" type="text/css" />
			
		<!-- Import JQuery -->
			<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>	
			
		<!-- Remember to Change Title! -->
			<title>Demographic Report - Overall</title>
			
		<!-- JavaScript -->
		<script type="text/javascript">
			function submitform(myform)
			{
				document.forms[myform].submit();
			}
		</script>	
			
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
			<h1>Demographic Overall Report</h1>
			<div class="container container_16">
				<?php
					//get the number of participants to use for each section
					$sql_result = 'SELECT * FROM participant';
					$result_count = mysql_query($sql_result);
					$totalCount = 0;
					$totalCount = mysql_num_rows($result_count);
				?>
				<div class='clear'>&nbsp;</div>
				<br />				
				<fieldset>
					<legend><b>State</b></legend>
					<div class='grid_14 alpha omega prefix_1' align='center'><u>Participant by State</u></div>
					<div class='clear'>&nbsp;</div>
					<?php
						// set the sql statement to get the state and count number, alphabetical
						if($totalCount == 0)
						{
							echo "<div class='grid_14 prefix_1' align='center'>No Records</div>";
						}
						else
						{
							//sql to retrieve information from the states
							$sql_state = 'SELECT s.STATEDESC STATENAME, p.STATEID STATEID, COUNT( p.STATEID ) TOTALCOUNT FROM statelookup s INNER JOIN participant p ON p.STATEID = s.STATEID GROUP BY p.STATEID ORDER BY s.STATEDESC';
							$result_state = mysql_query($sql_state);
							$l=1;
							while($row_state = mysql_fetch_array($result_state))
							{	
								//each state is it's own form
								echo "<form action='citybystate.php' method='post' id='form".$l."' name='form".$l."'>";
								//Grab the answer and their ID
								$stateName = $row_state['STATENAME'];
								$stateID = $row_state['STATEID'];
								$stateCount = $row_state['TOTALCOUNT'];
								echo "<div class='grid_7 prefix_1 alpha' align='right'><a href=\"javascript: submitform('form".$l."')\">".$stateName."</a></div>";
								$percent = 0;
								if($totalCount != 0)
									$percent = round(($stateCount/$totalCount)*100);
								echo "<div class='grid_7 omega'>".$percent."%</div>";
								echo "<div class='clear'>&nbsp;</div>";	
								echo "<input type='hidden' id='date' name='stateID' value='".$stateID."' />";
								echo "<input type='hidden' id='name' name='stateName' value='".$stateName."' />";
								echo "<div class='clear'>&nbsp;</div>";						
								echo "</form>";
								//echo "</div>";
								$l++;
							}
						}
					?>			
				</fieldset>
				<div class='clear'>&nbsp;</div>
				<br />		
				<fieldset>
					<legend><b>Ethnic/Race</b></legend>
					<div class='grid_14 alpha omega prefix_1' align='center'><u>Participant by Ethnic/Race</u></div>
					<div class='clear'>&nbsp;</div>
					<?php
						if($totalCount == 0)
						{	
							//if there are no records this will print
							echo "<div class='grid_14 prefix_1' align='center'>No Records</div>";
						}
						else
						{	
							//build query to bring back all items in racelookup table
							$sql_race = 'SELECT r.RACEDESC RACENAME, COUNT(p.RACEID) TOTALCOUNT FROM racelookup r INNER JOIN participant p ON p.RACEID = r.RACEID GROUP BY p.RACEID ORDER BY p.RACEID';
							$result_race = mysql_query($sql_race);
							while($row_race = mysql_fetch_array($result_race))
							{		
								//Grab the answer and their ID
								$raceName = $row_race['RACENAME'];
								$raceCount = $row_race['TOTALCOUNT'];
								echo "<div class='grid_7 prefix_1 alpha' align='right'>".$raceName."</div>";
								$percent = 0;
								if($totalCount != 0)
									$percent = round(($raceCount/$totalCount)*100);
								echo "<div class='grid_7 omega'>".$percent."%</div>";
								echo "<div class='clear'>&nbsp;</div>";							
							}
						}
					?>
				</fieldset>
				<div class='clear'>&nbsp;</div>
				<br />
				<fieldset>
					<legend><b>Education</b></legend>
					<div class='grid_14 prefix_1' align='center'>How many particpant ever had education for diabetes/pre-diabetes?</div>					
					<div class='clear'>&nbsp;</div>
					<?php
						if($totalCount == 0)
						{
							//if there are no records this will print
							echo "<div class='grid_14 prefix_1' align='center'>No Records</div>";
						}
						else
						{
							//bring back participants and calculate percentage of those who answer yes to Diabetes
							//education question
							$sql_education = 'SELECT * FROM participant WHERE DIABETESEEDUCATION = 1';
							$result_education = mysql_query($sql_education);
							$educationCount = 0;
							$educationCount = mysql_num_rows($result_education);						
							echo "<div class='grid_7 prefix_1 alpha' align='center'><u>Yes</u></div>";
							echo "<div class='grid_7 omega' align='center'><u>No</u></div>";
							echo "<div class='clear'>&nbsp;</div>";						
							echo "<div class='grid_7 prefix_1 alpha' align='center'>".round(($educationCount/$totalCount)*100)."%</div>";
							echo "<div class='grid_7 omega' align='center'>".round((1-($educationCount/$totalCount))*100)."%</div>";
							echo "<div class='clear'>&nbsp;</div>";		
						}
					?>
				</fieldset>
				<div class='clear'>&nbsp;</div>
				<br />
				<fieldset>
					<legend><b>Medication</b></legend>
					<div class='grid_14 prefix_1' align='center'>Particpant Current Medication</div>
					<div class='clear'>&nbsp;</div>
					<?php
						if($totalCount == 0)
						{
							//if there are no records this will print
							echo "<div class='grid_14 prefix_1' align='center'>No Records</div>";
						}
						else
						{
							//Calculate and show percentages of those taking certain medications
							echo "<div class='grid_2 prefix_3 alpha' align='center'><br />Diabetes<br /><u>Pre-Diabetes</u></div>";
							echo "<div class='grid_2' align='center'><br />Thyroid<br /><u>Issues</u></div>";
							echo "<div class='grid_2' align='center'>Asthma<br />Breathing<br /><u>Issues</u></div>";
							echo "<div class='grid_2' align='center'>Mood<br />Anxiety<br /><u>Depression</u></div>";
							echo "<div class='grid_2 omega' align='center'><br /><br /><u>Pain</u></div>";
							echo "<div class='clear'>&nbsp;</div>";
							
							
							$sql_med = 'SELECT * FROM participant WHERE DIABETESMED = 1';
							$result_med = mysql_query($sql_med);
							$medCount = 0;
							$medCount = mysql_num_rows($result_med);						
							echo "<div class='grid_2 prefix_3 alpha' align='center'>".round(($medCount/$totalCount)*100)."%</div>";
							
							$sql_med = 'SELECT * FROM participant WHERE THYROIDMED = 1';
							$result_med = mysql_query($sql_med);
							$medCount = 0;
							$medCount = mysql_num_rows($result_med);						
							echo "<div class='grid_2' align='center'>".round(($medCount/$totalCount)*100)."%</div>";
							
							$sql_med = 'SELECT * FROM participant WHERE ASTHMABREATHINGMED = 1';
							$result_med = mysql_query($sql_med);
							$medCount = 0;
							$medCount = mysql_num_rows($result_med);						
							echo "<div class='grid_2' align='center'>".round(($medCount/$totalCount)*100)."%</div>";
							
							$sql_med = 'SELECT * FROM participant WHERE MOODMED = 1';
							$result_med = mysql_query($sql_med);
							$medCount = 0;
							$medCount = mysql_num_rows($result_med);						
							echo "<div class='grid_2' align='center'>".round(($medCount/$totalCount)*100)."%</div>";
							
							$sql_med = 'SELECT * FROM participant WHERE PAINMED = 1';
							$result_med = mysql_query($sql_med);
							$medCount = 0;
							$medCount = mysql_num_rows($result_med);						
							echo "<div class='grid_2 omega' align='center'>".round(($medCount/$totalCount)*100)."%</div>";
							echo "<div class='clear'>&nbsp;</div>";
							
							echo "<br />";
							echo "<div class='grid_2 prefix_3 alpha' align='center'>Heart<br /><u>Issues</u></div>";
							echo "<div class='grid_2' align='center'>Blood<br /><u>Pressure</u></div>";
							echo "<div class='grid_2' align='center'><br /><u>Cholesterol</u></div>";
							echo "<div class='grid_2 omega' align='center'><br /><u>Other</u></div>";
							?>
							<br />
							<div class='grid_2'><input type='button' value='View Other Medications' onclick='window.location="othermedications.php";' /></div>
							<?php
							echo "<div class='clear'>&nbsp;</div>";
							
							$sql_med = 'SELECT * FROM participant WHERE HEARTMED = 1';
							$result_med = mysql_query($sql_med);
							$medCount = 0;
							$medCount = mysql_num_rows($result_med);						
							echo "<div class='grid_2 prefix_3 alpha' align='center'>".round(($medCount/$totalCount)*100)."%</div>";
							
							$sql_med = 'SELECT * FROM participant WHERE BLOODMED = 1';
							$result_med = mysql_query($sql_med);
							$medCount = 0;
							$medCount = mysql_num_rows($result_med);						
							echo "<div class='grid_2' align='center'>".round(($medCount/$totalCount)*100)."%</div>";
							
							$sql_med = 'SELECT * FROM participant WHERE CHOLESTEROLMED = 1';
							$result_med = mysql_query($sql_med);
							$medCount = 0;
							$medCount = mysql_num_rows($result_med);						
							echo "<div class='grid_2' align='center'>".round(($medCount/$totalCount)*100)."%</div>";
							
							$sql_med = 'SELECT * FROM participant WHERE OTHERMEDID != 0';
							$result_med = mysql_query($sql_med);
							$medCount = 0;
							$medCount = mysql_num_rows($result_med);						
							echo "<div class='grid_2' align='center'>".round(($medCount/$totalCount)*100)."%</div>";
						}
					?>
				</fieldset>
				<div class='clear'>&nbsp;</div>
				<br />
				<fieldset>
					<legend><b>Diagnosed</b></legend>
					<div class='grid_14 prefix_1' align='center'>Participants that have been diagnosed with diabetes/pre-diabetes</div>
					<div class='clear'>&nbsp;</div>
					<?php
						if($totalCount == 0)
						{
							//if there are no records this will print
							echo "<div class='grid_14 prefix_1' align='center'>No Records</div>";
						}
						else
						{
							//query database for participants that are diabetic
							$sql_yes = 'SELECT * FROM participant WHERE DIABETIC = 1';
							$result_yes = mysql_query($sql_yes);
							$yesCount = 0;
							$yesCount = mysql_num_rows($result_yes);
							$noCount = $totalCount - $yesCount;
							
							//calculate and display percentage of participants that have
							//either Diabetes or Pre-Diabetes
							$sql_dia = 'SELECT * FROM participant WHERE IFDIABETIC = 1';
							$result_dia = mysql_query($sql_dia);
							$diaCount = 0;
							$diaCount = mysql_num_rows($result_dia);
							$prediaCount = $yesCount - $diaCount;
												
							echo "<div class='grid_5 prefix_1 alpha' align='center'><u>Diabetes</u></div>";
							echo "<div class='grid_4' align='center'><u>Pre-Diabetes</u></div>";
							echo "<div class='grid_5 omega' align='center'><u>None</u></div>";
							echo "<div class='clear'>&nbsp;</div>";
							echo "<div class='grid_5 prefix_1 alpha' align='center'>".round(($diaCount/$totalCount)*100)."%</div>";						
							echo "<div class='grid_4' align='center'>".round(($prediaCount/$totalCount)*100)."%</div>";					
							echo "<div class='grid_5 omega' align='center'>".round(($noCount/$totalCount)*100)."%</div>";
						}
					?>
				</fieldset>
				<div class='clear'>&nbsp;</div>
				<br />
				<fieldset>
					<legend><b>Primary Physician</b></legend>
					<div class='grid_14 prefix_1' align='center'>Participants That Have a Primary Care Physician</div>
					<div class='clear'>&nbsp;</div>
					<?php
						if($totalCount == 0)
						{
							//if there are no records this will print
							echo "<div class='grid_14 prefix_1' align='center'>No Records</div>";
						}
						else
						{
							//retrieve number of participants that have a physician and display percentage
							$sql_physician = 'SELECT * FROM participant WHERE HAVEPHYSICIAN = 1';
							$result_physician = mysql_query($sql_physician);
							$physicianCount = 0;
							$physicianCount = mysql_num_rows($result_physician);
							
							echo "<div class='grid_7 prefix_1 alpha' align='center'><u>Yes</u></div>";
							echo "<div class='grid_7 omega' align='center'><u>No</u></div>";
							echo "<div class='clear'>&nbsp;</div>";
							echo "<div class='grid_7 prefix_1 alpha' align='center'>".round(($physicianCount/$totalCount)*100)."%</div>";
							echo "<div class='grid_7 omega' align='center'>".round((1-($physicianCount/$totalCount))*100)."%</div>";
							echo "<div class='clear'>&nbsp;</div>";	
						}
					?>
				</fieldset>
				<div class='clear'>&nbsp;</div>
				<br />
				<fieldset>
					<legend><b>Age Group</b></legend>
					<div class='grid_14 prefix_1' align='center'>Participants By Age Group</div>
					<div class='clear'>&nbsp;</div>
					<?php
						if($totalCount == 0)
						{
							echo "<div class='grid_14 prefix_1' align='center'>No Records</div>";
						}
						else
						{				
							//This section retrieves the date of birth from the participant table and uses
							//that information to calculate the participant's age which can be used to calculate
							//the percentage of participants within certain age groups
							echo "<div class='grid_2 prefix_1 alpha' align='center'><u>Below 18</u></div>";
							echo "<div class='grid_2' align='center'><u>18 - 25</u></div>";
							echo "<div class='grid_2' align='center'><u>26 - 35</u></div>";
							echo "<div class='grid_2' align='center'><u>36 - 45</u></div>";
							echo "<div class='grid_2' align='center'><u>46 - 55</u></div>";
							echo "<div class='grid_2' align='center'><u>56 - 65</u></div>";
							echo "<div class='grid_2 omega' align='center'><u>Above 65</u></div>";
							
							$sql_age = 'SELECT * FROM participant WHERE (YEAR(CURDATE())-YEAR(DOB))- (RIGHT(CURDATE(),5)<RIGHT(DOB,5)) < 18';
							$result_age = mysql_query($sql_age);
							$ageCount = 0;
							$ageCount = mysql_num_rows($result_age);			
							echo "<div class='grid_2 prefix_1 alpha' align='center'>".round(($ageCount/$totalCount)*100)."%</div>";

							$sql_age = 'SELECT * FROM participant WHERE (YEAR(CURDATE())-YEAR(DOB))- (RIGHT(CURDATE(),5)<RIGHT(DOB,5)) < 26 AND (YEAR(CURDATE())-YEAR(DOB))- (RIGHT(CURDATE(),5)<RIGHT(DOB,5)) > 17';
							$result_age = mysql_query($sql_age);
							$ageCount = 0;
							$ageCount = mysql_num_rows($result_age);
							echo "<div class='grid_2' align='center'>".round(($ageCount/$totalCount)*100)."%</div>";

							$sql_age = 'SELECT * FROM participant WHERE (YEAR(CURDATE())-YEAR(DOB))- (RIGHT(CURDATE(),5)<RIGHT(DOB,5)) < 36 AND (YEAR(CURDATE())-YEAR(DOB))- (RIGHT(CURDATE(),5)<RIGHT(DOB,5)) > 25';
							$result_age = mysql_query($sql_age);
							$ageCount = 0;
							$ageCount = mysql_num_rows($result_age);
							echo "<div class='grid_2' align='center'>".round(($ageCount/$totalCount)*100)."%</div>";
							
							$sql_age = 'SELECT * FROM participant WHERE (YEAR(CURDATE())-YEAR(DOB))- (RIGHT(CURDATE(),5)<RIGHT(DOB,5)) < 46 AND (YEAR(CURDATE())-YEAR(DOB))- (RIGHT(CURDATE(),5)<RIGHT(DOB,5)) > 35';
							$result_age = mysql_query($sql_age);
							$ageCount = 0;
							$ageCount = mysql_num_rows($result_age);
							echo "<div class='grid_2' align='center'>".round(($ageCount/$totalCount)*100)."%</div>";

							$sql_age = 'SELECT * FROM participant WHERE (YEAR(CURDATE())-YEAR(DOB))- (RIGHT(CURDATE(),5)<RIGHT(DOB,5)) < 56 AND (YEAR(CURDATE())-YEAR(DOB))- (RIGHT(CURDATE(),5)<RIGHT(DOB,5)) > 45';
							$result_age = mysql_query($sql_age);
							$ageCount = 0;
							$ageCount = mysql_num_rows($result_age);
							echo "<div class='grid_2' align='center'>".round(($ageCount/$totalCount)*100)."%</div>";

							$sql_age = 'SELECT * FROM participant WHERE (YEAR(CURDATE())-YEAR(DOB))- (RIGHT(CURDATE(),5)<RIGHT(DOB,5)) < 66 AND (YEAR(CURDATE())-YEAR(DOB))- (RIGHT(CURDATE(),5)<RIGHT(DOB,5)) > 55';
							$result_age = mysql_query($sql_age);
							$ageCount = 0;
							$ageCount = mysql_num_rows($result_age);
							echo "<div class='grid_2' align='center'>".round(($ageCount/$totalCount)*100)."%</div>";

							$sql_age = 'SELECT * FROM participant WHERE (YEAR(CURDATE())-YEAR(DOB))- (RIGHT(CURDATE(),5)<RIGHT(DOB,5)) > 65';
							$result_age = mysql_query($sql_age);
							$ageCount = 0;
							$ageCount = mysql_num_rows($result_age);
							echo "<div class='grid_2 omega' align='center'>".round(($ageCount/$totalCount)*100)."%</div>";
						}
					?>
				</fieldset>
			</div>
			<br />
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>