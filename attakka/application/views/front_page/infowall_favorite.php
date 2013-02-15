<div class="internal-wrapper">
<div style="margin-top:100px;">    <img src="images/movie-banner.png" alt="" class="image-border" />
		      
		      <h4 style="padding-left:10px;">Movies</h4></div>
			  <h5>TPM=2.451</h5>
			 
			  <div class="clear"></div>
			  <div class="left-panel-infowall">
			  <div class="top-heading-info">Vote for the best wallpic</div>
              
			 
             <?php 
			 $wall_paper_image = $this->topic_model->get_wall_paper();
			 
			 if(!empty($wall_paper_image))
			 {
				 
				 foreach($wall_paper_image as $wall_detail)
				 {
					 
					 
					 $image_path = "uploads/".$wall_detail['sub_category_image_name'];;
			 ?>
             
             
              <div class="info-image-left views-field">
              
              <img width="290" height="123" src="create_thumbnail_image.php?file=<?php echo $image_path;?>&maxw=290&maxh=123" alt="#" />
              
              </div>
			  <div class="box-rating">1<sup style="font-size:6px;">o</sup></div>
			  <div class="arrow-up"><img src="images/arrow-up.png" alt="#" style="margin-bottom:20px;" /><br />
<img src="images/arrow-down.png" alt="#" /></div>
<div class="clear"></div>

          <?php 
				}
				 }
		  ?>

<div class="clear"></div>




<div><!--<a href="#" class="red-button-newnov19">Submit Image</a>--></div>

			  
			  
			  
			  </div>
			  
			  
			  <div class="round-box-info">
			  <div style="padding:15px;">
                     
                    <?php
			//	pr($site_data);
			
			if(!empty($site_data))
			{
				foreach($site_data as $detail_topic)
				{
				?>
              
			  <div class="red-color-headinginfo">INFo<span class="black-color-heading"> Page</span></div>
			  <div class="topheading-boxinfo">Description:</div>
			  <div class="regular-text-info"><?php echo $detail_topic['sub_category_description'];?>
</div>
<div class="clear"></div>
<div><img src="images/shadow-line.png" alt="#"  style="margin-top:45px; margin-bottom:45px;"/></div>
<div class="clear"></div>

<div class="topheading-boxinfo">Rules</div>
			  <div class="regular-text-info"><?php echo $detail_topic['sub_category_rules'];?></div>
<div class="clear"></div>
<div align="right"><!--<a href="" style="margin-top:130px;" class="red-button-newnov19discuss">Discuss It</a>--></div>
			  
			  
              
          <?php
		}
	}
?>
	    
			  
			  </div>
			  
			  </div>
			  
			 
             
              
			  
			  <!--<div class="round-panel-rightinfo">
			  <div style="padding:10px;">
			  <div class="red-text-smallinfo">The Authority</div>
			  <div class="user-image-left views-field"><img src="images/us-pic1.png" alt="#" /></div>
			  <div class="name-text-small">Mariano Fonseca</div>
			  <div class="clear"></div>
			  <div class="red-text-biginfo">MODs</div>
			  <div class="user-image-left views-field"><img src="images/us-pic2.png" alt="#" /></div>
			  <div class="name-text">Sabrina</div>
			  <div class="clear"></div>
			  <div class="user-image-left views-field"><img src="images/us-pic3.png" alt="#" /></div>
			  <div class="name-text">Drey, Indie</div>
			  
			   <div class="clear"></div>
			  <div class="user-image-left views-field"><img src="images/us-pic4.png" alt="#" /></div>
			  <div class="name-text">Musician </div>
			  <div class="clear"></div>
			  <div><a href="Sugest-Subcategory.html" class="red-button-newnov19new">Suggest a <br />
subcategory</a></div>
			  <div class="clear"></div>
			   <div style="margin-top:10px;"><a href="Moderator-Page.html"class="red-button-newnov19new">Moderators<br />
Wanted</a></div>
			   <div class="how-heading">How we doing?</div>
			   <div align="center"><img src="images/small-arrow-up.png" alt="#" style="margin-top:4px;" /></div>
			      <div align="center"><img src="images/rate/rate4-small.png" alt="#" style="margin-top:4px;" /></div>
				     <div align="center"><img src="images/arrow-down-small.png" alt="#" /></div>
			  
			  
			  
			  </div>
			  
			  </div>-->
	

<div class="clear"></div>