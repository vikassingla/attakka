<?php
include "config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN " "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="stylesheet" href="css/style-fresh.css" type="text/css" media="screen" />
<title>ATTAKKA</title>
</head>

<body>

<div id="login-wrapper">
<a href = "index.php"><div align="center"><img src="images/logo-big.png" alt="#" /></div></a>
<div class="white-wrapper">
<div style="padding:15px;">


<?php
if (isset($_POST['Submit_x'])) {
$email=$_POST['email']; 
$password=$_POST['password'];

$enkriptovana_password=md5($password);

// To protect MySQL injection (more detail about MySQL injection)
$email = stripslashes($email);
$password = stripslashes($password);
$email = mysql_real_escape_string($email);
$password = mysql_real_escape_string($password);

$sql="SELECT * FROM member_info WHERE email='$email' and password='$enkriptovana_password'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row


if($count==1){
// Register session and redirect to file "login_success.php"
        while ($rows = mysql_fetch_assoc($result)){
			$id=$rows['id'];
			$name=$rows['name'];
			$surname=$rows['lastname'];
			$country=$rows['country'];
			$region=$rows['region'];
			$picture_path=$rows['picture_path'];
			
			}
		session_register("$email");
        session_register("$password");
        $_SESSION['email']= $email;
		$_SESSION['user_id']=$id;
		$_SESSION['is_open'] = True;
		$_SESSION['name']=$name;
		$_SESSION['surname']=$surname;
		$_SESSION['country']=$country;
		$_SESSION['region']=$region;
		$_SESSION['picture_path'] = $picture_path;
		
		include ('login_success.html');

}

if($count!=1){

	include "login_fail.html";

}
}
else{
?>

<form method="post" action="">

<div  class="form-panel form-text">Email :</div>
<div class="input-panel"><input name="email" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Email':this.value;" value="example@example.com" class="input" type="text"></div>
<div class="clear"></div>

<div  class="form-panel form-text">Password :</div>
<div class="input-panel"><input name="password" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Password':this.value;" value="Password" class="input" type="password"></div>
<div class="clear"></div>

<div class="form-panel"><img src="images/space.gif" alt="#" /></div>
<div class="input-panel">
<input name="Submit" id="submit_login" value="Log in" type="image" src="images/loginin-btrn.gif">
<div class="clear"></div>
</div>
</form>


<?php
}
// close connection 
mysql_close();
?>

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