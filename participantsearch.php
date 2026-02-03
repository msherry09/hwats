    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php 
		//Get Database
				require ('includes/db_connect.php');
				
		//Star Session for base security
				session_start();	
				
				unset($_SESSION['demoViews']);
				unset($_SESSION['lsViews']);
				unset($_SESSION['hwViews']);
				unset($_SESSION['wdbViews']);
				unset($_SESSION['paViews']);
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		
		<!-- Link to 960.css stylesheet & main.css stylesheet --> 
			<link rel="stylesheet" href="css/960_16.css" type="text/css" />
			<link href="css/main.css" rel="stylesheet" type="text/css" />
			
		<!-- Import JQuery -->
			<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>	
			
		<!-- Remember to Change Title! -->
			<title>Participant Search</title>
			
		<!-- JavaScript -->
			
	</head>
	<body>
		<div class="site" style="padding-bottom: 20px;"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->			
			<div class="container container_16">
				<div class='grid_16 center'><h1>Participant Search</h1></div>
				<div class='clear'>&nbsp;</div>				
				<div class='grid_16'>
					<div class='grid_1 prefix_2'><p><b>Action</b></p></div>
					<div class='grid_2'><p><b>Last Name</b></p></div>
					<div class='grid_2'><p><b>First Name</b></p></div>
					<div class='grid_5'><p><b>Email</b></p></div>
					<div class='grid_2'><p><b>City</b></p></div>
					<div class='grid_1'><p><b>State</b></p></div>
				</div>
				<div class='clear'>&nbsp;</div>
				<?php
					$sql = 'select * from participant ORDER BY LASTNAME ASC';
					$result = mysql_query($sql);
					$c = 1;
					while($row = mysql_fetch_array($result))
					{
						echo '<div class="grid_16';
						if($c % 2 != 0) echo ' grey">'; else echo '">';
						$c++;				
						echo "<div class='grid_1 prefix_2'><p>
									<form method='POST' action='participantforms.php'>
											<input type='hidden' name='id' value='".$row['PARTICIPANTID']."' />
											<input type='submit' value='View' /></form></p></div>";
						echo "<div class='grid_2'><p>".$row['LASTNAME']."</p></div>";					
						echo "<div class='grid_2'><p>".$row['FIRSTNAME']."</p></div>";
						echo "<div class='grid_5'><p>".$row['EMAIL']."</p></div>";
						echo "<div class='grid_2'><p>".$row['CITY']."</p></div>";
						echo "<div class='grid_1'><p>".$row['STATEID']."</p></div>";
						echo '</div>';
					}
				?>
			</div>			
			<!-- END PAGE CONTENT -->			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>