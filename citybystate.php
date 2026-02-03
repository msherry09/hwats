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
		
		<?php $stateID = $_POST['stateID'];	$stateName = $_POST['stateName'];?>
		
		<!-- Remember to Change Title! -->
			<title>Cities in <?php echo $stateName; ?></title>
			
		<!-- JavaScript -->
			
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
			<h1>Cities in <?php echo $stateName; ?></h1>
			
				<br />
				<div class="container container_16">
					<div class='grid_16'>
						<div class='grid_8 alpha' align='right'>List of Cities</div>
						<div class='grid_8 omega'>Number of Times</div>
					</div>
					<div class='clear'>&nbsp;</div>
					<?php
						
						$sql_city = "SELECT CITY, COUNT(CITY) CITYCOUNT FROM participant WHERE STATEID = '".$stateID."' GROUP BY CITY ORDER BY CITY";
						$result_city = mysql_query($sql_city);
						$i = 1;
						while($row_city = mysql_fetch_array($result_city))
						{
							$cityName = $row_city['CITY'];
							$cityCount = $row_city['CITYCOUNT'];
							echo '<div class="grid_16"';
								
								if($i % 2 != 0)
								{
									echo ' style="background-color:#e1e1e1"';
								}
								
								echo '>';
							echo "<div class='grid_8 alpha' align='right'>".$cityName."</div>";
							echo "<div class='grid_8 omega'>".$cityCount."</div>";
/*							if($cityCount > 1)
								echo "<div class='grid_8 omega'>x".$cityCount."</div>";*/
							echo "</div>";
							echo "<div class='clear'>&nbsp;</div>";
							$i++;
						}
					?>
					<div class="buttonarea"><input type='button' value='Back' onclick='window.location="demographicreportoverall.php"' /></div>
				</div>
				
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>