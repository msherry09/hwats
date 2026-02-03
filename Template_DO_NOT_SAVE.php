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
			<title>MyTitle</title>
			
		<!-- JavaScript -->
			
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
			
				<div class="container container_16 myContent">
				<div class='grid_8 prefix_2 suffix_2'><h1>Your Content Goes Here!</h1></div>
				<div class='clear'>&nbsp;</div>
				</div>
				
			<!-- END PAGE CONTENT -->
			<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
		</div><!-- END SITE CONTAINER -->
	</body>
</html>