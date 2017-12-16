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

    <td width="66" height="39" align="center" valign="top" nowrap class="cellcompanydetails"><span class="greytxt18">Steps of Investment</span>  </td>
    </tr></table>
    <div class="clear5"></div>
<table width="900" border="0" align="center" bordercolor="#333333" bgcolor="#FFFFFF">
<tr >
	
    <td width="250" align="left" valign="top" ><div class="steps-box">1   <span>Filter Companies</span></div>  </td>
    <td width="550" align="left" valign="top" ><span class="greytxt14grey">There are more than 7000 companies listed in India.We cannot analyze all of them so let's filter companies based on various fundamental parameters using Filter Tool. <br>
    Use link on right to go to filter tool.<br>If you already know the company name , directly go to Step 3</span></td>
    <td width="100" align="left" valign="top" ><a href="filter.php" ><img align="bottom" src="images/filter.jpg"  width="45" height="60" border="0"></a>  </td>
 
</tr>
<tr >
	
    <td height="10" align="left" valign="top" > </td></tr>
<tr >
	
    <td width="150" align="left" valign="top" ><div class="steps-box">2   <span>Check High Level Details</span></div>  </td>
    <td width="600" align="left" valign="top" ><span class="greytxt14grey">After getting the filtered results , do the high level analysis on the company by using Company Details , Profit & Loss and Balance Sheet pages.Company Details page can be accessed by clicking name of the company in filtered results.Profit & Loss and Balance Sheet page can be accessed from Company Details Page.
    Company Details page can also be accessed from Home page by entering company name in the search box.Sample Pages are present on right</span> </td>
    <td width="50" align="left" valign="top" ><a href='CompanyDetails.php?code=6494'  style="color:#000000"  ><span class="greytxt12">Company Details</span></a> <br><br><a href='Profit_Loss.php?mcode=TI01' style="color:#000000"  ><span class="greytxt12">Profit Loss</span></a> <br><br><a href='Balance_Sheet.php?mcode=TI01' style="color:#000000"  ><span class="greytxt12">Balance Sheet</span></a> </td>
 
</tr>
<tr >
	
    <td height="10" align="left" valign="top" > </td></tr>
<tr >
<tr >
	
    <td width="200" align="left" valign="top" ><div class="steps-box">3   <span>Analyze / Save to Favorites</span></div>  </td>
    <td width="550" align="left" valign="top" ><span class="greytxt14grey">If intial analysis looks fine you can do the detailed analysis by clicking "Analyse Company" link <img align="bottom" src="images/analyze.jpg"  width="30" height="30" border="0"> on Company Details page.If you want to analyse the company later then you can add it to your favorites. </span> </td>
    
 
</tr>
<tr >
	
    <td height="10" align="left" valign="top" > </td></tr>
<tr >
<tr >
	
    <td width="200" align="left" valign="top" ><div class="steps-box">4   <span>Rate the Company & Submit</span></div>  </td>
    <td width="550" align="left" valign="top" ><span class="greytxt14grey">Rate the company on 25 parameters using the automated data , analyse the graphs and analysis cloud of the company, Give the final rating to the Company and Submit the analysis sheet.Analysis Sheets can later be accessed from "My Account" after logging in</span> </td>
    <td width="50" align="left" valign="top" >  </td>
 
</tr>
<tr >
	
    <td height="10" align="left" valign="top" > </td></tr>
<tr >
<tr >
	
    <td width="200" align="left" valign="top" ><div class="steps-box">5   <span>Take investment decision</span></div>  </td>
    <td width="550" align="left" valign="top" ><span class="greytxt14grey">After analying the company on various fundamental parameters using the sheet , one can now take the decision to whether invest or not in the given company </td>
   
 
</tr>
  </table>
    
<div class="clear5"></div>
</div>


<?php include("footer.inc.php"); ?>

</body>
</html>
