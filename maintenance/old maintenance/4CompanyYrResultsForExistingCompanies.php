
<?php
/***********************************************************************************************
PHP file to update sales , profit and eps of company whihc are are already present in name_code
this will just update the columns which are added for new fy in tables sales , eps , operating_profit tables 

***********************************************************************************************/
include("config.inc.php");

set_time_limit(20000);
//$res=mysql_query("select max(number) as maxi from name_code");
//$result=mysql_query("select max(number) as maxnum from name_code");
//$row = mysql_fetch_array($result);
//$iCount= $row[maxnum]; //commented ************************************************************
$iCount=7217;//hard coded for fetching 100 records.
// Open error log file
$myFile = "error_logs.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
//loop to parse records
for ($iLoop= 5679; $iLoop <($iCount+1);$iLoop++)
{
	$result=mysql_query("select * from name_code where number = $iLoop ", $link);
	echo "error is".mysql_errno($link) . ": " . mysql_error($link) . "\n";
	echo "query"."select * from name_code where number = $iLoop ";
	echo "loop is".$iLoop;
	$row = mysql_fetch_array($result);
	echo "name is".$row['nameinmc'];
	$UrlName="http://www.moneycontrol.com/financials/".$row['nameinmc']."/results/yearly/".$row['code'];
	echo $UrlName."<br>"; 
	$handle = file_get_contents($UrlName);
	$filtered_string1=$handle;
	$dataNotFound = strstr($filtered_string1,"Data Not Available for Yearly Results");
	if ($dataNotFound!= NULL)
		{
			
		//echo $arrayiYear[$iLoop1-1];
		$res=mysql_query("update sales set Mar15='NA',Mar14='NA',Mar13='NA' where companynumber=$row[number]");//uncomment
		
		
		$resop=mysql_query("update operating_profit set Mar15='NA',Mar14='NA',Mar13='NA' where companynumber=$row[number]");//uncomment
		
	
		$reseps=mysql_query("update eps set Mar15='NA',Mar14='NA',Mar13='NA' where companynumber=$row[number]");//uncomment
			continue;
		}

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
		
		echo  "sales each".$arrayiSales[$iLoop1-1]."<br>";
		echo  "op each".$arrayiYOperatingProfit[$iLoop1-1]."<br>";
		echo  "eps eaach".$arrayiEps[$iLoop1-1]."<br>";
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
    if ($arrayiYear[0]== '15')
		{
			echo "in 12";
		$res=mysql_query("update sales set Mar15='$arrayiSales[0]',Mar14='$arrayiSales[1]',Mar13='$arrayiSales[2]' where companynumber='$row[number]' ") or die ("Error in query: $query. " . mysql_error());//uncomment
		
		
		$resop=mysql_query("update operating_profit set Mar15='$arrayiYOperatingProfit[0]',Mar14='$arrayiYOperatingProfit[1]',Mar13='$arrayiYOperatingProfit[2]' where companynumber='$row[number]' ") or die ("Error in query: $query. " . mysql_error());//uncomment
		

		$reseps=mysql_query("update eps set Mar15='$arrayiEps[0]',Mar14='$arrayiEps[1]',Mar13='$arrayiEps[2]' where companynumber='$row[number]'") or die ("Error in query: $query. " . mysql_error());//uncomment
		
		}
	else if ($arrayiYear[0]== '14')
		{
			
				$res=mysql_query("update sales set  Mar14='$arrayiSales[0]',Mar13='$arrayiSales[1]' where companynumber='$row[number]'");//uncomment
		
		
		$resop=mysql_query("update operating_profit set Mar14='$arrayiYOperatingProfit[0]',Mar13='$arrayiYOperatingProfit[1]' where companynumber='$row[number]' ");//uncomment
		

		$reseps=mysql_query("update eps set Mar14='$arrayiEps[0]',Mar13='$arrayiEps[1]' where companynumber='$row[number]' ");//uncomment
		}
		else if($arrayiYear[0]== '13')
		{
				$res=mysql_query("update sales set Mar15='--',Mar13='$arrayiSales[0]' where companynumber='$row[number]' ");//uncomment
		
		
		$resop=mysql_query("update operating_profit set Mar15='--',Mar13='$arrayiYOperatingProfit[0]'where companynumber='$row[number]' ");//uncomment
		

		$reseps=mysql_query("update eps set Mar15='--',Mar13='$arrayiEps[0]' where companynumber='$row[number]'");//uncomment	
		}
			else if($arrayiYear[0]== '12')
		{
		
	
		}
			else if($arrayiYear[0]== '11')
		{

		}
			else if($arrayiYear[0]== '10')
		{

		}
		else
		{
			$logData="Error inserting data ". $row[number]."--".$row[code];
			fwrite($fh, "$logData\r\n");
			//echo $arrayiYear[$iLoop1-1];
		$res=mysql_query("update sales set Mar15='NA',Mar14='NA',Mar13='NA' where companynumber='$row[number]' ");//uncomment
		
		
		$resop=mysql_query("update operating_profit set Mar15='NA',Mar14='NA',Mar13='NA' where companynumber='$row[number]' ");//uncomment
		
	
		$reseps=mysql_query("update eps set Mar15='NA',Mar14='NA',Mar13='NA' where companynumber='$row[number]' ");//uncomment
		}
		
$myFile = "error_logs.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
		if(!$res)
		{
			//echo "Error inserting sales ". $row[code];
			$stringData="Error inserting sales ". $row[code];
			fwrite($fh, "$stringData\r\n");
		}
		/*if(!$resop)
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
		}*/
		
		//echo  $arrayiSales[iloop1];
} //For loop closing brace
		fclose($fh);//close error log file
		
		echo "PROCESSING COMPLETED!!!!!!!";
?>