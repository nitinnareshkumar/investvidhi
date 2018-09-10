<?php
include("config/config.inc.php");
//$_SESSION['userid'] = 1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Search Company</title>
<script language="javascript" type="text/javascript" src="js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.coolautosuggest.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.coolfieldset.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.coolfieldset.css" />
<link rel="stylesheet" type="text/css" href="css/jquery.coolautosuggest.css" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<style type="text/css">
<!--
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
-->
</style></head>
<body>
<script>
function validateForm()
{
var x=document.forms["searchform"]["txt_name"].value;
if (x==null || x=="")
  {
  alert("Please enter the company name");
  return false;
  }
}
</script>

<?php
include("header.inc.php");
?>
<div id="main_content">
<table width="200" border="0" height="150">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
 
</table>

<div class="companyLabel1"><span class="greytxt12">Enter Company Name </span></div><div class="company" align="left">  <form action="SearchCompany.php" method="post" onSubmit="return validateForm()" enctype="multipart/form-data" name="searchform" id=""><input type="hidden" name="subfrm" value="1"><input type="hidden" name="code" id="code" size="5" /><input name="txt_name" type="text" class="company" id="txt_name" onfocus="if (this.value == 'ENTER COMPANY NAME') {this.value = '';}" onblur="if (this.value == '') {this.value = 'ENTER COMPANY NAME';}" value="ENTER COMPANY NAME">
<script language="javascript" type="text/javascript">
					$("#txt_name").coolautosuggest({
						url:"data.php?chars=",
						idField:$("#code"),
						width:225
					});
				</script>
&nbsp;<input type="submit" class="btn" value="FIND"></form></div>
<?php
if(isset($_POST['subfrm']))
{
?>
<div class="clear12"></div>	
<table width="800" border="1" align="left" cellpadding="0" cellspacing="1" bordercolor="#00CC00" bgcolor="#FFFFFF">
<tr>
    <td width="187" height = "40" align="left" valign="top"><div align="center"><span class="greytxt12">Company Name </span><br>
        </span>  </div></td><td width="187" align="left" valign="top"><div align="center"><span class="greytxt12">Company Number </span> </div></td>   </tr>
	
  
  <?php $searchCompanyName = "%".$_POST['txt_name']."%";
 // echo "<br>".$searchCompanyName."<br>";
 // $query = "select * from name_code where name like = '$searchCompanyName' ";
 // echo "<br>".$query."<br>";
     $companySearch=mysqli_query($link,"select * from name_code where name like '$searchCompanyName' ");?><?php if($rows_st=mysqli_num_rows($companySearch))
					{   					
						//while($row_st=mysql_fetch_assoc($area_suggested))
						while($row_st=mysqli_fetch_array($companySearch))
						{
						   // print_r($row_st);
							$Companyname=$row_st['name'];
							$Companynumber=$row_st['number'];
							$mcode = $row_st['code'];
							/*$test_array[] =$row_st['suggested_area'];
							//print_r($test_array); 							 
							$no_of_user=$row_st['count(*)'];
							$row_count++;	*/	
							$companyType = $row_st['Company_type']; 
							$isBank ='' ;
							if ($companyType == "banks-private-sector" || $companyType == "banks-public-sector")
							{
								$isBank = 'Y' ;
							}
							else
							{ 
	 							 $isBank = 'N' ;
							}					 	
					?>         
  <tr>
    <td width="187" align="left" valign="top"><a href="Analyse_Sheet.php?mcode=<?php echo $mcode; ?> &firsttime=Y&isBank=<?php echo $isBank; ?>&number=<?php echo $Companynumber; ?> " style="color:#000000"  ><span class="greytxt12"><?= $Companyname  ?></span></a></td> <td width="187" align="left" valign="top"><span class="greytxt12"><?php echo $Companynumber; ?> </span>  </td><?php }} ?> </tr>
</table>
<?php } ?>
<div class="clear12"></div>
</div>

<?php include("footer.inc.php"); ?>

</body>
</html>