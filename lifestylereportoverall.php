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
			<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>	
				<script src="js/jquery.maskedinput-1.3.js" type="text/javascript"></script>
		<!-- Remember to Change Title! -->
			<title>Lifestyle Report - Overall</title>
			
		<!-- JavaScript -->
		<script type="text/javascript">
			$(function() {
				$( "#start" ).datepicker({
					dateFormat: 'yy-mm-dd',
					changeMonth: true,
					changeYear: true,
					yearRange: '2011:2099'

				});
		
				$( "#format" ).change(function() {
					$( "#start" ).datepicker( "option", "dateFormat", $( this ).val() );
				});
			
				$( "#end" ).datepicker({
					dateFormat: 'yy-mm-dd',
					changeMonth: true,
					changeYear: true,
					yearRange: '2011:2099'

				});
		
				$( "#format" ).change(function() {
					$( "#end" ).datepicker( "option", "dateFormat", $( this ).val() );
				});
			});

			function submitform(myform)
			{
				document.forms[myform].submit();
			}
		
			function validateForm()
			{
				document.getElementById("startError").innerHTML="&nbsp;";
				document.getElementById("endError").innerHTML="&nbsp;";
				var start = 'start';
				if(!validatedate(start))
				{
					document.getElementById("startError").innerHTML = "Please enter a valid date (YYYY-MM-DD)";
					numErrors++;
					return false;
				}
				var end = 'end';
				if(!validatedate(end))
				{
					document.getElementById("endError").innerHTML = "Please enter a valid date (YYYY-MM-DD)";
					numErrors++;
					return false;
				}
				
				//If any errors are raised the form will not submit and alert the user.
				if(numErrors == 0)
				{
					return true;
				}
				else
				{
					alert("Please complete the entire form.");
					return false;
				}
			
			}
			//////////////Begin Date Validation/////////////////////
			function validatedate(target)
			{				
				var mydate = document.getElementById(target).value;
				var myarr = mydate.split("-");
				var errors = 0;
				var maxdays = 0;
				var leapyear = isleap(myarr[0]);
				
				
				if(myarr[1] > 0 && myarr[1] < 13)
				{
					errors = 0;
					if(myarr[1] == 1)	{maxdays = 31;}
					if(myarr[1] == 2)	{maxdays = 28;}
					if(myarr[1] == 3)	{maxdays = 31;}
					if(myarr[1] == 4)	{maxdays = 30;}
					if(myarr[1] == 5)	{maxdays = 31;}
					if(myarr[1] == 6)	{maxdays = 30;}
					if(myarr[1] == 7)	{maxdays = 31;}
					if(myarr[1] == 8)	{maxdays = 31;}
					if(myarr[1] == 9)	{maxdays = 30;}
					if(myarr[1] == 10)	{maxdays = 31;}
					if(myarr[1] == 11)	{maxdays = 30;}
					if(myarr[1] == 12)	{maxdays = 31;}
					
					if(myarr[1] == 2 && leapyear == 'true')
						{maxdays = 29;}
					
					if(myarr[2] > 0 && myarr[2] <= maxdays)
					{
						errors = 0;
						if(myarr[0] > 1900 && myarr[0] < 2100)
							errors = 0;
						else
							errors = 1;
					}
					else
						errors = 2;
				}
				else
					errors = 3;
				if(errors >= 1)
				{
					return false;
				}
				else
				{
					return true;
				}
			}
			
			
			function isleap(year)
			{
				var yr=year;
				if ((parseInt(yr)%4) == 0)
				{
					if (parseInt(yr)%100 == 0)
					{
						if (parseInt(yr)%400 != 0)
							return "false";
						if (parseInt(yr)%400 == 0)
							return "true";
					}
					if (parseInt(yr)%100 != 0)
						return "true";
				}
				if ((parseInt(yr)%4) != 0)
					return "false";
			}
			/////////////////End Date Validation/////////////////////

			jQuery(function($){
				$("#start").mask("9999-99-99", {
					placeholder : " "
				});
			});
			
			jQuery(function($){
				$("#end").mask("9999-99-99", {
					placeholder : " "
				});
			});
		</script>
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
			<div class="container container_16">
				<div class='grid_16' align="center"><h1>Overall Lifestyle Report</h1></div>
				<div class='clear'>&nbsp;</div><br />	
				<?php
					if(isset($_POST['submit'])) 
					{ 
						$startdate = $_POST['start'];
						$enddate = $_POST['end'];
					}
					else
					{	
						$startdate = "2012-01-01";
						$enddate = date("Y-m-d");
					}
					
				?>
				<form id='myform' action="lifestylereportoverall.php" method="post" onsubmit='return validateForm();'>
					<fieldset>
						<legend><p><b>Filter by Date</b></p></legend>
						<div class='grid_5'><div class='errortext' id='startError'>&nbsp;</div></div>
						<div class='grid_5 suffix_3'><div class='errortext' id='endError'>&nbsp;</div></div>
						<div class="left">
							<div class="grid_5">Starting Date:<input type="text" size="10" name="start" id="start" value="<?php echo $startdate; ?>"/></div>
							<div class="grid_5">Ending Date:<input type="text" size="10" name="end" id="end" value="<?php echo $enddate; ?>"/></div>
						</div><div class="grid_1"><div class="right"><input type="submit" name="submit" id="button" value="Go"></div></div>
						<div class='clear'>&nbsp;</div><br />
						<?php
							//build sql for sample size
							$sql_samplesize = 'select lsresultid from lsresult where lsquestionid = 1 and lsdate >= "'.$startdate.'" and lsdate <= "'.$enddate.'"';
							//run sql for sample size
							$result_samplesize = mysql_query($sql_samplesize);
							//count result for sample size
							$samplesize = mysql_num_rows($result_samplesize);
							//display count as sample size
							//echo "<div class='grid_16' id='answertext' align='center'>Sample Size:".$samplesize."</div>";
						?>
					</fieldset>
				</form>
				<br />
				<fieldset>
					<legend><b>Lifestyle Information</b></legend>
					<?php
						/*
						//build sql for sample size
						$sql_samplesize = 'select lsresultid from lsresult where lsquestionid = 1 and lsdate >= "'.$startdate.'" and lsdate <= "'.$enddate.'"';
						//run sql for sample size
						$result_samplesize = mysql_query($sql_samplesize);
						//count result for sample size
						$samplesize = mysql_num_rows($result_samplesize);
						//display count as sample size
						//echo "<div class='grid_16' id='answertext' align='center'>Sample Size:".$samplesize."</div>";
						*/
						if($samplesize == 0)
						{
							echo "<div class='grid_16' align='center'>No records</div>";
						}
						else
						{
								
						//counter for categories
						$i=1;
						$participantid = 1;
								
						//catch categories from database
						$sql_category = 'select * from lscategory';
						$result_category = mysql_query($sql_category);
								
						//comment form name variable
						$formcount = 0;
								
						//start loop to display category
						while($row_category = mysql_fetch_array($result_category))
						{
							//Grab the category and their ID
							$categoryid = $row_category['LSCATEGORYID'];
							$categorydesc = $row_category['LSCATEGORYDESC'];
									
							//display the category
							echo "<div class='clear'>&nbsp;</div><br />";
							echo '<div class="grid_15"><b><u>'.$i.'. '.$categorydesc.'</u></b></div><div class="clear">&nbsp;</div><hr />';
									
							//catch questions from database
							$sql_question = 'select * from lsquestion where LSCATEGORYID = '.$categoryid;
							//run sql for question 
							$result_question = mysql_query($sql_question);
								
							//start counter for question numbering where number of questions is < 4
							$l = 0;
							$i++;
							$cat8col = 1;
							//start loop to display questions
							while($row_question = mysql_fetch_array($result_question))
							{
								$formcount++;
								//build array to letter the questions based on the value of $l i.e. 1,2,3 or 4
								$letter = array('a','b','c','d','e','f','g','h','i','j','k','l');
								//catch question id
								$questionid = $row_question['LSQUESTIONID'];
								//catch question text
								$questiontext = $row_question['LSQUESTIONDESC'];
										
								//identify question number
								$questionfinder = $categoryid.'.'.$letter[$l];
										
								//print question text
								if($categoryid == 8)
								{
								
									if($cat8col % 2 != 0)
									{
										echo '<div class="grid_7 prefix_1 alpha" align="center">'.$questiontext.'<br />';
									}
									else
									{
										echo '<div class="grid_7 omega" align="center">'.$questiontext.'<br />';
									}
									
									//$cat8col++;
								/*
									echo '<div class="grid_15 prefix_1">'.$questiontext.'</div>';
								*/
									
								}
								else if($questionfinder == '6.b')
								{	
									echo "<div class='clear'>&nbsp;</div><br />";
									echo '<div class="grid_13 prefix_1">'.$letter[$l].'.'.$questiontext.'</div><div class="clear">&nbsp;</div><br />';
								}
								else if($questionfinder == '4.b')
								{
//************************************************************************************************************************************************************
	//Physical Activity Section								
	echo "<div class='clear'>&nbsp;</div><br />";
	echo '<div class="grid_13 prefix_1">'.$letter[$l].'.'.$questiontext.'</div>';
	echo "<div class='clear'>&nbsp;</div><br />";
	
	$sql_temp = 'SELECT DISTINCT PARTICIPANTID, ITERATION FROM lsresult WHERE LSQUESTIONID = 14 and LSDATE >= "'.$startdate.'" and LSDATE <= "'.$enddate.'"';
	$result_temp = mysql_query($sql_temp);
	$tempcount = mysql_num_rows($result_temp);
	
	$sql_physical = 'SELECT * FROM physicalactivitylookup WHERE PHYSICALID > 1 ORDER BY ITEMORDER';
	$result_physical = mysql_query($sql_physical);
	$layoutcount = 1;
	while($row_physical = mysql_fetch_array($result_physical))
	{
		$physicalid = $row_physical['PHYSICALID'];
		$physicaldesc = $row_physical['PHYSICALDESC'];
		$sql_phyresult = 'SELECT * FROM lsresult WHERE LSQUESTIONID = '.$questionid.' AND LSANSWERID = '.$physicalid.' and lsdate >= "'.$startdate.'" and lsdate <= "'.$enddate.'"';
		$result_phyresult = mysql_query($sql_phyresult);
		$physicalcount = 0;
		$physicalcount = mysql_num_rows($result_phyresult);
		$physicalpercent = 0;
		if($tempcount != 0)
		{
			$physicalpercent = round(($physicalcount/$tempcount)*100);
		}
		else
			$physicalpercent = 0;
		
		if($layoutcount % 5 == 1)
		{
			$gridsize = 'grid_2 prefix_2';
		}
		else
		{
			$gridsize = 'grid_2';
		}		
		echo "<div class='".$gridsize."' id='answertext'><u>".$physicaldesc."</u><p>".$physicalpercent."%</p></div>";
		if($layoutcount % 5 == 0)
		{
			echo "<div class='clear'>&nbsp;</div><br />";
		}
		$layoutcount++;
	}
	echo "<div class='clear'>&nbsp;</div><br />";

//************************************************************************************************************************************************************
}
								else if($questionfinder == '7.b')
								{	
									echo "<div class='clear'>&nbsp;</div><br />";
									echo "<form action='lifestylecomments.php' method='post' name=form".$formcount.">";
									echo "<div class='grid_12 prefix_1'>".$letter[$l].'.'.$questiontext."<br/>&nbsp;&nbsp;<a href=\"javascript: submitform('form".$formcount."')\">Show all comments</a></div>";
									echo "<input type='hidden' name='questionid' value='".$questionid."'>";
									echo "<input type='hidden' name='start' value='".$startdate."'>";
									echo "<input type='hidden' name='end' value='".$enddate."'></form>";
								}
								else	
									echo '<div class="grid_13 prefix_1">'.$letter[$l].'.'.$questiontext.'</div>';
										
								//build sql for answer
								$sql_answers = 'select * from lsanswer where LSQUESTIONID = '.$questionid;
								//run sql for answer
								$result_answer = mysql_query($sql_answers);
								//determine number of answers for question
								$num_answers = mysql_num_rows($result_answer);
										
								//build sql for result
								$sql_questionresult = 'select * from lsresult where LSQUESTIONID = '.$questionid.' and lsdate >= "'.$startdate.'" and lsdate <= "'.$enddate.'"';
								//run sql for result
								$result_questionresult = mysql_query($sql_questionresult);
								//determine number of results for question
								$num_questionresult = mysql_num_rows($result_questionresult);
										
								$l++;
								$a=1;
										
								//echo "<div class='clear'>&nbsp;</div>";
								while($row_answer = mysql_fetch_array($result_answer))
								{
									//identify answer number, 1=1, 2=2, 3=3, 4=0
									$amod = $a % 4;
											
									//catch answer id
									$answerid = $row_answer['LSANSWERID'];
											
									//catch answer text and comment
									$answertext = $row_answer['LSANSWERDESC'];
									//$answercomment = $row_answer['LSCOMMENT'];
											
									$sql_answerresult = 'select * from lsresult where LSQUESTIONID = '.$questionid.' and LSANSWERID = '.$answerid.' and lsdate >= "'.$startdate.'" and lsdate <= "'.$enddate.'"';
									$result_answerresult = mysql_query($sql_answerresult);
									$num_answerresult = 0;
									$num_answerresult = mysql_num_rows($result_answerresult);
									//echo $num_answers."-".$num_questionresult;
									if($num_questionresult != 0)
									{
										$try = ($num_answerresult/$num_questionresult)*100;
										$percent = round($try);
									}
									else
									{
										$percent = 0;
									}
									//print question text
									if($categoryid == 8)	
									{	
										//echo '</div>';
										if($answertext == 'YES')
										{
											echo '<div id="answertext" class="grid_3 suffix_1 alpha" align="center"><p><u>'.$answertext.'</u><br />'.$percent.'%</p></div>';
										}
										else
										{
											echo '<div id="answertext" class="grid_3 omega" align="center"><p><u>'.$answertext.'</u><br />'.$percent.'%</p></div>';
											if($cat8col % 2 != 0)
											{
												echo '</div>';
											}
											else
											{
												echo "</div><br />";
											}
											$cat8col++;
										}
										/*
										if($answertext == 'YES')
											echo '<div id="answertext" class="grid_1 prefix_1"><u>'.$answertext.'</u><br />'.$percent.'%</div>';
										else if($answertext == 'INPUT')
											echo '';
										else
											echo '<div id="answertext" class="grid_1"><u>'.$answertext.'</u><br />'.$percent.'%</div><br /><br />';
											*/
									}
									else
									{
										if($questionfinder != '4.b' and $questionfinder != '2.d')
										{	
											if($amod==1)
												if($questionfinder == '7.b')
													echo '<br />';
												else if($questionfinder == '6.b')
												{
													$sql_tobacco = 'select * from tobaccolookup order by tobaccoid';
													$result_tobacco = mysql_query($sql_tobacco);
													while($row_tobacco = mysql_fetch_array($result_tobacco))
													{
														$tobaccoid = $row_tobacco['TOBACCOID'];
														$tobaccodesc = $row_tobacco['TOBACCODESC'];
														$sql_tobresult = 'SELECT * FROM lsresult WHERE LSQUESTIONID = '.$questionid.' AND LSANSWERID = '.$tobaccoid.' and lsdate >= "'.$startdate.'" and lsdate <= "'.$enddate.'"';
														$result_tobresult = mysql_query($sql_tobresult);
														$tobacoocount = 0;
														$tobacoocount = mysql_num_rows($result_tobresult);
														$tobaccopercent = 0;
														if($num_questionresult != 0)
														{
															$tobaccopercent = round(($tobacoocount/	$num_questionresult)*100);
														}
														else
															$tobacoopercent = 0;
																
														if($tobaccodesc == '(Select)')
															echo "<div class='grid_2 prefix_2' id='answertext'><u>None</u><p>".$tobaccopercent."%</p></div>";
														else if($tobaccodesc == 'Chewing/Smokeless')
															echo "<div class='grid_3' id='answertext'><u>".$tobaccodesc."</u><p>".$tobaccopercent."%</p></div>";
														else if($tobaccodesc == 'Cigarettes')
															echo "<div class='grid_2' id='answertext'><u>".$tobaccodesc."</u><p>".$tobaccopercent."%</p></div>";
														else
															echo "<div class='grid_2' id='answertext'><u>".$tobaccodesc."</u><p>".$tobaccopercent."%</p></div>";	
																
													}
													echo "<div class='clear'>&nbsp;</div><br />";

												}
												else	
													echo '<div id="answertext" class="grid_2 prefix_2"><u>'.$answertext.'</u><br />'.$percent.'%</div>';
											else if($amod==0)		
												echo '<div id="answertext" class="grid_2 "><u>'.$answertext.'</u><br />'.$percent.'%</div><br /><br /><br />';	
											else
												echo '<div id="answertext" class="grid_2 "><u>'.$answertext.'</u><br />'.$percent.'%</div>';	
										}
										else if($questionfinder == '4.b')		
											echo '';
										else
										{
											if($amod == 1)
												if($answertext == 'Soy/Lactose-free')
													echo '<div id="answertext" class="grid_2"><u>'.$answertext.'</u><br />'.$percent.'%</div>';
												else
													echo '<div id="answertext" class="grid_2 prefix_2"><u>'.$answertext.'</u><br />'.$percent.'%</div>';
												else if($answertext == "I do not drink milk")
													echo '<div id="answertext" class="grid_2"><u>'.$answertext.'</u><br />'.$percent.'%</div><br />';
											else
												echo '<div id="answertext" class="grid_2"><u>'.$answertext.'</u><br />'.$percent.'%</div>';
										}
									}

								$a++;
								}
							}
						}
			}
					?>
				</fieldset>
			</div>
			<br />
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>