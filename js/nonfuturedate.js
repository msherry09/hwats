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


