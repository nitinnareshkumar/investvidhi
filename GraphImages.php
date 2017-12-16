<?php
include("config/config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Follow Steps of Investment Process</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
include("header.inc.php");
?>
<div class="clear5"></div>
<div align="center">

<table width="800" border="1" align="center" bordercolor="#333333" bgcolor="#FFFFFF">
<tr >
<?php $imagename = $_GET['imagename']; ?>
    <td width="66" height="39" align="center" valign="top" nowrap class="cellcompanydetails"><span class="greytxt18">Graph</span>  </td>
    </tr></table>
    <div class="clear5"></div>
<table width="700" border="0" align="center" bordercolor="#333333" bgcolor="#FFFFFF">

<tr >
	
    <td width="200" align="left" valign="top" ><img align="bottom" src="<?php echo $imagename ; ?>"  width="500" height="400" border="0">  </td>
    
   
 
</tr>
  </table>
    
<div class="clear5"></div>
</div>


<?php include("footer.inc.php"); ?>

</body>
</html>
