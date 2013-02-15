<style>
.chromestyle {

    width: 142%;
	margin-right:10px;
}

</style>

<script type="text/javascript">
/* <![CDATA[ */
$(document).ready(function(){
	$("#tabs li").click(function() {
		//	First remove class "active" from currently active tab
		$("#tabs li").removeClass('active');

		//	Now add class "active" to the selected/clicked tab
		$(this).addClass("active");

		//	Hide all tab content
		$(".tab_content").hide();

		//	Here we get the href value of the selected tab
		var selected_tab = $(this).find("a").attr("href");

		//	Show the selected tab content
		$(selected_tab).fadeIn();

		//	At the end, we add return false so that the click on the link is not executed
		return false;
	});
});
/* ]]> */
</script>
<!--dropdown menu-->
<script type="text/javascript" src="chromejs/chrome.js"></script>
<link rel="stylesheet" type="text/css" href="css/chromestyle.css" />



<div class="internal-wrapper">
<div style="margin-top:100px;">
 <div class="userpic-new views-field">
 
<?php 
$session_data =  get_session_data();
if($session_data['user_image_name']!="")
{
	$image_path = "user_profile_image/".$session_data['user_image_name'];		
	if(file_exists($image_path))
	{?>
<!--<a href="user/edit_profile" ><img alt="" src="<?php echo $image_path;?>"></a>
-->
<img src="create_thumbnail_image.php?file=<?php echo $image_path;?>&maxw=247&maxh=264" width="247" height="264"  border="0" />


<!--<img src="create_thumbnail_image.php?file=images/4.jpg&maxw=247&maxh=264"  border="0"/>-->

	
	<?php 
	}
}else{
?>

<img src="create_thumbnail_image.php?file=images/user-pic-big.png&maxw=247&maxh=264" />

<?php } ?>
 
 
 
 <h6 style="padding-left:10px; width:235px; margin-top:-79px;"><?php echo ucfirst($session_data['user_first_name'])." ".ucfirst($session_data['user_last_name']); ?></h6>
 </div>
 
 <div class="panel-user-one"><div class="topheading-text-user">History:</div>
 <div class="grey-text-new"><strong><?php echo $total_review;?> Reviews</strong><br />

 <!--  <strong>First Review :</strong> 4 reviews<br />

   <strong>MOR Review :</strong> 05 reviews<br />-->

   <strong>Member Since :</strong>  <?php echo  date('M-d-Y',strtotime($session_data['user_created_date_time']));?></div>
 </div>
 <div class="panel-user-two"><div class="topheading-text-user"><!--Average <span class="red-color">grades:</span>--></div>
 <div><!--<img src="images/graph.png" alt="#" border="0"/>--></div>
 </div>
 
 <div class="panel-user-three">
 
 
   <a href="javascript:void(0);"><img src="images/follow-btrn.png" alt="#" style="" border="0" /></a>
   <a href="message"><img src="images/message-btrn.png" alt="#" style="" border="0" /></a>
  <!-- <a href="javascript:void(0);"><img src="images/ignore-btrn.png" alt="#" border="0" /></a>-->
   
   
    <div class="bu">
   <a href="user/review"><p class="icon"><img src="images/subcategory-icon.png" alt="" /></p><p class="text">Review</p></a>
   </div>
   
   
   <div class="bu">
	<a href="user/category_list"><p class="icon"><img src="images/category-icon.png" alt="" width="25" /></p><p class="text">Category</p></a>
	
   </div>
   
   <div class="bu">
   <a href="user/sub_category_list"><p class="icon"><img src="images/subcategory-icon.png" alt="" /></p><p class="text">Sub-category</p></a>
   </div>
   
   
      <div class="bu">
   <a href="user/edit_profile"><p class="icon"><img src="images/subcategory-icon.png" alt="" /></p><p class="text">Profile Setting</p></a>
   </div>
   
   
  
    <!--<a href="https://twitter.com/twitter" class="twitter-follow-button" data-show-count="false">Follow @twitter</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<br/><br/>-->





 </div>
		
		<!--<div class="round-back-user"><div style="padding:10px; margin-bottom:5px;"><div class="internal-heading-box">Influence <img src="images/rate/small-four-rate.png" alt="#" style="margin-bottom:-15px; margin-right:35px;" /> Reputation <img src="images/rate/small-three-rate.png" alt="#" style="margin-bottom:-15px; margin-right:35px;" /> Contribition <img src="images/rate/small-five-rate.png" alt="#" style="margin-bottom:-15px;" /></div></div></div>-->	  
		<div class="clear"></div>
		<div><a href="Javascript:void(0);"><img src="images/createfree-banner.png" alt="#" border="0" /></a></div>
			  
  </div>	
  
  <div class="clear"></div>
  
  <div id="tabs_wrapper">
	<div id="tabs_container">
		<ul id="tabs" style="width:450px; float:left;">
			<li class="active"><a href="#tab1">Críticas</a></li>
			<li><a href="#tab2">Favoritos</a></li>
			<li><a href="#tab3">Fans</a></li>
			
		</ul>
		<div style="width:305px; float:right;"><a href="javascript:void(0);"><img src="images/renta-banner-btrn.png" alt="#" style="margin-bottom:-10px;" border="0" /></a> <a href="javascript:void(0);"><img src="images/mange-banner-btrn.png" alt="#" style="margin-bottom:-10px;" border="0" /></a></div>
	</div>
	<div id="tabs_content_container">
		<div id="tab1" class="tab_content" style="display: block;">
			<div class="grey-round-bar-newnov19" style="margin-top:5px;">
			 <div class="images-left-panel heading-black">Name</div>
			 <div class="notes-panel heading-black">Notes</div>
			 <div class="rate-panel heading-black" style="padding-left:10px;">Rate</div>
			
			  </div>
			  
			    <div class="clear"></div>
                
                         <?php
			//	pr($site_data);
			
			// show category deail
			
			if(!empty($site_data_category))
			{
				foreach($site_data_category as $detail_topic)
				{
				?>
	
			<!--row 2-->
			<a href="user/topicdetail/<?php echo $detail_topic["category_id"];?>/m"> <div class="border-round">
			  <div class="images-left-panel views-field round-img">
              
              <?php 

	$image_path = "upload_image/".$detail_topic['category_image'];		
	if(file_exists($image_path))
	{?>
              
     <img src="create_thumbnail_image.php?file=<?php echo $image_path;?>&maxw=287&maxh=157"  border="0"  alt="#" />
     <?php
	}else{
	 ?>
              <img src="images/thedark.png"  border="0"  alt="#" />
          
     <?php
	}
	 ?>
          
              
              <h6 style="padding-left:80px; margin-top:-68px;"><?php echo $detail_topic['category_name'];?> </h6></div>
			<!--  <div class="top-image-panel"><img src="images/movie.png" alt="#"  border="0" /></div>-->
			  <div class="notes-panelnew20cot middle-text"><div class="internal-panel">
<div class="panel">
<p style=" position: relative; top: -50%; margin-top:45px;"><?php echo $detail_topic['category_description'];?></p>
</div>
</div> </div>
<!--<div class="medal-panel"><img src="images/gold-icon.png" alt="#"  border="0"/></div>-->

<?php
	$topic_id = $detail_topic['category_id'];
	$rate = get_topic_rate($topic_id,1); // category
	
	
	$rate_image = find_image_name_review($rate);	
?>

<div class="rate-panel" align="right"><img src="images/rate/<?php echo $rate_image;?>" alt="#" class="rate-img" border="0" /></div>
			  	  
  </div></a>
<!--row 2-->

<?php
		}
	}
