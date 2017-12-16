<?php
include("config.inc.php");
set_time_limit(20000);
//$res=mysql_query("select max(number) as maxi from name_code");
$result=mysql_query("select max(number) as maxnum from name_code");
$row = mysql_fetch_array($result);
//$iCount= $row[maxnum]; //commented ************************************************************
$iCount=7177;//hard coded for fetching 100 records.
// Open error log file
$myFile = "No_Debt_error.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
//loop to parse records
for ($iLoop= 4965; $iLoop<($iCount+1);$iLoop++)
{
	$result=mysql_query("select * from name_code where number=$iLoop");
	//$result=mysql_query("select * from name_code where number=1");
	
	$row = mysql_fetch_array($result);
	$UrlName="http://www.moneycontrol.com/financials/". $row['nameinmc']."/balance-sheet/".$row['code'];
	
	$handle = file_get_contents($UrlName);
	$filtered_string1=$handle;
	$dataNotFound = strstr($filtered_string1,"Data Not Available for Balance Sheet");
	if ($dataNotFound!= NULL)
		{
			
		//echo $arrayiYear[$iLoop1-1];
		$res=mysql_query("insert into no_debt set companynumber='$row[number]',companycode= '$row[code]',Mar10='NA',Mar05='NA',Mar06='NA',Mar07='NA',Mar08='NA',Mar09='NA'");
		
			continue;
		}

	$year = strstr($filtered_string1,"detb\">M");					// when page has march or May data
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
		
	
	$no_debt = strstr($filtered_string1,">Total Debt<");
	$no_debt = strstr($no_debt,"<td");
	//$no_debt = strstr($no_debt,"</tr>", true);
	$no_debt = substr($no_debt, 0, strpos($no_debt, "</tr>")); 

	//$year = strstr($year,"<td");							//	For year string
	//$year = strstr($year,"</tr>", true);					//	For year string
	$year = substr($year, 0, strpos($year, "</tr>")); 


	for ($iLoop1= 1; $iLoop1< 6 ;$iLoop1++)
	{
		$iPos1 = strpos($no_debt,"detb\">");
		$iPos2 = strpos($no_debt,"</td");
		$iPos3 = strpos($year,"detb\">");					//	For year string
		$iPos4 = strpos($year,"</td");						//	For year string
		
		
		//echo  $iSales;
		$arrayinoDebt[5];
		$arrayiYear[5];	
		$arrayiYrDB[5];
		//$arrayinoDebt[iloop1]= substr($no_debt,($iPos1+5), ($iPos2-$iPos1));
		$temp = substr($no_debt,($iPos1+6), ($iPos2-$iPos1 -6));           // for no_debt
		$tempYr = substr($year,($iPos3+6), ($iPos4-$iPos3 -6));//	For year string
		$arrayinoDebt[$iLoop1-1] = $temp;
		$arrayiYear[$iLoop1-1]= $tempYr;					//	For year string
		$temp1= $iLoop1-1;

		//echo  $arrayinoDebt[$iLoop1-1]."<br>".$temp1;
		$no_debt = strstr($no_debt,"</td>");
		$no_debt = strstr($no_debt,"<td");
		
		//echo  $arrayiYear[$iLoop1-1].$temp1."<br>";		//	For year string
		$year = strstr($year,"</td>");					//	For year string
		//echo $year;
		$year = strstr($year,"<td");					//	For year string
		//echo $year;
		$patterns =" '";
		$replacements1 = '';
		$arrayiYear[$iLoop1-1] =  str_replace($patterns,$replacements1,$arrayiYear[$iLoop1-1]);
		$arrayiYear[$iLoop1-1] =  substr($arrayiYear[$iLoop1-1],3,2);
		
	}
    if ($arrayiYear[0]== '11')
		{
			

		$res=mysql_query("insert into no_debt set companynumber='$row[number]',companycode= '$row[code]',Mar11='$arrayinoDebt[0]',Mar10='$arrayinoDebt[1]',Mar09='$arrayinoDebt[2]',Mar08='$arrayinoDebt[3]',Mar07='$arrayinoDebt[4]'");
					
		}
	else if ($arrayiYear[0]== '10')
		{
			
		//echo $arrayiYear[$iLoop1-1];
				$res=mysql_query("insert into no_debt set companynumber='$row[number]',companycode= '$row[code]',Mar11='--',Mar10='$arrayinoDebt[0]',Mar09='$arrayinoDebt[1]',Mar08='$arrayinoDebt[2]',Mar07='$arrayinoDebt[3]'");
		
		}
		else if($arrayiYear[0]== '09')
		{
		$res=mysql_query("insert into no_debt set companynumber='$row[number]',companycode= '$row[code]',Mar11='--',Mar10='--',Mar09='$arrayinoDebt[0]',Mar08='$arrayinoDebt[1]',Mar07='$arrayinoDebt[2]'");;	
		}
			else if($arrayiYear[0]== '08')
		{
		$res=mysql_query("insert into no_debt set companynumber='$row[number]',companycode= '$row[code]',Mar11='--',Mar10='--',Mar09='--',Mar08='$arrayinoDebt[0]',Mar07='$arrayinoDebt[1]'");;	
		}
			else if($arrayiYear[0]== '07')
		{
		$res=mysql_query("insert into no_debt set companynumber='$row[number]',companycode= '$row[code]',Mar11='--',Mar10='--',Mar09='--',Mar08='--',Mar07='$arrayinoDebt[0]'");;	
		
		}
	
		else
		{
			$logData="Error inserting data ". $row[number]."--".$row[code];
			fwrite($fh, "$logData\r\n");
		}
		
//$myFile = "No_Debt_error.txt";
//$fh = fopen($myFile, 'a') or die("can't open file");
		if(!$res)
		{
			//echo "Error inserting no_debt ". $row[code];
			$stringData="Error inserting no_debt ". $row[code];
			fwrite($fh, "$stringData\r\n");
		}
		fclose($fh);
		//echo  $arrayinoDebt[iloop1];
} //For loop closing brace
		
		echo "PROCESSING COMPLETED!!!!!!!";
?>