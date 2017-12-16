<?php
/***********************************************************************************************
PHP File to read the Quarterly data for all companies for the financial year 12-13 till december quarter
***********************************************************************************************/
include("config.inc.php");
set_time_limit(20000);
//$res=mysql_query("select max(number) as maxi from name_code");
$result=mysql_query("select max(number) as maxnum from name_code");
$row = mysql_fetch_array($result);
//$iCount= $row[maxnum]; //commented ************************************************************
$iCount=7218;//hard coded for fetching 100 records.
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
		echo "$stringData\r\n";
		fwrite($fh, "$stringData\r\n");

		$res=mysql_query("insert into data_companies_curr set CompNumber='$row[number]',Comp_Code= '$row[code]', Jun_EPS='--',Jun_Operating_Profit='--',Jun_Sales='--',Sep_EPS='--',Sep_Operating_Profit='--',Sep_Sales='--', Dec_EPS='--',Dec_Operating_Profit='--',Dec_Sales='--'");
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
		echo "$stringData\r\n";
		fwrite($fh, "$stringData\r\n");
		$res=mysql_query("insert into data_companies_curr set CompNumber='$row[number]',Comp_Code= '$row[code]' ,Jun_EPS='--',Jun_Operating_Profit='--',Jun_Sales='--',Sep_EPS='--',Sep_Operating_Profit='--',Sep_Sales='--', Dec_EPS='--',Dec_Operating_Profit='--',Dec_Sales='--'");
		continue;
	}
	else
	{
	$sales = strstr($filtered_string1,">Net Sales/Income from operations<");
	$OperatingProfit = strstr($filtered_string1,">P/L Before Other Inc. , Int., Excpt. Items & Tax<");
		$OperatingProfit = strstr($OperatingProfit,"<td");
		//$OperatingProfit = strstr($OperatingProfit,"</tr>", true);
		$OperatingProfit = substr($OperatingProfit, 0, strpos($OperatingProfit, "</tr>")); 
echo "op is ".$OperatingProfit."<br>";	
	$eps = strstr($filtered_string1,">Diluted EPS<");
		$eps = strstr($eps,"<td");
		//$eps = strstr($eps,"</tr>", true);
		$eps = substr($eps, 0, strpos($eps, "</tr>")); 
echo "eps is ".$eps."<br>";	
		$sales = strstr($sales,"<td");
		//$sales = strstr($sales,"</tr>", true);
		$sales = substr($sales, 0, strpos($sales, "</tr>")); 
	echo "sales is ".$sales."<br>";
	
		//$year = strstr($year,"<td");							//	For year string
		//$year = strstr($year,"</tr>", true);					//	For year string
		$year = substr($year, 0, strpos($year, "</tr>")); 
//echo "naidu".$year."naidu";
			$decPresent= 0; // Flag =1 if dec data present
			$junPresent= 0; // Flag =1 if june data present
			$sepPresent=0;	// Flag =1 if Sept data present
			$junEPS='--';
			$junOp='--';
			$junSales='--';
			$sepEPS='--';
			$sepOp='--';
			$sepSales='--';
			$decEPS='--';
			$decOp='--';
			$decSales='--';
		for ($iLoop1= 1; $iLoop1< 6 ;$iLoop1++)
		{

		$iPos1 = strpos($sales,"det\">");  
			$iPos2 = strpos($sales,"</td");
			$iPos3 = strpos($year,"detb\">");					//	For year string
			$iPos4 = strpos($year,"</td");						//	For year string
		$iPos5 = strpos($OperatingProfit,"det\">");            //for operating profit
			$iPos6 = strpos($OperatingProfit,"</td");             //for operating profit
		$iPos7 = strpos($eps,"det\">");            //for eps
			$iPos8 = strpos($eps,"</td");             //for eps
				
			//echo  $iSales;
			$arrayiSales[5];
			$arrayiYear[5];	
			$arrayiYrDB[5];
			$arrayiYOperatingProfit[5];
			$arrayiEps[5];
			//$arrayiSales[iloop1]= substr($sales,($iPos1+5), ($iPos2-$iPos1));
		$temp = substr($sales,($iPos1+5), ($iPos2-$iPos1 -5));           // for sales
		$tempOperatingProfit = substr($OperatingProfit,($iPos5+5), ($iPos6-$iPos5 -5)); //for operating profit
		$tempEps = substr($eps,($iPos7+5), ($iPos8-$iPos7 -5)); //for eps
			$tempYr = substr($year,($iPos3+6), ($iPos4-$iPos3 -6));//	For year string
			echo "$tempYr ".$tempYr."<br>" ;
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
		echo  "sales each".$arrayiSales[$iLoop1-1]."<br>";
		echo  "op each".$arrayiYOperatingProfit[$iLoop1-1]."<br>";
		echo  "eps eaach".$arrayiEps[$iLoop1-1]."<br>";
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
			if($tempYr=="Dec '12")
			{
				$decSales=$arrayiSales[$currentLoop];
				$decOp=$arrayiYOperatingProfit[$currentLoop];
				$decEPS=$arrayiEps[$currentLoop];			
				$decPresent= 1; // Iinsert shd be set to one of inserted
			}
			if($tempYr=="Jun '12")
			{
				$junEPS=$arrayiEps[$currentLoop];
				$junOp=$arrayiYOperatingProfit[$currentLoop];
				$junSales=$arrayiSales[$currentLoop];
				$junePresent= 1; // Iinsert shd be set to one of inserted
			}
			else if($tempYr=="Sep '12")
			{
				$sepEPS=$arrayiEps[$currentLoop];
				$sepOp=$arrayiYOperatingProfit[$currentLoop];
				$sepSales=$arrayiSales[$currentLoop];
				$sepPresent= 1; // Iinsert shd be set to one of inserted
			}
		}//inner for loop close
		
		if(($decPresent== 1 ) ||($junePresent== 1 )||($septPresent== 1 )) 
		{
			$res=mysql_query("insert into data_companies_curr set CompNumber='$row[number]',Comp_Code= '$row[code]',Jun_EPS='$junEPS',Jun_Operating_Profit='$junOp',Jun_Sales='$junSales',Sep_EPS='$sepEPS',Sep_Operating_Profit='$sepOp',Sep_Sales='$sepSales', Dec_EPS='$decEPS',Dec_Operating_Profit='$decOp',Dec_Sales='$decSales'");	
		}
		
		else
		{
			$res=mysql_query("insert into data_companies_curr set CompNumber='$row[number]',Comp_Code= '$row[code]', Jun_EPS='--',Jun_Operating_Profit='--',Jun_Sales='--',Sep_EPS='--',Sep_Operating_Profit='--',Sep_Sales='--', Dec_EPS='--',Dec_Operating_Profit='--',Dec_Sales='--'");
			$stringData="No Quarterly data in 2011 for ". $row[code];
			echo "$stringData\r\n";
			fwrite($fh, "$stringData\r\n");
		}
			
		
	}//else  close

} //For loop closing brace
		fclose($fh);//close error log file
		
		echo "PROCESSING COMPLETED!!!!!!!";
?>