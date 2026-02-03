    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php 
		//Get Database
			require ('includes/db_connect.php');
				
		//Star Session for base security
			session_start();
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
			<title>Other Medications</title>
			
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
			
				<div class="container container_16">
				<div class='grid_16 center'><h1>Other Medications</h1></div>
				
				<div class='clear'>&nbsp;</div>
				
					
					<?php
						$sql_othermed = "select * from othermed WHERE MEDICATION IS NOT NULL";
						$result_othermed = mysql_query($sql_othermed);
						$othermed_count = mysql_num_rows($result_othermed);
						$c = 0;
						$l=1;
						if($othermed_count == 0){
							echo "<div class='grid_16 center'>No other medications found.</div>";
						}
						else{
							while($row_othermed = mysql_fetch_array($result_othermed))
							{
								echo '<div class="grid_16';
								if($c % 2 != 1) echo ' grey">'; else echo '">';
								
								$medication = $row_othermed['MEDICATION'];
								
								echo "<div id='reportdisplay'>".$l.". ".$medication."</div><br />";
								$c++;
								$l++;
								
								echo '</div>';
							}
						}
						
					?>
				<div class='clear'>&nbsp;</div><br />
				<div class='buttonarea'><input type='button' value='Back' onclick='window.location="demographicreportoverall.php";' /></div><br />
				<div class='clear'>&nbsp;</div><br />	
				</div>
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>