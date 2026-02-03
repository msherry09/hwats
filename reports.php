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
			<title>Overall Reports</title>
			
		<!-- JavaScript -->
			
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
			
				<div class="container container_16">
				<div class='grid_16 center'><h1>Reports</h1></div>
				<div class='clear'>&nbsp;</div>
				<div class='grid_3 prefix_4 reportheader'><b>Report Name</b></div>
				<div class='clear'>&nbsp;</div>
				<div class='grid_7 prefix_4'><p>Demographic Summary<p></div>
				<div class='grid_1'><p><input type='button' value='View'  onclick='window.location="demographicreportoverall.php";' /></p></div>
				<div class='clear'>&nbsp;</div>
				<div class='clear'>&nbsp;</div>
				<div class='grid_7 prefix_4'><p>Weight: Decisional Balance - Overall Report</p></div>
				<div class='grid_1'><p><input type='button' value='View' onclick='window.location="wdbreportoverall.php";' /></p></div>
				<div class='clear'>&nbsp;</div>				
				<div class='grid_7 prefix_4'><p>Lifestyle Questions - Overall Report</p></div>
				<div class='grid_1'><p><input type='button' value='View' onclick='window.location="lifestylereportoverall.php";' /></p></div>
				<div class='clear'>&nbsp;</div>				
				<div class='grid_7 prefix_4'><p>Health and Wellness Assessment - Overall Report</p></div>
				<div class='grid_1'><p><input type='button' value='View' onclick='window.location="hwoverallreport.php";' /></p></div>
				<div class='clear'>&nbsp;</div>
				
				</div>
				
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>