<?php
include("config/config.inc.php");

if ($_POST['formsubmit'] != 1)
{
 for($i=15;$i<25 ;$i++){

$_SESSION['sessionParameterData'][$i]=$_POST['parameterData'][$i];
$_SESSION['SessionRating'][$i]=$_POST['a_'.$i];
$_SESSION['sessionParameterRemarks'][$i]=$_POST['parameterRemarks'][$i];

}
}
 $fromMyacount = $_GET['frommyaccount'];
 if ($fromMyacount == 'Y' )
	{
	
	$_SESSION['companynumber'] = $_GET['number'];
	$number = $_SESSION['companynumber'];
	$userid = $_SESSION['userid'];
	for($i=0;$i<25 ;$i++){

$_SESSION['sessionParameterData'][$i]="";
$_SESSION['SessionRating'][$i]="";

$_SESSION['sessionParameterRemarks'][$i]="";
$_SESSION['SessionOverallRating'] = "";
$_SESSION['SessionValuationRating'] = "";

}
	 $analyselist=mysql_query("select * from user_analyze_companies where companynumber  = $number and userid = '$userid' ");
	 
	  				if($rows_st=mysql_num_rows($analyselist))
					{   					
							//while($row_st=mysql_fetch_assoc($area_suggested))
							while($row_st=mysql_fetch_array($analyselist))
							{
							//echo $row_st['P_data'].$row_st['P_rating'].$row_st['P_remarks'];
									if ( $row_st['P_code'] == 1001)
									{
									$_SESSION['sessionParameterData'][0]= $row_st['P_data'];
									$_SESSION['SessionRating'][0]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][0]=$row_st['P_remarks'];										
									}								
									if ( $row_st['P_code'] == 1002)
									{
									$_SESSION['sessionParameterData'][1]= $row_st['P_data'];
									$_SESSION['SessionRating'][1]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][1]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1003)
									{
									$_SESSION['sessionParameterData'][2]= $row_st['P_data'];
									$_SESSION['SessionRating'][2]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][2]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1003)
									{
									$_SESSION['sessionParameterData'][2]= $row_st['P_data'];
									$_SESSION['SessionRating'][2]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][2]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1003)
									{
									$_SESSION['sessionParameterData'][2]= $row_st['P_data'];
									$_SESSION['SessionRating'][2]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][2]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1004)
									{
									$_SESSION['sessionParameterData'][3]= $row_st['P_data'];
									$_SESSION['SessionRating'][3]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][3]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1005)
									{
									$_SESSION['sessionParameterData'][4]= $row_st['P_data'];
									$_SESSION['SessionRating'][4]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][4]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1006)
									{
									$_SESSION['sessionParameterData'][5]= $row_st['P_data'];
									$_SESSION['SessionRating'][5]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][5]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1007)
									{
									$_SESSION['sessionParameterData'][6]= $row_st['P_data'];
									$_SESSION['SessionRating'][6]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][6]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1008)
									{
									$_SESSION['sessionParameterData'][7]= $row_st['P_data'];
									$_SESSION['SessionRating'][7]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][7]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1009)
									{
									$_SESSION['sessionParameterData'][8]= $row_st['P_data'];
									$_SESSION['SessionRating'][8]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][8]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1010)
									{
									$_SESSION['sessionParameterData'][9]= $row_st['P_data'];
									$_SESSION['SessionRating'][9]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][9]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1011)
									{
									$_SESSION['sessionParameterData'][10]= $row_st['P_data'];
									$_SESSION['SessionRating'][10]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][10]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1012)
									{
									$_SESSION['sessionParameterData'][11]= $row_st['P_data'];
									$_SESSION['SessionRating'][11]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][11]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1013)
									{
									$_SESSION['sessionParameterData'][12]= $row_st['P_data'];
									$_SESSION['SessionRating'][12]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][12]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1014)
									{
									$_SESSION['sessionParameterData'][13]= $row_st['P_data'];
									$_SESSION['SessionRating'][13]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][13]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1015)
									{
									$_SESSION['sessionParameterData'][14]= $row_st['P_data'];
									$_SESSION['SessionRating'][14]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][14]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1016)
									{
									$_SESSION['sessionParameterData'][15]= $row_st['P_data'];
									$_SESSION['SessionRating'][15]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][15]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1017)
									{
									$_SESSION['sessionParameterData'][16]= $row_st['P_data'];
									$_SESSION['SessionRating'][16]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][16]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1018)
									{
									$_SESSION['sessionParameterData'][17]= $row_st['P_data'];
									$_SESSION['SessionRating'][17]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][17]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1019)
									{
									$_SESSION['sessionParameterData'][18]= $row_st['P_data'];
									$_SESSION['SessionRating'][18]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][18]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1020)
									{
									$_SESSION['sessionParameterData'][19]= $row_st['P_data'];
									$_SESSION['SessionRating'][19]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][19]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1021)
									{
									$_SESSION['sessionParameterData'][20]= $row_st['P_data'];
									$_SESSION['SessionRating'][20]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][20]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1022)
									{
									$_SESSION['sessionParameterData'][21]= $row_st['P_data'];
									$_SESSION['SessionRating'][21]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][21]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1023)
									{
									$_SESSION['sessionParameterData'][22]= $row_st['P_data'];
									$_SESSION['SessionRating'][22]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][22]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1024)
									{
									$_SESSION['sessionParameterData'][23]= $row_st['P_data'];
									$_SESSION['SessionRating'][23]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][23]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1025)
									{
									$_SESSION['sessionParameterData'][24]= $row_st['P_data'];
									$_SESSION['SessionRating'][24]=		  $row_st['P_rating'];
									$_SESSION['sessionParameterRemarks'][24]=$row_st['P_remarks'];										
									}
									if ( $row_st['P_code'] == 1100)
									{
									$_SESSION['SessionOverallRating'] = $row_st['P_rating'];
									}
									if ( $row_st['P_code'] == 1102)
									{
									$_SESSION['SessionValuationRating'] = $row_st['P_rating'];
									}
							}
					}
	}
	
