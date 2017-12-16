<?
include_once "fb/fbconnect.php";
?><div id="wraper">
<div id="header">
<div class="logo-box">P/<span>E</span><a href="index.php" ><img src="images/logo.png"  width="100" height="80" border="0" align="bottom"></a></div>
<div class="right-box">
<div class="headlink"><iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fpupone.com&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=false&amp;font=arial&amp;colorscheme=light&amp;action=like&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe></div>
<div class="subhead">Find, Analyse & Select the best company for your investment</div>
</div>
</div>
<div class="right-box-links"><a href="index.php">Home</a> | <?php if($_SESSION['userid'] !=""){?> <a href="Myaccount.php">Myaccount</a> | <a href="logout.php">Logout</a><? } else {?><a href="login.php">Login   </a> <span class="greytxt12"> OR </span>   <a href="<?php echo $loginUrl ?>"><img border="0" src="images/face.jpg" alt=""></a><? } ?></div>