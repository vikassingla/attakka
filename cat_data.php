<?php

require("config.php");
session_start();
if($_GET['type']=='all')
{
	$sql="select review_id, review_title from tbl_review where review_cat_id=".$_GET['cat_id']." order by review_id desc";
	//echo $sql;die;
	$rs=mysql_query($sql);
	if(mysql_num_rows($rs)>0)
	{
		while($row=mysql_fetch_array($rs))
		{
			print '<div id="catnamediv'.$row['review_id'].'" class="rev_div" onmouseover="setCatColor('.$row['review_id'].');" onmouseout="hideCatColor('.$row['review_id'].');" onclick="setCatText(\''.$row['review_title'].'\','.$row['review_id'].');">'.$row['review_title'].'</div>';
		}
	}
	//die('hereeee');
}
else if($_GET['type']=='bytxt')
{
	//echo 'ddddddd'.$_GET['reviewtitle'];
	//echo "M IN ELSE".$_GET['type'];die;
	//echo '<pre>';
	//print_r($_POST);die;
	$catid=$_GET['cat_id'];
	$cat = $_GET['reviewtitle'];
	$sql="select review_id, review_title from tbl_review where review_title like '%$cat%' and review_cat_id='".$_GET['cat_id']."'  order by review_id desc";
	//echo $sql;
	
	$rs=mysql_query($sql);
	if(mysql_num_rows($rs)>0)
	{
		while($row=mysql_fetch_array($rs))
		{
			print '<div id="catnamediv'.$row['review_id'].'" class="rev_div" onmouseover="setCatColor('.$row['review_id'].');" onmouseout="hideCatColor('.$row['review_id'].');" onclick="setCatText(\''.$row['review_title'].'\','.$row['review_id'].');">'.$row['review_title'].'</div>';
		}

	}
	else
	{
		//echo 'GET VALUE IS '.$_GET['create_flag'];die;
		$newId=100001;
		if(!empty($cat))
		{
			print '<div id="catnamediv'.$newId.'" class="rev_div" onmouseover="setCatColor('.$newId.');" onmouseout="hideCatColor('.$newId.');" onclick="addNewReview();">'.$cat.' (Create New) </div>';
		}
	}
}
?>
