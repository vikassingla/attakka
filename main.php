<?php 
 //phpinfo();
include('config.php');
session_start();
//print_r($_SESSION);
$con= mysql_connect(DB_HOST, DB_USER_NAME,DB_PASSWORD);
/*echo DB_HOST;
echo DB_USER_NAME;*/


if(!$con)
{
		die('Could not connect: ' . mysql_error());
}	
mysql_select_db(DB_NAME);


/*********function Resize************************/
function image_resize($src, $dst, $width, $height, $crop=0)
{
if(!list($w, $h) = getimagesize($src)) return false;

$type = strtolower(substr(strrchr($src,"."),1));
if($type == 'jpeg') $type = 'jpg';
switch($type){
case 'bmp': $img = imagecreatefromwbmp($src); break;
case 'gif': $img = imagecreatefromgif($src); break;
case 'jpg': $img = imagecreatefromjpeg($src); break;
case 'png': $img = imagecreatefrompng($src); break;
default : return false;
}

// resize
if($crop){
		/*echo "<br>W =".$w."<br>Width=".$width;
				echo "<br>W =".$w."<br>Width=".$width;*/
if($w < $width or $h < $height) return false;
$ratio = max($width/$w, $height/$h);
$h = $height / $ratio;
$x = ($w - $width / $ratio) / 2;
$w = $width / $ratio;
}
else{
if($w < $width and $h < $height)
{
$ratio = $width/$w;
$width = $width;
$height = $h * $ratio;
$x=0;
}
else
{
$ratio = $width/$w;
$width = $width;
$height = $h * $ratio;
$x = 0;
}
}

$new = imagecreatetruecolor($width, $height);

// preserve transparency
if($type == "gif" or $type == "png"){
imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
imagealphablending($new, false);
imagesavealpha($new, true);
}

imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);

switch($type){
case 'bmp': imagewbmp($new, $dst); break;
case 'gif': imagegif($new, $dst); break;
case 'jpg': imagejpeg($new, $dst); break;
case 'png': imagepng($new, $dst); break;
}
return true;
}	
/****************RESEND ACTIVATION COODE*********/
if(isset($_GET['email']))
{
	extract($_GET);
	$from="info@attaka.com";
	$sql="select user_id, user_firstname, user_lastname from tbl_user where user_email='".$email."'";
	$rs=mysql_query($sql);
	$row=mysql_fetch_array($rs);
	$sql1="update tbl_user set activation_code='$ac' where user_id=".$row['user_id'];
	mysql_query($sql);
	$link=SITE_URL.'login.php?actc='.$ac;
	$sentTo = $email;
	$subject = "Your New Activation Link";
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
	$headers .= 'Reply-To: '.$check. "\r\n" . 'X-Mailer: PHP/' . phpversion();
	$message = '';
	$message .="Dear ".$row['user_firstname']." ".$row['user_lastname']."<br><br/>";
	$message.="<b>Email:</b> ".$email."<br>";
	$message.="<b>Activation Link:</b>".$link."<br><br/>";
	$message.="Regards,<br>";
	$message.="www.attaka.com";
	$sentmail=mail($sentTo,$subject,$message,$headers);
	header('location:login.php?msg=chkacl');
}	

