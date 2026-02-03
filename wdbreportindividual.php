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
			<title>HWATS - Weight: Decisional Balance Report - Individual</title>
			
		<!-- JavaScript -->
			
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
			<form action="wdbform.php" name='myform' id='myform' method="post">
				<div class="container container_16">
					<br/><div class='clear'>&nbsp;</div>	
					<div class='grid_6' align="center">How important is this to me?</div>
					<div class='grid_10' align="center">Importance in making a decision about losing weight:</div>
					<hr />
					<div class='clear'>&nbsp;</div>			
					<?php											
						if(isset($_SESSION['participantid']))
							$participantid = $_SESSION['participantid'];
						else
							$participantid = 1;
							
						// get the questions
						$sql_questions = 'select * from wdbquestions';
						$result_questions = mysql_query($sql_questions);
						//set the query for answers				
						$i = 1;
						while($row_questions = mysql_fetch_array($result_questions))
						{
							//Grab the question and their ID
							$questionid = $row_questions['WDBQUESTIONID'];
							$questiondesc = $row_questions['WDBQUESTIONDESC'];
							
							//set the background color to grey if the row is odd
							echo '<div class="grid_16 padding"';								
							if($i % 2 != 0)
							{
								echo ' style="background-color:#e1e1e1"';
							}								
							echo '>';
							
							//display the question
							echo '<div class="grid_5">'.$i.') '.$questiondesc.'</div>';
							//run query for answer to retrieve the name of the answer
							$sql_answer = 'select wdbanswer.WDBANSWERDESC from wdbresults join wdbanswer on wdbresults.wdbanswerid = wdbanswer.wdbanswerid where wdbresults.wdbquestionid = '.$questionid.' AND wdbresults.participantid = '.$participantid;							
							$result_answer = mysql_query($sql_answer);
							$row_answers = mysql_fetch_array($result_answer);
							$answerdesc = $row_answers['WDBANSWERDESC'];
							//display the answer
							echo '<div class="grid_10" align="center">'.$answerdesc.'</div>';
							echo '</div>';
							//New line
							echo "<div class='clear'>&nbsp;</div>";
							$i++;							
						}
					?>
				
			<div class='clear'>&nbsp;</div>
			<div class='grid_16 buttonarea'>
				<input type='button' value='Return to Applicant Forms' onclick='window.location="participantforms.php";' />
				<?php 
					//build query to get the current iteration number from the participant table
					$sql_iteration = 'select ITERATION from participant where PARTICIPANTID = '.$participantid;
					//run query
					$result_iteration = mysql_query($sql_iteration);
					//retrieve iteration number and place into variable
					$row_iteration = mysql_fetch_row($result_iteration);
					$iteration = $row_iteration[0];
					
					//if it is the first iteration, display the edit button
					if($iteration == 1){
				?>
				<input type='submit' value='Edit Information' />
				<?php } ?>
			</div>
			<br />
			<div class='clear'><input type='hidden' id='partid' name='partid' value='<?php echo $participantid; ?>' /></div>
			</form>
					
			</div>	
			<!-- END PAGE CONTENT -->			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>