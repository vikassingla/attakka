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
?>
<div>
 <div class="userpic-new views-field" style="overflow:hidden;height:200px;width:200px;">
 <table width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="white" style="background-color:#fff;border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px;" >
	 <tr>
		 <td align="center" valign="center" style="padding:0px;background-color:#fff;">
		 <a href="edit_user_profile.php" title='Edit user profile'>
			 <img src="<?php echo $src1?>" alt="#" border="0" style="<?php print $thumb_w;?><?php print $thumb_h;?>"/> 
		</a>
		 </td>
	 </tr>
 </table>
	<h6 style="padding-left:10px; width:190px; margin-top:-23px;text-align:center;border-radius: 0 0 5px 5px;"><?php echo $row['user_firstname']." ".$row['user_lastname']?></h6>
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
  
  <div id="tabs_wrapper">
	<div id="tabs_container">
		<ul id="tabs" style="width:450px; float:left;padding: 7px 0 4px 0;">
			<li class="active"><a href="#tab1">Críticas</a></li>
			<li><a href="#tab2">Favoritos</a></li>
			<li><a href="#tab3">Fans</a></li>
			
		</ul>
		<div style="width:305px; float:right;"><a href="Rentabanner.html"><img src="images/renta-banner-btrn.png" alt="#" style="margin-bottom:-4px;" border="0" /></a> <a href="Banner-Management.html"><img src="images/mange-banner-btrn.png" alt="#" style="margin-bottom:-4px;" border="0" /></a></div>
	</div>
	<div id="tabs_content_container">
		<div id="tab1" class="tab_content" style="display: block;">
			<?php
  $sql59="select review_id, review_cat_id, review_opinion, review_rate from tbl_review where review_cat_id in (select cat_id from tbl_category where cat_parent_id!=0 and cat_created_by=$user_id) order by review_id DESC limit 0,9";
  //echo $sql59;
  $rs59=mysql_query($sql59);
  while($row59=mysql_fetch_array($rs59))
  {
	$sql60="select cat_name, cat_thumb_img, cat_parent_id from tbl_category where cat_id=".$row59['review_cat_id'];
	//echo $sql60;
	$rs60=mysql_query($sql60);
	$row60=mysql_fetch_array($rs60);
	if($row59['review_rate']>0)
	{
		$color="red";  
	} 
	else
	{
		$color="black";
	}	
	if($row60['cat_thumb_img']=="")
	{
		$lsrc="images/norevimage.jpg";
	}
	else
	{	
		$lsrc="cat_images/".$row60['cat_thumb_img'];
	}	
	/*if($row16['cat_thumb_img']=="")
	{
		$lsrc="images/norevimage.jpg";
	}
	else
	{	
		$lsrc="cat_images/".$row16['cat_thumb_img'];
	}*/	
	$rate=$row59['review_opinion'];
	if($rate=="-0")
	{
		$rate="0";
	}	
	$sql61="select cat_parent_id, cat_img, cat_thumb_img from tbl_category where cat_id=".$row60['cat_parent_id'];
	//echo $sql17;
	$rs61=mysql_query($sql61);
	$row61=mysql_fetch_array($rs61);
	if($row61['cat_parent_id']=="0")
	{
		$ssrc="uploads/".$row61['cat_img'];
	}
	else
	{
		$ssrc="cat_images/".$row61['cat_img'];
	}	
  ?>
  <a href="infowall_review.php?cat_id=<?php echo $row59['review_cat_id']?>"><div class="border-round">
    <div class="images-left-panel views-field round-img<?php echo $color?>-newgeneral">
    <img src="<?php echo $lsrc?>" border="0"  alt="#" style="height:120px;width:300px;"/>
    <h6 style="padding-left:80px; margin-top:-27px;"><?php echo $row60['cat_name']?></h6>
    </div>
    <div class="top-image-panel"><img src="<?php echo $ssrc?>" alt="#"  border="0" style="width:53px;height:53px;background-color:#ffffff"/></div>
    <div class="notes-panel middle-text">
      <div class="internal-panel">
        <div class="panel">
          <p style=" position: relative; top: -50%"><a href="discuss_review.php?rev_id=<?php echo $row59['review_id']?>"><?php echo $row59['review_opinion']?></a></p>
        </div>
      </div>
    </div>
    <div class="rate-panel" align="right"><img src="images/rate/bigrate<?php echo $row59['review_rate']?>.png" alt="#" class="rate-img" border="0" /></div>
  </div></a>
  <div class="clear"></div>
		    
			
		<?php
		
		}
			
		?>	
			
			
		</div>
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
			  <?php include("footer.php");?>