if ($_POST['formsubmit'] == 1)
{

	$userid = $_SESSION['userid'];
	$number = $_SESSION['companynumber'];
	$next = "Myaccount.php";
	//to check if company already present due to already analyzed , we need to delete old data
	$alreadyanalysed =mysql_query("select * from user_analyze_companies where companynumber  = $number and userid = '$userid' ");
	$rows_st1=mysql_num_rows($alreadyanalysed);
	
	$sql = "INSERT INTO user_analyze_companies (userid, companynumber, P_code, P_data , P_rating , P_remarks , lastupdateddate	)
 	 VALUES ";
	 $today = date("Y-m-d h:i:s") ;
	 
	for ($county = 0 ;$county <25 ; $county++)
	{
	
 		 if (($_SESSION['sessionParameterData'][$county] != "")|| ($_SESSION['SessionRating'][$county] != "")||($_SESSION[		'sessionParameterRemarks'][$county] != ""))
 		 {
  			$pcode = $_SESSION['Pcode'][$county];
  			$pdata = $_SESSION['sessionParameterData'][$county];
  			$prating = $_SESSION['SessionRating'][$county];
  			$premarks = $_SESSION['sessionParameterRemarks'][$county];
 			 
  			if ($county == 0)
  			{ $sql = $sql."('$userid', $number, '$pcode','$pdata' ,'$prating','$premarks', '$today')";}
  			else
  			{$sql = $sql." , "."('$userid', $number , '$pcode','$pdata' ,'$prating','$premarks' , '$today')";}
 
  		}
	}
	$prating = $_POST['O_rating'];
	$Vrating = $_POST['V_rating'];
	$sql = $sql." , "."('$userid', $number , '1100', '' ,'$prating', '' , '$today')";
	$sql = $sql." , "."('$userid', $number , '1102', '' ,'$Vrating', '' , '$today')";
	//echo "<br>".$sql."<br>";
	$resinsert = mysql_query($sql) or die(mysql_error()) ;
	if(!$resinsert)
		{
			echo "Error inserting analyse sheet ";
		}
	else
		{	
			if ( $rows_st1 > 0 )
			{
	
			$resdeleteexisting = mysql_query("delete  from user_analyze_companies where companynumber  = $number and userid = $userid and lastupdateddate != '$today' " ) or die(mysql_error()) ;
			
		
			$resUserCompanies=mysql_query("update user_companies set UpdateDate = '$today' where userid= $userid and companynumber=$number and favorite_analyse='A'  ")or die(mysql_error()) ;
			
			}
			else
			{
			$resUserCompanies=mysql_query("insert into user_companies set UpdateDate = '$today' , userid= $userid ,companynumber=$number , favorite_analyse='A'  ")or die(mysql_error()) ;
			
			}
			unset( $_SESSION['companynumber']);
			unset( $_SESSION['companycode']);
			for ($countydestroy = 0 ;$countydestroy <25 ; $countydestroy++)
			{
			unset( $_SESSION['Pcode'][$countydestroy] );
			unset( $_SESSION['sessionParameterData'][$countydestroy] );
			unset( $_SESSION['SessionRating'][$countydestroy] );
			unset($_SESSION['sessionParameterRemarks'][$countydestroy] );
			}
			
		}
header("Location: $next");
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Summary of Analysis Sheet</title>
<link rel="stylesheet" type="text/css" href="css/style.css">



    <link class="include" rel="stylesheet" type="text/css" href="jquerychart/jquery.jqplot.min.css" />
  <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="jquerychart/excanvas.js"></script><![endif]-->

	<script class="include" type="text/javascript" src="jquerychart/jquery.min.js"></script>
</head>
<body>

  <style type="text/css">
    .jqplot-target {
        margin-bottom: 0em;
    }
    
    .note {
        font-size: 0.8em;
    }
    
    #tooltip1b {
        font-size: 12px;
        color: rgb(15%, 15%, 15%);
        padding:2px;
        background-color: #cdcdcd;
    }
    
    #legend1b {
        font-size: 12px;
        border: 1px solid #cdcdcd;
        border-collapse: collapse;
    }
    #legend1b td, #legend1b th {
        border: 1px solid #cdcdcd;
        padding: 1px 4px;
    }
  </style>
