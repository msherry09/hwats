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
			<title>Lifestyle By Date</title>
			
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
				<div class='grid_16 center'><h1>Lifestyle Comments</h1></div>
				
				<div class='clear'>&nbsp;</div>
				
					
					<?php
						$lsquestionid = $_POST['questionid'];
						$start = $_POST['start'];
						$end = $_POST['end'];
						$sql_comment = 'select lsresult.LSCOMMENT, lsquestion.LSQUESTIONDESC from lsresult left join lsquestion on lsresult.LSQUESTIONID = lsquestion.LSQUESTIONID where lsresult.LSQUESTIONID = '.$lsquestionid.' and lsdate >= "'.$start.'" and lsdate <= "'.$end.'"';
						$result_comment = mysql_query($sql_comment);
						if($lsquestionid == 21)
							echo '<div class="grid_16"><b>What would make you decide to do something about your health and/or weight?</b></div><br /><br />';
						else if ($lsquestionid == 14)
							echo '<div class="grid_16"><b>What type of physical activity?</b></div><br /><br />';
						echo '<div class="grid_16" id="reportdisplay"><u>Comments submitted from: '.$start.' to: '.$end.'</u></div>';
						$c = 0;
						$l=1;
						while($row_comment = mysql_fetch_array($result_comment))
						{
							echo '<div class="grid_16';
							if($c % 2 != 1) echo ' grey">'; else echo '">';
							
							$lscomment = $row_comment['LSCOMMENT'];
							if($lscomment != null)
							{	
								echo "<div id='reportdisplay'>".$l.". ".$lscomment."</div><br />";
								$c++;
								$l++;
							}
							echo '</div>';
						}
					?>
				<div class='clear'>&nbsp;</div><br />
				<div class='buttonarea'><input type='button' value='Return to Lifestyle Overall Report' onclick='window.location="lifestylereportoverall.php";' /></div><br />
				<div class='clear'>&nbsp;</div><br />	
				</div>
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>