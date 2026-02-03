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
			<title>LifeStyle Questions Form</title>
			
		<!-- JavaScript -->
		<script type="text/javascript" src="js/ajax.js"></script>
		<script type="text/javascript">
		var ajax = new Array();
		function getSecondList()
		{
			var sel = document.getElementById(55);
			document.getElementById(800).options.length = 0;
			var selectItem = parseInt(sel.options[sel.selectedIndex].value,10);
			if(selectItem > 1 && sel.selectedIndex < (sel.length - 2))//selectItem < 10)
			{
				document.getElementById(800).disabled = false;
				var index = ajax.length;
				ajax[index] = new sack();
				
				ajax[index].requestFile = 'ajax/selectajax.php?first='+selectItem;
				ajax[index].onCompletion = function(){createList(index,800)};
				ajax[index].runAJAX();
			}
			else
			{
				document.getElementById(800).disabled = true;
				document.getElementById(800).options[document.getElementById(800).options.length] = new Option('None','0');
			}
			document.getElementById(900).options.length = 0;
			document.getElementById(900).disabled = true;
			document.getElementById(900).options[document.getElementById(900).options.length] = new Option('None','0');
		}
		
		function getThirdList()
		{
			var sel1 = document.getElementById(800);
			document.getElementById(900).options.length = 0;
			var selectItem1 = parseInt(sel1.options[sel1.selectedIndex].value,10);
			if(selectItem1 > 1)
			{
				document.getElementById(900).disabled = false;
				var index = ajax.length;
				ajax[index] = new sack();
				
				var sel2 = document.getElementById(55);
				var firstItem = parseInt(sel2.options[sel2.selectedIndex].value,10);
				
				ajax[index].requestFile = 'ajax/selectajax.php?first='+firstItem+'&second='+selectItem1;
				ajax[index].onCompletion = function(){createList(index,900)};
				ajax[index].runAJAX();
			}
			else
			{
				document.getElementById(900).disabled = true;
				document.getElementById(900).options[document.getElementById(900).options.length] = new Option('None','0');
			}
		}
		
		function createList(index,loc)
		{
			var obj = document.getElementById(loc);
			eval(ajax[index].response);
		}
		
		$(function() {
			$( "#datepicker" ).datepicker({
				dateFormat: 'yy-mm-dd',
				changeMonth: true,
				changeYear: true,
				yearRange: '2011:2012'
			});
			
			$( "#format" ).change(function() {
				$( "#datepicker" ).datepicker( "option", "dateFormat", $( this ).val() );
				$.datepicker.parseDate(dateFormat, $("#datepicker").val());
			});		
		});
		
		function firstSelectList()
		{
			var firstItem = document.getElementById(55).selectedIndex;
			var mylistbox = document.getElementById(800);
			while(mylistbox.length > 0)
				mylistbox.remove(0);			
			if(firstItem == 1 || firstItem == 10 || firstItem == 11)
			{
				mylistbox.disabled=true;
			}
			else
			{
				mylistbox.disabled=true;
			}
		}
		
		
		function disable_text()
		{
			if(document.myform.group14.checked == true)
			{
				document.myform.group14aaa55.disabled = true;
				document.myform.group14aaa55.value = "";
			}
			else
			{
				document.myform.group14aaa55.disabled = false;
			}
		} 		
		function disable_text2()
		{
			if(document.getElementById(70).checked == true)
			{
				document.getElementById(71).selectedIndex = 0;
			}
			else if(document.getElementById(71).selectedIndex != 0)
			{
				document.getElementById(69).checked == true;
				document.getElementById(70).checked == false;
			}
		}
		function disable_radio(value)
		{
			if(document.getElementById(71).selectedIndex > 0)
			{
				document.getElementById(70).checked = false;
				document.getElementById(69).checked = true;
			}
				
		}

		function imposeMaxLength(Object, MaxLen)
		{
			return(Object.value.length <= MaxLen)
		}
		
		function validateLifestyleForm()
		{
			var numErrors = 0;
			var focusNum = -1;
			var tempCount = 0;
			
			document.getElementById("1a").innerHTML="&nbsp;";			
			document.getElementById("1b").innerHTML="&nbsp;";			
			document.getElementById("1c").innerHTML="&nbsp;";			
			document.getElementById("1d").innerHTML="&nbsp;";			
			document.getElementById("2a").innerHTML="&nbsp;";			
			document.getElementById("2b").innerHTML="&nbsp;";			
			document.getElementById("2c").innerHTML="&nbsp;";			
			document.getElementById("2d").innerHTML="&nbsp;";			
			document.getElementById("3a").innerHTML="&nbsp;";			
			document.getElementById("3b").innerHTML="&nbsp;";			
			document.getElementById("3c").innerHTML="&nbsp;";			
			document.getElementById("3d").innerHTML="&nbsp;";			
			document.getElementById("4a").innerHTML="&nbsp;";			
			document.getElementById("4b").innerHTML="&nbsp;";			
			document.getElementById("5a").innerHTML="&nbsp;";			
			document.getElementById("5b").innerHTML="&nbsp;";		
			document.getElementById("5c").innerHTML="&nbsp;";		
			document.getElementById("6a").innerHTML="&nbsp;";		
			document.getElementById("6b").innerHTML="&nbsp;";		
			document.getElementById("7a").innerHTML="&nbsp;";		
			document.getElementById("7b").innerHTML="&nbsp;";		
			document.getElementById("8a").innerHTML="&nbsp;";		
			document.getElementById("8b").innerHTML="&nbsp;";		
			document.getElementById("8c").innerHTML="&nbsp;";		
			document.getElementById("8d").innerHTML="&nbsp;";		
			document.getElementById("8e").innerHTML="&nbsp;";		
			document.getElementById("8f").innerHTML="&nbsp;";		
			document.getElementById("8g").innerHTML="&nbsp;";		
			document.getElementById("8h").innerHTML="&nbsp;";		
			document.getElementById("8i").innerHTML="&nbsp;";		
			document.getElementById("8j").innerHTML="&nbsp;";		
			document.getElementById("8k").innerHTML="&nbsp;";		
			document.getElementById("8l").innerHTML="&nbsp;";		
			document.getElementById("dobError").innerHTML="&nbsp;";		
			//validate radio buttons are checked
			if(document.getElementById(1).checked == false && document.getElementById(2).checked == false && document.getElementById(3).checked == false && document.getElementById(4).checked == false)
			{
				if(focusNum < 0)
					focusNum = 1;
				numErrors++;
				document.getElementById("1a").innerHTML="Required field";			

			}	
			if(document.getElementById(5).checked == false && document.getElementById(6).checked == false && document.getElementById(7).checked == false && document.getElementById(8).checked == false)
			{
				if(focusNum < 0)
					focusNum = 5;
				numErrors++;
				document.getElementById("1b").innerHTML="Required field";
			}
			if(document.getElementById(9).checked == false && document.getElementById(10).checked == false && document.getElementById(11).checked == false && document.getElementById(12).checked == false)
			{
				if(focusNum < 0)
					focusNum = 9;
				numErrors++;
				document.getElementById("1c").innerHTML="Required field";
			}
			if(document.getElementById(13).checked == false && document.getElementById(14).checked == false && document.getElementById(15).checked == false && document.getElementById(16).checked == false)
			{
				if(focusNum < 0)
					focusNum = 13;
				numErrors++;
				document.getElementById("1d").innerHTML="Required field";
			}
			if(document.getElementById(17).checked == false && document.getElementById(18).checked == false && document.getElementById(19).checked == false && document.getElementById(20).checked == false)
			{
				if(focusNum < 0)
					focusNum = 17;
					numErrors++;
				document.getElementById("2a").innerHTML="Required field";
			}
			if(document.getElementById(21).checked == false && document.getElementById(22).checked == false && document.getElementById(23).checked == false && document.getElementById(24).checked == false)
			{
				if(focusNum < 0)
					focusNum = 21;
					numErrors++;
				document.getElementById("2b").innerHTML="Required field";
			}
			if(document.getElementById(25).checked == false && document.getElementById(26).checked == false && document.getElementById(27).checked == false && document.getElementById(28).checked == false)
			{
				if(focusNum < 0)
					focusNum = 25;
				numErrors++;
				document.getElementById("2c").innerHTML="Required field";
			}
			if(document.getElementById(29).checked == false && document.getElementById(30).checked == false &&  document.getElementById(31).checked == false && document.getElementById(32).checked == false &&  document.getElementById(33).checked == false && document.getElementById(34).checked == false)
			{
				if(focusNum < 0)
					focusNum = 29;
				numErrors++;
				document.getElementById("2d").innerHTML="Required field";
			}
			if(document.getElementById(35).checked == false && document.getElementById(36).checked == false && document.getElementById(37).checked == false && document.getElementById(38).checked == false)
			{
				if(focusNum < 0)
					focusNum = 35;
				numErrors++;
				document.getElementById("3a").innerHTML="Required field";
			}
			if(document.getElementById(39).checked == false && document.getElementById(40).checked == false && document.getElementById(41).checked == false && document.getElementById(42).checked == false)
			{
				if(focusNum < 0)
					focusNum = 39;
				numErrors++;
				document.getElementById("3b").innerHTML="Required field";
			}
			if(document.getElementById(43).checked == false && document.getElementById(44).checked == false && document.getElementById(45).checked == false && document.getElementById(46).checked == false)
			{
				if(focusNum < 0)
					focusNum = 43;
				numErrors++;
				document.getElementById("3c").innerHTML="Required field";
			}
			if(document.getElementById(47).checked == false && document.getElementById(48).checked == false && document.getElementById(49).checked == false && document.getElementById(50).checked == false)
			{
				if(focusNum < 0)
					focusNum = 47;
				numErrors++;
				document.getElementById("3d").innerHTML="Required field";
			}
			if(document.getElementById(51).checked == false && document.getElementById(52).checked == false && document.getElementById(53).checked == false && document.getElementById(54).checked == false)
			{
				if(focusNum < 0)
					focusNum = 51;
				numErrors++;
				document.getElementById("4a").innerHTML="Required field";
			}
			if(document.getElementById(55).selectedIndex == 0)// "" && document.getElementById(56).checked == false)
			{
				if(focusNum < 0)
					focusNum = 55;
				numErrors++;
				document.getElementById("4b").innerHTML="Required field";
			}
			
			if(document.getElementById(57).checked == false && document.getElementById(58).checked == false && document.getElementById(59).checked == false && document.getElementById(60).checked == false)
			{
				if(focusNum < 0)
					focusNum = 57;
				numErrors++;
				document.getElementById("5a").innerHTML="Required field";
			}
			if(document.getElementById(61).checked == false && document.getElementById(62).checked == false && document.getElementById(63).checked == false && document.getElementById(64).checked == false)
			{
				if(focusNum < 0)
					focusNum = 61;
				numErrors++;
				document.getElementById("5b").innerHTML="Required field";
			}
			if(document.getElementById(65).checked == false && document.getElementById(66).checked == false && document.getElementById(67).checked == false && document.getElementById(68).checked == false)
			{
				if(focusNum < 0)
					focusNum = 65;
				numErrors++;
				document.getElementById("5c").innerHTML="Required field";
			}
			if(document.getElementById(69).checked == false && document.getElementById(70).checked == false)
			{
				if(focusNum < 0)
					focusNum = 69;
				numErrors++;
				document.getElementById("6a").innerHTML="Required field";
			}
			else if(document.getElementById(69).checked == true && document.getElementById(71).selectedIndex == 0)
			{
				if(focusNum < 0)
					focusNum = 71;
				numErrors++;
				document.getElementById("6b").innerHTML="Required field";
			}
						
			if(document.getElementById(72).checked == false && document.getElementById(73).checked == false && document.getElementById(74).checked == false)
			{
				if(focusNum < 0)
					focusNum = 72;
				numErrors++;
				document.getElementById("7a").innerHTML="Required field";
			}
			if(document.getElementById(75).value == "")
			{
				if(focusNum < 0)
					focusNum = 75;
				numErrors++;
				document.getElementById("7b").innerHTML="Required field";
			}
			if(document.getElementById(76).checked == false && document.getElementById(77).checked == false)
			{
				if(focusNum < 0)
					focusNum = 76;
				numErrors++;
				document.getElementById("8a").innerHTML="Required field";
			}
			if(document.getElementById(78).checked == false && document.getElementById(79).checked == false)
			{
				if(focusNum < 0)
					focusNum = 78;
				numErrors++;
				document.getElementById("8b").innerHTML="Required field";
			}
			if(document.getElementById(80).checked == false && document.getElementById(81).checked == false)
			{
				if(focusNum < 0)
					focusNum = 80;
				numErrors++;
				document.getElementById("8c").innerHTML="Required field";
			}
			if(document.getElementById(82).checked == false && document.getElementById(83).checked == false)
			{
				if(focusNum < 0)
					focusNum = 82;
				numErrors++;
				document.getElementById("8d").innerHTML="Required field";
			}
			if(document.getElementById(84).checked == false && document.getElementById(85).checked == false)
			{
				if(focusNum < 0)
					focusNum = 84;
				numErrors++;
				document.getElementById("8e").innerHTML="Required field";
			}
			if(document.getElementById(86).checked == false && document.getElementById(87).checked == false)
			{
				if(focusNum < 0)
					focusNum = 86;
				numErrors++;
				document.getElementById("8f").innerHTML="Required field";
			}
			if(document.getElementById(88).checked == false && document.getElementById(89).checked == false)
			{
				if(focusNum < 0)
					focusNum = 88;
				numErrors++;
				document.getElementById("8g").innerHTML="Required field";
			}
			if(document.getElementById(90).checked == false && document.getElementById(91).checked == false)
			{
				if(focusNum < 0)
					focusNum = 90;
				numErrors++;
				document.getElementById("8h").innerHTML="Required field";
			}
			if(document.getElementById(92).checked == false && document.getElementById(93).checked == false)
			{
				if(focusNum < 0)
					focusNum = 92;
				numErrors++;
				document.getElementById("8i").innerHTML="Required field";
			}
			if(document.getElementById(94).checked == false && document.getElementById(95).checked == false)
			{
				if(focusNum < 0)
					focusNum = 94;
				numErrors++;
				document.getElementById("8j").innerHTML="Required field";
			}
			if(document.getElementById(96).checked == false && document.getElementById(97).checked == false)
			{
				if(focusNum < 0)
					focusNum = 96;
				numErrors++;
				document.getElementById("8k").innerHTML="Required field";
			}
			if(document.getElementById(98).checked == false && document.getElementById(99).checked == false)
			{
				if(focusNum < 0)
					focusNum = 98;
				numErrors++;
				document.getElementById("8l").innerHTML="Required field";
			}

			if($("#datepicker").val() == "") {
				document.getElementById("dobError").innerHTML = "<p class='errortext'>Please select a date</p>";
			  document.getElementById("datepicker").focus();
			  return false;
			}
			
			// If this is filled out the first time or the date is changed during edit, do this validation
			if(document.getElementById("datepicker").value != document.getElementById("currentdate").value){
				dateCount();
				
				var tempcountfield = document.getElementById('tempcount').value;
				var countint = parseInt(tempcountfield);
				if(countint > 0)
				{
					document.getElementById("dobError").innerHTML = "<div class='grid_5 prefix_2'>Date already entered.</div>";
					numErrors++;
					document.getElementById("datepicker").focus();
					return false;
				}
			}	
				
			
			var str = 'datepicker';
			if(!validatedate(str))
			{
				document.getElementById("dobError").innerHTML = "<div class='grid_5 prefix_2'>Please enter a valid date (YYYY-MM-DD)</div>";
				numErrors++;
				document.getElementById(str).focus();
				return false;
			}
			
			if(!nonfutureDate(document.getElementById(str).value))
			{
				document.getElementById("dobError").innerHTML = "<div class='grid_5 prefix_2'>Please enter a non-future date</div>";
				numErrors++;
				document.getElementById(str).focus();
				return false;
			}
			
			//If any errors are raised the form will not submit.
				if(numErrors == 0)
				{
					return true;
				}
				else
				{
					document.getElementById(focusNum).focus();
					return false;
				}
		}
		
		function dateCount()
		{
			if (window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}else{
			// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
				xmlhttp.onreadystatechange=function()

			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
					tempCount = xmlhttp.responseText;
					document.getElementById('tempcount').value = tempCount;
			}
				}
			
				var tempDate = document.getElementById("datepicker").value;
				xmlhttp.open("GET","post/checkDate.php?tempDate="+tempDate,false);
				xmlhttp.send();
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

			function nonfutureDate(tmpDate)
			{
				var datePat = /^(\d{4})(\/|-)(\d{1,2})\2(\d{1,2})$/;
				var m=tmpDate.match(datePat);
				var tmpYear = m[1];
				var tmpMonth = m[3];
				var tmpDay = m[4];
				var d = new Date();
				var todayDay = d.getDate(); //day
				var todayYear = d.getFullYear(); //year
				var todayMonth = d.getMonth()+1; //month

				//check year first
				if(todayYear < tmpYear)
				{
					//the passed in year is in the future, so it is invalid and stop here
					return false;
				}
				else if(todayYear > tmpYear)
				{
					//the passed in year is in the past, so it is valid and stop check here
					return true;
				}
							
				//if it makes it here, the years are the same and have to check the month
				if(todayMonth < tmpMonth)
				{
					//the passed in month is in the future, so it is invalid and stops here
					return false;
				}
				else if(todayMonth > tmpMonth)
				{
					//the passed in month is in the past, so it is valid and stops here
					return true;
				}
							
				//if it makes it here, the year and month is the same and have to check the day
				if(todayDay < tmpDay)
				{	
					//the passed in day is in the future, so it is invalid and stops here
					return false;
				}
				else
				{
					//the passed in day is either today or in the past, so it is valid
					return true;
				}
			}
			
			

			jQuery(function($){
				$("#datepicker").mask("9999-99-99", {
					placeholder : " "
				});
			});	
		</script>
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
			<?php				
				if(!isset($_POST['partid']) && !isset($_POST['lsdate']))
				{
					$partid = 0;
					$lsdate = 0;
				}
				else
				{
					$partid = $_POST['partid'];
					$lsdate = $_POST['lsdate'];
				}
				//echo 'Id from post is:'.$partid;
				
				if($partid != 0 && $lsdate != 0)
				{
					$sql_iteration = "select ITERATION from lsresult where participantid = ".$partid." AND LSDATE = '".$lsdate."' LIMIT 0,1";
					//SELECT * FROM `lsresult` WHERE `PARTICIPANTID` = 37 and `ITERATION` = 1 LIMIT 0,1
					$result_iteration = mysql_query($sql_iteration);
					$row_iteration = mysql_fetch_row($result_iteration);
					//echo $row_iteration[0];
					$itnum = $row_iteration[0];
				}
			?>
				<input type='hidden' id='tempcount' value='' />
				<div class="container container_16 blocktext">
				<div class='clear'>&nbsp;</div>
				<div class='grid_15 suffix_1'><div class="errortext"id="dateError">&nbsp;</div></div>		
				<div class='grid_8'><b>Please check the answers to the questions below:</b></div>
				<form action='post/lifestyleformpost.php' method='post' id='myform' name='myform' onsubmit='return validateLifestyleForm();'>
				<?php
					if($partid != 0 && $lsdate != 0)
					{
						echo "<div class='grid_1'><input type='hidden' id='partid' name='partid' value='".$partid."' /><input type='hidden' id='itnum' name='itnum' value='".$itnum."' /></div><br />";
					}
				?>
				<div class="errortext"id="dobError">&nbsp;</div>
				<div class='grid_4'>
					<p class='right'>Date of form completion:</p>
				</div>
				<div class='grid_3'> 
					<p><input type="text" name="date" <?php if($partid != 0 && $lsdate != 0){echo "value='".$lsdate."'";} else{echo "value=''";} ?> id="datepicker"/></p>
				</div>
				
				
				<div class='clear'>
					<input type='hidden' id='currentdate' name='currentdate' <?php if($partid != 0 && $lsdate != 0){echo "value='".$lsdate."'";} else{echo "value=''";} ?> />					
				</div>												
				
				<?php
				//start counter for category numbering
				$i = 1;
				$idcounter = 0;
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
					echo '<div class="grid_14 suffix_1">'.$i.'. <b><u>'.$categorydesc.'</u></b> - '.$cetegorysubtext.'</div><div class="clear">&nbsp;</div>';		
					//build sql for question
					$sql_question = 'Select * from lsquestion where LSCATEGORYID = '.$categoryid;
					//run sql for question 
					$result_question = mysql_query($sql_question);
					//start counter for question numbering where number of questions is < 4
					$l = 0;
					$z = 1;
					//start loop to pull questions
					while($row_question = mysql_fetch_array($result_question))
					{
						//build array to letter the questions bassed on the value of $l i.e. 1,2,3 or 4
						$letter = array('a','b','c','d','e','f','g','h','i','j','k','l','m');
						//build category/question id's for inline error div tag
						$divid = $categoryid.$letter[$l];
						$divid2 = $categoryid.$letter[$z];
						//catch question id
						$questionid = $row_question['LSQUESTIONID'];
						//build sql for answer
						$sql_answers = 'select * from lsanswer where LSQUESTIONID = '.$questionid;	
						//run sql for answer
						$result_answer = mysql_query($sql_answers);
						//catch question text
						$questiontext = $row_question['LSQUESTIONDESC'];
						//print question text
						//determine number of answers for question
						$num_answers = mysql_num_rows($result_answer);
						//use modulous to determine if question is divisible by 2
						$qmod = $l % 2;
						if($num_answers <= 4)
							if($categoryid == 8)
								if($qmod == 0)
									echo "
										<div class='errortext'>
											<div class='grid_2 suffix_2' id=".$divid.">
												&nbsp;
											</div>
										</div>
										<div class='errortext'>
											<div class='grid_2 prefix_4 suffix_6' id=".$divid2.">
												&nbsp;
											</div>
										</div>
										<div class='clear'>&nbsp;</div>
										<div class='grid_3 prefix_1'>
											<i>
												".$questiontext."
											</i>
										</div>";
								else if($qmod == 1)
									echo "<div class='grid_3 prefix_1'><i>".$questiontext."</i></div>";
								else
									echo "<div class='errortext'><div class='grid_3 prefix_1 suffix_12' id=".$divid.">&nbsp;</div></div><div class='grid_3 prefix_1'><i>".$questiontext."</i></div>";	
							else
								echo "<div class='errortext'><div class='grid_2 suffix_13' id=".$divid.">&nbsp;</div></div><div class='grid_6 prefix_1'>".$letter[$l].". <i>".$questiontext."</i></div>";
						else 
							echo "<div class='errortext'><div class='grid_2 suffix_14' id=".$divid.">&nbsp;</div></div><div class='grid_3 prefix_1'>".$letter[$l].". <i>".$questiontext."</i></div>";
						//increment question counter
						$l++;
						$z++;
						//reset counter for answers
						$ainc =0;
						//start loop to pull answers
						while($row_answers = mysql_fetch_array($result_answer))
						{
							//iterator to count answers
							$ainc++;
							$idcounter++;
							//check if iterator is divisible by 3
							$amod = $ainc % 2;
							//catch answer id
							$answerid = $row_answers['LSANSWERID'];
							//catch answer text
							$answertext = $row_answers['LSANSWERDESC'];
							//catch input type
							$answerinput = $row_answers['INPUTTYPE'];
							//Print answer text
							$answerlength = strlen($answertext);
							if($categoryid != 8)
							{
								if($answerlength < 4)
									$grid = 'grid_1';
								else if($answerlength >= 15)
									$grid = 'grid_3';
								else
									$grid = 'grid_2';
							}
							else
							{
								if($amod == 0)
									$grid = 'grid_2  pull_1';
								else
									$grid = 'grid_1 suffix_1 pull_1';
							}
							//**************************************************************
							if($answertext == "I am unable to be active")
									$grid = 'grid_4';
							//**************************************************************
							if($answertext == 'YES')
								$grid = 'grid_2';
							if($answertext == 'I do not drink milk')
								$grid = 'grid_3 alpha omega';
							if($answerinput == 'TXT')
							{		
								$formelement = "<input type='text' size='75' name='group".$questionid."aaa".$answerid."' value='' id='".$idcounter."' />";
								$grid = 'grid_7';
							}
							else if($answerinput == 'TXA')
							{
								if($partid != 0 && $lsdate != 0)
								{
									$sql = "SELECT LSCOMMENT FROM lsresult WHERE PARTICIPANTID = ".$partid." AND LSQUESTIONID = ".$questionid." AND ITERATION = ".$itnum;
									$rs = mysql_query($sql);
									$ri = mysql_fetch_row($rs);
									$areatext = $ri[0];
								}
								else
								{
									$areatext = '';
								}
								$formelement = "<textarea cols='50' rows='2' name='group".$questionid."aaa".$answerid."' id='".$idcounter."' onkeypress='return imposeMaxLength(this, 250);'>".$areatext."</textarea>";
							}
							else if($answerinput == 'LIS')
							{
							//****************************************************************************************
								if($questionid == 19)
								{
									//tobacco
									$formelement = "<select name='".$questionid."'id='".$idcounter."' onChange='disable_radio(this.value);'/>";
									$sql = "SELECT TOBACCOID, TOBACCODESC FROM tobaccolookup ORDER BY TOBACCOID";

									$rs = mysql_query($sql);
									
									if($partid != 0 && $lsdate != 0)
									{
										$sql = "SELECT LSANSWERID FROM lsresult WHERE PARTICIPANTID = ".$partid." AND LSQUESTIONID = ".$questionid." AND ITERATION = ".$itnum;
										$tresult = mysql_query($sql);
										$rowi = mysql_fetch_row($tresult);
										$queryans = $rowi[0];										
									}
									else
									{
										$queryans = -1;
									}

									while($row = mysql_fetch_array($rs))
									{
										$tobaccoid = $row["TOBACCOID"];
										if($tobaccoid == $queryans)
										{
											$listselect = ' selected ';
										}
										else
										{
											$listselect = ' ';
										}
										$formelement .= '<option'.$listselect.'value='.$tobaccoid.'>'.$row["TOBACCODESC"].'</option>\n  ';
									}
									$formelement .= '</select>';
								}
								else
								{
								//***********************************************************************************************************************************************
									//physical activity
									
									$sql = "SELECT PHYSICALID, PHYSICALDESC FROM physicalactivitylookup ORDER BY ITEMORDER";

									$rs = mysql_query($sql);
									$queryArray = array(-1,-1,-1);
									
									if($partid != 0 && $lsdate != 0)
									{
										$i = 0;
										$sql = "SELECT LSANSWERID FROM lsresult WHERE PARTICIPANTID = ".$partid." AND LSQUESTIONID = ".$questionid." AND ITERATION = ".$itnum." ORDER BY LSCOMMENT";
										$presult = mysql_query($sql);
										while($rowp = mysql_fetch_row($presult))
										{
											$queryArray[$i] = $rowp[0];
											$i++;
										}
										
									}
									$formelement = '';
									$sql = "SELECT PHYSICALID, PHYSICALDESC FROM physicalactivitylookup ORDER BY ITEMORDER";
									
									for($i=0;$i<count($queryArray);$i++)
									{
										if($i==0)
										{
											$diselement = " ";
											$optelement = "";
											$rs = mysql_query($sql);
											while($row = mysql_fetch_array($rs))
											{
												$physicalid = $row["PHYSICALID"];
												if($physicalid == $queryArray[$i])
												{
													$listselect = ' selected ';
												}
												else
												{
													$listselect = ' ';
												}
												$optelement .= '<option'.$listselect.'value='.$physicalid.'>'.$row["PHYSICALDESC"].'</option>';
											}
										}										
										elseif($queryArray[$i] > 0 && $queryArray[$i] != 56)
										{											
											$diselement = " ";
											$optelement = "";
											
											if($queryArray[$i] == 1)
											{
												$optelement = "<option selected value='1'>None</option>";
											}
											else
											{
												$optelement = "<option value='1'>None</option>";
											}
											
											$sql2 = "SELECT PHYSICALID, PHYSICALDESC FROM physicalactivitylookup WHERE PHYSICALID NOT IN (1,7,11) ORDER BY ITEMORDER";
											
											$rs2 = mysql_query($sql2);
											while($row = mysql_fetch_array($rs2))
											{
												$physicalid = $row["PHYSICALID"];
												if($physicalid == $queryArray[$i])
												{
													$listselect = ' selected ';
												}
												else
												{
													$listselect = ' ';
												}
												$newrecord = true;
												for($j=0;$j<$i;$j++)
												{
													if($queryArray[$j] == $physicalid)
														$newrecord = false;
												}
												if($newrecord)
													$optelement .= '<option'.$listselect.'value='.$physicalid.'>'.$row["PHYSICALDESC"].'</option>';
											}
										}
										else
										{
											$diselement = " disabled='disabled' ";
											$optelement = "<option value='0'>None</option>";
										}
										
										if($i==0)
										{
											$formelement .= "<select name='".$questionid."' id='".$idcounter."' onchange='getSecondList()' style='width: 320px;margin-bottom: 2px;margin-top: 2px;'/>";
											$formelement .= $optelement;
											$formelement .= '</select>';
										}
										else if($i==1)
										{
											$formelement .= "<select".$diselement."name='800'id='800' onchange='getThirdList()' style='width: 320px;margin-bottom: 2px;margin-top: 2px;'/>";
											$formelement .= $optelement;
											$formelement .= '</select>';
										}
										else
										{
											$formelement .= "<select".$diselement."name='900'id='900' style='width: 320px;margin-bottom: 2px;margin-top: 2px;'/>";
											$formelement .= $optelement;
											$formelement .= '</select>';
										}
									}
								//***********************************************************************************************************************************************
								}							
							}
							else
							{
								if($answerinput == 'CHB')
								{							
									$formelement = "<input type='hidden' />";
									$answertext = '';
									echo "<div class='clear'>&nbsp;</div><br />";
								}
								else
								{
									if($partid != 0 && $lsdate != 0)
									{
										$sql = "SELECT LSANSWERID FROM lsresult WHERE PARTICIPANTID = ".$partid." AND LSQUESTIONID = ".$questionid." AND ITERATION = ".$itnum;
										$rs = mysql_query($sql);
										$ri = mysql_fetch_row($rs);
										$queryans = $ri[0];
										if($answerid == $queryans)
											$selectRadio = " checked='true' ";
										else
											$selectRadio = " ";
									}
									else
									{
										$selectRadio = " ";
									}
								
									if($idcounter == 70 or $idcounter == 69)
										$formelement = "<input".$selectRadio."type='radio' name='group".$questionid."' value='".$answerid."'id='".$idcounter."' onchange='disable_text2();'/>";
									else
										$formelement = "<input".$selectRadio."type='radio' name='group".$questionid."' value='".$answerid."'id='".$idcounter."' />";
								}	
							}
							//**********************************************************************************************
							if($answerinput == 'TXT' or $answerinput=='TXA' or $answerinput == 'LIS')
								echo "<div class='".$grid."'>".$formelement."</div>";								
							else if($categoryid == 8 and $qmod == 1 and $amod == 0)
								echo "<div id='answertext' class='".$grid."'>".$formelement.$answertext."</div><div class='clear'>&nbsp;</div>";
							else
								echo "<div id='answertext' class='".$grid."'>".$formelement.$answertext."</div>";
						}
						if($categoryid != 8 and ($letter[$l] == 'e' or $divid == '6b' or $divid == '7b' or $divid == '5c'))
							echo "<div class='clear'>&nbsp;</div><br />";
					}
						echo "<div class='clear'>&nbsp;</div>";
						//increment category counter
						$i++;
				}
				?>
				<br />
				<div class='clear'>&nbsp;</div>
				<div class='buttonarea'><input type='submit' value='Submit Form' /></div>
				</form>
				<div class='clear'>&nbsp;</div>
				</div>
				
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>