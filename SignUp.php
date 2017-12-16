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
if($_POST['form_signup']==1)
{

	extract($_POST);
	// check for email already
	if($_SESSION['security_code']!=$_POST['security_code'] || $_POST['security_code'] == ''){
	$errmsg = 'Incorrect image verification word.';
	}
	else
	{
	$res=mysql_query("select id from tbl_user where email='$txt_email'");
	if($rows=mysql_num_rows($res))
	{
		$errmsg="This email already exist for other user";
	}
	else
	{
		$next = "Myaccount.php";
		$today = date("Y-m-d h:i:s") ;
		$res=mysql_query("insert into tbl_user set name='$txt_name', city= '$txt_city', phone ='$txt_phone', email='$txt_email', password='$txt_pswd', knowledgelevel = '$select_question' , postdate ='$today'");
		$res12=mysql_query("select id from tbl_user where email='$txt_email'");
		$row=mysql_fetch_assoc($res12);
		extract($row);	
		$_SESSION['userid']=$row['id'];
		//echo $_SESSION['id'];
//		$id=mysql_insert_id();		
		$_SESSION['name']=$txt_name;
		$email=$txt_email;
		$password=$txt_pswd;
	    $to=$txt_email;
		$from_email="admin@pupone.com";
		$subject="pupone.com: Account Information";
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$from = "pupone <".$from_email."> \r\n";
		$mail_body = readmyfile("emails/member-registration.txt");
		//$mail_body = str_replace("<Name>", $row_select[4], $mail_body);
		$mail_body = str_replace("<Username>", $email, $mail_body);
		$mail_body = str_replace("<Password>", $password, $mail_body);
		mail($to,$subject,$mail_body,"From:$from");
		
		if($_REQUEST['back'])
		header("Location: $back");
		else
		header("Location: $next");
		die();
	}
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SignUp - add your account on pupone</title>
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
function validpwd(str)
{
		invalidChars = " "
		if (str == "") 
		{
			return (false);
		}
		for (i=0; i<invalidChars.length; i++) 
		{
			badChar = invalidChars.charAt(i)
			if (str.indexOf(badChar,0) != -1) 
			{
				return (false);
			}
		}
		return(true);
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

	if(trim(objfrm.txt_name.value)=='')	msg+='- Please enter name. \n';
		
	if(trim(objfrm.txt_phone.value)!='')
	{	 		
		if(validNum(objfrm.txt_phone.value)==false)
		{		
			msg+='- Please enter numeric phone number. \n';			
		}
	}		
	if(trim(objfrm.txt_email.value)=='')	msg+='- Please enter email address. \n';	
	else if(!validEmailAddress(trim(objfrm.txt_email.value)))
	{
		msg +=  "- Please enter valid email address.\n";		
	}	
	if(trim(objfrm.txt_pswd.value)=='')	msg+='- Please enter password. \n';	
	if(trim(objfrm.txt_pswd.value)!=trim(objfrm.txt_cnfrm_pswd.value))	msg+='- Both password need to be same. \n';
	if(trim(objfrm.select_question.value)=='---Select---')	msg+='- Please choose knowledge level. \n';	
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

<form action="SignUp.php" method="post" enctype="multipart/form-data" name="signupform"  onSubmit="return validate_form(this)" id="">


<table width="400" border="0" align="left" bordercolor="#333333" bgcolor="#FFFFFF">
<tr > 
     <td width="50" align="left" valign="top">  </td>
    <td width="200" align="left" valign="top"><span class="redtxt"><?=$errmsg?></span></td>    
</tr>
<tr bordercolor="#FFFFFF"> 
     <td width="100" align="left" valign="top" class="cell" ><span class="greytxt14">Name</span><span class="redtxt"> *  </span>   </td>
    <td width="200" align="left" valign="top"><input name="txt_name" type="text" id="txt_name" /></td>    
</tr>
<tr bordercolor="#FFFFFF"> 
     <td width="50" align="left" valign="top" class="cell" ><span class="greytxt14">City</span>  </td>
    <td width="200" align="left" valign="top"><input name="txt_city" type="text" id="txt_city" /></td>    
</tr>
<tr bordercolor="#FFFFFF"> 
     <td width="50" align="left" valign="top" class="cell" ><span class="greytxt14">Phone</span>  </td>
    <td width="200" align="left" valign="top"><input name="txt_phone" type="text" id="txt_phone" /></td>    
</tr>
<tr bordercolor="#FFFFFF"> 
     <td width="50" align="left" valign="top" class="cell" ><span class="greytxt14">Email id</span><span class="redtxt"> *  </span>  </td>
    <td width="200" align="left" valign="top"><input name="txt_email" type="text" id="txt_email" /></td>    
</tr>
<tr bordercolor="#FFFFFF"> 
     <td width="50" align="left" valign="top" class="cell" ><span class="greytxt14">Password</span> <span class="redtxt"> *  </span> </td>
    <td width="200" align="left" valign="top"><input type="hidden" name="form_signup" value="1"><input name="txt_pswd" type="password" id="txt_pswd" /></td>    
</tr>
<tr bordercolor="#FFFFFF"> 
     <td width="50" align="left" valign="top" class="cell" ><span class="greytxt14">Confirm Password</span> <span class="redtxt"> *  </span> </td>
    <td width="200" align="left" valign="top"><input name="txt_cnfrm_pswd" type="password" id="txt_cnfrm_pswd" /></td>    
</tr>
<tr bordercolor="#FFFFFF"> 
     <td width="50" align="left" valign="top" class="cell" ><span class="greytxt14">Investment Knowledge Level</span> <span class="redtxt"> *  </span> </td>
    <td width="50" align="left" valign="top"> <select name="select_question" id="select_question">
          <option value="---Select---">---Select---</option>
          <option value="B"> Beginner </option>
		  <option value="I"> Intermediate </option>
		  <option value="E"> Expert </option>		  
        </select></td>    
</tr>
<tr bordercolor="#FFFFFF"> 
     <td width="50" align="left" valign="top" class="cell" ><span class="greytxt14">Secuirty Code</span> <span class="redtxt"> *  </span> </td>
    <td width="200" align="left" valign="top"><img src="CaptchaSecurityImages.php" style="border:1px solid #000; " /><br><input type="text" name="security_code"  size="35" class="txtfld"  /></td>    
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
</tr></table></form>

<div class="clear12"></div>




<?php include("footer.inc.php"); ?>

</body>
</html>
