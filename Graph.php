<?php
include("config/config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Analyse Graphs</title>
<link rel="stylesheet" type="text/css" href="css/style.css">


    <link class="include" rel="stylesheet" type="text/css" href="jquerychart/jquery.jqplot.min.css" />
  <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="jquerychart/excanvas.js"></script><![endif]-->

	<script class="include" type="text/javascript" src="jquerychart/jquery.min.js"></script>
  




</head>
<body>

  <style type="text/css">
    .jqplot-target {
        margin-bottom: 0em;
    }
    
    .note {
        font-size: 0.8em;
    }
    
    #tooltip1b {
        font-size: 12px;
        color: rgb(15%, 15%, 15%);
        padding:2px;
        background-color: #cdcdcd;
    }
    
    #legend1b {
        font-size: 12px;
        border: 1px solid #cdcdcd;
        border-collapse: collapse;
    }
    #legend1b td, #legend1b th {
        border: 1px solid #cdcdcd;
        padding: 1px 4px;
    }
  </style>


<?php
include("header.inc.php");
?>
<div class="clear5"></div>
<div class="clear5"></div>
<table><tr><td><div id="chart1"  class="graph-box-left"  style="height:300px; width:500px;"></div><div class="graph-box-right"><img  src="images/profitMargins.jpg"  width="200" height="200" vspace="50" border="0"></div></td></tr></table>
<table><tr><td><div id="chart2" class="graph-box-left" style="height:300px; width:300px;"></div><div class="graph-box-right"><img  src="images/growth.jpg"  width="200" height="200" border="0" vspace="50"></div></td></tr></table>
<table><tr><td><div id="chart3" class="graph-box-left" style="height:300px; width:300px;"></div><div class="graph-box-right"><img src="images/BalanceSheetRatios.jpg"  width="200" height="140" border="0" vspace="50"></div></td></tr></table>
<?php 

