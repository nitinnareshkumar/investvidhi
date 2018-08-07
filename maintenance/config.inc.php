<?php
session_start();

/*mysql_connect("localhost","shop2006","shop30");
mysql_select_db("shop");*/
global $HTTP_SERVER_VARS;
$HTTP_SERVER_VARS = $_SERVER;
if($HTTP_SERVER_VARS['HTTP_HOST']=="localhost")
{
	 $DB["dbName"] = "invidhi_automated";
	 $DB["host"]   = "localhost";
	 $DB["user"]   = "root";
	$DB["pass"]   = "";
	 
	$link = mysqli_connect($DB["host"],$DB["user"],$DB["pass"]) or die("Connection Failed");
	 mysqli_select_db($link,$DB["dbName"]);
	 echo mysqli_errno($link) . ": " . mysqli_error($link). "\n";
	
}
else
{
	 global $DB;
		 $DB["dbName"] = "invidhi_automated";
		 $DB["host"]   = "localhost";
	 $DB["user"]   = "root";
	 $DB["pass"]   = "";
	 //$DB["pass"]   = "";		
	 $link = mysqli_pconnect($link,$DB["host"],$DB["user"],$DB["pass"]) or die("Connection Failed");
	 mysqli_select_db($DB["dbName"]);
	 echo mysqli_errno($link) . ": " . mysqli_error($link). "\n";
	  echo "in if";
}

/*$sqlPaging=mysql_query("select * from paging_manager") or  die("Error in select paging:".mysql_error());
$getPageSize=mysql_fetch_array($sqlPaging);
define("SITENAME","E-KHOJASHOP.com");
define("SITETITLE","E-KHOJASHOP - THE CASHBACK SHOPPING NETWORK!");
define("ADMINTITLE","E-KHOJASHOP.com - Secure Administration Suite");
define("INVALIDPASSWORD","Please enter a valid username or password.");
define("PAGESIZE",$getPageSize['page_size']); // No. of record per page for display of results
define("MISMATCHPASS","Sorry, your passwords do not match.");
define("INCORRECTPASS","The password entered by you in incorrect.");
define("UPDATEPASS","Your password has been updated successfully.");
@extract($_REQUEST);
$currency="&pound;";

function getCategoryName($id)
{
	$r = mysql_query("select name from tbl_category where id='$id'");
	$s = mysql_fetch_array($r);
	return $s['name'];
}
function getUserName($id)
{
	$r = mysql_query("select concat_ws(' ',firstName,lastName) as name from tbl_user where id='$id'");
	$s = mysql_fetch_array($r);
	return $s['name'];
}	
function getUserSignupIp($id)
{
	$r = mysql_query("select ip from tbl_user where id='$id'");
	$s = mysql_fetch_array($r);
	return $s['ip'];
}	
*/
?>