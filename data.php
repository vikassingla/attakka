<?php
include("header.php");
/*echo "<pre>";
print_r($_REQUEST);*/
$catname=$_REQUEST['cat'];
$date=date('Y-m-d');
$user_id=$_SESSION['user_id'];
$sql="insert into tbl_category(cat_parent_id,cat_name, cat_created_by,cat_created_date,cat_modified_date, cat_mod_status,cat_active) values (0, '$catname', '$user_id', '$date', '$date', '0', 1)";
echo $sql;
mysql_query($sql);
	
?>
