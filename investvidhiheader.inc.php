<div id="wraper">
<div id="header">
<div class="logo-box">Invest<span>Vidhi</span></div>
<div class="right-box">
<div class="headlink"></div>
<div class="subhead">Find, Analyse & Select the best company for your investment</div>
</div>
</div>
<div class="right-box-links"><?php if($_SESSION['userid'] !=""){?> <a href="Myaccount.php">Myaccount</a> | <a href="logout.php">Logout</a><? } else {?><a href="login.php">Login   </a> <span class="greytxt12"> OR </span>   <a href="facebook/login_facebook.php"><img border="0" src="images/face.jpg" alt=""></a><? } ?></div>