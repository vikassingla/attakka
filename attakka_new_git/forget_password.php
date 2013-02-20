<?
include("config.php");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<title>ATTAKKA -Forgot Password</title>
<link rel="stylesheet" href="css/style-fresh.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="front-end/images/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="js/gen_validatorv4.js" language="JavaScript"></script>
	<script type="text/javascript">
function emptyfield(divid)
{
//alert(divid);
document.getElementById(divid).innerHTML = '';
}
	</script>
	<style type="text/css">
	.form-text a
	{
		color:#CB0505;
		text-decoration:underline;
	}		
	.form-text a:hover
	{
		color:#CB0505;
		text-decoration:none;
	}	
	</style>
</head>
<body>
<div id="login-wrapper">
<div align="center"><a href="index.php"><img src="images/logo-big.png" alt="" /></a></div>
      <?php
      if(isset($_GET['msg']) && $_GET['msg'] == 'forSucc')
{
	$message='Your account information has been sent to your email.';
	echo '<div class="white-wrapper-error" style="width:500px;margin-left:50px;">'.$message.'</div>';
}	
if(isset($_GET['msg']) && $_GET['msg'] == 'forFail')
{
	$message1='Your email does not exist. Please give right email.';
	echo '<div class="white-wrapper-error" style="width:500px;margin-left:50px;">'.$message1.'</div>';
}	?>
	<div class="white-wrapper">
		<div style="padding:15px;">
			<div class="red-color-heading"><span>FORGOT PASSWORD</span></div>
			<div class="clear"></div>
			<form name="form1" id="form1" action="main.php" method="POST">

				<div  class="form-panel form-text">Email Id :</div>
				<div class="input-panel"><input name="useremail" id="useremail" type="text" class="input" style="width:350px;" onkeyup="emptyfield('form1_useremail_errorloc')" onkeydown="emptyfield('form1_useremail_errorloc')" />
					<div class="error" id="form1_useremail_errorloc" style="visibility:hidden;">Please enter valid Password</div>
				</div>

		</div>


		<div class="form-panel"><img src="images/space.gif" alt="#" /></div>
		<div class="input-panel">

		<input name="forgot_password" type="submit" class="submit-buttons-round" value="Submit" style="margin-left:80px">
		</div>
		<div class="clear"></div>
		</form>
	</div>
  

<?php include("footer.php")?>
</html>
<script language="javascript" type="text/javascript">
var frmvalidator  = new Validator("form1");
frmvalidator.EnableOnPageErrorDisplay();
frmvalidator.EnableMsgsTogether();
frmvalidator.addValidation("useremail","req","Please enter your Email");
frmvalidator.addValidation("useremail","email", "Please enter valid Email");
frmvalidator.addValidation("useremail","maxlen=250", "Maximum length for Email is 50");
</script>

