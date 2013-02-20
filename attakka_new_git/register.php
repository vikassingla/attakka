<?
include("config.php");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<title>ATTAKKA -Register</title>
<link rel="stylesheet" href="css/style-fresh.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/gen_validatorv4.js" language="JavaScript"></script>
<script type="text/javascript" src="js/jquery-pack.js"></script>
<script type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>
<script type="text/javascript" src="js/jquery.ocupload-packed.js"></script>
	<script type="text/javascript">
function emptyfield(divid)
{
//alert(divid);
document.getElementById(divid).innerHTML = '';
}
function checkbox(obj)
{
if(obj.checked)
{
	document.getElementById("form1_terms_errorloc").innerHTML="";
}
else
{
	document.getElementById("form1_terms_errorloc").innerHTML="Please agree Terms and Condition";
}		
}

	</script>
</head>
<body>
<div id="login-wrapper">
	<div align="center"><a href="index.php"><img src="images/logo-big.png" alt="#" /></a></div>
	<?php
	if (isset($_GET['msg'])=='signUpFail')
					{	
						$msg='This email already exist. Please use another email';
						echo '<div class="white-wrapper-error" style="margin-left:15px;width:554px">'.$msg.'</div>';
					}
				?>	
	<div class="white-wrapper">
		<div style="padding:15px;">
			<div class="red-color-heading"><span>REGISTER</span></div>
			<div class="clear"></div>
			<form name="form1" id="form1" action="main.php" method="POST">
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
			?>						
			<input type="hidden" name="activation_code" value="<?php echo rand_str();?>">
			<div style="float:left;height:55px;">
				<div  class="form-panel form-text">First Name:</div>
				<div class="input-panel">
					<input name="userfirstname" id="userfirstname" type="text" class="input" style="width:360px;" onkeyup="emptyfield('form1_userfirstname_errorloc')" onkeydown="emptyfield('form1_userfirstname_errorloc')"/>
					<div class="error" id="form1_userfirstname_errorloc" style="visibility:hidden;">Please enter valid Password
					</div>
				</div>
			</div>	
			
			<div style="float:left;height:55px;">
				<div  class="form-panel form-text">Last Name:</div>
				<div class="input-panel">
					<input name="userlastname" id="userlastname" type="text" class="input" style="width:360px;" onkeyup="emptyfield('form1_userlastname_errorloc')" onkeydown="emptyfield('form1_userlastname_errorloc')"/>
					<div class="error" id="form1_userlastname_errorloc" style="visibility:hidden;">Please enter valid Password
					</div>
				</div>	
			</div>
			
			<div style="float:left;height:55px;">
				<div  class="form-panel form-text">Password :</div>
				<div class="input-panel">
					<input name="userpassword" id="userpassword" type="password" class="input" style="width:360px;" onkeyup="emptyfield('form1_userpassword_errorloc')" onkeydown="emptyfield('form1_userpassword_errorloc')" />
					<div class="error" id="form1_userpassword_errorloc" style="visibility:hidden;">Please enter valid Password</div>
				</div>
			</div>
			
			<div style="float:left;height:55px;">
				<div  class="form-panel form-text">Confirm Password :</div>
				<div class="input-panel">
					<input name="confpassword" id="confpassword" type="password" class="input" style="width:360px;" onkeyup="emptyfield('form1_confpassword_errorloc')" onkeydown="emptyfield('form1_confpassword_errorloc')"/>
					<div class="error" id="form1_confpassword_errorloc" style="visibility:hidden;">Please enter valid Password</div>
				</div>
			</div>

			<div style="float:left;height:55px;">
				<div  class="form-panel form-text">Email Id :</div>
				<div class="input-panel">
					<input name="useremail" id="useremail" type="text" class="input" style="width:360px;" onkeyup="emptyfield('form1_useremail_errorloc')" onkeydown="emptyfield('form1_useremail_errorloc')"/>
					<div class="error" id="form1_useremail_errorloc" style="visibility:hidden;">Please enter valid Password</div>
				</div>
			</div>
			
			<div style="float:left;height:55px;">
				<div  class="form-panel form-text">Country :</div>
				<div class="input-panel">
					<input name="country" id="country" type="text" class="input" style="width:360px;" value="" onkeyup="emptyfield('form1_country_errorloc')" onkeydown="emptyfield('form1_country_errorloc')"/>
					<div class="error" id="form1_country_errorloc" style="visibility:hidden;">Please enter valid Password</div>
				</div>
			</div>
			
			<div style="float:left;height:55px;">
				<div  class="form-panel form-text">Region :</div>
				<div class="input-panel">
					<input name="region" type="text" id="region" class="input" style="width:360px;" value="" onkeyup="emptyfield('form1_region_errorloc')" onkeydown="emptyfield('form1_region_errorloc')"/>
					<div class="error" id="form1_region_errorloc" style="visibility:hidden;">Please enter valid Password</div>
				</div>
			</div>
			
			<div style="float:left;height:55px;">
				<div class="form-panel"><img src="images/space.gif" alt="#" /></div>
				<div class="input-panel blue-text">
					<input name="terms" id="terms" type="checkbox" value="" onclick="checkbox(this);"/> I agree to the <u><a href="terms-conditions.html" class="blue-text">Terms & Conditions</a></u> 
					<div class="error" id="form1_terms_errorloc" style="visibility:hidden;">Please enter valid Password</div>
				</div>
			</div>

			<div class="form-panel"><img src="images/space.gif" alt="#" /></div>
			<div class="input-panel">
				<input name="signup" type="submit" class="submit-buttons-round" value="Register">
			</div>
			</form>

			<div class="clear"></div>
		</div>
	</div>
<?php include("footer.php")?>

<script language="javascript" type="text/javascript">
var frmvalidator  = new Validator("form1");
frmvalidator.EnableOnPageErrorDisplay();
frmvalidator.EnableMsgsTogether();

frmvalidator.addValidation("userfirstname","req","Please enter your First Name");
frmvalidator.addValidation("userfirstname","alpha_s", "Please enter alphabet only");
frmvalidator.addValidation("userfirstname","maxlen=50", "Max length for First Name is 50");

frmvalidator.addValidation("userlastname","req","Please enter your Last Name");
frmvalidator.addValidation("userlastname","alpha_s", "Please enter alphabet only");
frmvalidator.addValidation("userlastname","maxlen=50", "Max length for Last Name is 50");

frmvalidator.addValidation("userpassword","req","Please enter your Password");
frmvalidator.addValidation("userpassword","minlen=6", "Minimum length for Password is 6");
frmvalidator.addValidation("userpassword","maxlen=20", "Maximum length for Password is 20");

frmvalidator.addValidation("confpassword","req","Please enter Confirm Password");
frmvalidator.addValidation("confpassword","eqelmnt=userpassword","The confirm password is not same as password");

frmvalidator.addValidation("useremail","req","Please enter your Email");
frmvalidator.addValidation("useremail","email", "Please enter valid Email");
frmvalidator.addValidation("useremail","maxlen=250", "Maximum length for Email is 50");

frmvalidator.addValidation("country","req","Please enter your Country");
frmvalidator.addValidation("country","alpha_s", "Please enter alphabet only");
frmvalidator.addValidation("country","maxlen=50", "Maximum length for Country is 50");

frmvalidator.addValidation("region","req","Please enter your Region");
frmvalidator.addValidation("region","alpha_s", "Please enter alphabet only");
frmvalidator.addValidation("region","maxlen=50", "Maximum length for Region is 50");

frmvalidator.addValidation("terms","selmin=1","Please agree Terms and Condition");
</script>

