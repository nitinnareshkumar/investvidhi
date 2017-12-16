<?php 
session_start();
require_once("../config/config.inc.php");

$name=$_SESSION['sess_f_name'];
$face_id=$_SESSION['sess_face_id'];
$username=$_SESSION['sess_face_username'];
$dob=$_SESSION['sess_face_birthday'];
$email=$_SESSION['sess_face_email'];
$location=$_SESSION['sess_face_location'];
$token=$_SESSION['sess_f_token'];

 $res=mysql_query("select * from tbl_user where face_id='".$face_id."' or (email='$email' and email!='')");
  if(mysql_num_rows($res))
  {
    $row=mysql_fetch_assoc($res);
	$uid=$row['id'];
	$name=$row['name'];
	if($username=='')
	$username=$face_id;
    $res=mysql_query("update tbl_user set token='$token',face_id='".$face_id."',user_name='$username',name='$name',location='$location',dob='$dob' where  id='".$uid."'");
    
  }
  else
  {
  $res=mysql_query("insert into tbl_user set token='$token',status=1,face_id='".$face_id."',user_name='$username',name='$name',location='$location',dob='$dob',email='$email',postdate=now()");
  $uid=mysql_insert_id();
  }
            $_SESSION['sess_uid']=$uid;
			$_SESSION['sess_username']=$username;	
			//$_SESSION['sess_email']=$li['email'];		
			//$_SESSION['class_id']=$lid['id'];<br>
$_SESSION['sess_f_name']='';
$_SESSION['sess_face_id']='';
$_SESSION['sess_face_username']='';
$_SESSION['sess_face_birthday']='';
$_SESSION['sess_face_email']='';
$_SESSION['sess_face_location']='';
$_SESSION['sess_f_token']='';
header("Location: ../index.php");
die();
			
?>