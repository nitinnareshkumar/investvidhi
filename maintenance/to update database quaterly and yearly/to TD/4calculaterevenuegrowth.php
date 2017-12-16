<?php
/***********************************************************************************************
PHP file to insert growth percentage for each year , update always positive growth indicator and
update average growth percentage
***********************************************************************************************/
include("config.inc.php");


// Note that the sales can only be non blank , "--" , NA
set_time_limit(20000);
//$res=mysql_query("select max(number) as maxi from name_code");
//$result=mysql_query("select max(number) as maxnum from sales");
//$row = mysql_fetch_array($result);
//$iLoop= $row[maxnum]; //commented ************************************************************
//$iCount=6915;//hard coded for fetching 100 records.
// Open error log file
$myFile = "error_revenuegrowth1.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
//loop to parse records
$iLoop = 10;
for ($iCount= 1; $iCount<($iLoop+1);$iCount++)
{
	$result=mysql_query("select * from sales where companynumber= $iCount");

	$row = mysql_fetch_array($result);

	//$result=mysql_query("select * from name_code where number=1");
	$arrayiSales[10];
	$arrayiGrowth[9];
	
	$arrayiSales[0] = $row['Mar06'];
	$arrayiSales[1] = $row['Mar07'];
	$arrayiSales[2] = $row['Mar08'];
	$arrayiSales[3] = $row['Mar09'];
	$arrayiSales[4] = $row['Mar10'];
	$arrayiSales[5] = $row['Mar11'];
	$arrayiSales[6] = $row['Mar12'];
	$arrayiSales[7] = $row['Mar13'];
	$arrayiSales[8] = $row['Mar14'];
	$arrayiSales[9] = $row['Mar15'];
		
	$arrayiGrowth[1] = '';
	$arrayiGrowth[2] = '';
	$arrayiGrowth[3] = '';
	$arrayiGrowth[4] = '';
	$arrayiGrowth[0] = '';
	$arrayiGrowth[5] = '';
	$arrayiGrowth[6] = '';
	$arrayiGrowth[7] = '';
	$arrayiGrowth[8] = '';
	
	$validRecordsCount = 0; 
	for ($i=0 ; $i < 10 ;$i++)
	{
		if ( ($arrayiSales[$i] == "NA" ) || ($arrayiSales[$i] == "--" )  || ($arrayiSales[$i]==''  ) || ($arrayiSales[$i] == "0.00" ))
		{
			continue;
		}
		if ( ($arrayiSales[$i + 1] == "NA" ) || ($arrayiSales[$i+1] == "--" )|| ($arrayiSales[$i+1]==''  ))
		{
			continue;
		}
		if ( $i==9)
		{
		continue;
		}
		$arrayiGrowth[$i] = (($arrayiSales[$i + 1] - $arrayiSales[$i])/$arrayiSales[$i]) * 100;
		if ( $arrayiSales[$i] < 0 )
		{
			$arrayiGrowth[$i] = - $arrayiGrowth[$i];
		}
		
	
				//echo "$arrayiGrowth".$i."==".$arrayiGrowth[$i];
                // echo "<br>";
				 
				 
		$validRecordsCount = $validRecordsCount + 1;
	}
	//echo "valid".$validRecordsCount;
	
	$positiveindicator = 1;
	$finalGrowth = 0;
	$count =0 ;
	for ( $count=0 ; $count < 9 ;$count++)
	{
		$finalGrowth = $finalGrowth + $arrayiGrowth[$count];
		//echo "$arrayiGrowth".$count."==".$arrayiGrowth[j];

	}
	for ( $count=0 ; $count < 9 ;$count++)
	{
		if ( $arrayiGrowth[$count] < 0 )
		{
		$positiveindicator= -1;
		break;
		}
		/*if ( $arrayiGrowth[$count] == 0 )
		{
		$invalidrecords= $invalidrecords + 1;
	
		}*/
		
	}
	if ($validRecordsCount != 0)
	{
	$finalGrowth = $finalGrowth / $validRecordsCount;
	//echo "finalGrowth".$finalGrowth;
	//echo "<br>";
    $res=mysql_query("update  sales set GrowthPer='$finalGrowth', growth6_7 = '$arrayiGrowth[0]' , growth7_8 = '$arrayiGrowth[1]', growth8_9= '$arrayiGrowth[2]', growth9_10 = '$arrayiGrowth[3]', growth10_11 = '$arrayiGrowth[4]', growth11_12 = '$arrayiGrowth[5]', growth12_13 = '$arrayiGrowth[6]', growth13_14 = '$arrayiGrowth[7]', growth14_15 = '$arrayiGrowth[8]' , GrowthAlwaysPositive='$positiveindicator' where companynumber = $iCount") or die(mysql_error()) ;
	
	
	
	if(!$res)
	{
		//echo "Error inserting sales ". $row[code];
		$stringData="Error inserting revenue growth ". $iCount;
		fwrite($fh, "$stringData\r\n");
	}
	
	}
	else
	{
	$stringData="problem in record ". $iCount;
		fwrite($fh, "$stringData\r\n");
	}
	
	
		//echo "finalGrowth".$finalGrowth;

	
	//echo "growth is ".$finalGrowth;
}
	
	
	
	

		
		echo "PROCESSING COMPLETED!!!!!!!";
		
?>