<?php
session_start();
# We require the library
require("facebook.php");


# Creating the facebook object
$facebook = new Facebook(array(
    'appId'  => '254837444627266',
    'secret' => '3240e1ce52dd440aa2e653c090ddfe45',
    'cookie' => true
));

# Let's see if we have an active session
$session = $facebook->getSession();

if(!empty($session)) {
    # Active session, let's try getting the user id (getUser()) and user info (api->('/me'))
    try{
        $uid = $facebook->getUser();
		$access_token = $facebook->getAccessToken();
        $user = $facebook->api('/me');
    } catch (Exception $e){}

    if(!empty($user)){
	   
	   $likes = $facebook->api("/me/likes/424361200923395");
	   
	   if( !empty($likes['data']))
	{
	    $_SESSION['sess_user_already_liked']=1;
		}
	   
        # User info ok? Let's print it (Here we will be adding the login and registering routines)
		 $_SESSION['sess_f_token']=$access_token;
       $_SESSION['sess_f_name']=$user['name'];
	   $_SESSION['sess_face_id']=$user['id'];
	   $_SESSION['sess_face_username']=$user['username'];
	   list($m,$d,$y)=explode("/",$user['birthday']);
	   $_SESSION['sess_face_birthday']=$y."-".$m."-".$d;
		   $_SESSION['sess_face_email']=$user['email'];
		   if($user['hometown']['name'])
			$_SESSION['sess_face_location']=$user['hometown']['name'];
			else
			$_SESSION['sess_face_location']=$user['location']['name'];
	 /*  $res=mysql_query("select * from tbl_user where twit_id='".$face_id."'");
  if(mysql_num_rows($res))
  {
    $row=mysql_fetch_assoc($res);
	$uid=$row['id'];
	$name=$row['name'];
    $res=mysql_query("update tbl_user set twit_sname='$username' where  id='".$uid."'");
    
  }
  else
  {
  $res=mysql_query("insert into tbl_user set status=1,twit_id='".$face_id."',twit_sname='$username',name='$name',post_date=curdate()");
  $uid=mysql_insert_id();
  }
            $_SESSION['sess_uid']=$uid;
			$_SESSION['sess_username']=$name;	
			//$_SESSION['sess_email']=$li['email'];		
			//$_SESSION['class_id']=$lid['id'];*/

 ?>
 <script language="javascript">location.href='test.php'</script>
 <?
    } else {
        # For testing purposes, if there was an error, let's kill the script
      // die();
	$login_url = $facebook->getLoginUrl();
  header("Location: ".$login_url."&req_perms=user_birthday,user_location,email&method=permissions.request");
   //  $logoutUrl = $facebook->getLogoutUrl();
 //  header("Location: $logoutUrl");
    }
} else {
    # There's no active session, let's generate one
    $login_url = $facebook->getLoginUrl();
    header("Location: ".$login_url."&req_perms=user_birthday,user_location,email&method=permissions.request");
}

?>