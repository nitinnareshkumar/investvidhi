<?php
/***********************************************************************************************
PHP File to read the Quarterly data for all companies for the customized quarter , code needs to
be changed to get the data
currently it is set to update mar12 quarter
All sql queries have to be changed , search for //needs change
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
for ($iLoopCtr= 1; $iLoopCtr<($iCount+1);$iLoopCtr++)
{
	$result=mysql_query("select * from name_code where number=$iLoopCtr");
	//$result=mysql_query("select * from name_code where number=567");
	
	$row = mysql_fetch_array($result);
	$UrlName="http://www.moneycontrol.com/financials/". $row['nameinmc']."/results/quarterly-results/".$row['code'];
	
	$handle = file_get_contents($UrlName);
	$filtered_string1=$handle;
	
	$dataNotFound = strstr($filtered_string1,"Data Not Available for ");
	if ($dataNotFound!= NULL)
	{	
		$stringData="Data Not Available for Quarterly Results". $row[code];
		//echo "$stringData\r\n";
		fwrite($fh, "$stringData\r\n");

		$res=mysql_query("update data_companies_curr set MarFy12_EPS='--',MarFy12_Operating_Profit='--',MarFy12_Sales='--'where CompNumber='$row[number]'");//needs change
			continue;
	}	
	$year = strstr($filtered_string1,"Quarterly Results of");
	$year = strstr($year,"<!--INFOLINKS_ON-->");
	//$year = strstr($year,"<tr height='1px'><td colspan='11'><img src='http://img1.moneycontrol.com",true);
	//echo "naidu".$year."naidu";
	$year = strstr($year,"<td align=\"right\" class=\"detb\">");

	if ($year==NULL)
	{
		$stringData="********ERROR-No half yearly data for  ". $row[code]."************* None Inserted";
		//echo "$stringData\r\n";
		fwrite($fh, "$stringData\r\n");
		$res=mysql_query("update data_companies_curr set MarFy12_EPS='--',MarFy12_Operating_Profit='--',MarFy12_Sales='--'where CompNumber='$row[number]'");//needs change
		continue;
	}
	else
	{
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
//echo "naidu".$year."naidu";
			$QuarterPresent= 0; // Flag =1 if dec data present
			
			$QuarterEPS='--';
			$QuarterOp='--';
			$QuarterSales='--';
			
		for ($iLoop1= 1; $iLoop1< 2 ;$iLoop1++)
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
			//echo "$tempYr ".$tempYr."<br>" ;
			$arrayiSales[$iLoop1-1] = $temp;
			$arrayiYear[$iLoop1-1]= $tempYr;					//	For year string
			$arrayiYOperatingProfit[$iLoop1-1] = $tempOperatingProfit;
			$arrayiEps[$iLoop1-1]= $tempEps;
			//remove comma
		/*------------------------------------------------------------------*/
		$patterns =",";
		$replacements1 = '';
		$arrayiSales[$iLoop1-1] = str_replace($patterns,$replacements1,$arrayiSales[$iLoop1-1]);
		$arrayiYOperatingProfit[$iLoop1-1] = str_replace($patterns,$replacements1,$arrayiYOperatingProfit[$iLoop1-1]);
		$arrayiEps[$iLoop1-1] = str_replace($patterns,$replacements1,$arrayiEps[$iLoop1-1]);
		/*------------------------------------------------------------------*/
			$temp1= $iLoop1-1;
			$sales = strstr($sales,"</td>");
			$sales = strstr($sales,"<td");
			$OperatingProfit = strstr($OperatingProfit,"</td>");
			$OperatingProfit = strstr($OperatingProfit,"<td");
			$eps = strstr($eps,"</td>");
			$eps = strstr($eps,"<td");
			$year = strstr($year,"</td>");					//	For year string
			$year = strstr($year,"<td");					//	For year string
			//$patterns =" '";
			//$replacements1 = '';
			//$arrayiYear[$iLoop1-1] =  str_replace($patterns,$replacements1,$arrayiYear[$iLoop1-1]);
			//$arrayiYear[$iLoop1-1] =  substr($arrayiYear[$iLoop1-1],3,2);
			$currentLoop=$iLoop1-1;
			
		//echo "q is ".$arrayiYear[0]."<br>" ;
		//echo "sales is".$arrayiSales[$currentLoop]."<br>";	
		//echo "sales is".$arrayiYOperatingProfit[$currentLoop]."<br>";
		//echo "sales is".$arrayiEps[$currentLoop]."<br>";
			if($tempYr=="Mar '12") //needs change
			{
			echo "in if";
				$QuarterSales=$arrayiSales[$currentLoop];
				$QuarterOp=$arrayiYOperatingProfit[$currentLoop];
				$QuarterEPS=$arrayiEps[$currentLoop];			
				$QuarterPresent= 1; // Iinsert shd be set to one of inserted
			}
		
		}//inner for loop close
		
		if($QuarterPresent== 1 ) 
		{
			$res=mysql_query("update data_companies_curr set MarFy12_EPS='$QuarterEPS',MarFy12_Operating_Profit='$QuarterOp',MarFy12_Sales='$QuarterSales' where CompNumber='$row[number]'")  or die(mysql_error()) ;	//needs change
		}
		
		else
		{
			$res=mysql_query("update data_companies_curr set MarFy12_EPS='--',MarFy12_Operating_Profit='--',MarFy12_Sales='--'where CompNumber='$row[number]'"); //needs change
			$stringData="No Quarterly data in 2011 for ". $row[code];
			echo "$stringData\r\n";
			fwrite($fh, "$stringData\r\n");
		}
			
		
	}//else  close

} //For loop closing brace
		fclose($fh);//close error log file
		
		echo "PROCESSING COMPLETED!!!!!!!";
?>