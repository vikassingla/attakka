<?php include("header.php");
$user_id=$_SESSION['user_id'];
?>
<div class="internal-wrapper">

<div style="margin-top:100px;">
<?php
if (isset($_GET['msg'])=='susub')
{	
	$msg='Information is updated Sussessfully.';
	echo '<div class="white-wrapper-error" style="margin-left:65px;width:80%">'.$msg.'  X</div>';
}
if(isset($_GET['user_id']))
	{
		$user_id=$_GET['user_id'];
	}
	else
	{
		$user_id=$_SESSION['user_id'];
	}
?>
<div>
 <div class="userpic-new views-field" style="overflow:hidden;height:200px;width:200px;">
 <table width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="white" style="background-color:#fff;border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px;" >
	 <tr>
		 <td align="center" valign="center" style="padding:0px;background-color:#fff;">
		 <a href="edit_user_profile.php" title='Edit user profile'>
			 <img src="<?php echo $src1?>" alt="#" border="0" style="height:200px;width:200px;"/> 
		</a>
		 </td>
	 </tr>
 </table>
	<h6 style="padding-left:10px; width:190px; margin-top:-34px;text-align:center;border-radius: 0 0 5px 5px;"><?php echo $rown['user_firstname']." ".$rown['user_lastname']?></h6>
 </div>
 
 <div class="panel-user-one"><div class="topheading-text-user">History:</div>
 <div class="grey-text-new"><strong>18 Reviews</strong><br />

   <strong>First Review :</strong> 4 reviews<br />

   <strong>MOR Review :</strong> 05 reviews<br />

   <strong>Member Since :</strong>  Jan 03 '00</div>
 </div>
 <div class="panel-user-two"><div class="topheading-text-user">Average <span class="red-color">grades:</span></div>
 <div><img src="images/graph.png" alt="#" border="0"/></div>
 </div>
 
 <div class="panel-user-three"><a href="#"><img src="images/follow-btrn.png" alt="#" style="margin-bottom:10px;" border="0" /></a><br />
   <a href="#"><img src="images/message-btrn.png" alt="#" style="margin-bottom:10px;" border="0" /></a><br />
   <a href="#"><img src="images/ignore-btrn.png" alt="#" border="0" /></a></div>
		
		<div class="round-back-user"><div style="padding:10px; margin-bottom:5px;margin-top:-10px"><div class="internal-heading-box">Influence <img src="images/rate/small-four-rate.png" alt="#" style="margin-bottom:-15px; margin-right:35px;" /> Reputation <img src="images/rate/small-three-rate.png" alt="#" style="margin-bottom:-15px; margin-right:35px;" /> Contribition <img src="images/rate/small-five-rate.png" alt="#" style="margin-bottom:-15px;" /></div></div></div>	  
		<div class="clear"></div>
		<div><a href="Create-banner.html"><img src="images/createfree-banner.png" alt="#" border="0" /></a></div>
			  
  </div>	
  
  <div class="clear"></div>
  <?php $string=htmlentities('Críticas',ENT_QUOTES, 'UTF-8');?>
  
  <div id="tabs_wrapper">
	<div id="tabs_container">
		<ul id="tabs" style="width:450px; float:left;padding: 7px 0 4px 0;">
			<li class="active" onclick="document.getElementById('tab2').style.display='none';document.getElementById('tab1').style.display='block'"><a href="javascript:void(0);"><?php echo $string;?></a></li>
			<li><a href="javascript:void(0);" onclick="document.getElementById('tab2').style.display='block';document.getElementById('tab1').style.display='none';">Favoritos</a></li>
			<li><a href="javascript:void(0);">Fans</a></li>
			
		</ul>
		<div style="width:305px; float:right;"><a href="Rentabanner.html"><img src="images/renta-banner-btrn.png" alt="#" style="margin-bottom:-4px;" border="0" /></a> <a href="Banner-Management.html"><img src="images/mange-banner-btrn.png" alt="#" style="margin-bottom:-4px;" border="0" /></a></div>
	</div>
	<div id="tabs_content_container">
	<div class="grey-round-bar-newnov19" style="margin-top:5px;">
			 <div class="images-left-panel heading-black">Name</div>
			 <div class="notes-panel heading-black">Notes</div>
			 <div class="rate-panel heading-black" style="padding-left:10px;">Rate</div>
			
			  </div>
		<div id="tab1" class="tab_content" style="display: block;">
		
	<?php
	$allReviews=getReviewOfUserTotal();
	//echo '<pre>';
	//print_r($allReviews);die;
	$count=$allReviews;
	$adjacents = 3;
	$total_pages = $count;
	//echo $total_pages;
	$limit = 3; 								//how many items to show per page
	@$page = $_GET['page'];
	if($page) 
	$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;	
			
		if ($page == 0) $page = 1;
	//echo $pageno;					//if no page var is given, default to 1.
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 = $lastpage - 1;	
		$pagination = "";
		if($lastpage > 1)
		{	
			$pagination .= "<div class=\"pagination\">";
			//previous button
			if ($page > 1) 
				$pagination.= "<a href=\"user_page.php?page=$prev\">&laquo; </a>";
			else
				$pagination.= "<span class=\"disabled\">&laquo; </span>";	
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"user_page.php?page=$counter\">$counter</a>";					
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"user_page.php?page=$counter\">$counter</a>";					
					}
					$pagination .= "<span class=\"elipses\">...</span>";
					$pagination.= "<a href=\"user_page.php?page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"user_page.php?page=$lastpage\">$lastpage</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href=\"user_page.php?page=1\">1</a>";
					$pagination.= "<a href=\"user_page.php?page=2\">2</a>";
					$pagination .= "<span class=\"elipses\">...</span>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"category_detail.php?page=$counter\">$counter</a>";					
					}
					$pagination .= "<span class=\"elipses\">...</span>";
					$pagination.= "<a href=\"user_page.php?page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"user_page.php?page=$lastpage\">$lastpage</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<a href=\"user_page.php?page=1\">1</a>";
					$pagination.= "<a href=\"user_page.php?page=2\">2</a>";
					$pagination .= "<span class=\"elipses\">...</span>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"user_page.php?page=$counter\">$counter</a>";					
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination.= "<a href=\"user_page.php?page=$next\"> &raquo;</a>";
			else
				$pagination.= "<span class=\"disabled\"> &raquo;</span>";
			$pagination.= "</div>\n";		
		}
	
	
	//echo '<pre>';
	//print_r($allReview);die;
	
	
	$allReview=getReviewOfUser($start,$limit,$user_id);
	if(count($allReview)>0)
	{
		foreach($allReview as $rev)
		{
		 $thumnail='review_images/'.$rev['cat_img'];
		 $reviewImg='review_images/'.$rev['review_img'];
		 /***********thumnail image check***************/
			if(empty($rev['cat_img']))
			 {
				 
				 $thumnail='images/norevimage.jpg';
			 }
			 else
			 {
				 if(!file_exists($thumnail))
				 {
					$thumnail='images/norevimage.jpg';
				 }
				 else
				 {
					 $thumnail='review_images/'.$rev['cat_img'];
				 }
				 
			 }
			 /***********thumnail image check***************/
			
			/************review image check*****************/
			 if(empty($rev['review_img']))
			 {
				$reviewImg='images/norevimage.jpg';
			 }
			 else
			 {
				 if(!file_exists($reviewImg))
				 {
					$reviewImg='images/norevimage.jpg';
				 }
				 else
				 {
					$reviewImg='review_images/'.$rev['review_img'];
				 }
			 }
			 /************review image check*****************/
   ?>
  <a href="infowall_review.php?cat_id=<?php echo $rev['review_cat_id']?>"><div class="border-round">
    <div class="images-left-panel views-field round-img<?php echo $color?>-newgeneral">
    <img src="<?php echo $reviewImg;?>" border="0"  alt="#" style="height:120px;width:300px;"/>
    <h6 style="padding-left:80px; margin-top:-27px;"><?php echo $rev['cat_name']?></h6>
    </div>
    <div class="top-image-panel"><img src="<?php echo $thumnail;?>" alt="#"  border="0" style="width:53px;height:53px;background-color:#ffffff"/></div>
    <div class="notes-panel middle-text">
      <div class="internal-panel">
        <div class="panel">
          <p style=" position: relative; top: -50%"><a style="color: #383838;font-family: 'CalibriRegular'; font-size: 18px;line-height: 28px;text-decoration:none;cursor:pointer;" href="review_detail.php?review_id=<?php echo $rev['review_id']?>"><?php echo $rev['review_opinion']?></a></p>
        </div>
      </div>
    </div>
    <div class="rate-panel" align="right"><img src="images/rate/bigrate<?php echo $rev['review_rate']?>.png" alt="#" class="rate-img" border="0" /></div>
  </div></a>
  <div class="clear"></div>
		<?php
		 }
	    }
	    else
	    {
			echo 'No Record Found.';
		}	
		?>
		<div class="clear"></div>
			<div class="grey-round-bar-user " style="margin-top:15px; text-align: center;">
			<div><?php echo $pagination;?></div>
			</div>	
		</div>
		
	<div id="tab2" class="tab_content" style="display: none;">
	<?php

	
	
	$favCategory=getFavouriteCategoryOfUser($user_id);
	if(count($favCategory)>0)
	{
		    $cnt=0;
			foreach($favCategory as $fav)
			{
			  $cat_id=$fav['cat_id'];
			  // echo '<pre>';
			  //print_r( $cat_id);
			  $favR=getFavouriteReviewOfUser($user_id,$cat_id);
			  if(count($favR)>0)
			  {
				  foreach($favR as $fv)
				  {
						 $banner='review_images/'.$fv['cat_banner_img'];
						 $catname=$fv['cat_name'];
						 $catidd=$fv['cat_id'];
						 //echo $banner."<br>";
						 /***********banner image check***************/
						 if(empty($fv['cat_banner_img']))
						 {
							 
							 $banner='images/norevimage.jpg';
						 }
						 else
						 {
							 if(!file_exists($banner))
							 {
								$banner='images/norevimage.jpg';
							 }
							 else
							 {
								 $banner='review_images/'.$fv['cat_banner_img'];
							 }
							 
						 }
						 if(empty($fv['rat']))
						 {
							 $rating=0;
						 }
						 else
						 {
							 $rating=ceil($fv['rat']);
						 }
					}
				}
				else
				{
					$getCatdata=getCategoryFromId($cat_id);
					if(count($getCatdata)>0)
					{
						foreach($getCatdata as $catData)
						{
							$banner='review_images/'.$catData['cat_banner_img'];
							$rating=0;
							$catname=$catData['cat_name'];
							$catidd=$catData['cat_id'];
							if(empty($catData['cat_banner_img']))
							 {
								 
								 $banner='images/norevimage.jpg';
							 }
							 else
							 {
								 if(!file_exists($banner))
								 {
									$banner='images/norevimage.jpg';
								 }
								 else
								 {
									 $banner='review_images/'.$catData['cat_banner_img'];
								 }
								 
							 }
						}
					}
				}
				//echo '<pre>';
				//print_r($fv);
			
		/***********banner image check***************/
   ?>
    <?php 
     if(isset($fv['review_cat_id']))
     {
	     ?>
	    <a href="infowall_review.php?cat_id=<?php  if(isset($fv['review_cat_id'])) { echo $fv['review_cat_id']; }?>"><div class="border-round">
	    <?php
	 }
	 else
	 {
	 ?>
	  <a href="javascript:void(0);"><div class="border-round">
	  <?php
     }
     ?>
    <div class="images-left-panel views-field round-img<?php if(isset($color)) { echo $color;}?>-newgeneral">
    <img src="<?php if(isset($banner)) { echo $banner;};?>" border="0"  alt="" style="height:120px;width:300px;"/>
    <h6 style="padding-left:80px; margin-top:-27px;"><?php if(isset($catname)) {echo $catname;}; ?></h6>
    </div>
    <div class="notes-panel middle-text">
      <div class="internal-panel">
        <div class="panel">
          <p style=" position: relative; top: -50%"><a style="color: #383838;font-family: 'CalibriRegular'; font-size: 18px;line-height: 28px;text-decoration:none;cursor:pointer;" href="category_detail.php.php?cat_id=<?php if(isset( $catidd)) { echo $catidd; }?>"><?php if(isset($catname)) { echo $catname;}?></a></p>
        </div>
      </div>
    </div>
    <div class="rate-panel" align="right"><img src="images/rate/bigrate<?php echo $rating?>.png" alt="" class="rate-img" border="0" /></div>
  </div></a>
  <div class="clear"></div>
		<?php
		}
		}
		else
		{
			echo 'No Record Found';
		}	
		?>
		
		<!--<div id="tab2" class="tab_content">
			<div class="favorties-new views-field margingright-fav5 margingleft5"><img src="images/shopping-img.png" alt="#" /> <div class="top-heading-box">Shopping</div></div>
			
				<div class="favorties-new views-field margingright-fav5"><img src="images/night-img.png" alt="#" /> <div class="top-heading-box">Night Life</div></div>
					<div class="favorties-new views-field margingright-fav5"><img src="images/beauty-img.png" alt="#" /> <div class="top-heading-box">Beauty & Spa</div></div>
					
						<div class="favorties-new views-field"><img src="images/freshidea-img.png" alt="#" /> <div class="top-heading-box">FRESH IDEAS</div></div>
				
				
				<div class="clear"></div>
				
				
				<div class="favorties-new views-field margingright-fav5 margingleft5"><img src="images/consul-img.png" alt="#" /> <div class="top-heading-box">CONSUL</div></div>
			
				<div class="favorties-new views-field margingright-fav5"><img src="images/soccer-img-fav.png" alt="#" /> <div class="top-heading-box">SOCCER</div></div>
					<div class="favorties-new views-field margingright-fav5"><img src="images/resturant-img.png" alt="#" /> <div class="top-heading-box">Restaurant</div></div>
					
						<div class="favorties-new views-field"><img src="images/autority-img.png" alt="#" /> <div class="top-heading-box">Autority</div></div>
						
						<div class="clear"></div>
				
				
				<div class="favorties-new views-field margingright-fav5 margingleft5"><img src="images/active-img.png" alt="#" /> <div class="top-heading-box">ACTIVE LIFE</div></div>
			
				<div class="favorties-new views-field margingright-fav5"><img src="images/general-img.png" alt="#" /> <div class="top-heading-box">General</div></div>
					<div class="favorties-new views-field margingright-fav5"><img src="images/movie-img-fav.png" alt="#" /> <div class="top-heading-box">MOVIES</div></div>
					
						<div class="favorties-new views-field"><img src="images/mosic-img.png" alt="#" /> <div class="top-heading-box">mosaic</div></div>
						
						<div class="clear"></div>
						
						<div class="favorties-new views-field margingright-fav5 margingleft5"><img src="images/books-img.png" alt="#" /> <div class="top-heading-box">BOOKS</div></div>
			
				<div class="favorties-new views-field margingright-fav5"><img src="images/pets-img.png" alt="#" /> <div class="top-heading-box">Pets</div></div>
					<div class="favorties-new views-field margingright-fav5"><img src="images/indie-img-fav.png" alt="#" /> <div class="top-heading-box">INDIE</div></div>
				
			
			
		</div>
		
		
		
		
		
		<div id="tab3" class="tab_content">
				<div class="fanpic-new views-field margingright5 margingleft5"><img src="images/userpic1.png" alt="#" />
				<h6 style="padding-left:10px; width:185px; margin-top:-53px;">Robert Pattinson</h6>
				</div>
				
				<div class="fanpic-new views-field margingright5"><img src="images/userpic2.png" alt="#" />
				<h6 style="padding-left:10px; width:185px; margin-top:-53px;">Cameron Diaz</h6>
				</div>
				
				<div class="fanpic-new views-field margingright5"><img src="images/userpic3.png" alt="#" />
				<h6 style="padding-left:10px; width:185px; margin-top:-53px;">Shawn Johnson</h6>
				</div>
				
				
				<div class="fanpic-new views-field margingright5"><img src="images/userpic4.png" alt="#" />
				<h6 style="padding-left:10px; width:185px; margin-top:-53px;">Emmys</h6>
				</div>
				
				<div class="fanpic-new views-field"><img src="images/userpic5.png" alt="#" />
				<h6 style="padding-left:10px; width:185px; margin-top:-53px;">Selena Gomez's </h6>
				</div>
				
				<div class="clear"></div>
				
					<div class="fanpic-new views-field margingright5 margingleft5"><img src="images/userpic6.png" alt="#" />
				<h6 style="padding-left:10px; width:185px; margin-top:-53px;">Anne Hathaway</h6>
				</div>
				
				<div class="fanpic-new views-field margingright5"><img src="images/userpic7.png" alt="#" />
				<h6 style="padding-left:10px; width:185px; margin-top:-53px;">John Albert</h6>
				</div>
				
				<div class="fanpic-new views-field margingright5"><img src="images/userpic8.png" alt="#" />
				<h6 style="padding-left:10px; width:185px; margin-top:-53px;">Dave </h6>
				</div>
				
				
				<div class="fanpic-new views-field margingright5"><img src="images/userpic9.png" alt="#" />
				<h6 style="padding-left:10px; width:185px; margin-top:-53px;">Asline Burton</h6>
				</div>
				
				<div class="fanpic-new views-field"><img src="images/userpic10.png" alt="#" />
				<h6 style="padding-left:10px; width:185px; margin-top:-53px;">Ryan </h6>
				</div>
		</div>-->
	</div>
	
	
</div>	  
</div>
<script type="text/javascript">
	$(document).ready(function(){
	$('ul li a').click(function() {
		 $(this).parent().addClass('active').siblings().removeClass('active');
	});
	});

</script>
 <?php include("footer.php");?>
