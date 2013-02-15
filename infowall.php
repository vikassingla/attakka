<?php include("header.php")?>
<?php
$cat_id=$_GET['cat_id'];
$user_id=$_SESSION['user_id'];
$sql2="select cat_name, cat_img, cat_parent_id, cat_des, cat_rules, cat_created_by from tbl_category where cat_id=".$cat_id;
//echo $sql2;
$rs2=mysql_query($sql2);
$row2=mysql_fetch_array($rs2);
if($row2['cat_parent_id']=="0")
{
$sql1="select rev_img from tbl_review_image where rev_cat_id=".$cat_id." order by RAND()";
//echo $sql1;
$rs1=mysql_query($sql1);
$row1=mysql_fetch_array($rs1);
if($row1['rev_img']=="")
{
	$src="images/norevimage.jpg";
}
else
{
	$src="review_images/".$row1['rev_img'];
}
}
else
{
	$src="cat_images/".$row2['cat_img'];
}	
$sql20="select user_firstname, user_lastname, account_image, user_id, facebook_id from tbl_user where user_id=".$row2['cat_created_by'];
//echo $sql20;
$rs20=mysql_query($sql20);
$row20=mysql_fetch_array($rs20);	
if($row20['facebook_id']=="")
{
	if($row20['account_image']!='')
	{
		$src5="uploads/".$row20['account_image'];
	}
	else
	{
		$sr5="images/red_img.png";
	}		
}
else
{
	if($row20['account_image']!='')
	{
		$src5="uploads/".$row20['account_image'];
	}
	else
	{
		$src5="http://graph.facebook.com/".$row20['facebook_id']."/picture?width=60&height=60";
	}	
}
$sqla="select fav_id from tbl_favorites where cat_id='$cat_id' and user_id='$user_id'";
$rsa=mysql_query($sqla);
if(mysql_num_rows($rsa)>0)
{
	$srca="images/vote/add_to_fav1.png";
}	
else
{
	$srca="images/vote/add_to_fav.png";
}	
$sqlb="select fan_id from tbl_fan where cat_id='$cat_id' and user_id='$user_id'";
$rsb=mysql_query($sqlb);
if(mysql_num_rows($rsb)>0)
{
	$srcb="images/vote/become_fan1.png";
}	
else
{
	$srcb="images/vote/become_fan.png";
}	
$sqlc="select vote_id from tbl_vote where cat_id='$cat_id' and user_id='$user_id' and vote=1";
//echo $sqlc;
$rsc=mysql_query($sqlc);
if(mysql_num_rows($rsc)>0)
{
	$srcc="images/vote/like1.png";
}	
else
{
	$srcc="images/vote/like.png";
}
$sqld="select vote_id from tbl_vote where cat_id='$cat_id' and user_id='$user_id' and vote=0";
$rsd=mysql_query($sqld);
if(mysql_num_rows($rsd)>0)
{
	$srcd="images/vote/unlike1.png";
}	
else
{
	$srcd="images/vote/unlike.png";
}
$sqle="select moderator_id from tbl_moderator where moderator_cat_id='$cat_id' and moderator_user_id='$user_id'";
$rse=mysql_query($sqle);
if(mysql_num_rows($rse)>0)
{
	$srce="images/vote/apply_mod1.png";
}	
else
{
	$srce="images/vote/apply_mod.png";
}
$sql39="select moderator_id, moderator_user_id from tbl_moderator where moderator_cat_id=".$cat_id." order by moderator_id desc limit 0,3";
$rs39=mysql_query($sql39);
//echo mysql_num_rows($rs39);
?>

<div class="internal-wrapper">

