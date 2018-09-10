<div id="wraper">
<div id="header">
<div class="logo-box">Invest<span>Vidhi</span><a href="index.php" ></a></div>
<div class="right-box">
<div class="headlink"></div>
<div class="subhead">Let's Learn Focus Investing</div>
</div>
</div>
<?php $_SESSION['userid']=""?>
<div class="right-box-links"><a href="index.php">Home</a> | <?php if($_SESSION['userid'] !=""){ ?> <a href="Myaccount.php">Myaccount</a> | <a href="logout.php">Logout</a><?php } else { ?> <a href="login.php">Login   </a> <span class="greytxt12">  </span>  <?php } ?> </div>