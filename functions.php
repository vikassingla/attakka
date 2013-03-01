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
	//echo $sql3;die;
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
function user_detail($userid)
{
	$row2=array();
	$sql2="select user_id, user_firstname, user_lastname, profile_image, facebook_id from tbl_user where user_id=".$userid;
	$res2=mysql_query($sql2);
	if(mysql_num_rows($res2)>0)
	{
		$row2=mysql_fetch_assoc($res2);
	}
	return $row2;
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
function checkReviewId($rev)
{
	$sql="select review_id from  tbl_review where review_id='$rev'";
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
function reviewDetail($rev_id)	
{
	$row=array();
	$sql="select review_title, review_id, review_img, review_cat_id, review_created_by from tbl_review where review_id=".$rev_id;
	//echo $sql;
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		$row=mysql_fetch_assoc($result);
	}
	return $row;
}

function createRev($id,$revopin,$revdes,$user_id,$date,$rate,$img)
{
	if($img!="")
	{
		$sql1="update tbl_review set review_img='".$img."' where review_id=".$id;
		echo $sql1;
		mysql_query($sql1);
	}	
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
function rate($rev_id)
{
	$sql1="select count(review_rate) as num, sum(review_rate) as sum from tbl_review_map where review_id=".$rev_id;
	//echo $sql1;
	$rs1=mysql_query($sql1);
	$row1=mysql_fetch_array($rs1);
	if($row1['num']=="0")
	{
		$img="images/rate/no-rate.png";
	}
	else
	{	
		$rate=$row1['sum'];
		$no=$row1['num'];
		//echo $rate." ".$no;
		$avgrate=$rate/$no;
		if(is_float($avgrate))
		{
			$avg_rate=number_format(($rate/$no),1);
			$explode_avg=explode('.',$avg_rate);
			if($explode_avg[1]>=5)
			{
				$avg_rate=ceil($rate/$no);
			}
			else
			{
				$avg_rate=floor($rate/$no);
			}
		}
		else
		{
			$avg_rate=$avgrate;
		}
		if($avg_rate=="-0")
		{
			$avg_rate="0";
		}
		$img="images/rate/middlerate$avg_rate.png";
	
	}
	return $img;
}	
function firstopinion($revid,$userid)
{
	$row3=array();
	$sql3="select review_opinion, review_description, review_rate from tbl_review_map where review_id=".$revid." and created_by=".$userid;
	//echo $sql3;
	$result3=mysql_query($sql3);
	if(mysql_num_rows($result3)>0)
	{
		$row3=mysql_fetch_assoc($result3);
	}
	return $row3;
}
function allRecOp($revid, $userid)
{
	$res=array();
	$sql5="select review_opinion, review_rate,review_description, created_by from tbl_review_map where review_id=".$revid." and created_by!=".$userid;
    $rs5=mysql_query($sql5);
    if(mysql_num_rows($rs5)>0)
	{
		while($row=mysql_fetch_assoc($rs5))
		{
			$res[]=$row;
		}	
		return $res;
	}
}

function getReviewOfUserTotal()
{
	$row_array=array();
	$user_id=$_SESSION['user_id'];
	$sql="select trm.*,tbr.* ,tc.cat_img,tc.cat_name	
	from tbl_review_map trm,tbl_review tbr,tbl_category tc
	where trm.review_id=tbr.review_id
	and tbr.review_cat_id=tc.cat_id 	
	and trm.created_by=$user_id";
	//echo $sql;die;
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		//return mysql_num_rows($result);
		while($row=mysql_fetch_assoc($result))
		{
			$row_array[]=$row;
	    }
	}
	return count($row_array);
	
}

function getReviewOfUser($start,$limit,$user_id)
{
	$row_array=array();
	$sql="select trm.*,tbr.* ,tc.cat_img,tc.cat_name	
	from tbl_review_map trm,tbl_review tbr,tbl_category tc
	where trm.review_id=tbr.review_id
	and tbr.review_cat_id=tc.cat_id 	
	and trm.created_by=$user_id
	limit $start,$limit";
	//echo $sql;die;
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		while($row=mysql_fetch_assoc($result))
		{
			$row_array[]=$row;
	    }	//$total=mysql_num_rows($result);
	}
	return $row_array;
	
}
function getFavouriteCategoryOfUser($user_id)
{	
	$row_array=array();
	$sql="select cat_id from tbl_favorites
	where user_id=$user_id";
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		while($row=mysql_fetch_assoc($result))
		{
			$row_array[]=$row['cat_id'];
	    }	//$total=mysql_num_rows($result);
	}
	return $row_array;
}		
function getFavouriteReviewOfUser($user_id,$cat_id)
{
	$row_array=array();
	$sql="select trm.*,tbr.* ,tc.cat_img,tc.cat_banner_img,tc.cat_name,tc.cat_id,avg(trm.review_rate) as rat	
	from tbl_review_map trm,tbl_review tbr,tbl_category tc
	where trm.review_id=tbr.review_id
	and tbr.review_cat_id=tc.cat_id 
	and trm.created_by=$user_id
	and tbr.review_cat_id=$cat_id
	group by trm.review_id";
	//echo $sql;
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		while($row=mysql_fetch_assoc($result))
		{
			$row_array[]=$row;
	    }	//$total=mysql_num_rows($result);
	}
	return $row_array;	
}
function getBest($catid, $mode)	
{
	$rs=array();
	$sql="SELECT trm.review_id,count(trm.review_id) as reviews,sum(trm.review_rate) as total,tbr.review_title,tbr.review_img,avg(trm.review_rate) as avg from tbl_review tbr,tbl_review_map trm
	where tbr.review_id=trm.review_id and tbr.review_cat_id=".$catid." and tbr.review_active=1 group by trm.review_id order by avg ".$mode." limit 0, 5";
	$rs=mysql_query($sql);
    if(mysql_num_rows($rs)>0)
	{
		while($row=mysql_fetch_assoc($rs))
		{
			$res[]=$row;
		}	
		return $res;
	}
}	
function getCategoryFromId($catid)
{
	$res=array();
	$sql="select * from tbl_category where cat_id=$catid";
	$rs=mysql_query($sql);
    if(mysql_num_rows($rs)>0)
	{
		while($row=mysql_fetch_assoc($rs))
		{
			$res[]=$row;
		}	
		return $res;
	}
}
function getAllReviewsOfCategory($cat_id,$start,$limit)
{
	if(isset($_GET['mod']))
	{
		$mod=$_GET['mod'];
		if($mod=='hot')
		{
			$sortby='review_rate';
		}
		else if($mod=='new')
		{
			$sortby='created_date';
		}
	}
	else
	{
		$sortby='review_rate';
	}
	$res=array();
	$sql="select trm.*,tbr.*	
	from tbl_review_map trm,tbl_review tbr
	where trm.review_id=tbr.review_id
	and tbr.review_cat_id=$cat_id
	order by trm.$sortby desc
	limit $start,$limit";
	//echo $sql;
	$rs=mysql_query($sql);
    if(mysql_num_rows($rs)>0)
	{
		while($row=mysql_fetch_assoc($rs))
		{
			$res[]=$row;
		}	
		return $res;
	}
}


