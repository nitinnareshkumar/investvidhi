<?php
/***********************************************************************************************
this file is to add balance sheet data for 5 years for public and private banks, it will take whatver data is present,
this file should be run after deleting all data from balance_sheet_banks
***********************************************************************************************/
include("config.inc.php");
set_time_limit(20000);
//$res=mysql_query("select max(number) as maxi from name_code");
$result=mysqli_query($link,"select max(number) as maxnum from name_code");
$row = mysqli_fetch_array($result);
//$iCount= $row[maxnum]; //commented ************************************************************
// Open error log file

$myFile = "BalanceSheet_logs.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
//loop to parse records
$getcompanies = mysqli_query($link,"select * from name_code where company_type IN ('bankspublicsector','banksprivatesector')");
while($row=mysqli_fetch_array($getcompanies))
{
	$moneycontrol_code = $row['code'];
$UrlName="http://www.moneycontrol.com/stocks/company_info/print_financials.php?sc_did=$moneycontrol_code&type=balance";
		

	
	$handle = file_get_contents($UrlName);
	$filtered_string1=$handle;
//echo $theData;
//loop to parse records
//for ($iLoop= 5001; $iLoop<($iCount+1);$iLoop++)
//{
	//$result=mysql_query("select * from name_code where number=$iLoop");
	//$result=mysql_query("select * from name_code where number=1");
	
	$yearData = strstr($filtered_string1,"<td colspan=1 class=\"detb brdL brdR\" width=\"40%\">&nbsp;</td>");	// This string is repeated before every month	
	$yearData = substr($yearData, 0, strpos($yearData, "</tr>")); // $result = php
	
	
	$equityShareCapitalData = strstr($filtered_string1,">Equity Share Capital<");	// This string is repeated before every month	
	$equityShareCapitalData = substr($equityShareCapitalData, 0, strpos($equityShareCapitalData, "</tr>")); // $result = php
	
	$reservesData = strstr($filtered_string1,">Reserves<");	// This string is repeated before every month	
	$reservesData = substr($reservesData, 0, strpos($reservesData, "</tr>")); // $result = php
	
	$PreferenceShareCapitalData = strstr($filtered_string1,">Preference Share Capital<");	// This string is repeated before every month	
	$PreferenceShareCapitalData = substr($PreferenceShareCapitalData, 0, strpos($PreferenceShareCapitalData, "</tr>")); // $result = php
	
	$networthData = strstr($filtered_string1,">Net Worth<");	// This string is repeated before every month	
	$networthData = substr($networthData, 0, strpos($networthData, "</tr>")); // $result = php	
	
	$DepositsData = strstr($filtered_string1,">Deposits<");	// This string is repeated before every month	
	$DepositsData = substr($DepositsData, 0, strpos($DepositsData, "</tr>")); // $result = php
	
	$BorrowingsData = strstr($filtered_string1,">Borrowings<");	// This string is repeated before every month	
	$BorrowingsData = substr($BorrowingsData, 0, strpos($BorrowingsData, "</tr>")); // $result = php
	
	$TotalDebtData = strstr($filtered_string1,">Total Debt<");	// This string is repeated before every month	
	$TotalDebtData = substr($TotalDebtData, 0, strpos($TotalDebtData, "</tr>")); // $result = php
	
	$totalClProvisionsData = strstr($filtered_string1,">Other Liabilities & Provisions<");	// This string is repeated before every month	
	$totalClProvisionsData = substr($totalClProvisionsData, 0, strpos($totalClProvisionsData, "</tr>")); // $result = php

	$TotalLiabilitiesData = strstr($filtered_string1,">Total Liabilities<");	// This string is repeated before every month	
	//$TotalLiabilitiesData = strstr($TotalLiabilitiesData,"</tr>", true);
	$TotalLiabilitiesData = substr($TotalLiabilitiesData, 0, strpos($TotalLiabilitiesData, "</tr>")); // $result = php

	$cashData = strstr($filtered_string1,">Cash & Balances with RBI<");		
	//$cashData = strstr($cashData,"</tr>",true);
		$cashData = substr($cashData, 0, strpos($cashData, "</tr>")); // $result = php
	
	$BalanceWithBanksData = strstr($filtered_string1,">Balance with Banks, Money at Call<");		
	//$BalanceWithBanksData = strstr($BalanceWithBanksData,"</tr>",true);
	$BalanceWithBanksData = substr($BalanceWithBanksData, 0, strpos($BalanceWithBanksData, "</tr>")); // $result = php

	$AdvancesData = strstr($filtered_string1,">Advances<");		
	//$AdvancesData = strstr($AdvancesData,"</tr>",true);
	$AdvancesData = substr($AdvancesData, 0, strpos($AdvancesData, "</tr>")); // $result = php

	$InvestmentsData = strstr($filtered_string1,">Investments<");		
	//$InvestmentsData = strstr($InvestmentsData,"</tr>",true);
	$InvestmentsData = substr($InvestmentsData, 0, strpos($InvestmentsData, "</tr>")); // $result = php



	$GrossBlockData = strstr($filtered_string1,">Gross Block<");		
	//$GrossBlockData = strstr($GrossBlockData,"</tr>",true);
	$GrossBlockData = substr($GrossBlockData, 0, strpos($GrossBlockData, "</tr>")); // $result = php

	$AccumulatedDepreciationData = strstr($filtered_string1,">Accumulated Depreciation<");		
	//$AccumulatedDepreciationData = strstr($AccumulatedDepreciationData,"</tr>",true);
	$AccumulatedDepreciationData = substr($AccumulatedDepreciationData, 0, strpos($AccumulatedDepreciationData, "</tr>")); // $result = php

	$NetBlockData = strstr($filtered_string1,">Net Block<");		
	//$NetBlockData = strstr($NetBlockData,"</tr>",true);
	$NetBlockData = substr($NetBlockData, 0, strpos($NetBlockData, "</tr>")); // $result = php

	$CapitalWorkData = strstr($filtered_string1,">Capital Work In Progress<");		
	//$CapitalWorkData = strstr($CapitalWorkData,"</tr>",true);
	$CapitalWorkData = substr($CapitalWorkData, 0, strpos($CapitalWorkData, "</tr>")); // $result = php

	$OtherAssetsData = strstr($filtered_string1,">Other Assets<");		
	//$OtherAssetsData = strstr($OtherAssetsData,"</tr>",true);
	$OtherAssetsData = substr($OtherAssetsData, 0, strpos($OtherAssetsData, "</tr>")); // $result = php

	$TotalAssetsData = strstr($filtered_string1,">Total Assets<");		
	//$TotalAssetsData = strstr($TotalAssetsData,"</tr>",true);
	$TotalAssetsData = substr($TotalAssetsData, 0, strpos($TotalAssetsData, "</tr>")); // $result = php

	$ContingentLiabilitiesData = strstr($filtered_string1,">Contingent Liabilities<");		
	//$TotalAssetsData = strstr($TotalAssetsData,"</tr>",true);
	$ContingentLiabilitiesData = substr($ContingentLiabilitiesData, 0, strpos($ContingentLiabilitiesData, "</tr>")); // $result = php
	
	$BillsforcollectionData = strstr($filtered_string1,">Bills for collection<");		
	//$TotalAssetsData = strstr($TotalAssetsData,"</tr>",true);
	$BillsforcollectionData = substr($BillsforcollectionData, 0, strpos($BillsforcollectionData, "</tr>")); // $result = php
	
	$BookValueData = strstr($filtered_string1,">Book Value (Rs)<");		
	//$TotalAssetsData = strstr($TotalAssetsData,"</tr>",true);
	$BookValueData = substr($BookValueData, 0, strpos($BookValueData, "</tr>")); // $result = php

	for($icnt=1;$icnt<6;$icnt++)
	{
		$yearData = strstr($yearData,"<td align=right class=\"detb brdL brdR\">");		
		$iPos1 = strpos($yearData,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($yearData,"</td>");
		$tempyearData = substr($yearData,($iPos1+44), ($iPos2-$iPos1 -44));           		
		$yearData = strstr($yearData,$tempyearData);
		$arrayyearData['icnt'-1] = $tempyearData;

		$equityShareCapitalData = strstr($equityShareCapitalData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($equityShareCapitalData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($equityShareCapitalData,"</td>");
		$tempequityShareCapitalData = substr($equityShareCapitalData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$equityShareCapitalData = strstr($equityShareCapitalData,$tempequityShareCapitalData);
		
		$reservesData = strstr($reservesData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($reservesData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($reservesData,"</td>");
		$tempreservesData = substr($reservesData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$reservesData = strstr($reservesData,$tempreservesData);
		
		$PreferenceShareCapitalData = strstr($PreferenceShareCapitalData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($PreferenceShareCapitalData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($PreferenceShareCapitalData,"</td>");
		$tempPreferenceShareCapitalData = substr($PreferenceShareCapitalData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$PreferenceShareCapitalData = strstr($PreferenceShareCapitalData,$tempPreferenceShareCapitalData);
		
		//------------------------
	
		
		$networthData = strstr($networthData,"<td align=right class=\"detb brdL brdR\">");			
		$iPos1 = strpos($networthData,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($networthData,"</td>");
		$tempnetworthData = substr($networthData,($iPos1+39), ($iPos2-$iPos1 -39));           		
		$networthData = strstr($networthData,$tempnetworthData);
		
		
		$DepositsData  = strstr($DepositsData ,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($DepositsData ,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($DepositsData ,"</td>");
		$tempDepositsData  = substr($DepositsData ,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$DepositsData  = strstr($DepositsData ,$tempDepositsData);
		
		$BorrowingsData = strstr($BorrowingsData,"<td align=right class=\"det brdL brdR\">");
		$iPos1 = strpos($BorrowingsData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($BorrowingsData,"</td>");
		$tempBorrowingsData = substr($BorrowingsData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$BorrowingsData = strstr($BorrowingsData,$tempBorrowingsData);
		
		$TotalDebtData = strstr($TotalDebtData,"<td align=right class=\"detb brdL brdR\">");			
		$iPos1 = strpos($TotalDebtData,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($TotalDebtData,"</td>");
		$tempTotalDebtData = substr($TotalDebtData,($iPos1+39), ($iPos2-$iPos1 -39));           		
		$TotalDebtData = strstr($TotalDebtData,$tempTotalDebtData);
		
		$totalClProvisionsData = strstr($totalClProvisionsData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($totalClProvisionsData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($totalClProvisionsData,"</td>");
		$temptotalClProvisionsData = substr($totalClProvisionsData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$totalClProvisionsData = strstr($totalClProvisionsData,$temptotalClProvisionsData);
		
		$TotalLiabilitiesData = strstr($TotalLiabilitiesData,"<td align=right class=\"detb brdL brdR\">");			
		$iPos1 = strpos($TotalLiabilitiesData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($TotalLiabilitiesData,"</td>");
		$tempTotalLiabilitiesData = substr($TotalLiabilitiesData,($iPos1+39), ($iPos2-$iPos1 -39));           		
		$TotalLiabilitiesData = strstr($TotalLiabilitiesData,$tempTotalLiabilitiesData);
		
		$cashData = strstr($cashData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($cashData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($cashData,"</td>");
		$tempcashData = substr($cashData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$cashData = strstr($cashData,$tempcashData);
		
		$BalanceWithBanksData = strstr($BalanceWithBanksData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($BalanceWithBanksData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($BalanceWithBanksData,"</td>");
		$tempBalanceWithBanksData = substr($BalanceWithBanksData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$BalanceWithBanksData = strstr($BalanceWithBanksData,$tempBalanceWithBanksData);
		
		$AdvancesData = strstr($AdvancesData,"<td align=right class=\"detb brdL brdR\">");			
		$iPos1 = strpos($AdvancesData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($AdvancesData,"</td>");
		$tempAdvancesData = substr($AdvancesData,($iPos1+39), ($iPos2-$iPos1 -39));           		
		$AdvancesData = strstr($AdvancesData,$tempAdvancesData);
		
		$InvestmentsData = strstr($InvestmentsData,"<td align=right class=\"detb brdL brdR\">");			
		$iPos1 = strpos($InvestmentsData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($InvestmentsData,"</td>");
		$tempInvestmentsData = substr($InvestmentsData,($iPos1+39), ($iPos2-$iPos1 -39));           		
		$InvestmentsData = strstr($InvestmentsData,$tempInvestmentsData);

		$GrossBlockData = strstr($GrossBlockData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($GrossBlockData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($GrossBlockData,"</td>");
		$tempGrossBlockData = substr($GrossBlockData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$GrossBlockData = strstr($GrossBlockData,$tempGrossBlockData);

		$AccumulatedDepreciationData = strstr($AccumulatedDepreciationData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($AccumulatedDepreciationData,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($AccumulatedDepreciationData,"</td>");
		$tempAccumulatedDepreciationData = substr($AccumulatedDepreciationData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$AccumulatedDepreciationData = strstr($AccumulatedDepreciationData,$tempAccumulatedDepreciationData);

		$NetBlockData = strstr($NetBlockData,"<td align=right class=\"detb brdL brdR\">");			
		$iPos1 = strpos($NetBlockData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($NetBlockData,"</td>");
		$tempNetBlockData = substr($NetBlockData,($iPos1+39), ($iPos2-$iPos1 -39));           		
		$NetBlockData = strstr($NetBlockData,$tempNetBlockData);
		
		$CapitalWorkData = strstr($CapitalWorkData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($CapitalWorkData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($CapitalWorkData,"</td>");
		$tempCapitalWorkData = substr($CapitalWorkData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$CapitalWorkData = strstr($CapitalWorkData,$tempCapitalWorkData);

		$OtherAssetsData = strstr($OtherAssetsData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($OtherAssetsData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($OtherAssetsData,"</td>");
		$tempOtherAssetsData = substr($OtherAssetsData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$OtherAssetsData = strstr($OtherAssetsData,$tempOtherAssetsData);
		
		$TotalAssetsData = strstr($TotalAssetsData,"<td align=right class=\"detb brdL brdR\">");			
		$iPos1 = strpos($TotalAssetsData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($TotalAssetsData,"</td>");
		$tempTotalAssetsData = substr($TotalAssetsData,($iPos1+39), ($iPos2-$iPos1 -39));           		
		$TotalAssetsData = strstr($TotalAssetsData,$tempTotalAssetsData);
		
		$ContingentLiabilitiesData = strstr($ContingentLiabilitiesData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($ContingentLiabilitiesData,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($ContingentLiabilitiesData,"</td>");
		$tempContingentLiabilitiesData = substr($ContingentLiabilitiesData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$ContingentLiabilitiesData = strstr($ContingentLiabilitiesData,$tempContingentLiabilitiesData);
		
		$BillsforcollectionData = strstr($BillsforcollectionData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($BillsforcollectionData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($BillsforcollectionData,"</td>");
		$tempBillsforcollectionData = substr($BillsforcollectionData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$BillsforcollectionData = strstr($BillsforcollectionData,$tempBillsforcollectionData);
		
		$BookValueData = strstr($BookValueData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($BookValueData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($BookValueData,"</td>");
		$tempBookValueData = substr($BookValueData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$BookValueData = strstr($BookValueData,$tempBookValueData);
		
		$patterns =",";
		$replacements1 = '';
		$tempequityShareCapitalData = str_replace($patterns,$replacements1,$tempequityShareCapitalData);
		$tempreservesData = str_replace($patterns,$replacements1,$tempreservesData);
		$tempPreferenceShareCapitalData = str_replace($patterns,$replacements1,$tempPreferenceShareCapitalData);
		
		$tempnetworthData = str_replace($patterns,$replacements1,$tempnetworthData);
		$tempBorrowingsData = str_replace($patterns,$replacements1,$tempBorrowingsData);
		$tempDepositsData = str_replace($patterns,$replacements1,$tempDepositsData);
		
		$tempTotalDebtData = str_replace($patterns,$replacements1,$tempTotalDebtData);
		$temptotalClProvisionsData = str_replace($patterns,$replacements1,$temptotalClProvisionsData);
		$tempTotalLiabilitiesData = str_replace($patterns,$replacements1,$tempTotalLiabilitiesData);
		
		$tempcashData = str_replace($patterns,$replacements1,$tempcashData);
		$tempBalanceWithBanksData = str_replace($patterns,$replacements1,$tempBalanceWithBanksData);
		
		$tempAdvancesData = str_replace($patterns,$replacements1,$tempAdvancesData);
		$tempInvestmentsData = str_replace($patterns,$replacements1,$tempInvestmentsData);
		$tempGrossBlockData = str_replace($patterns,$replacements1,$tempGrossBlockData);
		$tempAccumulatedDepreciationData = str_replace($patterns,$replacements1,$tempAccumulatedDepreciationData);
		
		$tempNetBlockData = str_replace($patterns,$replacements1,$tempNetBlockData);
		$tempCapitalWorkData = str_replace($patterns,$replacements1,$tempCapitalWorkData);
		$tempOtherAssetsData = str_replace($patterns,$replacements1,$tempOtherAssetsData);
		
		$tempTotalAssetsData = str_replace($patterns,$replacements1,$tempTotalAssetsData);
		$tempContingentLiabilitiesData = str_replace($patterns,$replacements1,$tempContingentLiabilitiesData);
		$tempBillsforcollectionData = str_replace($patterns,$replacements1,$tempBillsforcollectionData);
		$tempOtherAssetsData = str_replace($patterns,$replacements1,$tempOtherAssetsData);
		$tempBookValueData = str_replace($patterns,$replacements1,$tempBookValueData);
		if ($tempyearData != NULL) 
			{
				$res=mysqli_query($link,"insert into balanceSheet_banks set companynumber='$row[number]',companycode= '$row[code]',  year='$tempyearData', equityShareCapital ='$tempequityShareCapitalData' , Reserves = '$tempreservesData' , PreferenceShareCapital= '$tempPreferenceShareCapitalData' , networth = '$tempnetworthData ' , Deposits = '$tempDepositsData' , Borrowings = '$tempBorrowingsData' , TotalDebt = '$tempTotalDebtData' , totalClProvisions = '$temptotalClProvisionsData' , TotalLiabilities = '$tempTotalLiabilitiesData' , cash = '$tempcashData' , BalanceWithBanks = '$tempBalanceWithBanksData' , Advances = '$tempAdvancesData' , Investments = '$tempInvestmentsData' , GrossBlock= '$tempGrossBlockData' , AccumulatedDepreciation = '$tempAccumulatedDepreciationData' , NetBlock = '$tempNetBlockData' , CapitalWork = '$tempCapitalWorkData' , OtherAssets = '$tempOtherAssetsData' , TotalAssets = '$tempTotalAssetsData', ContingentLiabilities = '$tempContingentLiabilitiesData', Billsforcollection ='$tempBillsforcollectionData', BookValue ='$tempBookValueData' ");//naidu uncomment
				//echo "companynumber".$row[number]."companycode".$row[code]."  year".$tempyearData." equityShareCapital ".$tempequityShareCapitalData." Reserves ".$tempreservesData." PreferenceShareCapital".$tempPreferenceShareCapitalData." networth ".$tempnetworthData ." Deposits ".$tempDepositsData." Borrowings ".$tempBorrowingsData." TotalDebt ".$tempTotalDebtData." totalClProvisions ".$temptotalClProvisionsData." TotalLiabilities ".$tempTotalLiabilitiesData." cash ".$tempcashData." BalanceWithBanks ".$tempBalanceWithBanksData." Advances ".$tempAdvancesData." Investments ".$tempInvestmentsData." GrossBlock".$tempGrossBlockData." AccumulatedDepreciation ".$tempAccumulatedDepreciationData." NetBlock ".$tempNetBlockData." CapitalWork ".$tempCapitalWorkData." OtherAssets ".$tempOtherAssetsData." TotalAssets ".$tempTotalAssetsData." ContingentLiabilities ".$tempContingentLiabilitiesData." Billsforcollection ".$tempBillsforcollectionData." BookValue ".$tempBookValueData;
			}
	if(!$res)
		{
			//echo "Error inserting sales ". $row[code];
			echo "Error inserting sales ". $row[number].mysqli_error($link);
		}
	}
	//break; //naidu delete this break - was for testing only
echo "after insert of ".$iLoop;
}
	
		
		echo "PROCESSING COMPLETED!!!!!!!";
?>