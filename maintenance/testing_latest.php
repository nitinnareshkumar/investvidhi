
<?php
include("config.inc.php");
set_time_limit(20000);
	
$myFile = "error_logs.txt";
$fh = fopen($myFile, 'a') or die("can't open file");

$result=mysql_query("select count(*) as count from name_code ");
$row=mysql_fetch_array($result);

echo $row['count'];

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

$testcount = 6495;
for ($iLoop= 6494; $iLoop < $testcount ;$iLoop++)
{

echo 'CurrentLoop'.$iLoop.'<br/>';
  $iterativeresult=mysql_query("select * from name_code where number=$iLoop");
$singlerow=mysql_fetch_array($iterativeresult);

$UrlName="http://www.moneycontrol.com/financials/".$singlerow['nameinmc']."/results/yearly/".$singlerow['code'];

echo $UrlName."<br/>";
$handle = file_get_contents($UrlName);
	$filtered_string1=$handle;

$filtered_string1=$handle;
	$dataNotFound = strstr($filtered_string1,"Data Not Available for Yearly Results");


if ($dataNotFound== NULL)
{
echo "data available"."<br/>";
}


$year[5];

$content = @getTextBetweenTags($tagtoCheck, $filtered_string1,0,$classtoCheck);
$contentyear = @getTextBetweenTags($tagtoCheck, $filtered_string1,0,$classtoCheckyear);
$maxyear=sizeof($contentyear);
for($i=0;$i<$maxyear;$i++)
{
	if(strcmp($contentyear[$i],"")==0)
		{   
	

	
	$year[0]=$contentyear[++$i];
	$year[0]= substr($year[0], -2); 
	$year[1]=$contentyear[++$i];
	$year[1]= substr($year[1], -2); 
	$year[2]=$contentyear[++$i];
	$year[2]= substr($year[2], -2); 
	$year[3]=$contentyear[++$i];
	$year[3]= substr($year[3], -2); 
	$year[4]=$contentyear[++$i];
	$year[4]= substr($year[4], -2); 
	echo "year1".$year[0].'<br />';
	echo "year2".$year[1].'<br />';
	echo "year3".$year[2].'<br />';
	echo "year4".$year[3].'<br />';
	echo "year5".$year[4].'<br />';
	break;
	}
}


$sales[5];
$operatingprofit[5];
$eps[5];


$max=sizeof($content);
$patterns =",";
$replacements1 = '';
		
for($i=0;$i<$max;$i++)
{

   // echo 'asdf'.$content[$i].'<br />';


if(strcmp($content[$i],'Net Sales/Income from operations')==0)
{   

$sales[4]=$content[++$i];
$sales[3]=$content[++$i];
$sales[2]=$content[++$i];
$sales[1]=$content[++$i];
$sales[0]=$content[++$i];
for($countremove = 0 ; $countremove <5 ;$countremove++ ) //added by nitin
	{
	$sales[$countremove] = str_replace($patterns,$replacements1,$sales[$countremove]);
	}

}
else if(strcmp($content[$i],"P/L Before Int., Excpt. Items & Tax")==0)
{   
 

echo 'operatingprofit'.$content[$i].'<br />';
$operatingprofit[4]=floatval($content[++$i]);
$operatingprofit[3]=floatval($content[++$i]);
$operatingprofit[2]=floatval($content[++$i]);
$operatingprofit[1]=floatval($content[++$i]);
$operatingprofit[0]=floatval($content[++$i]);

}

else if(strcmp($content[$i],'Basic EPS')==0)
{   
 

echo 'eps'.$content[$i].'<br />';
$eps[4]=$content[++$i];
$eps[3]=$content[++$i];
$eps[2]=$content[++$i];
$eps[1]=$content[++$i];
$eps[0]=$content[++$i];
for($countremove = 0 ; $countremove <5 ;$countremove++ ) //added by nitin
	{
	$eps[$countremove] = str_replace($patterns,$replacements1,$eps[$countremove]);
	}
break;
}






   
}



$arraysGrowth1[4];
$arrayeGrowth1[4];
$arrayoGrowth1[4];

$arraysGrowth[0] = '';
$arraysGrowth[1] = '';
$arraysGrowth[2] = '';
$arraysGrowth[3] = '';


$arrayoGrowth[0] = '';
$arrayoGrowth[1] = '';
$arrayoGrowth[2] = '';
$arrayoGrowth[3] = '';


$arrayeGrowth[0] = '';
$arrayeGrowth[1] = '';
$arrayeGrowth[2] = '';
$arrayeGrowth[3] = '';


$spositiveindicator = 1;
$epositiveindicator = 1;
$opositiveindicator = 1;


$salessum=0;
$epssum=0;
$operatingprofitsum=0;

for ($i=0 ; $i < 4 ;$i++)
	{

       //Sales Growth Calculation
		if ( ($sales[$i] == "NA" ) || ($sales[$i] == "--" )  || ($sales[$i]==''  ) || ($sales[$i] == "0.00" ))
		{
			continue;
		}
		if ( ($sales[$i + 1] == "NA" ) || ($sales[$i+1] == "--" )|| ($sales[$i+1]==''  ))
		{
			continue;
		}
		if ( $i==4)
		{
		continue;
		}
if($sales[$i+1]>=$sales[$i])
{
		$arraysGrowth[$i] = (($sales[$i + 1] - $sales[$i])/$sales[$i]) * 100;
}
else
{
$arraysGrowth[$i] = (($sales[$i] - $sales[$i+1])/$sales[$i]) * 100;
$arraysGrowth[$i] =-$arraysGrowth[$i];
}
		if ( $arraysGrowth[$i] < 0 )
		{
                $spositiveindicator = -1;
		}


		
				//echo $sales[$i].'<BR>';
				//echo $sales[$i+1].'<BR>';
				//echo "$arraysGrowth".$i."==".$arraysGrowth[$i].'<BR>';
                // echo "<br>";

           
		$salessum=$salessum+$arraysGrowth[$i];	


       //eps Growth Calculation
		if ( ($eps[$i] == "NA" ) || ($eps[$i] == "--" )  || ($eps[$i]==''  ) || ($eps[$i] == "0.00" ))
		{
			continue;
		}
		if ( ($eps[$i + 1] == "NA" ) || ($eps[$i+1] == "--" )|| ($eps[$i+1]==''  ))
		{
			continue;
		}
		if ( $i==4)
		{
		continue;
		}

if($eps[$i+1]>=$eps[$i])
{
		$arrayeGrowth[$i] = (($eps[$i + 1] - $eps[$i])/$eps[$i]) * 100;
}
else
{
$arrayeGrowth[$i] = (($eps[$i] - $eps[$i+1])/$eps[$i]) * 100;
$arrayeGrowth[$i] =-$arrayeGrowth[$i]; 
}
		if ( $arrayeGrowth[$i] < 0 )
		{
                $epositiveindicator = -1;
		}


		
	
			echo $eps[$i].'<BR>';
				echo $eps[$i+1].'<BR>';
				echo "$arrayeGrowth".$i."==".$arrayeGrowth[$i].'<BR>';
                // echo "<br>";

           
		$epssum=$epssum+$arrayeGrowth[$i];		


//Operating profit Growth Calculation
		if ( ($operatingprofit[$i] == "NA" ) || ($operatingprofit[$i] == "--" )  || ($operatingprofit[$i]==''  ) || ($operatingprofit[$i] == "0.00" ))
		{
			continue;
		}
		if ( ($operatingprofit[$i + 1] == "NA" ) || ($operatingprofit[$i+1] == "--" )|| ($operatingprofit[$i+1]==''  ))
		{
			continue;
		}
		if ( $i==4)
		{
		continue;
		}
if($operatingprofit[$i+1]>=$operatingprofit[$i])
{
		$arrayoGrowth[$i] = (($operatingprofit[$i + 1] - 				$operatingprofit[$i])/$operatingprofit[$i]) * 100;
}
else
{
$arrayoGrowth[$i] = (($operatingprofit[$i] - 				$operatingprofit[$i+1])/$operatingprofit[$i]) * 100;
$arrayoGrowth[$i] = - $arrayoGrowth[$i];
}
		if ( $arrayoGrowth[$i] < 0 )
		{
                $opositiveindicator = -1;
		}


		
	
				//echo "$arrayoGrowth".$i."==".$arrayoGrowth[$i];
                // echo "<br>";

           
		$operatingprofitsum=$operatingprofitsum+$arrayoGrowth[$i];	 
				 

	}

$averagesalessum=$salessum/4;
$averageepssum=$epssum/4;
$averageoperatingprofitsum=$operatingprofitsum/4;






$salesoutput=mysql_query("insert into sales_updated set companynumber='$singlerow[number]',companycode= '$singlerow[code]',value1='$sales[0]',value2='$sales[1]',value3='$sales[2]',value4='$sales[3]',value5='$sales[4]',growth1='$arraysGrowth[0]',growth2='$arraysGrowth[1]',growth3='$arraysGrowth[2]',growth4='$arraysGrowth[3]',growthalwayspositive='$spositiveindicator',growthper='$averagesalessum'  , year5='$year[0]',year4='$year[1]',year3='$year[2]',year2='$year[3]',year1='$year[4]'") or die ("Error in query: $query. " . mysql_error());//uncomment
$operatingprofitoutput=mysql_query("insert into operating_profit_updated set companynumber='$singlerow[number]',companycode= '$singlerow[code]',value1='$operatingprofit[0]',value2='$operatingprofit[1]',value3='$operatingprofit[2]',value4='$operatingprofit[3]',value5='$operatingprofit[4]',growth1='$arrayoGrowth[0]',growth2='$arrayoGrowth[1]',growth3='$arrayoGrowth[2]',growth4='$arrayoGrowth[3]',growthalwayspositive='$opositiveindicator',growthper='$averageoperatingprofitsum'  , year5='$year[0]',year4='$year[1]',year3='$year[2]',year2='$year[3]',year1='$year[4]'") or die ("Error in query: $query. " . mysql_error());//uncomment
$epsoutput=mysql_query("insert into eps_updated set companynumber='$singlerow[number]',companycode= '$singlerow[code]',value1='$eps[0]',value2='$eps[1]',value3='$eps[2]',value4='$eps[3]',value5='$eps[4]',growth1='$arrayeGrowth[0]',growth2='$arrayeGrowth[1]',growth3='$arrayeGrowth[2]',growth4='$arrayeGrowth[3]',growthalwayspositive='$epositiveindicator',growthper='$averageepssum'  , year5='$year[0]',year4='$year[1]',year3='$year[2]',year2='$year[3]',year1='$year[4]'") or die ("Error in query: $query. " . mysql_error());//uncomment






break;

}



	
?>
