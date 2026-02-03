    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php 
		//Get Database
				require ('includes/db_connect.php');
				
		//Star Session for base security
				session_start();	
				
				unset($_SESSION['demoViews']);
				unset($_SESSION['lsViews']);
				unset($_SESSION['hwViews']);
				unset($_SESSION['wdbViews']);
				unset($_SESSION['paViews']);
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		
		<!-- Link to 960.css stylesheet & main.css stylesheet --> 
			<link rel="stylesheet" href="css/960_16.css" type="text/css" />
			<link href="css/main.css" rel="stylesheet" type="text/css" />
			
		<!-- Import JQuery -->
			<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>	
			
		<!-- Remember to Change Title! -->
			<title>Participant Search</title>
			
		<!-- JavaScript -->
		<style type="text/css">

.pagNumActive {
    color: #000;
    border:#060 1px solid; background-color: #D2FFD2; padding-left:3px; padding-right:3px;
}
.paginationNumbers a:link {
    color: #000;
    text-decoration: none;
    border:#999 1px solid; background-color:#F0F0F0; padding-left:3px; padding-right:3px;
}
.paginationNumbers a:visited {
    color: #000;
    text-decoration: none;
    border:#999 1px solid; background-color:#F0F0F0; padding-left:3px; padding-right:3px;
}
.paginationNumbers a:hover {
    color: #000;
    text-decoration: none;
    border:#060 1px solid; background-color: #D2FFD2; padding-left:3px; padding-right:3px;
}
.paginationNumbers a:active {
    color: #000;
    text-decoration: none;
    border:#999 1px solid; background-color:#F0F0F0; padding-left:3px; padding-right:3px;
}
</style>	
	</head>
<?php

$sql = mysql_query('select * from participant');
$nr = mysql_num_rows($sql); // Get total of Num rows from the database query
if (isset($_GET['pn'])) { // Get pn from URL vars if it is present
    $pn = preg_replace('#[^0-9]#i', '', $_GET['pn']); // filter everything but numbers for security(new)
} else { // If the pn URL variable is not present force it to be value of page number 1
    $pn = 1;
}
 
//This is where we set how many database items to show on each page 
$itemsPerPage = 10; 
// Get the value of the last page in the pagination result set
$lastPage = ceil($nr / $itemsPerPage);
// Be sure URL variable $pn(page number) is no lower than page 1 and no higher than $lastpage
if ($pn < 1) { // If it is less than 1
    $pn = 1; // force if to be 1
} else if ($pn > $lastPage) { // if it is greater than $lastpage
    $pn = $lastPage; // force it to be $lastpage's value
} 
// This creates the numbers to click in between the next and back buttons
// This section is explained well in the video that accompanies this script
$centerPages = "";
$sub1 = $pn - 1;
$sub2 = $pn - 2;
$add1 = $pn + 1;
$add2 = $pn + 2;
if ($pn == 1) {
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
} else if ($pn == $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
} else if ($pn > 2 && $pn < ($lastPage - 1)) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub2 . '">' . $sub2 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add2 . '">' . $add2 . '</a> &nbsp;';
} else if ($pn > 1 && $pn < $lastPage) {
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $sub1 . '">' . $sub1 . '</a> &nbsp;';
    $centerPages .= '&nbsp; <span class="pagNumActive">' . $pn . '</span> &nbsp;';
    $centerPages .= '&nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $add1 . '">' . $add1 . '</a> &nbsp;';
}
// This line sets the "LIMIT" range... the 2 values we place to choose a range of rows from database in our query
$limit = 'LIMIT ' .($pn - 1) * $itemsPerPage .',' .$itemsPerPage; 
//**********************************************************************************************************************************
$paginationDisplay = ""; // Initialize the pagination output variable
// This code runs only if the last page variable is ot equal to 1, if it is only 1 page we require no paginated links to display
if ($lastPage != "1"){
    // This shows the user what page they are on, and the total number of pages
    $paginationDisplay .= 'Page <strong>' . $pn . '</strong> of ' . $lastPage. '&nbsp;  &nbsp;  &nbsp; ';
    // If we are not on page 1 we can place the Back button
    if ($pn != 1) {
        $previous = $pn - 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '"> Back</a> ';
    } 
    // Lay in the clickable numbers display here between the Back and Next links
    $paginationDisplay .= '<span class="paginationNumbers">' . $centerPages . '</span>';
    // If we are not on the very last page we can place the Next button
    if ($pn != $lastPage) {
        $nextPage = $pn + 1;
        $paginationDisplay .=  '&nbsp;  <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $nextPage . '"> Next</a> ';
    } 
}
//**********************************************************************************************************************************
$sql2 = mysql_query("select * from participant"); 
$outputList = '';
$c = 1;
while($row = mysql_fetch_array($sql2)){ 

	/*
    $id = $row["id"];
    $firstname = $row["firstname"];
    $country = $row["country"];
	*/
	$participantid = $row['PARTICIPANTID'];
	$firstname = $row['FIRSTNAME'];
	$lastname = $row['LASTNAME'];
	$email = $row['EMAIL'];
	$city = $row['CITY'];
	$stateid = $row['STATEID'];
	if($c % 2 != 0) 
		$outputList .= '<div class="grid_16 grey">';
	else
		$outputList .= '<div class="grid_16">';
	$c++;
	$outputList .= "<div class='grid_1 prefix_2'><p><form method='POST' action='participantforms.php'><input type='hidden' name='id' value='".$participantid."' /><input type='submit' value='View' /></form></p></div><div class='grid_3'><p>".$firstname." ".$lastname."</p></div><div class='grid_5'><p>".$email."</p></div><div class='grid_2'><p>".$city."</p></div><div class='grid_1'><p>".$stateid."</p></div></div>";

    //$outputList .= '<h1>' . $firstname . '</h1><h2>' . $country . ' </h2><hr />';
    
} // close while loop
?>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->			
			<div class="container container_16">
				<div class='grid_8 prefix_2 suffix_2'><h1>Participant Search</h1></div>
				<div class='clear'>&nbsp;</div>
				<div class='grid_16'>
					<div class='grid_1 prefix_2'><p><b>Action</b></p></div>
					<div class='grid_3'><p><b>Name</b></p></div>
					<div class='grid_5'><p><b>Email</b></p></div>
					<div class='grid_2'><p><b>City</b></p></div>
					<div class='grid_1'><p><b>State</b></p></div>
				</div>
				<div class='clear'>&nbsp;</div>
				<?php
				echo $outputList;
				/*
				$sql = 'select * from participant';
				$result = mysql_query($sql);
				$c = 1;
				while($row = mysql_fetch_array($result))
				{
					echo '<div class="grid_16';
					if($c % 2 != 0) echo ' grey">'; else echo '">';
					$c++;				
					echo "<div class='grid_1 prefix_2'><p>
								<form method='POST' action='participantforms.php'>
										<input type='hidden' name='id' value='".$row['PARTICIPANTID']."' />
										<input type='submit' value='View' /></form></p></div>";
					echo "<div class='grid_3'><p>".$row['FIRSTNAME']." ".$row['LASTNAME']."</p></div>";
					echo "<div class='grid_5'><p>".$row['EMAIL']."</p></div>";
					echo "<div class='grid_2'><p>".$row['CITY']."</p></div>";
					echo "<div class='grid_1'><p>".$row['STATEID']."</p></div>";
					echo '</div>';
				}
				*/
				?>
				<div class='grid_16'><?php echo $paginationDisplay; ?></div>
			</div>
				
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>