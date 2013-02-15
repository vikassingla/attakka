<?php
include("header.php");
if(isset($_GET['mod']))
{
	$mod=$_GET['mod'];
}	
else
{
	$mod="hot";
}	
if($mod=="hot")
{
	$mod1="review_rate";
}
else if($mod=="new")
{
	$mod1="review_id";
}	
else if($mod=="rank")
{
	$mod1="review_id";
}
else if($mod=="fan")
{
	$mod1="fan";
}

?>
<div class="internal-wrapper">
<div style="margin-top:100px;"> 
<?php
$img=explode("php",$_SERVER['REQUEST_URI']);
//echo $img[1];
if($img[1]=="")
{
$nav1="black-button";	
$nav2=$nav3=$nav4="heading-black";
}
else
{
$img1=explode("=",$img[1]);	
//echo $img1[1];
if($img1[1]=="hot")
{
$nav1="black-button";	
$nav2=$nav3=$nav4="heading-black";
}	
else if($img1[1]=="new")
{
$nav2="black-button";	
$nav1=$nav3=$nav4="heading-black";
}
else if($img1[1]=="rank")
{
$nav3="black-button";	
$nav1=$nav2=$nav4="heading-black";
}
else if($img1[1]=="fan")
{
$nav4="black_button";	
$nav1=$nav2=$nav3="heading-black";
}
}		
?>
<img src="images/generalbar.png" alt="" class="image-border" />
<h4 style="padding-left:10px;">General</h4>
			   </div>
			 
			 <div style="margin-top:40px; margin-bottom:20px;" ><img src="images/banner/banner-ad2.png" alt="#"  class="image-border"/></div>
			<div class="clear"></div>
             <!--slider content-->
             <script type="text/javascript">
/* RSID: */
var s_account="applebrglobal"
</script>


<script type="text/javascript" src="global/metrics/js/s_code_h.js"></script>
<style>
</style>

<div id="main" data-hires="true" style="z-index:15000;">
		<div class="productbrowser content grey-back-new" id="pb-mac">
        <div class="pb-pageindicator roundedbottom" id="pb-pi-mac"><div>
		<b class="caret"></b>
		<a class="page" style="float:left;">New</a>
        <a class="page">Striving</a>
        <a class="page">Struglying</a>
        <a class="page"> Dying</a>
        <a class="page" style="float:right;">TOP</a>
	
		
	</div></div>
	<div class="pb-slider">
		<div class="pb-slide">
			<ul class="ul-slider">
				<li class="pb-macbookair"><a href="#">Escolas de Samba</a></li>
				<li class="pb-macbookpro"><a href="#">Jogadores do Megao</a></li>
				<li class="pb-macmini"><a href="#">Brinquedos </a></li>
				<li class="pb-imac"><a href="#">Escolas de tiro</a></li>
				<li class="pb-macpro"><a href="#">Politicos</a></li>
                <li class="pb-macosx"><a href="#">Xícara</a></li>
                
			</ul>

			

			
			
		</div>
	</div>

	
</div>
<script src="global/scripts/productbrowser.js" type="text/javascript" charset="utf-8"></script>

	<!--/showcase-->


	</div>
             <!--slider content-->

  <div class="clear"></div>
            <div class="bestfive-panel">
  <h12>Best Five</h12>
</div>

       <div class="worsefive-panel">
  <h13>worse Five</h13>
