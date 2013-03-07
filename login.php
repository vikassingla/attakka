<?
include("config.php");
session_start();
error_reporting(0);
if($_GET['rpage'])
{
	@$rpage=$_GET['rpage'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<title>ATTAKKA -Login</title>
<link rel="stylesheet" href="css/style-fresh.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="js/gen_validatorv4.js" language="JavaScript"></script>
<div id="fb-root"></div>
  <script>
 window.fbAsyncInit = function() {
FB.init({ appId: '322558347843656', 
status: true, 
cookie: true,
xfbml: true,
oauth: true});

function updateButton(response) 
{
	var button = document.getElementById('fb-auth');
	var rpage_val=document.getElementById('rpage').value;
	//user is not connected to your app or logged out
	button.onclick = function() {
	FB.login(function(response) {
	if (response.authResponse) 
	{
		FB.api('/me', function(response) {
		var uid=response.id;
		var fname=response.first_name;
		var lname=response.last_name;
		var email=response.email;
		
		var formdata="uid="+uid+"&firstname="+fname+"&lastname="+lname+"&uemail="+email+"&rpage="+rpage_val;
		//alert(formdata);return false;
		window.location="main.php?"+formdata;
		});	
	} 
	else
	 {
	window.location.reload();
	}
	}, {scope:'email'}); 
	}
}

// run once with current status and whenever the status changes
FB.getLoginStatus(updateButton);
FB.Event.subscribe('auth.statusChange', updateButton);	
};

(function() {
var e = document.createElement('script'); e.async = true;
e.src = document.location.protocol 
+ '//connect.facebook.net/en_US/all.js';
document.getElementById('fb-root').appendChild(e);
}());

 </script>
	<script type="text/javascript">
function emptyfield(divid)
{
//alert(divid);
document.getElementById(divid).innerHTML = '';
}
	</script>
		<script>
function closepopup(id)
{
	document.getElementById(id).style.display="none";
}	
</script>
<script type="text/javascript"> 
     
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
				function rand_str($len = 6, $chars = 'abcdefghijklmnopqrstuvwxyz0123456789')
				{
				   $num_chars = strlen($chars);
				   $ret = '';
				   for($i = 0; $i < $len; ++$i)
				   {
					  $ret .= $chars[mt_rand(0, $num_chars)];
				   }
				   return $ret;
				}
				if (isset($_GET['email']))
					{
						$email=$_GET['email'];
					}
					if (isset($_GET['msg1'])=='accexist')
					{	
						$msg='Currently your account is not active. Check your email for the activation link or<br/>
						<a href="main.php?email='.$email.'&ac='.rand_str().'">Resend activation link</a>';
						echo '<div class="white-wrapper-error" style="margin-left:15px;width:554px" id="closemsg">'.$msg.'</div>
						';
						echo '<script>setTimeout("document.getElementById(\'closemsg\').style.display=\'none\';",4000);</script>';
					}
					else if (isset($_GET['msg2'])=='loginFail')
					{	
						$msg='Either email or password is wrong.<a href="javascript:void(0)" onclick=closepopup("closemsg1")><img src="images/cancel1.png" style=" float: right; margin-right: 8px; margin-top: 3px;"></a>';
						echo '<div class="white-wrapper-error" id="closemsg1">'.$msg.'</div>';
						echo '<script>setTimeout("document.getElementById(\'closemsg1\').style.display=\'none\';",4000);</script>';
					}
					else if (isset($_GET['msg3'])=='plzlogin')
					{	
						$msg='Please login to continue.<a href="javascript:void(0)" onclick=closepopup("closemsg2")><img src="images/cancel1.png" style=" float: right; margin-right: 8px; margin-top: 3px;"></a>';
						echo '<div class="white-wrapper-error" id="closemsg2" >'.$msg.'</div>
						';
						echo '<script>setTimeout("document.getElementById(\'closemsg2\').style.display=\'none\';",4000);</script>';
					}
					else if (isset($_GET['msg'])=='chkacl')
					{	
						$msg='Please click on activation link in your email for Login.<a href="javascript:void(0)" onclick=closepopup("closemsg3")><img src="images/cancel1.png" style=" float: right; margin-right: 8px; margin-top: 3px;"></a>';
						echo '<div class="white-wrapper-error" id="closemsg3">'.$msg.'</div>';
						echo '<script>setTimeout("document.getElementById(\'closemsg3\').style.display=\'none\';",4000);</script>';
					}
					if (isset($_GET['actc']))
					{
						$activation_code=$_GET['actc'];
						$msg='Please login to activate your account. <a href="javascript:void(0)" onclick=closepopup("closemsg4")><img src="images/cancel1.png"></a>';
						echo '<div class="white-wrapper-error" id="closemsg4">'.$msg.'</div>';
						echo '<script>setTimeout("document.getElementById(\'closemsg4\').style.display=\'none\';",4000);</script>';
					}
					
				?>	
	<div class="white-wrapper">
		<div style="padding:15px;">
			<div class="red-color-heading"><span>LOGIN</span></div>
			<div class="clear"></div>
			<form name="form1" id="form1" action="main.php" method="POST">
				<input type="hidden" name="rpage" id="rpage" value="<?php echo @$rpage?>">
				<input type="hidden" name="activation_code" value="<?php echo @$activation_code?>">
				<div style="float:left;height:50px;">
					<div  class="form-panel form-text">Email Id :</div>
					<div class="input-panel"><input name="useremail" id="useremail" type="text"  class="validate[required,custom[onlyLetterNumber],maxSize[20],ajax[ajaxUserCallPhp]] input" style="width:350px;" onkeyup="emptyfield('form1_useremail_errorloc')" onkeydown="emptyfield('form1_useremail_errorloc')" />
						<div class="error" id="form1_useremail_errorloc" style="visibility:hidden;">Please enter valid Password</div>
				</div>
				</div>
				<div style="float:left;height:50px;">
				<div  class="form-panel form-text">Password :</div>
				<div class="input-panel">
				<input name="userpassword" id="userpassword" type="password" class="input" style="width:350px;" onkeyup="emptyfield('form1_userpassword_errorloc')" onkeydown="emptyfield('form1_userpassword_errorloc')"/>

				<div class="error" id="form1_userpassword_errorloc" style="visibility:hidden;">Please enter valid Password</div>
				</div>
				</div>
				<div  class="form-panel form-text" style="float:left;width:100px;margin-left:42%;">
				<a href="forget_password.php">Forgot Password</a></div><span class="form-panel form-text" style="float:left;width:1px;margin-right:10px;">|</span><div  class="form-panel form-text" style="float:right;width:144px;margin-right:25px"> New User? <a href="register.php">Register</a> Here
				</div>

		<div class="form-panel"><img src="images/space.gif" alt="#" /></div>
		<div class="input-panel">

		<input name="login" type="submit" class="submit-buttons-round" value="login" style="margin-left:80px">
		</div>
		
		<div class="clear"></div>
	
		</form>
			  <div class="" style="width:400px;">
                     <img src="images/or2.png"  style="margin-top:20px; margin-left:18px;"/>
                     <div class="clear"></div>
                     <div style="margin-left:200px;">
		<button id="fb-auth" style="margin-top:20px;background:none repeat-x scroll 0 0 transparent;border:none;width:160px;cursor:pointer;" >
						<img alt="" src="images/facebook-login.png" style="margin-left:0px;" />
						</button>
						</div>
						</div>
	</div>
</div>
<?php include("footer.php")?>

<script language="javascript" type="text/javascript">
var frmvalidator  = new Validator("form1");
frmvalidator.EnableOnPageErrorDisplay();
frmvalidator.EnableMsgsTogether();
frmvalidator.addValidation("useremail","req","Please enter your Email");
frmvalidator.addValidation("useremail","email", "Please enter valid Email");
frmvalidator.addValidation("useremail","maxlen=250", "Maximum length for Email is 50");

frmvalidator.addValidation("userpassword","req","Please enter your Password");
frmvalidator.addValidation("userpassword","minlen=6", "Minimum length for Password is 6");
frmvalidator.addValidation("userpassword","maxlen=20", "Maximum length for Password is 20");

</script>

