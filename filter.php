<?php
//we have taken (ReturnOnEquity !=0) as a additional parameter in search as currently banks does not have ratio data in balance_sheet_banks and profit_loss_banks table so when search is made like debt to equity ratio as zero , banks are getting displayed as search results as they have no data in tbl_forsearchonyearlyparameters table.Some companies do not have fy12 data so we need to have this filter to avoid displaying these companies
include("config/config.inc.php");
$res=mysql_query("select * from searchoption order by id");


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
  while($row=mysql_fetch_assoc($res))
{ 
  if($_REQUEST['subfrm']==1){
  ?>
    $("#slider<?=$row['id']?>").slider({disabled: <? if($row['display']==0){?>false<? } else {?>false <? } ?>, range: true,min: 0,max: 100,step: .1,values: [ <?=$_REQUEST['minCost'.$row['id']]?>, <?=$_REQUEST['maxCost'.$row['id']]?>],	slide: function( event, ui ) {
	                                  //alert(ui.values[ 1 ]);
							jQuery("#min<?=$row['id']?>").html(ui.values[0] );
							jQuery("#max<?=$row['id']?>").html(ui.values[1]);							
							jQuery("#minCost<?=$row['id']?>").val(ui.values[0]);
							jQuery("#maxCost<?=$row['id']?>").val(ui.values[1]);
						}					});
						
						<?
  }
  else
  {
?>
    $("#slider<?=$row['id']?>").slider({disabled: <? if($row['display']==0){?>false<? } else {?>false <? } ?>, range: true,min: 0,max: 100,step: .1,values: [ 0, 100],	slide: function( event, ui ) {
	                                  
							jQuery("#min<?=$row['id']?>").html(  ui.values[ 0 ]  );
							jQuery("#max<?=$row['id']?>").html(  ui.values[ 1 ]  );							
							jQuery("#minCost<?=$row['id']?>").val(ui.values[0]);
							jQuery("#maxCost<?=$row['id']?>").val(ui.values[1]);
						}					});
						
						<? } } ?>
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
$res=mysql_query("select * from searchoption order by id");
while($row=mysql_fetch_assoc($res))
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
<tr id="rw<?=$row['id']?>"><td><a  class="tooltip">
    <img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?=$row['heading1']?></strong><br />
        <?=$row['helptxt']?>
    </span>
