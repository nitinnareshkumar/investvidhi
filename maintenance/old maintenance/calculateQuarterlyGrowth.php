<?php
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
$iLoop = 7177;
for ($iCount= 1; $iCount<($iLoop+1);$iCount++)
{
	$result=mysql_query("select * from data_companies_curr where CompNumber= $iCount");

	$row = mysql_fetch_array($result);

	//$result=mysql_query("select * from name_code where number=1");
	$arrayiEPS[3];
	$arrayiEPSGrowth[2];
	$arrayiOP[3];
	$arrayiOPGrowth[2];
	$arrayiSales[3];
	$arrayiSalesGrowth[2];	
	
	$arrayiEPS[0] = $row['Jun_EPS'];
	$arrayiOP[0] = $row['Jun_Operating_Profit'];
	$arrayiSales[0] = $row['Jun_Sales'];
	
	$arrayiEPS[1] = $row['Sep_EPS'];
	$arrayiOP[1] = $row['Sep_Operating_Profit'];
	$arrayiSales[1] = $row['Sep_Sales'];
	
	$arrayiEPS[2] = $row['Dec_EPS'];
	$arrayiOP[2] = $row['Dec_Operating_Profit'];
	$arrayiSales[2] = $row['Dec_Sales'];
	
				
	$arrayiEPSGrowth[0] = 0;
	$arrayiEPSGrowth[1] = 0;
	
	$arrayiOPGrowth[0] = 0;
	$arrayiOPGrowth[1] = 0;
	
	$arrayiSalesGrowth[0] = 0;
	$arrayiSalesGrowth[1] = 0;
		
	$validRecordsCount = 0; 
	for ($i=0 ; $i < 3 ;$i++)
	{
		if ( ($arrayiEPS[$i] == "NA" ) || ($arrayiEPS[$i] == "--" ) || ($arrayiEPS[$i]==''  ) || ($arrayiEPS[$i] == "0.00" ))
		{
			continue;
		}
		if ( ($arrayiEPS[$i + 1] == "NA" ) || ($arrayiEPS[$i+1] == "--" ) || ($arrayiEPS[$i]==''  ))
		{
			continue;
		}
		if ( $i==2)
		{
		continue;
		}
		$arrayiEPSGrowth[$i] = (($arrayiEPS[$i + 1] - $arrayiEPS[$i])/$arrayiEPS[$i]) * 100;
		if ( $arrayiEPS[$i] < 0 )
		{
			$arrayiEPSGrowth[$i] = - $arrayiEPSGrowth[$i];
		} 
	$arrayiEPSGrowth[1] = intval($arrayiEPSGrowth[1]);
	$arrayiEPSGrowth[0] = intval($arrayiEPSGrowth[0]);
	}
		for ($i=0 ; $i < 3 ;$i++)
	{
		if ( ($arrayiOP[$i] == "NA" ) || ($arrayiOP[$i] == "--" ) || ($arrayiOP[$i]==''  ) || ($arrayiOP[$i] == "0.00" ))
		{
			continue;
		}
		if ( ($arrayiOP[$i + 1] == "NA" ) || ($arrayiOP[$i+1] == "--" ) || ($arrayiOP[$i]==''  ))
		{
			continue;
		}
		if ( $i==2)
		{
		continue;
		}
		$arrayiOPGrowth[$i] = (($arrayiOP[$i + 1] - $arrayiOP[$i])/$arrayiOP[$i]) * 100;
		if ( $arrayiOP[$i] < 0 )
		{
			$arrayiOPGrowth[$i] = - $arrayiOPGrowth[$i];
		} 
		$arrayiOPGrowth[1] = intval($arrayiOPGrowth[1]);
	$arrayiOPGrowth[0] = intval($arrayiOPGrowth[0]);
	}
	
		for ($i=0 ; $i < 3 ;$i++)
	{
		if ( ($arrayiSales[$i] == "NA" ) || ($arrayiSales[$i] == "--" ) || ($arrayiSales[$i]==''  ) || ($arrayiSales[$i] == "0.00" ))
		{
			continue;
		}
		if ( ($arrayiSales[$i + 1] == "NA" ) || ($arrayiSales[$i+1] == "--" ) || ($arrayiSales[$i]==''  ))
		{
			continue;
		}
		if ( $i==2)
		{
		continue;
		}
		$arrayiSalesGrowth[$i] = (($arrayiSales[$i + 1] - $arrayiSales[$i])/$arrayiSales[$i]) * 100;
		if ( $arrayiSales[$i] < 0 )
		{
			$arrayiSalesGrowth[$i] = - $arrayiSalesGrowth[$i];
		} 
		$arrayiSalesGrowth[1] = intval($arrayiSalesGrowth[1]);
	$arrayiSalesGrowth[0] = intval($arrayiSalesGrowth[0]);
	}
	

	
	
    $res=mysql_query("update  data_companies_curr set growthEPS_qtr1='$arrayiEPSGrowth[0]',growthEPS_qtr2='$arrayiEPSGrowth[1]',growthOP_qtr1='$arrayiOPGrowth[0]',growthOP_qtr2='$arrayiOPGrowth[1]',growthSales_qtr1='$arrayiSalesGrowth[0]',growthSales_qtr2='$arrayiSalesGrowth[1]' where CompNumber = $iCount");
	
	
	if(!$res)
	{
		//echo "Error inserting sales ". $row[code];
		$stringData="Error inserting revenue growth ". $iCount;
		fwrite($fh, "$stringData\r\n");
	}
	
		//echo "finalGrowth".$finalGrowth;

	
	//echo "growth is ".$finalGrowth;
}
	
	
	
	

		
		echo "PROCESSING COMPLETED!!!!!!!";
		
?>