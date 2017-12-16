<?php
/***********************************************************************************************
PHP File to read the data company ocde from NAme_Code table and get the BSE Script name of the 
company and insert in to the name_code table.
Url Used is :
"http://www.moneycontrol.com/financials/". $row['nameinmc']."/results/yearly/".$row['code'];"S
***********************************************************************************************/


include("config.inc.php");
set_time_limit(20000);
//$res=mysql_query("select max(number) as maxi from name_code");
//$result=mysql_query("select max(number) as maxnum from name_code");
//$row = mysql_fetch_array($result);
//$iCount= $row[maxnum]; //commented ************************************************************
$iCount=7992;//hard coded for fetching 2000 records.
// Open error log file
$myFile = "error_logs.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
//loop to parse records
for ($iLoop= 7852; $iLoop<($iCount+1);$iLoop++)
{
	$result=mysql_query("select * from name_code where number=$iLoop");
	//$result=mysql_query("select * from name_code where number=1");
	
	$row = mysql_fetch_array($result);
	$UrlName="http://www.moneycontrol.com/financials/".$row['nameinmc']."/results/yearly/".$row['code'];
	echo $UrlName;
	
	$handle = file_get_contents($UrlName);
	$filtered_string1=$handle;
	$BSE_ScriptName_Temp = strstr($filtered_string1,"BSE:");// Look for "BSE:</b> in the webpage html source code.
	if ($BSE_ScriptName_Temp==FALSE)							// IF BSE code not found 
	{
		//$res=mysql_query("insert into temp_script set SNo='$iLoop',BSE_Script= 'No Longer traded'");
		$stringData="Error finding the BSE script code for". $row[code];
		fwrite($fh, "$stringData\r\n");
	}
	else
	{
	//echo $BSE_ScriptName_Temp.'asd';
		//$BSE_ScriptName_Temp = strstr($BSE_ScriptName_Temp,"&nbsp; <b>NSE:</b>", true);
		$BSE_ScriptName_Temp = substr($BSE_ScriptName_Temp, 0, strpos($BSE_ScriptName_Temp, "<span")); // $result = php
			
			$BSE_ScriptName_Temp = substr($BSE_ScriptName_Temp, 4); 
echo $BSE_ScriptName_Temp;
		//$iPos1 = strpos($sales,"BSE:</b>");
		//$iPos2 = strpos($sales," ");
	
		//$BSE_ScriptName_Temp = substr($BSE_ScriptName_Temp,($iPos1+9), ($iPos2-($iPos1+8)));    // Get the script code within the iPos1 n iPos2		
		//echo $BSE_ScriptName_Temp."naya wala";
		//Insert in to Table
		$res=mysql_query("UPDATE name_code SET BSE_Script='$BSE_ScriptName_Temp' WHERE code='$row[code]'");
	}	
	//echo $iLoop."--";
} //For loop closing brace
		fclose($fh);//close error log file
		
		echo "PROCESSING COMPLETED!!!!!!!";
?>