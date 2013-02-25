<?php include("header.php");?>
<?php 
if(empty($_GET))
{
	print '
	<script>
	window.location.href="all_category.php";
	</script>
	';
}	
else
{
	$rev_id=$_GET['review_id'];
	$exist=checkReviewId($rev_id);	
	if($exist=="0")
	{
		print '
		<script>
		window.location.href="all_category.php";
		</script>
		';
	}
	else
	{
	$detail=reviewDetail($rev_id);		
	if($detail['review_img']!="" && file_exists('review_images/'.$detail['review_img']))
	{
		$ban_img='review_images/'.$detail['review_img'];
	}	
	else
	{
		$ban_img='images/norevimage.jpg';
	}	
	$rate=rate($rev_id);
	}	
	
}	
$user=$detail['review_created_by'];
$owner=user_detail($user);
$thumb_w='';
$thumb_h='';

if($owner['facebook_id']=="")
{
	if($owner['profile_image']!='')
	{
		$src3="uploads/".$owner['profile_image'];
		if(file_exists($src3))
		{
			$src3="uploads/".$owner['profile_image'];
		}
		else
		{
			$src3="images/no_img.png";
		}
	}
	else
	{
		$src3="images/no_img.png";
	}		
}
else
{
	if($user['profile_image']!='')
	{
		$src3="uploads/".$owner['profile_image'];
	}
	else
	{
		//$src3="http://graph.facebook.com/".$row['facebook_id']."/picture?width=60&height=60";
		$src3="http://graph.facebook.com/".$owner['facebook_id']."/picture?type=large";
		
		list($width, $height, $type, $attr) = @getimagesize($src3);
															   
		$newheight = 127;
		$newwidth = 219;        
													   
		if ($width>$newwidth || $height>$newheight)
		{
			   $thumb_w=$newwidth;
			   $thumb_h=$newheight;
			   
			   if ($thumb_w/$width*$height>$thumb_h) 
			   {
					   $thumb_w = round($thumb_h*$width/$height); 
			   }
			   else 
			   {
					   $thumb_h = round($thumb_w*$height/$width);
			   }
		} 
		else
		{
			   $thumb_w=$width;
			   $thumb_h=$height;
		}  		
		
		$thumb_w='width:'.$thumb_w.'px;';
		$thumb_h='height:'.$thumb_h.'px;';		
	}	
}
$freview=firstopinion($rev_id, $owner['user_id']);
if($freview)
{
	$frate=$freview['review_rate'];
	if($freview['review_rate']=="-0")
	{
		$frate=0;
	}	
	$frimg="images/rate/bigrate$frate.png";
}
else
{
	$frimg="images/rate/no-rate.png";
	$freview['review_opinion']="No Opinion by owner";
	$freview['review_description']="No description by owner";
}	
?>
<div class="internal-wrapper">
<div style="margin-top:100px;position:relative;">
 <a href="Infowall-Review.html"> <img src="<?php echo $ban_img?>" alt="" class="image-border"  border="0"/></a>
  <h7 style="padding-left:10px; color: rgb(0, 0, 0); position: absolute; top: 231px; z-index: 10;width:970px;"><?php echo $detail['review_title']?></h7>
			  <div class="rate-icontop" align="right"><img src="<?php echo $rate?>" alt="" class="rate-shadow" /></div>
  </div>
  <div class="clear"></div>
  <div style="padding-bottom:10px; padding-top:20px;"><img src="images/fusion-banner.png" alt="" /></div>
  <div class="clear"></div>
  <div class="grey-round-bar heading-black topheading-CRITICA" align="center">
			  CRITICA MOR
  </div>
			   <div class="clear"></div>
			  
			  	<!--row 1-->
			 <div class="border-round">
             
             
             <div class="views-field round-imgred13-2012" style="marlgin-bottom:10px; margin-left:10px;"><img src="<?php echo $src3?>"  alt="" style="width:219px;height:127px;"/><div class="nametop-heading-box-review"><?php echo $owner['user_firstname']." ". substr($owner['user_lastname'],0,1)."."?> </div></div>
             
             <div class="message-box-back">
             <div style="padding:15px;">
               <div class="panel-left-new middle-text-review-new13-2012">
               <?php echo $freview['review_opinion']?>
               </div>
             <div class="rate-panel-right-new13-2012"><img src="<?php echo $frimg?>" alt="#" class="rate-img-new-new13-2012" style="margin-top:-7px" /></div>
             
             </div>
             
             </div>
             
             <div class="clear"></div>
             
             <div class="middle-text-review-small" style="padding:15px;">
              <?php echo $freview['review_description']?>
             <!--<img src="images/arrow-down-grey.png" alt="#" style="margin-bottom:-5px;" />--></div>

