<?php
session_start();
session_destroy();

header("Refresh: 3; url=index.php");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<title>ATTAKKA</title>

<link rel="stylesheet" href="css/style-fresh.css" type="text/css" media="screen" />

</head>


<body>

<div id="login-wrapper">
<div align="center"><img src="images/logo-big.png" alt="#" /></div>
<div class="white-wrapper">
<div style="padding:15px;">

<div class='red-color-heading'>You have <span class='black-color-heading'>logged out</span></div>
<a href='index.php'>Back to Start</a>



</div>
<div class="clear"></div>
</div>
<div class="footer-panel-left-login">
<div class="footer-text"><a href="index.php" class="footer-text">Home</a> &nbsp;|&nbsp; <a href="about-us.html" class="footer-text">About Us</a> &nbsp;|&nbsp; <a href="terms-conditions.html" class="footer-text">Terms &amp; Conditions</a> &nbsp;|&nbsp; <a href="login.php" class="footer-text" >Login</a> &nbsp;|&nbsp;     Register</div>
<div class="footer-text">© 2012 Attakka, All rights reserved.</div>

</div>
<div class="footer-panel-right"><a href="#"><img src="images/facebook-icon.png" alt="#" border="0" /></a> <a href="#"><img src="images/twitter-icon.png" alt="#" border="0" /></a> <a href="#"><img src="images/gplus-icon.png" alt="#"  border="0"/></a></div>
</div>
</body>
</html>