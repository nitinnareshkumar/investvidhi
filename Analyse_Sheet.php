<?php
include("config/config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Analyse sheet of the Company</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script language="javascript">
function vali_ana_form(obj)
{
 
 // var totalrow=document.ana_frm.elements['parameterData[]'].length;
  var fld;
  
  var total_sel=0;
  
  for(var j=0;j<15;j++)
  {
	var textBox = document.getElementById("parameterData[" + j + "]");
	var textLength = textBox.value.length;
	 if(textLength>1000)
  		{
		//red
    textBox.style.backgroundColor = "#A9E2A9";
		alert("Parameter Data Should be less than 1000 chars");
		return false;
		}
		else
		{
		textBox.style.backgroundColor = "#FFFFFF";
		}
 }
 for(var j=0;j<15;j++)
  {
	var textBox = document.getElementById("parameterRemarks[" + j + "]");
	var textLength = textBox.value.length;
	 if(textLength>2000)
  		{
		//red
    textBox.style.backgroundColor = "#A9E2A9";
		alert("Parameter Remarks Data Should be less than 2000 chars");
		return false;
		}
		else
		{
		textBox.style.backgroundColor = "#FFFFFF";
		}
 }
  for(var i=0;i<15;i++)
  {
  	  fld=eval("document.ana_frm.a_"+i);
	  if(fld.value>0)
	  {
	  total_sel=total_sel+1;
	  }
  }
  if(total_sel<5)
  {
  	alert("Please giving rating to atleast 5 parameters to analyze further");
	return false;
  }
  
}
</script>
</head>
<body>
<?php
include("header.inc.php");
?>
<div class="clear5"></div>

 <?php  
	 $searchCompanyCode = $_GET['mcode'];
	 $firsttime = $_GET['firsttime'];
	 $bank = 	  $_GET['isBank'];
	 //$_SESSION['companycode'] = $_GET['mcode'];
	// $_SESSION['companynumber'] = $_GET['number'];
	 if ($firsttime == 'Y' && $bank != 'Y' )
	{
	
	$_SESSION['companycode'] = $_GET['mcode'];
	 $_SESSION['companynumber'] = $_GET['number'];
	$_GET['firsttime'] = '' ;
		$getProfitLossData=mysqli_query($link, "select * from profit_loss where companycode  = '$searchCompanyCode' order by year");
		$parameter1Data = '';
		$parameter2Data = '';
		$parameter3Data = '';
		$parameter4Data = '';
		$parameter5Data = '';
		$parameter6Data = '';
		$parameter9Data = '';
		$iterator = 0;
		while($row_st1=mysqli_fetch_array($getProfitLossData))
		{
	
			$yearArray[$iterator] = $row_st1['year'];
			
			//$GPmarginArray[] = $row_st1['GPmargin'];
			//$OPMarginArray[] = $row_st1['OPMargin'];
			//$NPMarginArray[] = $row_st1['NPMargin'];
			//$SGAArray[] = $row_st1['SgaUponGp'];
			
			$parameter1Data = $parameter1Data."20".$row_st1['year']."--".$row_st1['GPmargin']."% "."\n";
			$parameter2Data = $parameter2Data."20".$row_st1['year']."--".$row_st1['OPMargin']."% "."\n";
			$parameter3Data = $parameter3Data."20".$row_st1['year']."--".$row_st1['NPMargin']."% "."\n";
			$parameter4Data = $parameter4Data."20".$row_st1['year']."--".$row_st1['SgaUponGp']."% "."\n";
			$parameter5Data = $parameter5Data."20".$row_st1['year']."--".$row_st1['DepUponGp']."% "."\n";
			$parameter6Data = $parameter6Data."20".$row_st1['year']."--".$row_st1['IntUponOP']."% "."\n";
			$parameter9Data = $parameter9Data."20".$row_st1['year']."--".$row_st1['equityDividends']."% "."\n";
			
			$arrayiTotalIncome[$iterator] = $row_st1['netProfit'];
			$arrayiEPSIncome[$iterator] = $row_st1['EPS'];
			$_SESSION['graphYearData'][$iterator]=  $row_st1['year'];
			$_SESSION['graphGPmarginData'][$iterator]=  $row_st1['GPmargin'];
			$_SESSION['graphOPMarginData'][$iterator]=  $row_st1['OPMargin'];
			$_SESSION['graphNPMarginData'][$iterator]=  $row_st1['NPMargin'];
			$_SESSION['graphSgaUponGpData'][$iterator]=  $row_st1['SgaUponGp'];
			$_SESSION['graphDepUponGpData'][$iterator]=  $row_st1['DepUponGp'];
			$_SESSION['graphIntUponOPData'][$iterator]=  $row_st1['IntUponOP'];
			
			$iterator = $iterator + 1;

		}
			//getting data from balance sheet table
		$getBalanceSheetData=mysqli_query($link, "select * from balancesheet where companycode  = '$searchCompanyCode' order by year");
		$iterator = 0;
		$ReturnOnEquity ="Return on Equity"."\n";
		$ReutrnOnAssets ="Return on Assets"."\n";
		$parameter11Data = '';
		$parameter12Data ='';
		$parameter13Data ='';
		$parameter14Data ='';
		while($row_st1=mysqli_fetch_array($getBalanceSheetData))
		{
			$yearArray[$iterator] = $row_st1['year'];
			$arrayiInventory[$iterator] = $row_st1['inventories'];
			$TotalDebt[$iterator] = $row_st1['totalDebt'];
			$RetainedEarnings[$iterator] = $row_st1['reserves'];
			$BookValue[$iterator] = $row_st1['bookvalue'];						
			$arrayiGrossPlusWorkingCapital[$iterator] = (is_numeric($row_st1['grossBlock'])?$row_st1['grossBlock']:0)  +  (is_numeric($row_st1['totalCALoansAdvances'])? $row_st1['totalCALoansAdvances']:0) - (is_numeric($row_st1['cash'])? $row_st1['cash']: 0 ) - (is_numeric($row_st1['fixedDeposit'])? $row_st1['fixedDeposit']:0 ) - (is_numeric($row_st1['totalClProvisions'])? $row_st1['totalClProvisions']:0);			
			$parameter12Data = $parameter12Data."20".$row_st1['year']."--".$row_st1['CurretRatio']."\n";
			$parameter13Data = $parameter13Data."20".$row_st1['year']."--".$row_st1['DebtEquityRatio']."\n";
			$parameter14Data = $parameter14Data."20".$row_st1['year']."--".$row_st1['DebtUponEarnings']."\n";
			$ReturnOnEquity = $ReturnOnEquity."20".$row_st1['year']."--".$row_st1['ReturnOnEquity']."% "."\n";
			$ReutrnOnAssets = $ReutrnOnAssets."20".$row_st1['year']."--".$row_st1['ReturnOnAssests']."% "."\n";
			
			$_SESSION['graphCurrentRatio'][$iterator] = $row_st1['CurretRatio'];
			$_SESSION['graphDebtEquity'][$iterator] = $row_st1['DebtEquityRatio'];
			$_SESSION['graphDebtuponearning'][$iterator] = $row_st1['DebtUponEarnings'];
			$iterator = $iterator + 1;
		}
		$parameter16Data = $ReturnOnEquity."\n".$ReutrnOnAssets;
		//end of balance sheet
	 	for($i=0;$i<25 ;$i++)
		{
			$_SESSION['sessionParameterData'][$i]='' ;
			$_SESSION['SessionRating'][$i]='' ;
			$_SESSION['sessionParameterRemarks'][$i]='';
		}
		$_SESSION['SessionOverallRating'] = '';
		$_SESSION['SessionValuationRating'] = '';
		//calculating capex
			
		for ($i=0 ; $i < 5 ;$i++)
		{
			if ($i == 4){ 
				continue;
			}
			$arrayCapex[$i] = $arrayiGrossPlusWorkingCapital[$i + 1] - $arrayiGrossPlusWorkingCapital[$i];
			if ($i != 4)
			{ 
				$parameter11Data = $parameter11Data."20".$yearArray[$i + 1]."--  ".$arrayCapex[$i]."\n"; 
			}			
		}
		$tempCapexData = $parameter11Data;
		$parameter11Data ='';
		//end of capex
			
		//calculatin net profit growth rate
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" ) || ($arrayiTotalIncome[$i] == "" ) || ($arrayiTotalIncome[$i] == "--" ))
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i + 1] == "NA" ) || ($arrayiTotalIncome[$i+1] == "--" ) || ($arrayiTotalIncome[$i+1] == "" ))
		{
			continue;
		}
		
		$arrayiIncomeGrowth[$i] = (($arrayiTotalIncome[$i + 1] - $arrayiTotalIncome[$i])/$arrayiTotalIncome[$i]) * 100;
		if ( $arrayiTotalIncome[$i] < 0 )
		{
			$arrayiIncomeGrowth[$i] = - $arrayiIncomeGrowth[$i];
		} 
		$arrayiIncomeGrowth[1] = intval($arrayiIncomeGrowth[1]);
		$arrayiIncomeGrowth[2] = intval($arrayiIncomeGrowth[2]);
		$arrayiIncomeGrowth[3] = intval($arrayiIncomeGrowth[3]);
		$arrayiIncomeGrowth[0] = intval($arrayiIncomeGrowth[0]);    		 
	} 
	
	$parameter7Data='';

	for ($profiti=0 ; $profiti < 5 ;$profiti++)
	{
		$parameter7Data = $parameter7Data."20".$yearArray[$profiti]."--".$arrayiTotalIncome[$profiti];
		if ($profiti != 4){
			$parameter7Data = $parameter7Data."&nbsp;&nbsp;Growth ".$arrayiIncomeGrowth[$profiti]."%"."\n";
			$_SESSION['graphNPGrowthRateData'][$profiti]=  $arrayiIncomeGrowth[$profiti] ;
			}
	}
	//calculate eps growth
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiEPSIncome[$i] == "NA" ) || ($arrayiEPSIncome[$i] == "--" ) || ($arrayiEPSIncome[$i] == "0.00" ) || ($arrayiEPSIncome[$i] == "" ) || ($arrayiEPSIncome[$i] == "--" ))
		{
			continue;
		}
		if ( ($arrayiEPSIncome[$i + 1] == "NA" ) || ($arrayiEPSIncome[$i+1] == "--" ) || ($arrayiEPSIncome[$i+1] == "" ))
		{
			continue;
		}
		
		$arrayiIncomeGrowth[$i] = (($arrayiEPSIncome[$i + 1] - $arrayiEPSIncome[$i])/$arrayiEPSIncome[$i]) * 100;
		if ( $arrayiEPSIncome[$i] < 0 )
		{
			$arrayiIncomeGrowth[$i] = - $arrayiIncomeGrowth[$i];
		} 
		$arrayiIncomeGrowth[1] = intval($arrayiIncomeGrowth[1]);
		$arrayiIncomeGrowth[2] = intval($arrayiIncomeGrowth[2]);
		$arrayiIncomeGrowth[3] = intval($arrayiIncomeGrowth[3]);
		$arrayiIncomeGrowth[0] = intval($arrayiIncomeGrowth[0]);    		 
	}
	$parameter8Data='';	
	for ($profiti=0 ; $profiti < 5 ;$profiti++)
	{
		$parameter8Data = $parameter8Data."20".$yearArray[$profiti]."--".$arrayiEPSIncome[$profiti];
		if ($profiti != 4){
			$parameter8Data = $parameter8Data."&nbsp;&nbsp;Growth ".$arrayiIncomeGrowth[$profiti]."%"."\n";
			$_SESSION['graphEpsGrowthRateData'][$profiti]=  $arrayiIncomeGrowth[$profiti] ;
			}
	}
	//------------------------end of eps growth calculation--------------------------------------- 
	
		//calculate inventory growth
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiInventory[$i] == "NA" ) || ($arrayiInventory[$i] == "--" ) || ($arrayiInventory[$i] == "0.00" ) || ($arrayiInventory[$i] == "" ) || ($arrayiInventory[$i] == "--" ))
		{
			continue;
		}
		if ( ($arrayiInventory[$i + 1] == "NA" ) || ($arrayiInventory[$i+1] == "--" ) || ($arrayiInventory[$i+1] == "" ))
		{
			continue;
		}
		
		$arrayiIncomeGrowth[$i] = (($arrayiInventory[$i + 1] - $arrayiInventory[$i])/$arrayiInventory[$i]) * 100;
		if ( $arrayiInventory[$i] < 0 )
		{
			$arrayiIncomeGrowth[$i] = - $arrayiIncomeGrowth[$i];
		} 
		$arrayiIncomeGrowth[1] = intval($arrayiIncomeGrowth[1]);
		$arrayiIncomeGrowth[2] = intval($arrayiIncomeGrowth[2]);
		$arrayiIncomeGrowth[3] = intval($arrayiIncomeGrowth[3]);
		$arrayiIncomeGrowth[0] = intval($arrayiIncomeGrowth[0]);    		 
	}
	$parameter10Data='';
	for ($profiti=0 ; $profiti < 5 ;$profiti++)
	{
		$parameter10Data = $parameter10Data."20".$yearArray[$profiti]."--".$arrayiInventory[$profiti];
		if ($profiti != 4)
		{
			$parameter10Data = $parameter10Data."&nbsp;&nbsp;Growth ".$arrayiIncomeGrowth[$profiti]."%"."\n";
			$_SESSION['graphInventoryGrowthRateData'][$profiti] = $arrayiIncomeGrowth[$profiti];
		}
	}
	//------------------------end of inventory growth calculation--------------------------------------- 
	
	//calculate capex growth
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiGrossPlusWorkingCapital[$i] == "NA" ) || ($arrayiGrossPlusWorkingCapital[$i] == "--" ) || ($arrayiGrossPlusWorkingCapital[$i] == "0.00" ) || ($arrayiGrossPlusWorkingCapital[$i] == "" ) || ($arrayiGrossPlusWorkingCapital[$i] == "--" ))
		{
			continue;
		}
		if ( ($arrayiGrossPlusWorkingCapital[$i + 1] == "NA" ) || ($arrayiGrossPlusWorkingCapital[$i+1] == "--" ) || ($arrayiGrossPlusWorkingCapital[$i+1] == "" ))
		{
			continue;
		}
		
		$arrayiIncomeGrowth[$i] = (($arrayiGrossPlusWorkingCapital[$i + 1] - $arrayiGrossPlusWorkingCapital[$i])/$arrayiGrossPlusWorkingCapital[$i]) * 100;
		if ( $arrayiGrossPlusWorkingCapital[$i] < 0 )
		{
			$arrayiIncomeGrowth[$i] = - $arrayiIncomeGrowth[$i];
		} 
		$arrayiIncomeGrowth[1] = intval($arrayiIncomeGrowth[1]);
		$arrayiIncomeGrowth[2] = intval($arrayiIncomeGrowth[2]);
		$arrayiIncomeGrowth[3] = intval($arrayiIncomeGrowth[3]);
		$arrayiIncomeGrowth[0] = intval($arrayiIncomeGrowth[0]);    		 
	}
	for ($profiti=0 ; $profiti < 4 ;$profiti++)
	{
	$_SESSION['graphCapexGrowthRateData'][$profiti] = $arrayiIncomeGrowth[$profiti];
			
	}
	//------------------------end of capex growth calculation--------------------------------------- 
		
		//calculate total debt  growth
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( $i==4)
		{
			continue;
		}
		if ( ($TotalDebt[$i] == "NA" ) || ($TotalDebt[$i] == "--" ) || ($TotalDebt[$i] == "0.00" ) || ($TotalDebt[$i] == "" ) || ($TotalDebt[$i] == "--" ))
		{
			continue;
		}
		if ( ($TotalDebt[$i + 1] == "NA" ) || ($TotalDebt[$i+1] == "--" ) || ($TotalDebt[$i+1] == "" ))
		{
			continue;
		}
		$arrayiIncomeGrowth[$i] = (($TotalDebt[$i + 1] - $TotalDebt[$i])/$TotalDebt[$i]) * 100;
		if ( $TotalDebt[$i] < 0 )
		{
			$arrayiIncomeGrowth[$i] = - $arrayiIncomeGrowth[$i];
		} 
		$arrayiIncomeGrowth[1] = intval($arrayiIncomeGrowth[1]);
		$arrayiIncomeGrowth[2] = intval($arrayiIncomeGrowth[2]);
		$arrayiIncomeGrowth[3] = intval($arrayiIncomeGrowth[3]);
		$arrayiIncomeGrowth[0] = intval($arrayiIncomeGrowth[0]);    		 
	}
	$parameter15Data='';
	for ($profiti=0 ; $profiti < 5 ;$profiti++)
	{
		$parameter15Data = $parameter15Data."20".$yearArray[$profiti]."--".$TotalDebt[$profiti];
		if ($profiti != 4){
			$parameter15Data = $parameter15Data."&nbsp;&nbsp;Growth ".$arrayiIncomeGrowth[$profiti]."%"."\n";
			$_SESSION['graphDebtGrowthRateData'][$profiti] = $arrayiIncomeGrowth[$profiti];
			}
	}
	$parameter15Data ="Capex"."\n".$tempCapexData; //making it blank as we have replaced debt for 5 years by cash flow point
	//------------------------end of total debt growth calculation--------------------------------------- 
	
			
		//calculate retained earnings  growth
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( $i==4)
		{
			continue;
		}
		if ( ($RetainedEarnings[$i] == "NA" ) || ($RetainedEarnings[$i] == "--" ) || ($RetainedEarnings[$i] == "0.00" ) || ($RetainedEarnings[$i] == "" ) || ($RetainedEarnings[$i] == "--" ))
		{
			continue;
		}
		if ( ($RetainedEarnings[$i + 1] == "NA" ) || ($RetainedEarnings[$i+1] == "--" ) || ($RetainedEarnings[$i+1] == "" ))
		{
			continue;
		}
		
		$arrayiIncomeGrowth[$i] = (($RetainedEarnings[$i + 1] - $RetainedEarnings[$i])/$RetainedEarnings[$i]) * 100;
		if ( $RetainedEarnings[$i] < 0 )
		{
			$arrayiIncomeGrowth[$i] = - $arrayiIncomeGrowth[$i];
		} 
		$arrayiIncomeGrowth[1] = intval($arrayiIncomeGrowth[1]);
		$arrayiIncomeGrowth[2] = intval($arrayiIncomeGrowth[2]);
		$arrayiIncomeGrowth[3] = intval($arrayiIncomeGrowth[3]);
		$arrayiIncomeGrowth[0] = intval($arrayiIncomeGrowth[0]);    		 
	}
	$parameter18Data='';
	for ($profiti=0 ; $profiti < 5 ;$profiti++)
	{
		$parameter18Data = $parameter18Data."20".$yearArray[$profiti]."--".$RetainedEarnings[$profiti];
		if ($profiti != 4){
			$parameter18Data = $parameter18Data."&nbsp;&nbsp;Growth ".$arrayiIncomeGrowth[$profiti]."%"."\n";
			}
	}
	//------------------------end of retained earnings growth calculation--------------------------------------- 
	
			//calculate book value  growth
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( $i==4)
		{
			continue;
		}
		if ( ($BookValue[$i] == "NA" ) || ($BookValue[$i] == "--" ) || ($BookValue[$i] == "0.00" ) || ($BookValue[$i] == "" ) || ($BookValue[$i] == "--" ))
		{
			continue;
		}
		if ( ($BookValue[$i + 1] == "NA" ) || ($BookValue[$i+1] == "--" ) || ($BookValue[$i+1] == "" ))
		{
			continue;
		}
		
		$arrayiIncomeGrowth[$i] = (($BookValue[$i + 1] - $BookValue[$i])/$BookValue[$i]) * 100;
		if ( $BookValue[$i] < 0 )
		{
			$arrayiIncomeGrowth[$i] = - $arrayiIncomeGrowth[$i];
		} 
		$arrayiIncomeGrowth[1] = intval($arrayiIncomeGrowth[1]);
		$arrayiIncomeGrowth[2] = intval($arrayiIncomeGrowth[2]);
		$arrayiIncomeGrowth[3] = intval($arrayiIncomeGrowth[3]);
		$arrayiIncomeGrowth[0] = intval($arrayiIncomeGrowth[0]);    		 
	}
	for ($profiti=0 ; $profiti < 5 ;$profiti++)
	{
	//$parameter16Data = $parameter16Data."20".$yearArray[$profiti]."--".$BookValue[$profiti];
		if ($profiti != 4){
			//$parameter16Data = $parameter16Data."&nbsp;&nbsp;Growth ".$arrayiIncomeGrowth[$profiti]."%"."\n";
			$_SESSION['graphBookGrowthRateData'][$profiti] = $arrayiIncomeGrowth[$profiti];

			}
	}
	//------------------------end of book value growth calculation--------------------------------------- 
