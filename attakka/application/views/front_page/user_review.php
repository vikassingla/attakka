
<div class="internal-wrapper">
<div style="margin-top:100px;">
 <a href="javaScript:void(0);"> <img src="images/possesion-banner.png" alt="" class="image-border"  border="0"/></a>
  <h7 style="padding-left:10px;">The Possession</h7>
			  <div class="rate-icontop" align="right"><img src="images/rate/rate-4.png" alt="#" class="rate-shadow" /></div>
  </div>
  <div class="clear"></div>
  <div style="padding-bottom:10px; padding-top:20px;"><img src="images/createfree-banner.png" alt="#" /></div>
  <div class="clear"></div>
  <div class="grey-round-bar heading-black topheading-CRITICA" align="center">
			  CRITICA MOR
  </div>
			   <div class="clear"></div>
			  
			  	<!--row 1-->
			 <div class="border-round">
             
             
             <div class="views-field round-imgred13-2012" style="marlgin-bottom:10px; margin-left:10px;">
             
             
            <?php  
if(!empty($review_data))
{
	 $userinfo = $this->user_model->get_user_deatil_by_user_id($review_data['creator_id'],"tbl_user");
    $image_path = "";
	
   
	 
	  
   $image_path = "user_profile_image/".$userinfo['user_image_name']; 

if(trim($userinfo['user_image_name'])!=""){
if(file_exists($image_path))
	{
		
?>
   
    
        <img src="create_thumbnail_image.php?file=<?php echo $image_path;?>&maxw=219&maxh=127" width="219" height="127"  border="0" />
        
        <?php 
        
    }else{
		?>
<img alt="" src="images/user-pic-big.png">
<?php } ?>

	<?php	
		
}
else{
?>
<img alt="" src="images/user-pic-big.png">
<?php } ?>
             
             
             
             <div class="nametop-heading-box-review">
			 
			 <?php 

if(!empty($review_data))
{
 
 echo ucfirst($userinfo['user_first_name'])." "; echo ucfirst(substr($userinfo['user_last_name'],0,1)); }?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></div>
             
             <div class="message-box-back">
             <div style="padding:15px;">
               <div class="panel-left-new middle-text-review-new13-2012"><?php echo $review_data['review_title'];?></div>
               
                    
               <?php
	//echo  find_image_name_review($detail_topic['review_rate']);
	$topic_id = $review_data['topic_id'];
	$category_or_subcategory = $review_data['category_or_subcategory'];

	
   $rate = get_topic_rate($topic_id,$category_or_subcategory);
	$rate_image = find_image_name_review($rate);
?>



             <div class="rate-panel-right-new13-2012"><img src="images/rate/<?php echo $rate_image;?>" alt="#" class="rate-img-new-new13-2012" style=" float:right; margin-right:5px; width:104px"  /></div>
             
             
          
             
             </div>
             
             </div>
             
             <div class="clear"></div>
             
             <div class="middle-text-review-small" style="padding:15px;"><?php echo $review_data['review_description'];?>.<img src="images/arrow-down-grey.png" alt="#" style="margin-bottom:-5px;" /></div>
<?php } ?>
<div class="clear"></div>

<div class="border-round-reviewnew"><div style="padding:5px;"><div class="button-right-new"><!--<a href="#" class="comentar-btrn">comentar</a>--></div> 
<div class="grey-panelnew13-2012"><img src="images/left-arrow-new.png" alt="#" />&nbsp;<img src="images/right-arrownew.png" alt="#" /></div>
<div class="footer-panel-right13-2012"><img src="images/star-icon.png" alt="#" /> <img src="images/facebook-icon.png" alt="#" />  <img src="images/twitter-icon.png" alt="#" />  <img src="images/gplus-icon.png" alt="#" /></div>

</div></div>
             
             </div>
	<!--row 1-->
    
    
    <!--you-may-panel-->
    
    <div class="youmaypanelnov20"><h12>YOU MAY ALSO LIKE</h12></div>
    <div class="clear"></div>
		
  <div style="margin-bottom:10px;">
 <!-- <div  style="height:115px; width:20px;">
  <?php //$this->load->view("front_page/images-scroller-inside");?>
  </div>-->
<iframe src="user/review_scroller_inside" allowtransparency="0" frameborder="0" height="115px" width="1045px"></iframe>
  
  </div>
		 
		 <div class="clear"></div>
    
    <!--you-may-panel-->
    
    <!--buttons-top--> 
    <div class="grey-round-barnew19nov"><div style="padding:5px;">
<!--    
    <a style="text-decoration:none;" class="black-button" href="#">HOT</a>
    <a href="#" class="grey-buttonnov19">NEW</a> 
    <a href="#" class="grey-buttonnov19" style="margin-right:86px;">Favorites</a>
    <a href="#" class="grey-buttonnov19">Positive 12</a> 
    <a href="#" class="grey-buttonnov19">Negative 30</a> 
    <a href="#" class="grey-buttonnov19" style="margin-right:80px;">Negative 60</a>
    <a href="#"  class="grey-buttonnov19" >reviews 25</a> <a href="#" class="black-button">opinions 112</a>-->
    
    
    </div></div>
     <!--buttons-top--> 
     
  <?php  

if(!empty($reveiw_all_user))
{
	
	
	foreach($reveiw_all_user as $review_detail)
	{
		$userinfo = $this->user_model->get_user_deatil_by_user_id($review_detail['creator_id'],"tbl_user");
	?>
     
     <!--row2-->
     <div class="images-left-panel-review13-2012 views-field review-new">
     <a href="user/review/<?php echo $review_detail['review_id']; ?>">
    <?php 
//$rate_review = 	 $this->user_model->get_review_rate($review_detail['review_id'],"tbl_rate_review");
 $userinfo = $this->user_model->get_user_deatil_by_user_id($review_detail['creator_id'],"tbl_user");
 $image_path = "user_profile_image/".$userinfo['user_image_name'];  
if(trim($userinfo['user_image_name'])!=""){
if(file_exists($image_path))
	{
		
?>
    
    
    <img src="create_thumbnail_image.php?file=<?php echo $image_path;?>&maxw=219&maxh=127" width="219" height="127"  border="0" />
        
        <?php 
        
    }else{
		?>
<img alt="" src="images/user-pic-big.png">
<?php } ?>

	<?php	
		
}
else{
?>
<img alt="" src="images/user-pic-big.png">
<?php } ?>
     
     <div class="nametop-heading-box-review">
     
    <?php echo ucfirst($userinfo['user_first_name'])." "; echo ucfirst(substr($userinfo['user_last_name'],0,1));?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     
     </div></div>
     
     <div class="message-box-back-big">
             <div style="padding:29px;">
               <div class="panel-left-new middle-text-review-new13-2012new"><?php echo $review_detail["review_title"];?></div>
               
               
               <?php
	//echo  find_image_name_review($detail_topic['review_rate']);
	$topic_id = $review_detail['topic_id'];
	$category_or_subcategory = $review_data['category_or_subcategory'];
    $rate = get_topic_rate($topic_id,$category_or_subcategory);
	$rate_image = find_image_name_review($rate);
?>


             <div class="rate-panel-right-new13-2012"><img src="images/rate/<?php echo $rate_image;?>" alt="#" class="rate-img-new-new13-2012new" /></div>
             
             </a>
             
             </div>
             
             </div>
     
     <!--row2-->
     <div class="clear"></div>
     
     <?php
	}
	}
	 ?>