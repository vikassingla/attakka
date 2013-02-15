<?php 
phpinfo();
include('config.php');
session_start();
//print_r($_SESSION);
$con= mysql_connect(DB_HOST, DB_USER_NAME,DB_PASSWORD); 
if(!$con)
{
		die('Could not connect: ' . mysql_error());
}	
mysql_select_db(DB_NAME);
echo "<pre>";
print_r($_POST);
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
			echo $body;
			$sent = mail($to,$subject,$body, $headers);	
			if($sent)
			{
				echo "true";
			}	
			else
			{
				echo "false";
			}*/	
		}
		if(mysql_insert_id())
		{
			header('Location:index.php?msg=veracc');
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
		$passGet=mysql_fetch_assoc($rs2);
		
        $sentTo = $check;
        $subject = "Your account information";
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
		$headers .= 'Reply-To: '.$sentTo. "\r\n" . 'X-Mailer: PHP/' . phpversion();
		$message=strip_tags(html_entity_decode($rowe['email_msg']), '<p><span><h3><a><br />');	
		$search = array('{user_firstname}', '{user_lastname}','{user_email}', '{user_password}');
		$replace = array($passGet['user_firstname'],$passGet['user_lastname'],$passGet['user_email'],$passGet['user_pass']) ;
		$body =str_replace($search,$replace,$message);
		echo $message;
		echo $replace;
		echo $body;
		$sent = mail($to,$subject,$body, $headers);	    
        header('location:forget_password.php?msg=forSucc');
    }
    else
    {
        header('location:forget_password.php?msg=forFail');
    }
}
/***************************Login***************/
if(isset($_POST['login']))
{
	extract($_POST);
	//echo $activation_code;
	if(($activation_code)=="")
	{
		$sql1="select user_id, user_status from tbl_user where user_email='$useremail' and user_pass='$userpassword' and user_status=1 limit 1";
	}
	else 
	{	
		$sql1="select user_id, activation_code ,user_status from tbl_user where user_email='$useremail' and user_pass='$userpassword' and activation_code='$activation_code' limit 1";
	}
	echo $sql1;
	$rs1=mysql_query($sql1);
	//echo (mysql_num_rows($rs1));
	if(mysql_num_rows($rs1)>0)
	{	
		
		$row=mysql_fetch_array($rs1);
		if($row['user_status']==0)
		{
		$sql2="UPDATE tbl_user SET user_status = 1, activation_code='' WHERE user_id=".$row['user_id'];
		mysql_query($sql2);
		}
		$_SESSION['user_id']=$row['user_id'];
		else
		{	
			header('Location:event.php');	
		}		
	}	
	else
	{
		$sqll="select user_id, user_status from tbl_user where user_email='$useremail' and user_pass='$userpassword' limit 1";
		$rss=mysql_query($sqll);
		if(mysql_num_rows($rss)>0){
			header('Location:login.php?msg1=accexist');
			die();	
			
		}
		else{
			header('Location:login.php?msg2=loginFail');
			die();	
		}

		
	}	
}
/**********Create Category*******************/
if(isset($_POST['create_cat']))
{
	echo "<pre>";
	//print_r($_POST);*/
	print_r($_FILES);
	extract($_POST);
	$date=date('Y-m-d');
	if($_FILES['cat_img']['error']==4)
	{
		if($mod==1)
		{
			$sqli="insert into tbl_cat(parent_id,cat_name,cat_ref,cat_des,cat_rules, created_by,created_date,modified_date, mod_status, active) values (0, '$catname', '$cat_referance', '$catdes', '$catrules','$user_id', '$date', '$date', '1', 1)";
		}
		else
		{
			$sqli="insert into tbl_cat(parent_id,cat_name,cat_ref,cat_des,cat_rules, created_by,created_date,modified_date, mod_status, active) values (0, '$catname', '$cat_referance', '$catdes', '$catrules','$user_id', '$date', '$date', '0', 1)";
		}	
	}	
	else
	{
		$fpath1=$_FILES['cat_image']['name'];
		$uploadDir1 =   "cat_images/";
		$randomstring=rand(00000,99999);
		$newname1=$randomstring.'-'.$fpath1;
		$uploadDir =   "review_images/";
		$fileTempName1=$_FILES['cat_image']['tmp_name'];
		$result1 = move_uploaded_file($_FILES['cat_image']['tmp_name'], $uploadDir1 . $newname1);
		if($result1)
		{
			if($mod==1)
			{
				$sqli="insert into tbl_cat(parent_id,cat_name,cat_img,cat_ref, cat_des,cat_rules, created_by,created_date,modified_date, mod_status,active) values (0, '$catname', '$newname1', '$cat_referance','$catdes', '$catrules', '$user_id', '$date', '$date', '1', 1)";
			}
			else
			{
				$sqli="insert into tbl_cat(parent_id,cat_name,cat_img,cat_ref,cat_des,cat_rules, created_by,created_date,modified_date, mod_status,active) values (0, '$catname', '$newname1', '$cat_referance', '$catdes', '$catrules', '$user_id', '$date', '$date', '0', 1)";
			}
		}	
		echo $sqli;
		mysql_query($sqli);
		$last_insert_id=mysql_insert_id();	
		if($mod==1)
		{
			$sqlj="insert into tbl_mod (cat_id, user_id ) values ('$last_insert_id', '$user_id')";
			mysql_query($sqlj);
		}	
		echo $last_insert_id;
		for($i=1;$i<6;$i++)
		{		
			$fpath=$_FILES['reviewimg'.$i]['name'];
			$randomstring=rand(00000,99999);
			$newname=$randomstring.'-'.$fpath;
			$fileTempName=$_FILES['reviewimg'.$i]['tmp_name'];
			$result = move_uploaded_file($_FILES['reviewimg'.$i]['tmp_name'], $uploadDir . $newname);
			if($result)
			{
				$sqlr="insert into tbl_review_image (rev_rank, rev_img, cat_id) values ($i, '$newname', $last_insert_id)";
				mysql_query($sqlr);
			}
		}	
	}
	header("Location:all-category.php");
}

