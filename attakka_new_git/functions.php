<?php
function isCreategoryExist($catname)
{
	$sql3="select cat_name from tbl_category where cat_name='$catname'";
	$rs3=mysql_query($sql3);
	if(mysql_num_rows($rs3)>0)
	{
		return true;
	}
	else
	{
		return false;
	}
}
function isReviewExist($catname, $catid)
{
	$sql3="select review_title from tbl_review where review_title='$catname' and review_cat_id=".$catid;
	//echo $sql3;
	$rs3=mysql_query($sql3);
	if(mysql_num_rows($rs3)>0)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}
function isCreategoryIdExist($catid)
{
	$sql6="select cat_name from tbl_category where cat_id='$catid'";
	//echo $sql6;
	$rs6=mysql_query($sql6);
	if(mysql_num_rows($rs6)>0)
	{
		return false;
	}
	else
	{
		return true;
	}
}
function createCategory($catname, $cat_img, $ban_img, $catrules, $catdes, $cat_ref, $created_by, $created_date, $modified_date, $mod_status, $cat_active, $is_cat_neighbour, $cat_neighbour)
{
	$sql4="insert into tbl_category (cat_name, cat_img, cat_banner_img, cat_des, cat_rules, cat_ref, cat_created_by, cat_created_date, cat_modified_date, cat_mod_status, cat_active, is_cat_neighbour, cat_neighbour) values('$catname', '$cat_img', '$ban_img', '$catrules', '$catdes', '$cat_ref', '$created_by', '$created_date', '$modified_date', '$mod_status', '1', '$is_cat_neighbour', '$cat_neighbour')";
	mysql_query($sql4);
	$last_insert_id=mysql_insert_id();
	return $last_insert_id;
}	
function createFilter($cat_id, $filter_name, $filter_value, $filter_active)
{
	$sql5="insert into tbl_category_filters (cat_id, filter_name, filter_value, is_active) value ($cat_id, '$filter_name', '$filter_value', 1)";
	//echo $sql5;

	mysql_query($sql5);
	$last_insert_id=mysql_insert_id();
	if($last_insert_id)
	{
		return true;
	}
	else
	{
		return false;
	}
}
function getAllFilters()
{
	$res=array();
	$sql="select filter_name,filter_id from  tbl_filters";
	//echo $sql;die;
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		while($row=mysql_fetch_assoc($result))
		{
			$res[]=$row['filter_id'].'_'.$row['filter_name'];
		}	
	}
	return $res;
}
function filtername($catid)
{
	$res=array();
	$sql="select filter_id,filter_name from  tbl_filters where filter_id in (select filter_id from tbl_category_filters where cat_id=".$catid.") order by filter_id desc limit 0,5";
	//echo $sql;
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		while($row=mysql_fetch_assoc($result))
		{
			$res[]=$row['filter_name'].'='.$row['filter_id'];
		}	
	}
	return $res;
}		
function filtervalue($filterid)
{
	$sql="select option_value from  tbl_category_filters where filter_id=".$filterid;
	//echo $sql;
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		while($row=mysql_fetch_assoc($result))
		{
			$res=$row['option_value'];
		}	
	}
	return $res;
}

function getAllFilterOption()
{
	$res=array();
	$sql="select option_value from  tbl_category_filters";
	//echo $sql;die;
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		while($row=mysql_fetch_assoc($result))
		{
			$res[]=$row['option_value'];
			$str_val=implode(",", $res);
		}	
		
	}
	return $str_val;
}

function getAlloptions()
{
 $sql="select filter_value from tbl_category_filters";
 $result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		while($row=mysql_fetch_assoc($result))
		{
			$res[]=$row['filter_value'];
		}	
		return $res;
	}
}
function getUserDetail()
{
	$row=array();
	$sql="select user_firstname, user_lastname,user_country, account_image, profile_image, facebook_id from tbl_user where user_id=".@$_SESSION['user_id'];
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		$row=mysql_fetch_assoc($result);
	}
	return $row;
}	
function getCategoryDetail($cat_id)
{
	$row=array();
	$sql="select * from tbl_category where cat_id=$cat_id";
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		$row=mysql_fetch_assoc($result);
	}
	return $row;
}
function createReview( $catid, $rname, $user, $date)
{
	$sql4="insert into tbl_review (review_cat_id, review_title, review_created_by, review_created_date, review_active) values( '$catid','$rname',  '$user', '$date', '1')";
	mysql_query($sql4);
	$last_insert_id=mysql_insert_id();
	return $last_insert_id;
}
function createNewReview($catid,$reviewname)
{
	$user=$_SESSION['user_id'];
	$sql="insert into tbl_review (review_cat_id, review_title, review_created_by, review_created_date, review_active)values($catid,'$reviewname',$user,now(),1)";
	//echo $sql;die;
	mysql_query($sql);
	$last_insert_id=mysql_insert_id();
	return $last_insert_id;
}
function checkReview($rev)
{
	$sql="select review_title from  tbl_review where review_title='$rev'";
	//echo $sql;die;
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		
		return true;
	}
	else
	{
		return false;
	}
}
function reviewInfo($name, $cat_id)	
{
	$row=array();
	$sql="select review_title, review_id, review_img, review_cat_id from tbl_review where review_title='".$name."' and review_cat_id=".$cat_id;
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		$row=mysql_fetch_assoc($result);
	}
	return $row;
}	
function createRev($id,$revopin,$revdes,$user_id,$date,$rate)
{
	$sql="INSERT INTO tbl_review_map (review_id,review_opinion,review_description,created_by, created_date, review_rate) values ('$id', '$revopin', '$revdes','$user_id', '$date', '$rate')";
	//echo $sql;
	mysql_query($sql);
	$last_insert_id=mysql_insert_id();
	return $last_insert_id;
}
function getReviewByUser($review_id)
{
	$row=array();
	$total=0;
	$user_id=$_SESSION['user_id'];
	$sql="select count(trm.review_id ) as total
	from tbl_review_map trm,tbl_review tbr
	where trm.review_id=tbr.review_id
	AND trm.review_id =$review_id
	and trm.created_by=$user_id";
	//echo $sql;die;
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		$row=mysql_fetch_assoc($result);
		$total=$row['total'];
		//$total=mysql_num_rows($result);
	}
	return $total;
	
}	

function getReviewIdFromName($rev)
{
	$review_id='';
	$sql="select review_id from  tbl_review where review_title='$rev'";
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		$row=mysql_fetch_assoc($result);
		$review_id=$row['review_id'];
	}
	return $review_id;
}
?>
