    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php 
		//Get Database
				require ('includes/db_connect.php');
				
		//Star Session for base security
				session_start();
				
				//unset the session variable from the demographic form
				unset($_SESSION['demoViews']);
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		
		<!-- Link to 960.css stylesheet & main.css stylesheet --> 
			<link rel="stylesheet" href="css/960_16.css" type="text/css" />
			<link href="css/main.css" rel="stylesheet" type="text/css" />
			
		<!-- Import JQuery -->
			<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
			<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet" />	
			<script type="text/javascript" src="/js/jquery-ui-1.8.17.custom.min.js"></script>
			
		<!-- Remember to Change Title! -->
			<title>Demographic Report</title>
			
		<!-- JavaScript -->

	</head>
	<script>
	</script>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
				
				
				
				<?php
					//set session variable for participant ID
					if(isset($_SESSION['participantid']))
						$participantid = $_SESSION['participantid'];
					else
						$participantid = 3;
					
					//build and run query to retrieve information from participant table
					$sql_participant = "select * from participant where participantid = ".$participantid;
					$result_participant = mysql_query($sql_participant);
					$row_participant = mysql_fetch_row($result_participant);	
				?>
				
				<div class="container container_16">
					<div class='grid_16'><h1>Participant Demographic Report</h1></div>
					<div class='clear'>&nbsp;</div>	
					
				<fieldset>
					<LEGEND><b>Demographic Information</b></LEGEND>
					<div class='clear'>&nbsp;</div>
					<!--| build demographic report |-->
					<div class='grid_2 prefix_2'>
						<div class='right' id="reportdisplay"><b>First name:</b></div>
					</div>
					<div class='grid_2'id="reportdisplay"><?php	echo $row_participant[1]; ?></div>
						
					<div class='grid_2'>
						<div class='right' id="reportdisplay"><b>Last name:</b></div>
					</div>
					<div class='grid_2 suffix_3' id="reportdisplay"><?php echo $row_participant[2]; ?></div>
						
					<div class='clear'>&nbsp;</div><br />
						
					<div class='grid_2 prefix_2'>
						<div class='right' id="reportdisplay"><b>Date of Birth:</b></div>
					</div>
					<div class='grid_2'id="reportdisplay"><?php	echo $row_participant[3]; ?></div>
					<div class='grid_2'>
						<div class='right' id="reportdisplay"><b>Ethnic Origin:</b></div>
					</div>
					<div class='grid_4 suffix_2' id="reportdisplay">
					<?php
						//build and run query to retrieve information from racelookup table for display
						$sql_race = 'SELECT RACEDESC FROM racelookup where RACEID = '.$row_participant[8];
						$result_race = mysql_query($sql_race);
						$row_race = mysql_fetch_row($result_race);
						echo $row_race[0];						
					?></div>

					<div class='clear'>&nbsp;</div><br />	
											
					<div class='grid_2 prefix_2'>
						<div class='right' id="reportdisplay"><b>Address:</b></div>
					</div>
					<div class='grid_10'id="reportdisplay"><?php echo $row_participant[4]; ?> </div>
					
					<div class='clear'>&nbsp;</div>	<br />				
					<div class='grid_2 prefix_2'>
						<div class='right' id="reportdisplay"><b>City:</b></div>
					</div>
					<div class='grid_2'id="reportdisplay"><?php echo $row_participant[5]; ?> </div>
						
					<div class='grid_2'>
						<div class='right' id="reportdisplay"><b>State:</b></div>
					</div>
					<div class='grid_2'id="reportdisplay"><?php	echo $row_participant[7]; ?></div>
						
					<div class='grid_2'>
						<div class='right' id="reportdisplay"><b>Zip code:</b></div>
					</div>
					<div class='grid_2'id="reportdisplay"><?php	echo str_pad($row_participant[6], 5, "0", STR_PAD_LEFT); ?></div>
					
					<div class='clear'>&nbsp;</div> <br />	

					<!--[if IE]>
					<div class='grid_2 prefix_2'>
						<div class='right' id="reportdisplay"><b>Phone(home):</b></div>
					</div>
					<div class='grid_2'id="reportdisplay"><?php echo $row_participant[10]; ?> </div>
					<![endif]-->
					
					<![if !IE]>
					<div class='grid_2 prefix_2'>
						<div class='right' id="reportdisplay"><b>Phone(home):</b></div>
					</div>
					<div class='grid_2'id="reportdisplay">&nbsp;<?php echo $row_participant[10]; ?> </div>
					<![endif]>
					
					<div class='grid_2'>
						<div class='right' id="reportdisplay"><b>(work):</b></div>
					</div>
					<!--[if IE]>
					<div class='grid_2'id="reportdisplay"><?php echo $row_participant[11]; ?>	</div>
					<![endif]-->
					<![if !IE]>
					<div class='grid_2'id="reportdisplay">&nbsp;<?php echo $row_participant[11]; ?>	</div>
					<![endif]>
						
					<div class='grid_2'>
						<div class='right' id="reportdisplay"><b>(cell):</b></div>
					</div>
					<!--[if IE]>
					<div class='grid_2'id="reportdisplay"><?php echo $row_participant[12]; ?> </div>
					<![endif]-->
					<![if !IE]>
					<div class='grid_2'id="reportdisplay">&nbsp;<?php echo $row_participant[12]; ?> </div>
					<![endif]>
						
					<div class='clear'>&nbsp;</div><br />
						
						
					<div class='grid_2 prefix_2'>
						<div class='right' id="reportdisplay"><b>Email:</b></div>
					</div>
					<div class='grid_10'id="reportdisplay"><?php echo $row_participant[9]; ?></div>
						
					<div class='clear'>&nbsp;</div><br />
				</fieldset>
					
					<div class='clear'>&nbsp;</div><br />	
					
				<fieldset>
					<legend><b>Health Care Information</b></legend>
					<div class='clear'>&nbsp;</div><br />
					<div class='grid_5 prefix_1'>
						<div class='right' id="reportdisplay"><b>Do you have a primary health physician:</b></div>
					</div>
					<div class='grid_9'id="reportdisplay">
						<?php
							if($row_participant[14] == 1)
								echo "Yes";
							else
								echo "No";
						?>
					</div>
					<div class='clear'>&nbsp;</div><br />
						
					<div class='grid_5 prefix_1'>
						<div class='right' id="reportdisplay"><b>Have you ever been diagnosed with diabetes/pre-diabetes:</b></div>
					</div>
					<div class='grid_2'id="reportdisplay">
						<?php
							if($row_participant[15] == 1)
								echo "Yes";
							else
								echo "No";
						?>
					</div>
						
					<div class='grid_2'>
						<div class='right' id="reportdisplay"><b>If yes, which:</b></div>
					</div>
					
					<div class='grid_4'id="reportdisplay">
						<?php
							if($row_participant[16] == 1)
								echo "Diabetes";
							else if($row_participant[16] == '0')
								echo "Pre-diabetes";
							else
								echo "<i>Not Applicable</i>";
						?>
					</div>
					<div class='clear'>&nbsp;</div><br />
						
					<div class='grid_5 prefix_1'>
						<div class='right' id="reportdisplay"><b>Have you ever had education for diabetes/pre-diabetes:</b></div>
					</div>
					<div class='grid_2'id="reportdisplay">
						<?php
							if($row_participant[17] == 1)
								echo "Yes";
							else
								echo "No";
						?>
					</div>
						
					<div class='clear'>&nbsp;</div><br />
						
					<div class='grid_14 prefix_1'>
							<div id="reportdisplay"><b>Current Medications - check boxes if you take medication for any of the following:</b></div>
					</div>
					<div class='clear'>&nbsp;</div>
					<div class='grid_13 prefix_2'id="reportdisplay">
						<?php
							$loopCount = 0;
							$medCount = 0;
							$row_start = 18;
							while($loopCount < 8){
								if($row_participant[$row_start] == 1){
									$medCount++;
								}
								$row_start++;
								$loopCount++;
							}
						
							if($row_participant[18] == 1)
								echo "<div class='grid_2' align='center'>Diabetes<br />Pre-Diabetes</div>";
							if($row_participant[19] == 1)
								echo "<div class='grid_2' align='center'>Thyroid Issues</div>";
							if($row_participant[20] == 1)
								echo "<div class='grid_2' align='center'>Asthma Breathing Issues</div>";
							if($row_participant[21] == 1)
								echo "<div class='grid_2' align='center'>Mood<br />Anxiety<br />Depression</div>";
						
							if($medCount >= 5)
								echo "<div class='clear'>&nbsp;</div><br />";
						
							if($row_participant[22] == 1)
								echo "<div class='grid_2' align='center'>Pain</div>";
							if($row_participant[23] == 1)
								echo "<div class='grid_2' align='center'>Heart Issues</div>";
							if($row_participant[24] == 1)
								echo "<div class='grid_2' align='center'>Blood Pressure</div>";
							if($row_participant[25] == 1)
								echo "<div class='grid_2' align='center'>Cholesterol</div>";
						?>
					</div><div class='clear'>&nbsp;</div><br />
						<div class='grid_14 prefix_1'>
							<div id="reportdisplay"><b>Other Medication:</b>&nbsp;&nbsp;&nbsp;
							<?php									
								if($row_participant[26] != 0){
									$select_othermed = 'select * from othermed where OTHERMEDID ='.$row_participant[26];
									$result_othermed = mysql_query($select_othermed);
									$row_othermed = mysql_fetch_row($result_othermed);
									
									echo $row_othermed[2];
								}
								else{
									echo "<i>Not Applicable</i>";
								}
							?>
							</div>
						</div>						
						<div class='clear'>&nbsp;</div><br />
						
						<div class='grid_14 prefix_1'>
							<div id="reportdisplay"><b>Weight Watchers Status:</b>&nbsp;&nbsp;&nbsp;
							<?php
								$wwid = $row_participant[28];
								
								$sql_wwid = 'SELECT WWDESC FROM wwstatuslookup where WWID = '.$wwid;
								$result_wwid = mysql_query($sql_wwid);
								$row_wwid = mysql_fetch_row($result_wwid);
								echo $row_wwid[0];
								
								/*/
								switch($wwid){
									case 1:
										echo "Not Invited";
										break;
									case 2:
										echo "Invited";
										break;
									case 3:
										echo "Accepted";
										break;
									case 4:
										echo "Declined";
										break;
									case 5:
										echo "Submitted";
										break;
								}*/
							?>
						</div>
				</fieldset>
				<div class='clear'>&nbsp;</div>
				<form action="demographicform.php" name='demographicForm' id='demoForm' method="post">
					<div class='grid_16 buttonarea'>
					<input type='button' value='Return to Applicant Forms' onclick='window.location="participantforms.php"' />
					<!-- Button to edit participant information -->
					<input type='submit' value='Edit Applicant' />
					</div>
					<br />
					<!-- hidden field for participant ID -->
					<div class='clear'><input type='hidden' id='partid' name='partid' value='<?php echo $participantid; ?>' /></div>					
				</form>
				</div>
				<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>				
						
						