/*************************Create Sub Category*************************/
if(isset($_POST['createsubcat']))
{
	echo "<pre>";
	//print_r($_POST);*/
	print_r($_FILES);
	extract($_POST);
	$date=date('Y-m-d');
	if($_FILES['subcatimg']['error']==4)
	{
		if($mod==1)
		{
			$sqli="insert into tbl_cat(parent_id,cat_name,mod_status,cat_des,cat_rules,created_by,created_date,modified_date, active) values ('$cat_id', '$subcatname', '1','$subcatdes','$subcatrules','$user_id', '$date', '$date', 1)";
		}
		else
		{
			$sqli="insert into tbl_cat(parent_id,cat_name,mod_status,cat_des,cat_rules,created_by,created_date,modified_date, active) values ('$cat_id', '$subcatname', '0','$subcatdes','$subcatrules','$user_id', '$date', '$date', 1)";
		}	
	}	
	else
	{
		$fpath1=$_FILES['subcatimg']['name'];
		$uploadDir1 =   "subcat_images/";
		$randomstring=rand(00000,99999);
		$newname1=$randomstring.'-'.$fpath1;
		$result1 = move_uploaded_file($_FILES['subcatimg']['tmp_name'], $uploadDir1 . $newname1);
		if($result1)
		{
			if($mod==1)
			{
				$sqli="insert into tbl_cat(parent_id,cat_name,cat_img,created_by,cat_des,cat_rules,created_date,modified_date, mod_status, active) values ('$cat_id', '$subcatname', '$newname1', '$user_id', '$subcatdes','$subcatrules','$date', '$date', '1', 1)";
			}
			else
			{
				$sqli="insert into tbl_cat(parent_id,cat_name,cat_img,created_by,cat_des,cat_rules,created_date,modified_date, mod_status, active) values ('$cat_id', '$subcatname', '$newname1', '$user_id', '$subcatdes','$subcatrules','$date', '$date', '0', 1)";
			}		
		}
	}	
	echo $sqli;
	mysql_query($sqli);
	$last_insert_id1=mysql_insert_id();
	if($mod==1)
	{
		$sqlj="insert into tbl_mod (cat_id, user_id ) values ('$last_insert_id1', '$user_id')";
		mysql_query($sqlj);
	}
	header("Location:all-category.php");
}
//INSERT INTO `tbl_users` (`user_id`, `user_firstname`, `user_lastname`, `user_pass`, `user_email`, `user_country`, `user_region`) VALUES ('1', '', '', '', '', '', '');
?>