<?php
include("header.inc.php");
?>
<div class="clear5"></div>

 <? 
	 $searchCompanyCode = $_SESSION['companycode'];
	 $number = $_SESSION['companynumber'];
     $companySearch1=mysql_query("select * from name_code where number = $number ");
	 $row1 = mysql_fetch_array($companySearch1);
	$name = $row1['name'];
	$bseScript = $row1['BSE_Script']; 
	$companyUrl = $row1['company_url']; 
	$mcode = $row1['code']; //money control code
	$companyType = $row1['Company_type'];
	$isBank ='' ;
	if ($companyType == "banks-private-sector" || $companyType == "banks-public-sector")
	{	$ProfitLossPage = "Profit_Loss_Banks.php" ;
		$BalanceSheetPage = "Balance_Sheet_Banks.php" ;
		$isBank = 'Y' ;
	}
	else
	{ $ProfitLossPage = "Profit_Loss.php";	
	  $BalanceSheetPage = "Balance_Sheet.php" ;
	  $isBank = 'N' ;
	}
	
	 //to get rating
	
	?>
<table width="800" border="0" align="center" bordercolor="#333333" bgcolor="#FFFFFF">
<tr ><td align="center"><h3>Analysis of the company based on 25 Fundamental Parameters , Add Fundamental Rating and Valuation Rating</h3></td> </tr></table>
<table width="700" border="1" align="center" bordercolor="#000000" bgcolor="#FFFFFF">
<tr>
    <td width="300" align="left" valign="top"><span class="greytxt12">Company Name - <? echo $name ?></span> </td><td width="200" align="left" valign="top"><span class="greytxt12">Company Number - <? echo $number?>             </span>  </td><td width="200" align="left" valign="top"><span class="greytxt12"> BSE Script ID - <? echo "     ".$bseScript?></span> </td>   </tr>
</table>

<table width="800" border="0" align="center" bordercolor="#333333" bgcolor="#FFFFFF"><tr bordercolor="#333333"><td width="45" align="left" valign="top"><a  class="tooltip">
    <img align="bottom" src="images/help1.jpg"  width="45" height="45">
    <span>
        <strong style="color:#009900">Analysis Cloud</strong><br />
        The below analysis cloud can rate the company on 25 fundamental parameters , select the rating of each parameter on previous
        2 sheets.It is suggested that investor should rate each of the 25 parameters to cover each aspect of company's business.<br>
        Analysis cloud give weightage to each fundamental parameter.Weightage can vary from 3 to 5.Parameter with higher weightage
        will have bigger circle in the cloud.For e.g cash flow has weightage of 5 so it will have cirlce with maximum size.<br>
        Now rating of each parameter can vary from 1 to 5.Poor rating i.e 1 is shown in red and best rating is shown in dark green
        color.<br>
       <strong> Analysis cloud for Great Companies will be Green and that of average/poor companies will be red.So Your Company should
        have Green cloud , darker the green ,better is the company </strong>
    </span>
</a></td></tr></table>

