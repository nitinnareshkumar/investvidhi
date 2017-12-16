<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
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

<div class="company" align="center">  <form action="CompanySearchResults.php" method="post" enctype="multipart/form-data" name="" id=""><input type="text" value="ENTER COMPANY NAME" onblur="if (this.value == '') {this.value = 'ENTER COMPANY NAME';}" onfocus="if (this.value == 'ENTER COMPANY NAME') {this.value = '';}" name="txt_name">&nbsp;<input type="submit" class="btn" value="FIND"></form></div>

<div class="clear12"></div>
</div>
<div>
<div class="inn_box" align="center"><a href="CaniInvest.php" ><img align="bottom" src="images/question.jpg"  width="40" height="80"></a>
<h3>Can I Invest?</h3></div>
<div class="inn_box"  align="center"><a href="StepsofInvestment.php" ><img align="bottom" src="images/Steps.jpg"  width="100" height="80"></a>
<h3>Step of Investment</h3></div>
<div class="inn_box"  align="center"><img align="bottom" src="images/filter.jpg"  width="60" height="80">
<h3>Filter 7000+ companies</h3></div>
<div class="inn_box"  align="center"><img align="bottom" src="images/analyze.jpg"  width="60" height="80">
<h3>Search Best Company</h3></div>
<div class="inn_box"  align="center"><img align="bottom" src="images/Recommend.bmp"  width="60" height="80">
<h3>Recommendations</h3></div>

</div>
<?php include("footer.inc.php"); ?>

</body>
</html>
