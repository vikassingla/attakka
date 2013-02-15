<?php
include "config.php";
session_start();

if ($_SESSION['is_open'] != "True")
{
	header( 'Location: /not-logged-in.html' ) ;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<title>ATTAKKA</title>

<link rel="stylesheet" href="css/style-fresh.css" type="text/css" media="screen" />


</head>


<body>
<div id="main-wrapper">
<div align="center"><img src="images/logo-big.png" alt="#" /></div>
<div class="white-wrapper">
<?php
if(!isset($_POST['Submit']))
{
?>

<form method="post" action="" enctype="multipart/form-data">
<div style="padding:15px;">
<div class="red-color-heading">Create <span class="black-color-heading">Category</span></div>
<div class="clear"></div>
<div id="left-panelform">
<div class="formpanel-text form-text">Category Name: </div>
<div class="inputpanel-rightCategory"><input name="category_name" type="text" class="input" style="width:263px;" /></div>
<div class="clear"></div>
<div class="formpanel-text form-text">Submit Category Image (240x214):</div>
<div class="inputpanel-rightCategory"><input name="category_image" type="file" class="input"/>
<img src="images/submit-btrn.gif" alt="#"  style="margin-bottom:-10px;"/></div>
<div class="clear"></div>
<div class="formpanel-text form-text">Is your category:</div>
<div class="inputpanel-rightCategory">
  <select name="category_type"  class="input" style="width:200px;">
    <option selected="selected">Regional</option>
  </select>
</div>
<div class="clear"></div>
<div class="formpanel-text form-text">Review Defaults: </div>
<div class="inputpanel-rightCategory"><input type="text" name="review_defaults" class="input" style="width:263px;" /></div>
<div class="clear"></div>
<div class="formpanel-text form-text">Review Defaults pics :</div>
<div class="inputpanel-rightCategory"><input name="revdef1" type="file" class="input"/>
<img src="images/submit-btrn.gif" alt="#"  style="margin-bottom:-10px;"/></div>
<div class="clear"></div>

<div class="formpanel-text form-text">Review Defaults pics :</div>
<div class="inputpanel-rightCategory"><input name="revdef2" type="file" class="input"/>
<img src="images/submit-btrn.gif" alt="#"  style="margin-bottom:-10px;"/></div>
<div class="clear"></div>

<div class="formpanel-text form-text">Review Defaults pics :</div>
<div class="inputpanel-rightCategory"><input name="revdef3" type="file" class="input"/>
<img src="images/submit-btrn.gif" alt="#"  style="margin-bottom:-10px;"/></div>
<div class="clear"></div>

<div class="formpanel-text form-text">Review Defaults pics :</div>
<div class="inputpanel-rightCategory"><input name="revdef4" type="file" class="input"/>
<img src="images/submit-btrn.gif" alt="#"  style="margin-bottom:-10px;"/></div>
<div class="clear"></div>

<div class="formpanel-text form-text">Review Defaults pics :</div>
<div class="inputpanel-rightCategory"><input name="revdef5" type="file" class="input"/>
<img src="images/submit-btrn.gif" alt="#"  style="margin-bottom:-10px;"/></div>
<div class="clear"></div>

<div class="clear"></div>

</div>


<div id="right-panelform"><div class="formpanel-text-rightCategory form-text">Category Rules:</div>
  <div class="inputpanel-rightCategory2"> <textarea name="category_rules" rows="8" class="textarea" style="width:270px;"></textarea> 
  </div>
  <div class="clear"></div>
  <div id="right-panelform"><div class="formpanel-text-rightCategory form-text"> Category Descripition:</div>
  <div class="inputpanel-rightCategory2"> <textarea name="description" rows="8" class="textarea" style="width:270px;"></textarea> 
  </div>
</div>





</div>
<div class="clear"></div>

<div><img src="images/line-flip.png" alt="#" /></div>
<div class="clear"></div>
<div align="center"><input name="Submit" type="submit" /> &nbsp;&nbsp;&nbsp; <input name="" type="image" src="images/clear-btrn.gif" /></div>


</div>
</form>
<?php
}
else{
include ("config.php");

// Get values from form 
$category_name=$_POST['category_name'];
$category_rules=$_POST['category_rules'];
$description=$_POST['description'];
$category_image=$_POST['category_image'];
$category_type=$_POST['category_type'];
$review_defaults=$_POST['review_defaults'];
$revdef1=$_POST['revdef1'];
$revdef2=$_POST['revdef2'];
$revdef3=$_POST['revdef3'];
$revdef4=$_POST['revdef4'];
$revdef5=$_POST['revdef5'];

define('UPLOAD_DIR', dirname(__FILE__)."/images/categories/");
$status = "OK";
$msg="<br>";

// Image upload and checking

if($_FILES['category_image']['type'] == "image/jpg") {$path = $path.'.jpg'; $new_file_name = $new_file_name.'.jpg';}
elseif($_FILES['category_image']['type'] == "image/jpeg") {$path = $path.'.jpeg'; $new_file_name = $new_file_name.'.jpeg';}
elseif($_FILES['category_image']['type'] == "image/gif") {$path = $path.'.gif'; $new_file_name = $new_file_name.'.gif';}
elseif($_FILES['category_image']['type'] == "image/png") {$path = $path.'.png'; $new_file_name = $new_file_name.'.png';}
else{ $msg=$msg."<div ><div class='form-panel form-text'>File format not supported. Please use one of the following: .jpeg, .png, .gif</div></div>"; $status="NOTOK";}

list ($height, $width) = getimagesize($_FILES['category_image']['tmp_name']);
if($height > 240 and $width > 214)
{
	
	$msg = $msg." <div class='clear'></div><div class='form-panel form-text' style='width:auto;'>Dimensions of the picture do not match. (Max allowed: 240x214)</div>";
	$status = "NOTOK";
}


if ($category_image !== '' && $status == "OK")
{
	$limit_size=100;
	$upload_file_name = $_FILES['category_image']['tmp_name'];
	$random_all=rand(00000000,99999999);
	$new_file_name=$category_name."-image-".$random_all;
	$path= UPLOAD_DIR.$new_file_name;

	if (is_uploaded_file($upload_file_name) and $status == "OK")  {  
		if (move_uploaded_file($upload_file_name, $path)) {
		} else {

			$status="NOTOK";
		};
	} else {

		$status="NOTOK";
	}; 
}
else {$msg = $msg."<div class='clear'></div><div class='form-panel form-text' style='width:auto;'>Category image not uploaded</div>"; $status = "NOTOK";}


list ($height, $width) = getimagesize($_FILES['revdef1']['tmp_name']);
if($height > 370 and $width > 700)
{
	
	$msg = $msg." <div class='clear'></div><div class='form-panel form-text' style='width:300px;'>Dimensions of the default picture 1 do not match. (Max allowed: 700x370)</div>";
	$status = "NOTOK";
}

if ($revdef1!=='' && $status == "OK")
{
	$limit_size=100;
	$upload_file_name = $_FILES['revdef1']['tmp_name'];
	$random_all=rand(00000000,99999999);
	$new_file_name1=$category_name."-image-".$random_all;
	$path= UPLOAD_DIR.$new_file_name1;

	if (is_uploaded_file($upload_file_name) and $status == "OK")  {  
		if (move_uploaded_file($upload_file_name, $path)) {
		} else {
			$msg = $msg."Default picture #1 not uploaded.";
		};
	} else {
		$msg = $msg."Default picture #1 not uploaded.";
	}; 
}

list ($height, $width) = getimagesize($_FILES['revdef2']['tmp_name']);
if($height > 370 and $width > 700)
{
	
	$msg = $msg." <div class='clear'></div><div class='form-panel form-text' style='width:300px;'>Dimensions of the default picture 2 do not match. (Max allowed: 700x370)</div>";
	$status = "NOTOK";
}

if ($revdef2!=='' && $status == "OK")
{
	$limit_size=100;
	$upload_file_name = $_FILES['$revdef2']['tmp_name'];
	$random_all=rand(00000000,99999999);
	$new_file_name2=$category_name."-image-".$random_all;
	$path= UPLOAD_DIR.$new_file_name2;

	if (is_uploaded_file($upload_file_name) and $status == "OK")  {  
		if (move_uploaded_file($upload_file_name, $path)) {
		} else {
			$msg = $msg."Default picture #2 not uploaded.";
		};
	} else {
		$msg = $msg."Default picture #2 not uploaded.";
	}; 
}


list ($height, $width) = getimagesize($_FILES['revdef3']['tmp_name']);
if($height > 370 and $width > 700)
{
	
	$msg = $msg." <div class='clear'></div><div class='form-panel form-text' style='width:300px;'>Dimensions of the default picture 3 do not match. (Max allowed: 700x370)</div>";
	$status = "NOTOK";
}

if ($revdef3!=='' && $status == "OK")
{
	$limit_size=100;
	$upload_file_name = $_FILES['$revdef3']['tmp_name'];
	$random_all=rand(00000000,99999999);
	$new_file_name3=$category_name."-image-".$random_all;
	$path= UPLOAD_DIR.$new_file_name3;

	if (is_uploaded_file($upload_file_name) and $status == "OK")  {  
		if (move_uploaded_file($upload_file_name, $path)) {
		} else {
			$msg = $msg."Default picture #3 not uploaded.";
		};
	} else {
		$msg = $msg."Default picture #3 not uploaded.";
	}; 
}


list ($height, $width) = getimagesize($_FILES['revdef4']['tmp_name']);
if($height > 370 and $width > 700)
{
	
	$msg = $msg." <div class='clear'></div><div class='form-panel form-text' style='width:300px;'>Dimensions of the default picture 4 do not match. (Max allowed: 700x370)</div>";
	$status = "NOTOK";
}

if ($revdef4!=='' && $status == "OK")
{
	$limit_size=100;
	$upload_file_name = $_FILES['$revdef4']['tmp_name'];
	$random_all=rand(00000000,99999999);
	$new_file_name4=$category_name."-image-".$random_all;
	$path= UPLOAD_DIR.$new_file_name4;

	if (is_uploaded_file($upload_file_name) and $status == "OK")  {  
		if (move_uploaded_file($upload_file_name, $path)) {
		} else {
			$msg = $msg."Default picture #4 not uploaded.";
		};
	} else {
		$msg = $msg."Default picture #4 not uploaded.";
	}; 
}

list ($height, $width) = getimagesize($_FILES['revdef5']['tmp_name']);
if($height > 370 and $width > 700)
{
	
	$msg = $msg." <div class='clear'></div><div class='form-panel form-text' style='width:300px;'>Dimensions of the default picture 5 do not match. (Max allowed: 700x370)</div>";
	$status = "NOTOK";
}

if ($revdef5!=='' && $status == "OK")
{
	$limit_size=100;
	$upload_file_name = $_FILES['$revdef5']['tmp_name'];
	$random_all=rand(00000000,99999999);
	$new_file_name5=$category_name."-image-".$random_all;
	$path= UPLOAD_DIR.$new_file_name5;

	if (is_uploaded_file($upload_file_name) and $status == "OK")  {  
		if (move_uploaded_file($upload_file_name, $path)) {
		} else {
			$msg = $msg."Default picture #5 not uploaded.";
		};
	} else {
		$msg = $msg."Default picture #5 not uploaded.";
	}; 
}



// Insert data into mysql 


if($status<>"OK"){
echo "<font face='Verdana' color=red>$msg</font> <div class='form-panel'><img src='images/space.gif' alt='#' /></div>
<div class='input-panel'> <br/><br/>
<a class='form-panel form-text' href='javascript:history.go(-1)'>TRY AGAIN</a> <div class='clear'></div> </div>";
}
else{
$sql="INSERT INTO category(category_name, category_rules, description, category_image, category_type, review_defaults, revdef1, revdef2, revdef3, revdef4, revdef5)VALUES('$category_name', '$category_rules', '$description', '$new_file_name', '$category_type', '$review_defaults', '$new_file_name1', '$new_file_name2', '$new_file_name3', '$new_file_name4', '$new_file_name5')";
$result=mysql_query($sql);
}
// if successfully insert data into database, displays message "Successful". 
if($result){
echo "You added category successfuly";
}
else {
echo "";
}
}
?>
</div>
<div class="clear"></div>
<div class="footer-panel-left-login">
<div class="footer-text"><a href="index.html" class="footer-text">Home</a> &nbsp;|&nbsp; <a href="about-us.html" class="footer-text">About Us</a> &nbsp;|&nbsp; <a href="terms-conditions.html" class="footer-text">Terms &amp; Conditions</a> &nbsp;|&nbsp; <a href="login.html" class="footer-text" >Login</a> &nbsp;|&nbsp;     Register</div>
<div class="footer-text">© 2012 Attakka, All rights reserved.</div>

</div>
<div class="footer-panel-right"><a href="#"><img src="images/facebook-icon.png" alt="#" border="0" /></a> <a href="#"><img src="images/twitter-icon.png" alt="#" border="0" /></a> <a href="#"><img src="images/gplus-icon.png" alt="#"  border="0"/></a></div>
</div>
</body>
</html>













			

