<?php include("header.php");
ob_start();

if(isset($_GET['cat_id']))
{
	$cat_id=$_GET['cat_id'];
}
else
{
	print '
	<script>
	window.location.href="all_category.php";
	</script>
	';
}
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
$adjacents = 3;
//echo $query1;
$total_pages = getAllReviewsOfCategoryTotal($cat_id);
//echo $total_pages;
$limit = 10; 								//how many items to show per page
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
				$pagination.= "<a href=\"category_detail.php?cat_id=".$cat_id."&mod=$mod&page=$prev\">&laquo; </a>";
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
						$pagination.= "<a href=\"category_detail.php?cat_id=".$cat_id."&mod=$mod&page=$counter\">$counter</a>";					
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
							$pagination.= "<a href=\"category_detail.php?cat_id=".$cat_id."&mod=$mod&page=$counter\">$counter</a>";					
					}
					$pagination .= "<span class=\"elipses\">...</span>";
					$pagination.= "<a href=\"category_detail.php?cat_id=".$cat_id."&mod=$mod&page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"category_detail.php?cat_id=".$cat_id."&mod=$mod&page=$lastpage\">$lastpage</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href=\"category_detail.php?cat_id=".$cat_id."&mod=$mod&page=1\">1</a>";
					$pagination.= "<a href=\"category_detail.php?cat_id=".$cat_id."&mod=$mod&page=2\">2</a>";
					$pagination .= "<span class=\"elipses\">...</span>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"category_detail.php?cat_id=".$cat_id."&mod=$mod&page=$counter\">$counter</a>";					
					}
					$pagination .= "<span class=\"elipses\">...</span>";
					$pagination.= "<a href=\"category_detail.php?cat_id=".$cat_id."&mod=$mod&page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"category_detail.php?cat_id=".$cat_id."&mod=$mod&page=$lastpage\">$lastpage</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<a href=\"category_detail.php?cat_id=".$cat_id."&mod=$mod&page=1\">1</a>";
					$pagination.= "<a href=\"category_detail.php?cat_id=".$cat_id."&mod=$mod&page=2\">2</a>";
					$pagination .= "<span class=\"elipses\">...</span>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"category_detail.php?cat_id=".$cat_id."&mod=$mod&page=$counter\">$counter</a>";					
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination.= "<a href=\"category_detail.php?cat_id=".$cat_id."&mod=$mod&page=$next\"> &raquo;</a>";
			else
				$pagination.= "<span class=\"disabled\"> &raquo;</span>";
			$pagination.= "</div>\n";		
		}
?> 
<div class="internal-wrapper">
<div style="margin-top:100px;position:relative">

<div style="width:100%;left:0px;top:0px;position:absolute;">
 <img onclick="xajax_bannerFavorites(<?php echo $cat_id?>)" id="bannerfav" src="<?php print $srcfb;?>" style="  cursor:pointer; float: left;     margin-left: 13px;     margin-top: 10px;">
  <div style="float:right;margin-right:40px;margin-top:10px;">
	<a href="create_rev.php?cat_id=<?php echo $cat_id;?>"><img src="images/review-btrn.png" alt="" style="" /></a>		 
	</div>
</div>
	

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

  <a href="infowall.php?cat_id=<?php echo $cat_id;?>"><img src="<?php echo $src?>" alt="" class="image-border" /></a>
  

  <h7 style="padding-left:10px;bottom:9px;width:979px;"><?php echo $row['cat_name']?></h7>
   
  </div>

			 <div style="margin-top:40px; margin-bottom:20px;" ><img src="images/banner/banner-ad2.png" alt="#"  class="image-border"/></div>
			 
			 <div class="clear"></div>
             
             <!--slider content-->
             <script type="text/javascript">
/* RSID: */
var s_account="applebrglobal"
function redirectTo(loc)
{
	window.location.href(loc);
}
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


.numbertext-new-right {
    color: #000000;
    float: left;
    font-family: "Times New Roman",Times,serif;
    font-size: 46px;
    font-weight: bold;
    margin-left: 9px;
    margin-right: 10px;
    width: 49px;
}
@font-face {
    font-family: 'CalibriRegular';
    src: url('fonts/calibri-webfont.eot');
    src: url('fonts/calibri-webfont.eot?#iefix') format('embedded-opentype'),
         url('fonts/calibri-webfont.woff') format('woff'),
         url('fonts/calibri-webfont.ttf') format('truetype'),
         url('fonts/calibri-webfont.svg#CalibriRegular') format('svg');
    font-weight: normal;
    font-style: normal;

}



.black-border-new-170ct{
width:291px;
height:89px;
float:left;
z-index:1;
margin-bottom:10px;
background: url("images/black-bordernew.png") no-repeat;
}

.views-field {
    overflow: hidden;
}


.subcategoryhorror-new17oct-black {
    border: 1px solid #000;
    border-radius: 5px 5px 5px 5px;
    float: left;
    height: 83px;
    margin: 2px 5px 5px 2px;
    width: 285px;
    z-index: 2;
}