?>   
              
 <?php
			//	pr($site_data);			
			// 	// show sub category deail			
			if(!empty($site_data))
			{
				foreach($site_data as $detail_topic)
				{
				?>
	
			<!--row 2-->
			<a href="user/topicdetail/<?php echo $detail_topic["sub_category_id"];?>/s"> <div class="border-round">
			  <div class="images-left-panel views-field round-img">
              
              <?php 

	$image_path = "upload_image/".$detail_topic['sub_category_image'];		
	if(file_exists($image_path))
	{?>
              
     <img src="create_thumbnail_image.php?file=<?php echo $image_path;?>&maxw=287&maxh=157"  border="0"  alt="#" />
     <?php
	}else{
	 ?>
              <img src="images/thedark.png"  border="0"  alt="#" />
          
     <?php
	}
	 ?>
          
              
              <h6 style="padding-left:80px; margin-top:-68px;"><?php echo $detail_topic['sub_category_name'];?> </h6></div>
			<!--  <div class="top-image-panel"><img src="images/movie.png" alt="#"  border="0" /></div>-->
			  <div class="notes-panelnew20cot middle-text"><div class="internal-panel">
<div class="panel">
<p style=" position: relative; top: -50%; margin-top:45px;"><?php echo $detail_topic['sub_category_description'];?></p>
</div>
</div> </div>
<!--<div class="medal-panel"><img src="images/gold-icon.png" alt="#"  border="0"/></div>-->

<?php
	$topic_id = $detail_topic['sub_category_id'];
	$rate = get_topic_rate($topic_id,2); // 2 means sub category
	$rate_image = find_image_name_review($rate);	
?>

<div class="rate-panel" align="right"><img src="images/rate/<?php echo $rate_image;?>" alt="#" class="rate-img" border="0" /></div>
			  	  
  </div></a>
<!--row 2-->

	<?php
		}
	}
