<?php
/***********************************************************************************************

Please note that we have to change the year in the query 
Note: The average growth is considered from 2009.
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

$result=mysqli_query($link,"select * from name_code");
//loop to parse records
$iCount=0;
while($row=mysqli_fetch_array($result))
	{
		$searchCompanyNumber =  $row['number'];
		
		$resultprofit=mysqli_query($link,"select * from profit_loss where companynumber = $searchCompanyNumber and year ='18' ");
		$row1 = mysqli_fetch_array($resultprofit);
		
			$GrossMargin =  floatval( $row1['GPmargin'] );
			$OPMargin =  floatval($row1['OPMargin'] );
			$NPMargin =  floatval($row1['NPMargin'] );
			$SgaUponGp =  floatval($row1['SgaUponGp'] );
			$DepUponGp =  floatval($row1['DepUponGp'] );
			$IntUponOP =  floatval($row1['IntUponOP'] );
		$resultbalancesheet=mysqli_query($link,"select * from balancesheet where companynumber = $searchCompanyNumber and year ='18' ");
		$row2 = mysqli_fetch_array($resultbalancesheet);
			$CurretRatio =  floatval($row2['CurretRatio']);
			$ReturnOnAssests =  floatval($row2['ReturnOnAssests'] );
			
			$DebtEquityRatio =  floatval($row2['DebtEquityRatio'] ) ;
			//echo $DebtEquityRatio."---".$row2['DebtEquityRatio']."<br>";
			$DebtUponEarnings =  floatval($row2['DebtUponEarnings']);
			$ReturnOnEquity =  floatval($row2['ReturnOnEquity'] );
		$resultSales=mysqli_query($link,"select * from sales where companynumber = $searchCompanyNumber");
		$row3 = mysqli_fetch_array($resultSales);
			//$salesGrowth12to13 =  floatval($row3['growth12_13'] );
			$salesGrowth13to14 =  floatval($row3['growth13_14'] );
			$salesGrowth14to15 =  floatval($row3['growth14_15'] );
			$salesGrowth15to16 =  floatval($row3['growth15_16'] );
			$salesGrowth16to17 = floatval( $row3['growth16_17'] );
			$salesGrowth17to18 = floatval( $row3['growth17_18'] );
			$avgsalesGrowth =  floatval($row3['GrowthPer'] );
			//echo "Sales%".$row3['GrowthPer'].<br/>;
			//echo "Salesfloatvalue".$avgsalesGrowth;
			$searchCompanyCode =  $row3['companycode'];
			echo "bittu".$searchCompanyCode;
		$resultprofit=mysqli_query($link, "select * from operating_profit where companynumber = $searchCompanyNumber");
		$row4 = mysqli_fetch_array($resultprofit);
			//$profitGrowth12to13 =  floatval($row4['growth12_13'] );
			$profitGrowth13to14 =  floatval($row4['growth13_14'] );
			$profitGrowth14to15 =  floatval($row4['growth14_15'] );
			$profitGrowth15to16 =  floatval($row4['growth15_16'] );
			$profitGrowth16to17 =  floatval($row4['growth16_17'] );
			$profitGrowth17to18 = floatval( $row4['growth17_18'] );
			$avgProfitGrowth = floatval( $row4['GrowthPer'] );
		$resulteps=mysqli_query($link, "select * from eps where companynumber = $searchCompanyNumber");
		$row5 = mysqli_fetch_array($resulteps);
			//$epsGrowth12to13 = floatval( $row5['growth12_13'] );
			$epsGrowth13to14 = floatval( $row5['growth13_14'] );
			$epsGrowth14to15 =  floatval($row5['growth14_15'] );
			$epsGrowth15to16 =  floatval($row5['growth15_16'] );
			$epsGrowth16to17 = floatval( $row5['growth16_17'] );
			$epsGrowth17to18 = floatval( $row5['growth17_18'] );
			$avgepsGrowth = floatval( $row5['GrowthPer'] );
			//echo $searchCompanyNumber;

			//$resultinsert=mysqli_query($link,"insert into tbl_forsearchonyearlyparameters (name) values ())
		$resultUpdate=mysqli_query($link, "insert into tbl_forsearchonyearlyparameters set  name = '$searchCompanyCode', number =$searchCompanyNumber,  GPmargin = $GrossMargin ,OPMargin = $OPMargin, IntUponOP = $IntUponOP , NPMargin = $NPMargin, SgaUponGp = $SgaUponGp, DepUponGp = $DepUponGp , CurretRatio = $CurretRatio, ReturnOnAssests = $ReturnOnAssests, DebtEquityRatio = $DebtEquityRatio, DebtUponEarnings = $DebtUponEarnings, ReturnOnEquity = $ReturnOnEquity  ,SalesGrowth13_14 = $salesGrowth13to14 , SalesGrowth14_15 = $salesGrowth14to15 , SalesGrowth15_16 = $salesGrowth15to16 , SalesGrowth16_17 = $salesGrowth16to17 , SalesGrowth17_18 = $salesGrowth17to18 , avgSalesGrowth = $avgsalesGrowth , ProfitGrowth13_14 = $profitGrowth13to14 , ProfitGrowth14_15 = $profitGrowth14to15 , ProfitGrowth15_16 = $profitGrowth15to16 , ProfitGrowth16_17 = $profitGrowth16to17 , ProfitGrowth17_18 = $profitGrowth17to18 , avgProfitGrowth = $avgProfitGrowth  , EPSGrowth13_14 = $epsGrowth13to14 , EPSGrowth14_15 = $epsGrowth14to15 , EPSGrowth15_16 = $epsGrowth15to16 , EPSGrowth16_17 = $epsGrowth16to17 , EPSGrowth17_18 = $epsGrowth17to18 , avgEPSGrowth = $avgepsGrowth");
	
		//echo "number =".$searchCompanyNumber.", name=".$searchCompanyCode."GPmargin = $GrossMargin ,OPMargin = $OPMargin, IntUponOP = $IntUponOP , NPMargin = $NPMargin, SgaUponGp = $SgaUponGp, DepUponGp = $DepUponGp , CurretRatio = $CurretRatio, ReturnOnAssests = $ReturnOnAssests, DebtEquityRatio = $DebtEquityRatio, DebtUponEarnings = $DebtUponEarnings, ReturnOnEquity = $ReturnOnEquity  ,SalesGrowth13_14 = $salesGrowth13to14 , SalesGrowth14_15 = $salesGrowth14to15 , SalesGrowth15_16 = $salesGrowth15to16 , SalesGrowth16_17 = $salesGrowth16to17 , SalesGrowth17_18 = $salesGrowth17to18 , avgSalesGrowth = $avgsalesGrowth , ProfitGrowth13_14 = $profitGrowth13to14 , ProfitGrowth14_15 = $profitGrowth14to15 , ProfitGrowth15_16 = $profitGrowth15to16 , ProfitGrowth16_17 = $profitGrowth16to17 , ProfitGrowth17_18 = $profitGrowth17to18 , avgProfitGrowth = $avgProfitGrowth  , EPSGrowth13_14 = $epsGrowth13to14 , EPSGrowth14_15 = $epsGrowth14to15 , EPSGrowth15_16 = $epsGrowth15to16 , EPSGrowth16_17 = $epsGrowth16to17 , EPSGrowth17_18 = $epsGrowth17to18 , avgEPSGrowth = $avgepsGrowth where number = $searchCompanyNumber";
		//echo "COmpany#".$searchCompanyNumber."GPmargin".$GrossMargin."OPMargin".$OPMargin." IntUponOP". $IntUponOP." NPMargin". $NPMargin."SgaUponGp". $SgaUponGp."DepUponGp". $DepUponGp." CurretRatio". $CurretRatio."ReturnOnAssests". $ReturnOnAssests."DebtEquityRatio". $DebtEquityRatio."DebtUponEarnings". $DebtUponEarnings."ReturnOnEquity". $ReturnOnEquity." SalesGrowth7_8". $salesGrowth7to8." SalesGrowth8_9". $salesGrowth8to9." SalesGrowth9_10". $salesGrowth9to10." SalesGrowth10_11". $salesGrowth10to11." SalesGrowth11_12". $salesGrowth11to12." avgSalesGrowth". $avgsalesGrowth." ProfitGrowth7_8". $profitGrowth7to8." ProfitGrowth8_9". $profitGrowth8to9." ProfitGrowth9_10". $profitGrowth9to10." ProfitGrowth10_11". $profitGrowth10to11." ProfitGrowth11_12". $profitGrowth11to12." avgProfitGrowth". $avgProfitGrowth ." EPSGrowth7_8". $epsGrowth7to8." EPSGrowth8_9". $epsGrowth8to9." EPSGrowth9_10". $epsGrowth9to10." EPSGrowth10_11". $epsGrowth10to11." EPSGrowth11_12". $epsGrowth11to12." avgEPSGrowth". $avgepsGrowth;
		 /* $iCount++;
		if($iCount==5)
		{
			break;
		}  */
		//break; //naidu delete this break - was for testing only 
	}
	

		
		echo "PROCESSING COMPLETED!!!!!!!";
?>