$_SESSION['sessionParameterData'][0]= $parameter1Data; 
$_SESSION['sessionParameterData'][1]= $parameter2Data; 
$_SESSION['sessionParameterData'][2]= $parameter3Data; 
$_SESSION['sessionParameterData'][3]= $parameter4Data; 
$_SESSION['sessionParameterData'][4]= $parameter5Data; 
$_SESSION['sessionParameterData'][5]= $parameter6Data; 
$_SESSION['sessionParameterData'][6]= $parameter7Data; 
$_SESSION['sessionParameterData'][7]= $parameter8Data; 
$_SESSION['sessionParameterData'][8]= $parameter9Data;
$_SESSION['sessionParameterData'][9]= $parameter10Data;
$_SESSION['sessionParameterData'][10]= $parameter11Data;
$_SESSION['sessionParameterData'][11]= $parameter12Data;
$_SESSION['sessionParameterData'][12]= $parameter13Data;
$_SESSION['sessionParameterData'][13]= $parameter14Data;
$_SESSION['sessionParameterData'][14]= $parameter15Data;
$_SESSION['sessionParameterData'][15]= $parameter16Data;
$_SESSION['sessionParameterData'][17]= $parameter18Data;
	}
	if ($firsttime == 'Y' && $bank == 'Y' )
	{
			$_SESSION['companycode'] = $_GET['mcode'];
	       $_SESSION['companynumber'] = $_GET['number'];
			 for($i=0;$i<25 ;$i++){
			$_SESSION['sessionParameterData'][$i]='' ;
			$_SESSION['SessionRating'][$i]='' ;
			$_SESSION['sessionParameterRemarks'][$i]='';
			}
	}

	$number = $_SESSION['companynumber'];
     $companySearch1=mysqli_query($link, "select * from name_code where number = $number ");
	 $row1 = mysqli_fetch_array($companySearch1);
	$name = $row1['name'];
	$bseScript = $row1['BSE_Script']; 
	$companyUrl = $row1['company_url']; 
	$mcode = $row1['code']; //money control code
	$companyType = $row1['Company_type'];
	//Get Profit and loss data
	
	
	?>
