
<base href="<?php echo base_url(); ?>" />
<link href="review-scroller/style.css" rel="stylesheet" type="text/css">
<!--
  jQuery library
-->
<script type="text/javascript" src="review-scroller/jquery-1.js"></script>
<!--
  jCarousel library
-->
<script type="text/javascript" src="review-scroller/jquery.js"></script>
<!--
  jCarousel skin stylesheets
-->
<link rel="stylesheet" type="text/css" href="review-scroller/skin.css">
<link rel="stylesheet" type="text/css" href="review-scroller/skin_002.css">
<script type="text/javascript">

jQuery(document).ready(function() {
    // Initialise the first and second carousel by class selector.
	// Note that they use both the same configuration options (none in this case).
	jQuery('.first-and-second-carousel').jcarousel();
	
	// If you want to use a caoursel with different configuration options,
	// you have to initialise it seperately.
	// We do it by an id selector here.
	jQuery('#third-carousel').jcarousel({
        vertical: true
    });
});

</script>
<div id="wrap">
  <ul id="first-carousel" class="first-and-second-carousel jcarousel-skin-tango">
   <?php
   
   $topic_scroller_data = $this->topic_model->get_scroller_topic_sub_category("tbl_sub_category");
   
   if(!empty($topic_scroller_data))
   {
	   foreach($topic_scroller_data as $detail_topic)
	   {
   
   ?>  
           <li>
                <div class="views-field subcategoryhorror-new-small">
                
             <!-- <img src="images/r1.png" alt="#" />-->
                
            
             <?php 

	$image_path = "upload_image/".$detail_topic['sub_category_image'];		
	if(file_exists($image_path))
	{?>
              
     <img src="create_thumbnail_image.php?file=<?php echo $image_path;?>&maxw=233&maxh=142"  border="0"  alt="#" />
     <?php
	}else{
	 ?>
              <img src="images/thedark.png"  border="0"  alt="#" />

     <?php
	}
	 ?>
        <div class="nametop-heading-box-horror-small">
			<?php
                 echo $detail_topic['sub_category_name'];
            ?>
        </div>				
				
                </div>
				 
                 <div class="top-rating-panel-small">
                 
              <!--  <img src="images/rate/smallrate-3plus.png" alt="#" />-->
                 
                 
                 <?php
	//echo  find_image_name_review($detail_topic['review_rate']);
	$topic_id = $detail_topic['sub_category_id'];
    $rate = get_topic_rate($topic_id,2); // sub category 
 
	$rate_image = find_small_image_name_review($rate);
?>


<img src="images/rate/<?php echo $rate_image;?>" alt="#" class="rate-img" border="0" width="48" height="47" />

                 
                 </div>
		
            
              		 
				</li>
                
              
                
                
              <?php
	    }
	   }
			  ?>
				    
  </ul>
  </div>