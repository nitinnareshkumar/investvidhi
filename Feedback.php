<?php
include("config/config.inc.php");
function readmyfile($path)
{
	$text='';
	$fp = fopen($path,"r") or die("Invalid Path");
	while (!@feof($fp))
	{
	$buffer = @fgets($fp, 4096);
	$text.= $buffer;
	}
	@fclose($fp);
	return $text;
}
//include("includes/commonfunc.php");
if($_POST['form_feedback1']==1)
{

	extract($_POST);
	// check for email already
	
	
		$next = "index.php";
		$today = date("Y-m-d h:i:s") ;
		$res=mysql_query("insert into feedback set name='$txt_name1' , phone ='$txt_phone1', emailid='$txt_email1',  topic = '$select_question1' , date ='$today', comments = '$txt_comments'");
		//send mail that feedback has been added
		$to ="nitinnareshkumar@gmail.com";
		$user_mail = $txt_email1;
		$feedback = $txt_name1;
		$from_email="admin@pupone.com";
		$subject="pupone.com: feedback added";
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$from = "pupone <".$from_email."> \r\n";
		$mail_body = readmyfile("emails/feedback.txt");
		//$mail_body = str_replace("<Name>", $row_select[4], $mail_body);
		$mail_body = str_replace("<Usermail>", $user_mail, $mail_body);
		$mail_body = str_replace("<Feedback>", $feedback, $mail_body);
		mail($to,$subject,$mail_body,"From:$from");
		
		if($_REQUEST['back'])
		header("Location: $back");
		else
		header("Location: $next");
		die();
	
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Feedback</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<script>
function trim(s) {
  while (s.substring(0,1) == ' ') {
    s = s.substring(1,s.length);
  }
  while (s.substring(s.length-1,s.length) == ' ') {
    s = s.substring(0,s.length-1);
  }
  return s;
}

function validEmailAddress(email)
{
		invalidChars = " /:,;~"
		if (email == "") 
		{
			return (false);
		}
		for (i=0; i<invalidChars.length; i++) 
		{
			badChar = invalidChars.charAt(i)
			if (email.indexOf(badChar,0) != -1) 
			{
				return (false);
			}
		}
		atPos = email.indexOf("@",1)
		if (atPos == -1) 
		{
			return (false);
		}
		if (email.indexOf("@",atPos+1) != -1) 
		{
			return (false);
		}
		periodPos = email.indexOf(".",atPos)
		if (periodPos == -1) 
		{
			return (false);
		}
		if (periodPos+3 > email.length)	
		{
			return (false);
		}
			
		return (true);
}


function validPhoneNum(number)
{
    // Check that only digits are entered	 
    var c;
    for( i=0; i<12; i++ ){
        //convert the i-th character to ascii code value
        c = number.charCodeAt(i);		
        if((c<48) || (c>57))
		{		
		 return false;
		}
    }
    return true;
}
function validNum(number)
{
    // Check that only digits are entered	 
    var c;
	var count=0;	
    for( i=0; i<12; i++ ){
        //convert the i-th character to ascii code value
        c = number.charCodeAt(i);		
        if(((c<48) || (c>57)) && (c!=45))
		{		
		 return false;
		}
    }
	for( i=0; i<12; i++ ){
	 c = number.charCodeAt(i);
	 if (c==45){
	     count++;
		 } 
	}
	if (count >1 )
	{
		return false; 
	}
    return true;
}
function validName(number)
{
    // Check that only digits are entered	 
    var c;	    
    for( i=0; i<50; i++ ){
        //convert the i-th character to ascii code value
        c = number.value.charCodeAt(i);		
        if(((c<65) || ((c>90)&&(c<97))||(c>122) )&& (c!=39 && c!=32))
		{		
		 return false;
		}
    }
    return true;
}
function validate_form(objfrm)
{
	msg="Sorry, we cannot complete your request.\nKindly provide us the missing or incorrect information enclosed below.\n\n";

	if(trim(objfrm.txt_name1.value)=='')	msg+='- Please enter name. \n';
	if(trim(objfrm.txt_comments.value)=='')	msg+='- Please enter comments. \n';	
	if(trim(objfrm.txt_phone1.value)!='')
	{	 		
		if(validNum(objfrm.txt_phone1.value)==false)
		{		
			msg+='- Please enter numeric phone number. \n';			
		}
	}		
	if(trim(objfrm.txt_email1.value)=='')	msg+='- Please enter email address. \n';	
	else if(!validEmailAddress(trim(objfrm.txt_email1.value)))
	{
		msg +=  "- Please enter valid email address.\n";		
	}	
	if(trim(objfrm.select_question1.value)=='---Select---')	msg+='- Please choose topic. \n';	
	if(msg!="Sorry, we cannot complete your request.\nKindly provide us the missing or incorrect information enclosed below.\n\n")
	{
		alert(msg);
		return false;
	}
	else
	{
		return true;
	}
}



</script>

<?php
include("header.inc.php");
?>

<div class="clear12"></div>
<div align="center">

<form action="Feedback.php" method="post" enctype="multipart/form-data" name="feedbackform"  onSubmit="return validate_form(this)" id="">


<table width="500" border="0" align="left" bordercolor="#333333" bgcolor="#FFFFFF">
<tr > 
     <td width="50" align="left" valign="top">  </td>
    <td width="200" align="left" valign="top"><span class="redtxt"><?=$errmsg?></span></td>    
</tr>
<tr bordercolor="#FFFFFF"> 
     <td width="100" align="left" valign="top" class="cell" ><span class="greytxt14">Name</span><span class="redtxt"> *  </span>   </td>
    <td width="200" align="left" valign="top"><input name="txt_name1" type="text" id="txt_name1" /></td>    
</tr>

<tr bordercolor="#FFFFFF"> 
     <td width="50" align="left" valign="top" class="cell" ><span class="greytxt14">Phone</span>  </td>
    <td width="200" align="left" valign="top"><input name="txt_phone1" type="text" id="txt_phone1" /></td>    
</tr>
<tr bordercolor="#FFFFFF"> 
     <td width="50" align="left" valign="top" class="cell" ><input type="hidden" name="form_feedback1" value="1"><span class="greytxt14">Email id</span><span class="redtxt"> *  </span>  </td>
    <td width="200" align="left" valign="top"><input name="txt_email1" type="text" id="txt_email1" /></td>    
</tr>


<tr bordercolor="#FFFFFF"> 
     <td width="50" align="left" valign="top" class="cell" ><span class="greytxt14">Select Topic</span> <span class="redtxt"> *  </span> </td>
    <td width="50" align="left" valign="top"> <select name="select_question1" id="select_question1">
          <option value="---Select---">---Select---</option>
          <option value="Report a Bug"> Report a Bug </option>
		  <option value="Suggestions"> Suggestions </option>
          
          <option value="Feedback"> Feedback </option>	  
        </select></td>    
</tr>
<tr bordercolor="#FFFFFF"> 
     <td width="50" align="left" valign="top" class="cell" ><span class="greytxt14">Your Comments</span>  </td>
    <td width="200" align="left" valign="top"><textarea class= "txtarea"  name ="txt_comments" rows="3" cols="30" id = "txt_comments" ></textarea></td>    
</tr>
<tr > 
     <td width="50" align="left" valign="top" >  </td>
    <td width="200" align="center" valign="top"><input type="submit" class="btn" value="Submit"></td>    
</tr>
<tr > 
     <td width="50" height="10" align="left" valign="top" >  </td>
    <td width="200" align="center" valign="top"> </td>    
</tr>
<tr > 
     <td width="100" align="left" valign="top" >  </td>
    <td width="200" align="left" valign="top"><span class="greytxt12">Field marked in <span class="redtxt">*</span> are mandatory. </td>    
</tr>
<tr > 
     <td width="100" height="50" align="left" valign="top" >  </td>    
</tr>
<tr > 
     <td width="100" height="10" align="left" valign="top" >  </td> 
    <td width="200" align="left" valign="top"></td>    
</tr></table></form>

<div class="clear5"></div>




<?php include("footer.inc.php"); ?>

</body>
</html>