for ($ireset = 0 ; $ireset < 5 ; $ireset++)
{
			$_SESSION['graphYearData'][$ireset]=  "";
			$_SESSION['graphGPmarginData'][$ireset]= "";
			$_SESSION['graphOPMarginData'][$ireset]=  "";
			$_SESSION['graphNPMarginData'][$ireset]=  "";
			$_SESSION['graphSgaUponGpData'][$ireset]=  "";
			$_SESSION['graphDepUponGpData'][$ireset]=  "";
			$_SESSION['graphIntUponOPData'][$ireset]=  "";
	$_SESSION['graphCurrentRatio'][$ireset] = "";
			$_SESSION['graphDebtEquity'][$ireset] = "";
			$_SESSION['graphDebtuponearning'][$ireset] = "";
 $_SESSION['graphNPGrowthRateData'][$ireset] = "";
	
 $_SESSION['graphInventoryGrowthRateData'][$ireset]= "";
	
	 $_SESSION['graphDebtGrowthRateData'][$ireset]= "";
	$_SESSION['graphBookGrowthRateData'][$ireset]= "";
	$_SESSION['graphCapexGrowthRateData'][$ireset]= "";
}
	$number = $_SESSION['companynumber'];
	$companySearch1=mysql_query("select * from name_code where number = $number ");
	 $row1 = mysql_fetch_array($companySearch1);
	$companyType = $row1['Company_type']; 
	$isBank ='' ;
	if ($companyType == "banks-private-sector" || $companyType == "banks-public-sector")
	{	$ProfitLossPage = "Profit_Loss_Banks.php" ;
		$BalanceSheetPage = "Balance_Sheet_Banks.php" ;
		$isBank = 'Y' ;
	}
	else
	{ $ProfitLossPage = "Profit_Loss.php";	
	  $BalanceSheetPage = "Balance_Sheet.php" ;
	  $isBank = 'N' ;
	}
	if ( $isBank != 'Y' )
	{	
		$getProfitLossData=mysql_query("select * from profit_loss where companynumber  = $number order by year");
		$parameter1Data = '';
		$iterator = 0;
		while($row_st1=mysql_fetch_array($getProfitLossData))
		{
			$yearArray[$iterator] = $row_st1['year'];
			$arrayiTotalIncome[$iterator] = $row_st1['netProfit'];			
			$_SESSION['graphYearData'][$iterator]=  $row_st1['year'];
			$_SESSION['graphGPmarginData'][$iterator]=  $row_st1['GPmargin'];
			$_SESSION['graphOPMarginData'][$iterator]=  $row_st1['OPMargin'];
			$_SESSION['graphNPMarginData'][$iterator]=  $row_st1['NPMargin'];
			$_SESSION['graphSgaUponGpData'][$iterator]=  $row_st1['SgaUponGp'];
			$_SESSION['graphDepUponGpData'][$iterator]=  $row_st1['DepUponGp'];
			$_SESSION['graphIntUponOPData'][$iterator]=  $row_st1['IntUponOP'];
			$iterator = $iterator + 1;
		}
		$getBalanceSheetData=mysql_query("select * from balancesheet where companynumber  = $number order by year");
		$iterator = 0;
		while($row_st1=mysql_fetch_array($getBalanceSheetData))
		{
			$yearArray[$iterator] = $row_st1['year'];
			$arrayiInventory[$iterator] = $row_st1['inventories'];
			$TotalDebt[$iterator] = $row_st1['totalDebt'];
			$RetainedEarnings[$iterator] = $row_st1['reserves'];
			$BookValue[$iterator] = $row_st1['bookvalue'];
			$arrayiGrossPlusWorkingCapital[$iterator] = $row_st1['grossBlock'] + $row_st1['totalCALoansAdvances'] - $row_st1['cash'] - $row_st1['fixedDeposit'] - $row_st1['totalClProvisions'];			
			$_SESSION['graphCurrentRatio'][$iterator] = $row_st1['CurretRatio'];
			$_SESSION['graphDebtEquity'][$iterator] = $row_st1['DebtEquityRatio'];
			$_SESSION['graphDebtuponearning'][$iterator] = $row_st1['DebtUponEarnings'];
			$iterator = $iterator + 1;
		}
		
	}
	//calculatin net profit growth rate
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" ) || ($arrayiTotalIncome[$i] == "" ) || ($arrayiTotalIncome[$i] == "--" ))
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i + 1] == "NA" ) || ($arrayiTotalIncome[$i+1] == "--" ) || ($arrayiTotalIncome[$i+1] == "" ))
		{
			continue;
		}
		if ( $i==4)
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
	
	for ($profiti=0 ; $profiti < 5 ;$profiti++)
	{
	$parameter7Data = $parameter7Data."20".$yearArray[$profiti]."--".$arrayiTotalIncome[$profiti];
		if ($profiti != 4){
			$parameter7Data = $parameter7Data."&nbsp;&nbsp;Growth ".$arrayiIncomeGrowth[$profiti]."%"."\n";
			$_SESSION['graphNPGrowthRateData'][$profiti]=  $arrayiIncomeGrowth[$profiti] ;
			}
	}
	
	//calculate inventory growth
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiInventory[$i] == "NA" ) || ($arrayiInventory[$i] == "--" ) || ($arrayiInventory[$i] == "0.00" ) || ($arrayiInventory[$i] == "" ) || ($arrayiInventory[$i] == "--" ))
		{
			continue;
		}
		if ( ($arrayiInventory[$i + 1] == "NA" ) || ($arrayiInventory[$i+1] == "--" ) || ($arrayiInventory[$i+1] == "" ))
		{
			continue;
		}
		if ( $i==4)
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
	for ($profiti=0 ; $profiti < 5 ;$profiti++)
	{
	$parameter10Data = $parameter10Data."20".$yearArray[$profiti]."--".$arrayiInventory[$profiti];
		if ($profiti != 4){
			$parameter10Data = $parameter10Data."&nbsp;&nbsp;Growth ".$arrayiIncomeGrowth[$profiti]."%"."\n";
			$_SESSION['graphInventoryGrowthRateData'][$profiti] = $arrayiIncomeGrowth[$profiti];
			}
	}
	//------------------------end of inventory growth calculation--------------------------------------- 
	//calculate total debt  growth
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($TotalDebt[$i] == "NA" ) || ($TotalDebt[$i] == "--" ) || ($TotalDebt[$i] == "0.00" ) || ($TotalDebt[$i] == "" ) || ($TotalDebt[$i] == "--" ))
		{
			continue;
		}
		if ( ($TotalDebt[$i + 1] == "NA" ) || ($TotalDebt[$i+1] == "--" ) || ($TotalDebt[$i+1] == "" ))
		{
			continue;
		}
		if ( $i==4)
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
	
		//------------------------end of retained earnings growth calculation--------------------------------------- 
	
			//calculate book value  growth
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($BookValue[$i] == "NA" ) || ($BookValue[$i] == "--" ) || ($BookValue[$i] == "0.00" ) || ($BookValue[$i] == "" ) || ($BookValue[$i] == "--" ))
		{
			continue;
		}
		if ( ($BookValue[$i + 1] == "NA" ) || ($BookValue[$i+1] == "--" ) || ($BookValue[$i+1] == "" ))
		{
			continue;
		}
		if ( $i==4)
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
	//------------------------end of inventory growth calculation--------------------------------------- 
	
	//calculate capex growth
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiGrossPlusWorkingCapital[$i] == "NA" ) || ($arrayiGrossPlusWorkingCapital[$i] == "--" ) || ($arrayiGrossPlusWorkingCapital[$i] == "0.00" ) || ($arrayiGrossPlusWorkingCapital[$i] == "" ) || ($arrayiGrossPlusWorkingCapital[$i] == "--" ))
		{
			continue;
		}
		if ( ($arrayiGrossPlusWorkingCapital[$i + 1] == "NA" ) || ($arrayiGrossPlusWorkingCapital[$i+1] == "--" ) || ($arrayiGrossPlusWorkingCapital[$i+1] == "" ))
		{
			continue;
		}
		if ( $i==4)
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
	for ($icount=0 ; $icount < 5 ;$icount++) 
	{
	$graphNPgrowth[$icount + 1] = $_SESSION['graphNPGrowthRateData'][$icount];
	
	$graphInventorygrowth[$icount + 1] = $_SESSION['graphInventoryGrowthRateData'][$icount];
	
	$grapDebtgrowth[$icount + 1] = $_SESSION['graphDebtGrowthRateData'][$icount];
	$graphBookgrowth[$icount + 1] = $_SESSION['graphBookGrowthRateData'][$icount];
	$graphCapexgrowth[$icount + 1] = $_SESSION['graphCapexGrowthRateData'][$icount];
	}
			
	$varGP = "[ ";
	$varOP = "[ ";
	$varNP = "[ ";
	$varSga = "[ ";
	$varDep = "[ ";
	$varInt = "[ ";
	$varNPgrowth = "[ ";
	$varInventorygrowth = "[ ";
	$varDebtgrowth = "[ ";
	$varBookgrowth = "[ ";
	$varCapexgrowth = "[ ";
	
	$varCurrentRatio = "[ ";
	$varDebtEquity = "[ ";
	$varDebtEarnings = "[ ";
	$validcount = 0;
	for ($i=0 ; $i < 5 ;$i++) 
	{
	
	 if ( $_SESSION['graphYearData'][$i] != '') 
	 	{
			if ($validcount == 0)
		 	{ 
				$varcomma = "";
			}
			else
			{
			$varcomma = " , ";
			}
			
		$varGP = $varGP.$varcomma."['01-Feb-".$_SESSION['graphYearData'][$i]."' ,".$_SESSION['graphGPmarginData'][$i]."]" ;
		$varOP = $varOP.$varcomma."['01-Feb-".$_SESSION['graphYearData'][$i]."' ,".$_SESSION['graphOPMarginData'][$i]."]" ;
		$varNP = $varNP.$varcomma."['01-Feb-".$_SESSION['graphYearData'][$i]."' ,".$_SESSION['graphNPMarginData'][$i]."]" ;
		$varSga = $varSga.$varcomma."['01-Feb-".$_SESSION['graphYearData'][$i]."' ,".$_SESSION['graphSgaUponGpData'][$i]."]" ;
		$varDep  = $varDep.$varcomma."['01-Feb-".$_SESSION['graphYearData'][$i]."' ,".$_SESSION['graphDepUponGpData'][$i]."]" ;
		$varInt = $varInt.$varcomma."['01-Feb-".$_SESSION['graphYearData'][$i]."' ,".$_SESSION['graphIntUponOPData'][$i]."]" ;
		
		$varCurrentRatio = $varCurrentRatio.$varcomma."['01-Feb-".$_SESSION['graphYearData'][$i]."' ,".$_SESSION['graphCurrentRatio'][$i]."]" ;
		$varDebtEquity = $varDebtEquity.$varcomma."['01-Feb-".$_SESSION['graphYearData'][$i]."' ,".$_SESSION['graphDebtEquity'][$i]."]" ;
		$varDebtEarnings = $varDebtEarnings.$varcomma."['01-Feb-".$_SESSION['graphYearData'][$i]."' ,".$_SESSION['graphDebtuponearning'][$i]."]" ;
		if($i != 4)
		{
		$varNPgrowth = $varNPgrowth.$varcomma."['01-Feb-".$_SESSION['graphYearData'][$i+1]."' ,".$_SESSION['graphNPGrowthRateData'][$i]."]" ;
		$varInventorygrowth = $varInventorygrowth.$varcomma."['01-Feb-".$_SESSION['graphYearData'][$i+1]."' ,".$_SESSION['graphInventoryGrowthRateData'][$i]."]" ;
		$varDebtgrowth  = $varDebtgrowth.$varcomma."['01-Feb-".$_SESSION['graphYearData'][$i+1]."' ,".$_SESSION['graphDebtGrowthRateData'][$i]."]" ;
		$varBookgrowth  = $varBookgrowth.$varcomma."['01-Feb-".$_SESSION['graphYearData'][$i+1]."' ,".$_SESSION['graphBookGrowthRateData'][$i]."]" ;
		$varCapexgrowth = $varCapexgrowth.$varcomma."['01-Feb-".$_SESSION['graphYearData'][$i+1]."' ,".$_SESSION['graphCapexGrowthRateData'][$i]."]" ;
		}
		
	
		
		//$varEpsGrowth  = $varEpsGrowth.$varcomma."['01-Feb-".$_SESSION['graphYearData'][$i]."' ,".$_SESSION['graphEpsGrowthRateData'][$i]."]" ;
		$validcount = 1;
		}
			
			//echo $_SESSION['graphGPmarginData'][$i]."<br>";
	}
	$varGP = $varGP." ]";
	$varOP = $varOP." ]";
	$varNP = $varNP." ]";
	$varSga = $varSga." ]";
	$varDep = $varDep." ]";
	$varInt = $varInt." ]";

	$varNPgrowth = $varNPgrowth." ]";
	$varInventorygrowth  = $varInventorygrowth." ]";
	$varDebtgrowth  = $varDebtgrowth." ]";
	$varBookgrowth = $varBookgrowth." ]";
	$varCapexgrowth = $varCapexgrowth." ]";
	
	$varCurrentRatio = $varCurrentRatio." ]";
	$varDebtEquity = $varDebtEquity." ]";
	$varDebtEarnings = $varDebtEarnings." ]";
	/*echo "OP".$varOP."<br>";
	echo "NP".$varNP."<br>";
	echo "Inventory".$varInventorygrowth."<br>";
	echo "debt".$varDebtgrowth."<br>";
	echo "book".$varBookgrowth."<br>";
	echo "capex".$varCapexgrowth."<br>";
	echo "Curr ratio".$varCurrentRatio."<br>";
	echo "Debt equity".$varDebtEquity."<br>";
	echo "debt /earning".$varDebtEarnings."<br>";*/
	
	 ?>
		
