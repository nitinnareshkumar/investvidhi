<?php
include("config/config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Analyse Profit and Loss Parameters</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
include("header.inc.php");
?>
<div class="clear5"></div>
 
<table width="850" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<tr><td align="center"><span class="greytxt12"><strong>Profit & Loss Statement analysis- Standalone Data</strong></span></td>
</tr>
</table>

<div align="center">
<table width="909" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">

  
  <?php 
    $searchCompanyCode = $_GET['mcode'];
	$mcode = $_GET['mcode'];
    $testcompanySearch=mysql_query("select * from profit_loss_banks where year = '12' and companycode = '$searchCompanyCode'");
	$rows_test = mysql_num_rows($testcompanySearch);
	if ($rows_test == 0 ){
     $companySearch=mysql_query("select * from profit_loss_banks where year = '11' and companycode = '$searchCompanyCode'"); 	 
	$row5 = mysql_fetch_array($companySearch);
	$companySearch=mysql_query("select * from profit_loss_banks where year = '10' and companycode = '$searchCompanyCode'"); 	 
	$row4 = mysql_fetch_array($companySearch);
	$companySearch=mysql_query("select * from profit_loss_banks where year = '09' and companycode = '$searchCompanyCode'"); 	 
	$row3 = mysql_fetch_array($companySearch);
	$companySearch=mysql_query("select * from profit_loss_banks where year = '08' and companycode = '$searchCompanyCode'"); 	 
	$row2 = mysql_fetch_array($companySearch);
	$companySearch=mysql_query("select * from profit_loss_banks where year = '07' and companycode = '$searchCompanyCode'"); 	 
	$row1 = mysql_fetch_array($companySearch);
	}
	else{
	$companySearch=mysql_query("select * from profit_loss_banks where year = '12' and companycode = '$searchCompanyCode'"); 	 
	$row5 = mysql_fetch_array($companySearch);
	$companySearch=mysql_query("select * from profit_loss_banks where year = '11' and companycode = '$searchCompanyCode'"); 	 
	$row4 = mysql_fetch_array($companySearch);
	$companySearch=mysql_query("select * from profit_loss_banks where year = '10' and companycode = '$searchCompanyCode'"); 	 
	$row3 = mysql_fetch_array($companySearch);
	$companySearch=mysql_query("select * from profit_loss_banks where year = '09' and companycode = '$searchCompanyCode'"); 	 
	$row2 = mysql_fetch_array($companySearch);
	$companySearch=mysql_query("select * from profit_loss_banks where year = '08' and companycode = '$searchCompanyCode'"); 	 
	$row1 = mysql_fetch_array($companySearch);
	}
	
//for sales start ---------------------------------------------------------------------

	$arrayiTotalIncome[0] = $row1['InterestEarned'];
	$arrayiTotalIncome[1] = $row2['InterestEarned'];
	$arrayiTotalIncome[2] = $row3['InterestEarned'];
	$arrayiTotalIncome[3] = $row4['InterestEarned'];
	$arrayiTotalIncome[4] = $row5['InterestEarned'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		$arrayiRevenue[0] = $arrayiTotalIncome[0] ;
		$arrayiRevenue[1] = $arrayiTotalIncome[1] ;
		$arrayiRevenue[2] = $arrayiTotalIncome[2] ;
		$arrayiRevenue[3] = $arrayiTotalIncome[3] ;
		$arrayiRevenue[4] = $arrayiTotalIncome[4] ;  
		
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "NULL" ) || ($arrayiTotalIncome[$i] == "" ) )
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
	
	
	?> 
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="80" align="left" valign="top" class="cell">&nbsp;</td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><? echo $row1['year']; ?></span>  </td> 
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><? echo "Growth%" ?></span>  </td>
   <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><? echo $row2['year']; ?></span>  </td>
   <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><? echo "Growth%" ?></span>  </td>
   <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><? echo $row3['year']; ?></span>  </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><? echo "Growth%" ?></span>  </td>
  <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><? echo $row4['year']; ?></span></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><? echo "Growth%" ?></span>  </td> 
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><? echo $row5['year']; ?></span>  </td>   
  </tr>
  
  <tr bordercolor="#000000">
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Interest Earned </span></td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td>
    <? if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
     <? } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
   <? if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
  //for sales end ---------------------------------------------------------------------?>
    
	<?php 
  //for total income start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['OtherIncome'];
	$arrayiTotalIncome[1] = $row2['OtherIncome'];
	$arrayiTotalIncome[2] = $row3['OtherIncome'];
	$arrayiTotalIncome[3] = $row4['OtherIncome'];
	$arrayiTotalIncome[4] = $row5['OtherIncome'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);

	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )|| ($arrayiTotalIncome[$i] == "" ))
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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Other Income</span></td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <? if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
    <? if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
    <? if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
    <? if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for total income end---------------------------------------------------------------------?>
    
        
	<?php 
  //for Gross Profit start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['TotalIncome'];
	$arrayiTotalIncome[1] = $row2['TotalIncome'];
	$arrayiTotalIncome[2] = $row3['TotalIncome'];
	$arrayiTotalIncome[3] = $row4['TotalIncome'];
	$arrayiTotalIncome[4] = $row5['TotalIncome'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		$arrayiGrossProfit[0] = $arrayiTotalIncome[0] ;
		$arrayiGrossProfit[1] = $arrayiTotalIncome[1] ;
		$arrayiGrossProfit[2] = $arrayiTotalIncome[2] ;
		$arrayiGrossProfit[3] = $arrayiTotalIncome[3] ;
		$arrayiGrossProfit[4] = $arrayiTotalIncome[4] ; 
		
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )  || ($arrayiTotalIncome[$i] == "" ))
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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">Total Income</span></td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td>
    <? if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
     <? } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
   <? if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Gross profit end---------------------------------------------------------------------?>


	<?php 
  //for Gross Profit Margin start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['InterestExpended'];
	$arrayiTotalIncome[1] = $row2['InterestExpended'];
	$arrayiTotalIncome[2] = $row3['InterestExpended'];
	$arrayiTotalIncome[3] = $row4['InterestExpended'];
	$arrayiTotalIncome[4] = $row5['InterestExpended'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		$arrayiGrossProfit[0] = $arrayiTotalIncome[0] ;
		$arrayiGrossProfit[1] = $arrayiTotalIncome[1] ;
		$arrayiGrossProfit[2] = $arrayiTotalIncome[2] ;
		$arrayiGrossProfit[3] = $arrayiTotalIncome[3] ;
		$arrayiGrossProfit[4] = $arrayiTotalIncome[4] ; 
		
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )  || ($arrayiTotalIncome[$i] == "" ))
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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Interest Expended</span></td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td>
    <? if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
     <? } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
   <? if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Gross profit end---------------------------------------------------------------------?>

	<?php 
  //for SGA/GP start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['EmployeeCost'];
	$arrayiTotalIncome[1] = $row2['EmployeeCost'];
	$arrayiTotalIncome[2] = $row3['EmployeeCost'];
	$arrayiTotalIncome[3] = $row4['EmployeeCost'];
	$arrayiTotalIncome[4] = $row5['EmployeeCost'];
