<?php
include('config.php');
session_start();
if(isset($_GET['cat_val']))
{
	$cat_val=$_GET['cat_val'];
	$review_id=$_GET['review_id'];
	$getCount=getReviewByUser($review_id);
	echo $getCount;
}

?>
