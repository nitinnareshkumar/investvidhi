<?php
if(!isset($_SESSION['user']))
{
	//Application Configurations
	$app_id		= "254837444627266";
	$app_secret	= "3240e1ce52dd440aa2e653c090ddfe45";
	$site_url	= "http://pupone.com/";

	try{
		include_once "src/facebook.php";
	}catch(Exception $e){
		error_log($e);
	}
	// Create our application instance
	$facebook = new Facebook(array(
		'appId'		=> $app_id,
		'secret'	=> $app_secret,
		));

	// Get User ID
	$user = $facebook->getUser();
	// We may or may not have this data based 
	// on whether the user is logged in.
	// If we have a $user id here, it means we know 
	// the user is logged into
	// Facebook, but we don’t know if the access token is valid. An access
	// token is invalid if the user logged out of Facebook.
	//print_r($user);
	if($user){
		// Get logout URL
		$logoutUrl = $facebook->getLogoutUrl();
	}else{
		// Get login URL  // 'read_stream, publish_stream, email, user_about_me',
		$loginUrl = $facebook->getLoginUrl(array(
			'scope'			=> 'read_stream,  email',
			'redirect_uri'	=> $site_url,
			));
	}

	if($user){

		try{
		// Proceed knowing you have a logged in user who's authenticated.
		$user = $facebook->api('/me');
		
		$name=$user['name'];
		$face_id=$user['id'];
		$username=$user['username'];
		 list($m,$d,$y)=explode("/",$user['birthday']);
		$dob=$y."-".$m."-".$d;
		$email=$user['email'];
		 if($user['hometown']['name'])
		$location=$user['hometown']['name'];
		else
		$location=$user['location']['name'];
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
		  
		    $_SESSION['userid']=$uid;
			 $_SESSION['sess_uid']=$uid;
			$_SESSION['sess_username']=$username;	
		
		}catch(FacebookApiException $e){
				error_log($e);
				$user = NULL;
			}
		
	}
}
?>