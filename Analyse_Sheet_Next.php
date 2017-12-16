<?php
include("config/config.inc.php");

 for($i=0;$i<15 ;$i++){
$_SESSION['sessionParameterData'][$i]=$_POST['parameterData'][$i];
$_SESSION['SessionRating'][$i]=$_POST['a_'.$i];
$_SESSION['sessionParameterRemarks'][$i]=$_POST['parameterRemarks'][$i];
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Analyse sheet of the Company</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script language="javascript">
function vali_ana_form1(obj)
{
 
 // var totalrow=document.ana_frm.elements['parameterData[]'].length;
  var fld;
  
  var total_sel=0;
  
  for(var j=15;j<25;j++)
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
 for(var j=15;j<25;j++)
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
 
  
}
</script>

</head>
<body>
<?php
include("header.inc.php");
?>
<div class="clear5"></div>

 <? 
 	$number = $_SESSION['companynumber'];
	 $searchCompanyCode = $_SESSION['companycode'];
     $companySearch1=mysql_query("select * from name_code where number = $number ");
	 $row1 = mysql_fetch_array($companySearch1);
	$name = $row1['name'];
	$bseScript = $row1['BSE_Script']; 
	$companyUrl = $row1['company_url']; 
	$mcode = $row1['code']; //money control code
	$companyType = $row1['Company_type'];
	
	
	 //to get rating
	
	?>

<table width="700" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<tr>
    <td width="300" align="left" valign="top"><span class="greytxt12">Company Name - <? echo $name ?></span> </td><td width="200" align="left" valign="top"><span class="greytxt12">Company Number - <? echo $number?>             </span>  </td><td width="200" align="left" valign="top"><span class="greytxt12"> BSE Script ID - <? echo "     ".$bseScript?></span> </td>   </tr>
</table>

<div align="center">
<form action="Analyse_Sheet_Summary.php" method="post" enctype="multipart/form-data" name="" id="" onSubmit="return vali_ana_form1(this)">
<table width="800" border="1" align="center" bordercolor="#333333" bgcolor="#FFFFFF">
<tr >

  <td width="36" align="left" valign="top"></td>
    <td width="41" align="left" valign="top" class="cell"><span class="greytxt14">S.No</span>  </td>
    <td width="220" align="left" valign="top" class="cell"><span class="greytxt14">Parameter Name</span>  </td>
  	<td width="197" align="left" valign="top" class="cell"><span class="greytxt14">Data</span>  </td>
   <td width="50" align="left" valign="top" class="cell"><span class="greytxt14">Rating</span></td>
  	<td width="200" align="left" valign="top" class="cell"><span class="greytxt14">Remarks<br>%</span>  </td>
</tr>
 
 <?php  $getparameters = mysql_query("select * from master_analyze_sheet where visible = 'Y' order by sequence limit 15,25"); 
 $i =15;
	while($row_st1=mysql_fetch_array($getparameters))
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
     <td width="250" align="left" valign="top" class="cell"><span class="greytxt14"><?php echo $row_st1['Parameter_Desc']; ?></span>  </td>
    <td width="200" align="left" valign="top"><textarea class= "txtarea" id ="parameterData[<?=$i-1?>]" name ="parameterData[<?=$i-1?>]" rows="3" cols="30" ><?php echo $_SESSION['sessionParameterData'][$i-1] ; ?></textarea></td>
      <td width="50" align="left" valign="top"><span class="greytxt12"><select name="a_<?=$i-1?>" >
     <option value="" > </option>
    <?php for ($icount = 1 ; $icount <6 ; $icount++)
	{   ?>
	<option value="<?php echo $icount ; ?>" <?php if ($_SESSION['SessionRating'][$i - 1] == $icount) { ?> selected="selected"<? }?> ><?php echo $icount ; ?> </option>
	<?php }
	?>
  
</select></span>   </td>
    <td width="200" align="left" valign="top"><textarea class= "txtarea" id ="parameterRemarks[<?=$i-1?>]" name ="parameterRemarks[<?=$i-1?>]" rows="2" cols="30"><?php echo $_SESSION['sessionParameterRemarks'][$i-1] ; ?></textarea></td></tr>
      <?php } ?>
 
  

	
</table> <div class="clear2"></div><div class="analyzenext-submit"><input type="button" class="btn" value="Back" onClick="javascript:location.href='Analyse_Sheet.php'">  <input type="submit" class="btn" value="Next"> </div></form>
</div>
<div class="clear2"></div>


<div class="clear5"></div>
<?php include("footer.inc.php"); ?>
</body>
</html>
