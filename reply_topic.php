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
$reply1=addslashes($reply);
$datetime = "$year-$month-$date $hour:$min:$sec";
//echo $current_date;
if(isset($_POST['post_reply']))
{
$sql52="insert into tbl_answer (dis_id, user_id, created_date, answer) values ($dis_id, '$user_id', '$datetime', '$reply1' )";
echo $sql52;
mysql_query($sql52);
}
header('location:view_topic.php?dis_id='.$dis_id);
?>
