<?php
require("config.php");
session_start();
if(isset($_GET['create_flag']) && $_GET['create_flag']==1)
{
	//echo '<pre>';
	//print_r($_GET);die;
	$catid=$_GET['hidcatid'];
	$cat=$_GET['catinput'];
	$create=createNewReview($catid,$cat);
	//echo $create;
	
}
?>
