<?php
	if (!isset($_SESSION)) {
		session_start();
	}
	//Get Current Page
	$uri_array =explode('/', $_SERVER['REQUEST_URI']);  //Gets string after www.mysite.com and breaks it into parts ex: TestingDemo/selecttest.php
	$page = end($uri_array); 							//Gets the last element in the uri_array.  ex: selecttest.php
	
	$pathName = $_SERVER['PHP_SELF'];
	$pageName = basename($pathName);
	$pageName = basename($pathName, '.php');
	
	if($page != 'index.php')
	{
		if(!isset($_SESSION['user']))
			{
				header('Location: index.php');
			}
	}	
?>
<!--JAVASCRIPT -->
<script type="text/javascript">
/* <![CDATA[ */
function MsgLogoutOkCancel() 
{ 
 var fRet;
 fRet = confirm('Are you sure you want to logout?'); 
 if (fRet){
     document.location.href="index.php";
	}	
 } 
 
 /* ]]>  */
</script>
<div class="container_16">
	<div class="beige">
		<div class="grid_3 suffix_1" onclick='window.location="landingpage.php";' ><img src="images/CHWC200.png" /></div>
		<div class="grid_7 headertext"> <br/> Health and Wellness <br/> Assessment Tracking System</div>		
		<?php if($page != 'index.php'){	?>
			<div class='grid_5 greentext right printbutton'>
			&nbsp;<br/>
			<b>You are logged in as <?php echo $_SESSION['user']; ?>. <a href="#" onclick="MsgLogoutOkCancel();">(Logout)</a>&nbsp;&nbsp;&nbsp;</b>
			<!--input type="button" value="Logout"/-->
			</div>
		<?php } ?>
		<div class="clear">&nbsp;</div>
	</div>
	
	<?php if($pageName != 'index'): ?>
	<div id="navbar" class="printbutton"> 
	  <ul> 
			<li><a <?php if($pageName == 'demographicform' && !isset($_POST['partid'])): ?> class="active"<?php endif ?> href="demographicform.php">New Participant</a></li> 
			<li><a <?php if($pageName == 'participantsearch'): ?> class="active"<?php endif ?> href="participantsearch.php">Participant Search</a></li> 
			<li><a <?php if($pageName == 'reports'): ?> class="active"<?php endif ?> href="reports.php">Reports</a></li>
	  </ul> 
	</div>
	<?php else: ?>
	<div class="green">
		<br /><br />
	</div>
	<?php endif ?>
</div>			
	
			
