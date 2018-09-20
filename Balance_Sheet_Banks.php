<?php
include("config/config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Analyse Balance Sheet Parameters</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
include("header.inc.php");
?>
<div class="clear5"></div>
 
<table width="850" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<tr><td align="center"><span class="greytxt12"><strong>Balance Sheet analysis- Standalone Data</strong></span></td>
</tr>
</table>
<div align="center">
<table width="909" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">

  
  <?php 
    $searchCompanyCode = $_GET['mcode'];
	$mcode = $_GET['mcode'];
    $testcompanySearch=mysqli_query($link, "select * from balancesheet_banks where year = '18' and companycode = '$searchCompanyCode'");
	$rows_test = mysqli_num_rows($testcompanySearch);
	if ($rows_test == 0 ){
     $companySearch=mysqli_query($link,"select * from balancesheet_banks where year = '17' and companycode = '$searchCompanyCode'"); 	 
	$row5 = mysqli_fetch_array($companySearch);
	$companySearch=mysqli_query($link,"select * from balancesheet_banks where year = '16' and companycode = '$searchCompanyCode'"); 	 
	$row4 = mysqli_fetch_array($companySearch);
	$companySearch=mysqli_query($link,"select * from balancesheet_banks where year = '15' and companycode = '$searchCompanyCode'"); 	 
	$row3 = mysqli_fetch_array($companySearch);
	$companySearch=mysqli_query($link,"select * from balancesheet_banks where year = '14' and companycode = '$searchCompanyCode'"); 	 
	$row2 = mysqli_fetch_array($companySearch);
	$companySearch=mysqli_query($link,"select * from balancesheet_banks where year = '13' and companycode = '$searchCompanyCode'"); 	 
	$row1 = mysqli_fetch_array($companySearch);
	}
	else{
	$companySearch=mysqli_query($link,"select * from balancesheet_banks where year = '18' and companycode = '$searchCompanyCode'"); 	 
	$row5 = mysqli_fetch_array($companySearch);
	$companySearch=mysqli_query($link,"select * from balancesheet_banks where year = '17' and companycode = '$searchCompanyCode'"); 	 
	$row4 = mysqli_fetch_array($companySearch);
	$companySearch=mysqli_query($link,"select * from balancesheet_banks where year = '16' and companycode = '$searchCompanyCode'"); 	 
	$row3 = mysqli_fetch_array($companySearch);
	$companySearch=mysqli_query($link,"select * from balancesheet_banks where year = '15' and companycode = '$searchCompanyCode'"); 	 
	$row2 = mysqli_fetch_array($companySearch);
	$companySearch=mysqli_query($link,"select * from balancesheet_banks where year = '14' and companycode = '$searchCompanyCode'"); 	 
	$row1 = mysqli_fetch_array($companySearch);
	}
	
//for sales start ---------------------------------------------------------------------

	$arrayiTotalIncome[0] = $row1['equityShareCapital'];
	$arrayiTotalIncome[1] = $row2['equityShareCapital'];
	$arrayiTotalIncome[2] = $row3['equityShareCapital'];
	$arrayiTotalIncome[3] = $row4['equityShareCapital'];
	$arrayiTotalIncome[4] = $row5['equityShareCapital'];
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
	?> 
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="80" align="left" valign="top" class="cell">&nbsp;</td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><?php echo $row1['year']; ?></span>  </td> 
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><?php echo "Growth%" ?></span>  </td>
   <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><?php echo $row2['year']; ?></span>  </td>
   <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><?php echo "Growth%" ?></span>  </td>
   <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><?php echo $row3['year']; ?></span>  </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><?php echo "Growth%" ?></span>  </td>
  <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><?php echo $row4['year']; ?></span></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><?php echo "Growth%" ?></span>  </td> 
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14"><?php echo $row5['year']; ?></span>  </td>   
  </tr>
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Equity Share Capital</span></td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
   <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
  //for sales end ---------------------------------------------------------------------?>
    
	<?php 
  //for total income start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['Reserves'];
	$arrayiTotalIncome[1] = $row2['Reserves'];
	$arrayiTotalIncome[2] = $row3['Reserves'];
	$arrayiTotalIncome[3] = $row4['Reserves'];
	$arrayiTotalIncome[4] = $row5['Reserves'];
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
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )|| ($arrayiTotalIncome[$i] == "" ))
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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Reserves</span></td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
    <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for total income end---------------------------------------------------------------------?>
    
        
	<?php 
  //for Gross Profit start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['networth'];
	$arrayiTotalIncome[1] = $row2['networth'];
	$arrayiTotalIncome[2] = $row3['networth'];
	$arrayiTotalIncome[3] = $row4['networth'];
	$arrayiTotalIncome[4] = $row5['networth'];
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
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )  || ($arrayiTotalIncome[$i] == "" ))
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i + 1] == "NA" ) || ($arrayiTotalIncome[$i+1] == "--" ) || ($arrayiTotalIncome[$i+1] == "" ))
		{
			continue;
		}
		
		$arrayiIncomeGrowth[$i] = (((float)$arrayiTotalIncome[$i + 1] - (float)$arrayiTotalIncome[$i])/(float)$arrayiTotalIncome[$i]) * 100;
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
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">Networth</span></td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
   <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Gross profit end---------------------------------------------------------------------?>


	<?php 
  //for Gross Profit Margin start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['Deposits'];
	$arrayiTotalIncome[1] = $row2['Deposits'];
	$arrayiTotalIncome[2] = $row3['Deposits'];
	$arrayiTotalIncome[3] = $row4['Deposits'];
	$arrayiTotalIncome[4] = $row5['Deposits'];
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
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )|| ($arrayiTotalIncome[$i] == "" ))
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
		
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Deposits</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
    <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?>  
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Gross profit Margin end---------------------------------------------------------------------?>


	<?php 
  //for SGA/GP start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['Borrowings'];
	$arrayiTotalIncome[1] = $row2['Borrowings'];
	$arrayiTotalIncome[2] = $row3['Borrowings'];
	$arrayiTotalIncome[3] = $row4['Borrowings'];
	$arrayiTotalIncome[4] = $row5['Borrowings'];
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
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )|| ($arrayiTotalIncome[$i] == "" ))
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
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Borrowings</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
    <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?>  
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for SGA/GP end---------------------------------------------------------------------?> 
    
    
	<?php 
  //for dep/GP start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['TotalDebt'];
	$arrayiTotalIncome[1] = $row2['TotalDebt'];
	$arrayiTotalIncome[2] = $row3['TotalDebt'];
	$arrayiTotalIncome[3] = $row4['TotalDebt'];
	$arrayiTotalIncome[4] = $row5['TotalDebt'];
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
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )|| ($arrayiTotalIncome[$i] == "" ))
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
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">Total Debt</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
     <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
     <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
     <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
    <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?>  
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Dep/GP end---------------------------------------------------------------------?> 
    
    <?php 
  //for Operating Profit start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['totalClProvisions'];
	$arrayiTotalIncome[1] = $row2['totalClProvisions'];
	$arrayiTotalIncome[2] = $row3['totalClProvisions'];
	$arrayiTotalIncome[3] = $row4['totalClProvisions'];
	$arrayiTotalIncome[4] = $row5['totalClProvisions'];
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
		if ( $i==4)
		{
		continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "" ) || ($arrayiTotalIncome[$i] == "0.00" ) || ($arrayiTotalIncome[$i] == "--" ))
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

	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Other Liabilities & Provisions</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
   <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Operating profit end---------------------------------------------------------------------?>
    
    
    
	<?php 
  //for Operating Profit Margin start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['TotalLiabilities'];
	$arrayiTotalIncome[1] = $row2['TotalLiabilities'];
	$arrayiTotalIncome[2] = $row3['TotalLiabilities'];
	$arrayiTotalIncome[3] = $row4['TotalLiabilities'];
	$arrayiTotalIncome[4] = $row5['TotalLiabilities'];
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
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )|| ($arrayiTotalIncome[$i] == "" ))
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
		
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Total Liabilities  </span></td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
     <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?>  
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Operating profit Margin end---------------------------------------------------------------------?>

