<?php
include("config/config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Company Details</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script language="javascript">
function vali_login()
{
 
 // var totalrow=document.ana_frm.elements['parameterData[]'].length;
 
 
 var loginid = "<?php echo $_SESSION['userid'] ;?>";
  if(loginid>0)
  {
  return true;
  }
  else
  {
  	alert("Please login so that you can track your analysis using your user id");
return false;
  }
  
 
}

function vali_login1()
{
 
 // var totalrow=document.ana_frm.elements['parameterData[]'].length;
 
 
 var loginid = "<?php echo $_SESSION['userid'] ;?>";
  if(loginid>0)
  {
  return true;
  }
  else
  {
  	alert("Please login so that you can track your favourites using your user id");
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

 <? 
	 $searchCompanyCode = $_GET['code'];
	 $companynumber = $_GET['code'];
     $companySearch1=mysql_query("select * from name_code where number = $searchCompanyCode ");
	 $row1 = mysql_fetch_array($companySearch1);
	$name = $row1['name'];
	$bseScript = $row1['BSE_Script']; 
	$companyUrl = $row1['company_url']; 
	$mcode = $row1['code']; //money control code
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
	 //to get rating
	
	?>
<table width="850" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<tr><td align="center"><span class="greytxt12"><strong>Company Details - Standalone Data</strong></span></td>
</tr>
</table>
<table width="700" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<tr>
    <td width="300" align="left" valign="top"><span class="greytxt12">Company Name - <? echo $name ?></span> </td><td width="200" align="left" valign="top"><span class="greytxt12">Company Number - <? echo $searchCompanyCode?>             </span>  </td><td width="200" align="left" valign="top"><span class="greytxt12"> BSE Script ID - <? echo "     ".$bseScript?></span> </td>   </tr>
</table>
<div  class="company-detailsleft">

</div>
<div align="center">
<table width="800" border="1" align="center" bordercolor="#333333" bgcolor="#FFFFFF">
<tr >
<td width="40" align="left" valign="top" bordercolor="#FF0000" > </td>
    <td width="66" align="left" valign="top" class="cellcompanydetails"><span class="greytxt14"></span>  </td>
    <td width="66" align="left" valign="top" class="cell"><span class="greytxt14">07</span>  </td>
  	<td width="66" align="left" valign="top" class="cell"><span class="greytxt14">Growth<br>%</span>  </td>
   <td width="66" align="left" valign="top" class="cell"><span class="greytxt14">08</span></td>
  	<td width="66" align="left" valign="top" class="cell"><span class="greytxt14">Growth<br>%</span>  </td>
   <td width="66" align="left" valign="top" class="cell"><span class="greytxt14">09</span>  </td>
  	<td width="66" align="left" valign="top" class="cell"><span class="greytxt14">Growth<br>%</span>  </td>
   <td width="66" align="left" valign="top" class="cell"><span class="greytxt14">10</span></td>
  	<td width="66" align="left" valign="top" class="cell"><span class="greytxt14">Growth<br>%</span>  </td>
   <td width="66" align="left" valign="top" class="cell"><span class="greytxt14">11</span></td>
  	<td width="66" align="left" valign="top" class="cell"><span class="greytxt14">Growth<br>%</span>  </td>
    <td width="66" align="left" valign="top" class="cell"><span class="greytxt14">12</span></td>
    <td width="66" align="left" valign="top" class="cell"><span class="greytxt14">Avg <br>growth%</span>  </td>
    <td width="66" align="left" valign="top" class="cell"><span class="greytxt14">Jun 12</span>  </td>  
	<td width="66" align="left" valign="top" class="cell"><span class="greytxt14">Sep 12</span>  </td>
    <td width="66" align="left" valign="top" class="cell"><span class="greytxt14">Dec 12</span>  </td>
	<td width="66" align="left" valign="top" class="cell"><span class="greytxt14">Quar1/<br> Fy12 %</span>  </td>
    <td width="66" align="left" valign="top" class="cell"><span class="greytxt14">Quar2/<br> Fy12 %</span>  </td>
</tr>
  
  
  <? 
     $companySearch=mysql_query("select * from sales where companynumber = $searchCompanyCode ");?><?php 
	 
	$row = mysql_fetch_array($companySearch);
	
	$arrayiSales[0] = $row['Mar07'];
	$arrayiSales[1] = $row['Mar08'];
	$arrayiSales[2] = $row['Mar09'];
	$arrayiSales[3] = $row['Mar10'];
	$arrayiSales[4] = $row['Mar11'];
	$arrayiSales[5] = $row['Mar12'];
	$avgsalesGrowth = $row['GrowthPer'];
		
	$arrayiGrowth[0] = $row['growth7_8'];
	$arrayiGrowth[1] = $row['growth8_9'];
	$arrayiGrowth[2] = $row['growth9_10'];
	$arrayiGrowth[3] = $row['growth10_11'];
	$arrayiGrowth[4] = $row['growth11_12'];
	
		
	$arrayiGrowth[1] = intval($arrayiGrowth[1]);
	$arrayiGrowth[2] = intval($arrayiGrowth[2]);
	$arrayiGrowth[3] = intval($arrayiGrowth[3]);
	$arrayiGrowth[4] = intval($arrayiGrowth[4]);
	$arrayiGrowth[0] = intval($arrayiGrowth[0]);    		 
	 
	//to get quarterly results
	$companySearch1=mysql_query("select * from data_companies_curr where CompNumber = $searchCompanyCode ");
	$row1 = mysql_fetch_array($companySearch1);
	$arrayQuarter1Sales = $row1['Jun_Sales'];
	
	$arrayQuarter1profit = $row1['Jun_Operating_Profit'];
	
	$arrayQuarter1eps = $row1['Jun_EPS'];
	//-----------------adding Sept data--------------------------
	$arrayQuarter2Sales = $row1['Sep_Sales'];
	$arrayQuarter2eps = $row1['Sep_EPS'];
	$arrayQuarter2profit = $row1['Sep_Operating_Profit'];
	
	//-----------------adding dec data--------------------------
	//$arrayQuarter3Sales = $row1['Dec_Sales'];
	//$arrayQuarter3profit = $row1['Dec_Operating_Profit'];
	//$arrayQuarter3eps = $row1['Dec_EPS'];
	
		
		if ( ($arrayQuarter1Sales != "NA" ) && ($arrayQuarter1Sales != "--" ) && ($arrayQuarter1Sales != "0.00" ) && ($arrayQuarter1Sales != "" ))
		{
			if ( ($arrayiSales[5] != "NA" ) && ($arrayiSales[5] != "--" ) && ($arrayiSales[5] != "0.00" ) && ($arrayiSales[5] != "" ))
			{			
				$quar1persales= ($arrayQuarter1Sales/$arrayiSales[5])*100;
				$quar1persales = intval($quar1persales); 
			}
		}
		if ( ($arrayQuarter2Sales != "NA" ) && ($arrayQuarter2Sales != "--" ) && ($arrayQuarter2Sales != "0.00" ))
		{
		    if ( ($arrayiSales[5] != "NA" ) && ($arrayiSales[5] != "--" ) & ($arrayiSales[5] != "0.00" ))
			{			
			 	$quar2persales= ($arrayQuarter2Sales/$arrayiSales[5])*100;
				$quar2persales = intval($quar2persales);
			}
		}/*
		if ( ($arrayQuarter3Sales != "NA" ) && ($arrayQuarter3Sales != "--" ) && ($arrayQuarter3Sales != "0.00" ))
		{
		    if ( ($arrayiSales[5] != "NA" ) && ($arrayiSales[5] != "--" ) & ($arrayiSales[5] != "0.00" ))
			{			
			 	$quar3persales= ($arrayQuarter3Sales/$arrayiSales[5])*100;
				$quar3persales = intval($quar3persales);
			}
		}
		*/
			//get help
	$arrayHelpHeading[3];
	$arrayHelpText[3];
	$gethelp = mysql_query("select * from tbl_help where page = 'CompanyDetails' order by number"); 
 $ihelp=1;
	while($row_help1=mysql_fetch_array($gethelp))
	{ 
	$arrayHelpHeading[$ihelp] = $row_help1['parameter'];
	$arrayHelpText[$ihelp] = $row_help1['helptext'];
	$ihelp = $ihelp + 1;
	}
	
	
	?> <tr>
     <td width="36" align="left" valign="top"> <a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[1]; ?> </strong><br />
      <?php echo $arrayHelpText[1]; ?>    </span>
</a></td>
    <td width="80" align="left" valign="top" class ="cellcompanydetails"><span class="greytxt14">Sales Cr</span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[0]; ?></span>  </td>
    <? if ($arrayiGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiGrowth[0];?></span>  </td>
     <? } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[1]; ?></span>  </td>
  <? if ($arrayiGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiGrowth[1];?></span>  </td>
     <? } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[2]; ?></span></td>
   <? if ($arrayiGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[3]; ?></span>  </td>
    <? if ($arrayiGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiGrowth[3];?></span>  </td>
     <? } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[4]; ?></span></td>
   <? if ($arrayiGrowth[4] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiGrowth[4];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiGrowth[4];?></span>  </td>
     <? } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[5]; ?></span></td>
 <? if ($avgsalesGrowth > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $avgsalesGrowth;?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $avgsalesGrowth;?></span>  </td>
     <? } ?>
	<td width="45" align="left" valign="top"><span class="greytxt12"><? echo "$arrayQuarter1Sales" ?></span>  </td>  
	<td width="45" align="left" valign="top"><span class="greytxt12"><? echo "$arrayQuarter2Sales" ?></span>  </td>
    <td width="45" align="left" valign="top"><span class="greytxt12"><? echo "Awaited"; ?></span>  </td>
	<td width="45" align="left" valign="top"><span class="greytxt12"><? echo "$quar1persales" ?></span>  </td>
	<td width="45" align="left" valign="top"><span class="greytxt12"><? echo "$quar2persales" ?></span>  </td>
  </tr>
	<? 
     $companySearch=mysql_query("select * from operating_profit where companynumber = $searchCompanyCode ");?><?php 
	$row = mysql_fetch_array($companySearch);
	$arrayiSales[0] = $row['Mar07'];
	$arrayiSales[1] = $row['Mar08'];
	$arrayiSales[2] = $row['Mar09'];
	$arrayiSales[3] = $row['Mar10'];
	$arrayiSales[4] = $row['Mar11'];
	$arrayiSales[5] = $row['Mar12'];
	$avgsalesGrowth = $row['GrowthPer'];
		
	$arrayiGrowth[0] = $row['growth7_8'];
	$arrayiGrowth[1] = $row['growth8_9'];
	$arrayiGrowth[2] = $row['growth9_10'];
	$arrayiGrowth[3] = $row['growth10_11'];
	$arrayiGrowth[4] = $row['growth11_12'];
	
	$arrayiGrowth[1] = intval($arrayiGrowth[1]);
	$arrayiGrowth[2] = intval($arrayiGrowth[2]);
	$arrayiGrowth[3] = intval($arrayiGrowth[3]);
	$arrayiGrowth[4] = intval($arrayiGrowth[4]);
	$arrayiGrowth[0] = intval($arrayiGrowth[0]);    		 
	 
	
	if ( ($arrayQuarter1profit != "NA" ) && ($arrayQuarter1profit != "--" ) && ($arrayQuarter1profit != "0.00" ) && ($arrayQuarter1profit != "" ))
		{
			if ( ($arrayiSales[5] != "NA" ) && ($arrayiSales[5] != "--" ) && ($arrayiSales[5] != "0.00" ) && ($arrayiSales[5] != "" ))
			{			
				$quar1perprofit= ($arrayQuarter1profit/$arrayiSales[5])*100;
				$quar1perprofit = intval($quar1perprofit); 
			}
			
			if ( $arrayiSales[5] < 0 )
			{
			$quar1perprofit  = (($arrayQuarter1profit - $arrayiSales[5])/$arrayiSales[5])*100;
			$quar1perprofit = - $quar1perprofit ;
			$quar1perprofit = intval($quar1perprofit); 
			}
			
		}
		if ( ($arrayQuarter2profit != "NA" ) && ($arrayQuarter2profit != "--" ) && ($arrayQuarter2profit != "0.00" ))
		{
			if ( ($arrayiSales[5] != "NA" ) && ($arrayiSales[5] != "--" ) && ($arrayiSales[5] != "0.00" ))
			{			
				$quar2perprofit= ($arrayQuarter2profit/$arrayiSales[5])*100;
				$quar2perprofit = intval($quar2perprofit); 
			}
			if ( $arrayiSales[5] < 0 )
			{
			$quar2perprofit  = (($arrayQuarter2profit - $arrayiSales[5])/$arrayiSales[5])*100;
			$quar2perprofit = - $quar2perprofit ;
			$quar2perprofit = intval($quar2perprofit); 
			}
		}/*
		if ( ($arrayQuarter3profit != "NA" ) && ($arrayQuarter3profit != "--" ) && ($arrayQuarter3profit != "0.00" ))
		{
			if ( ($arrayiSales[5] != "NA" ) && ($arrayiSales[5] != "--" ) && ($arrayiSales[5] != "0.00" ))
			{			
				$quar3perprofit= ($arrayQuarter3profit/$arrayiSales[5])*100;
				$quar3perprofit = intval($quar3perprofit); 
			}
			
			if ( $arrayiSales[5] < 0 )
			{
			$quar3perprofit  = (($arrayQuarter3profit - $arrayiSales[5])/$arrayiSales[5])*100;
			$quar3perprofit = - $quar3perprofit ;
			$quar3perprofit = intval($quar3perprofit); 
			}
		}*/
		
		?> <tr>
         <td width="36" align="left" valign="top"> <a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[2]; ?> </strong><br />
      <?php echo $arrayHelpText[2]; ?>    </span>
</a></td>
    <td width="66" align="left" valign="top" class="cellcompanydetails"><span class="greytxt14">Operating Profit</span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[0]; ?></span>  </td>
    <? if ($arrayiGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiGrowth[0];?></span>  </td>
     <? } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[1]; ?></span>  </td>
  <? if ($arrayiGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiGrowth[1];?></span>  </td>
     <? } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[2]; ?></span></td>
   <? if ($arrayiGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[3]; ?></span>  </td>
    <? if ($arrayiGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiGrowth[3];?></span>  </td>
     <? } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[4]; ?></span></td>
   <? if ($arrayiGrowth[4] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiGrowth[4];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiGrowth[4];?></span>  </td>
     <? } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[5]; ?></span></td>
 <? if ($avgsalesGrowth > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $avgsalesGrowth;?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $avgsalesGrowth;?></span>  </td>
     <? } ?>
     <td width="45" align="left" valign="top"><span class="greytxt12"><? echo "$arrayQuarter1profit"; ?></span>  </td>  
	<td width="45" align="left" valign="top"><span class="greytxt12"><? echo "$arrayQuarter2profit"; ?></span>  </td>
    <td width="45" align="left" valign="top"><span class="greytxt12"><? echo "Awaited"; ?></span>  </td>
	<td width="45" align="left" valign="top"><span class="greytxt12"><? echo "$quar1perprofit"; ?></span>  </td>
<td width="45" align="left" valign="top"><span class="greytxt12"><? echo "$quar2perprofit"; ?></span>  </td>
	</tr>
	<? 
     $companySearch=mysql_query("select * from eps where companynumber = $searchCompanyCode ");?><?php 
	$row = mysql_fetch_array($companySearch);
	$arrayiSales[0] = $row['Mar07'];
	$arrayiSales[1] = $row['Mar08'];
	$arrayiSales[2] = $row['Mar09'];
	$arrayiSales[3] = $row['Mar10'];
	$arrayiSales[4] = $row['Mar11'];
	$arrayiSales[5] = $row['Mar12'];
	$avgsalesGrowth = $row['GrowthPer'];
		
	$arrayiGrowth[0] = $row['growth7_8'];
	$arrayiGrowth[1] = $row['growth8_9'];
	$arrayiGrowth[2] = $row['growth9_10'];
	$arrayiGrowth[3] = $row['growth10_11'];
	$arrayiGrowth[4] = $row['growth11_12'];
	
	$arrayiGrowth[1] = intval($arrayiGrowth[1]);
	$arrayiGrowth[2] = intval($arrayiGrowth[2]);
	$arrayiGrowth[3] = intval($arrayiGrowth[3]);
	$arrayiGrowth[4] = intval($arrayiGrowth[4]);
	$arrayiGrowth[0] = intval($arrayiGrowth[0]); 

	
	
	if ( ($arrayQuarter1eps != "NA" ) && ($arrayQuarter1eps != "--" ) && ($arrayQuarter1eps != "0.00" ) && ($arrayQuarter1eps != "" ))
		{
			if ( ($arrayiSales[5] != "NA" ) && ($arrayiSales[5] != "--" ) && ($arrayiSales[5] != "" ))
			{			
				$quar1pereps= ($arrayQuarter1eps/$arrayiSales[5])*100;
				$quar1pereps = intval($quar1pereps); 
			}
		}
		if ( ($arrayQuarter2eps != "NA" ) && ($arrayQuarter2eps != "--" ) && ($arrayQuarter2eps != "0.00" ))
		{
			if ( ($arrayiSales[5] != "NA" ) && ($arrayiSales[5] != "--" ) && ($arrayiSales[5] != "0.00" ))
			{			
				$quar2pereps= ($arrayQuarter2eps/$arrayiSales[5])*100;
				$quar2pereps = intval($quar2pereps); 
			}
		}/*
			if ( ($arrayQuarter3eps != "NA" ) && ($arrayQuarter3eps != "--" ) && ($arrayQuarter3eps != "0.00" ))
		{
			if ( ($arrayiSales[5] != "NA" ) && ($arrayiSales[5] != "--" ) && ($arrayiSales[5] != "0.00" ))
			{			
				$quar3pereps= ($arrayQuarter3eps/$arrayiSales[5])*100;
				$quar3pereps = intval($quar3pereps); 
			}
		}*/
		?> <tr>
         <td width="36" align="left" valign="top"> <a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[3]; ?> </strong><br />
      <?php echo $arrayHelpText[3]; ?>    </span>
</a></td>
    <td width="66" align="left" valign="top" class="cellcompanydetails"><span class="greytxt14">Eps    	</span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[0]; ?></span>  </td>
    <? if ($arrayiGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiGrowth[0];?></span>  </td>
     <? } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[1]; ?></span>  </td>
  <? if ($arrayiGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiGrowth[1];?></span>  </td>
     <? } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[2]; ?></span></td>
   <? if ($arrayiGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[3]; ?></span>  </td>
    <? if ($arrayiGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiGrowth[3];?></span>  </td>
     <? } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[4]; ?></span></td>
   <? if ($arrayiGrowth[4] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiGrowth[4];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiGrowth[4];?></span>  </td>
     <? } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSales[5]; ?></span></td>
 <? if ($avgsalesGrowth > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $avgsalesGrowth;?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $avgsalesGrowth;?></span>  </td>
     <? } ?>
	<td width="45" align="left" valign="top"><span class="greytxt12"><? echo "$arrayQuarter1eps"; ?></span>  </td>  
	<td width="45" align="left" valign="top"><span class="greytxt12"><? echo "$arrayQuarter2eps" ?></span>  </td>
    <td width="45" align="left" valign="top"><span class="greytxt12"><? echo "Awaited" ?></span>  </td>
	<td width="45" align="left" valign="top"><span class="greytxt12"><? echo "$quar1pereps" ?></span>  </td>
<td width="45" align="left" valign="top"><span class="greytxt12"><? echo "$quar2pereps" ?></span>  </td>
	</tr>
</table>
</div>
<div class="clear2"></div>

<div align="center">
<div class="inn_box" >
<h3></h3></div>
<div class="inn_box"  align="center"><a href="<? echo $ProfitLossPage ?>?mcode=<? echo $mcode;?>" ><img align="bottom" src="images/profitloss.jpg"  width="100" height="100" border="0" ></a>
<h3>Analyze Profit & Loss Statements</h3></div>
<div class="inn_box" >
<a  onClick="return vali_login()" href="Analyse_Sheet.php?mcode=<? echo $mcode;?>&firsttime=Y&isBank=<? echo $isBank;?>&number=<? echo $companynumber;?>" ><img align="bottom" src="images/analyze.jpg"  width="100" height="100" border="0"></a>
<h3>Analyse Company</h3></div>
<div class="inn_box"  align="center"><a href="<? echo $BalanceSheetPage ?>?mcode=<? echo $mcode;?>" ><img src="images/balancesheet.jpg"  width="140" height="100" border="0" align="bottom"></a>
<h3>Analyze Balance Sheet</h3></div>
<div class="inn_box"  align="center"><a onClick="return vali_login1()" href="<? echo 'Myaccount.php' ;?>?addToFavorites=1&number=<? echo $companynumber;?>" ><img src="images/favorite.jpg"  width="40" height="40" border="0" align="bottom"></a>
<h5>Add to Favorites</h5></div>
</div>
<div class="clear5"></div>
<?php include("footer.inc.php"); ?>
</body>
</html>