$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		$arrayiGrossProfit[0] = $arrayiTotalIncome[0] ;
		$arrayiGrossProfit[1] = $arrayiTotalIncome[1] ;
		$arrayiGrossProfit[2] = $arrayiTotalIncome[2] ;
		$arrayiGrossProfit[3] = $arrayiTotalIncome[3] ;
		$arrayiGrossProfit[4] = $arrayiTotalIncome[4] ; 
		
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )  || ($arrayiTotalIncome[$i] == "" ))
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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Employee Cost</span></td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td>
    <? if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
     <? } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
   <? if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Gross profit end---------------------------------------------------------------------?>
    
	<?php 
  //for dep/GP start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['SGA'];
	$arrayiTotalIncome[1] = $row2['SGA'];
	$arrayiTotalIncome[2] = $row3['SGA'];
	$arrayiTotalIncome[3] = $row4['SGA'];
	$arrayiTotalIncome[4] = $row5['SGA'];
$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		$arrayiGrossProfit[0] = $arrayiTotalIncome[0] ;
		$arrayiGrossProfit[1] = $arrayiTotalIncome[1] ;
		$arrayiGrossProfit[2] = $arrayiTotalIncome[2] ;
		$arrayiGrossProfit[3] = $arrayiTotalIncome[3] ;
		$arrayiGrossProfit[4] = $arrayiTotalIncome[4] ; 
		
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )  || ($arrayiTotalIncome[$i] == "" ))
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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Selling and Admin Expenses</span></td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td>
    <? if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
     <? } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
   <? if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Gross profit end---------------------------------------------------------------------?>
    
    <?php 
  //for Operating Profit start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['Depreciation'];
	$arrayiTotalIncome[1] = $row2['Depreciation'];
	$arrayiTotalIncome[2] = $row3['Depreciation'];
	$arrayiTotalIncome[3] = $row4['Depreciation'];
	$arrayiTotalIncome[4] = $row5['Depreciation'];