</a><input type="hidden" name="para[]" value="<?=$row['id']?>"><?=$row['heading']." ".$revenueYears?> </td><td align="center"><span id="min<?=$row['id']?>"><? if($_REQUEST['minCost'.$row['id']]) echo $_REQUEST['minCost'.$row['id']]; else echo 0; ?></span><input type="hidden" id="minCost<?=$row['id']?>" name="minCost<?=$row['id']?>" value="<? if($_REQUEST['minCost'.$row['id']]) echo $_REQUEST['minCost'.$row['id']]; else echo 0; ?>" /></td><td align="center"><div class="slider" id="slider<?=$row['id']?>"></div></td><td align="center"><span id="max<?=$row['id']?>"><? if($_REQUEST['maxCost'.$row['id']]) echo $_REQUEST['maxCost'.$row['id']]; else echo 100; ?></span><input type="hidden" id="maxCost<?=$row['id']?>" name="maxCost<?=$row['id']?>" value="<? if($_REQUEST['maxCost'.$row['id']]) echo $_REQUEST['maxCost'.$row['id']]; else echo 100; ?>" /></td><td align="center"><? if($row['display']==0){?><? } ?></td></tr>
<?
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
if($_REQUEST['subfrm']==1)
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
   		if ( ($_REQUEST['minCost'.$_REQUEST['para'][$icount]] == 0) && ($_REQUEST['maxCost'.$_REQUEST['para'][$icount]] == 100))
		{
		continue;
		}
			if ($icount==0)
			{
				$showcolumn[$icount] = "avgSalesGrowth";
				if ($revenueYears ==5)
				{
					$searchparam[$icount]="(SalesGrowth7_8 >= "."$revenue_growth_min and SalesGrowth7_8 <= "."$revenue_growth_max) and "."(SalesGrowth8_9 >= "."$revenue_growth_min and SalesGrowth8_9 <= "."$revenue_growth_max) and "."(SalesGrowth9_10 >= "."$revenue_growth_min and SalesGrowth9_10 <= "."$revenue_growth_max) and "."(SalesGrowth10_11 >= "."$revenue_growth_min and SalesGrowth10_11 <= "."$revenue_growth_max) and "."(SalesGrowth11_12 >= "."$revenue_growth_min and SalesGrowth11_12 <= "."$revenue_growth_max)";
				}
				if ($revenueYears ==4)
				{
					$searchparam[$icount]="(SalesGrowth8_9 >= "."$revenue_growth_min and SalesGrowth8_9 <= "."$revenue_growth_max) and "."(SalesGrowth9_10 >= "."$revenue_growth_min and SalesGrowth9_10 <= "."$revenue_growth_max) and "."(SalesGrowth10_11 >= "."$revenue_growth_min and SalesGrowth10_11 <= "."$revenue_growth_max) and "."(SalesGrowth11_12 >= "."$revenue_growth_min and SalesGrowth11_12 <= "."$revenue_growth_max)";
				}
				if ($revenueYears ==3)
				{
					$searchparam[$icount]="(SalesGrowth9_10 >= "."$revenue_growth_min and SalesGrowth9_10 <= "."$revenue_growth_max) and "."(SalesGrowth10_11 >= "."$revenue_growth_min and SalesGrowth10_11 <= "."$revenue_growth_max) and "."(SalesGrowth11_12 >= "."$revenue_growth_min and SalesGrowth11_12 <= "."$revenue_growth_max)";
				}
				if ($revenueYears ==2)
				{
					$searchparam[$icount]="(SalesGrowth10_11 >= "."$revenue_growth_min and SalesGrowth10_11 <= "."$revenue_growth_max) and "."(SalesGrowth11_12 >= "."$revenue_growth_min and SalesGrowth11_12 <= "."$revenue_growth_max)";
				}
				//echo $searchparam[$icount];
			}
			if ($icount==1)
			{
				$showcolumn[$icount] = "avgProfitGrowth";
				if ($profitYears ==5)
				{
					$searchparam[$icount]="(ProfitGrowth7_8 >= "."$profit_growth_min and ProfitGrowth7_8 <= "."$profit_growth_max) and "."(ProfitGrowth8_9 >= "."$profit_growth_min and ProfitGrowth8_9 <= "."$profit_growth_max) and "."(ProfitGrowth9_10 >= "."$profit_growth_min and ProfitGrowth9_10 <= "."$profit_growth_max) and "."(ProfitGrowth10_11 >= "."$profit_growth_min and ProfitGrowth10_11 <= "."$profit_growth_max) and "."(ProfitGrowth11_12 >= "."$profit_growth_min and ProfitGrowth11_12 <= "."$profit_growth_max)";
				}
				if ($profitYears ==4)
				{
					$searchparam[$icount]="(ProfitGrowth8_9 >= "."$profit_growth_min and ProfitGrowth8_9 <= "."$profit_growth_max) and "."(ProfitGrowth9_10 >= "."$profit_growth_min and ProfitGrowth9_10 <= "."$profit_growth_max) and "."(ProfitGrowth10_11 >= "."$profit_growth_min and ProfitGrowth10_11 <= "."$profit_growth_max) and "."(ProfitGrowth11_12 >= "."$profit_growth_min and ProfitGrowth11_12 <= "."$profit_growth_max)";
				}
				if ($profitYears ==3)
				{
					$searchparam[$icount]="(ProfitGrowth9_10 >= "."$profit_growth_min and ProfitGrowth9_10 <= "."$profit_growth_max) and "."(ProfitGrowth10_11 >= "."$profit_growth_min and ProfitGrowth10_11 <= "."$profit_growth_max) and "."(ProfitGrowth11_12 >= "."$profit_growth_min and ProfitGrowth11_12 <= "."$profit_growth_max)";
				}
				if ($profitYears ==2)
				{
					$searchparam[$icount]="(ProfitGrowth10_11 >= "."$profit_growth_min and ProfitGrowth10_11 <= "."$profit_growth_max) and "."(ProfitGrowth11_12 >= "."$profit_growth_min and ProfitGrowth11_12 <= "."$profit_growth_max)";
				}
				//echo $searchparam[$icount];
			}
			if ($icount==2)
			{	
				
				$showcolumn[$icount] = "avgEPSGrowth";
				if ($epsYears ==5)
				{
					$searchparam[$icount]="(EPSGrowth7_8 >= "."$eps_growth_min and EPSGrowth7_8 <= "."$eps_growth_max) and "."(EPSGrowth8_9 >= "."$eps_growth_min and EPSGrowth8_9 <= "."$eps_growth_max) and "."(EPSGrowth9_10 >= "."$eps_growth_min and EPSGrowth9_10 <= "."$eps_growth_max) and "."(EPSGrowth10_11 >= "."$eps_growth_min and EPSGrowth10_11 <= "."$eps_growth_max) and "."(EPSGrowth11_12 >= "."$eps_growth_min and EPSGrowth11_12 <= "."$eps_growth_max)";
				}
				if ($epsYears ==4)
				{
					$searchparam[$icount]="(EPSGrowth8_9 >= "."$eps_growth_min and EPSGrowth8_9 <= "."$eps_growth_max) and "."(EPSGrowth9_10 >= "."$eps_growth_min and EPSGrowth9_10 <= "."$eps_growth_max) and "."(EPSGrowth10_11 >= "."$eps_growth_min and EPSGrowth10_11 <= "."$eps_growth_max) and "."(EPSGrowth11_12 >= "."$eps_growth_min and EPSGrowth11_12 <= "."$eps_growth_max)";
				}
				if ($epsYears ==3)
				{
					$searchparam[$icount]="(EPSGrowth9_10 >= "."$eps_growth_min and EPSGrowth9_10 <= "."$eps_growth_max) and "."(EPSGrowth10_11 >= "."$eps_growth_min and EPSGrowth10_11 <= "."$eps_growth_max) and "."(EPSGrowth11_12 >= "."$eps_growth_min and EPSGrowth11_12 <= "."$eps_growth_max)";
				}
				if ($epsYears ==2)
				{
					$searchparam[$icount]="(EPSGrowth10_11 >= "."$eps_growth_min and EPSGrowth10_11 <= "."$eps_growth_max) and "."(EPSGrowth11_12 >= "."$eps_growth_min and EPSGrowth11_12 <= "."$eps_growth_max)";
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
   //CAST(SalesGrowth7_8 AS INT)
  // echo $GP_min."--".$GP_max ;
  $showcolumnSql ='';
  $searchparamSql = '';
  $validsqlcount =0 ;
  	for ($isql =0 ; $isql < 13 ; $isql++)
   {
  	 	if ($showcolumn[$isql] != '')
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
  		echo $searchSql;
  // $searchSql = "select n.number ,n.name ,s.Mar07 as growth7to8 ,s.Mar08,s.Mar09 ,s.Mar10,s.Mar11,b.ReturnOnEquity, p.NPMargin,s.growth7_8,s.growth8_9,s.growth9_10,s.growth10_11 from  name_code n,  sales s , operating_profit o , profit_loss p ,balancesheet b  where n.number = s.companynumber and n.number = o.companynumber and n.number = p.companynumber and p.year='11' and n.number = b.companynumber and b.year ='11'
//and s.growth7_8 >20 and s.growth8_9>20 and s.growth9_10 > 20 and s.growth10_11>20 and s.growth11_12>20
//and o.growth7_8 >20 and o.growth8_9>20 and o.growth9_10 > 20 and o.growth10_11>20 and o.growth11_12>20
//and p.NPMargin >10 and b.ReturnOnEquity >10 limit 1,20";
//echo $searchSql;
$resSearch=mysql_query($searchSql);
if ($resSearch)
{
$numofrow = mysql_num_rows ($resSearch);
}

$category='';
	if ($numofrow == 0)
	{
	echo "No Results"."<br><br>";
	}
	if ($numofrow > 0)
	{
	$numofcolumns = mysql_num_fields ( $resSearch );
	echo "<table width='909' border='0' align='center' bordercolor='#000000' bgcolor='#FFFFFF'> <tr>";
	echo "<td width='15' align='left' valign='top' class='cell'><span class='greytxt14'>";
	echo "Number</span>  </td>";
	
	for ($icount = 0; $icount < $numofcolumns ; $icount++)
	{
	
			if ($icount == 0){}
			else{
			echo "<td width='45' align='left' valign='top' class='cell'><span class='greytxt14'>";
			echo mysql_field_name($resSearch, $icount);
			echo "</span>  </td>";
			}
		
	}
	echo "</tr>";
	$numi=1;
	while($row=mysql_fetch_row($resSearch))
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
?>
<div class="clear12"></div>
<div class="clear12"></div>
<div class="clear5"></div>
<?php include("footer.inc.php"); ?>
</body>
</html>
