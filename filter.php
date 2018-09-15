<?php
//we have taken (ReturnOnEquity !=0) as a additional parameter in search as currently banks does not have ratio data in balance_sheet_banks and profit_loss_banks table so when search is made like debt to equity ratio as zero , banks are getting displayed as search results as they have no data in tbl_forsearchonyearlyparameters table.Some companies do not have fy12 data so we need to have this filter to avoid displaying these companies
include("config/config.inc.php");
$res=mysqli_query($link, "select * from searchoption order by id");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Stock Screener - Filter the best companies based on various fundamentals</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
 <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
    <style type="text/css">
	.ui-slider-horizontal{
	height: 0.3em;
}

.ui-slider-horizontal .ui-slider-handle{
    top: -0.4em;
}

.ui-slider .ui-slider-handle{
    height: 0.85em;
    width: 0.85em;
	
}

.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
	background: #A9E2A9;
	border: 1px solid #2694E8;
}

    .slider {margin: 9px 0 0 5px;
	width: 160px; }
  </style>
  <script>

  $(document).ready(function() {
  <?php 
  while($row=mysqli_fetch_assoc($res))
{ 
if ( isset( $_GET['subfrm'] ) ){ ?>
    $("#slider<?php echo $row['id'] ?> ").slider({disabled: <?php if($row['display']==0){ ?> false <?php } else { ?> false <?php } ?>, range: true,min: 0,max: 100,step: .1,values: [<?php echo $_REQUEST['minCost'.$row['id']]?>,<?php echo $_REQUEST['maxCost'.$row['id']]?>],	slide: function( event, ui ) {
	                                  //alert(ui.values[ 1 ]);
							jQuery("#min<?php echo $row['id'] ?>").html(ui.values[0] );
							jQuery("#max<?php echo $row['id'] ?>").html(ui.values[1]);							
							jQuery("#minCost<?php echo $row['id'] ?>").val(ui.values[0]);
							jQuery("#maxCost<?php echo $row['id'] ?>").val(ui.values[1]);
						}					});
						
						<?php					
  }
  else
  {
	  $_REQUEST['minCost'.$row['id']]=0;
	  $_REQUEST['maxCost'.$row['id']]=100;
?>
    $("#slider<?php echo $row['id'] ?>").slider({disabled: <?php if($row['display']==0){ ?>false <?php } else { ?>false <?php } ?>, range: true,min: 0,max: 100,step: .1,values: [ 0, 100],	slide: function( event, ui ) {
	                               
							jQuery("#min<?php echo $row['id'] ?>").html(  ui.values[ 0 ]  );
							jQuery("#max<?php echo $row['id'] ?>").html(  ui.values[ 1 ]  );	 						
							jQuery("#minCost<?php echo $row['id'] ?>").val(ui.values[0]);
							jQuery("#maxCost<?php echo $row['id'] ?>").val(ui.values[1]);													
						}					});
						
						<?php } 
						} ?>
  });
  </script>
</head>

<body>
<?php
include("header.inc.php");
?>
<div class="clear5"></div>
<div class="filter-box-left">
<form id="discover-submit" name="discover" onsubmit="return true;"  method="get">
<input type="hidden" name="subfrm" value="1">
<table width="850" border="0" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<tr><td align="center"><span class="greytxt12"><strong>Currently only standalone data is considered</strong></span></td>
</tr>
</table>
<table cellpadding="0" class="greytxt12" cellspacing="0">
<tr><td><h3>Criteria</h3></td><td><h3>Min</h3></td><td>&nbsp;</td><td><h3>Max</h3></td><td><h3>Remove</h3></td></tr>
<?php
$category='';
$res=mysqli_query($link, "select * from searchoption order by id");

