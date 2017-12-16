<?php
include("config/config.inc.php");

session_destroy();
if($logoutUrl)
header("location: $logoutUrl");
else
header("location: index.php");
exit();
?>