<?php
include("header.php");
echo "<pre>";
print_r($_REQUEST);
$subcatname=$_REQUEST['subcatname'];
$catname=$_REQUEST['catname'];
$date=date('Y-m-d');
$user_id=$_SESSION['user_id'];
$sql="insert into tbl_category(cat_parent_id,cat_name, cat_created_by,cat_created_date,cat_modified_date, cat_mod_status,cat_active) values ( '$catname', '$subcatname', '$user_id', '$date', '$date', '0', 1)";
mysql_query($sql);
	
?>
