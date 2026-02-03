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
				xmlhttp.open("GET","includes/loginajax.php?user="+username+"&password="+password, true);
				xmlhttp.send();		
		}
		
		//////////Accompanying Form///////////////////
		
			<!-- PAGE CONTENT -->
			<div class="container container_12">
			<div class='grid_8 prefix_2 suffix_2'><h1>Welcome to the Ruralogic Testing Center</h1></div>
			<div class='clear'>&nbsp;</div>
			<form name='login' action='selecttest.php' method='post' >
			<input type='hidden' id='idcheck' value='' />
			<div class='grid_2 prefix_1' id='usernamestar'>&nbsp;</div>
			<div class='grid_2'><p class='right'>Email Address:</p></div>
			<div class='grid_3 suffix_3'><input type='text' size='30' id='username' name='username' /></div>
			<div class='clear'>&nbsp;</div>
			<div class='grid_3' id='passwordstar'>&nbsp;</div>
			<div class='grid_2'><p class='right'>Password:</p></div>
			<div class='grid_3'><input type='password' size='30' id='password' name='password' /></div>
			<div class='grid_2 suffix_1'><a href='forgotpassword.php'>Forgot Password</a></div>
			<div class='clear'>&nbsp;</div>
			<div class='grid_1 prefix_5 '><input type='button' value='Register' onClick='register();' /></div>
			<div class='grid_1 suffix_4'><input type='button' value='Log In' onClick='validateform();' /></div>
			</form>
			<div class='clear'>&nbsp;</div>		
			</div>
			<!-- END PAGE CONTENT -->
			