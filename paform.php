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
			<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet" /> 
			<script type="text/javascript" src="/js/jquery-ui-1.8.17.custom.min.js"></script>
			
		<!-- Remember to Change Title! -->
			<title>Participant Ackowledgement</title>
			
		<!-- JavaScript -->		
			
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
			<?php
				//if there is a partid from post, it is an update
				if(isset($_POST['partid']))
				{
					$partid = $_POST['partid'];
				}
				else //it is an insert
				{
					$partid = 0;
				}
			?>
			
			<h1>Participant Acknowledgement</h1>
			<form action="post/paformpost.php" method="post" id="myform">
			<br />
			<div class='clear'><input type='hidden' id='partid' name='partid' value='<?php echo $partid; ?>' /></div>
				<div class="container container_16">
					<?php
						$i = 1;
						$sql_questions = 'select * from paquestion'; 
						$result_questions = mysql_query($sql_questions);
							
						while($row_questions = mysql_fetch_array($result_questions))
						{
							//Grab the question and their ID
							$questionid = $row_questions['PAQUESTIONID'];
							$questiondesc = $row_questions['PAQUESTIONDESC'];
							//display the question
							echo '<div class="grid_16" style="white-space:pre-wrap">';
							echo '<p>'.$i.'. '.$questiondesc.'</p>';
							echo '</div>';
							echo '<div class="clear">&nbsp;</div>';
							
							//if this is an update, find the answer from the database
							if($partid != 0)
							{
								$sql = 'SELECT ANSWER FROM paresult WHERE PARTICIPANTID = '.$partid.' AND PAQUESTIONID = '.$questionid;
								$result = mysql_query($sql);
								$row = mysql_fetch_array($result);
								//if it is true, add the attributes to be checked and disabled
								if($row[0] == 'True')
								{
									$checked = ' checked="checked" disabled="disabled" ';
								}
								else
								{
									$checked = '  ';
								}
							}
							else
							{
								$checked = '  ';
							}
							
							//displays the check box input
							echo '<div class="grid_4 prefix_1"><input'.$checked.'type="checkbox" name="group'.$questionid.'" value="True">Accept Here</div>';									
							//New line
							echo "<div class='clear'>&nbsp;</div>";
							$i++;
						}												
					?>
					<div class="clear">&nbsp;</div>	
					<div class="buttonarea"><input type="submit" value="Submit"></div>						
				</div>
				<br />
				
			</form>
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>