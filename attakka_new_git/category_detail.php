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
       -->  <!--slider content-->
             
           
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
  
 
	   <div class="grey-round-bar heading-black">
	  <div style="padding-left:5px;float:left" id="navdiv">
	  <a style="text-decoration:none; padding-right:20px" class="<?php if ($_GET['mod']=="hot") {echo "black-button";} else {  echo "heading-black"; } ?>" href="category_detail.php?cat_id=<?php echo$cat_id?>&mod=hot">HOT</a> 
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
			//echo '<pre>';
			//print_r($getallReviews);
		    if(count($getallReviews)>0)
		    {
				foreach($getallReviews as $revs)
				{
					$reviewImg='review_images/'.$revs['review_img'];
					//echo $reviewImg."<br>";
					if(empty($revs['review_img']) || !file_exists($reviewImg))
					{
						$imgsrc='images/norevimage.jpg';
					}
					else
					{
						$imgsrc='review_images/'.$revs['review_img'];
					}
					if(empty($revs['review_title']))
					{
						$title='No title';
					}
					else
					{
						$title=$revs['review_title'];
					}
					if(empty($revs['review_title']))
					{
						$name='bigrate'.$revs['review_rate'].'png';
						$rateimg='images/rate'.$name;
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
 
				<a href="#"><div class="border-round">
					<div class="images-left-panel views-field round-img<?php echo $color?>-newgeneral">
					<img src="<?php echo $imgsrc;?>" border="0"  alt="#" style="height:120px;width:300px;"/>
					<h6 style="padding-left:10px; margin-top:-27px;width:270px;"><?php echo $title;?></h6>
					</div>
				   </a> 
					<div class="notes-panel middle-text">
					  <div class="internal-panel">
						<div class="panel">
						  <p style=" position: relative; top: -50%"><?php echo $revop;?></p>
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