<script type="text/javascript">
$(document).ready(function(){
  var line1= <?php echo $varGP ?> ;
  var line2= <?php echo $varOP ?> ;
  var line3= <?php echo $varNP ?> ;
  var line4= <?php echo $varSga ?> ;
  var line5= <?php echo $varDep ?> ;
  var line6= <?php echo $varInt ?> ;
  var line7= <?php echo $varNPgrowth ?> ;
 
  	
	 
  var plot1 = $.jqplot('chart1', [line1 , line2 , line3 , line4 , line5 , line6 ], {
      title:'Profitability Graph',
      axes:{
        xaxis:{
          renderer:$.jqplot.DateAxisRenderer,
          tickOptions:{
            formatString:'%y&nbsp;%#y'
          } 
        },
        yaxis:{
          tickOptions:{
            formatString:'%.0f'
            }
        }
      },
      highlighter: {
        show: true,
        sizeAdjust: 7.5
      },
      cursor: {
        show: true
      }
  });
});
</script>
  

<script type="text/javascript">
$(document).ready(function(){
  
  var line7= <?php echo $varNPgrowth ?> ;
	var line8= <?php echo $varInventorygrowth  ?> ;
	var line9= <?php echo $varDebtgrowth ?> ;
	var line10= <?php echo $varBookgrowth ?> ;
	var line11= <?php echo $varCapexgrowth ?> ; 
  var plot1 = $.jqplot('chart2', [line7 , line8, line9, line10, line11 ], {
      title:'Growth Vs Expenses Graph',
      axes:{
        xaxis:{
          renderer:$.jqplot.DateAxisRenderer,
          tickOptions:{
            formatString:'%y&nbsp;%#y'
          } 
        },
        yaxis:{
          tickOptions:{
            formatString:'%.0f'
            }
        }
      },
      highlighter: {
        show: true,
        sizeAdjust: 7.5
      },
      cursor: {
        show: true
      }
  });
});
</script>