?>
		
		
<div class="clear"></div>
<div class="grey-round-bar-user " style="margin-top:15px;">
<div class="bottom-text">

<!--Exibindo de 1 a 15 Total de Atualizãçoes: <span class="red-color">130</span></div>
<div><a href="#" class="grey-paging-selected">1</a> <a href="#" class="grey-paging">2</a> <a href="#" class="grey-paging"> 3</a> <a href="#" class="grey-paging">4</a> <a href="#" class="grey-paging">5</a> <a href="#" class="grey-paging">6</a> <a href="#" class="grey-paging">7</a> <a href="#" class="grey-paging">8</a> <a href="#" class="grey-paging"> 9</a> <a href="#" class="grey-paging">10</a> <a href="#" class="grey-paging-long">Proxima >></a>-->

<?php echo $site_data_pagination;?>

</div>
</div>

			
			
		</div>
		<div id="tab2" class="tab_content">
        
        <?php 
		
		if(!empty($category_list))
		{
			foreach($category_list as $detail)
			{
		?>
         <a href="user/topicdetail/<?php echo $detail['category_id']; ?>/m">
        <div class="favorties-new views-field margingright-fav5 margingleft5">
       
        
            <?php 

	$image_path = "upload_image/".$detail['category_image'];		
	if(file_exists($image_path))
	{?>
    
   <img src="create_thumbnail_image.php?file=<?php echo $image_path;?>&maxw=256&maxh=266" width="256" height="200"  border="0" />
	<?php 
	}
 ?>
        <div class="top-heading-box"><?php echo $detail['category_name'];?></div></div>
		</a>   
	<?php
			}
		}
	 ?>
		
        
         <?php 
		
		if(!empty($sub_category_list))
		{
			foreach($sub_category_list as $detail)
			{
		?>
        <a href="user/topicdetail/<?php echo $detail['sub_category_id']; ?>/s">
        <div class="favorties-new views-field margingright-fav5 margingleft5">
       
        
            <?php 

	$image_path = "upload_image/".$detail['sub_category_image'];		
	if(file_exists($image_path))
	{?>
    
   <img src="create_thumbnail_image.php?file=<?php echo $image_path;?>&maxw=256&maxh=266" width="256" height="200"  border="0" />
	<?php 
	}
 ?>
        <div class="top-heading-box"><?php echo $detail['sub_category_name'];?></div></div>
		</a>   
	<?php
			}
		}
	 ?>
				
				
				
				
				
				
				
				
				
			
			
		</div>
		
		<div id="tab3" class="tab_content">
        <?php 
		
		if(!empty($user_list))
		{
			foreach($user_list as $user_detail){
		?>
        		<div class="fanpic-new views-field margingright5">
               		<!--<img src="images/userpic2.png" alt="#" />-->
                    
                    <?php 
 $user_detail['user_image_name'];
if($user_detail['user_image_name']!="")
{
	 $image_path = "user_profile_image/".$user_detail['user_image_name'];		
	if(file_exists($image_path))
	{?>
    
   <img src="create_thumbnail_image.php?file=<?php echo $image_path;?>&maxw=233&maxh=209" width="233" height="209"  border="0" />
	<?php 
	}
}else{
?>
   <img src="create_thumbnail_image.php?file=images/user-pic-big.png&maxw=233&maxh=209" width="233" height="209"   border="0" />

<?php } ?>

                    
                    
                    
                    
                    <h6 style="padding-left:10px; width:185px; margin-top:-53px;">
                   	 <?php echo ucfirst($user_detail['user_first_name'])." ".ucfirst($user_detail['user_last_name'])?>
                    </h6>
				</div>
                
		<?php
		
			}
		}
		?>
				
				
				
		</div>
	</div>
</div>	  
			  
			  <div class="clear"></div>