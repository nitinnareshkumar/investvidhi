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

<table width="800" border="1" align="center" cellpadding="0" cellspacing="1" bordercolor="#00CC00" bgcolor="#FFFFFF">
<tr>
    <td width="187" height = "40" align="left" valign="top"><div align="center"><span class="greytxt12">Company Name </span><br>
        </span>  </div></td><td width="187" align="left" valign="top"><div align="center"><span class="greytxt12">Company Number </span> </div></td>   </tr>
	
  
  <?php $searchCompanyName = "%".$_POST['txt_name']."%";
 // echo "<br>".$searchCompanyName."<br>";
 // $query = "select * from name_code where name like = '$searchCompanyName' ";
 // echo "<br>".$query."<br>";
     $companySearch=mysqli_query($link,"select * from name_code where visibleOnSearch != 'N' and name like '$searchCompanyName' "); ?><?php if($rows_st=mysqli_num_rows($companySearch))
					{   					
						//while($row_st=mysql_fetch_assoc($area_suggested))
						while($row_st=mysqli_fetch_array($companySearch))
						{
						   // print_r($row_st);
							$Companyname=$row_st['name'];
							$Companynumber=$row_st['number'];

							/*$test_array[] =$row_st['suggested_area'];
							//print_r($test_array); 							 
							$no_of_user=$row_st['count(*)'];
							$row_count++;	*/						 	
					?>         
  <tr>
    <td width="187" align="left" valign="top"><a href='<?php echo 'CompanyDetails.php'.'?code='.$row_st['number'] ; ?> 'style="color:#000000"  ><span class="greytxt12"><?= $Companyname  ?></span></a></td> <td width="187" align="left" valign="top"><span class="greytxt12"><?php echo $Companynumber; ?></span>  </td><?php }} ?> </tr>
</table>
<div class="clear5"></div>
<?php include("footer.inc.php"); ?>
</body>
</html>