<?php
/***********************************************************************************************
PHP File to read the Quarterly data for all companies for the financial year 12-13 till december quarter
***********************************************************************************************/
include("config.inc.php");
set_time_limit(20000);
//$res=mysql_query("select max(number) as maxi from name_code");
$result=mysql_query("select max(number) as maxnum from name_code");
$row = mysql_fetch_array($result);
$iCount= $row[maxnum]; //commented ************************************************************
//$iCount=7218;//hard coded for fetching 100 records.
// Open error log file
$myFile = "error_logs.txt";
$fh = fopen($myFile, 'a') or die("can't open file");

$tagtoCheck='td';

$classtoCheck="det";
$classtoCheckyear="detb";


function getTextBetweenTags($tag, $html, $strict=0,$class)
{
    /*** a new dom object ***/
    $dom = new domDocument;

    /*** load the html into the object ***/
    if($strict==1)
    {
        $dom->loadXML($html);
    }
    else
    {
        $dom->loadHTML($html);
    }

    /*** discard white space ***/
    $dom->preserveWhiteSpace = false;

    /*** the tag by its tag name ***/
    $content = $dom->getElementsByTagname($tag);

    /*** the array to return ***/
    $out = array();
    foreach ($content as $item)
    {
		$attr=$item->getAttribute('class');
if (strpos($attr,$class) !== false) 
 {
 $out[] = $item->nodeValue;
 }
        /*** add node value to the out array ***/
        
    }
    /*** return the results ***/
    return $out;
}

	



//loop to parse records
//for ($iLoopCtr= 1; $iLoopCtr<($iCount+1);$iLoopCtr++)
for ($iLoopCtr= 6494; $iLoopCtr<6495;$iLoopCtr++)
{
	$result=mysql_query("select * from name_code where number=$iLoopCtr");
	//$result=mysql_query("select * from name_code where number=567");
	
	$row = mysql_fetch_array($result);
	$UrlName="http://www.moneycontrol.com/financials/". $row['nameinmc']."/results/quarterly-results/".$row['code'];
	echo $UrlName;
	$handle = file_get_contents($UrlName);
	$filtered_string1=$handle;
	
	$content = @getTextBetweenTags($tagtoCheck, $filtered_string1,0,$classtoCheck);
	$max=sizeof($content);
	
	
	$contentyear = @getTextBetweenTags($tagtoCheck, $filtered_string1,0,$classtoCheckyear);
$maxyear=sizeof($contentyear);

$year[4];
$month[4];
	
	for($i=0;$i<$maxyear;$i++)
{
	if(strcmp($contentyear[$i],"")==0)
		{   
	

	
	$year[0]=substr($contentyear[++$i], -2); 
	$month[0]= substr($contentyear[$i], 0, 3); 
	$year[1]=substr($contentyear[++$i], -2); 
	$month[1]= substr($contentyear[$i], 0, 3); 
	$year[2]=substr($contentyear[++$i], -2); 
	$month[2]= substr($contentyear[$i], 0, 3); 
	$year[3]=substr($contentyear[++$i], -2); 
	$month[3]= substr($contentyear[$i], 0, 3); 
	break;
	}
}

	$dataNotFound = strstr($filtered_string1,"Data Not Available for ");
	
	if ($dataNotFound!= NULL)
	{	
		$stringData="Data Not Available for Quarterly Results". $row[code];
		echo "$stringData\r\n";
		fwrite($fh, "$stringData\r\n");

		$res=mysql_query("insert into temp_data_companies_curr set CompNumber='$row[number]',Comp_Code= '$row[code]', Jun_EPS='--',Jun_Operating_Profit='--',Jun_Sales='--',Sep_EPS='--',Sep_Operating_Profit='--',Sep_Sales='--', Dec_EPS='--',Dec_Operating_Profit='--',Dec_Sales='--'");
			continue;
	}	
	
$sales[4];
$operatingprofit[4];
$eps[4];


$max=sizeof($content);
$patterns =",";
$replacements1 = '';
	
	for($i=0;$i<$max;$i++)
{
if(strcmp($content[$i],'Net Sales/Income from operations')==0)
{   
for($countremove = 0 ; $countremove <4 ;$countremove++ ) 
	{
	switch($month[$countremove])
	{
	case "Mar":
	$sales[0] = str_replace($patterns,$replacements1,$content[++$i]);
	$maryear=$year[$countremove];
	break;
	case 'Jun':
	$sales[1] = str_replace($patterns,$replacements1,$content[++$i]);
	$junyear=$year[$countremove];
	break;
	case 'Sep':
	$sales[2] = str_replace($patterns,$replacements1,$content[++$i]);
	$sepyear=$year[$countremove];
	break;
	case 'Dec':
	$sales[3] = str_replace($patterns,$replacements1,$content[++$i]);
	$decyear=$year[$countremove];
	break;
	}
	
	
	}

}
else if(strcmp($content[$i],'P/L Before Other Inc. , Int., Excpt. Items & Tax')==0)
{   
for($countremove = 0 ; $countremove <4 ;$countremove++ )
{
switch($month[$countremove])
	{
	case 'Mar':
	$operatingprofit[0] = floatval($content[++$i]);
	break;
	case 'Jun':
	$operatingprofit[1] = floatval($content[++$i]);
	break;
	case 'Sep':
	$operatingprofit[2] = floatval($content[++$i]);
	break;
	case 'Dec':
	$operatingprofit[3] = floatval($content[++$i]);
	break;
	}
}


}

else if(strcmp($content[$i],'Diluted EPS')==0)
{   
for($countremove = 0 ; $countremove <4 ;$countremove++ ) //added by nitin
	{
	switch($month[$countremove])
	{
	case 'Mar':
	$eps[0] = str_replace($patterns,$replacements1,$content[++$i]);
	break;
	case 'Jun':
	$eps[1] = str_replace($patterns,$replacements1,$content[++$i]);
	break;
	case 'Sep':
	$eps[2] = str_replace($patterns,$replacements1,$content[++$i]);
	break;
	case 'Dec':
	$eps[3] = str_replace($patterns,$replacements1,$content[++$i]);
	break;
	}

	}

}

}


$res=mysql_query("insert into data_companies_curr_updated set CompNumber='$row[number]',Comp_Code= '$row[code]',Mar_EPS='$eps[0]',Mar_Operating_Profit='$operatingprofit[0]',Mar_Sales='$sales[0]',Mar_Year='$maryear',Jun_EPS='$eps[1]',Jun_Operating_Profit='$operatingprofit[1]',Jun_Sales='$sales[1]',Jun_Year='$junyear',Sep_EPS='$eps[2]',Sep_Operating_Profit='$operatingprofit[2]',Sep_Sales='$sales[2]',Sep_Year='$sepyear', Dec_EPS='$eps[3]',Dec_Operating_Profit='$operatingprofit[3]',Dec_Sales='$sales[3]',Dec_Year='$decyear'") or die ("Error in query: $query. " . mysql_error());
	
}
	//For loop closing brace
		fclose($fh);//close error log file
		
		echo "PROCESSING COMPLETED!!!!!!!";
?>