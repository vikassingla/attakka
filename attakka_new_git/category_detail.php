<?php include("header.php");
ob_start();
$cat_id=$_GET['cat_id'];
$exist=isCreategoryIdExist($cat_id);
if($exist)
{
	print '
	<script>
	window.location.href="all_category.php";
	</script>
	';
}	
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
$sql="select cat_id, cat_name from tbl_category where cat_id=".$cat_id;
//echo $sql;
$rs=mysql_query($sql);
$row=mysql_fetch_array($rs);

$sqlfb = "select fav_id from tbl_favorites where cat_id='$cat_id' and user_id='$user_id'";

$rsfb=mysql_query($sqlfb);
if(mysql_num_rows($rsfb)>0)
{
	$srcfb="images/yellow_star.png";
}	
else
{
	$srcfb="images/big_star.png";
}	


?> 
<div class="internal-wrapper">
<div style="margin-top:100px;position:relative">


 <img onclick="xajax_bannerFavorites(<?php echo $cat_id?>)" id="bannerfav" src="<?php print $srcfb;?>" style="  cursor:pointer; float: right;     margin-left: 943px;     margin-top: 10px;     position: absolute;">


<?php
$sql1="select cat_name, cat_banner_img from tbl_category where cat_id=".$cat_id;
	$rs1=mysql_query($sql1);
	$row1=mysql_fetch_array($rs1);
	if($row1['cat_banner_img']!="" && file_exists('review_images/'.$row1['cat_banner_img']))
	{
		$src="review_images/".$row1['cat_banner_img'];
	}
	else
	{	
		$src="images/norevimage.jpg";
	}		
