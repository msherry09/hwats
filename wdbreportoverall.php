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
			<title>HWATS - Weight: Decisional Balance Report - Overall</title>
			
		<!-- JavaScript -->
			
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
			
			<form id='myform'>
				<div class="container container_16">
					<br /><div class='clear'>&nbsp;</div>
					<div class='grid_6' align="center">How important is this to me?</div>
					<div class='grid_10' align="center">Importance in making a decision about losing weight:</div>
					<hr />
					<div class='clear'>&nbsp;</div>			
					<?php
						//run a query to check if there are records in the result table
						$sql_check = 'select * from wdbresults';
						$result_check = mysql_query($sql_check);
						$totalcheck = 0;
						$totalcheck = mysql_num_rows($result_check);
						//if there are no records, display that there are no records
						if($totalcheck == 0)
						{
							echo "<div class='grid_16' align='center'>No Records</div>";
						}
						else
						{
							echo '<div class="grid_16">';
							echo '<div class="grid_5">&nbsp;</div>';
							//set the query for answers
							$sql_answers = 'SELECT * FROM wdbanswer';
							$result_answers = mysql_query($sql_answers);
							while($row_answers = mysql_fetch_array($result_answers))
							{
								//Grab the answer and their ID
								$answerid = $row_answers['WDBANSWERID'];
								$answerdesc = $row_answers['WDBANSWERDESC'];
								//Display the answer as a radio button
								echo "<div class='grid_2' align='center'>".$answerdesc."</div>";
							}
							echo '</div>';
							echo "<div class='clear'>&nbsp;</div>";
							//echo "<hr />";
							echo "<div class='clear'>&nbsp;</div>";
							// get the questions												
							$sql_questions = 'select * from wdbquestions';
							$result_questions = mysql_query($sql_questions);
							//set the query for answers
							$sql_answers = 'SELECT * FROM wdbanswer';				
							$i = 1;
							while($row_questions = mysql_fetch_array($result_questions))
							{
								//Grab the question and their ID
								$questionid = $row_questions['WDBQUESTIONID'];
								$questiondesc = $row_questions['WDBQUESTIONDESC'];
								//set the backgrond to grey if the row is odd
								echo '<div class="grid_16 padding"';								
								if($i % 2 != 0)
								{
									echo ' style="background-color:#e1e1e1"';
								}								
								echo '>';
								//display the question
								echo '<div class="grid_5">'.$i.') '.$questiondesc.'</div>';
								//run query for answers
								$result_answers = mysql_query($sql_answers);
								
								//get the total of results for each question
								$sql_result = 'select * from wdbresults where WDBQUESTIONID = '.$questionid;
								$result_count = mysql_query($sql_result);
								$totalCounter = 0;
								$totalCounter = mysql_num_rows($result_count);	
								
								while($row_answers = mysql_fetch_array($result_answers))
								{		
									//Grab the answer and their ID
									$answerid = $row_answers['WDBANSWERID'];
									$answerdesc = $row_answers['WDBANSWERDESC'];								
																
									//get the total for each anwer for the current question
									$sql_result = 'select * from wdbresults where WDBQUESTIONID = '.$questionid.' and WDBANSWERID = '.$answerid;
									$result_count = mysql_query($sql_result);
									$answerCounter = 0;
									$answerCounter = mysql_num_rows($result_count);
									$percent = 0;
									//as long the total results is not 0, find the percentage (Prevents Divide By 0)
									if($totalCounter != 0)
										$percent = round(($answerCounter/$totalCounter)*100);
									//display the result as a percent (XX%)
									echo "<div class='grid_2' align='center'>".$percent."%</div>";
								}
								//New line
								echo "</div>";
								echo "<div class='clear'>&nbsp;</div>";
								$i++;							
							}
						}
					?>
				</div>
			</form>	
			<br />
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>