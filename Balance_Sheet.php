<?php
include("config/config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Analyse Balance Sheet Parameters</title>
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
<tr><td align="center"><span class="greytxt12"><strong>Balance Sheet analysis- Standalone Data</strong></span></td>
</tr>
</table>

<div align="center">


  
  <?php 
    $searchCompanyCode = $_GET['mcode'];
	$mcode = $_GET['mcode'];
	
	$companySearch1=mysqli_query($link, "select * from name_code where code = '$searchCompanyCode' ");
	 $row1 = mysqli_fetch_array($companySearch1);
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
	
    $testcompanySearch=mysqli_query($link, "select * from balancesheet where year = '18' and companycode = '$searchCompanyCode'");
	$rows_test = mysqli_num_rows($testcompanySearch);
	if ($rows_test == 0 ){
     $companySearch=mysqli_query($link, "select * from balancesheet where year = '17' and companycode = '$searchCompanyCode'"); 	 
	$row5 = mysqli_fetch_array($companySearch);
	$companySearch=mysqli_query($link, "select * from balancesheet where year = '16' and companycode = '$searchCompanyCode'"); 	 
	$row4 = mysqli_fetch_array($companySearch);
	$companySearch=mysqli_query($link, "select * from balancesheet where year = '15' and companycode = '$searchCompanyCode'"); 	 
	$row3 = mysqli_fetch_array($companySearch);
	$companySearch=mysqli_query($link, "select * from balancesheet where year = '14' and companycode = '$searchCompanyCode'"); 	 
	$row2 = mysqli_fetch_array($companySearch);
	$companySearch=mysqli_query($link, "select * from balancesheet where year = '13' and companycode = '$searchCompanyCode'"); 	 
	$row1 = mysqli_fetch_array($companySearch);
	}
	else{
	$companySearch=mysqli_query($link, "select * from balancesheet where year = '18' and companycode = '$searchCompanyCode'"); 	 
	$row5 = mysqli_fetch_array($companySearch);
	$companySearch=mysqli_query($link, "select * from balancesheet where year = '17' and companycode = '$searchCompanyCode'"); 	 
	$row4 = mysqli_fetch_array($companySearch);
	$companySearch=mysqli_query($link, "select * from balancesheet where year = '16' and companycode = '$searchCompanyCode'"); 	 
	$row3 = mysqli_fetch_array($companySearch);
	$companySearch=mysqli_query($link, "select * from balancesheet where year = '15' and companycode = '$searchCompanyCode'"); 	 
	$row2 = mysqli_fetch_array($companySearch);
	$companySearch=mysqli_query($link, "select * from balancesheet where year = '14' and companycode = '$searchCompanyCode'"); 	 
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
		//get help
	$arrayHelpHeading[16]='';
	$arrayHelpText[16]='';
	$gethelp = mysqli_query($link, "select * from tbl_help where page = 'Balance_Sheet' order by number"); 
 $ihelp=1;
	while($row_help1=mysqli_fetch_array($gethelp))
	{ 
	$arrayHelpHeading[$ihelp] = $row_help1['parameter'];
	$arrayHelpText[$ihelp] = $row_help1['helptext'];
	$ihelp = $ihelp + 1;
	}
	
	
	
	?> 
    <table width="700" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<tr>
    <td width="300" align="left" valign="top"><span class="greytxt12">Company Name - <?php echo $name ?></span> </td><td width="200" align="left" valign="top"><span class="greytxt12">Company Number - <?php echo $companynumber?>             </span>  </td><td width="200" align="left" valign="top"><span class="greytxt12"> BSE Script ID - <?php echo "     ".$bseScript?></span> </td>   </tr>
</table>

    <table width="909" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
  <tr>
  <td width="36" align="left" valign="top"></td>
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
  
  <tr bordercolor="#000000">
  <td width="36" align="left" valign="top"> <a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[1]; ?> </strong><br />
      <?php echo $arrayHelpText[1]; ?>  
    </span>
</a></td>
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

  $arrayiTotalIncome[0] = $row1['reserves'];
	$arrayiTotalIncome[1] = $row2['reserves'];
	$arrayiTotalIncome[2] = $row3['reserves'];
	$arrayiTotalIncome[3] = $row4['reserves'];
	$arrayiTotalIncome[4] = $row5['reserves'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[2]; ?> </strong><br />
      <?php echo $arrayHelpText[2]; ?>  
    </span>
</a></td>
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

  $arrayiTotalIncome[0] = $row1['securedLoans'];
	$arrayiTotalIncome[1] = $row2['securedLoans'];
	$arrayiTotalIncome[2] = $row3['securedLoans'];
	$arrayiTotalIncome[3] = $row4['securedLoans'];
	$arrayiTotalIncome[4] = $row5['securedLoans'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		 
	
	
	?> 
  
  <tr >
  <td width="36" align="left" valign="top"><a  class="tooltip">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[4]; ?> </strong><br />
      <?php echo $arrayHelpText[4]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Secured Loans</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <td width="69" align="left" valign="top"><span class="style20 greytxt12"><span class="style22">
      <?php  ?>
    </span></span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <?php ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <?php ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <?php ?>
    </span>  </td> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Gross profit Margin end---------------------------------------------------------------------?>


	<?php 
  //for SGA/GP start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['unsecuredLoans'];
	$arrayiTotalIncome[1] = $row2['unsecuredLoans'];
	$arrayiTotalIncome[2] = $row3['unsecuredLoans'];
	$arrayiTotalIncome[3] = $row4['unsecuredLoans'];
	$arrayiTotalIncome[4] = $row5['unsecuredLoans'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
	
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"><a  class="tooltip">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[5]; ?> </strong><br />
      <?php echo $arrayHelpText[5]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Unsecured Loans</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <td width="69" align="left" valign="top" ><span class="style20 greytxt12"><span class="style22">
      <?php  ?>
    </span></span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <?php ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <?php ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <?php ?>
    </span>  </td> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for SGA/GP end---------------------------------------------------------------------?> 
    
    
	<?php 
  //for dep/GP start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['totalDebt'];
	$arrayiTotalIncome[1] = $row2['totalDebt'];
	$arrayiTotalIncome[2] = $row3['totalDebt'];
	$arrayiTotalIncome[3] = $row4['totalDebt'];
	$arrayiTotalIncome[4] = $row5['totalDebt'];
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
        <strong style="color:#009900"><?php echo $arrayHelpHeading[6]; ?> </strong><br />
      <?php echo $arrayHelpText[6]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">Total Debt</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <td width="69" align="left" valign="top" ><span class="style20 greytxt12"><span class="style22">
      <?php  ?>
    </span></span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <?php ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <?php ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <?php ?>
    </span>  </td> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Dep/GP end---------------------------------------------------------------------?> 
    
    <?php 
  //for Operating Profit start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['totalAssets'];
	$arrayiTotalIncome[1] = $row2['totalAssets'];
	$arrayiTotalIncome[2] = $row3['totalAssets'];
	$arrayiTotalIncome[3] = $row4['totalAssets'];
	$arrayiTotalIncome[4] = $row5['totalAssets'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[7]; ?> </strong><br />
      <?php echo $arrayHelpText[7]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Total Liabilities</span>  </td>
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

  $arrayiTotalIncome[0] = $row1['grossBlock'];
	$arrayiTotalIncome[1] = $row2['grossBlock'];
	$arrayiTotalIncome[2] = $row3['grossBlock'];
	$arrayiTotalIncome[3] = $row4['grossBlock'];
	$arrayiTotalIncome[4] = $row5['grossBlock'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		
	?> 
  
  <tr >
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[8]; ?> </strong><br />
      <?php echo $arrayHelpText[8]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Gross Block  </span></td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <td width="69" align="left" valign="top"><span class="style20 greytxt12"><span class="style22">
      <?php  ?>
    </span></span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <?php ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <?php ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <?php ?>
    </span>  </td> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Operating profit Margin end---------------------------------------------------------------------?>

<?php 
  //for Interest/OP start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['lessAccumDepcreciation'];
	$arrayiTotalIncome[1] = $row2['lessAccumDepcreciation'];
	$arrayiTotalIncome[2] = $row3['lessAccumDepcreciation'];
	$arrayiTotalIncome[3] = $row4['lessAccumDepcreciation'];
	$arrayiTotalIncome[4] = $row5['lessAccumDepcreciation'];
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
        <strong style="color:#009900"><?php echo $arrayHelpHeading[9]; ?> </strong><br />
      <?php echo $arrayHelpText[9]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Less Accumulated Depreciation</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <td width="69" align="left" valign="top" ><span class="style20 greytxt12"><span class="style22">
      <?php  ?>
    </span></span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <?php ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <?php ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <?php ?>
    </span>  </td> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Interest/OP end---------------------------------------------------------------------?> 
    
    <?php 
  //for PBT start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['netBlock'];
	$arrayiTotalIncome[1] = $row2['netBlock'];
	$arrayiTotalIncome[2] = $row3['netBlock'];
	$arrayiTotalIncome[3] = $row4['netBlock'];
	$arrayiTotalIncome[4] = $row5['netBlock'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[10]; ?> </strong><br />
      <?php echo $arrayHelpText[10]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Net Block</span>  </td>
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

  $arrayiTotalIncome[0] = $row1['CapitalProgress'];
	$arrayiTotalIncome[1] = $row2['CapitalProgress'];
	$arrayiTotalIncome[2] = $row3['CapitalProgress'];
	$arrayiTotalIncome[3] = $row4['CapitalProgress'];
	$arrayiTotalIncome[4] = $row5['CapitalProgress'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[11]; ?> </strong><br />
      <?php echo $arrayHelpText[11]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Capital Work in Progress</span>  </td>
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

  $arrayiTotalIncome[0] = $row1['investments'];
	$arrayiTotalIncome[1] = $row2['investments'];
	$arrayiTotalIncome[2] = $row3['investments'];
	$arrayiTotalIncome[3] = $row4['investments'];
	$arrayiTotalIncome[4] = $row5['investments'];
		$patterns =",";
		$replacements1 = '';
		$arrayiTotalIncome[0] = str_replace($patterns,$replacements1,$arrayiTotalIncome[0]);
		$arrayiTotalIncome[1] = str_replace($patterns,$replacements1,$arrayiTotalIncome[1]);
		$arrayiTotalIncome[2] = str_replace($patterns,$replacements1,$arrayiTotalIncome[2]);
		$arrayiTotalIncome[3] = str_replace($patterns,$replacements1,$arrayiTotalIncome[3]);
		$arrayiTotalIncome[4] = str_replace($patterns,$replacements1,$arrayiTotalIncome[4]);
		
		
		
	
	?> 
  
  <tr >
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[12]; ?> </strong><br />
      <?php echo $arrayHelpText[12]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">Investments</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <td width="69" align="left" valign="top"><span class="style20 greytxt12"><span class="style22">
      <?php  ?>
    </span></span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <?php ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <?php ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
    <td width="69" align="left" valign="top"><span class="greytxt12">
      <?php ?>
    </span>  </td> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Net profit Margin end---------------------------------------------------------------------
	
	?>
    
        
     <?php 
  //for Equity start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['inventories'];
	$arrayiTotalIncome[1] = $row2['inventories'];
	$arrayiTotalIncome[2] = $row3['inventories'];
	$arrayiTotalIncome[3] = $row4['inventories'];
	$arrayiTotalIncome[4] = $row5['inventories'];
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
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Inventories</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <td width="69" align="left" valign="top" ><span class="style20 greytxt12"><span class="style22">
      <?php  ?>
    </span></span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <?php ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <?php ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <?php ?>
    </span>  </td> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for Equity end--------------------------------------------------------------------- 
	?>
    
       
     <?php 
  //for dividends start ---------------------------------------------------------------------

  $arrayiTotalIncome[0] = $row1['sundryDebtors'];
	$arrayiTotalIncome[1] = $row2['sundryDebtors'];
	$arrayiTotalIncome[2] = $row3['sundryDebtors'];
	$arrayiTotalIncome[3] = $row4['sundryDebtors'];
	$arrayiTotalIncome[4] = $row5['sundryDebtors'];
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
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Accounts Receivables</span>  </td>
    <td width="65" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[0]; ?></span>  </td> 
    <td width="69" align="left" valign="top" ><span class="style20 greytxt12"><span class="style22">
      <?php  ?>
    </span></span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[1]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <?php ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[2]; ?></span>  </td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <?php ?>
    </span>  </td>
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[3]; ?></span></td>
    <td width="69" align="left" valign="top" ><span class="greytxt12">
      <?php ?>
    </span>  </td> 
    <td width="52" align="left" valign="top"><span class="greytxt12"><?php echo $arrayiTotalIncome[4]; ?></span>  </td>
  </tr>
    <?php 
    //for dividends end--------------------------------------------------------------------- 
	?>
    
    
     <?php 
  //for Book value start ---------------------------------------------------------------------

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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[15]; ?> </strong><br />
      <?php echo $arrayHelpText[15]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">Cash and Bank Balance</span>  </td>
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

    $arrayiTotalIncome[0] = $row1['fixedDeposit'];
	$arrayiTotalIncome[1] = $row2['fixedDeposit'];
	$arrayiTotalIncome[2] = $row3['fixedDeposit'];
	$arrayiTotalIncome[3] = $row4['fixedDeposit'];
	$arrayiTotalIncome[4] = $row5['fixedDeposit'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[18]; ?> </strong><br />
      <?php echo $arrayHelpText[18]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Fixed Deposits</span>  </td>
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

    $arrayiTotalIncome[0] = $row1['totalCurrAssets'];
	$arrayiTotalIncome[1] = $row2['totalCurrAssets'];
	$arrayiTotalIncome[2] = $row3['totalCurrAssets'];
	$arrayiTotalIncome[3] = $row4['totalCurrAssets'];
	$arrayiTotalIncome[4] = $row5['totalCurrAssets'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[16]; ?> </strong><br />
      <?php echo $arrayHelpText[16]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Total Current Assets</span>  </td>
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

    $arrayiTotalIncome[0] = $row1['loans'];
	$arrayiTotalIncome[1] = $row2['loans'];
	$arrayiTotalIncome[2] = $row3['loans'];
	$arrayiTotalIncome[3] = $row4['loans'];
	$arrayiTotalIncome[4] = $row5['loans'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[17]; ?> </strong><br />
      <?php echo $arrayHelpText[17]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Loans and Advances</span>  </td>
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

    $arrayiTotalIncome[0] = $row1['totalCALoansAdvances'];
	$arrayiTotalIncome[1] = $row2['totalCALoansAdvances'];
	$arrayiTotalIncome[2] = $row3['totalCALoansAdvances'];
	$arrayiTotalIncome[3] = $row4['totalCALoansAdvances'];
	$arrayiTotalIncome[4] = $row5['totalCALoansAdvances'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[18]; ?> </strong><br />
      <?php echo $arrayHelpText[18]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Total CA, Loans & Advances</span>  </td>
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

    $arrayiTotalIncome[0] = $row1['currLiabilities'];
	$arrayiTotalIncome[1] = $row2['currLiabilities'];
	$arrayiTotalIncome[2] = $row3['currLiabilities'];
	$arrayiTotalIncome[3] = $row4['currLiabilities'];
	$arrayiTotalIncome[4] = $row5['currLiabilities'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[20]; ?> </strong><br />
      <?php echo $arrayHelpText[20]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Current Liabilities</span>  </td>
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

    $arrayiTotalIncome[0] = $row1['provisions'];
	$arrayiTotalIncome[1] = $row2['provisions'];
	$arrayiTotalIncome[2] = $row3['provisions'];
	$arrayiTotalIncome[3] = $row4['provisions'];
	$arrayiTotalIncome[4] = $row5['provisions'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[21]; ?> </strong><br />
      <?php echo $arrayHelpText[21]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Provisions</span>  </td>
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
				
		$arrayiIncomeGrowth[$i] = (((float)$arrayiTotalIncome[$i + 1] - (float)$arrayiTotalIncome[$i])/(float)$arrayiTotalIncome[$i]) * 100;
		//$arrayiIncomeGrowth[$i] = ($arrayiTotalIncome[$i + 1] - $arrayiTotalIncome[$i]) ;
		//echo "naidu".$arrayiIncomeGrowth[$i];
		/* if ( $arrayiTotalIncome[$i] < 0 )
		{
			$arrayiIncomeGrowth[$i] = - $arrayiIncomeGrowth[$i];
		}  */
		 		 
	} 
	$arrayiIncomeGrowth[1] =  bcdiv($arrayiIncomeGrowth[1],1,1);		
	$arrayiIncomeGrowth[2] = bcdiv($arrayiIncomeGrowth[2],1,1);
	$arrayiIncomeGrowth[3] = bcdiv($arrayiIncomeGrowth[3],1,1);
	$arrayiIncomeGrowth[0] = bcdiv($arrayiIncomeGrowth[0],1,1);   
	
	?> 
  
  <tr>
  <td width="36" align="left" valign="top"><a  class="tooltip">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[21]; ?> </strong><br />
      <?php echo $arrayHelpText[21]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Total CL & Provisions</span>  </td>
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

    $arrayiTotalIncome[0] = (float)$row1['totalCALoansAdvances'] - (float)$row1['totalClProvisions'];
	$arrayiTotalIncome[1] = (float)$row2['totalCALoansAdvances'] - (float)$row2['totalClProvisions'];
	$arrayiTotalIncome[2] = (float)$row3['totalCALoansAdvances'] - (float)$row3['totalClProvisions'];
	$arrayiTotalIncome[3] = (float)$row4['totalCALoansAdvances'] - (float)$row4['totalClProvisions'];
	$arrayiTotalIncome[4] = (float)$row5['totalCALoansAdvances'] - (float)$row5['totalClProvisions'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[23]; ?> </strong><br />
      <?php echo $arrayHelpText[23]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Net Current Assets</span>  </td>
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

    $arrayiTotalIncome[0] = $row1['totalAssets'];
	$arrayiTotalIncome[1] = $row2['totalAssets'];
	$arrayiTotalIncome[2] = $row3['totalAssets'];
	$arrayiTotalIncome[3] = $row4['totalAssets'];
	$arrayiTotalIncome[4] = $row5['totalAssets'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[23]; ?> </strong><br />
      <?php echo $arrayHelpText[23]; ?>  
    </span>
</a></td>
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

    $arrayiTotalIncome[0] = $row1['bookvalue'];
	$arrayiTotalIncome[1] = $row2['bookvalue'];
	$arrayiTotalIncome[2] = $row3['bookvalue'];
	$arrayiTotalIncome[3] = $row4['bookvalue'];
	$arrayiTotalIncome[4] = $row5['bookvalue'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[25]; ?> </strong><br />
      <?php echo $arrayHelpText[25]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="cell"><span class="greytxt14">Book Value </span>  </td>
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

    $arrayiTotalIncome[0] = $row1['CurretRatio'];
	$arrayiTotalIncome[1] = $row2['CurretRatio'];
	$arrayiTotalIncome[2] = $row3['CurretRatio'];
	$arrayiTotalIncome[3] = $row4['CurretRatio'];
	$arrayiTotalIncome[4] = $row5['CurretRatio'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[26]; ?> </strong><br />
      <?php echo $arrayHelpText[26]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">Current Ratio</span>  </td>
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

    $arrayiTotalIncome[0] = $row1['DebtEquityRatio'];
	$arrayiTotalIncome[1] = $row2['DebtEquityRatio'];
	$arrayiTotalIncome[2] = $row3['DebtEquityRatio'];
	$arrayiTotalIncome[3] = $row4['DebtEquityRatio'];
	$arrayiTotalIncome[4] = $row5['DebtEquityRatio'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[27]; ?> </strong><br />
      <?php echo $arrayHelpText[27]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14"> Debt to Equity</span>   </td>
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

    $arrayiTotalIncome[0] = $row1['ReturnOnAssests'];
	$arrayiTotalIncome[1] = $row2['ReturnOnAssests'];
	$arrayiTotalIncome[2] = $row3['ReturnOnAssests'];
	$arrayiTotalIncome[3] = $row4['ReturnOnAssests'];
	$arrayiTotalIncome[4] = $row5['ReturnOnAssests'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[28]; ?> </strong><br />
      <?php echo $arrayHelpText[28]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">Return on Assets</span>  </td>
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

    $arrayiTotalIncome[0] = $row1['DebtUponEarnings'];
	$arrayiTotalIncome[1] = $row2['DebtUponEarnings'];
	$arrayiTotalIncome[2] = $row3['DebtUponEarnings'];
	$arrayiTotalIncome[3] = $row4['DebtUponEarnings'];
	$arrayiTotalIncome[4] = $row5['DebtUponEarnings'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[29]; ?> </strong><br />
      <?php echo $arrayHelpText[29]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">Debt/Earnings</span>  </td>
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

    $arrayiTotalIncome[0] = $row1['ReturnOnEquity'];
	$arrayiTotalIncome[1] = $row2['ReturnOnEquity'];
	$arrayiTotalIncome[2] = $row3['ReturnOnEquity'];
	$arrayiTotalIncome[3] = $row4['ReturnOnEquity'];
	$arrayiTotalIncome[4] = $row5['ReturnOnEquity'];
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
  <td width="36" align="left" valign="top"><a  class="tooltip"><img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?php echo $arrayHelpHeading[30]; ?> </strong><br />
      <?php echo $arrayHelpText[30]; ?>  
    </span>
</a></td>
    <td width="65" align="left" valign="top" class="celldark"><span class="greytxt14">Return on Equity</span>  </td>
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
<a  onClick="return vali_login()" href="Analyse_Sheet.php?mcode=<?php echo $mcode; ?>&firsttime=Y&isBank= <?php echo $isBank; ?> &number=<?php echo $companynumber;?>" ><img align="bottom" src="images/analyze.jpg"  width="100" height="100" border="0"></a>
<h3>Analyse Company</h3></div>

</div>
<div class="inn_box"  align="center"><a href="Profit_Loss.php?mcode=<?php echo $mcode; ?>" ><img align="bottom" src="images/profitloss.jpg"  width="100" height="100" border="0" ></a>
<h3>Analyze Profit & Loss Statements</h3></div>
<div class="inn_box" >
<h3></h3></div>


<div class="clear5"></div>
<?php include("footer.inc.php"); ?>	

</body>
</html>