<script type="text/javascript">
$(document).ready(function(){
  
  var line12= <?php echo $varCurrentRatio ?> ;
	var line13= <?php echo $varDebtEquity  ?> ;
	var line14= <?php echo $varDebtEarnings ?> ;

  var plot1 = $.jqplot('chart3', [line12 , line13, line14 ], {
      title:'Ratios Graph',
      axes:{
        xaxis:{
          renderer:$.jqplot.DateAxisRenderer,
          tickOptions:{
            formatString:'%y&nbsp;%#y'
          } 
        },
        yaxis:{
          tickOptions:{
            formatString:'%.0f'
            }
        }
      },
      highlighter: {
        show: true,
        sizeAdjust: 7.5
      },
      cursor: {
        show: true
      }
  });
});
</script>
<div class="clear5"></div>
<div style="position:absolute;z-index:99;display:none;" id="tooltip1b"></div>

<table><tr>
    <td><div id="chart1b" class="plot" style="width:1000px;height:340px;"></div></td>
    <td><div style="height:340px;"><table id="legend1b"><tr><th>Paramter</th><th>Rating </th></tr></table></div></td></tr></table>

<?php 

$varBubbleGraph = "[ ";
$validcountGraph = 0;
for ($county = 0 ;$county <25 ; $county++)
	{
 		 if ($_SESSION['SessionRating'][$county] != "")
 		 {
			 if ($validcountGraph == 0)
		 	{ 
				$varcomma = "";
			}
			else
			{
			$varcomma = " , ";
			}
			if ( $validcountGraph == 0 || $validcountGraph == 1 || $validcountGraph == 2 )
			{			$xaxis= 2;}
			if ( $validcountGraph == 3 || $validcountGraph == 4 || $validcountGraph == 5 )
			{			$xaxis= 4;}
			if ( $validcountGraph == 6 || $validcountGraph == 7 || $validcountGraph == 8 )
			{			$xaxis= 6;}
			if ( $validcountGraph == 9 || $validcountGraph == 10 || $validcountGraph == 11 )
			{			$xaxis= 8;}
			if ( $validcountGraph == 12 || $validcountGraph == 13 || $validcountGraph == 14 )
			{			$xaxis= 10;}
			if ( $validcountGraph == 15 || $validcountGraph == 16 || $validcountGraph == 17 )
			{			$xaxis= 12;}
			if ( $validcountGraph == 18 || $validcountGraph == 19 || $validcountGraph == 20 )
			{			$xaxis= 14;}
			if ( $validcountGraph == 21 || $validcountGraph == 22 || $validcountGraph == 23 )
			{			$xaxis= 16;}
			if ( $validcountGraph == 24 || $validcountGraph == 25 || $validcountGraph == 26 )
			{			$xaxis= 18;}
			if ( ($validcountGraph == 0) || ($validcountGraph == 3) || ($validcountGraph == 6) || ($validcountGraph == 9) ||  ($validcountGraph == 12)  || ($validcountGraph == 15 )|| ($validcountGraph == 18) || ($validcountGraph == 21 )|| ($validcountGraph ==24))   
				{$yaxis= 20 ;}
			if ( $validcountGraph == 1 || $validcountGraph == 4 || $validcountGraph == 7 || $validcountGraph == 10 ||  $validcountGraph == 13  || $validcountGraph == 16 || $validcountGraph == 19 || $validcountGraph == 22 || $validcountGraph == 25)   
				{$yaxis= 40 ;}
			if ( $validcountGraph == 2 || $validcountGraph == 5 || $validcountGraph == 8 || $validcountGraph == 11 ||  $validcountGraph == 14  || $validcountGraph == 17 || $validcountGraph == 20 || $validcountGraph == 23)   
				{$yaxis= 60 ;}
			$radius = $_SESSION['weight'][$county]*300;
			$label1 = $_SESSION['Parameter_ShortDesc'][$county];
			if ($_SESSION['SessionRating'][$county] == 1) 				{	$color1 = 'red'; }
			if ($_SESSION['SessionRating'][$county] == 2) 				{	$color1 = 'orangered'; }
			if ($_SESSION['SessionRating'][$county] == 3) 				{	$color1 = 'aquamarine'; }
			if ($_SESSION['SessionRating'][$county] == 4) 				{	$color1 = 'limegreen'; }
			if ($_SESSION['SessionRating'][$county] == 5) 				{	$color1 = 'green'; }
		 	$varBubbleGraph = $varBubbleGraph.$varcomma."[".$xaxis.",".$yaxis.",".$radius.","." {label:'".$label1."' ,"."color:'".$color1."' }"."]" ;
			$validcountGraph = $validcountGraph + 1;
         }
     }
	 
	 $varBubbleGraph = $varBubbleGraph." ]";
	// echo $varBubbleGraph;
