    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php 
		//Get Database
				require ('includes/db_connect.php');
				
		//Start Session for base security
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
			<title>Health and Wellness by Date</title>
			
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
					<div class='grid_16 center'><h1>Health and Wellness by Date</h1></div>
					<div class='clear'>&nbsp;</div>
					
					<?php
						$sql_user = 'select FIRSTNAME, LASTNAME from participant where PARTICIPANTID = '.$participantid;
						$result_user = mysql_query($sql_user);
						$row_user = mysql_fetch_row($result_user);
						$first = $row_user[0];
						$last = $row_user[1];
						echo "<div class='grid_16 center'><b>Select report date for: ".$first." ".$last."</b></div><div class='clear'>&nbsp;</div><br />";
						//build query to catch distinct date from result table
						$sql_date = 'select distinct DATE from hwaresult where PARTICIPANTID = '.$participantid;
						//run query to catch distinct date from result table
						$result_date = mysql_query($sql_date);
						//start loop to catch distinct date from result table
						$l=1;
						while($row_date = mysql_fetch_array($result_date))
						{
							echo "<form action='hwreportindividual.php' method='post' id='form".$l."' name='form".$l."'>";
							$hwdate = $row_date['DATE'];
							echo "<div class='grid_16 center'><a href=\"javascript: submitform('form".$l."')\">".$hwdate."</a></div><br />";
							echo "<input type='hidden' id='date' name='hwdate' value='".$hwdate."' />";
							echo "</form>";
							$l++;
						}
					?>
					<div class='clear'>&nbsp;</div>
					<div class='grid_16 buttonarea'><input type='button' value='Return to Applicant Forms' onclick='window.location="participantforms.php";' /></div><br />
					<div class='clear'>&nbsp;</div>					
				</div>
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>