.nametop-heading-box-horror1stnov {
    background: url("images/black-bar.png") repeat-x scroll 0 0 transparent;
    border-radius: 0 0 4px 4px;
    color: #FFFFFF;
    font-family: 'CalibriRegular';
    font-size: 14px;
    font-weight: normal;
    line-height: 20px;
    margin-top: -25px;
    padding-left: 11px;
    position: absolute;
    text-shadow: 1px 2px 1px #000000;
    width: 274px;
}

.rate-panel-right{
	width:81px;
	float:left;
	margin-left:10px;
	margin-top:6px;
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
       -->  <!--slider content-->
             
           
             <div class="clear"></div>
          
               <div class="bestfive-panel">
  <h12>Best Five</h12>
</div>

       <div class="worsefive-panel-new">
  <h14>worse Five</h14>
</div>

<div class="clear"></div>

	<!--<div id="left-panel-restaurantcategories"><iframe src="scroller-left-restaurant.php?cat_id=<?php //echo $cat_id?>" allowtransparency="0" width="470" height="520" frameborder="0" scrolling="no"></iframe></div>-->
	<div id="left-panel-restaurantcategories">
	
	
	<div id="ca-container" class="ca-container">
	<div class="ca-wrapper">
	<div class="ca-item ca-item-1">
	<div class="ca-item-main">	
	<?php
		$best1=getBest($cat_id, 'desc');
		if(count($best1)>0)
		{
			$cntt=0;
			foreach($best1 as $best)
			{
			if($best['reviews']==0)
			{
				$rateimg="images/rate/no-rate.png";
			}	
			else
			{
				$rate=ceil($best['total']/$best['reviews']);
				if($rate=="-0")
				{
					$rate="0";
				}
				$rateimg="images/rate/middlerate$rate.png";
			}	
			if($best['review_img']!="" && file_exists('review_images/'.$best['review_img']))
			{
				$src="review_images/".$best['review_img'];
			}
			else
			{
				//$src="images/norevimage.jpg";
				$src="images/red-blank1.jpeg";
			}
			$cntt++;
		?>
		<div class="numbertext-new-general"><?php echo $cntt;?></div>	
		<div class="red-border-new-170ct">
			<div class="views-field subcategoryhorror-new17oct-black">
			<a href="review_detail.php?review_id=<?php echo $best['review_id'];?>">
				<img alt="#" src="<?php echo $src?>" style="width:300px;height:84px;">
			 </a>
			 <?php
			 if(empty($best['review_img']) || !file_exists('review_images/'.$best['review_img']))
			 {
			  ?>
			  <a href="review_detail.php?review_id=<?php echo $best['review_id'];?>"><h6 style="padding-left:45px; margin-top:-59px;background:none;text-align:center;font:14px Castrella;color:#000000"><?php echo $best['review_title']?></h6></a>
			  <?php
			 }
			  else
			  {
			   ?>
			   <div class="nametop-heading-box-horror1stnov"><?php echo $best['review_title']?></div>
			   <?php
			  }
			  ?>
			</div>
		</div>
		<div class="rate-panel-right"><img alt="#" src="<?php echo $rateimg?>"></div>
		<div class="clear"></div>
			

			<?php
					}
				}
				
					?>

					</div>
				</div>
			</div>	
		</div>
	
	
	

	
	
	</div>
 
	<!--<div id="right-panel-restaurantcategories"><iframe src="scroller-right-restaurant.php?cat_id=<?php //echo $cat_id?>" allowtransparency="0" width="465" height="520" frameborder="0" scrolling="no"></iframe></div> 	-->
	<div id="right-panel-restaurantcategories">
	
	
	
	
	<div id="ca-container" class="ca-container">
	<div class="ca-wrapper">
		<div class="ca-item ca-item-1">
			<div class="ca-item-main">	
			
				<?php
				$best1=getBest($cat_id, 'asc');
				if(count($best1)>0)
				{
					$ct=count($best1);
					foreach($best1 as $best)
					{
					if($best['reviews']==0)
					{
						$rateimg="images/rate/no-rate.png";
					}	
					else
					{
						$rate=ceil($best['total']/$best['reviews']);
						if($rate=="-0")
						{
							$rate="0";
						}
						$rateimg="images/rate/middlerate$rate.png";
					}	
					if($best['review_img']!="" && file_exists('review_images/'.$best['review_img']))
					{
						$src="review_images/".$best['review_img'];
					}
					else
					{
						//$src="images/norevimage.jpg";
						$src="images/red-blank1.jpeg";
					}
					
				?>
                <div class="numbertext-new-general" style="color:black"><?php echo $ct;?></div>
				<div class="black-border-new-170ct">
					<div class="views-field subcategoryhorror-new17oct-black">
					<a href="review_detail.php?review_id=<?php echo $best['review_id'];?>">
						<img alt="#" src="<?php echo $src?>" style="width:300px;height:84px;">
					</a>
					<?php
					 if(empty($best['review_img']) || !file_exists('review_images/'.$best['review_img']))
					 {
					  ?>
					 <a href="review_detail.php?review_id=<?php echo $best['review_id'];?>"> <h6 style="padding-left:45px; margin-top:-59px;background:none;text-align:center;cursor:pointer;font:14px Castrella;color:#000000"><?php echo $best['review_title']?></h6></a>
					  <?php
					  }
					  else
					  {
					   ?>
					   <div class="nametop-heading-box-horror1stnov"><?php echo $best['review_title']?></div>
					   <?php
					  }
					 ?>
					</div>
				</div>
				<div class="rate-panel-right"><img alt="#" src="<?php echo $rateimg?>"></div>
				<div class="clear"></div>
			
			<?php
			$ct--;
				}
				
			}
		
			?>
			</div>
		</div>
		
</div>

</div>
	

	
	</div> 	
  
 
	   <div class="grey-round-bar heading-black">
	  <div style="padding-left:5px;float:left" id="navdiv">
	  <a style="text-decoration:none; padding-right:20px" class="<?php if ($_GET['mod']=="hot" || $mod='hot') {echo "black-button";} else {  echo "heading-black"; } ?>" href="category_detail.php?cat_id=<?php echo$cat_id?>&mod=hot">HOT</a> 
	  <a style="text-decoration:none; padding-right:20px;" class="<?php if ($_GET['mod']=="new") {echo "black-button";} else {  echo "heading-black"; } ?>" href="category_detail.php?cat_id=<?php echo $cat_id?>&mod=new">NEW</a> 
	  <a style="text-decoration:none; padding-right:20px;" class="<?php if ($_GET['mod']=="rank") {echo "black-button";} else {  echo "heading-black"; } ?>" href="#">RANK</a> 
	  <a style="text-decoration:none; padding-right:20px;" class="<?php if ($_GET['mod']=="fan") {echo " black-button";} else {  echo "heading-black"; } ?>" href="#">FANS</a>
	  </div> 
	  <div style="padding-right:5px;float:right" class="crev">
	  <div class="clear"></div>
		<?php echo $pagination?>
		  </div>
		  </div>
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
		if(isset($cat_id))
		{
			$getallReviews=getAllReviewsOfCategory($cat_id,$start,$limit);
			/*echo '<pre>';
			print_r($getallReviews);*/
		    if(count($getallReviews)>0)
		    {
				foreach($getallReviews as $revs)
				{
					/*echo '<pre>';
					print_r($revs);
					*/
					$reviewImg='review_images/'.$revs['review_img'];
					//echo $reviewImg."<br>";
					if(empty($revs['review_img']) || !file_exists($reviewImg))
					{
						//$imgsrc='images/norevimage.jpg';
						$imgsrc='images/red-blank1.jpeg';
						$style1="height:120px;width:283px;border: 1px solid #CCCCCC;";
					}
					else
					{
						$imgsrc='review_images/'.$revs['review_img'];
						$style1="height:120px;width:283px;";
					}
					if(empty($revs['review_title']))
					{
						$title='No title';
					}
					else
					{
						$title=$revs['review_title'];
					}
					if(!empty($revs['avg']))
					{
						$rate=round($revs['avg']);
						$name='bigrate'.$rate.'.png';
						$rateimg='images/rate/'.$name;
					}
					else
					{
						$rateimg='images/rate/no-rate.png';
					}
					if(empty($revs['review_opinion']))
					{
						$revop='No opinion yet';
					}
					else
					{
						$revop=$revs['review_opinion'];
					}
				?>
 
				<a href="review_detail.php?review_id=<?php echo $revs['review_id'];?>"><div class="border-round">
					<div class="images-left-panel views-field round-img<?php echo $color?>-newgeneral">
					<img src="<?php echo $imgsrc;?>"  style="<?php echo $style1?>"/>
					<?php
					if(empty($revs['review_img']) || !file_exists($reviewImg))
					{
					 ?>
					<h6 style="padding-left:10px; margin-top:-76px;width:270px;background:none;text-align:center;font:19px castrella;color:#000000"><?php echo $title;?></h6>
					<?php
				    }
				    else
				    {
					 ?>
					 <h6 style="padding-left:10px; margin-top:-30px;width:270px;"><?php echo $title;?></h6>
					 <?php
				    }
				    ?>
					</div>
				   </a> 
					<div class="notes-panel middle-text">
					  <div class="internal-panel">
						<div class="panel">
						  <p style=" position: relative; top: 50%;padding-top:40px;"><?php echo $revop;?></p>
						</div>
					  </div>
					</div>
					<div class="rate-panel" align="right"><img src="<?php echo $rateimg;?>" alt="#" class="rate-img" border="0" /></div>
				  </div>
				  <div class="clear"></div>
			 

			<?php
					}
				}
			}
			?>
					
<?php include ("footer.php")?>
</div> 	


