
<?php
include("config/config.inc.php");
set_time_limit(20000);
for ($iLoop= 65; $iLoop<91;$iLoop++)
{
	$temp= chr($iLoop);
	$file_name= "http://www.moneycontrol.com/india/stockmarket/pricechartquote/".$temp;
	$handle = file_get_contents($file_name);
	$filtered_string1=$handle;
	while( $filtered_string1 != NULL )
	{
	$filtered_string1= strstr($filtered_string1,"http://www.moneycontrol.com/india/stockpricequote");
	//echo "filtered_string1".$filtered_string1."<br>"; 
	//$CompanyUrl= strstr($filtered_string1,"'>", true);
	$CompanyUrl = substr($filtered_string1, 0, strpos($filtered_string1, "\" c")); // $result = php
	$url=$CompanyUrl;
		//echo "url".$url."<br>"; 
		

	//echo $CompanyUrl;
	//to update the url in table
	
	//$CompanyUrl = strstr($CompanyUrl,"http://www.moneycontrol.com/india/stockpricequote/");
	$CompanyUrl1 = strrchr($CompanyUrl,"/");
	//echo "CompanyUrl1".$CompanyUrl1."<br>"; 

	$Companycode = substr($CompanyUrl1, 1); 
//echo "Companycode".$Companycode."<br>"; 
	//$CompanyUrl= strstr($CompanyUrl,$CompanyUrl1, true);
	
	$CompanyUrl = substr($CompanyUrl, 0, strpos($CompanyUrl, $CompanyUrl1)); // $result = php

	$CompanyNameMc = strrchr($CompanyUrl,"/");
	$CompanyNameMc = substr($CompanyNameMc, 1); 
	$patterns = '-';
	$replacements1 = ' ';
	$replacements = '';
	$CompanyName =  str_replace($patterns,$replacements1,$CompanyNameMc);
	//echo "CompanyName".$CompanyName."<br>"; 

	$CompanyNameMc =  str_replace($patterns,$replacements,$CompanyNameMc);
	//	echo "CompanyNameMc".$CompanyNameMc."<br>"; 
		

	$filtered_string1= strstr($filtered_string1,"\" c");
	//Insert the company name and code in to name_code table
	// ************************NoTe out of the two query.use only one at a time******************************************/
	if($Companycode != NULL)
		$res=mysql_query("insert into name_code set name= '$CompanyName', nameinmc='$CompanyNameMc', code='$Companycode' , company_url = '$url'");
		
	
	 
	}
}

?>