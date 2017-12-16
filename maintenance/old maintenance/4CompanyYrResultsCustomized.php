
<?php
/***********************************************************************************************
PHP file to insert sales , profit and eps of company for which needsTobeUpdated is set to Y, this 
file can be used on need basis to update any company with missing data.
This file will update results till 2011
***********************************************************************************************/
include("config.inc.php");
set_time_limit(20000);
//$res=mysql_query("select max(number) as maxi from name_code");
$result=mysql_query("select max(number) as maxnum from name_code");
$row = mysql_fetch_array($result);
//$iCount= $row[maxnum]; //commented ************************************************************
$iCount=7184;//hard coded for fetching 100 records.
// Open error log file
$myFile = "error_logs.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
//loop to parse records
$getcompanies = mysql_query("select * from name_code where needsToBeUpdated = 'Y'");
while($row=mysql_fetch_array($getcompanies))
{
	//$result=mysql_query("select * from name_code where number=$iLoop");
	//$result=mysql_query("select * from name_code where number=1");
	
	//$row = mysql_fetch_array($result);
	$UrlName="http://www.moneycontrol.com/financials/".$row['nameinmc']."/results/yearly/".$row['code'];
	
	$handle = file_get_contents($UrlName);
	$filtered_string1=$handle;
	$dataNotFound = strstr($filtered_string1,"Data Not Available for Yearly Results");
	

	$year = strstr($filtered_string1,"detb\">M");					// when page has march or May data detb">M
	if ($year==NULL)
		$year = strstr($filtered_string1,"detb\">D");				// when page has dec data
	if ($year==NULL)
		$year = strstr($filtered_string1,"detb\">S");				// when page has sept data
	if ($year==NULL)
		$year = strstr($filtered_string1,"detb\">J");				// when page has Jan data
	if ($year==NULL)
		$year = strstr($filtered_string1,"detb\">F");				// when page has Feb data
	if ($year==NULL)
		$year = strstr($filtered_string1,"detb\">A");				// when page has April or August data
	if ($year==NULL)
		$year = strstr($filtered_string1,"detb\">J");				// when page has June or July data
	if ($year==NULL)
		$year = strstr($filtered_string1,"detb\">O");				// when page has Oct data
	if ($year==NULL)
		$year = strstr($filtered_string1,"detb\">N");				// when page has Nov data
		
	
	$sales = strstr($filtered_string1,">Sales Turnover<");
	
	$OperatingProfit = strstr($filtered_string1,">Operating Profit<");
	$OperatingProfit = strstr($OperatingProfit,"<td");
	//$OperatingProfit = strstr($OperatingProfit,"</tr>", true);
	
	$OperatingProfit = substr($OperatingProfit, 0, strpos($OperatingProfit, "</tr>")); 
	$eps = strstr($filtered_string1,">Earnings Per Share<");
	$eps = strstr($eps,"<td");
	//$eps = strstr($eps,"</tr>", true);
	$eps = substr($eps, 0, strpos($eps, "</tr>")); 

	$sales = strstr($sales,"<td");
	//$sales = strstr($sales,"</tr>", true);
	$sales = substr($sales, 0, strpos($sales, "</tr>")); 

	//$year = strstr($year,"<td");							//	For year string
	//$year = strstr($year,"</tr>", true);					//	For year string
    $year = substr($year, 0, strpos($year, "</tr>")); 

	for ($iLoop1= 1; $iLoop1< 6 ;$iLoop1++)
	{
		$iPos1 = strpos($sales,"detb\">");  
		$iPos2 = strpos($sales,"</td");
		$iPos3 = strpos($year,"detb\">");					//	For year string
		$iPos4 = strpos($year,"</td");						//	For year string
		$iPos5 = strpos($OperatingProfit,"detb\">");            //for operating profit
		$iPos6 = strpos($OperatingProfit,"</td");             //for operating profit
		$iPos7 = strpos($eps,"detb\">");            //for eps
		$iPos8 = strpos($eps,"</td");             //for eps
		
		//echo  $iSales;
		$arrayiSales[5];
		$arrayiYear[5];	
		$arrayiYrDB[5];
		$arrayiYOperatingProfit[5];
		$arrayiEps[5];
		//$arrayiSales[iloop1]= substr($sales,($iPos1+5), ($iPos2-$iPos1));
		$temp = substr($sales,($iPos1+6), ($iPos2-$iPos1 -6));           // for sales

		$tempOperatingProfit = substr($OperatingProfit,($iPos5+6), ($iPos6-$iPos5 -6)); //for operating profit

		$tempEps = substr($eps,($iPos7+6), ($iPos8-$iPos7 -6)); //for eps

		$tempYr = substr($year,($iPos3+6), ($iPos4-$iPos3 -6));//	For year string
		$arrayiSales[$iLoop1-1] = $temp;
		$arrayiYear[$iLoop1-1]= $tempYr;					//	For year string
		$arrayiYOperatingProfit[$iLoop1-1] = $tempOperatingProfit;
		$arrayiEps[$iLoop1-1]= $tempEps;
		$temp1= $iLoop1-1;
		
		//remove comma
		/*------------------------------------------------------------------*/
		$patterns =",";
		$replacements1 = '';
		$arrayiSales[$iLoop1-1] = str_replace($patterns,$replacements1,$arrayiSales[$iLoop1-1]);
		$arrayiYOperatingProfit[$iLoop1-1] = str_replace($patterns,$replacements1,$arrayiYOperatingProfit[$iLoop1-1]);
		$arrayiEps[$iLoop1-1] = str_replace($patterns,$replacements1,$arrayiEps[$iLoop1-1]);
		/*------------------------------------------------------------------*/
		
		echo  $arrayiSales[$iLoop1-1]."<br>";
		echo  $arrayiYOperatingProfit[$iLoop1-1]."<br>";
		echo  $arrayiEps[$iLoop1-1]."<br>";
		$sales = strstr($sales,"</td>");
		$sales = strstr($sales,"<td");
		$OperatingProfit = strstr($OperatingProfit,"</td>");
		$OperatingProfit = strstr($OperatingProfit,"<td");
		
		$eps = strstr($eps,"</td>");
		$eps = strstr($eps,"<td");
		//echo  $arrayiYear[$iLoop1-1].$temp1."<br>";		//	For year string
		$year = strstr($year,"</td>");					//	For year string
		//echo $year;
		$year = strstr($year,"<td");					//	For year string
		//echo $year;
		$patterns =" '";
		$replacements1 = '';
	
		$arrayiYear[$iLoop1-1] =  str_replace($patterns,$replacements1,$arrayiYear[$iLoop1-1]);
		$arrayiYear[$iLoop1-1] =  substr($arrayiYear[$iLoop1-1],3,2);
		echo $arrayiYear[$iLoop1-1]."<br>";
		
	} //end for loop 1 to 6
    if ($arrayiYear[0]== '12')
		{
			echo "in 12";
		$res=mysql_query("update sales set  Mar11='$arrayiSales[1]',Mar10='$arrayiSales[2]',Mar09='$arrayiSales[3]',Mar08='$arrayiSales[4]',Mar07='--',Mar06='--' where companynumber='$row[number]'") ;//uncomment
		
		
		$resop=mysql_query("update operating_profit set Mar11='$arrayiYOperatingProfit[1]',Mar10='$arrayiYOperatingProfit[2]',Mar09='$arrayiYOperatingProfit[3]',Mar08='$arrayiYOperatingProfit[4]',Mar07='--',Mar06='--' where companynumber='$row[number]'");//uncomment
		

		$reseps=mysql_query("update eps set  Mar11='$arrayiEps[1]',Mar10='$arrayiEps[2]',Mar09='$arrayiEps[3]',Mar08='$arrayiEps[4]',Mar07='--',Mar06='--' where companynumber='$row[number]'");//uncomment
		
		}
	else if ($arrayiYear[0]== '11')
		{
			
				$res=mysql_query("update sales set Mar11='$arrayiSales[0]',Mar10='$arrayiSales[1]',Mar09='$arrayiSales[2]',Mar08='$arrayiSales[3]',Mar07='$arrayiSales[4]',Mar06='--' where companynumber='$row[number]'");//uncomment
		
		
		$resop=mysql_query("update operating_profit set Mar11='$arrayiYOperatingProfit[0]',Mar10='$arrayiYOperatingProfit[1]',Mar09='$arrayiYOperatingProfit[2]',Mar08='$arrayiYOperatingProfit[3]',Mar07='$arrayiYOperatingProfit[4]',Mar06='--' where companynumber='$row[number]'");//uncomment
		

		$reseps=mysql_query("update eps set Mar11='$arrayiYOperatingProfit[0]',Mar10='$arrayiEps[1]',Mar09='$arrayiEps[2]',Mar08='$arrayiEps[3]',Mar07='$arrayiEps[4]',Mar06='--' where companynumber='$row[number]'");//uncomment
		}
		else if($arrayiYear[0]== '10')
		{
				
		}
			else if($arrayiYear[0]== '09')
		{
		
	
		}
			else if($arrayiYear[0]== '08')
		{

		}
			else if($arrayiYear[0]== '07')
		{

		}
		else
		{
			$logData="Error inserting data ". $row[number]."--".$row[code];
			fwrite($fh, "$logData\r\n");
			//echo $arrayiYear[$iLoop1-1];
	
		}
		
$myFile = "error_logs.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
		if(!$res)
		{
			//echo "Error inserting sales ". $row[code];
			$stringData="Error inserting sales ". $row[code];
			fwrite($fh, "$stringData\r\n");
		}
		if(!$resop)
		{
			//echo "Error inserting operating profit". $row[code];
			$stringData="Error inserting Operating Profit ". $row[code];
			fwrite($fh, "$stringData\r\n");
		}
		if(!$reseps)
		{
			//echo "Error inserting eps". $row[code];
			$stringData="Error inserting EPS ". $row[code];
			fwrite($fh, "$stringData\r\n");
		}
		
		//echo  $arrayiSales[iloop1];
} //For loop closing brace
		fclose($fh);//close error log file
		
		echo "PROCESSING COMPLETED!!!!!!!";
?>