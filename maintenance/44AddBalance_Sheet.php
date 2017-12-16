<?php
/***********************************************************************************************
this file is to add balance sheet data for 5 years for non banking copanies, it will take whatver data is present,
this file should be run after deleting all data from balance_sheet
***********************************************************************************************/
include("config.inc.php");
set_time_limit(20000);
//$res=mysql_query("select max(number) as maxi from name_code");
$result=mysql_query("select max(number) as maxnum from name_code");
$row = mysql_fetch_array($result);
//$iCount= $row[maxnum]; //commented ************************************************************
$iCount=6495;//hard coded for fetching 100 records.
// Open error log file

$myFile = "BalanceSheet_logs.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
//loop to parse records
for ($iLoop= 6494; $iLoop<($iCount+1);$iLoop++)
{
	$result=mysql_query("select * from name_code where number=$iLoop and Company_type NOT IN ('banks-public-sector','banks-private-sector')");
	//$result=mysql_query("select * from name_code where number=1");
	$row = mysql_fetch_array($result);;
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
	
	$networthData = strstr($filtered_string1,">Networth<");	// This string is repeated before every month	
	$networthData = substr($networthData, 0, strpos($networthData, "</tr>")); // $result = php
	
	$totalDebtData = strstr($filtered_string1,">Total Debt<");	// This string is repeated before every month	
	$totalDebtData = substr($totalDebtData, 0, strpos($totalDebtData, "</tr>")); // $result = php
	
	$grossBlockData = strstr($filtered_string1,">Gross Block<");	// This string is repeated before every month	
	$grossBlockData = substr($grossBlockData, 0, strpos($grossBlockData, "</tr>")); // $result = php
	
	$lessAccumDepcreciationData = strstr($filtered_string1,">Less: Accum. Depreciation<");	// This string is repeated before every month	
	$lessAccumDepcreciationData = substr($lessAccumDepcreciationData, 0, strpos($lessAccumDepcreciationData, "</tr>")); // $result = php
	
	$netBlockData = strstr($filtered_string1,">Net Block<");	// This string is repeated before every month	
	$netBlockData = substr($netBlockData, 0, strpos($netBlockData, "</tr>")); // $result = php
	
	$capitalProgressData = strstr($filtered_string1,">Capital Work in Progress<");	// This string is repeated before every month	
	$capitalProgressData = substr($capitalProgressData, 0, strpos($capitalProgressData, "</tr>")); // $result = php
	
	$totalCALoansAdvancesData = strstr($filtered_string1,">Total CA, Loans & Advances<");	// This string is repeated before every month	
	$totalCALoansAdvancesData = substr($totalCALoansAdvancesData, 0, strpos($totalCALoansAdvancesData, "</tr>")); // $result = php
	
	$totalClProvisionsData = strstr($filtered_string1,">Total CL & Provisions<");	// This string is repeated before every month	
	$totalClProvisionsData = substr($totalClProvisionsData, 0, strpos($totalClProvisionsData, "</tr>")); // $result = php

	$bookvalueData = strstr($filtered_string1,">Book Value (Rs)<");	// This string is repeated before every month	
	$bookvalueData = substr($bookvalueData, 0, strpos($bookvalueData, "</tr>")); // $result = php	
	
			
	
	$reservesData = strstr($filtered_string1,">Reserves<");	// This string is repeated before every month	
	$reservesData = substr($reservesData, 0, strpos($reservesData, "</tr>")); // $result = php

	$securedLoansData = strstr($filtered_string1,">Secured Loans<");	// This string is repeated before every month	
	//$securedLoansData = strstr($securedLoansData,"</tr>", true);
		$securedLoansData = substr($securedLoansData, 0, strpos($securedLoansData, "</tr>")); // $result = php

	$unsecuredLoansData = strstr($filtered_string1,">Unsecured Loans<");	// This string is repeated before every month	
	//$unsecuredLoansData = strstr($unsecuredLoansData,"</tr>",true);
		$unsecuredLoansData = substr($unsecuredLoansData, 0, strpos($unsecuredLoansData, "</tr>")); // $result = php

	$cashData = strstr($filtered_string1,">Cash and Bank Balance<");		
	//$cashData = strstr($cashData,"</tr>",true);
		$cashData = substr($cashData, 0, strpos($cashData, "</tr>")); // $result = php
	
	$fixedDepositData = strstr($filtered_string1,">Fixed Deposits<");		
	//$fixedDepositData = strstr($fixedDepositData,"</tr>",true);
	$fixedDepositData = substr($fixedDepositData, 0, strpos($fixedDepositData, "</tr>")); // $result = php

	$inventoriesData = strstr($filtered_string1,">Inventories<");		
	//$inventoriesData = strstr($inventoriesData,"</tr>",true);
	$inventoriesData = substr($inventoriesData, 0, strpos($inventoriesData, "</tr>")); // $result = php

	$sundryDebtorsData = strstr($filtered_string1,">Sundry Debtors<");		
	//$sundryDebtorsData = strstr($sundryDebtorsData,"</tr>",true);
	$sundryDebtorsData = substr($sundryDebtorsData, 0, strpos($sundryDebtorsData, "</tr>")); // $result = php



	$totalCurrAssetsData = strstr($filtered_string1,">Total Current Assets<");		
	//$totalCurrAssetsData = strstr($totalCurrAssetsData,"</tr>",true);
	$totalCurrAssetsData = substr($totalCurrAssetsData, 0, strpos($totalCurrAssetsData, "</tr>")); // $result = php

	$totalAssetsData = strstr($filtered_string1,">Total Assets<");		
	//$totalAssetsData = strstr($totalAssetsData,"</tr>",true);
	$totalAssetsData = substr($totalAssetsData, 0, strpos($totalAssetsData, "</tr>")); // $result = php

	$loansData = strstr($filtered_string1,">Loans and Advances<");		
	//$loansData = strstr($loansData,"</tr>",true);
	$loansData = substr($loansData, 0, strpos($loansData, "</tr>")); // $result = php

	$currLiabilitiesData = strstr($filtered_string1,">Current Liabilities<");		
	//$currLiabilitiesData = strstr($currLiabilitiesData,"</tr>",true);
	$currLiabilitiesData = substr($currLiabilitiesData, 0, strpos($currLiabilitiesData, "</tr>")); // $result = php

	$provisionsData = strstr($filtered_string1,">Provisions<");		
	//$provisionsData = strstr($provisionsData,"</tr>",true);
	$provisionsData = substr($provisionsData, 0, strpos($provisionsData, "</tr>")); // $result = php

	$investmentsData = strstr($filtered_string1,">Investments<");		
	//$investmentsData = strstr($investmentsData,"</tr>",true);
	$investmentsData = substr($investmentsData, 0, strpos($investmentsData, "</tr>")); // $result = php

	
	for($icnt=1;$icnt<6;$icnt++)
	{
		$yearData = strstr($yearData,"<td align=right class=\"detb brdL brdR\">");		
		$iPos1 = strpos($yearData,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($yearData,"</td>");
		$tempyearData = substr($yearData,($iPos1+44), ($iPos2-$iPos1 -44));           		
		$yearData = strstr($yearData,$tempyearData);
		$arrayyearData[icnt-1] = $tempyearData;

		$reservesData = strstr($reservesData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($reservesData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($reservesData,"</td>");
		$tempreservesData = substr($reservesData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$reservesData = strstr($reservesData,$tempreservesData);
		
		//------------------------
		$equityShareCapitalData = strstr($equityShareCapitalData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($equityShareCapitalData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($equityShareCapitalData,"</td>");
		$tempequityShareCapitalData = substr($equityShareCapitalData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$equityShareCapitalData = strstr($equityShareCapitalData,$tempequityShareCapitalData);
		
		$networthData = strstr($networthData,"<td align=right class=\"detb brdL brdR\">");			
		$iPos1 = strpos($networthData,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($networthData,"</td>");
		$tempnetworthData = substr($networthData,($iPos1+39), ($iPos2-$iPos1 -39));           		
		$networthData = strstr($networthData,$tempnetworthData);
		
		
		$totalDebtData = strstr($totalDebtData,"<td align=right class=\"detb brdL brdR\">");			
		$iPos1 = strpos($totalDebtData,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($totalDebtData,"</td>");
		$temptotalDebtData = substr($totalDebtData,($iPos1+39), ($iPos2-$iPos1 -39));           		
		$totalDebtData = strstr($totalDebtData,$temptotalDebtData);
		
		
		
		$grossBlockData = strstr($grossBlockData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($grossBlockData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($grossBlockData,"</td>");
		$tempgrossBlockData = substr($grossBlockData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$grossBlockData = strstr($grossBlockData,$tempgrossBlockData);
		
		$lessAccumDepcreciationData = strstr($lessAccumDepcreciationData,"<td align=right class=\"det brdL brdR\">");
		echo "less-------------".$lessAccumDepcreciationData."<br>";			
		$iPos1 = strpos($lessAccumDepcreciationData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($lessAccumDepcreciationData,"</td>");
		$templessAccumDepcreciationData = substr($lessAccumDepcreciationData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$lessAccumDepcreciationData = strstr($lessAccumDepcreciationData,$templessAccumDepcreciationData);
		
			$capitalProgressData = strstr($capitalProgressData,"<td align=right class=\"det brdL brdR\">");
		$iPos1 = strpos($capitalProgressData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($capitalProgressData,"</td>");
		$templesscapitalProgressData = substr($capitalProgressData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$capitalProgressData = strstr($capitalProgressData,$templesscapitalProgressData);
		
		$netBlockData = strstr($netBlockData,"<td align=right class=\"detb brdL brdR\">");			
		$iPos1 = strpos($netBlockData,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($netBlockData,"</td>");
		$tempnetBlockData = substr($netBlockData,($iPos1+39), ($iPos2-$iPos1 -39));           		
		$netBlockData = strstr($netBlockData,$tempnetBlockData);
		
		$totalCALoansAdvancesData = strstr($totalCALoansAdvancesData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($totalCALoansAdvancesData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($totalCALoansAdvancesData,"</td>");
		$temptotalCALoansAdvancesData = substr($totalCALoansAdvancesData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$totalCALoansAdvancesData = strstr($totalCALoansAdvancesData,$temptotalCALoansAdvancesData);
		
		$totalClProvisionsData = strstr($totalClProvisionsData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($totalClProvisionsData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($totalClProvisionsData,"</td>");
		$temptotalClProvisionsData = substr($totalClProvisionsData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$totalClProvisionsData = strstr($totalClProvisionsData,$temptotalClProvisionsData);
		
		$bookvalueData  = strstr($bookvalueData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($bookvalueData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($bookvalueData,"</td>");
		$tempbookvalueData = substr($bookvalueData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$bookvalueData = strstr($bookvalueData,$tempbookvalueData);
		
		
		//----------------------------
		
		$securedLoansData = strstr($securedLoansData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($securedLoansData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($securedLoansData,"</td>");
		$tempsecuredLoansData = substr($securedLoansData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$securedLoansData = strstr($securedLoansData,$tempsecuredLoansData);
		
		$unsecuredLoansData = strstr($unsecuredLoansData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($unsecuredLoansData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($unsecuredLoansData,"</td>");
		$tempunsecuredLoansData = substr($unsecuredLoansData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$unsecuredLoansData = strstr($unsecuredLoansData,$tempunsecuredLoansData);

		$cashData = strstr($cashData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($cashData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($cashData,"</td>");
		$tempcashData = substr($cashData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$cashData = strstr($cashData,$tempcashData);
		
		$fixedDepositData = strstr($fixedDepositData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($fixedDepositData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($fixedDepositData,"</td>");
		$tempfixedDepositData = substr($fixedDepositData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$fixedDepositData = strstr($fixedDepositData,$tempfixedDepositData);
		
		$inventoriesData = strstr($inventoriesData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($inventoriesData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($inventoriesData,"</td>");
		$tempinventoriesData = substr($inventoriesData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$inventoriesData = strstr($inventoriesData,$tempinventoriesData);
		
		$sundryDebtorsData = strstr($sundryDebtorsData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($sundryDebtorsData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($sundryDebtorsData,"</td>");
		$tempsundryDebtorsData = substr($sundryDebtorsData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$sundryDebtorsData = strstr($sundryDebtorsData,$tempsundryDebtorsData);
		
		$netWorthData = strstr($netWorthData,"<td align=right class=\"detb brdL brdR\">");			
		$iPos1 = strpos($netWorthData,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($netWorthData,"</td>");
		$tempnetWorthData = substr($netWorthData,($iPos1+39), ($iPos2-$iPos1 -39));           		
		$netWorthData = strstr($netWorthData,$tempnetWorthData);

		$totalCurrAssetsData = strstr($totalCurrAssetsData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($totalCurrAssetsData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($totalCurrAssetsData,"</td>");
		$temptotalCurrAssetsData = substr($totalCurrAssetsData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$totalCurrAssetsData = strstr($totalCurrAssetsData,$temptotalCurrAssetsData);

		$totalAssetsData = strstr($totalAssetsData,"<td align=right class=\"detb brdL brdR\">");			
		$iPos1 = strpos($totalAssetsData,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($totalAssetsData,"</td>");
		$temptotalAssetsData = substr($totalAssetsData,($iPos1+39), ($iPos2-$iPos1 -39));           		
		$totalAssetsData = strstr($totalAssetsData,$temptotalAssetsData);

		$loansData = strstr($loansData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($loansData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($loansData,"</td>");
		$temploansData = substr($loansData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$loansData = strstr($loansData,$temploansData);
		
		$currLiabilitiesData = strstr($currLiabilitiesData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($currLiabilitiesData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($currLiabilitiesData,"</td>");
		$tempcurrLiabilitiesData = substr($currLiabilitiesData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$currLiabilitiesData = strstr($currLiabilitiesData,$tempcurrLiabilitiesData);

		$provisionsData = strstr($provisionsData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($provisionsData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($provisionsData,"</td>");
		$tempprovisionsData = substr($provisionsData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$provisionsData = strstr($provisionsData,$tempprovisionsData);
		
		$investmentsData = strstr($investmentsData,"<td align=right class=\"detb brdL brdR\">");			
		$iPos1 = strpos($investmentsData,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($investmentsData,"</td>");
		$tempinvestmentsData = substr($investmentsData,($iPos1+39), ($iPos2-$iPos1 -39));           		
		$investmentsData = strstr($investmentsData,$tempinvestmentsData);
		
		$patterns =",";
		$replacements1 = '';
		$tempequityShareCapitalData = str_replace($patterns,$replacements1,$tempequityShareCapitalData);
		$tempnetworthData = str_replace($patterns,$replacements1,$tempnetworthData);
		$temptotalDebtData = str_replace($patterns,$replacements1,$temptotalDebtData);
		$tempgrossBlockData = str_replace($patterns,$replacements1,$tempgrossBlockData);
		$templessAccumDepcreciationData = str_replace($patterns,$replacements1,$templessAccumDepcreciationData);
		$templesscapitalProgressData = str_replace($patterns,$replacements1,$templesscapitalProgressData);
		$tempnetBlockData = str_replace($patterns,$replacements1,$tempnetBlockData);
		$temptotalCALoansAdvancesData = str_replace($patterns,$replacements1,$temptotalCALoansAdvancesData);
		$temptotalClProvisionsData = str_replace($patterns,$replacements1,$temptotalClProvisionsData);
		$tempbookvalueData = str_replace($patterns,$replacements1,$tempbookvalueData);
		$tempreservesData = str_replace($patterns,$replacements1,$tempreservesData);
		$tempsecuredLoansData = str_replace($patterns,$replacements1,$tempsecuredLoansData);
		$tempunsecuredLoansData = str_replace($patterns,$replacements1,$tempunsecuredLoansData);
		$tempcashData = str_replace($patterns,$replacements1,$tempcashData);
		$tempfixedDepositData = str_replace($patterns,$replacements1,$tempfixedDepositData);
		$tempinventoriesData = str_replace($patterns,$replacements1,$tempinventoriesData);
		$tempsundryDebtorsData = str_replace($patterns,$replacements1,$tempsundryDebtorsData);
		$temptotalCurrAssetsData = str_replace($patterns,$replacements1,$temptotalCurrAssetsData);
		$temptotalAssetsData = str_replace($patterns,$replacements1,$temptotalAssetsData);
		$temploansData = str_replace($patterns,$replacements1,$temploansData);
		$tempcurrLiabilitiesData = str_replace($patterns,$replacements1,$tempcurrLiabilitiesData);
		$tempprovisionsData = str_replace($patterns,$replacements1,$tempprovisionsData);
		$tempinvestmentsData = str_replace($patterns,$replacements1,$tempinvestmentsData);
		//calculation ratios
		if ( ($tempnetworthData == "NA" ) || ($tempnetworthData == "--" ) || ( $tempnetworthData == "0.00" ) || ( $tempnetworthData == "" ))
		{
			$debtequityratio= "" ;
		}
		else
		{
		$debtequityratio = $temptotalDebtData / $tempnetworthData ;
	
		}
		
			if ( ($temptotalClProvisionsData == "NA" ) || ($temptotalClProvisionsData == "--" ) || ( $temptotalClProvisionsData == "0.00" ) || ( $temptotalClProvisionsData == "" ))
		{
			$currentratio= "" ;
		}
		else
		{
		$currentratio = $temptotalCALoansAdvancesData / $temptotalClProvisionsData ;
	
		}
		
		$getnetprofit=mysql_query("select * from profit_loss where companynumber  = '$row[number]' and year = '$tempyearData'");
	//$result=mysql_query("select * from name_code where number=1");
	$row1 = mysql_fetch_array($getnetprofit);;
	$tempnetprofit = $row1['netProfit'];
	
	echo "netprofit is ".$tempnetprofit."---";
		
		if ( ($temptotalAssetsData == "NA" ) || ($temptotalAssetsData == "--" ) || ( $temptotalAssetsData == "0.00" ) || ( $temptotalAssetsData == "" ))
		{
			$tempReturnOnAssests = "" ;
		}
		else
		{
		$tempReturnOnAssests = $tempnetprofit / $temptotalAssetsData * 100 ;
		}
		
			if ( ($tempnetprofit == "NA" ) || ($tempnetprofit == "--" ) || ( $tempnetprofit == "0.00" ) || ( $tempnetprofit == "" ))
		{
			$tempDebtUponEarnings = "" ;
		}
		else
		{
		$tempDebtUponEarnings = $temptotalDebtData / $tempnetprofit ;
		}
		
			if ( ($tempnetworthData == "NA" ) || ($tempnetworthData == "--" ) || ( $tempnetworthData == "0.00" ) || ( $tempnetworthData == "" ))
		{
			$tempReturnOnEquity  = "" ;
		}
		else
		{
		$tempReturnOnEquity = $tempnetprofit / $tempnetworthData * 100;			
		}

		$debtequityratio = round($debtequityratio, 2);
		$currentratio = round($currentratio, 2); 
		$tempDebtUponEarnings = round($tempDebtUponEarnings, 2); 
		$tempReturnOnEquity = intval( $tempReturnOnEquity );
		$tempReturnOnAssests = intval( $tempReturnOnAssests );

		// end of ratios
		if ($tempyearData != NULL) 
			{
				$res=mysql_query("insert into balanceSheet set companynumber='$row[number]',companycode= '$row[code]',  year='$tempyearData', equityShareCapital = '$tempequityShareCapitalData' , networth ='$tempnetworthData' , totalDebt ='$temptotalDebtData' , grossBlock ='$tempgrossBlockData' , lessAccumDepcreciation ='$templessAccumDepcreciationData' , netBlock= '$tempnetBlockData' ,CapitalProgress ='$templesscapitalProgressData' , totalCALoansAdvances='$temptotalCALoansAdvancesData' , totalClProvisions ='$temptotalClProvisionsData ' , bookvalue='$tempbookvalueData',reserves ='$tempreservesData', securedLoans ='$tempsecuredLoansData',	unsecuredLoans ='$tempunsecuredLoansData',	cash ='$tempcashData',	fixedDeposit ='$tempfixedDepositData',	inventories ='$tempinventoriesData',	sundryDebtors ='$tempsundryDebtorsData',		totalCurrAssets ='$temptotalCurrAssetsData',	totalAssets ='$temptotalAssetsData',	loans ='$temploansData',	currLiabilities = '$tempcurrLiabilitiesData',	provisions = '$tempprovisionsData',	investments = '$tempinvestmentsData' , CurretRatio = '$currentratio' , DebtEquityRatio = '$debtequityratio' , ReturnOnAssests ='$tempReturnOnAssests' , DebtUponEarnings = '$tempDebtUponEarnings' , ReturnOnEquity = '$tempReturnOnEquity'");
			}
	if(!$res)
		{
			//echo "Error inserting sales ". $row[code];
			echo "Error inserting sales ". $row[number].mysql_error();
		}
	}
	
echo "after insert of ".$iLoop;
}
	
		
		echo "PROCESSING COMPLETED!!!!!!!";
?>