while($row=mysqli_fetch_assoc($res))
{
  if($category!=$row['category'])
  {
  echo "<tr><td colspan='4' align='left' class='greentxt14'><br><br>".$row['category']."</td></tr>";
  $category=$row['category'];
  }
  $revenueYears ="";
  if ($row['heading'] == "Revenue growth for last")
  {
  $revenueYears = "<select name='revenueYears' ><option value='5' > 5</option> <option value='4' > 4</option><option value='3' > 3</option><option value='2' > 2</option></select> years";
  }
   if ($row['heading'] == "Operating Profit growth for last")
  {
  $revenueYears = "<select name='profitYears' ><option value='5' > 5</option> <option value='4' > 4</option><option value='3' > 3</option><option value='2' > 2</option></select> years";
  }
   if ($row['heading'] == "EPS growth for last")
  {
  $revenueYears = "<select name='epsYears' ><option value='5' > 5</option> <option value='4' > 4</option><option value='3' > 3</option><option value='2' > 2</option></select> years";
  }
?>
<tr id="rw<?php echo $row['id'] ?>"><td><a  class="tooltip">
    <img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $row['heading1'] ?></strong><br />
        <?php echo $row['helptxt'] ?>
    </span>
</a><input type="hidden" name="para[]" value="<?php echo $row['id'] ?>"><?php echo $row['heading']." ".$revenueYears ?> </td><td align="center"><span id="min<?php echo $row['id'] ?>"><?php if($_REQUEST['minCost'.$row['id']]) echo $_REQUEST['minCost'.$row['id']]; else echo 0; ?></span><input type="hidden" id="minCost<?php echo $row['id'] ?>" name="minCost<?php echo $row['id'] ?>" value="<?php if($_REQUEST['minCost'.$row['id']]) echo $_REQUEST['minCost'.$row['id']]; else echo 0; ?>" /></td><td align="center"><div class="slider" id="slider<?php echo $row['id'] ?>"></div></td><td align="center"><span id="max<?php echo $row['id'] ?>"><?php if($_REQUEST['maxCost'.$row['id']]) echo $_REQUEST['maxCost'.$row['id']]; else echo 100; ?></span><input type="hidden" id="maxCost<?php echo $row['id'] ?>" name="maxCost<?php echo $row['id'] ?>" value=" <?php if($_REQUEST['maxCost'.$row['id']]) echo $_REQUEST['maxCost'.$row['id']]; else echo 100; ?>" /></td><td align="center"><?php if($row['display']==0){ ?> <?php } ?></td></tr>
<?php
}
?>
<tr><td>&nbsp;</td></tr>
<tr><td colspan="4" align="center"><input type="submit" name="search" value="Search"></td></tr>
</table>
</form></div>
<div class="filter-box-right"><div class="clear12"></div><a  class="tooltipSearch">
    <img align="bottom" src="images/help.jpg" width="80" height="80" >
    <span>
        <strong style="color:#009900">How to Filter Companies?</strong><br />
        
        1. You can filter comapnies based on 13 parameters<br>
        2. Move the slider of the particular parameter if you want to include that parameter for the search<br>
        3. If you don't move the slider that parameter will not be considered in the search<br>
        4. Click on search button <br>
        5. For the first 3 parameters you can change the number of years to be considered <br>
       <strong>Use the below link "Using Filter tool effectively" to know how to use Filter tool effectively</strong><br>
    </span>
