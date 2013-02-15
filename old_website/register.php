<?php 
chmod("home/", 0777);
include "config.php";
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<title>ATTAKKA</title>

<link rel="stylesheet" href="css/style-fresh.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/livevalidation_standalone.js"></script>

</head>


<body>

<div id="login-wrapper">
<div align="center"><a href="/index.php"><img src="/images/logo-big.png" alt="#" border="0" /></a></div>
<div class="white-wrapper">
<div style="padding:15px;">

<?php
if (isset($_POST['Submit'])) {
// Get values from form 
$name=$_POST['name'];
$surname=$_POST['surname'];
$myPasswordField=$_POST['myPasswordField'];
$r_PasswordField=$_POST['r_PasswordField'];
$email=$_POST['email'];
$country=$_POST['country'];
$region=$_POST['region'];
$picture_path = $_POST['picture_path'];

$name = mysql_real_escape_string($name);
$email = mysql_real_escape_string($email);
$surname = mysql_real_escape_string($surname);
$myPasswordField = mysql_real_escape_string($myPasswordField);
$r_PasswordField = mysql_real_escape_string($r_PasswordField);
$country = mysql_real_escape_string($country);
$region = mysql_real_escape_string($region);
$picture_path = mysql_real_escape_string($picture_path);

$status = "OK";
$msg="<div class='input-panel blue-text'>Errors: </div>";

$height = 0;
$width = 0;
$file_name = $_FILES['picture_path']['name'];
$random_all=rand(00000000,99999999);
$new_file_name=$name."-image-".$random_all;
$path= "/home/attakka/public_html/images/profile/".$new_file_name;

define('UPLOAD_DIR', dirname(__FILE__)."/images/profile/");

if($_FILES['picture_path']['type'] == "image/jpg") {$path = $path.'.jpg'; $new_file_name = $new_file_name.'.jpg';}
elseif($_FILES['picture_path']['type'] == "image/jpeg") {$path = $path.'.jpeg'; $new_file_name = $new_file_name.'.jpeg';}
elseif($_FILES['picture_path']['type'] == "image/gif") {$path = $path.'.gif'; $new_file_name = $new_file_name.'.gif';}
elseif($_FILES['picture_path']['type'] == "image/png") {$path = $path.'.png'; $new_file_name = $new_file_name.'.png';}
else{ $msg=$msg."<div ><div class='form-panel form-text'>File format not supported. Please use one of the following: .jpeg, .png, .gif</div></div>"; $status="NOTOK";}

list ($height, $width) = getimagesize($_FILES['picture_path']['tmp_name']);
if($height > 62 and $width > 62)
{
	
	$msg = $msg." <div class='clear'></div><div class='form-panel form-text' style='width:300px;'>Dimensions of the picture do not match.</div>";
	$status = "NOTOK";
}

if (is_uploaded_file($_FILES['picture_path']['tmp_name']) and $status == "OK")  {  
    if (move_uploaded_file($_FILES['picture_path']['tmp_name'], $path)) {

    } else {

		 $status="NOTOK";
    };
} else {

	 $status="NOTOK";
}; 


$encripted_password=md5($myPasswordField);
$encripted_password2=md5($r_PasswordField);


if($name == '' || $email == '' || $myPasswordField == '' || $r_PasswordField == '' || $country == '' || $region == '' || $surname == '')
{
$msg=$msg."<div class='clear'><div class='form-panel form-text'>All fields have to be filled</div></div>";
$status= "NOTOK";
}
$if_email = mysql_query("SELECT * FROM member_info WHERE email = '". $email ."'");
if (mysql_num_rows($if_email) > 0) {
 $msg=$msg."<div class='clear'><div class='form-panel form-text'>Mail already exists</div></div>";
$status= "NOTOK";
}
 
if($status<>"OK"){
echo "<font face='Verdana' color=red>$msg</font> <div class='form-panel'><img src='images/space.gif' alt='#' /></div>
<div class='input-panel'>
<a class='form-panel form-text' href='javascript:history.go(-1)'>TRY AGAIN</a> <div class='clear'></div> </div>";
}else{ 
// Insert data into mysql 
$sql="INSERT INTO member_info(name, lastname, password, password1, email, country, region, picture_path) VALUES('$name', '$surname', '$encripted_password', '$encripted_password2', '$email', '$country', '$region', 'images/profile/$new_file_name')";
$result=mysql_query($sql);
}
if($result){
	echo "<div class='red-color-heading'>Successfully <span class='black-color-heading'>registered</span></div>";
	echo "<a href='index.php'>Back to Start</a>";
		session_register("$email");
        session_register("$password");
        $_SESSION['email']= $email;
		$_SESSION['user_id']=$id;
		$_SESSION['is_open'] = True;
		$_SESSION['name']=$name;
		$_SESSION['surname']=$surname;
		$_SESSION['country']=$country;
		$_SESSION['region']=$region;
		$_SESSION['picture_path'] = "images/profile/".$new_file_name;
		
}
 

}
else{
?>


<form method="post" action="" enctype="multipart/form-data">
<div class="red-color-heading">Create <span class="black-color-heading">A LOGIN</span></div>
<div class="clear"></div>
<div  class="form-panel form-text">Name:</div>
<div class="input-panel"><input name="name" id="name" type="text" class="input" style="width:350px;" /></div>
<div class="clear"></div>

<script type="text/javascript">
var f1 = new LiveValidation('name');
f1.add(Validate.Presence);
</script>

<div  class="form-panel form-text">Last Name:</div>
<div class="input-panel"><input name="surname" type="text" class="input" style="width:330px;" /></div>
<div class="clear"></div>

<div  class="form-panel form-text">Password :</div>
<div class="input-panel"><input name="myPasswordField" id="myPasswordField" type="password" class="input" style="width:330px;" /></div>
<div class="clear"></div>
<div  class="form-panel form-text">Repeat Password :</div>
<div class="input-panel"><input name="r_PasswordField" id="r_PasswordField" type="password" class="input" style="width:330px;" /></div>
<div class="clear"></div>

<script type="text/javascript">
var f19 = new LiveValidation('r_PasswordField');
f19.add(Validate.Confirmation, { match: 'myPasswordField'} );
</script>

<div  class="form-panel form-text">Email ID:</div>
<div style="width:287px; float:left;"><input name="email" id="email" type="text" class="input" style="width:280px;" /> </div>
<script type="text/javascript"> 
var f20 = new LiveValidation('email');
f20.add(Validate.Email );
</script>

<div class="clear"><br /></div>



<div  class="form-panel form-text">Country :</div>
<div class="input-panel"><input name="country" type="text" class="input" style="width:150px;" value="New York" />
</div>

<div class="clear"></div>
<div  class="form-panel form-text">Region :</div>
<div class="input-panel"><input name="region" type="text" class="input" style="width:150px;" value="Russian" /></div>
<div class="clear"></div>

<div class="form-panel form-text">User Picture <br/> (dimensions: 60 x 60 px):</div>
<div class="inputpanel-rightCategory"><input name="picture_path" type="file" id = "picture_path" class="input"/>
<div class="clear"></div></div>

<div class="form-panel"><img src="images/space.gif" alt="#" /></div>
<div class="input-panel blue-text" style = "margin-left: 170px"> I agree to the <u><a href="terms-conditions.html" class="blue-text">Terms & Conditions</a></u> <input name="terms" id = "terms" type="checkbox" value="" /></div>
<div class="clear"></div>
<script type="text/javascript">
var f18 = new LiveValidation('terms');
f18.add(Validate.Acceptance );
</script>
<div class="form-panel"><img src="images/space.gif" alt="#" /></div>
<div class="input-panel">

<input name="Submit" type = "submit" value = "Register">
<div class="clear"></div>
</form>

</div>
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