/****************SIGNUP************************/
if(isset($_POST['signup']))
{
	extract($_POST);
	$date=date('Y-m-d');
	$sqlj="select user_email from tbl_user where user_email='".$useremail."'";
	echo $sqlj;
	$rsj=mysql_query($sqlj);
	echo mysql_num_rows($rsj);
	if(mysql_num_rows($rsj)>0)
	{
		$rowj=mysql_fetch_array($rsj);
		/*echo "<pre>";
		print_r($rowj);*/
		header('Location:register.php?msg=signUpFail');
	}	
	else
	{
		$sql="insert into tbl_user (user_firstname, user_lastname, user_pass, user_email, user_country, user_region, user_created, user_modified, user_status, activation_code) values ('$userfirstname', '$userlastname', '$userpassword', '$useremail', '$country', '$region', '$date', '$date', '0', '$activation_code')";
		echo $sql;
		mysql_query($sql);
		$last_insert_id=mysql_insert_id();
		echo $last_insert_id;
		$sqle="select email_msg from tbl_email_templates where email_id=1";
		$rsle=mysql_query($sqle);
		$rowe=mysql_fetch_array($rsle);
		$sqll="select user_firstname, user_lastname, user_email from tbl_user where user_id=$last_insert_id";
		$rsl=mysql_query($sqll);
		$from="admin@attaka.com";
		if(mysql_num_rows($rsl)>0)
		{
			$sendMail2=mysql_fetch_array($rsl);
			$user_email=$sendMail2['user_email'];
			$to=$user_email;
			$subject = "Your account information";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
			$headers .= 'Reply-To: '.$to. "\r\n" . 'X-Mailer: PHP/' . phpversion();
			$message=strip_tags(html_entity_decode($rowe['email_msg']), '<p><span><h3><a><br />');	
			$link=SITE_URL.'login.php?actc='.$activation_code;
			$search = array('{user_firstname}','{user_lastname}', '{link}');
			$replace = array($sendMail2['user_firstname'], $sendMail2['user_lastname'], $link) ;
			$body =str_replace($search,$replace,$message);
			echo $search;
			echo $body;
			$sent = mail($to,$subject,$body, $headers);	
			if($sent)
			{
				echo "true";
			}	
			else
			{
				echo "false";
			}
		}
		if(mysql_insert_id())
		{
			header('Location:index.php?msg=veracc');
		}
	}
}
/**********************LOGIN*************/
if(isset($_POST['login']))
{
	echo "<pre>";
	print_r($_POST);
	extract($_POST);
	//echo $activation_code;
	if((@$activation_code)=="")
	{
		$sql1="select user_id, user_status from tbl_user where user_email='$useremail' and user_pass='$userpassword' and user_status=1 limit 1";
	}
	else 
	{	
		$sql1="select user_id, activation_code ,user_status from tbl_user where user_email='$useremail' and user_pass='$userpassword' and activation_code='$activation_code' limit 1";
	}
	echo $sql1;
	$rs1=mysql_query($sql1);
	echo (mysql_num_rows($rs1));
	if(mysql_num_rows($rs1)>0)
	{	
		
		$row=mysql_fetch_array($rs1);
		if($row['user_status']==0)
		{
		$sql2="UPDATE tbl_user SET user_status = 1, activation_code='' WHERE user_id=".$row['user_id'];
		mysql_query($sql2);
		}
		$_SESSION['user_id']=$row['user_id'];
		if($rpage=="")
		{
			echo "Yes";
			header('Location:all_category.php');	
		}
		else
		{
			echo "No";
			header('Location:'.$rpage);	
		}			
	}	
	else
	{
		$sqll="select user_id, user_status from tbl_user where user_email='$useremail' limit 0, 1";
		$rss=mysql_query($sqll);
		if(mysql_num_rows($rss)>0)
		{
			if($rss['user_status']==1)
			{
				header('Location:login.php?msg1=aexist');
				die();					
			}
			else
			{	
				header('Location:login.php?msg1=accexist&email='.$useremail);
				die();	
			}	
		}
		else
		{
			header('Location:login.php?msg2=loginFail');
			die();	
		}
		
	}	
}
/***************************Forget Password*******************/
if(isset($_POST['forgot_password']))
{
	$check=$_POST['useremail'];
	$sql2="select user_firstname, user_lastname, user_email, user_pass from tbl_user where user_email='$check' and user_status=1";
	//echo $sql2;
    $rs2=mysql_query($sql2);
        $sqle="select email_msg from tbl_email_templates where email_id=2";
	$rsle=mysql_query($sqle);
	$rowe=mysql_fetch_array($rsle);
	// echo mysql_num_rows($rs2);
    if(mysql_num_rows($rs2)>0)
    {
		$from="admin@attaka.com";
		$passGet=mysql_fetch_array($rs2);
		$user_email=$passGet['user_email'];
		$to=$check;
		$subject = "Your account information";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
		$headers .= 'Reply-To: '.$to. "\r\n" . 'X-Mailer: PHP/' . phpversion();
		$message=strip_tags(html_entity_decode($rowe['email_msg']), '<p><span><h3><a><br />');	
		$search = array('{user_firstname}', '{user_lastname}','{user_email}', '{user_password}');
		$replace = array($passGet['user_firstname'],$passGet['user_lastname'],$passGet['user_email'],$passGet['user_pass']) ;
		$body =str_replace($search,$replace,$message);
		echo $message;
		echo $replace;
		echo $body;
		@$sent = mail($to,$subject,$body,$headers);	
		if(@$sent)
		{
			echo "1";
		}
		else
		{
			echo "0";	
		}	    
        header('location:forget_password.php?msg=forSucc');
    }
    else
    {
       header('location:forget_password.php?msg=forFail');
    }
}
/**********Create Category*******************/
if(isset($_POST['create_cat']))
{
	//echo "<pre>";
	//print_r($_POST);
	//die;
	//print_r($_FILES);
	extract($_POST);
	$date=date('Y-m-d');
	$sql3="select cat_name from tbl_category where cat_name='$catname'";

	$rs3=mysql_query($sql3);
	if(mysql_num_rows($rs3)>0)
	{
		header('location:create_category.php?msg=alexist');
	}
	else
	{
		$uploadDir="review_images/";
		$catimg1=$p250_image;
		$catname1=addslashes($catname);
		$defreview1=addslashes($defreview);
		$catdes1=addslashes($catdes);
		$catrules1=addslashes($catrules);
		
			if($mod==1)
			{
				$sqli="insert into tbl_category(cat_parent_id,cat_name,cat_img,cat_banner_img,cat_ref, cat_def_review, cat_des,cat_rules, cat_created_by,cat_created_date,cat_modified_date, cat_mod_status,cat_active) values (0, '$catname1', '$catimg1','','$cat_referance','$defreview1','$catdes1', '$catrules1', '$user_id', '$date', '$date', '1', 1)";
			}
			else 
			{
				$sqli="insert into tbl_category(cat_parent_id,cat_name,cat_img,cat_banner_img,cat_ref, cat_def_review, cat_des,cat_rules, cat_created_by,cat_created_date,cat_modified_date, cat_mod_status,cat_active) values (0, '$catname1', '$catimg1','','$cat_referance','$defreview1' , '$catdes1', '$catrules1', '$user_id', '$date', '$date', '0', 1)";
			}	
			
		//echo $sqli;
		mysql_query($sqli);
		$last_insert_id=mysql_insert_id();
		//echo $last_insert_id;	
		if($mod==1)
		{
			$sqlj="insert into tbl_moderator (moderator_cat_id, moderator_user_id ) values ('$last_insert_id', '$user_id')";
			mysql_query($sqlj);
		}	
		//echo $last_insert_id;
		/*for($i=1;$i<6;$i++)
		{		
			if($_FILES['reviewimg'.$i]['error']==0)
			{
				$fpath=$_FILES['reviewimg'.$i]['name'];
				$randomstring=rand(00000,99999);
				$newname=$randomstring.'-'.$fpath;
				$fileTempName=$_FILES['reviewimg'.$i]['tmp_name'];
				$result = move_uploaded_file($_FILES['reviewimg'.$i]['tmp_name'], $uploadDir . $newname);
				$src2=$uploadDir . $newname;
				$destpath1="review_images/";
				$dst2=$destpath1.'tmb_'.$newname;
				$img1='tmb_'.$newname;
				//$pic_error = image_resize($src2, $dst2, 980, 272, 1);
				$pic_error = image_resize_new($src2, $dst2, 980, 272, 0);
				$image = $dst2;
				$maxHeight = 123; $maxWidth = 290;
				//include 'thumb_save.php';
				$tmb_name1=@substr(@$tmb_name,14);
				$tmb_name1 ='';
				if($pic_error)
				{
					$sqlr="insert into tbl_review_image (rev_img, rev_cat_id, rev_tmb_img, rev_rank) values ('$img1', $last_insert_id, '$tmb_name1',$i)";
					echo $sqlr;
					mysql_query($sqlr);
				}
				
			}
		}	*/
		
		$tmb_name1 = '';
		$img1 = $b990_image;
		$sqlr="insert into tbl_review_image (rev_img, rev_cat_id, rev_tmb_img, rev_rank) values ('$img1', $last_insert_id, '$tmb_name1',1)";
		//echo $sqlr;
		mysql_query($sqlr);
		
		//die('here');
		header("Location:create_review.php?cat_id=$last_insert_id");
		//die();
	}
}
/*************************Create Sub Category*************************/
if(isset($_POST['createsubcat']))
{
	echo "<pre>";
	print_r($_POST);
	print_r($_FILES);
	extract($_POST);
	$date=date('Y-m-d');
	$subcatname1=addslashes($subcatname);
	$subcatdes1=addslashes($subcatdes);
	$subcatrules1=addslashes($subcatrules);
	$sql12="select cat_id, cat_name from tbl_category where cat_name='".$subcatname1."'";
	echo @$sql12;
	$rs12=mysql_query($sql12);
	if(mysql_num_rows($rs12)==0)
	{
		
		$fpath1=$_FILES['subcatimg']['name'];
		$uploadDir1 ="cat_images/";
		$randomstring=rand(00000,99999);
		$newname1=$randomstring.'-'.$fpath1;
		$pic_type = strtolower(strrchr($newname1,"."));
		$result1 = move_uploaded_file($_FILES['subcatimg']['tmp_name'], $uploadDir1 . $newname1);
		$src1=$uploadDir1 . $newname1;
		$destpath="cat_images/";
		$dst1=$destpath.'tmb_'.$newname1;
		$img='tmb_'.$newname1;
		$pic_error = @image_resize($src1, $dst1, 990, 274, 1);
		$image = $dst1;
		$maxHeight = 120; $maxWidth = 325;
		include 'thumb_save.php';
		$tmb_name1=substr($tmb_name,11);
		echo $tmb_name1;
		
		echo $pic_error;
		if($pic_error)
		{
			if($mod==1)
			{
				$sqli="insert into tbl_category(cat_parent_id,cat_name,cat_img,cat_thumb_img,cat_created_by,cat_des,cat_rules,cat_created_date,cat_modified_date, cat_mod_status, cat_active) values ('$cat_id', '$subcatname1', '$img', '$tmb_name1','$user_id', '$subcatdes','$subcatrules','$date', '$date', '1', 1)";
			}
			else
			{
				$sqli="insert into tbl_category(cat_parent_id,cat_name,cat_img,cat_thumb_img,cat_created_by,cat_des,cat_rules,cat_created_date,cat_modified_date, cat_mod_status, cat_active) values ('$cat_id', '$subcatname1', '$img', '$tmb_name1','$user_id', '$subcatdes','$subcatrules','$date', '$date', '0', 1)";
			}		
		}	
		echo $sqli;
		mysql_query($sqli);
		$last_insert_id1=mysql_insert_id();
		if($mod==1)
		{
			$sqlj="insert into tbl_moderator (moderator_cat_id, moderator_user_id ) values ('$last_insert_id1', '$user_id')";
			mysql_query($sqlj);
		}
		header("Location:create_review.php?cat_id=".$last_insert_id1);
	}
	
	else
	{	
		header("Location:sub_cat.php?cat_id=".$cat_id."&msg=alexst");		
	}
}
/*************************Create a Review*************************/
if(isset($_POST['review']))
{
	extract($_POST);
	$date=date('Y-m-d');
	$user=$_SESSION['user_id'];
	$revtitle1=addslashes($revtitle);
	$revcom1=addslashes($revcom);
	
	if($subcat=="" || $subcat=="none")
	{
		$sql="INSERT INTO tbl_review (
review_cat_id,review_title,review_opinion,review_created_by ,review_created_date,review_rate ,review_active
) values ('$catid', '$revtitle1', '$revcom1', '$user', '$date', '$rate', 1)";
echo $sql;
mysql_query($sql);
header("Location:create_rev.php?msg=susub");
	}
	else
	{
		$sql="INSERT INTO tbl_review (
review_cat_id,review_title,review_opinion,review_created_by ,review_created_date,review_rate ,review_active
) values ('$subcat', '$revtitle1', '$revcom1', '$user', '$date', '$rate', 1)";
echo $sql;
mysql_query($sql);
header("Location:create_rev.php?msg=susub");
	}		
}
/*********************Create from pic review*********************************/
if(isset($_POST['create_review']))
{
	extract($_POST);
	$date=date('Y-m-d');
	$opintitle1=addslashes($opintitle);
	$revtitle1=addslashes($revtitle);
	$sql="INSERT INTO tbl_review (
review_cat_id,review_title,review_opinion,review_created_by ,review_created_date,review_rate ,review_active
) values ('$cat_id', '$opintitle', '$revtitle', '$user_id', '$date', '$rate', 1)";
echo $sql;
mysql_query($sql);
header("Location:create_review.php?cat_id=$cat_id&msg=susub");
			
}
if(isset($_POST['edit']))
{
	echo "<pre>";
	print_r($_POST);
	extract($_POST);
	$date=date('Y-m-d');
	$user_id=$_SESSION['user_id'];
	$userfirstname1=addslashes($userfirstname);
	$userlastname1=addslashes($userlastname);
	$userpassword1=addslashes($userpassword);
//	1=addslashes();1=addslashes();1=addslashes();
	if($account_image)
	{
		$img=explode(",", $account_image);
		$img1=$img[0];
		$img2=$img[1];
		$sql="update tbl_user set user_firstname='$userfirstname1', user_lastname='$userlastname1', user_pass='$userpassword1', user_email='$useremail', user_country='$country', user_region='$region', user_created='$date', user_modified='$date', profile_image='$img1', account_image='$img2' where user_id=".$user_id;
	}
	else
	{	
		$sql="update tbl_user set user_firstname='$userfirstname1', user_lastname='$userlastname1', user_pass='$userpassword1', user_email='$useremail', user_country='$country', user_region='$region', user_created='$date', user_modified='$date' where user_id=".$user_id;
	}
	echo $sql;
mysql_query($sql);
header("Location:user_page.php?msg=susub");
			
}
/******************fb login***************************/
/********fb Login********/
if(isset($_GET['uid']) && isset($_GET['firstname']) && isset($_GET['lastname']) && isset($_GET['uemail']))
{
	echo "<pre>"; 
print_r($_GET);

$date=date('Y-m-d');
	$uid=$_GET['uid'];
	$email=$_GET['uemail'];
	$fname=$_GET['firstname'];
	$lname=$_GET['lastname'];
	$queryfb='select user_id from tbl_user where user_email ="'.$email.'" or facebook_id	='.$uid.'';
	echo $queryfb;
	$resultfb=mysql_query($queryfb);
	if(mysql_num_rows($resultfb) > 0)
	{
		$fbrow = mysql_fetch_assoc($resultfb);
		$_SESSION['user_id']=$fbrow['user_id'];
		header('Location:user_page.php');
	}
	else
	{	
		$insertFBquery="insert into tbl_user (user_firstname, user_lastname,user_email,facebook_id, user_status, user_created, user_modified )values('".htmlentities($fname, ENT_QUOTES, 'utf-8')."', '".htmlentities($lname, ENT_QUOTES, 'utf-8')."','$email',$uid, 1, '$date', '$date')";
		echo $insertFBquery;
		$resultfb=mysql_query($insertFBquery);
		$last_insert_id=mysql_insert_id();
		if($last_insert_id)
		{
			$query='select user_id from tbl_user where user_id ='.$last_insert_id;
			$result=mysql_query($query);
			if(mysql_num_rows($result)>0)
			{
				$_SESSION['user_id'] = $last_insert_id;
			}
			header('Location:user_page.php');
		}
	}
}
/******Image of Reviews*********/
if(isset($_POST['review_image']))
{
	/*echo "<pre>";
	print_r($_POST);*/
	extract($_POST);
	$n=count($pos);
	$user_id=$_SESSION['user_id'];
	$sql36="select img_rank_id, rev_img_id, img_rank from tbl_img_rank where cat_id=$cat_id and user_id=$user_id order by img_rank asc";
	echo $sql36;
	$rs36=mysql_query($sql36);
	//echo mysql_num_rows($rs36);
	$i=1;
	$j=0;
	if(mysql_num_rows($rs36)==0)
	{
		while($j<$n)
		{
			$sql37="insert into tbl_img_rank (rev_img_id, img_rank, cat_id, user_id) values ('$pos[$j]', '$i','$cat_id', '$user_id')";
			echo $sql37;
			mysql_query($sql37);
			$j++; 
			$i++;
		} 
	}
	else
	{
		
		$n=mysql_num_rows($rs36);
		while($row36=mysql_fetch_array($rs36))
		{
			$sql41="update tbl_img_rank set rev_img_id='$pos[$j]', img_rank='$i' where img_rank_id=".$row36['img_rank_id'];
			echo $sql41;
			mysql_query($sql41);
			$j++; 
			$i++;
		}	
	}	
	header("Location:infowall.php?cat_id=$cat_id&msg=susub");
			
}
/******************Reset the Site***********************/
if(isset($_POST['reset']))
{
$sql55="truncate table tbl_answer";
mysql_query($sql55);
$sql56="truncate table tbl_category";
mysql_query($sql56);
$sql57="truncate table tbl_discuss";
mysql_query($sql57);
$sql58="truncate table tbl_fan";
mysql_query($sql58);
$sql59="truncate table tbl_favorites";
mysql_query($sql59);
$sql60="truncate table tbl_img_rank";
mysql_query($sql60);	
$sql61="truncate table tbl_moderator";
mysql_query($sql61);	
$sql62="truncate table tbl_review";
mysql_query($sql62);	
$sql63="truncate table tbl_review_image";
mysql_query($sql63);	
$sql64="truncate table tbl_vote";
mysql_query($sql64);	
header("Location:reset.php?msg=sudel");
}	
?>