</a><h3>How to Filter?</h3><br><a href="FilteredCompanies.php" target="_blank" ><img src="images/alreadyAnalyzed.jpg"  width="80" height="80" border="0" align="bottom"></a><h3>Using Filter tool effectively</h3></div>
<div class="clear5"></div>
<?php
if ( isset( $_GET['subfrm'] ) )
{

  // print_r($_GET);
   $revenue_growth_min=$_REQUEST['minCost'.$_REQUEST['para'][0]];
   $_SESSION['revmin'] = $revenue_growth_min;
   $revenue_growth_max=$_REQUEST['maxCost'.$_REQUEST['para'][0]];
   if ($revenue_growth_max ==100) { $revenue_growth_max =10000 ;} //changing 100 to 10000 as some comanies has one or 2 year with more than 100 % increase in sales
   $revenueYears= $_REQUEST['revenueYears'];
   $profitYears= $_REQUEST['profitYears'];
   $epsYears= $_REQUEST['epsYears'];
  
   $profit_growth_min=$_REQUEST['minCost'.$_REQUEST['para'][1]];
   $profit_growth_max=$_REQUEST['maxCost'.$_REQUEST['para'][1]];
   if ($profit_growth_max ==100) { $profit_growth_max =10000 ;}
   $eps_growth_min=$_REQUEST['minCost'.$_REQUEST['para'][2]];
   $eps_growth_max=$_REQUEST['maxCost'.$_REQUEST['para'][2]];
   if ($eps_growth_max ==100) { $eps_growth_max =10000 ;}

   $GP_min=$_REQUEST['minCost'.$_REQUEST['para'][3]];
   $GP_max=$_REQUEST['maxCost'.$_REQUEST['para'][3]];
   $OP_min=$_REQUEST['minCost'.$_REQUEST['para'][4]];
   $OP_max=$_REQUEST['maxCost'.$_REQUEST['para'][4]];
   $NP_min=$_REQUEST['minCost'.$_REQUEST['para'][5]];
   $NP_max=$_REQUEST['maxCost'.$_REQUEST['para'][5]];
   $SGA_min=$_REQUEST['minCost'.$_REQUEST['para'][6]];
   $SGA_max=$_REQUEST['maxCost'.$_REQUEST['para'][6]];
   $Interest_min=$_REQUEST['minCost'.$_REQUEST['para'][7]];
   $Interest_max=$_REQUEST['maxCost'.$_REQUEST['para'][7]];
   $Dep_min=$_REQUEST['minCost'.$_REQUEST['para'][8]];
   $Dep_max=$_REQUEST['maxCost'.$_REQUEST['para'][8]];
   $Current_min=$_REQUEST['minCost'.$_REQUEST['para'][9]];
   $Current_max=$_REQUEST['maxCost'.$_REQUEST['para'][9]];
   $ROA_min=$_REQUEST['minCost'.$_REQUEST['para'][10]];
   $ROA_max=$_REQUEST['maxCost'.$_REQUEST['para'][10]];
   $DebtEquity_min=$_REQUEST['minCost'.$_REQUEST['para'][11]];
   $DebtEquity_max=$_REQUEST['maxCost'.$_REQUEST['para'][11]];
   $ROE_min=$_REQUEST['minCost'.$_REQUEST['para'][12]];
   $ROE_max=$_REQUEST['maxCost'.$_REQUEST['para'][12]];
   $showcolumn[]="";
   $searchparam[]="";
   for ($icount =0 ; $icount < 13 ; $icount++)
   {	   
   		if ( ($_REQUEST["minCost".$_REQUEST['para'][$icount]] == 0) && ($_REQUEST["maxCost".$_REQUEST['para'][$icount]] == 100))
		{
			continue;
		}
			if ($icount==0)
			{
				$showcolumn[$icount] = "avgSalesGrowth";
				if ($revenueYears ==5)
				{
					$searchparam[$icount]="(SalesGrowth13_14 >= "."$revenue_growth_min and SalesGrowth13_14 <= "."$revenue_growth_max) and "."(SalesGrowth14_15 >= "."$revenue_growth_min and SalesGrowth14_15 <= "."$revenue_growth_max) and "."(SalesGrowth15_16 >= "."$revenue_growth_min and SalesGrowth15_16 <= "."$revenue_growth_max) and "."(SalesGrowth16_17 >= "."$revenue_growth_min and SalesGrowth16_17 <= "."$revenue_growth_max) and "."(SalesGrowth17_18 >= "."$revenue_growth_min and SalesGrowth17_18 <= "."$revenue_growth_max)";
				}
				if ($revenueYears ==4)
				{
					$searchparam[$icount]="(SalesGrowth14_15 >= "."$revenue_growth_min and SalesGrowth14_15 <= "."$revenue_growth_max) and "."(SalesGrowth15_16 >= "."$revenue_growth_min and SalesGrowth15_16 <= "."$revenue_growth_max) and "."(SalesGrowth16_17 >= "."$revenue_growth_min and SalesGrowth16_17 <= "."$revenue_growth_max) and "."(SalesGrowth17_18 >= "."$revenue_growth_min and SalesGrowth17_18 <= "."$revenue_growth_max)";
				}
				if ($revenueYears ==3)
				{
					$searchparam[$icount]="(SalesGrowth15_16 >= "."$revenue_growth_min and SalesGrowth15_16 <= "."$revenue_growth_max) and "."(SalesGrowth16_17 >= "."$revenue_growth_min and SalesGrowth16_17 <= "."$revenue_growth_max) and "."(SalesGrowth17_18 >= "."$revenue_growth_min and SalesGrowth17_18 <= "."$revenue_growth_max)";
				}
				if ($revenueYears ==2)
				{
					$searchparam[$icount]="(SalesGrowth16_17 >= "."$revenue_growth_min and SalesGrowth16_17 <= "."$revenue_growth_max) and "."(SalesGrowth17_18 >= "."$revenue_growth_min and SalesGrowth17_18 <= "."$revenue_growth_max)";
				}
				//echo $searchparam[$icount];
			}
			if ($icount==1)
			{
				$showcolumn[$icount] = "avgProfitGrowth";
				if ($profitYears ==5)
				{
					$searchparam[$icount]="(ProfitGrowth13_14 >= "."$profit_growth_min and ProfitGrowth13_14 <= "."$profit_growth_max) and "."(ProfitGrowth14_15 >= "."$profit_growth_min and ProfitGrowth14_15 <= "."$profit_growth_max) and "."(ProfitGrowth15_16 >= "."$profit_growth_min and ProfitGrowth15_16 <= "."$profit_growth_max) and "."(ProfitGrowth16_17 >= "."$profit_growth_min and ProfitGrowth16_17 <= "."$profit_growth_max) and "."(ProfitGrowth17_18 >= "."$profit_growth_min and ProfitGrowth17_18 <= "."$profit_growth_max)";
				}
				if ($profitYears ==4)
				{
					$searchparam[$icount]="(ProfitGrowth14_15 >= "."$profit_growth_min and ProfitGrowth14_15 <= "."$profit_growth_max) and "."(ProfitGrowth15_16 >= "."$profit_growth_min and ProfitGrowth15_16 <= "."$profit_growth_max) and "."(ProfitGrowth16_17 >= "."$profit_growth_min and ProfitGrowth16_17 <= "."$profit_growth_max) and "."(ProfitGrowth17_18 >= "."$profit_growth_min and ProfitGrowth17_18 <= "."$profit_growth_max)";
				}
				if ($profitYears ==3)
				{
					$searchparam[$icount]="(ProfitGrowth15_16 >= "."$profit_growth_min and ProfitGrowth15_16 <= "."$profit_growth_max) and "."(ProfitGrowth16_17 >= "."$profit_growth_min and ProfitGrowth16_17 <= "."$profit_growth_max) and "."(ProfitGrowth17_18 >= "."$profit_growth_min and ProfitGrowth17_18 <= "."$profit_growth_max)";
				}
				if ($profitYears ==2)
				{
					$searchparam[$icount]="(ProfitGrowth16_17 >= "."$profit_growth_min and ProfitGrowth16_17 <= "."$profit_growth_max) and "."(ProfitGrowth17_18 >= "."$profit_growth_min and ProfitGrowth17_18 <= "."$profit_growth_max)";
				}
				//echo $searchparam[$icount];
			}
			if ($icount==2)
			{	
				
				$showcolumn[$icount] = "avgEPSGrowth";
				if ($epsYears ==5)
				{
					$searchparam[$icount]="(EPSGrowth13_14 >= "."$eps_growth_min and EPSGrowth13_14 <= "."$eps_growth_max) and "."(EPSGrowth14_15 >= "."$eps_growth_min and EPSGrowth14_15 <= "."$eps_growth_max) and "."(EPSGrowth15_16 >= "."$eps_growth_min and EPSGrowth15_16 <= "."$eps_growth_max) and "."(EPSGrowth16_17 >= "."$eps_growth_min and EPSGrowth16_17 <= "."$eps_growth_max) and "."(EPSGrowth17_18 >= "."$eps_growth_min and EPSGrowth17_18 <= "."$eps_growth_max)";
				}
				if ($epsYears ==4)
				{
					$searchparam[$icount]="(EPSGrowth14_15 >= "."$eps_growth_min and EPSGrowth14_15 <= "."$eps_growth_max) and "."(EPSGrowth15_16 >= "."$eps_growth_min and EPSGrowth15_16 <= "."$eps_growth_max) and "."(EPSGrowth16_17 >= "."$eps_growth_min and EPSGrowth16_17 <= "."$eps_growth_max) and "."(EPSGrowth17_18 >= "."$eps_growth_min and EPSGrowth17_18 <= "."$eps_growth_max)";
				}
				if ($epsYears ==3)
				{
					$searchparam[$icount]="(EPSGrowth15_16 >= "."$eps_growth_min and EPSGrowth15_16 <= "."$eps_growth_max) and "."(EPSGrowth16_17 >= "."$eps_growth_min and EPSGrowth16_17 <= "."$eps_growth_max) and "."(EPSGrowth17_18 >= "."$eps_growth_min and EPSGrowth17_18 <= "."$eps_growth_max)";
				}
				if ($epsYears ==2)
				{
					$searchparam[$icount]="(EPSGrowth16_17 >= "."$eps_growth_min and EPSGrowth16_17 <= "."$eps_growth_max) and "."(EPSGrowth17_18 >= "."$eps_growth_min and EPSGrowth17_18 <= "."$eps_growth_max)";
				}
				//echo $searchparam[$icount];
			}
				if ($icount==3)
			{
				$showcolumn[$icount] = "GPmargin";
				$searchparam[$icount]="(GPmargin >= "."$GP_min and GPmargin <= "."$GP_max) and (avgSalesGrowth !=0)and (ReturnOnEquity !=0)";
				//echo $searchparam[$icount];
			}
				if ($icount==4)
			{
				$showcolumn[$icount] = "OPMargin";
				$searchparam[$icount]="(OPMargin >= "."$OP_min and OPMargin <= "."$OP_max) and (avgSalesGrowth !=0)and (ReturnOnEquity !=0)";
				//echo $searchparam[$icount];
			}
				if ($icount==5)
			{
				$showcolumn[$icount] = "NPMargin";
				$searchparam[$icount]="(NPMargin >= "."$NP_min and NPMargin <= "."$NP_max) and (avgSalesGrowth !=0)and (ReturnOnEquity !=0)";
				//echo $searchparam[$icount];
			}
				if ($icount==6)
			{
				$showcolumn[$icount] = "SgaUponGp";
				$searchparam[$icount]="(SgaUponGp >= "."$SGA_min and SgaUponGp <= "."$SGA_max) and (avgSalesGrowth !=0)and (ReturnOnEquity !=0)";
				//echo $searchparam[$icount];
			}
				if ($icount==7)
			{
				$showcolumn[$icount] = "IntUponOP";
				$searchparam[$icount]="(IntUponOP >= "."$Interest_min and IntUponOP <= "."$Interest_max) and (avgSalesGrowth !=0)and (ReturnOnEquity !=0)";
				//echo $searchparam[$icount];
			}
				if ($icount==8)
			{
				$showcolumn[$icount] = "DepUponGp";
				$searchparam[$icount]="(DepUponGp >= "."$Dep_min and DepUponGp <= "."$Dep_max) and (avgSalesGrowth !=0)and (ReturnOnEquity !=0)";
				//echo $searchparam[$icount];
			}
				if ($icount==9)
			{
				$showcolumn[$icount] = "CurretRatio";
				$searchparam[$icount]="(CurretRatio >= "."$Current_min and CurretRatio <= "."$Current_max) and (avgSalesGrowth !=0)and (ReturnOnEquity !=0)";
				//echo $searchparam[$icount];
			}
				if ($icount==10)
			{
				$showcolumn[$icount] = "ReturnOnAssests";
				$searchparam[$icount]="(ReturnOnAssests >= "."$ROA_min and ReturnOnAssests <= "."$ROA_max) and (avgSalesGrowth !=0)and (ReturnOnEquity !=0)";
				//echo $searchparam[$icount];
			}
				if ($icount==11)
			{
				$showcolumn[$icount] = "DebtEquityRatio";
				$searchparam[$icount]="(DebtEquityRatio >= "."$DebtEquity_min and DebtEquityRatio <= "."$DebtEquity_max)and (avgSalesGrowth !=0) and (ReturnOnEquity !=0)";
				//echo $searchparam[$icount];
			}
				if ($icount==12)
			{
				$showcolumn[$icount] = "ReturnOnEquity";
				$searchparam[$icount]="(ReturnOnEquity >= "."$ROE_min and ReturnOnEquity <= "."$ROE_max) and (avgSalesGrowth !=0)";
				//echo $searchparam[$icount];
			}
		
   }
   //CAST(SalesGrowth13_14 AS INT)
  // echo $GP_min."--".$GP_max ;
  
  $showcolumnSql ='';
  $searchparamSql = '';
  $validsqlcount =0 ;
  	for ($isql =0 ; $isql < 13 ; $isql++)
   {
  	 	if ((isset($showcolumn[$isql])) && $showcolumn[$isql] != '')
		{
			if ($validsqlcount ==0)
			{
			$showcolumnSql ="number , name ,"." ".$showcolumn[$isql];
  	 		$searchparamSql = $searchparamSql." ".$searchparam[$isql];
			}
			else
			{
			$showcolumnSql =$showcolumnSql." ,".$showcolumn[$isql];
  	 		$searchparamSql = $searchparamSql." and  ".$searchparam[$isql];
			}
			$validsqlcount = $validsqlcount + 1;
		}
   		
   }
   $searchSql = "select ".$showcolumnSql." from tbl_forsearchonyearlyparameters where ".$searchparamSql ;
  		//echo $searchSql;
  // $searchSql = "select n.number ,n.name ,s.Mar07 as growth7to8 ,s.Mar08,s.Mar09 ,s.Mar10,s.Mar11,b.ReturnOnEquity, p.NPMargin,s.growth13_14,s.growth14_15,s.growth15_16,s.growth16_17 from  name_code n,  sales s , operating_profit o , profit_loss p ,balancesheet b  where n.number = s.companynumber and n.number = o.companynumber and n.number = p.companynumber and p.year='11' and n.number = b.companynumber and b.year ='11'
//and s.growth13_14 >20 and s.growth14_15>20 and s.growth15_16 > 20 and s.growth16_17>20 and s.growth17_18>20
//and o.growth13_14 >20 and o.growth14_15>20 and o.growth15_16 > 20 and o.growth16_17>20 and o.growth17_18>20
//and p.NPMargin >10 and b.ReturnOnEquity >10 limit 1,20";
//echo $searchSql;
$resSearch=mysqli_query($link, $searchSql);
if ($resSearch)
{
	$numofrow = mysqli_num_rows ($resSearch);
}

$category='';
	if ($numofrow == 0)
	{
	echo "No Results"."<br><br>";
	}
	if ($numofrow > 0)
	{
	$numofcolumns = mysqli_num_fields( $resSearch );
	echo "<table width='909' border='0' align='center' bordercolor='#000000' bgcolor='#FFFFFF'> <tr>";
	echo "<td width='15' align='left' valign='top' class='cell'><span class='greytxt14'>";
	echo "Number</span>  </td>";
	
	for ($icount = 0; $icount < $numofcolumns ; $icount++)
	{
	
			if ($icount == 0){}
			else{
				echo "naidu";
			echo "<td width='45' align='left' valign='top' class='cell'><span class='greytxt14'>";
			echo mysqli_field_name($resSearch, $icount);
			echo "</span>  </td>";
			 //$rowtemp = mysqli_fetch_array($resSearch);
			//echo $rowtemp['number']."CompanyNumber"; 
			}
		
	}
	echo "</tr>";
	$numi=1;
	while($row=mysqli_fetch_row($resSearch))
	{
	
   		echo "<tr>";
		echo   "<td width= '65' align='left' valign='top'><span class='greytxt12'>";
		echo $numi; 
		echo "</span>  </td>";
		for ($icount1 = 0; $icount1 < $numofcolumns ; $icount1++)
		{   if ($icount1 ==0){}
			elseif ($icount1 ==1)
			{
				echo "<td width='60' align='left' valign='top'><a href='";
		 		echo "CompanyDetails.php?code=";
		 		echo $row[$icount1-1]; 
		 		echo "' style='color:#000000'  ><span class='greytxt12'>";
				echo $row[$icount1]; 
				echo "</span></a></td>";
			}
			else
			{	echo   "<td width= '65' align='left' valign='top'><span class='greytxt12'>";
				echo $row[$icount1]; 
				echo "</span>  </td>";
			}
		}
		echo "</tr>";
		$numi=$numi+1;
	}
	echo "</table>";
	}
}

function mysqli_field_name($result, $field_offset)
{
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->name : null;
}
 ?>
<div class="clear12"></div>
<div class="clear12"></div>
<div class="clear5"></div>
<?php include("footer.inc.php"); ?>
</body>
</html>