<?php
include("config/config.inc.php");

//$_SESSION['userid'] ="";//delete this line

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title> Let's learn Focus Investing</title>
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
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-37604506-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script>
function vali_login()
{
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

function validateForm()
{
var x=document.forms["indexform"]["txt_name"].value;
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
<table width="1000" border="0" height="150">
  <tr>
    <td width="750">&nbsp;</td>
    <td align="center"></td>
    <td>&nbsp;</td>
  </tr>

</table>

<div class="companyLabel"><span class="greytxt14grey">Enter Company Name </span></div><div class="company" align="center">  <form action="CompanySearchResults.php" onSubmit="return validateForm()" method="post" enctype="multipart/form-data" name="indexform" id=""><input type="hidden" name="code" id="code" size="5" /><input name="txt_name" type="text" class="company" id="txt_name" onfocus="if (this.value == 'ENTER COMPANY NAME') {this.value = '';}" onblur="if (this.value == '') {this.value = 'ENTER COMPANY NAME';}" value="ENTER COMPANY NAME">

&nbsp;<input type="submit" class="btn" value="FIND"></form></div>

<div class="clear5"></div>
<div class="clear2"></div>
</div>
<div>
<div class="inn_box" align="center"><a href="CaniInvest.php" ><img src="images/question.jpg"  width="40" height="80" border="0" align="bottom"></a>
<h3>Can I Invest?</h3></div>
<div class="inn_box"  align="center"><a href="StepsofInvestment.php" ><img src="images/Steps.jpg"  width="100" height="80" border="0" align="bottom"></a>
<h3>Steps of Investment</h3></div>
<div class="inn_box"  align="center"><a href="filter.php" ><img align="bottom" src="images/filter.jpg"  width="60" height="80" border="0"></a>
<h3>Filter 7000+ companies</h3></div>
<div class="inn_box"  align="center"><a onClick="return vali_login()" href="SearchCompany.php" ><img align="bottom" src="images/analyze.jpg"  width="60" height="80" border="0"></a>
<h3>Analyse a Company</h3></div>
<div class="inn_box"  align="center"><a  href="ListAnalyzedCompanies.php" ><img align="bottom" src="images/Recommend.bmp"  width="60" height="80" border="0"></a>
<h3>Already Analyzed Companies</h3></div>

</div>
<?php include("footer.inc.php"); ?>

</body>
</html>
