<?php
require("config.php");
session_start();
if(isset($_GET['check_flag']) && $_GET['check_flag']==1)
{
	$res='';
	$cat=$_GET['catinput'];
	$create=checkReview($cat);
	if(!$create)
	{
		$res='review not exist';
	}
	else
	{   
		if(!empty($cat))
		{
			$review_id=getReviewIdFromName($cat);
		}
		if(!empty($review_id))
		{
			$total=getReviewByUser($review_id);
		}
		//$res='review exist';
		$res=$total;
	}
	echo $res;
	//echo $create;
	
}
?>