$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		$arrayiGrossProfit[0] = $arrayiTotalIncome[0] ;
		$arrayiGrossProfit[1] = $arrayiTotalIncome[1] ;
		$arrayiGrossProfit[2] = $arrayiTotalIncome[2] ;
		$arrayiGrossProfit[3] = $arrayiTotalIncome[3] ;
		$arrayiGrossProfit[4] = $arrayiTotalIncome[4] ; 
		
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )  || ($arrayiTotalIncome[$i] == "" ))
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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Depreciation</span></td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td>
    <? if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
     <? } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
   <? if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Gross profit end---------------------------------------------------------------------?>
    
    
	<?php 
  //for Operating Profit Margin start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['MiscellaneousExpenses'];
	$arrayiTotalIncome[1] = $row2['MiscellaneousExpenses'];
	$arrayiTotalIncome[2] = $row3['MiscellaneousExpenses'];
	$arrayiTotalIncome[3] = $row4['MiscellaneousExpenses'];
	$arrayiTotalIncome[4] = $row5['MiscellaneousExpenses'];
$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		$arrayiGrossProfit[0] = $arrayiTotalIncome[0] ;
		$arrayiGrossProfit[1] = $arrayiTotalIncome[1] ;
		$arrayiGrossProfit[2] = $arrayiTotalIncome[2] ;
		$arrayiGrossProfit[3] = $arrayiTotalIncome[3] ;
		$arrayiGrossProfit[4] = $arrayiTotalIncome[4] ; 
		
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )  || ($arrayiTotalIncome[$i] == "" ))
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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Miscellaneous Expenses</span></td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td>
    <? if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
     <? } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
   <? if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Gross profit end---------------------------------------------------------------------?>

<?php 
  //for Interest/OP start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['OperatingExpenses'];
	$arrayiTotalIncome[1] = $row2['OperatingExpenses'];
	$arrayiTotalIncome[2] = $row3['OperatingExpenses'];
	$arrayiTotalIncome[3] = $row4['OperatingExpenses'];
	$arrayiTotalIncome[4] = $row5['OperatingExpenses'];
$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		$arrayiGrossProfit[0] = $arrayiTotalIncome[0] ;
		$arrayiGrossProfit[1] = $arrayiTotalIncome[1] ;
		$arrayiGrossProfit[2] = $arrayiTotalIncome[2] ;
		$arrayiGrossProfit[3] = $arrayiTotalIncome[3] ;
		$arrayiGrossProfit[4] = $arrayiTotalIncome[4] ; 
		
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )  || ($arrayiTotalIncome[$i] == "" ))
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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">Operating Expenses</span></td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td>
    <? if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
     <? } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
   <? if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Gross profit end---------------------------------------------------------------------?>
    <?php 
  //for PBT start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['Provisions'];
	$arrayiTotalIncome[1] = $row2['Provisions'];
	$arrayiTotalIncome[2] = $row3['Provisions'];
	$arrayiTotalIncome[3] = $row4['Provisions'];
	$arrayiTotalIncome[4] = $row5['Provisions'];
