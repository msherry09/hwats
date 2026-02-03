    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php 
		//Get Database
				require ('includes/db_connect.php');
				
		//Star Session for base security
				session_start();
				
				unset($_SESSION['demoViews']);
				
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		
		<!-- Link to 960.css stylesheet & main.css stylesheet --> 
			<link rel="stylesheet" href="css/960_16.css" type="text/css" />
			<link href="css/main.css" rel="stylesheet" type="text/css" />
			
			
		<!-- Import JQuery -->
			<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>	
			
		<!-- Remember to Change Title! -->
			<title>HWATS - Login</title>
			
		<!-- JavaScript -->
			
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
			
			<div class="container_16 container">
			<div class='grid_16 center'><h3>Please choose an option below</h3></div>
			<div class='clear'>&nbsp;</div>
			
			<div class='grid_4 prefix_1 left omega'>
			<fieldset>
			<legend><input type='button' value='New Participant' onclick='window.location = "demographicform.php"'/></legend>
				<p>Register a new participant for assessment.</p>
			</fieldset>
			</div>
			<div class='grid_4 prefix_1 left alpha omega'>
			<fieldset>
			<legend><input type='button' value='Participant Search' onclick='window.location = "participantsearch.php"'/></legend>
				<p>View information reports based on individual participants.</p>
			</fieldset>
			</div>
			<div class='grid_4 prefix_1 left alpha'>
			<fieldset>
			<legend><input type='button' value='Reports' onclick='window.location = "reports.php"'/></legend>
				<p>View information reports based on all collected participants.</p>
			</fieldset>
			</div>
			<div class='clear'>&nbsp;</div>
			</div>
				
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>