    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php 
		//Get Database
				require ('includes/db_connect.php');
				
		//Start Session for base security
				session_start();
				//session variable for the participant id
				if(isset($_SESSION['participantid'])){
					$_SESSION['participantid']=$_SESSION['participantid'];
				}
				else{
					$_SESSION['participantid']=1;
				}
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		
		<!-- Link to 960.css stylesheet & main.css stylesheet --> 
			<link rel="stylesheet" href="css/960_16.css" type="text/css" />
			<link href="css/main.css" rel="stylesheet" type="text/css" />
			
		<!-- Import JQuery -->
			<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>	
			<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
			<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
				<script src="js/jquery.maskedinput-1.3.js" type="text/javascript"></script>

		<!-- Remember to Change Title! -->
			<title>Health and Wellness Assessment</title>
			
		<!-- JavaScript -->
		<script>

		//function for datepicker
		$(function() {
			$( "#datepicker" ).datepicker({
				dateFormat: 'yy-mm-dd',
				changeMonth: true,
				changeYear: true,
				yearRange: '1901:2025'

			});

				$( "#format" ).change(function() {
				$( "#datepicker" ).datepicker( "option", "dateFormat", $( this ).val() );
				$.datepicker.parseDate(dateFormat, $("#datepicker").val());
			});
		});
			//function for masking the datepicker field
			jQuery(function($){
				$("#datepicker").mask("9999-99-99", {
					placeholder : " "
				});
			});
	
		//function so that only numbers can be entered into certain fields
		function numbersonly(e, decimal) {
			var key;
			var keychar;

			if (window.event) {
			   key = window.event.keyCode;
			}
			else if (e) {
			   key = e.which;
			}
			else {
			   return true;
			}
			keychar = String.fromCharCode(key);

			if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
			   return true;
			}
			else if ((("0123456789").indexOf(keychar) > -1)) {
			   return true;
			}
			else if (decimal && (keychar == ".")) { 
			  return true;
			}
			else
			   return false;
			}
			
		
		
		//function for rounding out calculation called within calcBMI
		function mod(div,base) {
			return Math.round(div - (Math.floor(div/base)*base));
		}
		//function for calculating BMI
		function calcBmi() {
			var w = document.hwform.weight.value * 1;
			var HeightFeetInt = document.hwform.feet.value * 1;
			var HeightInchesInt = document.hwform.inches.value * 1;
			//convert number of feet into inches 
			HeightFeetConvert = HeightFeetInt * 12;
			h = HeightFeetConvert + HeightInchesInt;
			//calculate BMI and store in variable
			displaybmi = (Math.round((w * 703) / (h * h)));
			var rvalue = true;
			//will give an error if the weight and height is too low
			if ( (w < 20) || (w >= 999)  || (h < 36) || (h >= 120) ) {
				alert ("Invalid weight.  Please check and re-enter!");
				rvalue = false;
			}
			//if the weight and height is valid
			if (rvalue) {
					if (HeightInchesInt > 11) {
					reminderinches = mod(HeightInchesInt,12);
					document.hwform.inches.value = reminderinches;
					document.hwform.feet.value = HeightFeetInt + 
					((HeightInchesInt - reminderinches)/12);
					document.hwform.bmi.value = displaybmi;
					}
				document.hwform.bmi.value = displaybmi;
			}
			return rvalue;
		}
		
		//function for validating form
		function validateHWForm(theForm){
			var numErrors = 0;
						
			//Clears out the error divs
			document.getElementById("rad1Error").innerHTML = "";
			document.getElementById("weightError").innerHTML = "";
			document.getElementById("rad2Error").innerHTML = "";
			document.getElementById("bmiError").innerHTML = "";
			document.getElementById("waistError").innerHTML = "";
			document.getElementById("a1cError").innerHTML = "";
			document.getElementById("completedbyError").innerHTML = "";
			document.getElementById("dateError").innerHTML = "";

			//validate if Completed by field is empty
			if(document.getElementById(10).value == ""){
				document.getElementById("completedbyError").innerHTML = "<p class='errortext'>Please enter name or initials</p>";
				document.getElementById(10).focus();
				numErrors++;}
				
			//validate if A1C field is empty
			if(document.getElementById(9).value == ""){
				document.getElementById("a1cError").innerHTML = "<p class='errortext'>Please enter A1C percent</p>";
				document.getElementById(9).focus();
				numErrors++;}
				
			//validate if Waist field is empty
			if(document.getElementById(8).value == ""){
				document.getElementById("waistError").innerHTML = "<p class='errortext'>Please enter waist circumferance</p>";
				document.getElementById(8).focus();
				numErrors++;}
				
			//validate if BMI field is empty
			if(document.getElementById(7).value == ""){
				document.getElementById("bmiError").innerHTML = "<p class='errortext'>Please enter BMI</p>";
				document.getElementById(7).focus();
				numErrors++;}
				
			//validate weight w/shoes w/o shoes radio buttons
			if(document.getElementById(5).checked == false && document.getElementById(6).checked == false){
				document.getElementById("rad2Error").innerHTML = "<p class='errortext'>Please select an option</p>";
				document.getElementById(5).focus();
				numErrors++;}
				
			//validate if Weight field is empty
			if(document.getElementById(4).value == ""){
				document.getElementById("weightError").innerHTML = "<p class='errortext'>Please enter weight</p>";
				document.getElementById(4).focus();
				numErrors++;}
				
			//validate hieght w/shoes w/o shoes radio buttons	
			if(document.getElementById(2).checked == false && document.getElementById(3).checked == false){
				document.getElementById("rad1Error").innerHTML = "<p class='errortext'>Please select an option</p>";
				document.getElementById(2).focus();
				numErrors++;}
			
			//validate datepicker			
			if($("#datepicker").val() == "") {
			  document.getElementById("dateError").innerHTML = "<p class='errortext'>Please select a date</p>";
			  document.getElementById("datepicker").focus();
			  return false;
			  }
			
			if(document.getElementById("datepicker").value != document.getElementById("currentdate").value){			
				dateCount();
				
				var tempcountfield = document.getElementById('tempcount').value;
				var countint = parseInt(tempcountfield);
				if(countint > 0)
				{
					document.getElementById("dateError").innerHTML = "<p class='errortext'>Date already entered.</p>";
					numErrors++;
				}
			}
			  
			  var str = 'datepicker';
			 if(!validatedate(str))
			 {
				document.getElementById("dateError").innerHTML = "<p class='errortext'>Invalid Date</p>";
				return false;
			 }
			 if(!nonfutureDate(document.getElementById(str).value))
			{
				document.getElementById("datepicker").focus();
				numErrors++;
				document.getElementById("dateError").innerHTML = "<p class='errortext'>Please select a non-future date</p>";;
			}		  
			
			//If any errors are raised the form will not submit and alert the user.
			if(numErrors == 0){
				return true;
				}
			else{
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
				xmlhttp.open("GET","post/checkHWDate.php?tempDate="+tempDate,false);
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
	</script>

			
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
			<?php	
				//set the hidden id variable
				if(!isset($_POST['hwid']))
					$hwid = 0;
				else
					$hwid = $_POST['hwid'];
				
				if($hwid != 0)
				{
					$sql_health = "select * from hwaresult where HWARESULTID = ".$hwid;
					$result_health = mysql_query($sql_health);
					$row_health = mysql_fetch_row($result_health);
				}
			?>
			
				<input type='hidden' id='tempcount' value='' />
				<div class="container container_16 blocktext">
				<div class='grid_12 prefix_2 suffix_2'><h1>Health and Wellness Assessment</h1></div>
				<div class='clear'>&nbsp;</div>
				<form action='post/HealthWellnessFormpost.php' method='post' id='myform' name='hwform' onsubmit='return validateHWForm(this);'>
				<div class='clear'><input type='hidden' id='hwid' name='hwid' value='<?php echo $hwid; ?>' /></div>
				<?php
				//min and max values for height drop downs
				$minFeet = 3;
				$maxFeet = 7;
				$minInches = 0;
				$maxInches = 11;
				$gridError = "grid_3";
				?>
				<div class='grid_8'><b>Measurement Information:</b></div>
				<div class='clear'>&nbsp;</div>
				<div class='grid_8'><b>Staff Only</b></div>
				<div class='clear'>&nbsp;</div><br />
				
				<!-- input for the datepicker -->
				<div class='grid_8'><b>Date</b>&nbsp;(YYYY-MM-DD)</div>
				<div class='grid_4'><input type='text' size='10' name='date' <?php if($hwid != 0){echo "value='".$row_health[10]."'";} ?> id='datepicker' /></div>
				
				<div class='clear'>
					<input type='hidden' id='currentdate' name='currentdate' <?php if($hwid != 0){echo "value='".$row_health[10]."'";} else{echo "value=''";} ?> />					
				</div>	
				
				
				<div class='clear'>&nbsp;</div>
				<div id="dateError" class='<?php echo $gridError; ?>'></div>
				<div class='clear'>&nbsp;</div><br />
				
				<!-- drop downs for Height -->
				<div class='grid_8'><b>Height</b>&nbsp;(in feet & inches)
				<?php 
						if($hwid != 0)
						{
							$returnHeight = $row_health[2];
							
							$explodeHeight = explode(" ", $returnHeight);
							$explodeFeet = $explodeHeight[0];
							$explodeInches = $explodeHeight[1];
						}
					?>
				</div>
				<!-- Feet -->
				<div class='grid_1'>
					<select name='feet'>
					<?php
					  while($minFeet <= $maxFeet){
						echo "<option ".($hwid != 0 ? ($minFeet == $explodeFeet ? " selected " : "") : "")." value='".$minFeet."'>".$minFeet." ft.</option>";
						$minFeet++;
					  }
					?>
					</select> 
				</div>
				
				<!-- Inches -->
				<div class='grid_1'>
					<select name='inches'>
					<?php
					  while($minInches <= $maxInches){
						echo "<option ".($hwid != 0 ? ($minInches == $explodeInches ? " selected " : "") : "")." value='".$minInches."'>".$minInches." in.</option>";
						$minInches++;
					  }
					?>
					</select> 
				</div>
				<div class='clear'>&nbsp;</div>
				<?php
					$heightShoes1 = '';
					$heightShoes2 = '';
					if($hwid !=0)
					{
						if($row_health[3] == 1)
						{
							$heightShoes1 = "checked='true'";
						}
						else
						{
							$heightShoes2 = "checked='true'";
						}
					}
				?>
				
				<!-- radio buttons for with or without shoes -->
				<div class='grid_2'><input type='radio' <?php echo $heightShoes1; ?> name='heightshoes' id='2' value='1' />w/shoes</div>
				<div class='grid_2'><input type='radio' <?php echo $heightShoes2; ?> name='heightshoes' id='3' value='0' />w/o shoes</div>
				<div class='clear'>&nbsp;</div>
				<div id="rad1Error" class='grid_4'></div>
				<div class='clear'>&nbsp;</div><br />
				
				<!-- input for Weight -->
				<div class='grid_8'><b>Weight</b>&nbsp;(in pounds)</div>
				<div class='grid_4'><input type='text' size='10' name='weight' onKeyPress='return numbersonly(event, false)' <?php if($hwid != 0){echo "value='".$row_health[4]."'";} ?> maxlength='3' id='4' />lbs.</div>
				<div class='clear'>&nbsp;</div>
				<div id="weightError" class='<?php echo $gridError; ?>'></div>
				<div class='clear'>&nbsp;</div>
				<?php
					$weightShoes1 = '';
					$weightShoes2 = '';
					if($hwid !=0)
					{
						if($row_health[3] == 1)
						{
							$weightShoes1 = "checked='true'";
						}
						else
						{
							$weightShoes2 = "checked='true'";
						}
					}
				?>
				<!-- radio buttons for with or without shoes -->
				<div class='grid_2'><input type='radio' <?php echo $weightShoes1; ?> name='weightshoes' id='5' value='1' >w/shoes</div>
				<div class='grid_2'><input type='radio' <?php echo $weightShoes2; ?> name='weightshoes' id='6' value='0' >w/o shoes</div>
				<div class='clear'>&nbsp;</div>
				<div id="rad2Error" class='<?php echo $gridError; ?>'></div>
				<div class='clear'>&nbsp;</div><br />
				
				<!-- input for BMI with a button to calculate BMI based on Height and Weight-->
				<div class='grid_8'><b>BMI</b>&nbsp;<input type='button' value='Calculate' onclick='calcBmi();'></div>
				<div class='grid_4'><input type='text' size='10' name='bmi' onKeyPress='return numbersonly(event, false)' <?php if($hwid != 0){echo "value='".$row_health[6]."'";} ?> maxlength='2' id='7' /></div>
				<div class='clear'>&nbsp;</div>
				<div id="bmiError" class='<?php echo $gridError; ?>'></div>
				<div class='clear'>&nbsp;</div><br />
				
				<!-- input for Waist circumference -->
				<div class='grid_8'><b>Waist circumference</b>&nbsp;(in inches)</div>
				<div class='grid_4'><input type='text' size='10' name='waist' onKeyPress='return numbersonly(event, false)' <?php if($hwid != 0){echo "value='".$row_health[7]."'";} ?> maxlength='2' id='8' />in.</div>
				<div class='clear'>&nbsp;</div>
				<div id="waistError" class='<?php echo $gridError; ?>'></div>
				<div class='clear'>&nbsp;</div><br />
				
				<!-- input for A1C -->
				<div class='grid_8'><b>A1C</b>&nbsp;(percentage)</div>
				<div class='grid_4'><input type='text' size='10' name='a1c' onKeyPress='return numbersonly(event, true)' <?php if($hwid != 0){echo "value='".$row_health[8]."'";} ?> maxlength='3' id='9' />%</div>
				<div class='clear'>&nbsp;</div>
				<div id="a1cError" class='<?php echo $gridError; ?>'></div>
				<div class='clear'>&nbsp;</div><br />
				
				<!-- input for Completed by -->
				<div class='grid_8'><b>Completed by</b></div>
				<div class='grid_4'><input type='text' size='30' name='completedby' <?php if($hwid != 0){echo "value='".$row_health[9]."'";} ?> maxlength='40' id='10' /></div>
				<div class='clear'>&nbsp;</div>
				<div id="completedbyError" class='<?php echo $gridError; ?>'></div>
				<div class='clear'>&nbsp;</div><br />
				
				<div class='buttonarea'><input type='submit' value='Submit' /></div>
				</form>
				<div class='clear'>&nbsp;</div>
				</div>
				
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>