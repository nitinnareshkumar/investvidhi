
<?php
/***********************************************************************************************
PHP file to insert sales , profit and eps of company whihc have been newly added in name_code
This file update data for fy11 and less.It will work till 2013 march.
Because in after 2013 , data will start like mar13, mar12 and if condition mentioned in the code
if ($arrayiYear[0]== '12') , wont work.This files needs to be manipulated to add data after 2013 
march
Updated to insert data after March 12
***********************************************************************************************/
include("config.inc.php");
set_time_limit(20000);
//$res=mysqli_query($link,"select max(number) as maxi from name_code");
$result=mysqli_query($link,"select max(number) as maxnum from name_code");
$row = mysqli_fetch_array($result);
//$iCount= $row[maxnum]; //commented ************************************************************
$iCount=1000;//hard coded for fetching 100 records.
// Open error log file
$myFile = "error_logs.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
//loop to parse records
for ($iLoop= 19023; $iLoop<($iLoop + 1);$iLoop++) //19023
{
	$result=mysqli_query($link,"select * from name_code where number=$iLoop");
	//$result=mysqli_query($link,"select * from name_code where number=1");
	
	$row = mysqli_fetch_array($result);
	$UrlName="http://www.moneycontrol.com/financials/". $row['nameinmc']."/results/yearly/".$row['code'];
	$handle = file_get_contents($UrlName);
	$filtered_string1=$handle;
	$dataNotFound = strstr($filtered_string1,"Data Not Available for Yearly Results");
	if ($dataNotFound!= NULL)
		{
			
		//echo $arrayiYear[$iLoop1-1];
		//$res=mysqli_query($link,"insert into sales set companynumber='$row[number]',companycode= '$row[code]',Mar11='NA',Mar10='NA',Mar09='NA',Mar08='NA',Mar07='NA',Mar06='NA'");//uncomment naidu
		
		
		//$resop=mysqli_query($link,"insert into operating_profit set companynumber='$row[number]',companycode= '$row[code]',Mar11='NA',Mar10='NA',Mar09='NA',Mar08='NA',Mar07='NA',Mar06='NA'");//uncomment naidu
		
	
		//$reseps=mysqli_query($link,"insert into eps set companynumber='$row[number]',companycode= '$row[code]',Mar11='NA',Mar10='NA',Mar09='NA',Mar08='NA',Mar07='NA',Mar06='NA'");//uncomment naidu
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
	
	$sales = strstr($filtered_string1,">Total Income From Operations<");	
	$OperatingProfit = strstr($filtered_string1,">Net Profit/(Loss) For the Period<");
	$OperatingProfit = strstr($OperatingProfit,"<td");
	//$OperatingProfit = strstr($OperatingProfit,"</tr>", true);
	$OperatingProfit = substr($OperatingProfit, 0, strpos($OperatingProfit, "</tr>")); 
	$eps = strstr($filtered_string1,">Basic EPS<");
	$eps = strstr($eps,"<td");
	//$eps = strstr($eps,"</tr>", true);
	$eps = substr($eps, 0, strpos($eps, "</tr>")); 

	$sales = strstr($sales,"<td");
	//$sales = strstr($sales,"</tr>", true);
	$sales = substr($sales, 0, strpos($sales, "</tr>")); 

	//$year = strstr($year,"<td");							//	For year string
	//$year = strstr($year,"</tr>", true);					//	For year string
    $year = substr($year, 0, strpos($year, "</tr>")); 
echo "sales".$sales;
echo "OperatingProfit".$OperatingProfit;
echo "eps".$eps;
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
		//Naidu commented - i guess it is not needed
		//echo  $iSales;
		//$arrayiSales[5];
		//$arrayiYear[5];	
		//$arrayiYrDB[5];
		//$arrayiYOperatingProfit[5];
		//$arrayiEps[5];
		//Naidu commented - i guess it is not needed - end 
		//$arrayiSales[iloop1]= substr($sales,($iPos1+5), ($iPos2-$iPos1));
		$temp = substr($sales,($iPos1+30), ($iPos2-$iPos1 -6));           // for sales
		$tempOperatingProfit = substr($OperatingProfit,($iPos5+30), ($iPos6-$iPos5 -6)); //for operating profit

		$tempEps = substr($eps,($iPos7+30), ($iPos8-$iPos7 -6)); //for eps
		$tempYr = substr($year,($iPos3+6), ($iPos4-$iPos3 -6));//	For year string
		$arrayiSales[$iLoop1-1] = $temp;
		$arrayiYear[$iLoop1-1]= $tempYr;					//	For year string
		$arrayiYOperatingProfit[$iLoop1-1] = $tempOperatingProfit;
		$arrayiEps[$iLoop1-1]= $tempEps;
		$temp1= $iLoop1-1;
		
		//remove comma
		/*------------------------------------------------------------------*/
		$patterns =",";
		$pattern2 ="</td>";
		$replacements1 = '';
		$arrayiSales[$iLoop1-1] = str_replace($patterns,$replacements1,$arrayiSales[$iLoop1-1]);
		$arrayiSales[$iLoop1-1] = substr($arrayiSales[$iLoop1-1],0,strpos($arrayiSales[$iLoop1-1],$pattern2));		
		$arrayiYOperatingProfit[$iLoop1-1] = str_replace($patterns,$replacements1,$arrayiYOperatingProfit[$iLoop1-1]);
		$arrayiYOperatingProfit[$iLoop1-1] = substr($arrayiYOperatingProfit[$iLoop1-1],0,strpos($arrayiYOperatingProfit[$iLoop1-1],$pattern2));
		$arrayiEps[$iLoop1-1] = str_replace($patterns,$replacements1,$arrayiEps[$iLoop1-1]);
		$arrayiEps[$iLoop1-1] = substr($arrayiEps[$iLoop1-1],0,strpos($arrayiEps[$iLoop1-1],$pattern2));		
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
	//echo "$temp".$sales."tempOperatingProfit".$OperatingProfit."tempEps".$eps;
		$arrayiYear[$iLoop1-1] =  str_replace($patterns,$replacements1,$arrayiYear[$iLoop1-1]);
		$arrayiYear[$iLoop1-1] =  substr($arrayiYear[$iLoop1-1],3,2);
		echo $arrayiYear[$iLoop1-1]."<br>";
	} //end for loop 1 to 6
    if ($arrayiYear[0]== '17')
		{
			echo "in 17";
			$res=mysqli_query($link,"update sales set companynumber='$row[number]',companycode= '$row[code]',Mar17='$arrayiSales[0]',Mar16='$arrayiSales[1]',Mar15='$arrayiSales[2]',Mar14='$arrayiSales[3]',Mar13='$arrayiSales[4]' where companycode='$row[code]'") or die ("Error in query:" . mysqli_error($link));//uncomment
			
			
			$resop=mysqli_query($link,"update operating_profit set companynumber='$row[number]',companycode= '$row[code]',Mar17='$arrayiYOperatingProfit[0]',Mar16='$arrayiYOperatingProfit[1]',Mar15='$arrayiYOperatingProfit[2]',Mar14='$arrayiYOperatingProfit[3]',Mar13='$arrayiYOperatingProfit[4]' where companycode='$row[code]'");//uncomment
			

			$reseps=mysqli_query($link,"update eps set companynumber='$row[number]',companycode= '$row[code]',Mar17='$arrayiEps[0]',Mar16='$arrayiEps[1]',Mar15='$arrayiEps[2]',Mar14='$arrayiEps[3]',Mar13='$arrayiEps[4]' where companycode='$row[code]'");//uncomment		
		}
		else if ($arrayiYear[0]== '16')
		{
			
			$res=mysqli_query($link,"insert into sales set companynumber='$row[number]',companycode= '$row[code]',Mar16='$arrayiSales[0]',Mar15='$arrayiSales[1]',Mar14='$arrayiSales[2]',Mar13='$arrayiSales[3]',Mar12='$arrayiSales[4]'");//uncomment
		
		
			$resop=mysqli_query($link,"insert into operating_profit set companynumber='$row[number]',companycode= '$row[code]',Mar16='$arrayiYOperatingProfit[0]',Mar15='$arrayiYOperatingProfit[1]',Mar14='$arrayiYOperatingProfit[2]',Mar13='$arrayiYOperatingProfit[3]',Mar12='$arrayiYOperatingProfit[4]'");//uncomment
		

		$reseps=mysqli_query($link,"insert into eps set companynumber='$row[number]',companycode= '$row[code]',Mar16='$arrayiYOperatingProfit[0]',Mar15='$arrayiEps[1]',Mar14='$arrayiEps[2]',Mar13='$arrayiEps[3]',Mar12='$arrayiEps[4]'");//uncomment
		}
		else if($arrayiYear[0]== '15')
		{
			/*$res=mysqli_query($link,"insert into sales set companynumber='$row[number]',companycode= '$row[code]',Mar11='--',Mar10='$arrayiSales[0]',Mar09='$arrayiSales[1]',Mar08='$arrayiSales[2]',Mar07='$arrayiSales[3]',Mar06='$arrayiSales[4]'");//uncomment
						
			$resop=mysqli_query($link,"insert into operating_profit set companynumber='$row[number]',companycode= '$row[code]',Mar11='--',Mar10='$arrayiYOperatingProfit[0]',Mar09='$arrayiYOperatingProfit[1]',Mar08='$arrayiYOperatingProfit[2]',Mar07='$arrayiYOperatingProfit[3]',Mar06='$arrayiYOperatingProfit[4]'");//uncomment
			

			$reseps=mysqli_query($link,"insert into eps set companynumber='$row[number]',companycode= '$row[code]',Mar11='--',Mar10='$arrayiEps[0]',Mar09='$arrayiEps[1]',Mar08='$arrayiEps[2]',Mar07='$arrayiEps[3]',Mar06='$arrayiEps[4]'");//uncomment	*/
		}
		else if($arrayiYear[0]== '14')
		{
		
	
		}
		else if($arrayiYear[0]== '13')
		{

		}
		else if($arrayiYear[0]== '12')
		{

		}
		else
		{
			$logData="Error inserting data ". $row[number]."--".$row[code];
			fwrite($fh, "$logData\r\n");
			//echo $arrayiYear[$iLoop1-1];
		$res=mysqli_query($link,"insert into sales set companynumber='$row[number]',companycode= '$row[code]',Mar17='NA',Mar16='NA',Mar15='NA',Mar14='NA',Mar13='NA'");//uncomment
		
		
		$resop=mysqli_query($link,"insert into operating_profit set companynumber='$row[number]',companycode= '$row[code]',Mar17='NA',Mar16='NA',Mar15='NA',Mar14='NA',Mar13='NA'");//uncomment
		
	
		$reseps=mysqli_query($link,"insert into eps set companynumber='$row[number]',companycode= '$row[code]',Mar17='NA',Mar16='NA',Mar15='NA',Mar14='NA',Mar13='NA'");//uncomment
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