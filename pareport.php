    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php 
		//Get Database
				require ('includes/db_connect.php');
				
		//Star Session for base security
				session_start();

				
		//grabs the participant id
			if(isset($_SESSION['participantid']))
			$participantid = $_SESSION['participantid'];
			else
			$participantid = 1;
			//echo $participantid;				
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		
		<!-- Link to 960.css stylesheet & main.css stylesheet --> 
			<link rel="stylesheet" href="css/960_16.css" type="text/css" />
			<link href="css/main.css" rel="stylesheet" type="text/css" />
			
		<!-- Import JQuery -->
			<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>	
			
		<!-- Remember to Change Title! -->
			<title>Participant Ackowledgement - Report</title>
			
		<!-- JavaScript -->
		<script type="text/javascript">
		function printFunction()
		{			
			//prompts the browser to print the page			
			window.print();
			
			//if the browser is IE
			if(navigator.appName == 'Microsoft Internet Explorer')
			{	
				//hide/show elements
				document.getElementById('ieblock').style.display="none";
				document.getElementById('ieprint').style.display="block";				
				return true;
			}
			else
			{
				//prompt the user if the page has printed
				amRet = confirm('Has the page printed successfully?');
				if(amRet)
				{
					//redirect to post page
					document.location.href="post/pareportprint.php";
					return true;
				}
				return false;
			}
		}		
		
		function showPrint()
		{
			//only being used for IE browser
			document.getElementById('ieblock').style.display="block";
			document.getElementById('ieprint').style.display="none";
			return true;
		}				
		
		</script>
			
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
			<style type="text/css" media="print">
			.printbutton{
				visibility: hidden;
				display: none;
			}
			.fontchange{
				color: black;
			}
			</style>
			
			
			<h1>Participant Acknowledgement - Report</h1>				
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
						
						// Search the answer here
						$sql_answer = 'select * from paresult WHERE PARTICIPANTID = '.$participantid.' and PAQUESTIONID = '.$questionid;
						$result_answer = mysql_query($sql_answer);
						$row_answer = mysql_fetch_array($result_answer);
						$answerdesc = $row_answer['ANSWER'];
						$acceptDate = $row_answer['ACCEPTDATE'];
						//if the answer is true, display Agree and the date of agreement
						if(strcmp($answerdesc,"True") == 0)
						{
							$displayans = 'Agree - <i>'.$acceptDate.'</i>';
							$colorSelect = 'black';
						}
						else //else, display Did Not Agree and make it stand out
						{
							$displayans = '<big><b><u>Did Not Agree</u></b></big>';
							$colorSelect = 'red';
						}
						//display the answer
						echo '<div class="grid_4 prefix_1" style="color:'.$colorSelect.'"><div class="fontchange">'.$displayans.'</div></div>';									
						//New line
						echo "<div class='clear'>&nbsp;</div>";
						$i++;
					}
				?>
				<br />
				<br />
				<div class="clear">&nbsp;</div>
				<div class="grid_3"><p class="right">Participant Signature:</p></div>
				<div class="grid_6">__________________________________________________</div>
				<div class="grid_3"><p class="right">Date:</p></div>
				<div class="grid_3">____________________</div>
				<div class="clear">&nbsp;</div>
				<br />
				<br />
				<div class="clear">&nbsp;</div>
				<div class="grid_3"><p class="right">Witness Signature:</p></div>
				<div class="grid_6">__________________________________________________</div>
				<div class="grid_3"><p class="right">Date:</p></div>
				<div class="grid_3">____________________</div>
				<div class="clear">&nbsp;</div>
				<div class="clear">&nbsp;</div>
				<br />
				
				<!-- Work In Progress-->
				<form action="paform.php" name='paForm' id='paForm' method="post">
				<?php
				
					$returnButton = "<input type='button' onClick='document.location.href=\"participantforms.php\"' value=\"Return to Forms\"/>";
					$sql_date = 'select * from participant WHERE PARTICIPANTID = '.$participantid;
					$result_date = mysql_query($sql_date);
					$row_date = mysql_fetch_array($result_date);
					$resultDate = $row_date['PAFORMPRINTDATE'];
					//if it is, set the print date.
					if($resultDate != NULL){
						$printButton = "<div id='ieblock' class='pabuttons'><input type='button' onClick='return printFunction()' class='printbutton' value='Print Page' /> - <i>Page has been printed on ".$resultDate." </i></div>";
						$printFlag = 1;
					}
					else{ 
						$printButton = "<div id='ieblock' class='pabuttons'><input type='button' onClick='return printFunction()' class='printbutton' value='Print Page' /></div>";
						$printFlag = 0;
					}
					
					//get the browser type
					$user_agent = $_SERVER['HTTP_USER_AGENT'];
					
					//if the browser is IE, set the fields for confirmation of printing
					if(preg_match('/MSIE/i',$user_agent)){ 
						$printButton = $printButton.'<div class="printbutton pabuttons" style="display:none" id="ieprint"><i>Has the page printed successfully?</i>&nbsp;<input type="button" onClick=\'document.location.href="post/pareportprint.php"\' value="Yes" />&nbsp;<input type="button" onClick=\'return showPrint()\' value="No" />&nbsp;</div>';
					}
					
					
						
					$sql_iteration = 'select ITERATION from participant where PARTICIPANTID = '.$participantid;				
					$result_iteration = mysql_query($sql_iteration);
					//retrieve iteration number and place into variable
					$row_iteration = mysql_fetch_row($result_iteration);
					$iteration = $row_iteration[0];
				
					//if it is the first iteration, display the edit button
					if($iteration == 1){
						$editButton = "<input type='submit' value='Edit' />";
						$edithidden = "<input type='hidden' id='partid' name='partid' value='".$participantid."' />";
						$editFlag = 1;
					 }
					 else{
						$editButton = "";
						$edithidden = "";
						$editFlag = 0;
					}
					//display the button to print the report
					/*
					if($printFlag == 0)
					{
						echo "<div class='grid_16 printbutton' align='center'>".$returnButton.$editButton.$printButton."</div>".$edithidden;
					}
					else*/ 
					if($editFlag == 0){
						echo "<div class='grid_8 printbutton pabuttons' align='right'>".$returnButton."</div><div class='grid_8 printbutton'>".$printButton."</div>";
					}
					else{
						echo "<div class='grid_7 alpha printbutton pabuttons' align='right'>".$returnButton."</div>
							  <div class='grid_1 printbutton' align='center pabuttons'>".$editButton."</div>
							  <div class='grid_7 omega printbutton pabuttons'>".$printButton."</div>".$edithidden;
					}
					
					
				?>						
				</form>				
				<!-- End of Progress-->
				<?php		/*
					//check if the form has been printed or not
					$sql_date = 'select * from participant WHERE PARTICIPANTID = '.$participantid;
					$result_date = mysql_query($sql_date);
					$row_date = mysql_fetch_array($result_date);
					$resultDate = $row_date['PAFORMPRINTDATE'];
					//if it is, set the print date.
					if($resultDate != NULL)
						$dateString = " - <i>Page has been printed on ".$resultDate." </i>";
					else 
						$dateString = '';
					//display the button to print the report
					echo "<div class='printbutton grid_8' id='ieblock'><input type='button' onClick='return printFunction()' class='printbutton' value='Print Page' id='ieprint' />".$dateString."</div>";
					
					//get the browser type
					$user_agent = $_SERVER['HTTP_USER_AGENT'];
					
					//if the browser is IE, set the fields for confirmation of printing
					if(preg_match('/MSIE/i',$user_agent)){
						echo '<br/> <div class="clear">&nbsp;</div>'; 
						echo '<div class="printbutton" style="visibility:hidden" id="idie"><i>Has the page printed successfully?</i>&nbsp;';
						echo '<input type="button" style="visibility:hidden" onClick=\'document.location.href="post/pareportprint.php"\' value="Yes" id="ieyes" />&nbsp;';
						echo '<input type="button" style="visibility:hidden" onClick=\'return showPrint()\' value="No" id="ieno" />&nbsp;</div>';
					}					
				?>
				<br/> <div class="clear">&nbsp;</div>	
				<div class="printbutton grid_2"><input type='button' onClick='document.location.href="participantforms.php"' value="Return to Forms"/>
				</div>
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
				<form action="paform.php" name='paForm' id='paForm' method="post">
					<div class='grid_1 printbutton'><input type='submit' value='Edit' /></div>
					<br />
					<div class='clear'>&nbsp;<input type='hidden' id='partid' name='partid' value='<?php echo $participantid; ?>' /></div>					
				</form>
				<?php } */?>				
			</div>
				
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>