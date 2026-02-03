    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php 
		//Get Database
				require ('includes/db_connect.php');
				
		//Start Session for base security
				session_start();
				
				//Set the participant ID
				if(isset($_SESSION['participantid']))
					$participantid = $_SESSION['participantid'];
				else
					$participantid = 1;
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		
		<!-- Link to 960.css stylesheet & main.css stylesheet --> 
			<link rel="stylesheet" href="css/960_16.css" type="text/css" />
			<link href="css/main.css" rel="stylesheet" type="text/css" />
			
		<!-- Import JQuery -->
			<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>	
			
		<!-- Remember to Change Title! -->
			<title>Health and Wellness Assessment - Report</title>
			
		<!-- JavaScript -->
			
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
				<div class="container container_16">
					<div class='grid_16 center'><h1>Health and Wellness Assessment Report</h1></div>
					<div class='clear'>&nbsp;</div>
					<?php
						$hwdate = $_POST['hwdate'];
						
						//build query and retrieve name for the participant
						$sql_name = "select FIRSTNAME, LASTNAME from participant where PARTICIPANTID = ".$participantid;
						$result_name = mysql_query($sql_name);
						$row_name = mysql_fetch_row($result_name);
						
						//build query and retrieve information from hwaresult table
						$sql_hwaresult = "select * from hwaresult where PARTICIPANTID = ".$participantid." and DATE = '".$hwdate."'";
						$result_hwaresult = mysql_query($sql_hwaresult);
						$row_hwaresult = mysql_fetch_row($result_hwaresult);

						$hwid = $row_hwaresult[0];
					?>
					<!-- <form action='post/HealthWellnessFormpost.php' method='post' id='myform'> -->
					<fieldset>
					<LEGEND><b>Measurement Information</b></LEGEND>
					
					<div class='clear'>&nbsp;</div>
						
					<form action="post/HealthWellnessFormpost.php" method="post">
						
							<div class='grid_2 prefix_2'>
								<div class='right' id="reportdisplay"><b>Participant:</b></div>
							</div><div class='grid_2'id="reportdisplay"><?php
								echo $row_name[0]." ".$row_name[1];?>
							</div>
							
							<div class='clear'>&nbsp;</div><br />
							
							<div class='grid_2 prefix_2'>
								<div class='right' id="reportdisplay"><b>Height:</b></div>
							</div>
							<div class='grid_2'id="reportdisplay"><?php
								echo $row_hwaresult[2];?>
							</div>
							
							<div class='clear'>&nbsp;</div>
							
							<div class='grid_2 prefix_2'>
								<div class='right' id="reportdisplay">(w/shoes)</div>
							</div>
							<div class='grid_2'id="reportdisplay"><?php
								if($row_hwaresult[3] == 0)
									echo "No";
								else
									echo "Yes";?>
							</div>

							<div class='clear'>&nbsp;</div><br />	
												
							<div class='grid_2 prefix_2'>
								<div class='right' id="reportdisplay"><b>Weight:</b></div>
							</div>
							<div class='grid_2'id="reportdisplay"><?php
								echo $row_hwaresult[4]." lbs.";?>
							</div>
							
							<div class='clear'>&nbsp;</div>	
				
							<div class='grid_2 prefix_2'>
								<div class='right' id="reportdisplay">(w/shoes)</div>
							</div>
							<div class='grid_2'id="reportdisplay"><?php
								if($row_hwaresult[5] == 0)
									echo "No";
								else
									echo "Yes";?>
							</div>
							
							<div class='clear'>&nbsp;</div><br />
							
							<div class='grid_2 prefix_2'>
							<div class='right' id="reportdisplay"><b>BMI:</b></div>
							</div>
							<div class='grid_2'id="reportdisplay"><?php
								echo $row_hwaresult[6];?>
							</div>
							
							<div class='clear'>&nbsp;</div><br />
							
							<div class='grid_4'>
								<div class='right' id="reportdisplay"><b>Waist circumference:</b></div>
							</div>
							<div class='grid_2'id="reportdisplay"><?php
								echo $row_hwaresult[7]." inches";?>
							</div>
							
							<div class='clear'>&nbsp;</div><br />
						
							<div class='grid_2 prefix_2'>
								<div class='right' id="reportdisplay"><b>A1C:</b></div>
							</div>
							<div class='grid_2'id="reportdisplay"><?php
								echo $row_hwaresult[8]."%";?>
							</div>
							
							<div class='clear'>&nbsp;</div><br />
							
							<div class='grid_4'>
								<div class='right' id="reportdisplay"><b>Completed by:</b></div>
							</div>
							<div class='grid_2'id="reportdisplay"><?php
								echo $row_hwaresult[9];?>
							</div>
							
							<div class='clear'>&nbsp;</div><br />
							
							<div class='grid_2 prefix_2'>
								<div class='right' id="reportdisplay"><b>Date:</b></div>
							</div>
							<div class='grid_2'id="reportdisplay"><?php
								echo $row_hwaresult[10];?>
							</div>
							
							<div class='clear'>&nbsp;</div><br />
													
					</fieldset>
					</form>
					<div class="grid_16 buttonarea">
					<form action="HealthWellnessForm.php" name='hweditForm' id='hweditForm' method="post">
						<input type='button' value='Return to Health and Wellness By Date' onclick='window.location="hwbydate.php"' />
						<input type='submit' value='Edit Health Info' />
						<div class='clear'><input type='hidden' id='hwid' name='hwid' value='<?php echo $hwid; ?>' /></div>					
					</form>
					</div>
						
					
				</div>				
			
				
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>