?>
<script  language="javascript" type="text/javascript">$(document).ready(function(){
    
    
    var arr = <?php echo $varBubbleGraph; ?> ;
    plot1b = $.jqplot('chart1b',[arr],{
        title: 'Analysis Cloud : How Green is the Company?',
        seriesDefaults:{
            renderer: $.jqplot.BubbleRenderer,
            rendererOptions: {
                bubbleAlpha: 0.6,
                highlightAlpha: 0.8,
                showLabels: true
            },
            shadow: true,
            shadowAlpha: 0.05
        }
    });
    
    // Legend is a simple table in the html.
    // Now populate it with the labels from each data value.
    $.each(arr, function(index, val) {
	 var Color1 = val[3].color ;
	 var rating1 ='';
	
	if (Color1  == 'red'){  rating1 = 1 ;}
	if (Color1  == 'orangered'){  rating1 = 2 ;}
	if (Color1  == 'aquamarine'){  rating1 = 3 ;}
	if (Color1  == 'limegreen'){  rating1 = 4 ;}
	if (Color1  == 'green'){  rating1 = 5 ;}
        $('#legend1b').append('<tr><td>'+val[3].label+'</td><td>'+rating1+'</td></tr>');
    });
    
    // Now bind function to the highlight event to show the tooltip
    // and highlight the row in the legend. 
    $('#chart1b').bind('jqplotDataHighlight', 
        function (ev, seriesIndex, pointIndex, data, radius) {    
            var chart_left = $('#chart1b').offset().left,
                chart_top = $('#chart1b').offset().top,
                x = plot1b.axes.xaxis.u2p(data[0]),  // convert x axis unita to pixels on grid
                y = plot1b.axes.yaxis.u2p(data[1]);  // convert y axis units to pixels on grid
				
            var color = 'rgb(50%,50%,100%)';
            $('#tooltip1b').css({left:chart_left+x+radius+5, top:chart_top+y});
            $('#tooltip1b').html('<span style="font-size:14px;font-weight:bold;color:'+color+';">' + 
            data[3].label + '</span><br />' + 'Weight: '+data[2]/300 );
            $('#tooltip1b').show();
            $('#legend1b tr').css('background-color', '#ffffff');
            $('#legend1b tr').eq(pointIndex+1).css('background-color', color);
        });
    
    // Bind a function to the unhighlight event to clean up after highlighting.
    $('#chart1b').bind('jqplotDataUnhighlight', 
        function (ev, seriesIndex, pointIndex, data) {
            $('#tooltip1b').empty();
            $('#tooltip1b').hide();
            $('#legend1b tr').css('background-color', '#ffffff');
        });
});</script>






<!-- End example scripts -->

<!-- Don't touch this! -->

 
<!-- End example scripts -->

<!-- Don't touch this! -->


    <script class="include" type="text/javascript" src="jquerychart/jquery.jqplot.min.js"></script>

<!-- End Don't touch this! -->

<!-- Additional plugins go here -->

    <script class="include" language="javascript" type="text/javascript" src="jquerychart/jqplot.highlighter.min.js"></script>
    <script class="include" language="javascript" type="text/javascript" src="jquerychart/jqplot.cursor.min.js"></script>
    <script class="include" language="javascript" type="text/javascript" src="jquerychart/jqplot.dateAxisRenderer.min.js"></script>
<script class="include" type="text/javascript" src="jquerychart/jqplot.bubbleRenderer.min.js"></script>

<!-- End additional plugins -->


	
	





<div class="clear5"></div>
<?php include("footer.inc.php"); ?>
</body>
</html>
