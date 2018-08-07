
<?php
include("config.inc.php");
set_time_limit(20000);
//We have one more page in MC called other apart from these alphabetical listing. whch is not covered so far
for ($iLoop= 65; $iLoop<91;$iLoop++)
{
	$temp= chr($iLoop);
	$file_name= "http://www.moneycontrol.com/india/stockmarket/pricechartquote/".$temp;
	$handle = file_get_contents($file_name);
	$filtered_string1=NULL;
	$filtered_string1=$handle;
	$filtered_string1= strstr($filtered_string1,"pcq_tbl MT10");
	$filtered_string1= strstr($filtered_string1,"Moneycontrol Footer start here",true);	
	$count =0;
	while( $filtered_string1 != NULL )
	//while($count<1)
	{
		//echo "Gaurav".$count;
		$count=$count+1;
		//echo $filtered_string1;
		//$filtered_string1= strstr($filtered_string1,"http://www.moneycontrol.com/india/stockpricequote");
		//$filtered_string1= strstr($filtered_string1,"absmiddle");
		//echo "filtered_string1".$filtered_string1."<br>"; 
		//$CompanyUrl= strstr($filtered_string1,"'>", true);
		$CompanyUrl = substr($filtered_string1, 0, strpos($filtered_string1, "\" title")); // $result = php
		$CompanyUrl = substr($CompanyUrl,(strpos($CompanyUrl, "href=\"")+6));
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
		//echo "CompanyNameMc".$CompanyNameMc."<br>"; 
			
		$filtered_string1= substr($filtered_string1,strpos($filtered_string1,"title")+5);
		
		//Insert the company name and code in to name_code table
		// ************************NoTe out of the two query.use only one at a time******************************************/
			if($Companycode != NULL)
			{
					$res1=mysqli_query($link,"select * from name_code where code='$Companycode' ");
					$row = mysqli_fetch_array($res1);;
					$number = $row['number'];
					if ($number == NULL)
					{
						//echo "in If loop";
						$Url1 = $url;
						$Url1= strstr($Url1,"quote/");
						$Url1= substr($Url1,6);
						$type = substr($Url1, 0, strpos($Url1, "/"));		
						$res=mysqli_query($link, "insert into name_code set name= '$CompanyName', nameinmc='$CompanyNameMc', code='$Companycode' , company_url = '$url',company_type = '$type', Insertdate = CURDATE() ");
						echo "insert into name_code set name= '$CompanyName', nameinmc='$CompanyNameMc', code='$Companycode' , company_url = '$url',company_type = '$type', Insertdate = CURDATE() ";
					}
					else
					{
						//echo "in If loop";
						$Url1 = $url;
						$Url1= strstr($Url1,"quote/");
						$Url1= substr($Url1,6);
						$type = substr($Url1, 0, strpos($Url1, "/"));		
						$res=mysqli_query($link, "Update name_code set name= '$CompanyName', nameinmc='$CompanyNameMc', code='$Companycode' , company_url = '$url',company_type = '$type', Insertdate = CURDATE() where code='$Companycode'");
						echo "Updated row with companycode= ".$Companycode;
					} 
			} 
			//echo $filtered_string1;
			echo $Companycode." ----> ".$url."----> ".$CompanyNameMc."<br>";
	}
}

?>