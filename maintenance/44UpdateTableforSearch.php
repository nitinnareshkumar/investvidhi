<?php
/***********************************************************************************************

Please note that we have to change the year in the query 
***********************************************************************************************/
include("config.inc.php");


set_time_limit(20000);
//$res=mysqli_query($link, "select max(number) as maxi from name_code");
//$result=mysqli_query($link, "select max(number) as maxnum from name_code");
//$row = mysqli_fetch_array($result);
//$iCount= $row[maxnum]; //commented ************************************************************
//$res1=mysqli_query($link, "delete from profit_loss");
$iCount=7184;//hard coded for fetching 100 records.
// Open error log file
		//$res1=mysqli_query($link, "delete from profit_loss");
$myFile = "Profit_Loss_logs.txt";
$fh = fopen($myFile, 'a') or die("can't open file");

$result=mysqli_query($link,"select * from tbl_forsearchonyearlyparameters ");
//loop to parse records
while($row=mysqli_fetch_array($result))
	{
		$searchCompanyNumber =  $row['number'];
		$resultprofit=mysqli_query($link,"select * from profit_loss where companynumber = $searchCompanyNumber and year ='17' ");
		$row1 = mysqli_fetch_array($resultprofit);
		
			$GrossMargin =  intval( $row1['GPmargin'] );
			$OPMargin =  intval($row1['OPMargin'] );
			$NPMargin =  intval($row1['NPMargin'] );
			$SgaUponGp =  intval($row1['SgaUponGp'] );
			$DepUponGp =  intval($row1['DepUponGp'] );
			$IntUponOP =  intval($row1['IntUponOP'] );
		$resultbalancesheet=mysqli_query($link,"select * from balancesheet where companynumber = $searchCompanyNumber and year ='17' ");
		$row2 = mysqli_fetch_array($resultbalancesheet);
			$CurretRatio =  floatval($row2['CurretRatio']);
			$ReturnOnAssests =  intval($row2['ReturnOnAssests'] );
			
			$DebtEquityRatio =  floatval($row2['DebtEquityRatio'] ) ;
			//echo $DebtEquityRatio."---".$row2['DebtEquityRatio']."<br>";
			$DebtUponEarnings =  floatval($row2['DebtUponEarnings']);
			$ReturnOnEquity =  intval($row2['ReturnOnEquity'] );
		$resultSales=mysqli_query($link,"select * from sales where companynumber = $searchCompanyNumber");
		$row3 = mysqli_fetch_array($resultSales);
			$salesGrowth7to8 =  intval($row3['growth7_8'] );
			$salesGrowth8to9 =  intval($row3['growth8_9'] );
			$salesGrowth9to10 =  intval($row3['growth9_10'] );
			$salesGrowth10to11 = intval( $row3['growth10_11'] );
			$salesGrowth11to12 = intval( $row3['growth11_12'] );
			$avgsalesGrowth =  intval($row3['GrowthPer'] );
		$resultprofit=mysqli_query($link, "select * from operating_profit where companynumber = $searchCompanyNumber");
		$row4 = mysqli_fetch_array($resultprofit);
			$profitGrowth7to8 =  intval($row4['growth7_8'] );
			$profitGrowth8to9 =  intval($row4['growth8_9'] );
			$profitGrowth9to10 =  intval($row4['growth9_10'] );
			$profitGrowth10to11 =  intval($row4['growth10_11'] );
			$profitGrowth11to12 = intval( $row4['growth11_12'] );
			$avgProfitGrowth = intval( $row4['GrowthPer'] );
		$resulteps=mysqli_query($link, "select * from eps where companynumber = $searchCompanyNumber");
		$row5 = mysqli_fetch_array($resulteps);
			$epsGrowth7to8 = intval( $row5['growth7_8'] );
			$epsGrowth8to9 =  intval($row5['growth8_9'] );
			$epsGrowth9to10 =  intval($row5['growth9_10'] );
			$epsGrowth10to11 = intval( $row5['growth10_11'] );
			$epsGrowth11to12 = intval( $row5['growth11_12'] );
			$avgepsGrowth = intval( $row5['GrowthPer'] );
			echo $searchCompanyNumber;
		
		$resultUpdate=mysqli_query($link, "update tbl_forsearchonyearlyparameters set  GPmargin = $GrossMargin ,OPMargin = $OPMargin, IntUponOP = $IntUponOP , NPMargin = $NPMargin, SgaUponGp = $SgaUponGp, DepUponGp = $DepUponGp , CurretRatio = $CurretRatio, ReturnOnAssests = $ReturnOnAssests, DebtEquityRatio = $DebtEquityRatio, DebtUponEarnings = $DebtUponEarnings, ReturnOnEquity = $ReturnOnEquity , SalesGrowth7_8 = $salesGrowth7to8 , SalesGrowth8_9 = $salesGrowth8to9 , SalesGrowth9_10 = $salesGrowth9to10 , SalesGrowth10_11 = $salesGrowth10to11 , SalesGrowth11_12 = $salesGrowth11to12 , avgSalesGrowth = $avgsalesGrowth , ProfitGrowth7_8 = $profitGrowth7to8 , ProfitGrowth8_9 = $profitGrowth8to9 , ProfitGrowth9_10 = $profitGrowth9to10 , ProfitGrowth10_11 = $profitGrowth10to11 , ProfitGrowth11_12 = $profitGrowth11to12 , avgProfitGrowth = $avgProfitGrowth  , EPSGrowth7_8 = $epsGrowth7to8 , EPSGrowth8_9 = $epsGrowth8to9 , EPSGrowth9_10 = $epsGrowth9to10 , EPSGrowth10_11 = $epsGrowth10to11 , EPSGrowth11_12 = $epsGrowth11to12 , avgEPSGrowth = $avgepsGrowth where number = $searchCompanyNumber");
		//echo "COmpany#".$searchCompanyNumber."GPmargin".$GrossMargin."OPMargin".$OPMargin." IntUponOP". $IntUponOP." NPMargin". $NPMargin."SgaUponGp". $SgaUponGp."DepUponGp". $DepUponGp." CurretRatio". $CurretRatio."ReturnOnAssests". $ReturnOnAssests."DebtEquityRatio". $DebtEquityRatio."DebtUponEarnings". $DebtUponEarnings."ReturnOnEquity". $ReturnOnEquity." SalesGrowth7_8". $salesGrowth7to8." SalesGrowth8_9". $salesGrowth8to9." SalesGrowth9_10". $salesGrowth9to10." SalesGrowth10_11". $salesGrowth10to11." SalesGrowth11_12". $salesGrowth11to12." avgSalesGrowth". $avgsalesGrowth." ProfitGrowth7_8". $profitGrowth7to8." ProfitGrowth8_9". $profitGrowth8to9." ProfitGrowth9_10". $profitGrowth9to10." ProfitGrowth10_11". $profitGrowth10to11." ProfitGrowth11_12". $profitGrowth11to12." avgProfitGrowth". $avgProfitGrowth ." EPSGrowth7_8". $epsGrowth7to8." EPSGrowth8_9". $epsGrowth8to9." EPSGrowth9_10". $epsGrowth9to10." EPSGrowth10_11". $epsGrowth10to11." EPSGrowth11_12". $epsGrowth11to12." avgEPSGrowth". $avgepsGrowth;
		//break; //naidu delete this break - was for testing only 
	}
	

		
		echo "PROCESSING COMPLETED!!!!!!!";
?>