function getAllReviewsOfCategoryTotal($cat_id)
{
	$row_array=array();
	$sql="select trm.*,tbr.*	
	from tbl_review_map trm,tbl_review tbr
	where trm.review_id=tbr.review_id
	and tbr.review_cat_id=$cat_id";
	//echo $sql;die;
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		//return mysql_num_rows($result);
		while($row=mysql_fetch_assoc($result))
		{
			$row_array[]=$row;
	    }
	}
	return count($row_array);
	
}

function getBestOfAllCategory($mode)	
{
	$rs=array();
	$sql="SELECT trm.review_id,count(trm.review_id) as reviews,sum(trm.review_rate) as total,tbr.review_title,tbr.review_img,avg(trm.review_rate) as avg ,tc.cat_img,tc.cat_name
	from tbl_review tbr,tbl_review_map trm,tbl_category tc
	where tbr.review_id=trm.review_id 
	and tbr.review_cat_id=tc.cat_id  
	and tbr.review_active=1 
	group by tbr.review_cat_id 
	order by avg ".$mode."
	 limit 0, 5";
	 //echo $sql;
	$rs=mysql_query($sql);
    if(mysql_num_rows($rs)>0)
	{
		while($row=mysql_fetch_assoc($rs))
		{
			$res[]=$row;
		}	
		return $res;
	}
}
function getAllCategoryDetail()
{
	$row=array();
	$sql="select * from tbl_category";
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		$row=mysql_fetch_assoc($result);
	}
	return $row;
}


function getAllReviewsOfAllCategory($start,$limit,$mod)
{
	if(isset($_GET['mod']))
	{
		$mod=$_GET['mod'];
		if($mod=='hot')
		{
			$sortby='review_rate';
		}
		else if($mod=='new')
		{
			$sortby='created_date';
		}
	}
	else
	{
		$sortby='review_rate';
	}
	$res=array();
	$sql="select trm.*,tbr.*,tbc.*	
	from tbl_review_map trm,tbl_review tbr,tbl_category tbc
	where tbr.review_id=trm.review_id
	and tbr.review_cat_id=tbc.cat_id
	order by trm.$sortby desc
	limit $start,$limit";
	//echo $sql;
	$rs=mysql_query($sql);
    if(mysql_num_rows($rs)>0)
	{
		while($row=mysql_fetch_assoc($rs))
		{
			$res[]=$row;
		}	
		return $res;
	}
}


function getAllReviewsOfAllCategoryTotal()
{
	$row_array=array();
	$sql="select trm.*,tbr.*,tbc.*	
	from tbl_review_map trm,tbl_review tbr,tbl_category tbc
	where trm.review_id=tbr.review_id
	and tbr.review_cat_id=tbc.cat_id";
	//echo $sql;die;
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		//return mysql_num_rows($result);
		while($row=mysql_fetch_assoc($result))
		{
			$row_array[]=$row;
	    }
	}
	return count($row_array);
	
}
?>
