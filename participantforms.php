    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php 
		//Get Database
				require ('includes/db_connect.php');
				
		//Star Session for base security
				session_start();	

				if(isset($_POST['id']))
					$_SESSION['participantid'] = $_POST['id'];
				//echo $_SESSION['participantid'];				
				if(!isset($_SESSION['participantid']))
					header('Location: landingpage.php');
				
				//echo $_SESSION['participantid'];
				$sql = 'select PARTICIPANTID from paresult where PARTICIPANTID = '.$_SESSION['participantid'];
				$result = mysql_query($sql);
				$pa = mysql_num_rows($result);
				$sql = 'select PARTICIPANTID from wdbresults where PARTICIPANTID = '.$_SESSION['participantid'];
				$result = mysql_query($sql);
				$wdb = mysql_num_rows($result);
				$sql = 'select PARTICIPANTID from lsresult where PARTICIPANTID = '.$_SESSION['participantid'];
				$result = mysql_query($sql);
				$ls = mysql_num_rows($result);
				$sql = 'select PARTICIPANTID from hwaresult where PARTICIPANTID = '.$_SESSION['participantid'];
				$result = mysql_query($sql);
				$hwa = mysql_num_rows($result);
				$sql = 'select FIRSTNAME, LASTNAME from participant where PARTICIPANTID = '.$_SESSION['participantid'];
				$result = mysql_query($sql);
				$fname = mysql_result($result, 0, 'FIRSTNAME');
				$lname = mysql_result($result, 0, 'LASTNAME');
				$name = $fname.' '.$lname;
				
				//get the current iteration
				$sql_iteration = 'select ITERATION from participant where PARTICIPANTID = '.$_SESSION['participantid'];
				$result_iteration = mysql_query($sql_iteration);
				$row_iteration = mysql_fetch_row($result_iteration);//
				$iteration = $row_iteration[0];
				
				//get the number of rows in the lifestyle result table for the current iteration
				$sql = 'select PARTICIPANTID from lsresult where PARTICIPANTID = '.$_SESSION['participantid'].' and ITERATION = '.$iteration;
				$result = mysql_query($sql);
				$lsit = mysql_num_rows($result);//
				
				//get the number of questions that are agreed to from the participant acknowledge form
				$sql = 'select PARTICIPANTID from paresult where PARTICIPANTID = '.$_SESSION['participantid'].' AND ANSWER = "True"';
				$result = mysql_query($sql);
				$pach = mysql_num_rows($result);
				
				
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		
		<!-- Link to 960.css stylesheet & main.css stylesheet --> 
			<link rel="stylesheet" href="css/960_16.css" type="text/css" />
			<link href="css/main.css" rel="stylesheet" type="text/css" />
			
		<!-- Import JQuery -->
			<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>	
			
		<!-- Remember to Change Title! -->
			<title>Participant Forms</title>
			
		<!-- JavaScript -->
		
			
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
			
				<div class="container container_16">
				<div class='grid_16 center'><h1>Participant Forms - <?php echo $name; ?></h1></div>
				<div class='clear'>&nbsp;</div>
				<div class='grid_5 prefix_3'><b><p>Form Name</p></b></div>
				<div class='grid_2'><b><p>Status</p></b></div>
				<div class='grid_2'><b><p></p></b></div>
				<div class='clear'>&nbsp;</div>
				<div class='grid_5 prefix_3'><p>Demographic Information</p></div>
				<div class='grid_2'><p>Completed</p></div>
				<div class='grid_1'><p><input type='button' value='Begin' disabled='true' onclick='window.location="paform.php";' /></p></div>
				<div class='grid_1'><p><input type='button' value='View'  onclick='window.location="demographicreport.php";' /></p></div>
				<div class='clear'>&nbsp;</div>
				<div class='grid_5 prefix_3'><p>Participant Acknowledgement</p></div>
				<div class='grid_2'><p><?php if($pa == 0 ) echo 'Not Completed'; else if($pa > $pach) echo 'Partial Completed'; else echo 'Completed'; ?></p></div>
				<div class='grid_1'><p><input type='button' value='Begin' <?php if($pa != 0) echo "disabled='true'; " ?> onclick='window.location="paform.php";' /></p></div>
				<div class='grid_1'><p><input type='button' value='View' <?php if($pa == 0) echo "disabled='true'; " ?> onclick='window.location="pareport.php";' /></p></div>
				<div class='clear'>&nbsp;</div>
				<div class='grid_5 prefix_3'><p>Weight: Decisional Balance</p></div>
				<div class='grid_2'><p><?php if($wdb == 0 ) echo 'Not Completed'; else echo 'Completed'; ?></p></div>
				<div class='grid_1'><p><input type='button' value='Begin' <?php if($wdb != 0 || $pa == 0) echo "disabled='true'; " ?> onclick='window.location="wdbform.php";' /></p></div>
				<div class='grid_1'><p><input type='button' value='View' <?php if($wdb == 0) echo "disabled='true'; " ?> onclick='window.location="wdbreportindividual.php";' /></p></div>
				<div class='clear'>&nbsp;</div>				
				<div class='grid_5 prefix_3'><p>Lifestyle Questions</p></div>
				<div class='grid_2'><p><?php if($ls == 0 ) echo 'Not Completed'; else echo 'Completed'; ?></p></div>
				<div class='grid_1'><p><input type='button' value='Begin' <?php if($pa == 0 || $wdb == 0 || $lsit!= 0 || $pa > $pach) echo "disabled='true'; " ?> onclick='window.location="lifestyleform.php";' /></p></div>
				<div class='grid_1'><p><input type='button' value='View' <?php if($ls == 0) echo "disabled='true'; " ?> onclick='window.location="lifestylebydate.php";' /></p></div>
				<div class='clear'>&nbsp;</div>				
				<div class='grid_5 prefix_3'><p>Health and Wellness Assessment</p></div>
				<div class='grid_2'><p><?php if($hwa == 0 ) echo 'Not Completed'; else echo 'Completed'; ?></p></div>
				<div class='grid_1'><p><input type='button' value='Begin' <?php if($pa == 0 || $wdb == 0 || $lsit == 0 || $pa > $pach) echo "disabled='true'; " ?> onclick='window.location="HealthWellnessForm.php";' /></p></div>
				<div class='grid_1'><p><input type='button' value='View' <?php if($hwa == 0) echo "disabled='true'; " ?> onclick='window.location="hwbydate.php";' /></p></div>
				<div class='clear'>&nbsp;</div>
								
				<?php //echo $ls.' '.$pa.' '.$lsit.' '.$hwa; ?>
				</div>				
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>