<div style="margin-top:100px;">  
<?php
if (isset($_GET['msg'])=='susub')
{	
$msg='Your voting for best pic has been submitted.';
echo '<div class="white-wrapper-error" style="margin-left:15%;width:554px;margin-top:100px;float:left;">'.$msg.'</div>';
}
?>
  <img src="<?php echo $src?>" alt="" class="image-border" />
		      
		      <h4 style="padding-left:10px;width:968px"><?php echo $row2['cat_name']?></h4></div>
			 
			 
			  <div class="clear"></div>
			  <div style="width:981px;float:left;height:15%;padding-top:7px;margin-top:10px; border: 5px solid #FFFFFF;box-shadow: 4px 3px 4px 1px #CCCCCC;paddng-top:">
			   
			   <a href="javascript:void(0)" onclick="xajax_favorites(<?php echo $cat_id?>)" style="float:left;margin-left:20%;margin-right:5px;"><img src="<?php echo $srca?>" id="favorites"></a>
				 <a href="javascript:void(0)" onclick="xajax_friend(<?php echo $cat_id?>)" style="float:left;margin-right:5px;"><img id="fan" src="<?php echo $srcb?>"></a>
				<div style="float:left; margin-right:100px;">
				 <a href="javascript:void(0)" onclick="xajax_upvote(<?php echo $cat_id?>)" style="float:left;"><img src="<?php echo $srcc?>" id="upvote"></a>
				 <img src="images/vote/vote.png" style="float:left">
				 <a href="javascript:void(0)" onclick="xajax_downvote(<?php echo $cat_id?>)" style="float:left"><img src="<?php echo $srcd?>" id="downvote"></a>
				 <a href="javascript:void(0)" onclick="xajax_moderator(<?php echo $cat_id?>)" style="float:left"><img src="<?php echo $srce?>" id="mod"></a>
				 </div>
			  </div>
			  
			  <div class="left-panel-infowall" <?php if($row2['cat_parent_id']!=0){ echo "style='display:none;'";} ?>>
			  <div class="top-heading-info">Vote for the best wallpic</div>
			  <form name="form1" id="form1" action="main.php" method="POST"> 
			  <input type="hidden" name="cat_id" value="<?php echo $cat_id?>">
			  <div id="wallPicDiv" style="float:left;">
			  
			  
			  <?php
			  $sql18="select rev_id, rev_img from tbl_review_image where rev_cat_id=".$cat_id." order by rev_rank";
			 // echo $sql18;
			  $rs18=mysql_query($sql18);
			  $n=mysql_num_rows($rs18);
			  $i=1;
			  
			  while($row18=mysql_fetch_array($rs18))
			{
			  
			  ?>
			  <div class="info-image-left views-field"><img src="review_images/<?php echo $row18['rev_img']?>" style="height:113px;width:276px;" alt="#" /></div>
			  <div class="box-rating" style="margin-top:6px"><?php echo $i?><sup style="font-size:6px;">o</sup></div>
			 
			  <div class="arrow-up">
			   <?php if($i>1)
			   {
				   ?>
			  <a href="javascript:void(0);" onclick="xajax_uporder(<?php echo $row18['rev_id']?>,<?php echo $i?>)">
			  <img src="images/arrow-up.png" alt="#" style="margin-bottom:20px;" />
			  <input type="hidden" name="pos[]" value=<?php echo $row18['rev_id']?>>
			  </a>
			  <?php 
			  }
			   if($i<$n)
			   {
				   ?>
				<a href="javascript:void(0);" onclick="xajax_downorder(<?php echo $row18['rev_id']?>,<?php echo $i?>)">
			  <img src="images/arrow-down.png" alt="#" style="margin-bottom:20px;" />
			  <input type="hidden" name="pos[]" value=<?php echo $row18['rev_id']?>>
			  </a>
<?php
		}
		?></div>
<div class="clear"></div>
			<?php
			$i++;
			}?>
 </div>
<div><input type="submit" name="review_image" value="Submit Image" class="red-button-newnov19" style="cursor:pointer;"></a></div>
</div>
</form>
			  <div class="round-box-info" <?php if($row2['cat_parent_id']!=0){echo "style='width:838px;'";} ?>>
			  <div style="padding:15px;">
			  <div class="red-color-headinginfo">INFo<span class="black-color-heading"> Page</span></div>
			  <div class="topheading-boxinfo">Description:</div>
			  <div class="regular-text-info"><?php echo $row2['cat_des']?>
</div>
<div class="clear"></div>
<div><img src="images/shadow-line.png" alt="#"  style="margin-top:45px; margin-bottom:45px;"/></div>
<div class="clear"></div>

<div class="topheading-boxinfo">Rules</div>
			  <div class="regular-text-info">
			  <?php echo $row2['cat_rules']?>
			  <br />
<br />

</div>
<div class="clear"></div>
<div align="right"><a href="discuss_it.php?cat_id=<?php echo $cat_id?>" style="margin-top:130px;" class="red-button-newnov19discuss">Discuss It</a></div>
			  
			  </div>
			  </div>
			  <div class="round-panel-rightinfo">
			  <div style="padding:10px;">
			  <div class="red-text-smallinfo" style="text-align:center">The Authority</div>
			  <div class="user-image-left views-field"><img src="<?php echo $src5?>" alt="#" style="height:80px;width:112px;"/></div>
			  <div class="name-text-small"><?php echo $row20['user_firstname']." ".$row20['user_lastname']?> </div>
			  <div class="clear"></div>
			  <div class="red-text-biginfo">MODs</div>
			  <div id="moder" name="moder">
			  <?php
			  while($row39=mysql_fetch_array($rs39))
			  {
				$sql40="select user_firstname, user_lastname, account_image, facebook_id from tbl_user where user_id=".$row39['moderator_user_id'];
				$rs40=mysql_query($sql40);
				$row40=mysql_fetch_array($rs40);
				if($row40['facebook_id']=="")
				{
					if($row40['account_image']!='')
					{
						$msrc="uploads/".$row40['account_image'];
					}
					else
					{
						$msrc="images/red_img.png";
					}		
				}
				else
				{
					if($row40['account_image']!='')
					{
						$msrc="uploads/".$row40['account_image'];
					}
					else
					{
						$msrc="http://graph.facebook.com/".$row40['facebook_id']."/picture?width=112&height=80";
					}	
				}  
			  ?>
			  <div class="user-image-left views-field"><img src="<?php echo $msrc?>" alt="#" style="height:80px;width:112px;"/></div>
			  <div class="name-text"><?php echo $row40['user_firstname']." ".$row40['user_lastname']?></div>
			  <div class="clear"></div>
			<?php
				}
			?>
			</div>
			  <div><a href="sub_cat.php?cat_id=<?php echo $cat_id;?>" class="red-button-newnov19new">Suggest a <br />
subcategory</a></div>
			  <div class="clear"></div>
			   <div style="margin-top:10px;"><a href="Moderator-Page.html"class="red-button-newnov19new">Moderators<br />
Wanted</a></div>
			   <div class="how-heading">How we doing?</div>
			   <div align="center"><img src="images/small-arrow-up.png" alt="#" style="margin-top:4px;" /></div>
			      <div align="center"><img src="images/rate/rate4-small.png" alt="#" style="margin-top:4px;" /></div>
				     <div align="center"><img src="images/arrow-down-small.png" alt="#" /></div>			  
			  </div>
			  
			  </div>
<?php include("footer.php")?>
