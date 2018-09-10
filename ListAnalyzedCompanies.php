<?php
include("config/config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>List of Already Analysed Companies</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php
include("header.inc.php");

?>
<div class="clear5"></div>
<div class="clear5"></div>

<table width="900" border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#00CC00" bgcolor="#FFFFFF">
<tr>
    <td width="200" height = "10" align="left" valign="top"><h5>Already Analyzed Companies</h5>

</td> <td width="350" height = "10" align="left" valign="top"><h5>Fundamental Rating from 1 to 5</h5><a  class="tooltip">
    <img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900">Overall Rating</strong><br />
        This indicates the overall rating of the company after analyzing the business , financial strength , management quality ,<br> growth and other fundamental parameters of the company.<br>
Give ratings from 1 to 5 where <br>
<strong>1</strong> means a very average company with low growth , low return 
on equity, needs lot of capital expenditure and have no competitive advantage.<br>
<strong>5</strong> means a company with good growth , good cash flows , good return<br> on equity , exceptional brand value , needs very less capex and working capital and have bright future prospects.
    </span>
</a></td><td width="200" height = "10" align="left" valign="top"><h5>Valuation Rating</h5><a  class="tooltip">
    <img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
   <span>
        <strong style="color:#009900">Valuation Rating</strong><br />
        This indicates the valuation rating of the company 
Give ratings from 1 to 5 where <br>
<strong>1</strong> means that stock price of the company is at very high valuation compared to business<br> prospects of the company and there is either no upside in near future or stock price can<br> go down in near future<br>
<strong>5</strong> means that stock price of the company is at very low valuation compared to business<br> prospects of the company , hence lot of upside can happen.
    </span>
</a></td> <td width="150" height = "10" align="left" valign="top"><h5>Last Updated</h5></td> </tr>
	<tr><td height="30" ></td></tr>
  
  <?php
 // echo "<br>".$searchCompanyName."<br>";
 // $query = "select * from name_code where name like = '$searchCompanyName' ";
 // echo "<br>".$query."<br>";
 
 		
     $companylist=mysqli_query($link,"select * from user_companies where  userid in (select id from tbl_user where isAdmin = 'Y') and favorite_analyse = 'A' ");
	  if($rows_st=mysqli_num_rows($companylist))
					{   					
						//while($row_st=mysql_fetch_assoc($area_suggested))
						while($row_st=mysqli_fetch_array($companylist))
						{
						   // print_r($row_st);
							$Companynumber=$row_st['companynumber'];

							$getnamesql = mysqli_query($link,"select name from name_code where number = $Companynumber");	
							$getratingsql = mysqli_query($link,"select P_rating from user_analyze_companies  where companynumber = $Companynumber and P_code = '1100' and userid in (select id from tbl_user where isAdmin = 'Y') ");
							$getvratingsql = mysqli_query($link,"select P_rating from user_analyze_companies  where companynumber = $Companynumber and P_code = '1102' and userid in (select id from tbl_user where isAdmin = 'Y') ");
											 												$row_st1=mysqli_fetch_array($getnamesql);
$row_strating=mysqli_fetch_array($getratingsql);	
$row_Vtrating=mysqli_fetch_array($getvratingsql);							
					?>         
  
  <tr>
    <td width="300" align="left" valign="top"><a href="<?php echo "AnalyzedCompanies.php?frommyaccount=Y&number=".$Companynumber ; ?>" style="color:#000000"  ><?php echo ucwords($row_st1['name']); ?> </a></td> <td><span class="greytxt12"><?php echo $row_strating['P_rating']; ?></span></td> <td><span class="greytxt12"><?php echo $row_Vtrating['P_rating']; ?></span></td><td><span class="greytxt12"><?php echo $row_st['UpdateDate']; ?></span></td><?php }}?> </tr>
</table>
<div class="clear5"></div>
<div class="clear2"></div>
<table width="900" border="0" align="center" bordercolor="#333333" bgcolor="#FFFFFF">
<tr >
	
   
    <td width="550" align="left" valign="top" ><span class="greentxt14"><br>Important Disclaimer<br> </span><span class="greytxt14grey">Investment in equity shares has its own risks.Companies mentioned in the above list are not recommendations.We have provided analysis on above companies to help individual investor learn the investment process using some practical examples.The information contained herein is based on analysis and up on sources that we consider reliable. We,however, are not responsible for the accuracy or the completeness thereof.This material is for personal information and we are not responsible for any loss incurred based upon it & take no responsibility whatsoever for any financial profits or loss which may arise from the recommendations above.The stock price projections shown are not necessarily indicative of future price performance.The information herein, together with all estimates and forecasts, can change without notice.</span>
    </td></tr></table>

<div class="clear12"></div>
<?php include("footer.inc.php"); ?>
</body>
</html>