$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		$arrayiGrossProfit[0] = $arrayiTotalIncome[0] ;
		$arrayiGrossProfit[1] = $arrayiTotalIncome[1] ;
		$arrayiGrossProfit[2] = $arrayiTotalIncome[2] ;
		$arrayiGrossProfit[3] = $arrayiTotalIncome[3] ;
		$arrayiGrossProfit[4] = $arrayiTotalIncome[4] ; 
		
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )  || ($arrayiTotalIncome[$i] == "" ))
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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Provisions</span></td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td>
    <? if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
     <? } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
   <? if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
   <?php 
    //for Gross profit end---------------------------------------------------------------------?>
    
        
     <?php 
  //for Net Profit start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['TotalExpenses'];
	$arrayiTotalIncome[1] = $row2['TotalExpenses'];
	$arrayiTotalIncome[2] = $row3['TotalExpenses'];
	$arrayiTotalIncome[3] = $row4['TotalExpenses'];
	$arrayiTotalIncome[4] = $row5['TotalExpenses'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);

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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Total Expenses</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td>
    <? if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
     <? } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
   <? if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Net Profit end---------------------------------------------------------------------?>
    
    
    
	<?php 
  //for Net Profit Margin start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['NetProfit'];
	$arrayiTotalIncome[1] = $row2['NetProfit'];
	$arrayiTotalIncome[2] = $row3['NetProfit'];
	$arrayiTotalIncome[3] = $row4['NetProfit'];
	$arrayiTotalIncome[4] = $row5['NetProfit'];
	$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);

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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">Net Profit</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td>
    <? if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
     <? } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
   <? if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Net Profit end---------------------------------------------------------------------?>
    
        
     <?php 
  //for Equity start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['Eps'];
	$arrayiTotalIncome[1] = $row2['Eps'];
	$arrayiTotalIncome[2] = $row3['Eps'];
	$arrayiTotalIncome[3] = $row4['Eps'];
	$arrayiTotalIncome[4] = $row5['Eps'];
	$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);

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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">EPS</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td>
    <? if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
     <? } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
   <? if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
   <?php 
    //for Net Profit end---------------------------------------------------------------------?>
    
       
     <?php 
  //for dividends start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['EquityDividend'];
	$arrayiTotalIncome[1] = $row2['EquityDividend'];
	$arrayiTotalIncome[2] = $row3['EquityDividend'];
	$arrayiTotalIncome[3] = $row4['EquityDividend'];
	$arrayiTotalIncome[4] = $row5['EquityDividend'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);

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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Equity Dividend</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td>
    <? if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
     <? } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
   <? if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Net Profit end---------------------------------------------------------------------?>
   
    
     <?php 
  //for Book value start ---------------------------------------------------------------------

    $arrayiTotalIncome[0] = $row1['BookValue'];
	$arrayiTotalIncome[1] = $row2['BookValue'];
	$arrayiTotalIncome[2] = $row3['BookValue'];
	$arrayiTotalIncome[3] = $row4['BookValue'];
	$arrayiTotalIncome[4] = $row5['BookValue'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);

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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Book Value</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td>
    <? if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[0];?></span>  </td>
     <? } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[1];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
   <? if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[2];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
   <? if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
    <? } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><? echo $arrayiIncomeGrowth[3];?></span>  </td>
     <? } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Net Profit end---------------------------------------------------------------------?>
   
        
            
</table></div>
<div class="clear2"></div>

<div align="center">
<div class="inn_box" >
<h3></h3></div>
<div class="inn_box"  align="center"></div>

<div class="inn_box"  align="center"><a href="Balance_Sheet_Banks.php?mcode=<? echo $mcode;?>" ><img src="images/balancesheet.jpg"  width="140" height="120" border="0" align="bottom"></a>
<h3>Analyze Balance Sheet</h3></div>
</div>
<div class="clear5"></div>
<?php include("footer.inc.php"); ?>	

</body>
</html>
