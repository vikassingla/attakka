<?
include("header.php");
$sql="select user_firstname, user_lastname, user_pass, user_email, user_country, user_region from tbl_user where user_id=".$_SESSION['user_id'];
//echo $sql;
$rs=mysql_query($sql);
$row=mysql_fetch_array($rs);
?>
<link href="scripts/jQuery-Impromptu/jquery-impromptu.css" rel="stylesheet" type="text/css" />
		<link href="scripts/fineuploader/fineuploader.css" rel="stylesheet" type="text/css" />
		<link href="scripts/Jcrop/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="scripts/jQuery-Impromptu/jquery-impromptu.js"></script>
		<script type="text/javascript" src="scripts/fineuploader/jquery.fineuploader-3.0.min.js"></script>
		<script type="text/javascript" src="scripts/Jcrop/jquery.Jcrop.min.js"></script>
		<script type="text/javascript" src="scripts/jquery-uberuploadcropper.js"></script>

<script type="text/javascript">
			$(function() {
				
				$('#UploadImages').uberuploadcropper({
					//---------------------------------------------------
					// uploadify options..
					//---------------------------------------------------
					fineuploader: {
						//debug : true,
						request	: { 
							// params: {}
							endpoint: 'upload.php' 
						},						
						validation: {
							//sizeLimit	: 0,
							allowedExtensions: ['jpg','jpeg','png','gif']
						}
					},
					//---------------------------------------------------
					//now the cropper options..
					//---------------------------------------------------
					jcrop: {
						aspectRatio  : 1, 
						allowSelect  : true, //can reselect
						allowResize  : true,  //can resize selection
						setSelect    : [ 0, 0, 200, 200 ], //these are the dimensions of the crop box x1,y1,x2,y2
						minSize      : [ 200, 200 ], //if you want to be able to resize, use these
						maxSize      : [ 500, 500 ]
					},
					//---------------------------------------------------
					//now the uber options..
					//---------------------------------------------------
					folder           : 'uploads/', // only used in uber, not passed to server
					cropAction       : 'crop.php', // server side request to crop image
					onComplete       : function(e,imgs,data){ 
						var $PhotoPrevs = $('#PhotoPrevs');
						var name="";
						for(var i=0,l=imgs.length; i<l; i++){
							
							name=imgs[i].filename+","+name;
							//alert(imgs[i].filename);
							$PhotoPrevs.append('<img style="height:100px;" src="uploads/'+ imgs[i].filename +'?d='+ (new Date()).getTime() +'" />&nbsp;&nbsp;<input type="hidden" name="account_image" value="'+name+'">');
							
						}
					}
				});
				
			});
		</script>
<div id="login-wrapper" style="padding-top:100px;">
	<!--<div align="center"><a href="index.php"><img src="images/logo-big.png" alt="#" /></a></div>-->
	<div class="white-wrapper">
		<div style="padding:15px;">
			<div class="red-color-heading">EDIT
				<span class="black-color-heading">USER PROFILE DETAIL</span>
			</div>
			<div class="clear"></div>
			<form name="form1" id="form1" action="main.php" method="POST">
			<div style="float:left;height:55px;">
				<div  class="form-panel form-text">First Name:</div>
				<div class="input-panel">
					<input name="userfirstname" id="userfirstname" type="text" class="input" style="width:360px;" onkeyup="emptyfield('form1_userfirstname_errorloc')" onkeydown="emptyfield('form1_userfirstname_errorloc')" value="<?php echo $row['user_firstname']?>"/>
					<div class="error" id="form1_userfirstname_errorloc" style="visibility:hidden;">Please enter valid Password
					</div>
				</div>
			</div>	
			
			<div style="float:left;height:55px;">
				<div  class="form-panel form-text">Last Name:</div>
				<div class="input-panel">
					<input name="userlastname" id="userlastname" type="text" class="input" style="width:360px;" onkeyup="emptyfield('form1_userlastname_errorloc')" onkeydown="emptyfield('form1_userlastname_errorloc')" value="<?php echo $row['user_lastname']?>"/>
					<div class="error" id="form1_userlastname_errorloc" style="visibility:hidden;">Please enter valid Password
					</div>
				</div>	
			</div>
			
			<div style="float:left;height:55px;">
				<div  class="form-panel form-text">Password :</div>
				<div class="input-panel">
					<input name="userpassword" id="userpassword" type="password" class="input" style="width:360px;" onkeyup="emptyfield('form1_userpassword_errorloc')" onkeydown="emptyfield('form1_userpassword_errorloc')" value="<?php echo $row['user_pass']?>"/>
					<div class="error" id="form1_userpassword_errorloc" style="visibility:hidden;">Please enter valid Password</div>
				</div>
			</div>
			
			<!--<div style="float:left;height:55px;">
				<div  class="form-panel form-text">Confirm Password :</div>
				<div class="input-panel">
					<input name="confpassword" id="confpassword" type="password" class="input" style="width:360px;" onkeyup="emptyfield('form1_confpassword_errorloc')" onkeydown="emptyfield('form1_confpassword_errorloc')"/>
					<div class="error" id="form1_confpassword_errorloc" style="visibility:hidden;">Please enter valid Password</div>
				</div>
			</div>-->

			<div style="float:left;height:55px;">
				<div  class="form-panel form-text">Email Id :</div>
				<div class="input-panel">
					<input name="useremail" id="useremail" type="text" class="input" style="width:360px;" onkeyup="emptyfield('form1_useremail_errorloc')" onkeydown="emptyfield('form1_useremail_errorloc')" value="<?php echo $row['user_email']?>"/>
					<div class="error" id="form1_useremail_errorloc" style="visibility:hidden;">Please enter valid Password</div>
				</div>
			</div>
			
			<div style="float:left;height:55px;">
				<div  class="form-panel form-text">Country :</div>
				<div class="input-panel">
					<input name="country" id="country" type="text" class="input" style="width:360px;" onkeyup="emptyfield('form1_country_errorloc')" onkeydown="emptyfield('form1_country_errorloc')" value="<?php echo $row['user_country']?>"/>
					<div class="error" id="form1_country_errorloc" style="visibility:hidden;">Please enter valid Password</div>
				</div>
			</div>
			
			<div style="float:left;height:55px;">
				<div  class="form-panel form-text">Region :</div>
				<div class="input-panel">
					<input name="region" type="text" id="region" class="input" style="width:360px;" onkeyup="emptyfield('form1_region_errorloc')" onkeydown="emptyfield('form1_region_errorloc')" value="<?php echo $row['user_region']?>"/>
					<div class="error" id="form1_region_errorloc" style="visibility:hidden;">Please enter valid Password</div>
				</div>
			</div>
			
			<div style="float:left;height:auto;">
				<div  class="form-panel form-text" style="width:600px;text-align:left">Please select only two images for account and profile image respectively</div><br/>
				<div class="input-panel">
				
					<div id="wrapper" style="margin-left:20px;margin-bottom:20px;">
			
						<div id="UploadImages">
						</div>
				<div id="PhotoPrevs">
				<!-- The cropped images will be populated here -->
			</div>
					</div>
				</div>
				
			</div>
			<div class="clear"></div>
			<div class="form-panel"><img src="images/space.gif" alt="#" /></div>
			<div class="input-panel">
				<input name="edit" type="submit" class="submit-buttons-round" value="Edit">
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

