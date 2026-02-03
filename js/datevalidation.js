//////////////Begin Date Validation/////////////////////
			function validatedate(target)
			{				
				var mydate = document.getElementById(target).value;
				var myarr = mydate.split("/");
				var errors = 0;
				var maxdays = 0;
				var leapyear = isleap(myarr[2]);
				
				
				if(myarr[0] > 0 && myarr[0] < 13)
				{
					errors = 0;
					if(myarr[0] == 1)	{maxdays = 31;}
					if(myarr[0] == 2)	{maxdays = 28;}
					if(myarr[0] == 3)	{maxdays = 31;}
					if(myarr[0] == 4)	{maxdays = 30;}
					if(myarr[0] == 5)	{maxdays = 31;}
					if(myarr[0] == 6)	{maxdays = 30;}
					if(myarr[0] == 7)	{maxdays = 31;}
					if(myarr[0] == 8)	{maxdays = 31;}
					if(myarr[0] == 9)	{maxdays = 30;}
					if(myarr[0] == 10)	{maxdays = 31;}
					if(myarr[0] == 11)	{maxdays = 30;}
					if(myarr[0] == 12)	{maxdays = 31;}
					
					if(myarr[0] == 2 && leapyear == 'true')
						{maxdays = 29;}
					
					if(myarr[1] > 0 && myarr[1] <= maxdays)
					{
						errors = 0;
						if(myarr[2] > 1900 && myarr[2] < 2100)
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
					document.getElementById("star"+target).innerHTML = "<font size='2' color='red'><i>*Invalid Date</i></font>";
					unanswered++;
					document.getElementById(target).value = "";
				}
				else
					document.getElementById("star"+target).innerHTML = "";
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