<table width="1000" border="0" align="right" bordercolor="#000000" bgcolor="#FFFFFF"><tr>
<td width="40" align="left" valign="top"></td>
    <td><div id="chart1b" class="plot" style="width:1000px;height:340px;"></div></td><td width="100">   </td><td><div style="height:340px;"></div></td>
    </tr>
<tr><td width="40" align="left" valign="top" >  </td><td height="40"><?php if ($isBank != 'Y' ) {  ?> <a  href="Graph.php" target="_blank"> Click here </a> to see all graphs <?php } ?></td>
</tr>

</table>

<?php 

$varBubbleGraph = "[ ";
$validcountGraph = 0;
for ($county = 0 ;$county <25 ; $county++)
	{ 
 		 if ($_SESSION['SessionRating'][$county] != "")
 		 {
			 if ($validcountGraph == 0)
		 	{ 
				$varcomma = "";
			}
			else
			{
			$varcomma = " , ";
			}
			if ( $validcountGraph == 0 || $validcountGraph == 1 || $validcountGraph == 2 )
			{			$xaxis= 2;}
			if ( $validcountGraph == 3 || $validcountGraph == 4 || $validcountGraph == 5 )
			{			$xaxis= 4;}
			if ( $validcountGraph == 6 || $validcountGraph == 7 || $validcountGraph == 8 )
			{			$xaxis= 6;}
			if ( $validcountGraph == 9 || $validcountGraph == 10 || $validcountGraph == 11 )
			{			$xaxis= 8;}
			if ( $validcountGraph == 12 || $validcountGraph == 13 || $validcountGraph == 14 )
			{			$xaxis= 10;}
			if ( $validcountGraph == 15 || $validcountGraph == 16 || $validcountGraph == 17 )
			{			$xaxis= 12;}
			if ( $validcountGraph == 18 || $validcountGraph == 19 || $validcountGraph == 20 )
			{			$xaxis= 14;}
			if ( $validcountGraph == 21 || $validcountGraph == 22 || $validcountGraph == 23 )
			{			$xaxis= 16;}
			if ( $validcountGraph == 24 || $validcountGraph == 25 || $validcountGraph == 26 )
			{			$xaxis= 18;}
			if ( ($validcountGraph == 0) || ($validcountGraph == 3) || ($validcountGraph == 6) || ($validcountGraph == 9) ||  ($validcountGraph == 12)  || ($validcountGraph == 15 )|| ($validcountGraph == 18) || ($validcountGraph == 21 )|| ($validcountGraph ==24))   
				{$yaxis= 20 ;}
			if ( $validcountGraph == 1 || $validcountGraph == 4 || $validcountGraph == 7 || $validcountGraph == 10 ||  $validcountGraph == 13  || $validcountGraph == 16 || $validcountGraph == 19 || $validcountGraph == 22 || $validcountGraph == 25)   
				{$yaxis= 40 ;}
			if ( $validcountGraph == 2 || $validcountGraph == 5 || $validcountGraph == 8 || $validcountGraph == 11 ||  $validcountGraph == 14  || $validcountGraph == 17 || $validcountGraph == 20 || $validcountGraph == 23)   
				{$yaxis= 60 ;}
			$radius = $_SESSION['weight'][$county]*300;
			$label1 = $_SESSION['Parameter_ShortDesc'][$county];
			if ($_SESSION['SessionRating'][$county] == 1) 				{	$color1 = 'red'; }
			if ($_SESSION['SessionRating'][$county] == 2) 				{	$color1 = 'orangered'; }
			if ($_SESSION['SessionRating'][$county] == 3) 				{	$color1 = 'aquamarine'; }
			if ($_SESSION['SessionRating'][$county] == 4) 				{	$color1 = 'limegreen'; }
			if ($_SESSION['SessionRating'][$county] == 5) 				{	$color1 = 'green'; }
		 	$varBubbleGraph = $varBubbleGraph.$varcomma."[".$xaxis.",".$yaxis.",".$radius.","." {label:'".$label1."' ,"."color:'".$color1."' }"."]" ;
			$validcountGraph = $validcountGraph + 1;
         }
     }
	 
	 $varBubbleGraph = $varBubbleGraph." ]";
	// echo $varBubbleGraph;
