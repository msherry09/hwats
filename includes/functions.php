<?php
//Functions Page
//All functions shared between pages are saved here.

	//Function use for data cleansing either before inserting into the database
	function cleanData($string)
	{
		//trim the whitespace at the begining and end of the string
		$string = trim($string);
		//convert all applicable characters to HTML enitites
		$string = htmlentities($string, ENT_QUOTES, 'UTF-8');
		//real escape the string to prevent any sql injection
		return mysql_real_escape_string($string);		
	}	
	function calculatePercent($numerator, $denominator)
	{
		$percent = 0;
		if($denominator != 0)			
			$percent = round(($numerator/$denominator)*100);
		return $percent;	
	}
?>