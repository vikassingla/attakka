
<div class="internal-wrapper">
<div style="margin-top:100px;">
 <a href="user/favorite/3"> <img src="images/possesion-banner.png" alt="" class="image-border"  border="0"/></a>
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
     <?php if($this->uri->segment(4)=='s')
		{?>        
             
    <?php 
	$image_path1 = "upload_image/".$topic_data['sub_category_image'];		
	if(file_exists($image_path1))
	{?>
              
     <img src="create_thumbnail_image.php?file=<?php echo $image_path1;?>&maxw=219&maxh=127"  border="0"  alt="#" />
     <?php
	}else{
	 ?>
              <img src="images/thedark.png"  border="0"  alt="#" width="219" height="127" />
          
     <?php
	}
	 ?>
     
     
             
             <div class="nametop-heading-box-review"><?php echo $topic_data['sub_category_name'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--134 Fans <img src="images/staryellow-icon.png" alt="#" style="margin-bottom:-2px;" />--></div></div>
             
             <div class="message-box-back">
             <div style="padding:15px;">
               <div class="panel-left-new middle-text-review-new13-2012"><?php echo $topic_data['sub_category_name'];?> ,..</div>
             <div class="rate-panel-right-new13-2012">
             
             <?php
	$topic_id = $topic_data['sub_category_id'];
	$rate = get_topic_rate($topic_id,2); // means sub category
	$rate_image = find_image_name_review($rate);	
?>
             
             <img src="images/rate/<?php echo $rate_image;?>" alt="#" class="rate-img-new-new13-2012" width="104" height="101"  />
             
             </div>
             
             </div>
             
             </div>
             
             <div class="clear"></div>
             
             <div class="middle-text-review-small" style="padding:15px;"><?php echo $topic_data['sub_category_description'];?></div>

<div class="clear"></div>

<div class="border-round-reviewnew"><div style="padding:5px;"><div class="button-right-new">

<a href="user/create_review/<?php echo $topic_data['sub_category_id']; ?>/s" class="comentar-btrn">Create Review </a>

</div> 
<div class="grey-panelnew13-2012"><img src="images/left-arrow-new.png" alt="#" />&nbsp;<img src="images/right-arrownew.png" alt="#" /></div>
<div class="footer-panel-right13-2012"><img src="images/star-icon.png" alt="#" /> <img src="images/facebook-icon.png" alt="#" />  <img src="images/twitter-icon.png" alt="#" />  <img src="images/gplus-icon.png" alt="#" /></div>

</div></div>
             
             </div>
	<!--row 1-->
 
 <?php 
}
 ?>
 
  <?php if($this->uri->segment(4)=='m')
		{?> 
        
          <?php 
	$image_path1 = "upload_image/".$topic_data['category_image'];		
	if(file_exists($image_path1))
	{?>
              
     <img src="create_thumbnail_image.php?file=<?php echo $image_path1;?>&maxw=219&maxh=127"  border="0"  alt="#" />
     <?php
	}else{
	 ?>
              <img src="images/thedark.png"  border="0"  alt="#" width="219" height="127" />
          
     <?php
	}
	 ?>
     
     
             
             <div class="nametop-heading-box-review"><?php echo $topic_data['category_name'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--134 Fans <img src="images/staryellow-icon.png" alt="#" style="margin-bottom:-2px;" />--></div></div>
             
             <div class="message-box-back">
             <div style="padding:15px;">
               <div class="panel-left-new middle-text-review-new13-2012"><?php echo $topic_data['category_name'];?> ,..</div>
             <div class="rate-panel-right-new13-2012">
             
             <?php
	$topic_id = $topic_data['category_id'];
	$rate = get_topic_rate($topic_id,1); // 1 means category 
	$rate_image = find_image_name_review($rate);	
?>
             
             <img src="images/rate/<?php echo $rate_image;?>" alt="#" class="rate-img-new-new13-2012" width="104" height="101"  />
             
             </div>
             
             </div>
             
             </div>
             
             <div class="clear"></div>
             
             <div class="middle-text-review-small" style="padding:15px;"><?php echo $topic_data['category_description'];?></div>

<div class="clear"></div>

<div class="border-round-reviewnew"><div style="padding:5px;"><div class="button-right-new">

<a href="user/create_review/<?php echo $topic_data['category_id']; ?>/m" class="comentar-btrn">Create Review </a>

</div> 
<div class="grey-panelnew13-2012"><img src="images/left-arrow-new.png" alt="#" />&nbsp;<img src="images/right-arrownew.png" alt="#" /></div>
<div class="footer-panel-right13-2012"><img src="images/star-icon.png" alt="#" /> <img src="images/facebook-icon.png" alt="#" />  <img src="images/twitter-icon.png" alt="#" />  <img src="images/gplus-icon.png" alt="#" /></div>

</div></div>
             
             </div>
	<!--row 1-->  
 
  <?php 
}
 ?>
 
    
    <!--you-may-panel-->
    
    <span style="color:green"><?php 

	if($this->session->flashdata('add'))
	{
		 $msg = $this->session->flashdata('add');
		 display_error($msg,"Notice:");
	}
?></span>


    
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
  <!--  <a style="text-decoration:none;" class="black-button" href="#">HOT</a><a href="#" class="grey-buttonnov19">NEW</a> <a href="#" class="grey-buttonnov19" style="margin-right:86px;">Favorites</a> <a href="#" class="grey-buttonnov19">Positive 12</a> <a href="#" class="grey-buttonnov19">Negative 30</a> <a href="#" class="grey-buttonnov19" style="margin-right:80px;">Negative 60</a> <a href="#"  class="grey-buttonnov19" >reviews 25</a> <a href="#" class="black-button">opinions 112</a>-->
    
    </div></div>
     <!--buttons-top--> 
      <?php    
    	 if(!empty($review_on_category))
	 {
?>
     
     <?php
	 
	 	foreach($review_on_category as $review_detail)
		{
	 
	 	
	 ?>
     
     
     <!--row2-->
     <a href="user/topicdetail/<?php echo $review_detail["sub_category_id"]; ?>/s">
     <div class="images-left-panel-review13-2012 views-field review-new">    
   
<!--<img src="create_thumbnail_image.php?file=images/4.jpg&maxw=247&maxh=264"  border="0"/>-->

	
	    <?php 

	$image_path = "upload_image/".$review_detail['sub_category_image'];		
	if(file_exists($image_path))
	{?>
              
     <img src="create_thumbnail_image.php?file=<?php echo $image_path;?>&maxw=222&maxh=127"  border="0"  alt="#" />
     <?php
	}else{
	 ?>
              <img src="images/thedark.png"  border="0"  alt="#" width="222" height="127" />
          
     <?php
	}
	 ?>
     
         
     
     <div class="nametop-heading-box-review"><?php echo $review_detail['sub_category_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--154 Fans <img src="images/staryellow-icon.png" alt="#" style="margin-bottom:-2px;" />--></div></div>
     
     <div class="message-box-back-big">
             <div style="padding:15px;">
               <div class="panel-left-new middle-text-review-new13-2012new">
               <?php echo $review_detail['sub_category_description'];?>
               
               </div>
             <div class="rate-panel-right-new13-2012">
             
            <?php
	$topic_id = $review_detail['sub_category_id'];
	$rate = get_topic_rate($topic_id,2); // 2 means sub category 
	$rate_image = find_image_name_review($rate);	
?>

             
             
             
             <img src="images/rate/<?php echo $rate_image;?>" alt="#" class="rate-img-new-new13-2012new" />
             </a>
             
             </div>
             
             </div>
             </div>
             
     <!--row2-->
     <div class="clear"></div>
     <?php
		}
	}
	 ?>
     
      