?>
<script  language="javascript" type="text/javascript">$(document).ready(function(){
    
    
    var arr = <?php echo $varBubbleGraph; ?> ;
    plot1b = $.jqplot('chart1b',[arr],{
        title: '<span class="greentxt14">Analysis Cloud : How Green is the Company? </span> <br> <span class="greytxt12">Please refresh the page if cloud is not displayed</span>',
        seriesDefaults:{
            renderer: $.jqplot.BubbleRenderer,
            rendererOptions: {
                bubbleAlpha: 0.6,
                highlightAlpha: 0.8,
                showLabels: true
            },
            shadow: true,
            shadowAlpha: 0.05
        }
    });
    
    // Legend is a simple table in the html.
    // Now populate it with the labels from each data value.
    $.each(arr, function(index, val) {
	 var Color1 = val[3].color ;
	 var rating1 ='';
	
	if (Color1  == 'red'){  rating1 = 1 ;}
	if (Color1  == 'orangered'){  rating1 = 2 ;}
	if (Color1  == 'aquamarine'){  rating1 = 3 ;}
	if (Color1  == 'limegreen'){  rating1 = 4 ;}
	if (Color1  == 'green'){  rating1 = 5 ;}
        $('#legend1b').append('<tr><td>'+val[3].label+'</td><td>'+rating1+'</td></tr>');
    });
    
    // Now bind function to the highlight event to show the tooltip
    // and highlight the row in the legend. 
    $('#chart1b').bind('jqplotDataHighlight', 
        function (ev, seriesIndex, pointIndex, data, radius) {    
            var chart_left = $('#chart1b').offset().left,
                chart_top = $('#chart1b').offset().top,
                x = plot1b.axes.xaxis.u2p(data[0]),  // convert x axis unita to pixels on grid
                y = plot1b.axes.yaxis.u2p(data[1]);  // convert y axis units to pixels on grid
				
            var color = 'rgb(50%,50%,100%)';
            $('#tooltip1b').css({left:chart_left+x+radius+5, top:chart_top+y});
            $('#tooltip1b').html('<span style="font-size:14px;font-weight:bold;color:'+color+';">' + 
            data[3].label + '</span><br />' + 'Weight: '+data[2]/300 );
            $('#tooltip1b').show();
            $('#legend1b tr').css('background-color', '#ffffff');
            $('#legend1b tr').eq(pointIndex+1).css('background-color', color);
        });
    
    // Bind a function to the unhighlight event to clean up after highlighting.
    $('#chart1b').bind('jqplotDataUnhighlight', 
        function (ev, seriesIndex, pointIndex, data) {
            $('#tooltip1b').empty();
            $('#tooltip1b').hide();
            $('#legend1b tr').css('background-color', '#ffffff');
        });
});</script>
<script class="include" type="text/javascript" src="jquerychart/jquery.jqplot.min.js"></script>
<!-- End Don't touch this! -->

<!-- Additional plugins go here -->

    <script class="include" language="javascript" type="text/javascript" src="jquerychart/jqplot.highlighter.min.js"></script>
    <script class="include" language="javascript" type="text/javascript" src="jquerychart/jqplot.cursor.min.js"></script>
    <script class="include" language="javascript" type="text/javascript" src="jquerychart/jqplot.dateAxisRenderer.min.js"></script>
<script class="include" type="text/javascript" src="jquerychart/jqplot.bubbleRenderer.min.js"></script>


<div align="center">
<form action="Analyse_Sheet_Summary.php" method="post" enctype="multipart/form-data" name="" id="">
<table width="900" border="1" align="center" bordercolor="#333333" bgcolor="#FFFFFF">
<tr >
  <td width="36" align="left" valign="top"></td>
   <td width="41" align="left" valign="top" class="cell"><span class="greytxt14">S.No</span>  </td>
    <td width="220" align="left" valign="top" class="cell"><span class="greytxt14">Parameter Name</span>  </td>
  	<td width="197" align="left" valign="top" class="cell"><span class="greytxt14">Data</span>  </td>
   <td width="50" align="left" valign="top" class="cell"><span class="greytxt14">Rating</span></td>
  	<td width="200" align="left" valign="top" class="cell"><span class="greytxt14">Remarks<br>%</span>  </td>