<table width="800" border="0" align="center" bordercolor="#333333" bgcolor="#FFFFFF">
<tr ><td align="center"><h3>Analyze company based on 25 Fundamental Parameters </h3> <br> <a  class="tooltipSearch">
    <img align="texttop" src="images/help.jpg" width="60" height="60" >
    <span>
        <strong style="color:#009900">How to analyze the company?</strong><br />
        1. Add data for each fundamental parameter.Most of the financial data is already prepopulated<br>
        2. Add rating to each fundamental parameter, refer to help icon while deciding the rating. <br>
        3. Analyze graphs and analyze fundamental analysis cloud to identify weak/strong points about the company<br>
        4. Give your overall fundamental rating and valuation rating to the company. <br>
        5. Submit your analsis sheet<br>
        6. You can go to my account section to view/modify your anlayis sheets.
       
    </span>
</a><br><span class="greytxt12">How to analyze the company?</span></td> <td  align="left" ><a href="ListAnalyzedCompanies.php" target="_blank" ><img src="images/alreadyAnalyzed.jpg"  width="80" height="80" border="0" align="bottom"></a>
<br>Some Sample Analyzed Companies</td></tr></table>

<div class="clear2"></div>
<table width="700" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<tr>
    <td width="300" align="left" valign="top"><span class="greytxt12">Company Name - <?php  echo $name ?></span> </td><td width="200" align="left" valign="top"><span class="greytxt12">Company Number - <?php  echo $number?>             </span>  </td><td width="200" align="left" valign="top"><span class="greytxt12"> BSE Script ID - <?php  echo "     ".$bseScript?></span> </td>   </tr>
