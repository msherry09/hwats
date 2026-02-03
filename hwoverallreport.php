    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php 
		//Get Database
				require ('includes/db_connect.php');
				
		//Start Session for base security
				session_start();				
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		
		<!-- Link to 960.css stylesheet & main.css stylesheet --> 
			<link rel="stylesheet" href="css/960_16.css" type="text/css" />
			<link href="css/main.css" rel="stylesheet" type="text/css" />
			
		<!-- Import JQuery -->
			<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>	
			
		<!-- Remember to Change Title! -->
			<title>Health and Wellness Assessment - Overall Report</title>
			
		<!-- JavaScript -->
			
	</head>
	<body>
		<div class="site"><!-- SITE CONTAINER -->
			<!-- PAGE HEADER --><?php include "includes/header.php"; ?><!-- END PAGE HEADER -->
			<!-- PAGE CONTENT -->
			
				<div class="container container_16">
				<div class='grid_16 center'><h1>Health and Wellness Overall Report</h1></div>
				<div class='clear'>&nbsp;</div>
				<fieldset>
				<legend><b>Total of Measurements</b></legend>
				<div class='clear'>&nbsp;</div><br />
				
				<div class='grid_3'><b><br />Weight</b></div>
				<div class='grid_2 center'><br /><u>90 - 100 lbs.</u></div>
				<div class='grid_2 center'><br /><u>100 - 150 lbs.</u></div>
				<div class='grid_2 center'><br /><u>150 - 200 lbs.</u></div>
				<div class='grid_2 center'><br /><u>200 - 250 lbs.</u></div>
				<div class='grid_2 center'>250 lbs.<br /><u>and over</u></div>
				<div class='clear'>&nbsp;</div>
				
				<div class='grid_3'>No. of measurements</div>
				<?php 
				//query for first set of weight counts
				$weight_range1 = "select count(WEIGHT) from hwaresult where WEIGHT between 90 and 99";
				$weight_result1 = mysql_query($weight_range1);
				$row_weight1 = mysql_fetch_row($weight_result1);
				//display number of results
				echo "<div class='grid_2 center'>".$row_weight1[0]."</div>";
				
				//query for second set of weight counts
				$weight_range2 = "select count(WEIGHT) from hwaresult where WEIGHT between 100 and 149";
				$weight_result2 = mysql_query($weight_range2);
				$row_weight2 = mysql_fetch_row($weight_result2);
				//display number of results
				echo "<div class='grid_2 center'>".$row_weight2[0]."</div>";
				
				//query for third set of weight counts
				$weight_range3 = "select count(WEIGHT) from hwaresult where WEIGHT between 150 and 199";
				$weight_result3 = mysql_query($weight_range3);
				$row_weight3 = mysql_fetch_row($weight_result3);
				//display number of results
				echo "<div class='grid_2 center'>".$row_weight3[0]."</div>";
				
				//query for fourth set of weight counts
				$weight_range4 = "select count(WEIGHT) from hwaresult where WEIGHT between 200 and 249";
				$weight_result4 = mysql_query($weight_range4);
				$row_weight4 = mysql_fetch_row($weight_result4);
				//display number of results
				echo "<div class='grid_2 center'>".$row_weight4[0]."</div>";
				
				//query for fifth set of weight counts
				$weight_range5 = "select count(WEIGHT) from hwaresult where WEIGHT >= 250";
				$weight_result5 = mysql_query($weight_range5);
				$row_weight5 = mysql_fetch_row($weight_result5);
				//display number of results
				echo "<div class='grid_2 center'>".$row_weight5[0]."</div>";
				?>
				<div class='clear'>&nbsp;</div><br />
				
				<div class='grid_3'><b>Height</b></div>
				<div class='grid_2 center'><u>3 - 4ft.</u></div>
				<div class='grid_2 center'><u>4 - 5ft.</u></div>
				<div class='grid_2 center'><u>5 - 6ft.</u></div>
				<div class='grid_2 center'><u>6ft. - 7ft.</u></div>
				<div class='grid_2 center'><u>7ft. and over</u></div>
				<div class='clear'>&nbsp;</div>
				
				<div class='grid_3'>No. of measurements</div>
				<?php 
				//query for first set of height counts
				$height_range1 = "select count(HEIGHT) from hwaresult where HEIGHT >= \"3' 0'\" and HEIGHT < \"3' 11'\"";
				$height_result1 = mysql_query($height_range1);
				$row_height1 = mysql_fetch_row($height_result1);
				//display number of results
				echo "<div class='grid_2 center'>".$row_height1[0]."</div>";
				
				//query for second set of height counts
				$height_range2 = "select count(HEIGHT) from hwaresult where HEIGHT >= \"4' 0'\" and HEIGHT < \"4' 11'\"";
				$height_result2 = mysql_query($height_range2);
				$row_height2 = mysql_fetch_row($height_result2);
				//display number of results
				echo "<div class='grid_2 center'>".$row_height2[0]."</div>";
				
				//query for third set of height counts
				$height_range3 = "select count(HEIGHT) from hwaresult where HEIGHT >= \"5' 0'\" and HEIGHT < \"5' 11'\"";
				$height_result3 = mysql_query($height_range3);
				$row_height3 = mysql_fetch_row($height_result3);
				//display number of results
				echo "<div class='grid_2 center'>".$row_height3[0]."</div>";
				
				//query for fourth set of height counts
				$height_range4 = "select count(HEIGHT) from hwaresult where HEIGHT >= \"6' 0'\" and HEIGHT < \"6' 11'\"";
				$height_result4 = mysql_query($height_range4);
				$row_height4 = mysql_fetch_row($height_result4);
				//display number of results
				echo "<div class='grid_2 center'>".$row_height4[0]."</div>";
				
				//query for fifth set of height counts
				$height_range5 = "select count(HEIGHT) from hwaresult where HEIGHT >= \"7' 0'\"";
				$height_result5 = mysql_query($height_range5);
				$row_height5 = mysql_fetch_row($height_result5);
				//display number of results
				echo "<div class='grid_2 center'>".$row_height5[0]."</div>";
				?>
				<div class='clear'>&nbsp;</div><br />
				
				<div class='grid_3'><b>BMI</b></div>
				<div class='grid_2 center'><u>20 - 25</u></div>
				<div class='grid_2 center'><u>25 - 30</u></div>
				<div class='grid_2 center'><u>30 - 35</u></div>
				<div class='grid_2 center'><u>35 - 40</u></div>
				<div class='grid_2 center'><u>40 and over</u></div>
				<div class='clear'>&nbsp;</div>
				
				<div class='grid_3'>No. of measurements</div>
				<?php 
				//query for first set of bmi counts
				$bmi_range1 = "select count(BMI) from hwaresult where BMI between 20 and 24";
				$bmi_result1 = mysql_query($bmi_range1);
				$row_bmi1 = mysql_fetch_row($bmi_result1);
				//display number of results
				echo "<div class='grid_2 center'>".$row_bmi1[0]."</div>";
				
				//query for second set of bmi counts
				$bmi_range2 = "select count(BMI) from hwaresult where BMI between 25 and 29";
				$bmi_result2 = mysql_query($bmi_range2);
				$row_bmi2 = mysql_fetch_row($bmi_result2);
				//display number of results
				echo "<div class='grid_2 center'>".$row_bmi2[0]."</div>";
				
				//query for third set of bmi counts
				$bmi_range3 = "select count(BMI) from hwaresult where BMI between 30 and 34";
				$bmi_result3 = mysql_query($bmi_range3);
				$row_bmi3 = mysql_fetch_row($bmi_result3);
				//display number of results
				echo "<div class='grid_2 center'>".$row_bmi3[0]."</div>";
				
				//query for fourth set of bmi counts
				$bmi_range4 = "select count(BMI) from hwaresult where BMI between 35 and 39";
				$bmi_result4 = mysql_query($bmi_range4);
				$row_bmi4 = mysql_fetch_row($bmi_result4);
				//display number of results
				echo "<div class='grid_2 center'>".$row_bmi4[0]."</div>";
				
				//query for fifth set of bmi counts
				$bmi_range5 = "select count(BMI) from hwaresult where BMI >= 40";
				$bmi_result5 = mysql_query($bmi_range5);
				$row_bmi5 = mysql_fetch_row($bmi_result5);
				//display number of results
				echo "<div class='grid_2 center'>".$row_bmi5[0]."</div>";
				?>
				<div class='clear'>&nbsp;</div><br />
				
				<div class='grid_3'><br /><br /><b>Waist</b></div>
				<div class='grid_2 center'><br />10 - 20<br /><u>inches</u></div>
				<div class='grid_2 center'><br />20 - 30<br /><u>inches</u></div>
				<div class='grid_2 center'><br />30 - 40<br /><u>inches</u></div>
				<div class='grid_2 center'><br />40 - 50<br /><u>inches</u></div>
				<div class='grid_2 center'><br />50 inches<br /><u>and over</u></div>
				<div class='clear center'>&nbsp;</div>
				
				<div class='grid_3'>No. of measurements</div>
				<?php 
				//query for first set of waist counts
				$waist_range1 = "select count(WAIST) from hwaresult where WAIST between 10 and 19";
				$waist_result1 = mysql_query($waist_range1);
				$row_waist1 = mysql_fetch_row($waist_result1);
				//display number of results
				echo "<div class='grid_2 center'>".$row_waist1[0]."</div>";
				
				//query for second set of waist counts
				$waist_range2 = "select count(WAIST) from hwaresult where WAIST between 20 and 29";
				$waist_result2 = mysql_query($waist_range2);
				$row_waist2 = mysql_fetch_row($waist_result2);
				//display number of results
				echo "<div class='grid_2 center'>".$row_waist2[0]."</div>";
				
				//query for third set of waist counts
				$waist_range3 = "select count(WAIST) from hwaresult where WAIST between 30 and 39";
				$waist_result3 = mysql_query($waist_range3);
				$row_waist3 = mysql_fetch_row($waist_result3);
				//display number of results
				echo "<div class='grid_2 center'>".$row_waist3[0]."</div>";
				
				//query for fourth set of waist counts
				$waist_range4 = "select count(WAIST) from hwaresult where WAIST between 40 and 49";
				$waist_result4 = mysql_query($waist_range4);
				$row_waist4 = mysql_fetch_row($waist_result4);
				//display number of results
				echo "<div class='grid_2 center'>".$row_waist4[0]."</div>";
				
				//query for fifth set of waist counts
				$waist_range5 = "select count(WAIST) from hwaresult where WAIST >= 50";
				$waist_result5 = mysql_query($waist_range5);
				$row_waist5 = mysql_fetch_row($waist_result5);
				//display number of results
				echo "<div class='grid_2 center'>".$row_waist5[0]."</div>";
				?>
				<div class='clear'>&nbsp;</div><br />
				
				<div class='grid_3'><b>A1C</b></div>
				<div class='grid_2 center'><u>under 4%</u></div>
				<div class='grid_2 center'><u>4% - 5%</u></div>
				<div class='grid_2 center'><u>5% - 6%</u></div>
				<div class='grid_2 center'><u>6% - 7%</u></div>
				<div class='grid_2 center'><u>over 7%</u></div>
				<div class='clear center'>&nbsp;</div>
				
				<div class='grid_3'>No. of measurements</div>
				<?php 
				//query for first set of a1c counts
				$a1c_range1 = "select count(A1C) from hwaresult where A1C <= 3.9";
				$a1c_result1 = mysql_query($a1c_range1);
				$row_a1c1 = mysql_fetch_row($a1c_result1);
				//display number of results
				echo "<div class='grid_2 center'>".$row_a1c1[0]."</div>";
				
				//query for second set of a1c counts
				$a1c_range2 = "select count(A1C) from hwaresult where A1C between 4 and 4.9";
				$a1c_result2 = mysql_query($a1c_range2);
				$row_a1c2 = mysql_fetch_row($a1c_result2);
				//display number of results
				echo "<div class='grid_2 center'>".$row_a1c2[0]."</div>";
				
				//query for third set of a1c counts
				$a1c_range3 = "select count(A1C) from hwaresult where A1C between 5 and 5.9";
				$a1c_result3 = mysql_query($a1c_range3);
				$row_a1c3 = mysql_fetch_row($a1c_result3);
				//display number of results
				echo "<div class='grid_2 center'>".$row_a1c3[0]."</div>";
				
				//query for fourth set of a1c counts
				$a1c_range4 = "select count(A1C) from hwaresult where A1C between 6 and 6.9";
				$a1c_result4 = mysql_query($a1c_range4);
				$row_a1c4 = mysql_fetch_row($a1c_result4);
				//display number of results
				echo "<div class='grid_2 center'>".$row_a1c4[0]."</div>";
				
				//query for fifth set of a1c counts
				$a1c_range5 = "select count(A1C) from hwaresult where A1C >= 7";
				$a1c_result5 = mysql_query($a1c_range5);
				$row_a1c5 = mysql_fetch_row($a1c_result5);
				//display number of results
				echo "<div class='grid_2 center'>".$row_a1c5[0]."</div>";
				?>
				<div class='clear'>&nbsp;</div><br />
				
				</div>
				<br />
			<!-- END PAGE CONTENT -->
			
		</div><!-- END SITE CONTAINER -->
		<!-- PAGE FOOTER --><?php include "includes/footer.php"; ?><!-- END PAGE FOOTER -->
	</body>
</html>