<div class="clear"></div>

<div class="border-round-reviewnew"><div style="padding:5px;"><div class="button-right-new"><a href="#" class="comentar-btrn">comentar</a></div> 
<div class="grey-panelnew13-2012"><img src="images/left-arrow-new.png" alt="#" />&nbsp;<img src="images/right-arrownew.png" alt="#" /></div>
<div class="footer-panel-right13-2012"><img src="images/star-icon.png" alt="#" /> <img src="images/facebook-icon.png" alt="#" />  <img src="images/twitter-icon.png" alt="#" />  <img src="images/gplus-icon.png" alt="#" /></div>

</div></div>
             
             </div>
	<!--row 1-->
    
    
    <!--you-may-panel-->
    
    <div class="youmaypanelnov20"><h12>YOU MAY ALSO LIKE</h12></div>
    
    	<div class="clear"></div>
	<!--	
  <div style="margin-bottom:10px;"><iframe src="images-scroller-inside.html" allowtransparency="0" frameborder="0" height="115px" width="1045px"></iframe></div>
		 -->
		 <div class="clear"></div>
    
    <!--you-may-panel-->
    
    <!--buttons-top--> 
    <div class="grey-round-barnew19nov"><div style="padding:5px;"><a style="text-decoration:none;" class="black-button" href="#">HOT</a><a href="#" class="grey-buttonnov19">NEW</a> <a href="#" class="grey-buttonnov19" style="margin-right:86px;">Favorites</a> <a href="#" class="grey-buttonnov19">Positive 12</a> <a href="#" class="grey-buttonnov19">Negative 30</a> <a href="#" class="grey-buttonnov19" style="margin-right:80px;">Negative 60</a> <a href="#"  class="grey-buttonnov19" >reviews 25</a> <a href="#" class="black-button">opinions 112</a></div></div>
     <!--buttons-top--> 
     <?php 
     $rec=allRecOp($rev_id, $owner['user_id']);
     if(count($rec)>0)
     {
    foreach($rec as $cmt)
    {
		$crate=$cmt['review_rate'];
		if($crate=="-0")
		{
			$crate=0;
		}	
		$cimg="images/rate/bigrate$crate.png";
		$cuser=user_detail($cmt['created_by']);
		//print_r($cuser);
		if($cuser['facebook_id']=="")
		{
			if($cuser['profile_image']!='')
			{
				$srcc="uploads/".$cuser['profile_image'];
				if(file_exists($srcc))
				{
					$srcc="uploads/".$cuser['profile_image'];
				}
				else
				{
					$srcc="images/no_img.png";
				}
			}
			else
			{
				$srcc="images/no_img.png";
			}		
		}
		else
		{
			if($cuser['profile_image']!='')
			{
				$srcc="uploads/".$cuser['profile_image'];
			}
			else
			{
				//$src3="http://graph.facebook.com/".$row['facebook_id']."/picture?width=60&height=60";
				$srcc="http://graph.facebook.com/".$cuser['facebook_id']."/picture?type=large";
				
				list($width, $height, $type, $attr) = @getimagesize($src3);
																	   
				$newheight = 127;
				$newwidth = 219;        
															   
				if ($width>$newwidth || $height>$newheight)
				{
					   $thumb_w=$newwidth;
					   $thumb_h=$newheight;
					   
					   if ($thumb_w/$width*$height>$thumb_h) 
					   {
							   $thumb_w = round($thumb_h*$width/$height); 
					   }
					   else 
					   {
							   $thumb_h = round($thumb_w*$height/$width);
					   }
				} 
				else
				{
					   $thumb_w=$width;
					   $thumb_h=$height;
				}  		
				
				$thumb_w='width:'.$thumb_w.'px;';
				$thumb_h='height:'.$thumb_h.'px;';		
			}	
		}
     ?>
     <div class="images-left-panel-review13-2012 views-field review-new"><img src="<?php echo $srcc?>" style="width:219px;height:127px;" alt="#" /><div class="nametop-heading-box-review"><?php echo $cuser['user_firstname']." ".substr($cuser['user_lastname'], 0, 1)."."?></div></div>
     
     <div class="message-box-back-big">
             <div style="padding:15px;">
               <div class="panel-left-new middle-text-review-new13-2012new"><?php echo $cmt['review_opinion']?></div>
             <div class="rate-panel-right-new13-2012"><img src="<?php echo $cimg?>" alt="#" class="rate-img-new-new13-2012new" /></div>
             
             </div>
             
             </div>
     
     <!--row2-->
     <div class="clear"></div>
    <?php
	}
	}
	else
	{
		echo "No review till";
	}	
    ?>
             
             </div>
 <?php include("footer.php")?>
