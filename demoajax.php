    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php 
			//Get Database
			require ('includes/db_connect.php');
				
			//Star Session for base security
			session_start();	
			
			//set session variable to prevent double posting
			if(isset($_SESSION['demoViews'])){
				$_SESSION['demoViews'] = $_SESSION['demoViews'];
			}
			else{
				$_SESSION['demoViews']=0;
			}
			
			//if the session variable demoViews is not 0 the user is sent
			//back to participant forms page
			if($_SESSION['demoViews'] != 0)
				header('Location: ../participantforms.php');
			
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<!-- Link to 960.css stylesheet & main.css stylesheet --> 
		<link rel="stylesheet" href="css/960_16.css" type="text/css" />
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<!-- Import JQuery -->
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="/js/jquery-ui-1.8.17.custom.min.js"></script>
				<script src="js/jquery.maskedinput-1.3.js" type="text/javascript"></script>
		<title>Demographic Form</title>
	</head>
	<script>
	<!--
	//function to run datepicker
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

	//Function for disabling radio buttons based on choice
	function disable(value)
	{
		var rad1 = document.getElementById("rad1");
		var rad2 = document.getElementById("rad2");
		rad1.disabled = false;
		rad2.disabled = false;
		if (value === '0') 
		{
			rad1.disabled = true;
			rad2.disabled = true;
			rad1.checked = false;
			rad2.checked = false;
		}	
	}
	
	//Form validation and error handling
	function validateForm()
	{
		//set/reset error counter
		var numErrors = 0;
		var focusString = "none";
		//set regex variables
		var emailformat=/^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})$/; //regular expression defining email format
		var dateformat=/[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])/; //regular expression defining iso 8601 date format
		var zipcodeformat=/[0-9]{5}/; //regular expression defining zipcode length(5)
		var phoneformat=/[(.0-9].[^ ]{11}/; //regular expression defining phone field length
		//check that diabetes type selected if user answers yes to diabetes question
		var rad1 = document.getElementById("rad1");
		var rad2 = document.getElementById("rad2");
		var value = document.getElementById("diabetesquestion").value;
		if(value == '' || (value == '1' && rad1.checked == false && rad2.checked == false))
		{
			numErrors++;
		}
		//reset errortext divs		
		document.getElementById("lastnameError").innerHTML="";
		document.getElementById("firstnameError").innerHTML="";
		document.getElementById("raceidError").innerHTML="";
		document.getElementById("dobError").innerHTML="<div class='grid_2 prefix_2 suffix_3'>&nbsp;</div>";
		document.getElementById("addressError").innerHTML= "";
		document.getElementById("cityError").innerHTML= "";
		document.getElementById("stateidError").innerHTML= "";
		document.getElementById("zipcodeError").innerHTML= "";
		document.getElementById("homeError").innerHTML= "";
		document.getElementById("cellError").innerHTML= "";
		document.getElementById("workError").innerHTML= "";
		document.getElementById("emailError").innerHTML= "";
		document.getElementById("havephysicianError").innerHTML= "";
		document.getElementById("diabetesquestionError").innerHTML= "";
		document.getElementById("diabeteseducationError").innerHTML= "";
		//check to see if required text fields are empty
		if(document.getElementById("firstname").value == "" && document.getElementById("lastname").value == "" )
		{
			if(focusString == "none")
				focusString = "firstname";
			numErrors++;
			document.getElementById("firstnameError").innerHTML= "<div class='grid_2 prefix_2 suffix_3'>Required field</div>";
			document.getElementById("lastnameError").innerHTML= "<div class='grid_2 suffix_6'>Required field</div>";
		}
		else if(document.getElementById("lastname").value == "" )
		{
			if(focusString == "none")
				focusString = "lastname";
			numErrors++;
			document.getElementById("lastnameError").innerHTML= "<div class ='grid_2 prefix_7 suffix_6'>Required field</div>";
		}
		else if(document.getElementById("firstname").value == "")
		{
			if(focusString == "none")
				focusString = "firstname";
			numErrors++;
			document.getElementById("firstnameError").innerHTML= "<div class ='grid_2 prefix_2 suffix_11'>Required field</div>";
		}
		if(document.getElementById('raceid').value == "8")
		{
			if(focusString == "none")
				focusString = "raceid";
			numErrors++;
			document.getElementById("raceidError").innerHTML= "Required field";
		}	
		if(document.getElementById('address').value == "")
		{
			if(focusString == "none")
				focusString = "address";
			numErrors++;
			document.getElementById("addressError").innerHTML= "Required field";
		}
		if(document.getElementById('city').value == "" && document.getElementById('stateid').value == "" && (document.getElementById('zipcode').value == "" || document.demographicForm.zipcode.value.search(zipcodeformat)==-1))
		{
			if(focusString == "none")
				focusString = "city";
			numErrors++;
			document.getElementById("cityError").innerHTML= "<div class='grid_2 prefix_2'>Required field</div>";
			document.getElementById("stateidError").innerHTML= "<div class='grid_2 prefix_2'>Required field</div>";
			document.getElementById("zipcodeError").innerHTML= "<div class='grid_4 prefix_2'>Please enter a valid zipcode</div>";
		}
		else if(document.getElementById('city').value == "" && document.getElementById('stateid').value == "")
		{
			if(focusString == "none")
				focusString = "city";
			numErrors++;
			document.getElementById("cityError").innerHTML= "<div class='grid_2 prefix_2'>Required field</div>";
			document.getElementById("stateidError").innerHTML= "<div class='grid_2 prefix_2 suffix_4'>Required field</div>";
		}
		else if(document.getElementById('city').value == "" && (document.getElementById('zipcode').value == "" || document.demographicForm.zipcode.value.search(zipcodeformat)==-1))
		{
			if(focusString == "none")
				focusString = "city";
			numErrors++;
			document.getElementById("cityError").innerHTML= "<div class='grid_2 prefix_2'>Required field</div>";
			document.getElementById("zipcodeError").innerHTML= "<div class='grid_4 prefix_6'>Please enter a valid zipcode</div>";
		}
		else if(document.getElementById('stateid').value == "" && (document.getElementById('zipcode').value == "" || document.demographicForm.zipcode.value.search(zipcodeformat)==-1))
		{
			if(focusString == "none")
				focusString = "stateid";
			numErrors++;
			document.getElementById("stateidError").innerHTML= "<div class='grid_2 prefix_6'>Required field</div>";
			document.getElementById("zipcodeError").innerHTML= "<div class='grid_4 prefix_2'>Please enter a valid zipcode</div>";
		}
		else if(document.getElementById('city').value == "")
		{
			if(focusString == "none")
				focusString = "city";
			numErrors++;
			document.getElementById("cityError").innerHTML= "<div class='grid_2 prefix_2 suffix_8'>Required field</div>";
		}
		else if(document.getElementById('stateid').value == "")
		{
			if(focusString == "none")
				focusString = "stateid";
			numErrors++;
			document.getElementById("stateidError").innerHTML= "<div class='grid_6 prefix_2 suffix_4'>Required field</div>";
		}
		
		else if(document.getElementById('zipcode').value == "" || document.demographicForm.zipcode.value.search(zipcodeformat)==-1)
		{
			if(focusString == "none")
				focusString = "zipcode";
			numErrors++;
			document.getElementById("zipcodeError").innerHTML= "<div class='grid_4 prefix_8'>Please enter a valid zipcode</div>";
		}
		if((document.getElementById('home').value != "" && document.demographicForm.home.value.search(phoneformat)==-1) && (document.getElementById('work').value != "" && document.demographicForm.work.value.search(phoneformat)==-1) && (document.getElementById('cell').value != "" && document.demographicForm.cell.value.search(phoneformat)==-1))
		{
			if(focusString == "none")
				focusString = "home";
			numErrors++;
			document.getElementById("homeError").innerHTML= "<div class='grid_4 prefix_3'>Please complete field if applicable</div>";
			document.getElementById("workError").innerHTML= "<div class='grid_4'>Please complete field if applicable</div>";
			document.getElementById("cellError").innerHTML= "<div class='grid_4'>Please complete field if applicable</div>";
		}
		else if((document.getElementById('home').value != "" && document.demographicForm.home.value.search(phoneformat)==-1) && (document.getElementById('work').value != "" && document.demographicForm.work.value.search(phoneformat)==-1))
		{
			if(focusString == "none")
				focusString = "home";
			numErrors++;
			document.getElementById("homeError").innerHTML= "<div class='grid_4 prefix_3'>Please complete field if applicable</div>";
			document.getElementById("workError").innerHTML= "<div class='grid_4 suffix_4'>Please complete field if applicable</div>";
		}
		else if((document.getElementById('home').value != "" && document.demographicForm.home.value.search(phoneformat)==-1) && (document.getElementById('cell').value != "" && document.demographicForm.cell.value.search(phoneformat)==-1))
		{
			if(focusString == "none")
				focusString = "home";
			numErrors++;
			document.getElementById("homeError").innerHTML= "<div class='grid_4 prefix_3'>Please complete field if applicable</div>";
			document.getElementById("cellError").innerHTML= "<div class='grid_4 prefix_4'>Please complete field if applicable</div>";
		}
		else if((document.getElementById('work').value != "" && document.demographicForm.work.value.search(phoneformat)==-1) && (document.getElementById('cell').value != "" && document.demographicForm.cell.value.search(phoneformat)==-1))
		{
			if(focusString == "none")
				focusString = "work";
			numErrors++;
			document.getElementById("workError").innerHTML= "<div class='grid_4 prefix_7'>Please complete field if applicable</div>";
			document.getElementById("cellError").innerHTML= "<div class='grid_4'>Please complete field if applicable</div>";
		}
		else if(document.getElementById('home').value != "" && document.demographicForm.home.value.search(phoneformat)==-1)
		{
			if(focusString == "none")
				focusString = "home";
			numErrors++;
			document.getElementById("homeError").innerHTML= "<div class='grid_4 prefix_3 suffix_8'>Please complete field if applicable</div>";
		}
		else if(document.getElementById('work').value != "" && document.demographicForm.work.value.search(phoneformat)==-1)
		{
			if(focusString == "none")
				focusString = "work";
			numErrors++;
			document.getElementById("workError").innerHTML= "<div class='grid_4 prefix_7 suffix_4'>Please complete field if applicable</div>";
		}
		else if(document.getElementById('cell').value != "" && document.demographicForm.cell.value.search(phoneformat)==-1)
		{
			if(focusString == "none")
				focusString = "cell";
			numErrors++;
			document.getElementById("cellError").innerHTML= "<div class='grid_4 prefix_11'>Please complete field if applicable</div>";
		}
		if(document.getElementById('email').value == "" || document.demographicForm.email.value.search(emailformat)==-1)
		{
			if(focusString == "none")
				focusString = "email";
			numErrors++;
			document.getElementById("emailError").innerHTML= "<div class='grid_4 prefix_2 suffix_9'>Please enter a valid email address</div>";
		}	
		if(document.getElementById('havephysician').value == "")
		{
			if(focusString == "none")
				focusString = "havephysician";
			numErrors++;
			document.getElementById("havephysicianError").innerHTML= "Required field";
		}	
		if(document.getElementById('diabeteseducation').value == "")
		{
			if(focusString == "none")
				focusString = "diabeteseducation";
			numErrors++;
			document.getElementById("diabeteseducationError").innerHTML= "Required field";
		}
		if(document.getElementById('diabetesquestion').value == '' || (document.getElementById('diabetesquestion').value == '1' && document.getElementById("rad1").checked == false && document.getElementById("rad2").checked == false))
		{
			if(focusString == "none")
				focusString = "diabetesquestion";
			numErrors++;
			document.getElementById("diabetesquestionError").innerHTML= "Required field";
		}
		
		if($("#datepicker").val() == "")
		{
			document.getElementById("dobError").innerHTML= "<div class='grid_5 prefix_2'>Please enter a date</div>";
			document.getElementById('datepicker').focus();			
			return false;
		}
		var str = 'datepicker';
		if(!validatedate(str))
		{
			document.getElementById("dobError").innerHTML = "<div class='grid_5 prefix_2'>Please enter a valid date (YYYY-MM-DD)</div>";
			numErrors++;
			document.getElementById('datepicker').focus();
			return false;
		}
		if(!nonfutureDate(document.getElementById(str).value))
		{
			if(focusString == "none")
				focusString = "datepicker";
			numErrors++;
			document.getElementById("dobError").innerHTML = "<div class='grid_5 prefix_2'>Please enter a non-future date</div>";
		}
		
			  
		//If any errors are raised the form will not submit and alert the user.
		if(numErrors == 0)
		{
			document.getElementById('submitButton').disabled=true;
			var emailaddress = document.getElementById('email').value;
			var errors = 0;
			var xmlhttp;
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					var response = xmlhttp.responseText;
					//alert(xmlhttp.responseText);
					if(response > 0) 
					{
						errors = 1; 
						document.getElementById("emailError").innerHTML= "<div class='grid_4 prefix_2 suffix_9'>Email already Exsits</div>";
						document.getElementById("email").focus();
						document.getElementById('submitButton').disabled=false;						
					}	
					
					if(errors == 0)
						document.forms.demographicForm.submit();					
						
				}
			}
			xmlhttp.open("GET","ajax/emailajax.php?email="+emailaddress, true);
			xmlhttp.send();			
			//return true;
		}
		else
		{
			document.getElementById(focusString).focus();
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

		//This function prevents the user from picking a date past the current date
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

		//masking for various fields
		jQuery(function($){
			$("#datepicker").mask("9999-99-99", {
				placeholder : " "
			});
			$("#home").mask("(999)999-9999", {
				placeholder : "_"
			});
			$("#work").mask("(999)999-9999", {
				placeholder : "_"
			});
			$("#cell").mask("(999)999-9999", {
				placeholder : "_"
			});
			$("#zipcode").mask("99999", {
				placeholder : " "
			});
		});
//-->
	</script> 
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
			<?php		
				//set partid from the session variable
				if(!isset($_POST['partid']))
					$partid = 0;
				else
					$partid = $_POST['partid'];
				
				if($partid != 0)
				{
					$sql_participant = "select * from participant where participantid = ".$partid;
					$result_participant = mysql_query($sql_participant);
					$row_participant = mysql_fetch_row($result_participant);
				}
			?>
			
			<div class="container container_16">
				<div class='grid_16'><h1>Health and Wellness Assessment Informed Consent</h1></div>
					
				<div class='clear'>&nbsp;</div>
					
				<!--| build demographic form |-->
				<form action="post/demographicformpost.php" name='demographicForm' id='demoForm' method="post" >
				<!-- Hidden field based on participant ID -->
				<div class='clear'><input type='hidden' id='partid' name='partid' value='<?php echo $partid; ?>' /></div>
					<fieldset>
						<legend><b>Demographic Information</b></legend>
						<div class='clear'>&nbsp;</div><br />
						<div class="errortext"id="firstnameError"></div>
						<div class="errortext" id="lastnameError"></div>
						<div class='grid_2 prefix_2'>
							<p class='right'>First name:</p>
						</div><div class='grid_3'> 
							<p><input type="text" id="firstname" name="firstname"  <?php if($partid != 0){echo "value='".$row_participant[1]."'";} ?> maxlength="20" /></p>
						</div>
						
						<div class='grid_2'>
							<p class='right'>Last name:</p>
						</div>
						<div class='grid_3 suffix_3'> 
							<p><input type="text" id="lastname" name="lastname" <?php if($partid != 0){echo "value='".$row_participant[2]."'";} ?> maxlength="20" /></p>
						</div>
						
						<div class='clear'>&nbsp;</div><br />
						<div class="errortext"id="dobError">&nbsp;</div>
						<div class='grid_2 suffix_6'><div class="errortext" id="raceidError"></div></div>
						<div class='clear'>&nbsp;</div>
						<div class='grid_2 prefix_2'>
							<p class='right'>Date of Birth:</p>
						</div>
						<div class='grid_3'> 
							<p><input type="text" name="date" <?php if($partid != 0){echo "value='".$row_participant[3]."'";} else{echo "value=''";} ?> id="datepicker"/></p>
						</div>
						
						<div class='grid_2'>
						<p class='right'>Ethnic Origin/race:</p>
						</div>
						<div class='grid_2 suffix_4'> 
						<!--| build state dropdown from database |-->
						<p><select id="raceid" name="raceid">
							<?php
								//build and run query on racelookup table for select list
								$sql = "SELECT RACEID, RACEDESC FROM racelookup ".
									   "ORDER BY RACEID desc";

								$rs = mysql_query($sql);

								while($row = mysql_fetch_array($rs))
								{
									$raceid = $row['RACEID'];
									echo "<option ".($partid != 0 ? ($raceid == $row_participant[8] ? " selected " : "") : "")." value=\"".$row['RACEID']."\">".$row['RACEDESC']."</option>\n  ";
								}
							?>
						</select></p>
						</div>

						<div class='clear'>&nbsp;</div><br />	
						<div class='grid_2 prefix_2 suffix_11'><div class="errortext"id="addressError"></div></div>					
						<div class='grid_2 prefix_2'>
							<p class='right'>Address:</p>
						</div>
						<div class='grid_11'>
							<p><input type="text" id="address" name="address" <?php if($partid != 0){echo "value='".$row_participant[4]."'";} ?>/></p>
						</div>
												
						<div class='clear'>&nbsp;</div><br />	
						
						<div class="errortext"id="cityError"></div>
						<div class="errortext" id="stateidError"></div>
						<div class="errortext" id="zipcodeError"></div>
						<div class='grid_2 prefix_2'>
							<p class='right'>City:</p>
						</div>
						<div class='grid_2'> 
							<p><input type="text" id="city" name="city" maxlength="20" <?php if($partid != 0){echo "value='".$row_participant[5]."'";} ?>/></p>
						</div>
						
						<div class='grid_2'>
						<p class='right'>State:</p>
						</div>
						<div class='grid_2'>
						<!--| build state dropdown from database |-->
						<p><select id="stateid" name="stateid">
								<option value="">Select</option>
							<?php
								$sql = "SELECT STATEID, STATEDESC FROM statelookup ".
									   "ORDER BY STATEDESC";

								$rs = mysql_query($sql);

								while($row = mysql_fetch_array($rs))
								{
									$stateid = $row['STATEID'];
									echo "<option ".($partid != 0 ? ($stateid == $row_participant[7] ? " selected " : "") : "")." value=\"".$row['STATEID']."\">".$row['STATEDESC']."</option>\n  ";
								}
							?>
						</select></p>
						</div>
						
						<div class='grid_2'>
							<p class='right'>Zip code:</p>
						</div>
						<div class='grid_2'> 
							<p><input type="text" id="zipcode" name="zipcode" <?php if($partid != 0){echo "value='".str_pad($row_participant[6], 5, "0", STR_PAD_LEFT)."'";} ?> /></p>
						</div>
						
						<div class='clear'>&nbsp;</div><br />					

						<div class="errortext"id="homeError"></div>
						<div class="errortext" id="workError"></div>
						<div class="errortext" id="cellError"></div>
						<div class='grid_2 prefix_2'>
							<p class='right'>Phone(home):</p>
						</div>
						<div class='grid_2'> 
							<p><input type="text" id="home" name="home" <?php if($partid != 0){echo "value='".$row_participant[10]."'";} ?> /></p>
						</div>
						
						<div class='grid_2'>
							<p class='right'>(work):</p>
						</div>
						<div class='grid_2'> 
							<p><input type="text" id="work" name="work" <?php if($partid != 0){echo "value='".$row_participant[11]."'";} ?> /></p>
						</div>
						
						<div class='grid_2'>
							<p class='right'>(cell):</p>
						</div>
						<div class='grid_2 suffix_1'> 
							<p><input type="text" id="cell" name="cell" <?php if($partid != 0){echo "value='".$row_participant[12]."'";} ?> /></p>
						</div>						
						
						<div class='clear'>&nbsp;</div><br />
												
						<div class="errortext"id="emailError"></div>
						<div class='grid_2 prefix_2'>
							<p class='right'>Email:</p>
						</div><div class='grid_11'>
							<p><input type="text" id="email" name="email" maxlength="50" <?php if($partid != 0){echo "value='".$row_participant[9]."'";} ?>/></p>
						</div>	
						<div class='clear'>&nbsp;</div><br />
					</fieldset>					
					
					<div class='clear'>&nbsp;</div><br />
												
					<fieldset>
						<legend><b>Health Care Information</b></legend>
						<div class='clear'>&nbsp;</div><br />						
						<div class="grid_2 prefix_1 suffix_12"><div class="errortext"id="havephysicianError"></div></div>
						<div class='grid_5 prefix_1'>
						<p>Do you have a primary care physician?</p>
						</div>
						<div class='grid_2 suffix_7'> 
						<p><select id="havephysician" name="havephysician" >
							<option value="">Select</option>
							<option <?php if($partid != 0) { if($row_participant[14] == 1) { echo ' selected '; } } ?> value="1">Yes</option>
							<option <?php if($partid != 0) { if($row_participant[14] == 0) { echo ' selected '; } }?> value="0">No</option>
						</select></p>
						</div>						
						
						<div class='clear'>&nbsp;</div><br />
												
						<div class="grid_2 prefix_1 suffix_12"><div class="errortext"id="diabetesquestionError"></div></div>
						<div class='grid_5 prefix_1'>
							<p>Have you ever been diagnosed with diabetes/pre-diabetes?</p>
						</div><div class='grid_2'>
							<p><select id="diabetesquestion" name="diabetesquestion" onchange="disable(this.value);">
								<option value="">Select</option>
								<option <?php if($partid != 0) { if($row_participant[15] == 1) { echo ' selected '; } }?> value="1">Yes</option>
								<option <?php if($partid != 0) { if($row_participant[15] == 0) { echo ' selected '; } }?> value="0">No</option>
							</select></p>
						</div>
						
						<div class='grid_2'>
							<p>If yes, which?</p>
						</div><div class='grid_4'>
						<?php
							//used for populating radio buttons for editing functionality
							$diatext = '';
							$pretext = '';
							if($partid !=0)
							{
								if($row_participant[15] == 1)
								{
									if($row_participant[16] == 1)
									{
										$diatext = "checked='true'";
										
									}
									else
									{
										$pretext = "checked='true'";
									}
								}
								else
								{
									$diatext = "disabled='true'";
									$pretext = "disabled='true'";
								}
							}
						?>
							<p><input <?php echo $diatext; ?> type="radio" id="rad1" name="diabetesconfirmation" value="1" /> Diabetes
							<input <?php echo $pretext; ?> type="radio" id="rad2" name="diabetesconfirmation" value="0" /> Pre-diabetes</p>
						</div>						
						
						<div class='clear'>&nbsp;</div><br />
											
						<div class="grid_2 prefix_1 suffix_12"><div class="errortext"id="diabeteseducationError"></div></div>
						<div class='grid_5 prefix_1'>
							<p>Have you ever had education for diabetes/pre-diabetes?</p>
						</div><div class='grid_2 suffix_7'>
							<p><select id="diabeteseducation" name="diabeteseducation">
								<option value="">Select</option>
								<option <?php if($partid != 0) { if($row_participant[17] == 1) { echo ' selected '; } } ?> value="1">Yes</option>
								<option <?php if($partid != 0) { if($row_participant[17] == 0) { echo ' selected '; } } ?> value="0">No</option>
							</select></p>
						</div>						
						
						<div class='clear'>&nbsp;</div><br />
												
						<div class='grid_14 prefix_1'>
							<p class=''>Current Medications - check boxes if you take medication for any of the following:</p>
						</div><div class='grid_14 prefix_1' id="reportdisplay">
							<p><input <?php if($partid != 0) { if($row_participant[18] == 1) { echo ' checked=\'true\' '; } } ?> type="checkbox" name="diabetes" value="1" /> Diabetes/Pre-Diabetes&nbsp;&nbsp;&nbsp;
							<input <?php if($partid != 0) { if($row_participant[19] == 1) { echo ' checked=\'true\' '; } } ?> type="checkbox" name="thyroid" value="1" /> Thyroid Issues&nbsp;&nbsp;&nbsp;
							<input <?php if($partid != 0) { if($row_participant[20] == 1) { echo ' checked=\'true\' '; } } ?> type="checkbox" name="asthma" value="1" /> Asthma/Breathing Issues&nbsp;&nbsp;&nbsp;
							<input <?php if($partid != 0) { if($row_participant[21] == 1) { echo ' checked=\'true\' '; } } ?> type="checkbox" name="depression" value="1" /> Mood/Anxiety/Depression&nbsp;&nbsp;&nbsp;
							<input <?php if($partid != 0) { if($row_participant[22] == 1) { echo ' checked=\'true\' '; } } ?> type="checkbox" name="pain" value="1" /> Pain</p>
						</div>						
						
						<div class='clear'>&nbsp;</div><br />
					</fieldset>					
					
					<br />
					<div class='grid_16'>
						<p class='left'><b><u>Project Description:</u></b></p>
					</div>
					<div class='clear'>&nbsp;</div>
					<div class='grid_16'>
						<p>The Health and Wellness Assessment (HWA) is an effort specifically designed to help people understand their risk factors for diabetes and weight management. The primary education function will be to teach how proper nutrition and physical activity play a major role in a healthy lifestyle. The HWA is a combined effort of the Williams County Health Deapartment (WCHD), Midwest Community Health Associates (MCHA) and Community Hospitals and Wellness Centers (CHWC).</p>
					</div>
					<div class='clear'>&nbsp;</div>
					<div class='grid_16'>
						<p class='left'><b><u>Information to be collected today:</u></b></p>
					</div>
					<div class='clear'>&nbsp;</div>
					<div class='grid_16'>
						<p>The assessment will collect the following information:</p>
						<ul>
							<li>Demographic information</li>
							<ul>
								<li>For use in establishing a database for research and for continuing communication with each participant.</li>
								<ul>
									<li>Name, date of birth, gender, address, contact telephone, contact email, ethnic origin, current primary medical provider</li>
								</ul>
							</ul>
							<li>Clinical Information</li>
							<ul>
								<li>For use in determining your personal risk factors for diabetes and weight control</li>
								<ul>
									<li>Current medications, height, weight, waist measurement</li>
								</ul>
							</ul>
							<li>Finger Stick Blood Test</li>
								<ul>
								<li>For use in obtaining your hemoglobin A1C level; a marker for risk of diabetes.</li>
								<li>Additional testing by your physician may be needed to make any diagnosis.</li>
							</ul>
							<li>Your responses to 8 lifestyle questions</li>
							<ul>
								<li>For use in assessing your current nutrition and physical activity behaviors</li>
							</ul>
							<li>Your responses to how you make decisions about the importance of weight management</li>
							<ul>
								<li>For use in determining the specific factors that motivate you to have a healthier lifestyle</li>
							</ul>
						</ul>
					</div>
					<div class='clear'>&nbsp;</div>
					<div class='grid_16'>
						<p class='left'><b><u>What we will do with the information we obtain:</u></b></p>
					</div>
					<div class='clear'>&nbsp;</div>
					<div class='grid_16'>
						<p>We will be collecting all the information in order to determine your level of risk for diabetes and weight control issues. The results we obtain today will allow us to provide you with immediate education "coaching" today. A trained health professional will review all the results with you and establish future plans based on your specific needs.</p>
					</div>
					<div class='clear'>&nbsp;</div>
					<div class='grid_16'>
						<p class='left'><b><u>Ongoing communication with you:</u></b></p>
					</div>
					<div class='clear'>&nbsp;</div>
					<div class='grid_16'>
						<p>You will recieve ongoing communication from us. The frequency and detail of communication will be based on the risk factors from today's assessment. In general, the higher your risk factors, the sooner we will be communicating with you.</p>
					</div>
					<div class='clear'>&nbsp;</div>
					<div class='grid_16'>
						<p class='left'><b><u>All services are free of charge</u></b></p>
					</div>
					<div class='clear'>&nbsp;</div>
					<div class='grid_16'>
						<p class='left'><b><u>Future services may have fees/charges:</u></b></p>
					</div>
					<div class='clear'>&nbsp;</div>
					<div class='grid_16'>
						<p>For all future services related to this project and your participation, we will always inform you in advance if the service is
						free or if there will be fees/charges. We will make every effort to support every participant, regardless of ability to pay.</p>
					</div>
					<div class='clear'>&nbsp;</div>
					<input type="button" id="submitButton" value="Submit" onClick="return validateForm()"/>
				</form>
			</div>
		</div>
		<!-- END PAGE CONTENT -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
		<!-- END SITE CONTAINER -->
	</body>
</html>
		