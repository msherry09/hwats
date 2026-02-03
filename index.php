    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php 
		//Get Database
				require ('includes/db_connect.php');
				
		//Star Session for base security
					session_start(); 
					session_destroy();
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		
		<!-- Link to 960.css stylesheet & main.css stylesheet --> 
			<link rel="stylesheet" href="css/960_16.css" type="text/css" />
			<link href="css/main.css" rel="stylesheet" type="text/css" />
			
		<!-- Import JQuery -->
			<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>	
			
		<!-- Remember to Change Title! -->
			<title>HWATS - Login</title>
			
		<!-- JavaScript -->
			<script type='text/javascript'>
		function validateform()
		{
			var errors = 0;
			//Collect Varaible Values
			var username 		= document.getElementById('username').value;
			var password 		= document.getElementById('password').value;			
			//Check for Nulls
			if(username 		== '') {errors = 1; document.getElementById('usernamestar').innerHTML ="<p class='right'><font size='1' color='red'><i>*Please Answer</i></font></p>";}
				else document.getElementById('usernamestar').innerHTML ="&nbsp;";
			if(password 		== '') {errors = 1; document.getElementById('passwordstar').innerHTML = "<p class='right'><font size='1' color='red'><i>*Please Answer</i></font></p>";}
				else document.getElementById('passwordstar').innerHTML ="&nbsp;";
			//Check DB for Account
			if(errors == 0)
			{
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
						if(response != 1) {errors = 1; document.getElementById('usernamestar').innerHTML ="<p class='right'><font size='1' color='red'><i>Invalid Username and/or Password</i></font></p>";}
						if(errors == 0)
							document.forms.login.submit();
					}
				  }
				xmlhttp.open("GET","ajax/loginajax.php?user="+username+"&password="+password, true);
				xmlhttp.send();
			}
			
		}

		</script>
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
			
			<div class="container container_16">
			<div class='grid_16 center'><h3>Login</h3></div>
			<div class='clear'>&nbsp;</div>
			<form name='login' action='post/loginpost.php' method='post' >
			<input type='hidden' id='idcheck' value='' />
			<div class='grid_2 prefix_3' id='usernamestar'>&nbsp;</div>
			<div class='grid_2'><p class='right'>Username:</p></div>
			<div class='grid_3 suffix_3'><input type='text' size='30' id='username' name='username' /></div>
			<div class='clear'>&nbsp;</div>
			<div class='grid_3 prefix_2' id='passwordstar'>&nbsp;</div>
			<div class='grid_2'><p class='right'>Password:</p></div>
			<div class='grid_3'><input type='password' size='30' id='password' name='password' /></div>
			<div class='clear'>&nbsp;</div>
			<div class='grid_16 center'><input type='button' value='Login' onClick='validateform();' /></div>
			</form>
			<div class='clear'>&nbsp;</div>		
			</div>
				
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>