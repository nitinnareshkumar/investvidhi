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

if($_POST['form_login']==1)
{
	extract($_POST);
	$next = "index.php";
	// check for email already
		$res=mysql_query("select * from tbl_user where email='$txt_email' ");	
	if($rows=mysql_num_rows($res))
	{	
		$row=mysql_fetch_assoc($res);
		extract($row);	
		if($txt_email!='')
		{
		$passwd = $row['password'];
		$userId = $row['email'];
		$email=$userId;
		$password=$passwd;
	    $to=$email;
		$from_email="admin@pupone.com";
		$subject="pupone.com: Account Information";
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$from = "pupone <".$from_email."> \r\n";
		$mail_body = readmyfile("emails/forgot -password.txt");
		//$mail_body = str_replace("<Name>", $row_select[4], $mail_body);
		$mail_body = str_replace("<Username>", $email, $mail_body);
		$mail_body = str_replace("<Password>", $password, $mail_body);
		mail($to,$subject,$mail_body,"From:$from");
			//$_SESSION['sess_email']=$txt_email;
			//$_SESSION['userid']=$row['id'];
			$errmsg="We have send password information to your registered email id";				
		}
			//header("Location: $next");

	}
	else
	{
	$errmsg="Invalid Email id";	
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Forgot Password</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
include("header.inc.php");
?>
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

function validate_form(objfrm)
{
	msg="Sorry, we cannot complete your request.\nKindly provide us the missing or incorrect information enclosed below.\n\n";
	var emailFlag="";
	var pwdFlag="";
	if(trim(objfrm.txt_email.value)=='')	msg+='- Please enter email address. \n';	
	else if(!validEmailAddress(trim(objfrm.txt_email.value)))
	{
		msg +=  "- Please enter valid email address.\n";		
	}	
			
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

<div class="clear12"></div>
<div align="center">

<form action="ForgotPassword.php" method="post" enctype="multipart/form-data" name="loginform"  onSubmit="return validate_form(this)" id="">


<table width="250" border="0" align="left" bordercolor="#333333" bgcolor="#FFFFFF">
<tr > 
     <td width="50" align="left" valign="top">  </td>
    <td width="200" align="left" valign="top"><?=$errmsg?></td>    
</tr>

<tr bordercolor="#FFFFFF"> 
     <td width="50" align="left" valign="top" class="cell" ><span class="greytxt14">Email</span>  </td>
    <td width="200" align="left" valign="top"><input type="hidden" name=form_login value="1"><input name="txt_email" type="text" id="txt_email" /></td>    
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
     <td width="50" align="left" valign="top" >  </td>
    <td width="200" align="center" valign="top"><span class="greytxt12">Enter your email , we will send password to your mail id    </span>  </td>    
</tr>
</table></form>

<div class="clear12"></div>



<?php include("footer.inc.php"); ?>

</body>
</html>
