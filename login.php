<?php
include("config/config.inc.php");
$errmsg = '';
$m = isset($_POST['form_login']) ? $_POST['form_login'] : null;
if($m!= null && $m==1)
{
	extract($_POST);
	$next = "Myaccount.php";
	// check for email already
		$res=mysqli_query($link,"select * from tbl_user where email='$txt_email' and password='$txt_pswd' ");	
	if($rows=mysqli_num_rows($res))
	{	
		$row=mysqli_fetch_assoc($res);
		extract($row);	
		if($txt_email!='')
		{
			$_SESSION['sess_email']=$txt_email;
			$_SESSION['userid']=$row['id'];				
		}
			header("Location: $next");

	}
	else
	{
	$errmsg="Incorrect Information";	
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Login</title>
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
	if(trim(objfrm.txt_pswd.value)=='')	msg+='- Please enter password. \n';	
			
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

<form action="login.php" method="post" enctype="multipart/form-data" name="loginform"  onSubmit="return validate_form(this)" id="">


<table width="250" border="0" align="left" bordercolor="#333333" bgcolor="#FFFFFF">
<tr > 
     <td width="50" align="left" valign="top">  </td>
    <td width="200" align="left" valign="top"><?=$errmsg ?></td>    
</tr>
<tr bordercolor="#FFFFFF"> 
     <td width="50" align="left" valign="top" class="cell" ><span class="greytxt14">Email</span>  </td>
    <td width="200" align="left" valign="top"><input name="txt_email" type="text" id="txt_email" /></td>    
</tr>
<tr bordercolor="#FFFFFF"> 
     <td width="50" align="left" valign="top" class="cell" ><span class="greytxt14">Password</span>  </td>
    <td width="200" align="left" valign="top"><input type="hidden" name=form_login value="1"><input name="txt_pswd" type="password" id="txt_pswd" /></td>    
</tr><tr > 
     <td width="50" align="left" valign="top" >  </td>
    <td width="200" align="center" valign="top"><input type="submit" class="btn" value="Submit"></td>    
</tr>
<tr > 
     <td width="50" height="10" align="left" valign="top" >  </td>
    <td width="200" align="center" valign="top"> </td>    
</tr>
<tr > 
     <td width="50" align="left" valign="top" >  </td>
    <td width="200" align="center" valign="top"><span class="greytxt12">New user     </span>  <a href="SignUp.php">click here</a> <br><br> <span class="greytxt12">Forgot Password     </span>  <a href="ForgotPassword.php">click here</a> </td>    
</tr></table></form>

<div class="clear12"></div>



<?php include("footer.inc.php"); ?>

</body>
</html>
