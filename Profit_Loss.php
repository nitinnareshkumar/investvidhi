<?php
include("config/config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Analyse Profit and Loss Parameters</title>
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

</script>

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
<div  class="company-detailsleft">

</div>
<div align="center">


  
  <?php 
    $searchCompanyCode = $_GET['mcode'];
	$mcode = $_GET['mcode'];
	
     $companySearch1=mysql_query("select * from name_code where code = '$searchCompanyCode' ");
	 $row1 = mysql_fetch_array($companySearch1);
	$name = $row1['name'];
	$bseScript = $row1['BSE_Script']; 
	$companyUrl = $row1['company_url']; 
	$companynumber = $row1['number']; //money control code
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
	
	
    $testcompanySearch=mysql_query("select * from profit_loss where year = '12' and companycode = '$searchCompanyCode'");
	$rows_test = mysql_num_rows($testcompanySearch);
	if ($rows_test == 0 ){
     $companySearch=mysql_query("select * from profit_loss where year = '11' and companycode = '$searchCompanyCode'"); 	 
	$row5 = mysql_fetch_array($companySearch);
	$companySearch=mysql_query("select * from profit_loss where year = '10' and companycode = '$searchCompanyCode'"); 	 
	$row4 = mysql_fetch_array($companySearch);
	$companySearch=mysql_query("select * from profit_loss where year = '09' and companycode = '$searchCompanyCode'"); 	 
	$row3 = mysql_fetch_array($companySearch);
	$companySearch=mysql_query("select * from profit_loss where year = '08' and companycode = '$searchCompanyCode'"); 	 
	$row2 = mysql_fetch_array($companySearch);
	$companySearch=mysql_query("select * from profit_loss where year = '07' and companycode = '$searchCompanyCode'"); 	 
	$row1 = mysql_fetch_array($companySearch);
	}
	else{
	$companySearch=mysql_query("select * from profit_loss where year = '12' and companycode = '$searchCompanyCode'"); 	 
	$row5 = mysql_fetch_array($companySearch);
	$companySearch=mysql_query("select * from profit_loss where year = '11' and companycode = '$searchCompanyCode'"); 	 
	$row4 = mysql_fetch_array($companySearch);
	$companySearch=mysql_query("select * from profit_loss where year = '10' and companycode = '$searchCompanyCode'"); 	 
	$row3 = mysql_fetch_array($companySearch);
	$companySearch=mysql_query("select * from profit_loss where year = '09' and companycode = '$searchCompanyCode'"); 	 
	$row2 = mysql_fetch_array($companySearch);
	$companySearch=mysql_query("select * from profit_loss where year = '08' and companycode = '$searchCompanyCode'"); 	 
	$row1 = mysql_fetch_array($companySearch);
	}
	
//for sales start ---------------------------------------------------------------------

	$arrayiTotalIncome[0] = $row1['salesTurnover'];
	$arrayiTotalIncome[1] = $row2['salesTurnover'];
	$arrayiTotalIncome[2] = $row3['salesTurnover'];
	$arrayiTotalIncome[3] = $row4['salesTurnover'];
	$arrayiTotalIncome[4] = $row5['salesTurnover'];
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
	//get help
	$arrayHelpHeading[16];
	$arrayHelpText[16];
	$gethelp = mysql_query("select * from tbl_help where page = 'Profit_Loss' order by number"); 
 $ihelp=1;
	while($row_help1=mysql_fetch_array($gethelp))
	{ 
	$arrayHelpHeading[$ihelp] = $row_help1['parameter'];
	$arrayHelpText[$ihelp] = $row_help1['helptext'];
	$ihelp = $ihelp + 1;
	}
	
	
	?> 
    <table width="700" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<tr>
    <td width="300" align="left" valign="top"><span class="greytxt12">Company Name - <? echo $name ?></span> </td><td width="200" align="left" valign="top"><span class="greytxt12">Company Number - <? echo $companynumber?>             </span>  </td><td width="200" align="left" valign="top"><span class="greytxt12"> BSE Script ID - <? echo "     ".$bseScript?></span> </td>   </tr>
</table>
  <table width="909" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
  <tr>
  <td width="36" align="left" valign="top">
   </td>
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
  <td width="36" align="left" valign="top"> <a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[1]; ?> </strong><br />
      <?php echo $arrayHelpText[1]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Sales </span></td>
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

  $arrayiTotalIncome[0] = $row1['totalIncome'];
	$arrayiTotalIncome[1] = $row2['totalIncome'];
	$arrayiTotalIncome[2] = $row3['totalIncome'];
	$arrayiTotalIncome[3] = $row4['totalIncome'];
	$arrayiTotalIncome[4] = $row5['totalIncome'];
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
  <td width="36" align="left" valign="top"></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Total Income</span></td>
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

  $arrayiTotalIncome[0] = $row1['grossProfit'];
	$arrayiTotalIncome[1] = $row2['grossProfit'];
	$arrayiTotalIncome[2] = $row3['grossProfit'];
	$arrayiTotalIncome[3] = $row4['grossProfit'];
	$arrayiTotalIncome[4] = $row5['grossProfit'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[3]; ?> </strong><br />
      <?php echo $arrayHelpText[3]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Gross Profit</span></td>
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

  $arrayiTotalIncome[0] = $row1['grossProfit'];
	$arrayiTotalIncome[1] = $row2['grossProfit'];
	$arrayiTotalIncome[2] = $row3['grossProfit'];
	$arrayiTotalIncome[3] = $row4['grossProfit'];
	$arrayiTotalIncome[4] = $row5['grossProfit'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		/*$arrayiGPmargin[0] = $arrayiTotalIncome[0]/$arrayiRevenue[0] * 100;
		$arrayiGPmargin[1] = $arrayiTotalIncome[1]/$arrayiRevenue[1] * 100;
		$arrayiGPmargin[2] = $arrayiTotalIncome[2]/$arrayiRevenue[2] * 100;
		$arrayiGPmargin[3] = $arrayiTotalIncome[3]/$arrayiRevenue[3] * 100;
		$arrayiGPmargin[4] = $arrayiTotalIncome[4]/$arrayiRevenue[4] * 100;*/
		
		for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiRevenue[$i] == "NA" ) || ($arrayiRevenue[$i] == "--" ) || ($arrayiRevenue[$i] == "0.00" ) || ($arrayiRevenue[$i] == "" ))
		{
			continue;
		}
		$arrayiGPmargin[$i] = $arrayiTotalIncome[$i]/$arrayiRevenue[$i] * 100;
	}
    
	$arrayiGPmargin[1] = intval($arrayiGPmargin[1]);
	$arrayiGPmargin[2] = intval($arrayiGPmargin[2]);
	$arrayiGPmargin[3] = intval($arrayiGPmargin[3]);
	$arrayiGPmargin[0] = intval($arrayiGPmargin[0]); 
	$arrayiGPmargin[4] = intval($arrayiGPmargin[4]);   
	
	
	?> 
  
  <tr >
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[4]; ?> </strong><br />
      <?php echo $arrayHelpText[4]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">GP Margin = <br>
       GP/Sales *100</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiGPmargin[0]; ?></span>  </td> 
    <td width="69" align="left" valign="top"><span class="style20 greytxt12"><span class="style22">
      <?  ?>
    </span></span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiGPmargin[1]; ?></span>  </td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <? ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiGPmargin[2]; ?></span>  </td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <? ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiGPmargin[3]; ?></span></td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <? ?>
    </span>  </td> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiGPmargin[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Gross profit Margin end---------------------------------------------------------------------?>


	<?php 
  //for SGA/GP start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['sGACost'];
	$arrayiTotalIncome[1] = $row2['sGACost'];
	$arrayiTotalIncome[2] = $row3['sGACost'];
	$arrayiTotalIncome[3] = $row4['sGACost'];
	$arrayiTotalIncome[4] = $row5['sGACost'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		/*$arrayiGPmargin[0] = $arrayiTotalIncome[0]/$arrayiRevenue[0] * 100;
		$arrayiGPmargin[1] = $arrayiTotalIncome[1]/$arrayiRevenue[1] * 100;
		$arrayiGPmargin[2] = $arrayiTotalIncome[2]/$arrayiRevenue[2] * 100;
		$arrayiGPmargin[3] = $arrayiTotalIncome[3]/$arrayiRevenue[3] * 100;
		$arrayiGPmargin[4] = $arrayiTotalIncome[4]/$arrayiRevenue[4] * 100;*/
		
		for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiGrossProfit[$i] == "NA" ) || ($arrayiGrossProfit[$i] == "--" ) || ($arrayiGrossProfit[$i] == "0.00" ) || ($arrayiGrossProfit[$i] == "" ))
		{
			continue ;
		}
		$arrayiSGAuponGP[$i] = $arrayiTotalIncome[$i]/$arrayiGrossProfit[$i] * 100;
	}
    
	$arrayiSGAuponGP[1] = intval($arrayiSGAuponGP[1]);
	$arrayiSGAuponGP[2] = intval($arrayiSGAuponGP[2]);
	$arrayiSGAuponGP[3] = intval($arrayiSGAuponGP[3]);
	$arrayiSGAuponGP[0] = intval($arrayiSGAuponGP[0]); 
	$arrayiSGAuponGP[4] = intval($arrayiSGAuponGP[4]);   
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[5]; ?> </strong><br />
      <?php echo $arrayHelpText[5]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">SGA % =<br> SGA/GP * 100</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSGAuponGP[0]; ?></span>  </td> 
    <td width="69" align="left" valign="top" ><span class="style20 greytxt12"><span class="style22">
      <?  ?>
    </span></span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSGAuponGP[1]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <? ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSGAuponGP[2]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <? ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSGAuponGP[3]; ?></span></td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <? ?>
    </span>  </td> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSGAuponGP[4]; ?></span>  </td>
  </tr>
    <?php 
    //for SGA/GP end---------------------------------------------------------------------?> 
    
    
	<?php 
  //for dep/GP start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['depreciation'];
	$arrayiTotalIncome[1] = $row2['depreciation'];
	$arrayiTotalIncome[2] = $row3['depreciation'];
	$arrayiTotalIncome[3] = $row4['depreciation'];
	$arrayiTotalIncome[4] = $row5['depreciation'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		/*$arrayiGPmargin[0] = $arrayiTotalIncome[0]/$arrayiRevenue[0] * 100;
		$arrayiGPmargin[1] = $arrayiTotalIncome[1]/$arrayiRevenue[1] * 100;
		$arrayiGPmargin[2] = $arrayiTotalIncome[2]/$arrayiRevenue[2] * 100;
		$arrayiGPmargin[3] = $arrayiTotalIncome[3]/$arrayiRevenue[3] * 100;
		$arrayiGPmargin[4] = $arrayiTotalIncome[4]/$arrayiRevenue[4] * 100;*/
		
		for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiGrossProfit[$i] == "NA" ) || ($arrayiGrossProfit[$i] == "--" ) || ($arrayiGrossProfit[$i] == "0.00" ) || ($arrayiGrossProfit[$i] == "" ))
		{
			continue ;
		}
		$arrayiSGAuponGP[$i] = $arrayiTotalIncome[$i]/$arrayiGrossProfit[$i] * 100;
	}
    
	$arrayiSGAuponGP[1] = intval($arrayiSGAuponGP[1]);
	$arrayiSGAuponGP[2] = intval($arrayiSGAuponGP[2]);
	$arrayiSGAuponGP[3] = intval($arrayiSGAuponGP[3]);
	$arrayiSGAuponGP[0] = intval($arrayiSGAuponGP[0]); 
	$arrayiSGAuponGP[4] = intval($arrayiSGAuponGP[4]);   
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[6]; ?> </strong><br />
      <?php echo $arrayHelpText[6]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Dep % = <br> Dep/GP * 100</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSGAuponGP[0]; ?></span>  </td> 
    <td width="69" align="left" valign="top" ><span class="style20 greytxt12"><span class="style22">
      <?  ?>
    </span></span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSGAuponGP[1]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <? ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSGAuponGP[2]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <? ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSGAuponGP[3]; ?></span></td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <? ?>
    </span>  </td> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiSGAuponGP[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Dep/GP end---------------------------------------------------------------------?> 
    
    <?php 
  //for Operating Profit start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['operatingProfit'];
	$arrayiTotalIncome[1] = $row2['operatingProfit'];
	$arrayiTotalIncome[2] = $row3['operatingProfit'];
	$arrayiTotalIncome[3] = $row4['operatingProfit'];
	$arrayiTotalIncome[4] = $row5['operatingProfit'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		$arrayiOperatingProfit[0] = $arrayiTotalIncome[0] ;
		$arrayiOperatingProfit[1] = $arrayiTotalIncome[1] ;
		$arrayiOperatingProfit[2] = $arrayiTotalIncome[2] ;
		$arrayiOperatingProfit[3] = $arrayiTotalIncome[3] ;
		$arrayiOperatingProfit[4] = $arrayiTotalIncome[4] ; 
		
	$arrayiIncomeGrowth[1] = 0;
	$arrayiIncomeGrowth[2] = 0;
	$arrayiIncomeGrowth[3] = 0;
	$arrayiIncomeGrowth[0] = 0;
	
	for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "" ) || ($arrayiTotalIncome[$i] == "0.00" ) || ($arrayiTotalIncome[$i] == "--" ))
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[7]; ?> </strong><br />
      <?php echo $arrayHelpText[7]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Operating Profit</span>  </td>
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
    //for Operating profit end---------------------------------------------------------------------?>
    
    
    
	<?php 
  //for Operating Profit Margin start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['operatingProfit'];
	$arrayiTotalIncome[1] = $row2['operatingProfit'];
	$arrayiTotalIncome[2] = $row3['operatingProfit'];
	$arrayiTotalIncome[3] = $row4['operatingProfit'];
	$arrayiTotalIncome[4] = $row5['operatingProfit'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		
		
		for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiRevenue[$i] == "NA" ) || ($arrayiRevenue[$i] == "--" ) || ($arrayiRevenue[$i] == "0.00" ) || ($arrayiRevenue[$i] == "" ))
		{
			continue;
		}
		$arrayiGPmargin[$i] = $arrayiTotalIncome[$i]/$arrayiRevenue[$i] * 100;
	}
    
	$arrayiGPmargin[1] = intval($arrayiGPmargin[1]);
	$arrayiGPmargin[2] = intval($arrayiGPmargin[2]);
	$arrayiGPmargin[3] = intval($arrayiGPmargin[3]);
	$arrayiGPmargin[0] = intval($arrayiGPmargin[0]); 
	$arrayiGPmargin[4] = intval($arrayiGPmargin[4]);   
	
	
	?> 
  
  <tr >
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[8]; ?> </strong><br />
      <?php echo $arrayHelpText[8]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">OP Margin = <br>
      OP/Sales *100</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiGPmargin[0]; ?></span>  </td> 
    <td width="69" align="left" valign="top"><span class="style20 greytxt12"><span class="style22">
      <?  ?>
    </span></span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiGPmargin[1]; ?></span>  </td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <? ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiGPmargin[2]; ?></span>  </td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <? ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiGPmargin[3]; ?></span></td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <? ?>
    </span>  </td> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiGPmargin[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Operating profit Margin end---------------------------------------------------------------------?>

<?php 
  //for Interest/OP start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['interest'];
	$arrayiTotalIncome[1] = $row2['interest'];
	$arrayiTotalIncome[2] = $row3['interest'];
	$arrayiTotalIncome[3] = $row4['interest'];
	$arrayiTotalIncome[4] = $row5['interest'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
	
		
		for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiOperatingProfit[$i] == "NA" ) || ($arrayiOperatingProfit[$i] == "" ) || ($arrayiOperatingProfit[$i] == "--" ) || ($arrayiOperatingProfit[$i] == "0.00" ))
		{
			continue;
		}
		$arrayiIntuponOP[$i] = $arrayiTotalIncome[$i]/$arrayiOperatingProfit[$i] * 100;
	}
    
	$arrayiIntuponOP[1] = intval($arrayiIntuponOP[1]);
	$arrayiIntuponOP[2] = intval($arrayiIntuponOP[2]);
	$arrayiIntuponOP[3] = intval($arrayiIntuponOP[3]);
	$arrayiIntuponOP[0] = intval($arrayiIntuponOP[0]); 
	$arrayiIntuponOP[4] = intval($arrayiIntuponOP[4]);   
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[9]; ?> </strong><br />
      <?php echo $arrayHelpText[9]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">Int % = <br>
      Int/OP * 100</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiIntuponOP[0]; ?></span>  </td> 
    <td width="69" align="left" valign="top" ><span class="style20 greytxt12"><span class="style22">
      <?  ?>
    </span></span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiIntuponOP[1]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <? ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiIntuponOP[2]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <? ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiIntuponOP[3]; ?></span></td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <? ?>
    </span>  </td> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiIntuponOP[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Interest/OP end---------------------------------------------------------------------?> 
    
    <?php 
  //for PBT start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['PBT'];
	$arrayiTotalIncome[1] = $row2['PBT'];
	$arrayiTotalIncome[2] = $row3['PBT'];
	$arrayiTotalIncome[3] = $row4['PBT'];
	$arrayiTotalIncome[4] = $row5['PBT'];
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
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "" ))
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[10]; ?> </strong><br />
      <?php echo $arrayHelpText[10]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">PBT</span>  </td>
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
    //for PBT end---------------------------------------------------------------------?>
    
        
     <?php 
  //for Net Profit start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['netProfit'];
	$arrayiTotalIncome[1] = $row2['netProfit'];
	$arrayiTotalIncome[2] = $row3['netProfit'];
	$arrayiTotalIncome[3] = $row4['netProfit'];
	$arrayiTotalIncome[4] = $row5['netProfit'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[11]; ?> </strong><br />
      <?php echo $arrayHelpText[11]; ?>  
    </span>
</a></td>
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
  //for Net Profit Margin start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['netProfit'];
	$arrayiTotalIncome[1] = $row2['netProfit'];
	$arrayiTotalIncome[2] = $row3['netProfit'];
	$arrayiTotalIncome[3] = $row4['netProfit'];
	$arrayiTotalIncome[4] = $row5['netProfit'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		
		
		for ($i=0 ; $i < 5 ;$i++)
	{
		if ( ($arrayiRevenue[$i] == "NA" ) || ($arrayiRevenue[$i] == "--" ) || ($arrayiRevenue[$i] == "0.00" ) || ($arrayiRevenue[$i] == "" ))
		{
			continue;
		}
		$arrayiGPmargin[$i] = $arrayiTotalIncome[$i]/$arrayiRevenue[$i] * 100;
	}
    
	$arrayiGPmargin[1] = intval($arrayiGPmargin[1]);
	$arrayiGPmargin[2] = intval($arrayiGPmargin[2]);
	$arrayiGPmargin[3] = intval($arrayiGPmargin[3]);
	$arrayiGPmargin[0] = intval($arrayiGPmargin[0]); 
	$arrayiGPmargin[4] = intval($arrayiGPmargin[4]);   
	
	
	?> 
  
  <tr >
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[12]; ?> </strong><br />
      <?php echo $arrayHelpText[12]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">NP Margin = <br>
      Net Profit/Sales</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiGPmargin[0]; ?></span>  </td> 
    <td width="69" align="left" valign="top"><span class="style20 greytxt12"><span class="style22">
      <?  ?>
    </span></span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiGPmargin[1]; ?></span>  </td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <? ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiGPmargin[2]; ?></span>  </td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <? ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiGPmargin[3]; ?></span></td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <? ?>
    </span>  </td> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiGPmargin[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Net profit Margin end---------------------------------------------------------------------
	
	?>
    
        
     <?php 
  //for Equity start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['sharesIssued'];
	$arrayiTotalIncome[1] = $row2['sharesIssued'];
	$arrayiTotalIncome[2] = $row3['sharesIssued'];
	$arrayiTotalIncome[3] = $row4['sharesIssued'];
	$arrayiTotalIncome[4] = $row5['sharesIssued'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);

	
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[13]; ?> </strong><br />
      <?php echo $arrayHelpText[13]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Equity Shares (lakhs)</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <td width="69" align="left" valign="top" ><span class="style20 greytxt12"><span class="style22">
      <?  ?>
    </span></span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <? ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <? ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <? ?>
    </span>  </td> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Equity end--------------------------------------------------------------------- 
	?>
    
       
     <?php 
  //for dividends start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['equityDividends'];
	$arrayiTotalIncome[1] = $row2['equityDividends'];
	$arrayiTotalIncome[2] = $row3['equityDividends'];
	$arrayiTotalIncome[3] = $row4['equityDividends'];
	$arrayiTotalIncome[4] = $row5['equityDividends'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);

	
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[14]; ?> </strong><br />
      <?php echo $arrayHelpText[14]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Equity Dividend(%)</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <td width="69" align="left" valign="top" ><span class="style20 greytxt12"><span class="style22">
      <?  ?>
    </span></span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[1]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <? ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[2]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <? ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[3]; ?></span></td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <? ?>
    </span>  </td> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><? echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for dividends end--------------------------------------------------------------------- 
	?>
    
    
     <?php 
  //for Book value start ---------------------------------------------------------------------

    $arrayiTotalIncome[0] = $row1['bookValue'];
	$arrayiTotalIncome[1] = $row2['bookValue'];
	$arrayiTotalIncome[2] = $row3['bookValue'];
	$arrayiTotalIncome[3] = $row4['bookValue'];
	$arrayiTotalIncome[4] = $row5['bookValue'];
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
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "" ))
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
    <?php 
    //for Book value end---------------------------------------------------------------------
	?>
        
             <?php 
  //for eps start ---------------------------------------------------------------------

    $arrayiTotalIncome[0] = $row1['EPS'];
	$arrayiTotalIncome[1] = $row2['EPS'];
	$arrayiTotalIncome[2] = $row3['EPS'];
	$arrayiTotalIncome[3] = $row4['EPS'];
	$arrayiTotalIncome[4] = $row5['EPS'];
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
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "" ) || ($arrayiTotalIncome[$i] == "0.00" ) || ($arrayiTotalIncome[$i] == "--" ))
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[16]; ?> </strong><br />
      <?php echo $arrayHelpText[16]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">EPS</span>  </td>
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
    //for eps end---------------------------------------------------------------------
	?>
</table></div>
<div class="clear2"></div>

<div align="center">
<div class="inn_box" >
<h3></h3></div>

<div class="inn_box" >
<a  onClick="return vali_login()" href="Analyse_Sheet.php?mcode=<? echo $mcode;?>&firsttime=Y&isBank=<? echo $isBank;?>&number=<? echo $companynumber;?>" ><img align="bottom" src="images/analyze.jpg"  width="100" height="100" border="0"></a>
<h3>Analyse Company</h3></div>
<div class="inn_box"  align="center"><a href="Balance_Sheet.php?mcode=<? echo $mcode;?>" ><img src="images/balancesheet.jpg"  width="100" height="100" border="0" align="bottom"></a>
<h3>Analyze Balance Sheet</h3></div>
</div>


<div class="clear5"></div>
<?php include("footer.inc.php"); ?>	

</body>
</html>