</tr>
 
 <?php  $getparameters = mysql_query("select * from master_analyze_sheet where visible = 'Y' order by sequence");
 $i=0; 
	while($row_st1=mysql_fetch_array($getparameters))
	{ 
	$i = $i + 1; 
	$_SESSION['Pcode'][$i-1]  = $row_st1['P_Number'];
	$_SESSION['Parameter_ShortDesc'][$i-1] = $row_st1['Parameter_ShortDesc'];
	$_SESSION['weight'][$i-1] = $row_st1['weight'];
	?>
<tr bordercolor="#333333">
  <td width="36" align="left" valign="top"><a  class="tooltip">
    <img src="images/help1.jpg" height="8" align="bottom"  class ="helpimagesize">
    <span>
        <strong style="color:#009900"><?=$row_st1['Parameter_ShortDesc']?></strong><br />
        <?=$row_st1['helptxt']?>
    </span>
</a></td>
     <td width="41" align="left" valign="top" class="cell" ><span class="greytxt14"><?php echo $i; ?></span>  </td>
     <td width="220" align="left" valign="top" class="cell"><span class="greytxt14"><?php echo $row_st1['Parameter_Desc']; ?></span>  </td>
    <td width="197" align="left" valign="top"><span class="greytxt12"><?php $DisplayParData = $_SESSION['sessionParameterData'][$i-1] ; $DisplayParData = str_replace("\n", "<br>", $DisplayParData); echo $DisplayParData ; ?></span></td>
      <td width="50" align="left" valign="top"><span class="greytxt12">
      <?php echo $_SESSION['SessionRating'][$i - 1] ; ?> </span>   </td>
    <td width="200" align="left" valign="top"><span class="greytxt12"><?php $RemarksParData =  $_SESSION['sessionParameterRemarks'][$i-1] ;  $RemarksParData = str_replace("\n", "<br>", $RemarksParData); echo $RemarksParData ; ?> </span> </td></tr>
        <?php } ?>
 
  

	
</table> <div class="clear2"></div> <table width="800" border="1" align="center" bordercolor="#333333" bgcolor="#FFFFFF"><tr bordercolor="#333333"><td width="36" align="left" valign="top"><a  class="tooltip">
    <img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900">Overall Fundamental Rating</strong><br />
        This indicates the overall rating of the company after analyzing the business , financial strength , management quality , growth and other fundamental parameters of the compan y.<br>
Give ratings from 1 to 5 where <br>
<strong>1</strong> means a very average company with low growth , low return 
on equity, needs lot of capital expenditure and have no competitive advantage.<br>
<strong>5</strong> means a company with good growth , good cash flows , good return on equity , exceptional brand value , needs very less capex and working capital and have bright future prospects.
    </span>
</a></td><td width="200" align="left" valign="top" class="cell"><span class="greytxt14">Overall Fundamental Rating </span>  </td><td width="34" align="left" valign="top"><span class="greytxt12"><select name="O_rating" >
     <option value="" > </option>
    <?php for ($icount = 1 ; $icount <6 ; $icount++)
	{   ?>
	<option value="<?php echo $icount ; ?>" <?php if ($_SESSION['SessionOverallRating'] == $icount) { ?> selected="selected"<? }?> ><?php echo $icount ; ?> </option>
	<?php }
	?>
  
</select></span>   </td></tr>
<tr bordercolor="#333333"><td width="36" align="left" valign="top"><a  class="tooltip">
    <img align="bottom" src="images/help1.jpg"  class ="helpimagesize">
    <span>
        <strong style="color:#009900">Valuation Rating</strong><br />
        This indicates the valuation rating of the company 
Give ratings from 1 to 5 where <br>
<strong>1</strong> means that stock price of the company is at very high valuation compared to business prospects of the company and there is either no upside in near future or stock price can go down in near future<br>
<strong>5</strong> means that stock price of the company is at very low valuation compared to business prospects of the company , hence lot of upside can happen.
    </span>
</a></td><td width="200" align="left" valign="top" class="cell"><span class="greytxt14">Valuation Rating </span>  </td><td width="34" align="left" valign="top"><span class="greytxt12"><select name="V_rating" >
     <option value="" > </option>
    <?php for ($icount = 1 ; $icount <6 ; $icount++)
	{   ?>
	<option value="<?php echo $icount ; ?>" <?php if ($_SESSION['SessionValuationRating'] == $icount) { ?> selected="selected"<? }?> ><?php echo $icount ; ?> </option>
	<?php }
	?>
  
</select></span>   </td></tr></table> <div class="clear2"></div><input type="hidden" name ="formsubmit" class="btn" value="1"><div class="analyzenext-submit"> <input type="button" class="btn" value="Edit" onClick="javascript:location.href='Analyse_Sheet.php'"> <input type="submit" class="btn" value="Submit"> </div></form>
</div>
<div class="clear2"></div>

<div class="clear12"></div>
<div class="clear5"></div>
<?php include("footer.inc.php"); ?>
</body>
</html>
