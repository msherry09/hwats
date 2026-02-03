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
			<title>LifeStyle Questions Form</title>
			
		<!-- JavaScript -->
			
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
				
				<div class="container container_16">
					<div class='grid_16'><h1>Participant Lifestyle Report</h1></div>
					<div class='clear'>&nbsp;</div>
					<form action='lifestyleform.php' name='lifestyleReport' method='post' id='myform'>
						<?php
							$lsdate = $_POST['lsdate'];
							$sql_user = 'select FIRSTNAME, LASTNAME from participant where PARTICIPANTID = '.$participantid;
							$result_user = mysql_query($sql_user);
							$row_user = mysql_fetch_row($result_user);
							$first = $row_user[0];
							$last = $row_user[1];
						echo "<div class='grid_8 prefix_4 suffix_2'><div class='center'><b>".$first." ".$last."</b></div></div><div class='clear'>&nbsp;</div><br />";
						echo "<div class='grid_8 prefix_4 suffix_2'><div class='center'><b>".$lsdate."</b></div></div><div class='clear'>&nbsp;</div><br />";
						?>
						
						<fieldset>
							<legend><b>Lifestyle Information</b></legend>
							<br />
							<?php								
								//start counter for category numbering
								$i = 1;
								//build sql for category
								$sql_category = 'select * from lscategory';
								//run sql for category
								$result_category = mysql_query($sql_category);
								//start loop to pull categories and their subtext
								while($row_category = mysql_fetch_array($result_category))
								{
									//Catch cateogry name & Id
									$categoryid = $row_category['LSCATEGORYID'];
									$categorydesc = $row_category['LSCATEGORYDESC'];
									//Catch Subtext
									$cetegorysubtext = $row_category['SUBTEXT'];
									//print category//print subtext
									echo '<div class="grid_6 prefix_1">'.$i.'. <b><u>'.$categorydesc.'</u></b> - '.$cetegorysubtext.'</div>
									<div class="clear">&nbsp;</div>';
									echo "<br />";			
									//build sql for question
									$sql_question = 'Select * from lsquestion where LSCATEGORYID = '.$categoryid;
									//run sql for question 
									$result_question = mysql_query($sql_question);
									//start counter for question numbering where number of questions is < 4
									$l = 0;
									$qwerty = 1;
									//start loop to pull questions
									while($row_question = mysql_fetch_array($result_question))
									{
										//build array to letter the questions bassed on the value of $l i.e. 1,2,3 or 4
										$letter = array('a','b','c','d');
										//catch question id
										$questionid = $row_question['LSQUESTIONID'];
										//catch question text
										$questiontext = $row_question['LSQUESTIONDESC'];
										if($categoryid == 8)
											echo "<div class='grid_3 prefix_2' <i>".$questiontext."</i></div>";	
										else
											echo "<div class='grid_6 prefix_2'>".$letter[$l].". <i>".$questiontext."</i></div>";
										//increment question counter
										$l++;
										//build sql for results
										$sql_participantanswer = "select distinct lsanswer.LSANSWERDESC, lsanswer.LSANSWERID, lsresult.LSCOMMENT from lsresult left join lsanswer on lsanswer.LSANSWERID = lsresult.LSANSWERID where lsresult.LSQUESTIONID =".$questionid." and lsresult.PARTICIPANTID = ".$participantid." and LSDATE = '".$lsdate."'";
										//run sql for results
										$result_participantanswer = mysql_query($sql_participantanswer);
										//start loop to catch answers/results
										$physcialbreak = 1;
										while($row_participantanswer = mysql_fetch_array($result_participantanswer))
										{											
											//determine if result/answer is even or odd
											$amod = $qwerty % 2;
											//catch answer text
											$answerdesc = $row_participantanswer['LSANSWERDESC'];
											//catch comment text
											$answercomment = $row_participantanswer['LSCOMMENT'];
											//***********************************************************************************************************
											if($questionid == 14) //physical activity
											{				
												if($physcialbreak != 1)
													continue;
												//******************

												$sql_tmp = "select * from lsresult where lsresult.LSQUESTIONID =".$questionid." and lsresult.PARTICIPANTID = ".$participantid." and LSDATE = '".$lsdate."'";
												$result_tmp = mysql_query($sql_tmp);
												while($row_tmp = mysql_fetch_array($result_tmp))
												{
													$physicalid = $row_tmp['LSANSWERID'];
													if($physicalid == 1 || $physicalid < 2 || $physicalid == 56)
														continue;
													$sql_physical = "SELECT PHYSICALDESC FROM physicalactivitylookup WHERE PHYSICALID = ".$physicalid;
													$result_physical = mysql_query($sql_physical);
													$row_physical = mysql_fetch_array($result_physical);
													if($physcialbreak == 1)
														$answerdesc = $row_physical['PHYSICALDESC'];
													else
														$answerdesc = $answerdesc.', '.$row_physical['PHYSICALDESC'];
													$physcialbreak++;
												}
												//******************												
											}
											//***********************************************************************************************************
											if($questionid == 19)
											{	
												$tabaccoid = $row_participantanswer['LSANSWERID'];
												$sql_tabacco = "SELECT TOBACCODESC FROM tobaccolookup WHERE TOBACCOID = ".$tabaccoid;
												$result_tabacco = mysql_query($sql_tabacco);
												$row_tabacco = mysql_fetch_array($result_tabacco);
												$answerdesc = $row_tabacco['TOBACCODESC'];
												if($tabaccoid == 1)
												{
													$answerdesc = '';
												}
											}
											
											if($categoryid != 8)
											{
												if($answerdesc != 'INPUT' and $answerdesc != 'TEXTAREA')
													echo "<div class='grid_3 prefix_1' id='reportdisplay'><b>".$answerdesc."</b></div>";
												if($answercomment != 'null' && $questionid != 14)
													echo "<div class='grid_5 prefix_1' id='reportdisplay'><b>".$answercomment."</b></div>";
											}
											else
											{
												if($amod == 0)
												{
													if($answerdesc != 'INPUT' and $answerdesc != 'TEXTAREA')
														echo "<div class='grid_2' id='reportdisplay'><b>".$answerdesc."</b></div><div class='clear'>&nbsp;</div><br />";
													else
														echo "<div class='grid_2' id='reportdisplay'><b>".$answercomment."</b></div>";
												}
												else
												{	
													echo "<div class='grid_2' id='reportdisplay'><b>".$answerdesc."</b></div>";
												}
											}	
											$qwerty++;
										}
										if($categoryid != 8)
											echo "<div class='clear'>&nbsp;</div><br />";
									}
									echo "<div class='clear'>&nbsp;</div>";
									//increment category counter
									$i++;
								}
							?>
						</fieldset>
						<div class='grid_16 buttonarea'><input type='button' value='Return to Lifestyle Reports' onclick='window.location="lifestylebydate.php"' />
						<?php
							$sql_lsiteration = 'select ITERATION from lsresult where LSDATE = "'.$lsdate.'" and PARTICIPANTID ='.$participantid;
							$result_lsiteration = mysql_query($sql_lsiteration);
							$row_lsiteration = mysql_fetch_row($result_lsiteration);
							
							$sql_paiteration = 'select ITERATION from participant where PARTICIPANTID ='.$participantid;
							$result_paiteration = mysql_query($sql_paiteration);
							$row_paiteration = mysql_fetch_row($result_paiteration);
							
							/* if($row_lsiteration[0] == $row_paiteration[0])
							{ */
						?>
						<input type='submit' value='Edit Information' />
						<?php //} ?>
						</div>
						<div class='clear'><input type='hidden' id='partid' name='partid' value='<?php echo $participantid; ?>' /><input type='hidden' id='lsdate' name='lsdate' value='<?php echo $lsdate; ?>' /></div>
					</form>
					<div class='clear'>&nbsp;</div>
					
				</div>
			<!-- END PAGE CONTENT -->			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>