<?php
/***********************************************************************************************
this file is to add profit and loss data for 5 years , it will take whatver data is present,
this file should be run after deleting all data from profit_loss
***********************************************************************************************/
include("config.inc.php");


set_time_limit(20000);
//$res=mysql_query("select max(number) as maxi from name_code");
//$result=mysql_query("select max(number) as maxnum from name_code");
//$row = mysql_fetch_array($result);
//$iCount= $row[maxnum]; //commented ************************************************************
//$res1=mysql_query("delete from profit_loss");
$iCount=19081;//hard coded for fetching 100 records.?//naidu - uncomment  to delete old data
// Open error log file
		//$res1=mysql_query("delete from profit_loss");
$myFile = "Profit_Loss_logs.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
//loop to parse records
for ($iLoop= 19081; $iLoop<($iCount+1);$iLoop++)
{
	$result=mysqli_query($link, "select * from name_code where number=$iLoop and Company_type NOT IN ('banks-public-sector','banks-private-sector')");
	//$result=mysql_query("select * from name_code where number=1");
	$row = mysqli_fetch_array($result);;
	$moneycontrol_code = $row['code'];
	$UrlName="http://www.moneycontrol.com/stocks/company_info/print_financials.php?sc_did=$moneycontrol_code&type=profit";
	//echo $UrlName."<br>";
	
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
	$salesTurnoverData = strstr($filtered_string1,"Sales Turnover");	// This string is repeated before every month
	$salesTurnoverData = substr($salesTurnoverData, 0, strpos($salesTurnoverData, "</tr>")); // $result = php
	
	$ExciseDutyData = strstr($filtered_string1,">Excise Duty<");	// This string is repeated before every month	
	//$ExciseDutyData = strstr($ExciseDutyData,"</tr>", true);
	$ExciseDutyData = substr($ExciseDutyData, 0, strpos($ExciseDutyData, "</tr>")); // $result = php

	$netSalesData = strstr($filtered_string1,">Net Sales<");	// This string is repeated before every month	
	//$netSalesData = strstr($netSalesData,"</tr>",true);
		$netSalesData = substr($netSalesData, 0, strpos($netSalesData, "</tr>")); // $result = php

	$otherIncomeData = strstr($filtered_string1,">Other Income<");		
	//$otherIncomeData = strstr($otherIncomeData,"</tr>",true);
			$otherIncomeData = substr($otherIncomeData, 0, strpos($otherIncomeData, "</tr>")); // $result = php

			


	$stockAdjData = strstr($filtered_string1,">Stock Adjustments<");		
	//$stockAdjData = strstr($stockAdjData,"</tr>",true);
				$stockAdjData = substr($stockAdjData, 0, strpos($stockAdjData, "</tr>")); // $result = php

	$totalIncomeData = strstr($filtered_string1,">Total Income<");		
	//$totalIncomeData = strstr($totalIncomeData,"</tr>",true);
					$totalIncomeData = substr($totalIncomeData, 0, strpos($totalIncomeData, "</tr>")); // $result = php

	$rawMaterialData = strstr($filtered_string1,">Raw Materials<");		
	//$rawMaterialData = strstr($rawMaterialData,"</tr>",true);
						$rawMaterialData = substr($rawMaterialData, 0, strpos($rawMaterialData, "</tr>")); // $result = php

	$powerFuelData = strstr($filtered_string1,">Power & Fuel Cost<");		
	//$powerFuelData = strstr($powerFuelData,"</tr>",true);
	
						$powerFuelData = substr($powerFuelData, 0, strpos($powerFuelData, "</tr>")); // $result = php

	$employeeCostData = strstr($filtered_string1,">Employee Cost<");		
	//$employeeCostData = strstr($employeeCostData,"</tr>",true);
							$employeeCostData = substr($employeeCostData, 0, strpos($employeeCostData, "</tr>")); // $result = php

	$otherManuCostData = strstr($filtered_string1,">Other Manufacturing Expenses<");		
	//$otherManuCostData = strstr($otherManuCostData,"</tr>",true);
								$otherManuCostData = substr($otherManuCostData, 0, strpos($otherManuCostData, "</tr>")); // $result = php

	$sGACostData = strstr($filtered_string1,">Selling and Admin Expenses<");		
	//$sGACostData = strstr($sGACostData,"</tr>",true);
									$sGACostData = substr($sGACostData, 0, strpos($sGACostData, "</tr>")); // $result = php

	$miscCostData = strstr($filtered_string1,">Miscellaneous Expenses<");		
	//$miscCostData = strstr($miscCostData,"</tr>",true);
	$miscCostData = substr($miscCostData, 0, strpos($miscCostData, "</tr>")); // $result = php

	$preopExpCostData = strstr($filtered_string1,">Preoperative Exp Capitalised<");		
	//$preopExpCostData = strstr($preopExpCostData,"</tr>",true);
		$preopExpCostData = substr($preopExpCostData, 0, strpos($preopExpCostData, "</tr>")); // $result = php

	$totalExpData = strstr($filtered_string1,">Total Expenses<");		
	//$totalExpData = strstr($totalExpData,"</tr>",true);
		$totalExpData = substr($totalExpData, 0, strpos($totalExpData, "</tr>")); // $result = php
	
	$PBDITData = strstr($filtered_string1,">PBDIT<");		
	//$PBDITData = strstr($PBDITData,"</tr>",true);
			$PBDITData = substr($PBDITData, 0, strpos($PBDITData, "</tr>")); // $result = php

	$interestData = strstr($filtered_string1,">Interest<");		
	//$interestData = strstr($interestData,"</tr>",true);
				$interestData = substr($interestData, 0, strpos($interestData, "</tr>")); // $result = php

	$depreciationData = strstr($filtered_string1,">Depreciation<");		
	//$depreciationData = strstr($depreciationData,"</tr>",true);
					$depreciationData = substr($depreciationData, 0, strpos($depreciationData, "</tr>")); // $result = php
	
	$PBTData = strstr($filtered_string1,">Profit Before Tax<");		
	//$PBTData = strstr($PBTData,"</tr>",true);
	$PBTData = substr($PBTData, 0, strpos($PBTData, "</tr>")); // $result = php

	$netProfitData = strstr($filtered_string1,">Reported Net Profit<");		
	//$netProfitData = strstr($netProfitData,"</tr>",true);
	$netProfitData = substr($netProfitData, 0, strpos($netProfitData, "</tr>")); // $result = php

	$sharesIssuedData = strstr($filtered_string1,">Shares in issue (lakhs)<");		
	//$sharesIssuedData = strstr($sharesIssuedData,"</tr>",true);
	$sharesIssuedData = substr($sharesIssuedData, 0, strpos($sharesIssuedData, "</tr>")); // $result = php

	$EPSData = strstr($filtered_string1,">Earning Per Share (Rs)<");		
	//$EPSData = strstr($EPSData,"</tr>",true);
	$EPSData = substr($EPSData, 0, strpos($EPSData, "</tr>")); // $result = php

	$equityDividendsData = strstr($filtered_string1,">Equity Dividend (%)<");		
	//$equityDividendsData = strstr($equityDividendsData,"</tr>",true);
	$equityDividendsData = substr($equityDividendsData, 0, strpos($equityDividendsData, "</tr>")); // $result = php

	$bookValueData = strstr($filtered_string1,">Book Value (Rs)<");		
	//$bookValueData = strstr($bookValueData,"</tr>",true);
	$bookValueData = substr($bookValueData, 0, strpos($bookValueData, "</tr>")); // $result = php

	
	for($icnt=1;$icnt<6;$icnt++)
	{
		$yearData = strstr($yearData,"<td align=right class=\"detb brdL brdR\">");	
		$iPos1 = strpos($yearData,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($yearData,"</td>");
		$tempyearData = substr($yearData,($iPos1+44), ($iPos2-$iPos1 -44));  
		$yearData = strstr($yearData,$tempyearData);
		$arrayyearData[icnt-1] = $tempyearData;
		//Sales turnover
		$salesTurnoverData = strstr($salesTurnoverData,"<td align=right class=\"det brdL brdR\">");			
		$iPos1 = strpos($salesTurnoverData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($salesTurnoverData,"</td>");
		$tempsalesTurnoverData = substr($salesTurnoverData,($iPos1+38), ($iPos2-$iPos1 -38));           		
		$salesTurnoverData = strstr($salesTurnoverData,$tempsalesTurnoverData);
		$arraysalesTurnoverData[icnt-1] = $tempsalesTurnoverData;
		$ExciseDutyData = strstr($ExciseDutyData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($ExciseDutyData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($ExciseDutyData,"</td>");
		$tempExciseDutyData = substr($ExciseDutyData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$ExciseDutyData = strstr($ExciseDutyData,$tempExciseDutyData);
		
		$netSalesData = strstr($netSalesData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($netSalesData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($netSalesData,"</td>");
		$tempnetSalesData = substr($netSalesData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$netSalesData = strstr($netSalesData,$tempnetSalesData);
		
		$otherIncomeData = strstr($otherIncomeData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($otherIncomeData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($otherIncomeData,"</td>");
		$tempotherIncomeData = substr($otherIncomeData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$otherIncomeData = strstr($otherIncomeData,$tempotherIncomeData);
		
		$stockAdjData = strstr($stockAdjData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($stockAdjData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($stockAdjData,"</td>");
		$tempstockAdjData = substr($stockAdjData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$stockAdjData = strstr($stockAdjData,$tempstockAdjData);
		
		$totalIncomeData = strstr($totalIncomeData,"<td align=right class=\"detb brdL brdR\">");		
		$iPos1 = strpos($totalIncomeData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($totalIncomeData,"</td>");
		$temptotalIncomeData = substr($totalIncomeData,($iPos1+39), ($iPos2-$iPos1 -39));           
		$totalIncomeData = strstr($totalIncomeData,$temptotalIncomeData);
		$rawMaterialData = strstr($rawMaterialData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($rawMaterialData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($rawMaterialData,"</td>");
		$temprawMaterialData = substr($rawMaterialData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$rawMaterialData = strstr($rawMaterialData,$temprawMaterialData);
		
		$powerFuelData = strstr($powerFuelData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($powerFuelData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($powerFuelData,"</td>");
		$temppowerFuelData = substr($powerFuelData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$powerFuelData = strstr($powerFuelData,$temppowerFuelData);
		
		$employeeCostData = strstr($employeeCostData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($employeeCostData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($employeeCostData,"</td>");
		$tempemployeeCostData = substr($employeeCostData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$employeeCostData = strstr($employeeCostData,$tempemployeeCostData);
		
		$otherManuCostData = strstr($otherManuCostData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($otherManuCostData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($otherManuCostData,"</td>");
		$tempotherManuCostData = substr($otherManuCostData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$otherManuCostData = strstr($otherManuCostData,$tempotherManuCostData);
		
		$sGACostData = strstr($sGACostData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($sGACostData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($sGACostData,"</td>");
		$tempsGACostData = substr($sGACostData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$sGACostData = strstr($sGACostData,$tempsGACostData);
		
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
		
		$totalExpData = strstr($totalExpData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($totalExpData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($totalExpData,"</td>");
		$temptotalExpData = substr($totalExpData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$totalExpData = strstr($totalExpData,$temptotalExpData);
		
		$PBDITData = strstr($PBDITData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($PBDITData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($PBDITData,"</td>");
		$tempPBDITData = substr($PBDITData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$PBDITData = strstr($PBDITData,$tempPBDITData);
		
		$interestData = strstr($interestData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($interestData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($interestData,"</td>");
		$tempinterestData = substr($interestData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$interestData = strstr($interestData,$tempinterestData);
		
		$depreciationData = strstr($depreciationData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($depreciationData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($depreciationData,"</td>");
		$tempdepreciationData = substr($depreciationData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$depreciationData = strstr($depreciationData,$tempdepreciationData);
		
		$PBTData = strstr($PBTData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($PBTData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($PBTData,"</td>");
		$tempPBTData = substr($PBTData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$PBTData = strstr($PBTData,$tempPBTData);
		
		$netProfitData = strstr($netProfitData,"<td align=right class=\"detb brdL brdR\">");		
		$iPos1 = strpos($netProfitData,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($netProfitData,"</td>");
		$tempnetProfitData = substr($netProfitData,($iPos1+39), ($iPos2-$iPos1 -39));           
		$netProfitData = strstr($netProfitData,$tempnetProfitData);
		
		$sharesIssuedData = strstr($sharesIssuedData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($sharesIssuedData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($sharesIssuedData,"</td>");
		$tempsharesIssuedData = substr($sharesIssuedData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$sharesIssuedData = strstr($sharesIssuedData,$tempsharesIssuedData);
		
		$EPSData = strstr($EPSData,"<td align=right class=\"detb brdL brdR\">");		
		$iPos1 = strpos($EPSData,"<td align=right class=\"detb brdL brdR\">");
		$iPos2 = strpos($EPSData,"</td>");
		$tempEPSData = substr($EPSData,($iPos1+39), ($iPos2-$iPos1 -39));           
		$EPSData = strstr($EPSData,$tempEPSData);
		
		$equityDividendsData = strstr($equityDividendsData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($equityDividendsData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($equityDividendsData,"</td>");
		$tempequityDividendsData = substr($equityDividendsData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$equityDividendsData = strstr($equityDividendsData,$tempequityDividendsData);
		
		$bookValueData = strstr($bookValueData,"<td align=right class=\"det brdL brdR\">");		
		$iPos1 = strpos($bookValueData,"<td align=right class=\"det brdL brdR\">");
		$iPos2 = strpos($bookValueData,"</td>");
		$tempbookValueData = substr($bookValueData,($iPos1+38), ($iPos2-$iPos1 -38));           
		$bookValueData = strstr($bookValueData,$tempbookValueData);
			$patterns =",";
		$replacements1 = '';
		$temptotalIncomeData = str_replace($patterns,$replacements1,$temptotalIncomeData);
		$temprawMaterialData = str_replace($patterns,$replacements1,$temprawMaterialData);
		$temppowerFuelData = str_replace($patterns,$replacements1,$temppowerFuelData);
		$tempemployeeCostData = str_replace($patterns,$replacements1,$tempemployeeCostData);
		$tempotherManuCostData = str_replace($patterns,$replacements1,$tempotherManuCostData);
		$tempPBDITData = str_replace($patterns,$replacements1,$tempPBDITData);
		$tempdepreciationData = str_replace($patterns,$replacements1,$tempdepreciationData);
		
		//---------remove comma-------
		$tempsalesTurnoverData = str_replace($patterns,$replacements1,$tempsalesTurnoverData);
		$tempExciseDutyData = str_replace($patterns,$replacements1,$tempExciseDutyData);
		$tempnetSalesData = str_replace($patterns,$replacements1,$tempnetSalesData);
		$tempotherIncomeData = str_replace($patterns,$replacements1,$tempotherIncomeData);
		$tempstockAdjData = str_replace($patterns,$replacements1,$tempstockAdjData);
		$temptotalIncomeData = str_replace($patterns,$replacements1,$temptotalIncomeData);
		$temprawMaterialData = str_replace($patterns,$replacements1,$temprawMaterialData);
		$temppowerFuelData = str_replace($patterns,$replacements1,$temppowerFuelData);
		
		$tempemployeeCostData = str_replace($patterns,$replacements1,$tempemployeeCostData);
		$tempotherManuCostData = str_replace($patterns,$replacements1,$tempotherManuCostData);
		$tempsGACostData = str_replace($patterns,$replacements1,$tempsGACostData);
		$tempmiscCostData = str_replace($patterns,$replacements1,$tempmiscCostData);
		$temppreopExpCostData = str_replace($patterns,$replacements1,$temppreopExpCostData);
		$temptotalExpData = str_replace($patterns,$replacements1,$temptotalExpData);
		
		$tempPBDITData = str_replace($patterns,$replacements1,$tempPBDITData);
		$tempinterestData = str_replace($patterns,$replacements1,$tempinterestData);
		$tempdepreciationData = str_replace($patterns,$replacements1,$tempdepreciationData);
		$tempPBTData = str_replace($patterns,$replacements1,$tempPBTData);
		$tempnetProfitData = str_replace($patterns,$replacements1,$tempnetProfitData);
		
		$tempEPSData = str_replace($patterns,$replacements1,$tempEPSData);
		$tempequityDividendsData = str_replace($patterns,$replacements1,$tempequityDividendsData);
		$tempGrossProfit = str_replace($patterns,$replacements1,$tempGrossProfit);
		$tempoperatingProfit = str_replace($patterns,$replacements1,$tempoperatingProfit);
		$tempsharesIssuedData = str_replace($patterns,$replacements1,$tempsharesIssuedData);
		$tempbookValueData = str_replace($patterns,$replacements1,$tempbookValueData);
		//----------------------------------

		$tempGrossProfit = $temptotalIncomeData-($temprawMaterialData + $temppowerFuelData + $tempemployeeCostData ); 
		$tempoperatingProfit = $tempPBDITData - $tempdepreciationData;
		
		if ( ($tempsalesTurnoverData == "NA" ) || ($tempsalesTurnoverData == "--" ) || ( $tempsalesTurnoverData == "0.00" ) || ( $tempsalesTurnoverData == "" ))
		{
			$GPMargin= "" ;
			$OPMargin= "" ;
			$NPMargin= "" ;
		}
		else
		{
		$GPMargin = $tempGrossProfit / $tempsalesTurnoverData * 100;
		$OPMargin = $tempoperatingProfit / $tempsalesTurnoverData * 100;
		$NPMargin = $tempnetProfitData / $tempsalesTurnoverData * 100;
		}
		
				if ( ($tempGrossProfit == "NA" ) || ($tempGrossProfit == "--" ) || ( $tempGrossProfit == "0.00" ) || ( $tempGrossProfit == "" ))
		{
			$SGAuponGp= "" ;
		}
		else
		{
		$SGAuponGp = $tempsGACostData / $tempGrossProfit * 100;
		$SGAuponGp = 'NA';
		$DepuponGp= $tempdepreciationData  / $tempGrossProfit * 100;
		}

		if ( ($tempoperatingProfit == "NA" ) || ($tempoperatingProfit == "--" ) || ( $tempoperatingProfit == "0.00" ) || ( $tempGrossProfit == "" ))
		{
			$IntupoonOp= "" ;
		}
		else
		{
		$IntupoonOp = $tempinterestData / $tempoperatingProfit * 100;
		}

$GPMargin = intval( $GPMargin );
$OPMargin = intval( $OPMargin );
$NPMargin = intval( $NPMargin );
//$SGAuponGp = intval( $SGAuponGp );
$DepuponGp = intval( $DepuponGp );
$IntupoonOp = intval( $IntupoonOp );



		if ($tempyearData != NULL) 
			{
			//echo "insert into profit_loss set  companynumber='$row[number]',companycode= '$row[code]', year='$tempyearData', salesTurnover='$tempsalesTurnoverData',	ExciseDuty='$tempExciseDutyData',	netSales='$tempnetSalesData',	otherIncome='$tempotherIncomeData',	stockAdj='$tempstockAdjData',	totalIncome='$temptotalIncomeData',	rawMaterial='$temprawMaterialData',	powerFuel='$temppowerFuelData',	employeeCost='$tempemployeeCostData',	otherManuCost='$tempotherManuCostData',	sGACost='$tempsGACostData',	miscCost='$tempmiscCostData',	preopExpCost='$temppreopExpCostData',	totalExp='$temptotalExpData',	PBDIT='$tempPBDITData',	interest='$tempinterestData',	depreciation='$tempdepreciationData',	PBT='$tempPBTData',	netProfit='$tempnetProfitData',	sharesIssued='$tempsharesIssuedData',	EPS='$tempEPSData',	equityDividends='$tempequityDividendsData',	bookValue='$tempbookValueData', grossProfit='$tempGrossProfit', operatingProfit='$tempoperatingProfit' , GPmargin = '$GPMargin' , SgaUponGp = '$SGAuponGp' , DepUponGp ='$DepuponGp' , OPMargin	='$OPMargin', IntUponOP = '$IntupoonOp' , NPMargin = '$NPMargin'";

			$res=mysqli_query($link,"insert into profit_loss set  companynumber='$row[number]',companycode= '$row[code]', year='$tempyearData', salesTurnover='$tempsalesTurnoverData',	ExciseDuty='$tempExciseDutyData',	netSales='$tempnetSalesData',	otherIncome='$tempotherIncomeData',	stockAdj='$tempstockAdjData',	totalIncome='$temptotalIncomeData',	rawMaterial='$temprawMaterialData',	powerFuel='$temppowerFuelData',	employeeCost='$tempemployeeCostData',	otherManuCost='$tempotherManuCostData',	sGACost='$tempsGACostData',	miscCost='$tempmiscCostData',	preopExpCost='$temppreopExpCostData',	totalExp='$temptotalExpData',	PBDIT='$tempPBDITData',	interest='$tempinterestData',	depreciation='$tempdepreciationData',	PBT='$tempPBTData',	netProfit='$tempnetProfitData',	sharesIssued='$tempsharesIssuedData',	EPS='$tempEPSData',	equityDividends='$tempequityDividendsData',	bookValue='$tempbookValueData', grossProfit='$tempGrossProfit', operatingProfit='$tempoperatingProfit' , GPmargin = '$GPMargin' , SgaUponGp = '$SGAuponGp' , DepUponGp ='$DepuponGp' , OPMargin	='$OPMargin', IntUponOP = '$IntupoonOp' , NPMargin = '$NPMargin'"); //naidu uncomment
			//echo "companynumber=".$row[number]."companycode= ".$row[code]."year=".$tempyearData.", salesTurnover=".$tempsalesTurnoverData.",	ExciseDuty=".$tempExciseDutyData.",	netSales=".$tempnetSalesData.",	otherIncome=".$tempotherIncomeData."stockAdj=".$tempstockAdjData."totalIncome=".$temptotalIncomeData.",	rawMaterial=".$temprawMaterialData."powerFuel=".$temppowerFuelData."	employeeCost=".$tempemployeeCostData."	otherManuCost=".$tempotherManuCostData."	sGACost=".$tempsGACostData."	miscCost=".$tempmiscCostData."	preopExpCost=".$temppreopExpCostData."	totalExp=".$temptotalExpData."	PBDIT=".$tempPBDITData."	interest=".$tempinterestData."	depreciation=".$tempdepreciationData."	PBT=".$tempPBTData."	netProfit=".$tempnetProfitData."	sharesIssued=".$tempsharesIssuedData."	EPS=".$tempEPSData."	equityDividends=".$tempequityDividendsData."	bookValue=".$tempbookValueData." grossProfit=".$tempGrossProfit." operatingProfit=".$tempoperatingProfit." GPmargin = ".$GPMargin."SgaUponGp = ".$SGAuponGp."DepUponGp =".$DepuponGp."OPMargin	=".$OPMargin." IntUponOP = ".$IntupoonOp."NPMargin = ".$NPMargin;
			}
		if(!$res)
		{
			//echo "Error inserting sales ". $row[code];
			echo "Error inserting sales ". $row[number].mysqli_error();
		}
	
	} 

echo "after insert of ".$iLoop;
}
		
//		fclose($fh);
//} //For loop closing brace
		
		echo "PROCESSING COMPLETED!!!!!!!";
?>