</table>
<table width="850" border="0" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<tr><td align="center"><span class="greytxt12"><strong>Standalone Data is considered for analysis ,please modify data to consider consolidated data</strong></span></td>
</tr>
</table>
<div align="center">

<form action="Analyse_Sheet_Next.php" method="post" enctype="multipart/form-data" name="ana_frm" id="" onSubmit="return vali_ana_form(this)">
<table width="800" border="1" align="center" bordercolor="#333333" bgcolor="#FFFFFF">
<tr >

  <td width="36" align="left" valign="top"></td>
    <td width="41" align="left" valign="top" class="cell"><span class="greytxt14">S.No</span>  </td>
    <td width="141" align="left" valign="top" class="cell"><span class="greytxt14">Parameter Name</span>  </td>
  	<td width="197" align="left" valign="top" class="cell"><span class="greytxt14">Data</span>  </td>
   <td width="50" align="left" valign="top" class="cell"><span class="greytxt14">Rating</span></td>
  	<td width="262" align="left" valign="top" class="cell"><span class="greytxt14">Remarks<br>%</span>  </td>
</tr>
 
 <?php  $getparameters = mysqli_query($link, "select * from master_analyze_sheet where visible = 'Y' order by sequence limit 0,15"); 
 $i=0;
	while($row_st1=mysqli_fetch_array($getparameters))
	{ 
	
	$i = $i + 1; 
	?>
  <tr bordercolor="#FFFFFF">
  
  <td width="36" align="left" valign="top"><a  class="tooltip">
    <img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?=$row_st1['Parameter_ShortDesc']?></strong><br />
        <?=$row_st1['helptxt']?>
    </span>
</a></td>
     <td width="41" align="left" valign="top" class="cell" ><span class="greytxt14"><?php echo $i; ?></span>  </td>
     <td width="141" align="left" valign="top" class="cell" ><span class="greytxt14"><?php echo $row_st1['Parameter_Desc']; ?></span>  </td>
    <td width="197" align="left" valign="top"><textarea class= "txtarea" id ="parameterData[<?=$i-1?>]" name ="parameterData[<?=$i-1?>]" rows="3" cols="30" ><?php echo $_SESSION['sessionParameterData'][$i-1] ; ?></textarea></td>
    <td width="50" align="left" valign="top"><span class="greytxt12"><select name="a_<?=$i-1?>" >
     <option value=""> </option>
    <?php for ($icount = 1 ; $icount <6 ; $icount++)
	{   ?>
	<option value="<?php echo $icount ; ?>" <?php if ($_SESSION['SessionRating'][$i - 1] == $icount) { ?> selected="selected"<?php  }?> ><?php echo $icount ; ?> </option>
	<?php }
	?>
  
</select></span>   </td>
    <td width="262" align="left" valign="top"><textarea  class= "txtarea" id ="parameterRemarks[<?=$i-1?>]" name ="parameterRemarks[<?=$i-1?>]" rows="2" cols="30"><?php echo $_SESSION['sessionParameterRemarks'][$i-1] ; ?></textarea></td></tr>
    <?php } ?>
 
  

	
</table> <div class="clear2"></div><div class="analyze-submit"><input type="submit" class="btn" value="Next"> </div></form>
</div>
<div class="clear2"></div>


<div class="clear5"></div>
<?php include("footer.inc.php"); ?>
</body>
</html>
