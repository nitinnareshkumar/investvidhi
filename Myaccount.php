<?php
include("config/config.inc.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Myaccount</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php
include("header.inc.php");
if ( $_GET['addToFavorites'] == 1)
{

$compnumber = $_GET['number'];
$userid = $_SESSION['userid'];
 $list=mysql_query("select * from user_companies where companynumber  = $compnumber and userid = '$userid' and favorite_analyse ='F'");
 $numofrows = mysql_num_rows ($list);
 if (  $numofrows  > 0)
 {
 
 }
 else
 {
 
// echo "INSERT INTO user_companies (userid, companynumber, favorite_analyse	) VALUES ($userid, $compnumber, 'F' )";
 	$sql = "INSERT INTO user_companies (userid, companynumber, favorite_analyse, UpdateDate	) VALUES ($userid, $compnumber, 'F' ,CURDATE())";
	
	 $resinsert = mysql_query($sql) or die(mysql_error()) ;
 }
}

?>
<div class="clear5"></div>
<div class="clear5"></div>
<div class="graph-box-left">
<table width="600" border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#00CC00" bgcolor="#FFFFFF">
<tr>
    <td width="300" height = "70" align="left" valign="top"><div class="inn_box" ><h5>Favorites</h5><img src="images/favorite.jpg"  width="40" height="40" border="0" align="bottom"></a>
</div>
</td>   </tr>
	
  
  <? 
 // echo "<br>".$searchCompanyName."<br>";
 // $query = "select * from name_code where name like = '$searchCompanyName' ";
 // echo "<br>".$query."<br>";
 
 		$userid = $_SESSION['userid'];
     $companylist=mysql_query("select * from user_companies where  userid = '$userid' and favorite_analyse ='F' ");
	  if($rows_st=mysql_num_rows($companylist))
					{   					
						//while($row_st=mysql_fetch_assoc($area_suggested))
						while($row_st=mysql_fetch_array($companylist))
						{
						   // print_r($row_st);
							$Companynumber=$row_st['companynumber'];

							$getnamesql = mysql_query("select name from name_code where number = $Companynumber");						 							$row_st=mysql_fetch_array($getnamesql);
					?>         
  <tr>
    <td width="300" align="left" valign="top"><a href="<? echo "CompanyDetails.php?code=".$Companynumber ;?>" style="color:#000000"  ><?php echo ucwords($row_st['name']);?></a></td></tr> <? }} 
	else { ?>
    <tr><td width="300" align="left" valign="top"><span class="greytxt14grey">You have not added any company as favorite.Please add.</span></td></tr> <?php } ?>
	
</table>
</div>

<div class="graph-box-right">
<table width="600" border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#00CC00" bgcolor="#FFFFFF">
<tr>
    <td width="300" height = "70" align="left" valign="top"><div class="inn_box" ><h5>Already Analyzed Companies</h5><img src="images/analyze.jpg"  width="60" height="60" border="0" align="bottom"></a>
</div>
</td>   </tr>
	
  
  <? 
 // echo "<br>".$searchCompanyName."<br>";
 // $query = "select * from name_code where name like = '$searchCompanyName' ";
 // echo "<br>".$query."<br>";
 
 		$userid = $_SESSION['userid'];
     $companylist=mysql_query("select * from user_companies where  userid = '$userid' and favorite_analyse ='A' ");
	  if($rows_st=mysql_num_rows($companylist))
					{   					
						//while($row_st=mysql_fetch_assoc($area_suggested))
						while($row_st=mysql_fetch_array($companylist))
						{
						   // print_r($row_st);
							$Companynumber=$row_st['companynumber'];

							$getnamesql = mysql_query("select name from name_code where number = $Companynumber");						 							$row_st=mysql_fetch_array($getnamesql);
					?>         
  <tr>
    <td width="300" align="left" valign="top"><a href="<? echo "Analyse_Sheet_Summary.php?frommyaccount=Y&number=".$Companynumber."&userid=".$userid ;?>" style="color:#000000"  ><?php echo ucwords($row_st['name']);?></a></td> </tr> <?  }} 
	else { ?>
    <tr><td width="300" align="left" valign="top"><span class="greytxt14grey">You have not added any company as favorite.Please</span> <a href="SearchCompany.php" >Analyse </a></td></tr> <?php } ?>
    
</table>
</div>
<div class="clear5"></div>
<?php include("footer.inc.php"); ?>
</body>
</html>