</div>
        
        
        <div class="clear"></div>
          <div id="left-panel-restaurantcategories-24nov"><iframe src="scroller-left-general.php" allowtransparency="0" width="482" height="520" frameborder="0" scrolling="no"></iframe></div>
 
  <div id="right-panel-restaurantcategories-24nov"><iframe src="scroller-right-general.php" allowtransparency="0" width="515" height="520" frameborder="0" scrolling="no"></iframe></div> 
              

  
  
   <div class="clear"></div>
  
  
  <div class="grey-round-bar heading-black">
  <div style="padding-left:5px;"><a id="hot" style="text-decoration:none;padding-right:20px" class="<?php echo $nav1; ?>" href="general_category.php?mod=hot">HOT</a><a id="new" style="text-decoration:none; padding-right:20px;" class="<?php echo $nav2; ?>" href="general_category.php?mod=new">NEW</a> <a id="rank" style="text-decoration:none; padding-right:20px;" class="<?php echo $nav3; ?>" href="general_category.php?mod=new">RANK</a> <a id="fans" style="text-decoration:none; padding-right:20px;" class="<?php echo $nav4; ?>" href="general_category.php?mod=new">FANS</a></div> 
  </div>
  
  <div class="clear"></div>
                
               <div class="heading-nov19">
  <h8>Name</h8>
</div>

<div class="notes-panelnov19">
  <h10>Notes</h10>
</div>

<div class="rates-panelnov19">
  <h11>Rates</h11>
</div>
      
      <div class="clear"></div>
  <!--row 1-->
  <?php
  $sql15="select review_id, review_cat_id, review_opinion, review_rate from tbl_review where review_cat_id in (select cat_id from tbl_category where cat_parent_id!=0 ) order by $mod1 DESC limit 0,9";
  //echo $sql15;
  $rs15=mysql_query($sql15);
  while($row15=mysql_fetch_array($rs15))
  {
	$sql16="select cat_name, cat_thumb_img, cat_parent_id from tbl_category where cat_id=".$row15['review_cat_id'];
	//echo $sql16;
	$rs16=mysql_query($sql16);
	$row16=mysql_fetch_array($rs16);
	if($row15['review_rate']>0)
	{
		$color="red";  
	} 
	else
	{
		$color="black";
	}	
	if($row16['cat_thumb_img']=="")
	{
		$lsrc="images/norevimage.jpg";
	}
	else
	{	
		$lsrc="cat_images/".$row16['cat_thumb_img'];
	}	
	/*if($row16['cat_thumb_img']=="")
	{
		$lsrc="images/norevimage.jpg";
	}
	else
	{	
		$lsrc="cat_images/".$row16['cat_thumb_img'];
	}*/	
	$rate=$row15['review_opinion'];
	if($rate=="-0")
	{
		$rate="0";
	}	
	$sql17="select cat_parent_id, cat_img, cat_thumb_img from tbl_category where cat_id=".$row16['cat_parent_id'];
	//echo $sql17;
	$rs17=mysql_query($sql17);
	$row17=mysql_fetch_array($rs17);
	if($row17['cat_parent_id']=="0")
	{
		$ssrc="uploads/".$row17['cat_img'];
	}
	else
	{
		$ssrc="cat_images/".$row17['cat_img'];
	}	
  ?>
  <a href="infowall_review.php?cat_id=<?php echo $row15['review_cat_id']?>"><div class="border-round">
    <div class="images-left-panel views-field round-img<?php echo $color?>-newgeneral">
    <img src="<?php echo $lsrc?>" border="0"  alt="#" style="height:120px;width:300px;"/>
    <h6 style="padding-left:80px; margin-top:-27px;"><?php echo $row16['cat_name']?></h6>
    </div>
    <div class="top-image-panel"><img src="<?php echo $ssrc?>" alt="#"  border="0" style="width:53px;height:53px;background-color:#ffffff"/></div>
    <div class="notes-panel middle-text">
      <div class="internal-panel">
        <div class="panel">
          <p style=" position: relative; top: -50%"><a href="discuss_review.php?rev_id=<?php echo $row15['review_id']?>"><?php echo $row15['review_opinion']?></a></p>
        </div>
      </div>
    </div>
    <div class="rate-panel" align="right"><img src="images/rate/bigrate<?php echo $row15['review_rate']?>.png" alt="#" class="rate-img" border="0" /></div>
  </div></a>
  <div class="clear"></div>
		    
			
		<?php
		
		}
			
		?>	
		
<?php include ("footer.php")?>
</div> 	