<?php 
  //for Interest/OP start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['cash'];
	$arrayiTotalIncome[1] = $row2['cash'];
	$arrayiTotalIncome[2] = $row3['cash'];
	$arrayiTotalIncome[3] = $row4['cash'];
	$arrayiTotalIncome[4] = $row5['cash'];
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
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )|| ($arrayiTotalIncome[$i] == "" ))
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
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Cash & Balances with RBI</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
    <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Interest/OP end---------------------------------------------------------------------?> 
    
    <?php 
  //for PBT start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['BalanceWithBanks'];
	$arrayiTotalIncome[1] = $row2['BalanceWithBanks'];
	$arrayiTotalIncome[2] = $row3['BalanceWithBanks'];
	$arrayiTotalIncome[3] = $row4['BalanceWithBanks'];
	$arrayiTotalIncome[4] = $row5['BalanceWithBanks'];
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
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "" ))
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

	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Balance with Banks, Money at Call</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
   <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for PBT end---------------------------------------------------------------------?>
    
        
     <?php 
  //for Net Profit start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['Advances'];
	$arrayiTotalIncome[1] = $row2['Advances'];
	$arrayiTotalIncome[2] = $row3['Advances'];
	$arrayiTotalIncome[3] = $row4['Advances'];
	$arrayiTotalIncome[4] = $row5['Advances'];
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
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Advances</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
   <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Net Profit end---------------------------------------------------------------------?>
    
    
    
	<?php 
  //for Net Profit Margin start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['Investments'];
	$arrayiTotalIncome[1] = $row2['Investments'];
	$arrayiTotalIncome[2] = $row3['Investments'];
	$arrayiTotalIncome[3] = $row4['Investments'];
	$arrayiTotalIncome[4] = $row5['Investments'];
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
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )|| ($arrayiTotalIncome[$i] == "" ))
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
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">Investments</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
    <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Net profit Margin end---------------------------------------------------------------------
	
	?>
    
        
     <?php 
  //for Equity start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['GrossBlock'];
	$arrayiTotalIncome[1] = $row2['GrossBlock'];
	$arrayiTotalIncome[2] = $row3['GrossBlock'];
	$arrayiTotalIncome[3] = $row4['GrossBlock'];
	$arrayiTotalIncome[4] = $row5['GrossBlock'];
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
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )|| ($arrayiTotalIncome[$i] == "" ))
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
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Gross Block</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
    <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Equity end--------------------------------------------------------------------- 
	?>
    
       
     <?php 
  //for dividends start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['AccumulatedDepreciation'];
	$arrayiTotalIncome[1] = $row2['AccumulatedDepreciation'];
	$arrayiTotalIncome[2] = $row3['AccumulatedDepreciation'];
	$arrayiTotalIncome[3] = $row4['AccumulatedDepreciation'];
	$arrayiTotalIncome[4] = $row5['AccumulatedDepreciation'];
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
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" )|| ($arrayiTotalIncome[$i] == "" ))
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
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Accumulated Depreciation</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
    <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for dividends end--------------------------------------------------------------------- 
	?>
    
    
     <?php 
  //for Book value start ---------------------------------------------------------------------

    $arrayiTotalIncome[0] = $row1['NetBlock'];
	$arrayiTotalIncome[1] = $row2['NetBlock'];
	$arrayiTotalIncome[2] = $row3['NetBlock'];
	$arrayiTotalIncome[3] = $row4['NetBlock'];
	$arrayiTotalIncome[4] = $row5['NetBlock'];
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
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "0.00" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "" ))
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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">Net Block</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
   <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Book value end---------------------------------------------------------------------
	?>
        
             <?php 
  //for eps start ---------------------------------------------------------------------

    $arrayiTotalIncome[0] = $row1['CapitalWork'];
	$arrayiTotalIncome[1] = $row2['CapitalWork'];
	$arrayiTotalIncome[2] = $row3['CapitalWork'];
	$arrayiTotalIncome[3] = $row4['CapitalWork'];
	$arrayiTotalIncome[4] = $row5['CapitalWork'];
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
		if ( $i==4)
		{
		continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "" ) || ($arrayiTotalIncome[$i] == "0.00" ) || ($arrayiTotalIncome[$i] == "--" ))
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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Capital Work In Progress</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
   <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for eps end---------------------------------------------------------------------
	?>
    
      
             <?php 
  //for eps start ---------------------------------------------------------------------

    $arrayiTotalIncome[0] = $row1['OtherAssets'];
	$arrayiTotalIncome[1] = $row2['OtherAssets'];
	$arrayiTotalIncome[2] = $row3['OtherAssets'];
	$arrayiTotalIncome[3] = $row4['OtherAssets'];
	$arrayiTotalIncome[4] = $row5['OtherAssets'];
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
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "" ) || ($arrayiTotalIncome[$i] == "0.00" ) || ($arrayiTotalIncome[$i] == "--" ))
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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Other Assets</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
   <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for eps end---------------------------------------------------------------------
	?>
    
    
             <?php 
  //for eps start ---------------------------------------------------------------------

    $arrayiTotalIncome[0] = $row1['TotalAssets'];
	$arrayiTotalIncome[1] = $row2['TotalAssets'];
	$arrayiTotalIncome[2] = $row3['TotalAssets'];
	$arrayiTotalIncome[3] = $row4['TotalAssets'];
	$arrayiTotalIncome[4] = $row5['TotalAssets'];
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
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "" ) || ($arrayiTotalIncome[$i] == "0.00" ) || ($arrayiTotalIncome[$i] == "--" ))
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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Total Assets</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
   <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for eps end---------------------------------------------------------------------
	?>
    
    
             <?php 
  //for eps start ---------------------------------------------------------------------

    $arrayiTotalIncome[0] = $row1['ContingentLiabilities'];
	$arrayiTotalIncome[1] = $row2['ContingentLiabilities'];
	$arrayiTotalIncome[2] = $row3['ContingentLiabilities'];
	$arrayiTotalIncome[3] = $row4['ContingentLiabilities'];
	$arrayiTotalIncome[4] = $row5['ContingentLiabilities'];
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
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "" ) || ($arrayiTotalIncome[$i] == "0.00" ) || ($arrayiTotalIncome[$i] == "--" ))
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
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Contingent Liabilities</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
   <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for eps end---------------------------------------------------------------------
	?>
    
    
             <?php 
  //for eps start ---------------------------------------------------------------------

    $arrayiTotalIncome[0] = $row1['Billsforcollection'];
	$arrayiTotalIncome[1] = $row2['Billsforcollection'];
	$arrayiTotalIncome[2] = $row3['Billsforcollection'];
	$arrayiTotalIncome[3] = $row4['Billsforcollection'];
	$arrayiTotalIncome[4] = $row5['Billsforcollection'];
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
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Bills for collection</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
   <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for eps end---------------------------------------------------------------------
	?>
    
    
             <?php 
  //for eps start ---------------------------------------------------------------------

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
		if ( $i==4)
		{
			continue;
		}
		if ( ($arrayiTotalIncome[$i] == "NA" ) || ($arrayiTotalIncome[$i] == "--" ) || ($arrayiTotalIncome[$i] == "" ) || ($arrayiTotalIncome[$i] == "0.00" ) || ($arrayiTotalIncome[$i] == "--" ))
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
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"> </td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Book Value</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td>
    <?php if ($arrayiIncomeGrowth[0] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[0];?></span>  </td>
     <?php } ?> 
    
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[1] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[1];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
   <?php if ($arrayiIncomeGrowth[2] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[2];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
   <?php if ($arrayiIncomeGrowth[3] > 0 ) {?>
    <td width="69" align="left" valign="top"><span class="greentxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
    <?php } 
	else { ?>
     <td width="69" align="left" valign="top"><span class="redtxt12"><?php echo $arrayiIncomeGrowth[3];?></span>  </td>
     <?php } ?> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
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
<h3></h3></div>

</div>
<div class="inn_box"  align="center"><a href="Profit_Loss_Banks.php?mcode=<?php echo $mcode;?>" ><img align="bottom" src="images/profitloss.jpg"  width="100" height="100" border="0" ></a>
<h3>Analyze Profit & Loss Statements</h3></div>
<div class="inn_box" >
<h3></h3></div>


<div class="clear5"></div>
<?php include("footer.inc.php"); ?>	

</body>
</html>
