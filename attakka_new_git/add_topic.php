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
echo "<pre>";
print_r($_POST);
extract($_POST);
$info = getdate();
print_r($info);
$date = $info['mday'];
$month = $info['mon'];
$year = $info['year'];
$hour = $info['hours'];
$min = $info['minutes'];
$sec = $info['seconds'];

$datetime = "$year-$month-$date $hour:$min:$sec";
//echo $current_date;
if(isset($_POST['create_subject']))
{
$sql43="INSERT INTO tbl_discuss(dis_cat_id, dis_subject, created_by, created_date, modified_date)VALUES('$cat_id', '$sub', '$user_id', '$datetime', '$datetime')";
echo $sql43;
mysql_query($sql43);

$last_insert_id7=mysql_insert_id();
$sql46="insert into tbl_answer (dis_id, user_id, created_date, answer) values ($last_insert_id7, '$user_id', '$datetime', '$reply' )";
mysql_query($sql46);
}
header('location:discuss_it.php?cat_id='.$cat_id);
?>