?>
<?php
$img=explode("php",$_SERVER['REQUEST_URI']);
//echo $img[1];
$img4=explode("&",$img[1]);	
//echo $img4[1];
if(@$img4[1])
{
$img1=explode("=",$img4[1]);
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
else
{
$nav1="black-button";	
$nav2=$nav3=$nav4="heading-black";
}		
	
	
?>
	<script src="global/scripts/lib/prototype.js" type="text/javascript" charset="utf-8"></script>
    <script src="http://images.apple.com/global/scripts/lib/scriptaculous.js" type="text/javascript" charset="utf-8"></script>
	<script src="global/scripts/browserdetect.js" type="text/javascript" charset="utf-8"></script>
	<script src="global/scripts/apple_core.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="global/styles/base.css" type="text/css" />
    <link rel="stylesheet" href="global/styles/productbrowser-style27-nov.css" type="text/css" />
	
	<script type="text/javascript">
		document.write('<style type="text/css">.productbrowser { opacity:0; }<\/style>');
		if (AC.Detector.isCSSAvailable('transition')) {
			document.write('<link rel="stylesheet" href="global/styles/reveal.css" type="text/css" />');
		}
	</script>
  <a href="infowall.php?cat_id=<?php echo $cat_id;?>"><img src="<?php echo $src?>" alt="" class="image-border" /></a>
  <h7 style="padding-left:10px;bottom:6;"><?php echo $row['cat_name']?></h7>
   
  </div>
  <div style="float:right;margin-right:40px;">
	<a href="create_rev.php?cat_id=<?php echo $cat_id;?>"><img src="images/review-btrn.png" alt="" style="" /></a>		 
	</div>
			 <div style="margin-top:40px; margin-bottom:20px;" ><img src="images/banner/banner-ad2.png" alt="#"  class="image-border"/></div>
			 
			 <div class="clear"></div>
             
             <!--slider content-->
             <script type="text/javascript">
/* RSID: */
var s_account="applebrglobal"
</script>
<style>
.crev a
{
	color:#000000;
	text-decoration:none;
}
.crev a:hover
{
	color:#C52B31;
	text-decoration:none;
}		
</style>
	<script type="text/javascript">
		document.write('<style type="text/css">.productbrowser { opacity:0; }<\/style>');
		if (AC.Detector.isCSSAvailable('transition')) {
			document.write('<link rel="stylesheet" href="global/styles/reveal.css" type="text/css" />');
		}
	</script>
<script type="text/javascript" src="global/metrics/js/s_code_h.js"></script>

	<?php
	/*$fil_name=filtername($cat_id);
	//echo count($fil_name);
	if(count($fil_name)>0)
	{
		print '
		<div id="main" data-hires="true" style="z-index:15000;">
		<div class="productbrowser content grey-back-new" id="pb-mac">
         <div class="pb-pageindicator roundedbottom" id="pb-pi-mac"><div>
		<b class="caret"></b>';
		foreach($fil_name as $fi)
		{
			//echo $fi;
			$name=strstr($fi,"=",true);
			$id=strstr($fi,"=");
			//echo $id;
			$id1=substr($id,1);
			


			print '<a class="page" id="filterid'.$id1.'">'.$name.'</a>';
		}
		print '	</div></div>'	;
	}	*/
	/*if(count($fil_name1)>0)
	{
		
	}	
	*/
	?>
			
		
	<!--	

	<div class="pb-slider">
		<div class="pb-slide">
		<?php/*
		foreach($fil_name as $fi)
	{
		$id=strstr($fi,"=");
		//echo $id;
		$id1=substr($id,1);
		print '	<ul class="ul-slider" style="width:350px">';
		$fil_name1=array();
		$fil_name1=explode(",",filtervalue($id1));
		 
		//print_r($fil_name1);
		
			foreach($fil_name1 as $fil1)
	{
		print '	
				
                <li class="pb-macosx"><a href="#">'.$fil1.'</a></li>';
		
	}
		print '</ul>';			}*/?>
		</div>
	</div>

	
</div>
<script src="global/scripts/productbrowser.js" type="text/javascript" charset="utf-8"></script>

	<!--/showcase-->

<!--
  </div>
            -->   <!--slider content-->
             
           
             <div class="clear"></div>
             <!--
               <div class="bestfive-panel">
  <h12>Best Five</h12>
</div>

       <div class="worsefive-panel-new">
  <h14>worse Five</h14>
</div>

<div class="clear"></div>

 <div id="left-panel-restaurantcategories"><iframe src="scroller-left-restaurant.php?cat_id=<?php echo $cat_id?>" allowtransparency="0" width="470" height="520" frameborder="0" scrolling="no"></iframe></div>
 
  <div id="right-panel-restaurantcategories"><iframe src="scroller-right-restaurant.php?cat_id=<?php echo $cat_id?>" allowtransparency="0" width="465" height="520" frameborder="0" scrolling="no"></iframe></div> 	
  <div class="clear"></div>
  <div class="grey-round-bar heading-black">
  <div style="padding-left:5px;float:left">
  <a style="text-decoration:none; padding-right:20px" class="<?php echo $nav1; ?>" href="category_detail.php?cat_id=<?php echo$cat_id?>&mod=hot">HOT</a> 
  <a style="text-decoration:none; padding-right:20px;" class="<?php echo $nav2; ?>" href="category_detail.php?cat_id=<?php echo $cat_id?>&mod=new">NEW</a> 
  <a style="text-decoration:none; padding-right:20px;" class="<?php echo $nav3; ?>" href="#">RANK</a> 
  <a style="text-decoration:none; padding-right:20px;" class="<?php echo $nav4; ?>" href="#">FANS</a>
  </div> 
  <div style="padding-right:5px;float:right" class="crev">
  <a href="create_review.php?cat_id=<?php echo $cat_id?>">CREATE A REVIEW</a>
  </div>
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
                
                
                <div class="clear"></div>-->
                	<?php 
		?>
 <?php

	/*$sql16="select cat_name, cat_banner_img from tbl_category where cat_id=".$cat_id;
	echo $sql16;
	$rs16=mysql_query($sql16);
	$row16=mysql_fetch_array($rs16);
		
	if($row16['cat_banner_img']=="")
	{
		$lsrc="images/norevimage.jpg";
	}
	else
	{	
		$lsrc="review_images/".$row16['cat_banner_img'];
	}	
*/
	
  ?>
 <!-- <a href="infowall_review.php?cat_id=<?php echo $row15['review_cat_id']?>"><div class="border-round">
    <div class="images-left-panel views-field round-img<?php echo $color?>-newgeneral">
    <img src="<?php echo $lsrc?>" border="0"  alt="#" style="height:120px;width:300px;"/>
    <h6 style="padding-left:10px; margin-top:-27px;width:270px;"><?php echo $row16['cat_name']?></h6>
    </div>
   </a> 
    <div class="notes-panel middle-text">
      <div class="internal-panel">
        <div class="panel">
          <p style=" position: relative; top: -50%"><a href="discuss_review.php?rev_id=<?php echo $row15['review_id']?>"><?php echo $row15['review_opinion']?></a></p>
        </div>
      </div>
    </div>
    <div class="rate-panel" align="right"><img src="images/rate/bigrate<?php echo $row15['review_rate']?>.png" alt="#" class="rate-img" border="0" /></div>
  </div>
  <div class="clear"></div>
		    
			-->
		
	
		<?php include ("footer.php")?>
		</div> 	


