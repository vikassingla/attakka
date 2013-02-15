<?php include("header.php");

$cat_id=$_GET['cat_id'];
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
$sql1="select rev_img from tbl_review_image where rev_cat_id=".$cat_id." order by RAND()";
//echo $sql1;
$rs1=mysql_query($sql1);
$row1=mysql_fetch_array($rs1);
if($row1['rev_img']=="")
{
	$src="images/norevimage.jpg";
}
else
{
	$src="review_images/".$row1['rev_img'];
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
  <a href="infowall.php?cat_id=<?php echo $cat_id;?>"><img src="<?php echo $src?>" alt="" class="image-border" /></a>
  <h7 style="padding-left:10px;bottom:6;"><?php echo $row['cat_name']?></h7>
  
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

<script type="text/javascript" src="global/metrics/js/s_code_h.js"></script>


<div id="main" data-hires="true" style="z-index:15000;">
		<div class="productbrowser content grey-back-new" id="pb-mac">
         <div class="pb-pageindicator roundedbottom" id="pb-pi-mac"><div>
		<b class="caret"></b>
		<a class="page">Bairros</a>
		<a class="page"> Comida</a>
		<a class="page">Preços</a>
		
	</div></div>
	<!--<div class="pb-slider">
		<div class="pb-slide">
			<ul class="ul-slider">
				<li class="pb-macbookair"><a href="restaurant-categories-Bairros.html">Copacabana</a></li>
				<li class="pb-macbookpro"><a href="#">Ipanema</a></li>
				<li class="pb-macmini"><a href="#">Tijuca</a></li>
				<li class="pb-imac"><a href="#">Barra</a></li>
				<li class="pb-macpro"><a href="#">Leblom</a></li>
				<li class="pb-macosx"><a href="#">Botafogo</a></li>
                <li class="pb-macosx"><a href="#">Flamengo</a></li>
                <li class="pb-macosx"><a href="#">Humaita</a></li>
                <li class="pb-macosx"><a href="#">Urca</a></li>
			</ul>

			<ul class="ul-slider">
				<li class="pb-ilife"><a href="#">Tailandesa</a></li>
				<li class="pb-iwork"><a href="#">Japonesa</a></li>
				<li class="pb-safari"><a href="#">Italiana</a></li>
				<li class="pb-aperture"><a href="#">Portuguesa</a></li>
				<li class="pb-finalcut"><a href="#">Kilo</a></li>
				<li class="pb-logicpro"><a href="#">Pizzaria</a></li>
                <li class="pb-logicpro"><a href="#">Rodizio</a></li>
                <li class="pb-logicpro"><a href="#">Churrascaria</a></li>
                <li class="pb-logicpro"><a href="#">Chinesa</a></li>
                <li class="pb-logicpro"><a href="#">Brasileira</a></li>
			</ul>

			<ul class="ul-slider">
				<li class="pb-keyboard"><a href="#">Pe sujo</a></li>
				<li class="pb-magicmouse"><a href="#">Caro Demais</a></li>
				<li class="pb-magictrackpad"><a href="#"> Na conta</a></li>
				
			</ul>

			
		</div>
	</div>-->

	
</div>
<script src="global/scripts/productbrowser.js" type="text/javascript" charset="utf-8"></script>

	<!--/showcase-->


  </div>
             <!--slider content-->
             
             
             <div class="clear"></div>
             
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
                
                
                <div class="clear"></div>
 <?php
  $sql15="select review_id, review_cat_id, review_opinion, review_rate from tbl_review where review_cat_id in (select cat_id from tbl_category where cat_parent_id=$cat_id ) order by $mod1 DESC limit 0,9";
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
		$ssrc="cat_images/".$row17['cat_thumb_img'];
	}	
  ?>
  <a href="infowall_review.php?cat_id=<?php echo $row15['review_cat_id']?>"><div class="border-round">
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
		    
			
		<?php
		
		}
			
		?>	
		<?php include ("footer.php")?>
		</div> 	


