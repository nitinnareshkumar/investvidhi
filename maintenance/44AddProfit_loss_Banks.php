<?php
/***********************************************************************************************
this file is to add profit and loss data for 5 years for only public and private banks, it will take whatver data is present,
this file should be run after deleting all data from profit_loss_banks
***********************************************************************************************/
include("config.inc.php");


set_time_limit(20000);
//$res=mysql_query("select max(number) as maxi from name_code");
//$result=mysql_query("select max(number) as maxnum from name_code");
//$row = mysql_fetch_array($result);
//$iCount= $row[maxnum]; //commented ************************************************************
//$res1=mysql_query("delete from profit_loss");
// Open error log file
		//$res1=mysql_query("delete from profit_loss");
$myFile = "Profit_Loss_logs.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
//loop to parse records
$getcompanies = mysqli_query($link,"select * from name_code where company_type IN ('bankspublicsector','banksprivatesector')");
echo "aaaa".mysqli_fetch_array($getcompanies);
while($row=mysqli_fetch_array($getcompanies))
{
	$moneycontrol_code = $row['code'];
	$UrlName="http://www.moneycontrol.com/stocks/company_info/print_financials.php?sc_did=$moneycontrol_code&type=profit";
	//echo $UrlName."<br>";
	
	$handle = file_get_contents($UrlName);
	$filtered_string1=$handle;

	$yearData = strstr($filtered_string1,"<td colspan=1 class=\"detb brdL brdR\" width=\"40%\">&nbsp;</td>");	// This string is repeated before every month	
	$yearData = substr($yearData, 0, strpos($yearData, "</tr>")); // $result = php

	$InterestEarnedData  = strstr($filtered_string1,"Interest Earned");	// This string is repeated before every month
	$InterestEarnedData = substr($InterestEarnedData, 0, strpos($InterestEarnedData, "</tr>")); // $result = php
	
	$OtherIncomeData  = strstr($filtered_string1,">Other Income<");	// This string is repeated before every month	
	$OtherIncomeData = substr($OtherIncomeData, 0, strpos($OtherIncomeData, "</tr>")); // $result = php

	$totalIncomeData = strstr($filtered_string1,">Total Income<");		
	$totalIncomeData = substr($totalIncomeData, 0, strpos($totalIncomeData, "</tr>")); // $result = php

	

	$InterestExpendedData = strstr($filtered_string1,">Interest  expended<");		
	$InterestExpendedData = substr($InterestExpendedData, 0, strpos($InterestExpendedData, "</tr>")); // $result = php

	
	$EmployeeCostData = strstr($filtered_string1,">Employee Cost<");		
	$EmployeeCostData = substr($EmployeeCostData, 0, strpos($EmployeeCostData, "</tr>")); // $result = php

	$SGA1Data = strstr($filtered_string1,">Selling and Admin Expenses<");		
	$SGA1Data = substr($SGA1Data, 0, strpos($SGA1Data, "</tr>")); // $result = php

	$DepreciationData = strstr($filtered_string1,">Depreciation<");		
	$DepreciationData = substr($DepreciationData, 0, strpos($DepreciationData, "</tr>")); // $result = php


	$miscCostData = strstr($filtered_string1,">Miscellaneous Expenses<");		
	$miscCostData = substr($miscCostData, 0, strpos($miscCostData, "</tr>")); // $result = php

	$preopExpCostData = strstr($filtered_string1,">Preoperative Exp Capitalised<");		
	$preopExpCostData = substr($preopExpCostData, 0, strpos($preopExpCostData, "</tr>")); // $result = php

	$OperatingExpensesData = strstr($filtered_string1,">Operating  Expenses<");		
	$OperatingExpensesData = substr($OperatingExpensesData, 0, strpos($OperatingExpensesData, "</tr>")); // $result = php
	
	$ProvisionsData = strstr($filtered_string1,">Provisions & Contingencies<");		
	$ProvisionsData = substr($ProvisionsData, 0, strpos($ProvisionsData, "</tr>")); // $result = php

	
	$TotalExpensesData = strstr($filtered_string1,">Total Expenses<");		
	$TotalExpensesData = substr($TotalExpensesData, 0, strpos($TotalExpensesData, "</tr>")); // $result = php

	$NetProfit1Data = strstr($filtered_string1,">Net Profit for the Year<");		
	$NetProfit1Data = substr($NetProfit1Data, 0, strpos($NetProfit1Data, "</tr>")); // $result = php
	
	$EpsData = strstr($filtered_string1,">Earning Per Share (Rs)<");		
	$EpsData = substr($EpsData, 0, strpos($EpsData, "</tr>")); // $result = php

	$EquityDividendData = strstr($filtered_string1,">Equity Dividend (%)<");		
	$EquityDividendData = substr($EquityDividendData, 0, strpos($EquityDividendData, "</tr>")); // $result = php
	
		$BookValueData = strstr($filtered_string1,">Book Value (Rs)<");		
	$BookValueData = substr($BookValueData, 0, strpos($BookValueData, "</tr>")); // $result = php

	
	for($icnt=1;$icnt<6;$icnt++)
	{
		$yearData = strstr($yearData,"<td align=right class=\"detb brdL brdR\">");		
		$iPos1 = strpos($yearData,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($yearData,"</td>");
		$tempyearData = substr($yearData,($iPos1+44), ($iPos2-$iPos1 -44));           		
		$yearData = strstr($yearData,$tempyearData);
		$arrayyearData[icnt-1] = $tempyearData;
		//Sales turnover
		$InterestEarnedData = strstr($InterestEarnedData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($InterestEarnedData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($InterestEarnedData,"</td>");
		$tempInterestEarnedData = substr($InterestEarnedData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$InterestEarnedData = strstr($InterestEarnedData,$tempInterestEarnedData);
		$arrayInterestEarnedData[icnt-1] = $tempInterestEarnedData;
		
		$OtherIncomeData = strstr($OtherIncomeData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($OtherIncomeData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($OtherIncomeData,"</td>");
		$tempOtherIncomeData = substr($OtherIncomeData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$OtherIncomeData = strstr($OtherIncomeData,$tempOtherIncomeData);
		
		
		$InterestExpendedData = strstr($InterestExpendedData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($InterestExpendedData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($InterestExpendedData,"</td>");
		$tempInterestExpendedData = substr($InterestExpendedData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$InterestExpendedData = strstr($InterestExpendedData,$tempInterestExpendedData);
		
		$totalIncomeData = strstr($totalIncomeData,"<td align=right class=\"hed brdL brdR\">");		
		$iPos1 = strpos($totalIncomeData,"<td align=right class=\"hed brdL brdR\">");
		$iPos2 = strpos($totalIncomeData,"</td>");
		$temptotalIncomeData = substr($totalIncomeData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$totalIncomeData = strstr($totalIncomeData,$temptotalIncomeData);
		
		
//echo $temptotalIncomeData."gaurav";
		$EmployeeCostData = strstr($EmployeeCostData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($EmployeeCostData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($EmployeeCostData,"</td>");
		$tempEmployeeCostData = substr($EmployeeCostData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$EmployeeCostData = strstr($EmployeeCostData,$tempEmployeeCostData);
		
		$SGA1Data = strstr($SGA1Data,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($SGA1Data,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($SGA1Data,"</td>");
		$tempSGA1Data = substr($SGA1Data,($iPos1+38), ($iPos2-$iPos1 -38));           
		$SGA1Data = strstr($SGA1Data,$tempSGA1Data);

		$DepreciationData = strstr($DepreciationData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($DepreciationData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($DepreciationData,"</td>");
		$tempDepreciationData = substr($DepreciationData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$DepreciationData = strstr($DepreciationData,$tempDepreciationData);
	
		$miscCostData = strstr($miscCostData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($miscCostData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($miscCostData,"</td>");
		$tempmiscCostData = substr($miscCostData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$miscCostData = strstr($miscCostData,$tempmiscCostData);
		
		$preopExpCostData = strstr($preopExpCostData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($preopExpCostData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($preopExpCostData,"</td>");
		$temppreopExpCostData = substr($preopExpCostData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$preopExpCostData = strstr($preopExpCostData,$temppreopExpCostData);
		
		$OperatingExpensesData = strstr($OperatingExpensesData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($OperatingExpensesData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($OperatingExpensesData,"</td>");
		$tempOperatingExpensesData = substr($OperatingExpensesData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$OperatingExpensesData = strstr($OperatingExpensesData,$tempOperatingExpensesData);
		
		$ProvisionsData = strstr($ProvisionsData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($ProvisionsData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($ProvisionsData,"</td>");
		$tempProvisionsData = substr($ProvisionsData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$ProvisionsData = strstr($ProvisionsData,$tempProvisionsData);
		
		$TotalExpensesData = strstr($TotalExpensesData,"<td align=right class=\"hed brdL brdR\">");		
		$iPos1 = strpos($TotalExpensesData,"<td align=right class=\"hed brdL brdR\">");
		$iPos2 = strpos($TotalExpensesData,"</td>");
		$tempTotalExpensesData = substr($TotalExpensesData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$TotalExpensesData = strstr($TotalExpensesData,$tempTotalExpensesData);
		
		$NetProfit1Data = strstr($NetProfit1Data,"<td align=right class=\"hed brdL brdR\">");		
		$iPos1 = strpos($NetProfit1Data,"<td align=right class=\"hed brdL brdR\">");
		$iPos2 = strpos($NetProfit1Data,"</td>");
		$tempNetProfit1Data = substr($NetProfit1Data,($iPos1+38), ($iPos2-$iPos1 -38));           
		$NetProfit1Data = strstr($NetProfit1Data,$tempNetProfit1Data);
		
		$EpsData = strstr($EpsData,"<td align=right class=\"hed brdL brdR\">");		
		$iPos1 = strpos($EpsData,"<td align=right class=\"hed brdL brdR\">");
		$iPos2 = strpos($EpsData,"</td>");
		$tempEpsData = substr($EpsData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$EpsData = strstr($EpsData,$tempEpsData);
		
	
		
		$EquityDividendData = strstr($EquityDividendData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($EquityDividendData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($EquityDividendData,"</td>");
		$tempEquityDividendData = substr($EquityDividendData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$EquityDividendData = strstr($EquityDividendData,$tempEquityDividendData);
		
		$BookValueData = strstr($BookValueData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($BookValueData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($BookValueData,"</td>");
		$tempBookValueData = substr($BookValueData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$BookValueData = strstr($BookValueData,$tempBookValueData);
		
		
		
			$patterns =",";
		$replacements1 = '';

		
		//---------remove comma-------
		$tempInterestEarnedData = str_replace($patterns,$replacements1,$tempInterestEarnedData);
		$tempOtherIncomeData = str_replace($patterns,$replacements1,$tempOtherIncomeData);
		$tempInterestExpendedData = str_replace($patterns,$replacements1,$tempInterestExpendedData);
		$temptotalIncomeData = str_replace($patterns,$replacements1,$temptotalIncomeData);
		$tempEmployeeCostData = str_replace($patterns,$replacements1,$tempEmployeeCostData);
		$tempSGA1Data = str_replace($patterns,$replacements1,$tempSGA1Data);
			
		$tempDepreciationData = str_replace($patterns,$replacements1,$tempDepreciationData);
		
		$tempmiscCostData = str_replace($patterns,$replacements1,$tempmiscCostData);
		$temppreopExpCostData = str_replace($patterns,$replacements1,$temppreopExpCostData);
		$tempOperatingExpensesData = str_replace($patterns,$replacements1,$tempOperatingExpensesData);
		
		$tempProvisionsData = str_replace($patterns,$replacements1,$tempProvisionsData);
		$tempTotalExpensesData = str_replace($patterns,$replacements1,$tempTotalExpensesData);
		$tempNetProfit1Data = str_replace($patterns,$replacements1,$tempNetProfit1Data);
		$tempEpsData = str_replace($patterns,$replacements1,$tempEpsData);		
		$tempEquityDividendData = str_replace($patterns,$replacements1,$tempEquityDividendData);
		$tempBookValueData = str_replace($patterns,$replacements1,$tempBookValueData);

		//----------------------------------

		

		echo "before insert of ".$row[number]."<br>";
		if ($tempyearData != NULL) 
		{
			//$res=mysqli_query($link,"insert into profit_loss_banks set  companynumber='$row[number]',companycode= '$row[code]', year='$tempyearData', InterestEarned ='$tempInterestEarnedData' , OtherIncome = '$tempOtherIncomeData' , TotalIncome = '$temptotalIncomeData' , InterestExpended = '$tempInterestExpendedData' , EmployeeCost ='$tempEmployeeCostData', SGA ='$tempSGA1Data' , Depreciation = '$tempDepreciationData' , MiscellaneousExpenses = '$tempmiscCostData', OperatingExpenses = '$tempOperatingExpensesData' , Provisions ='$tempProvisionsData' , TotalExpenses = '$tempTotalExpensesData' , NetProfit ='$tempNetProfit1Data' , Eps ='$tempEpsData' , EquityDividend ='$tempEquityDividendData' ,BookValue ='$tempBookValueData' ");// naidu uncomment
			echo "companynumber=".$row[number]."companycode".$row[code]." year".$tempyearData." InterestEarned ".$tempInterestEarnedData." OtherIncome ".$tempOtherIncomeData." TotalIncome ".$temptotalIncomeData." InterestExpended ".$tempInterestExpendedData." EmployeeCost ".$tempEmployeeCostData." SGA ".$tempSGA1Data." Depreciation ".$tempDepreciationData." MiscellaneousExpenses ".$tempmiscCostData." OperatingExpenses ".$tempOperatingExpensesData." Provisions ".$tempProvisionsData." TotalExpenses ".$tempTotalExpensesData." NetProfit ".$tempNetProfit1Data." Eps ".$tempEpsData." EquityDividend ".$tempEquityDividendData."BookValue ".$tempBookValueData;
		}
		if(!$res)
		{
			//echo "Error inserting sales ". $row[code];
			echo "Error inserting sales ". $row[number].mysqli_error();
		}
	
	} 

echo "after insert of ";
			break;//naidu delete
}
		
		fclose($fh);
//} //For loop closing brace
		
		echo "PROCESSING COMPLETED!!!!!!!";
?>