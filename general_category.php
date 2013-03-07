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
$adjacents = 3;
//echo $query1;
$total_pages = getAllReviewsOfAllCategoryTotal();
//echo $total_pages;
$limit = 5; 								//how many items to show per page
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
				$pagination.= "<a href=\"category_detail.php&mod=$mod&page=$prev\">&laquo; </a>";
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
						$pagination.= "<a href=\"general_category.php?mod=$mod&page=$counter\">$counter</a>";					
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
							$pagination.= "<a href=\"general_category.php?mod=$mod&page=$counter\">$counter</a>";					
					}
					$pagination .= "<span class=\"elipses\">...</span>";
					$pagination.= "<a href=\"general_category.php?mod=$mod&page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"general_category.php?mod=$mod&page=$lastpage\">$lastpage</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href=\"general_category.php?mod=$mod&page=1\">1</a>";
					$pagination.= "<a href=\"general_category.php?mod=$mod&page=2\">2</a>";
					$pagination .= "<span class=\"elipses\">...</span>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"general_category.php?mod=$mod&page=$counter\">$counter</a>";					
					}
					$pagination .= "<span class=\"elipses\">...</span>";
					$pagination.= "<a href=\"general_category.php?mod=$mod&page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"general_category.php?mod=$mod&page=$lastpage\">$lastpage</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<a href=\"general_category.php?mod=$mod&page=1\">1</a>";
					$pagination.= "<a href=\"general_category.php?mod=$mod&page=2\">2</a>";
					$pagination .= "<span class=\"elipses\">...</span>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"general_category.php?mod=$mod&page=$counter\">$counter</a>";					
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination.= "<a href=\"general_category.php?mod=$mod&page=$next\"> &raquo;</a>";
			else
				$pagination.= "<span class=\"disabled\"> &raquo;</span>";
			$pagination.= "</div>\n";		
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
<style type="text/css">


.numbertext-new-general {
    color: #D03F2A;
    float: left;
    font-family: "Times New Roman",Times,serif;
    font-size: 46px;
    font-weight: bold;
    margin-right: 5px;
    width: 33px;
    margin-top:20px;
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


.views-field {
    overflow: hidden;
}



	 .clear{
	 clear:both;
	 }
	 
	 .numbertext-new{
  font-size: 46px;
  background:-webkit-gradient(linear, left top, left bottom, from(#d03f2a), to(#ed9285));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  width:30px;
  float:left;
  margin-right:5px;
  color:#d03f2a;
  font-weight:bold;
   font-family:"Times New Roman", Times, serif;
	
}

.red-border-new-170ct{
width:291px;
height:89px;
float:left;
z-index:1;
background: url("images/redborder-small-new.png") no-repeat;
margin-bottom:10px;

}
	 
.subcategoryhorror-new17oct {
    border: 1px solid #E1503A;
    border-radius: 5px 5px 5px 5px;
    float: left;
    height: 83px;
    margin: 2px 5px 5px 2px;
    width: 285px;
    z-index: 2;
}

.nametop-heading-box-horror8thnov {
    background: url("images/black-bar.png") repeat-x scroll 0 0 transparent;
    border-radius: 0 0 4px 4px;
    color: #FFFFFF;
    font-family: 'CalibriRegular';
    font-size: 14px;
    font-weight: normal;
    line-height: 20px;
    margin-top: -24px;
    padding-left: 77px;
    position: absolute;
    text-shadow: 1px 2px 1px #000000;
    width: 208px;
}


.rate-panel-right{
	width:81px;
	float:left;
	margin-left:10px;
	margin-top:6px;
}

.top-image-panel-general {
    border: 3px solid #FFFFFF;
    box-shadow: 1px 2px 2px #DADADA;
    float: left;
    height: 53px;
    margin-left: 11px;
    position: relative;
    width: 53px;
    z-index: 2;
    margin-top:-68px;
    background-color:#fff;
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

.nametop-heading-box-horror8thnov {
    background: url("images/black-bar.png") repeat-x scroll 0 0 transparent;
    border-radius: 0 0 4px 4px;
    color: #FFFFFF;
    font-family: 'CalibriRegular';
    font-size: 14px;
    font-weight: normal;
    line-height: 20px;
    margin-top: -20px;
    padding-left: 77px;
    position: absolute;
    text-shadow: 1px 2px 1px #000000;
    width: 208px;
}


.top-image-panel-general {
    border: 3px solid #FFFFFF;
    box-shadow: 1px 2px 2px #DADADA;
    float: left;
    height: 53px;
    margin-left: 11px;
    margin-top: -65px;
    position: relative;
    width: 53px;
    z-index: 2;
    background-color:#fff;
}
.rate-panel-right{
	width:81px;
	float:left;
	margin-left:10px;
	margin-top:6px;
}

.numbertext-new-rightgeneral{
  font-size: 46px;
  background:-webkit-gradient(linear, left top, left bottom, from(#000), to(#ccc));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  width:55px;
  float:left;
  margin-right:10px;
  color:#000;
  font-weight:bold;
  font-family:"Times New Roman", Times, serif;
  line-height:35px;
  margin-top:20px;
}


.small-number-text-black{
font-family:"Times New Roman", Times, serif;
font-size:22px;
color:#000;
font-weight:bold;
}
	

.clear{
clear:both;
}

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
          <!--<div id="left-panel-restaurantcategories-24nov"><iframe src="scroller-left-general.php" allowtransparency="0" width="482" height="520" frameborder="0" scrolling="no"></iframe></div>-->
          <div id="left-panel-restaurantcategories-24nov">
          
          
          
          <div id="ca-container" class="ca-container">
			<div class="ca-wrapper">
			<div class="ca-item ca-item-1">
			<div class="ca-item-main">
			<?php	
	         $getBest=getBestOfAllCategory('desc');
	        // echo '<pre>';
	         //print_r($getBest);die;
	         if(count($getBest)>0)
	         {
				 $i=0;
				 foreach($getBest as $gb)
				 {
					$reviewImg='review_images/'.$gb['review_img'];
					$catImg='review_images/'.$gb['cat_img'];
					$catName=$gb['cat_name'];
					$rate=ceil($gb['avg']);
					if(empty($gb['review_img']) || !file_exists($reviewImg))
					{
						//$reviewImgsrc='images/norevimage.jpg';
						$reviewImgsrc='images/red-blank1.jpeg';
					}
					else
					{
						$reviewImgsrc='review_images/'.$gb['review_img'];
					}
					if(empty($gb['cat_img']) || !file_exists($catImg))
					{
						//$catImgsrc='images/norevimage.jpg
						$catImgsrc='images/new.png';
					}
					else
					{
						$catImgsrc='review_images/'.$gb['cat_img'];
					}
					if(empty($rate))
					{
						$rate=0;
					}
					$i++;
			        
				?>			
				<div class="numbertext-new-general"><?php echo $i;?><sup style="font-size:16px;">0</sup></div> 
				<div class="red-border-new-170ct">
				<a href="review_detail.php?review_id=<?php echo $gb['review_id']?>">
					<div class="views-field subcategoryhorror-new17oct">
						<img alt="#" src="<?php echo $reviewImgsrc;?>" style="width:300px;height:83px;">
						<?php
						if(empty($gb['review_img']) || !file_exists($reviewImg))
						{
						?>
						<div class="nametop-heading-box-horror8thnov"><?php echo $catName;?></div>
						<div class="nametop-heading-box-horror8thnov" style="background:none;margin-top:-55px;text-align:center;padding-left:40px;"><?php echo $gb['review_title'];?></div>
						<?php
					    }
					    else
					    {
					    ?>
					    <div class="nametop-heading-box-horror8thnov"><?php echo $catName;?></div>
					    <?php
					    }
					     ?>
						<div class="top-image-panel-general"><img src="<?php echo $catImgsrc?>" alt="#" style="width:53px;height:53px;" /></div>
					</div>
					</a>
				</div>	
				<div class="rate-panel-right"><img alt="#" src="images/rate/middlerate<?php echo$rate?>.png"></div>
				<div class="clear"></div>
				<?php
				}
			 }
		   //closing loop
			?>
					</div>
				</div>
			</div>
		</div>  
		
         </div>
         
		<!-- <div id="right-panel-restaurantcategories-24nov"><iframe src="scroller-right-general.php" allowtransparency="0" width="515" height="520" frameborder="0" scrolling="no"></iframe></div> -->
		 <div id="right-panel-restaurantcategories-24nov">
		 
		 <div id="ca-container" class="ca-container">
	<div class="ca-wrapper">
		<div class="ca-item ca-item-1">
			<div class="ca-item-main">
			<?php	
			$getBest=getBestOfAllCategory('asc');
	        // echo '<pre>';
	         //print_r($getBest);die;
	         if(count($getBest)>0)
	         {
				 $i=0;
				 foreach($getBest as $gb)
				 {
					$reviewImg='review_images/'.$gb['review_img'];
					$catImg='review_images/'.$gb['cat_img'];
					$catName=$gb['cat_name'];
					$rate=ceil($gb['avg']);
					if(empty($gb['review_img']) || !file_exists($reviewImg))
					{
						//$reviewImgsrc='images/norevimage.jpg';
						$reviewImgsrc='images/red-blank1.jpeg';
					}
					else
					{
						$reviewImgsrc='review_images/'.$gb['review_img'];
					}
					if(empty($gb['cat_img']) || !file_exists($catImg))
					{
						//$catImgsrc='images/norevimage.jpg';
						$catImgsrc='images/new.png';
					}
					else
					{
						$catImgsrc='review_images/'.$gb['cat_img'];
					}
					if(empty($rate))
					{
						$rate=0;
					}
					$i++;
			        
				?>
				<div class="numbertext-new-rightgeneral"><?php echo $i?><sup style="font-size:16px;">0</sup> 
				</div>
				<div class="black-border-new-170ct">
				<a href="review_detail.php?review_id=<?php echo $gb['review_id']?>">
					<div class="views-field subcategoryhorror-new17oct-black">
						<img alt="#" src="<?php echo $reviewImgsrc?>" style="width:300px;height:83px;">
						<?php
						if(empty($gb['review_img']) || !file_exists($reviewImg))
						{
						?>
						<div class="nametop-heading-box-horror8thnov"><?php echo $catName;?></div>
						<div class="nametop-heading-box-horror8thnov" style="background:none;margin-top:-55px;text-align:center;padding-left:40px;"><?php echo $gb['review_title'];?></div>
						<?php
					    }
					    else
					    {
					    ?>
					    <div class="nametop-heading-box-horror8thnov"><?php echo $catName;?></div>
					    <?php
					    }
					     ?>
						<div class="top-image-panel-general"><img src="<?php echo $catImgsrc?>" alt="#" style="width:53px;height:53px;"/></div>
					</div>
					</a>
				</div>
				<div class="rate-panel-right"><img alt="#" src="images/rate/middlerate<?php echo$rate?>.png"></div>
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
              

  
  
   <div class="clear"></div>
  
  
  <div class="grey-round-bar heading-black">
	  <div style="padding-left:5px;float:left" id="navdiv">
	  <a style="text-decoration:none; padding-right:20px" class="<?php if ($_GET['mod']=="hot") {echo "black-button";} else {  echo "heading-black"; } ?>" href="general_category.php?mod=hot">HOT</a> 
	  <a style="text-decoration:none; padding-right:20px;" class="<?php if ($_GET['mod']=="new") {echo "black-button";} else {  echo "heading-black"; } ?>" href="general_category.php?mod=new">NEW</a> 
	  <a style="text-decoration:none; padding-right:20px;" class="<?php if ($_GET['mod']=="rank") {echo "black-button";} else {  echo "heading-black"; } ?>" href="#">RANK</a> 
	  <a style="text-decoration:none; padding-right:20px;" class="<?php if ($_GET['mod']=="fan") {echo " black-button";} else {  echo "heading-black"; } ?>" href="#">FANS</a>
</div> 
  
  <div class="clear"></div>
	<?php echo $pagination?>
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
			    $getAll=getAllReviewsOfAllCategory($start,$limit,$mod);
			     //echo '<pre>';
			     //print_r($getAll);die;
			     if (count($getAll)>0)
			     {
					foreach($getAll as $revs)
					{
						$reviewImg='review_images/'.$revs['review_img'];
						$catImg='review_images/'.$revs['cat_img'];
						//echo $reviewImg."<br>";
						if(empty($revs['review_img']) || !file_exists($reviewImg))
						{
							//$imgsrc='images/norevimage.jpg';
							$imgsrc='images/red-blank1.jpeg';
						}
						else
						{
							$imgsrc='review_images/'.$revs['review_img'];
						}
						if(empty($revs['cat_img']) || !file_exists($catImg))
						{
							//$catsrc='images/norevimage.jpg';
							$catsrc='images/new.png';
						}
						else
						{
							$catsrc='review_images/'.$revs['cat_img'];
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
				  <a href="review_detail.php?review_id=<?php echo $revs['review_id']?>"><div class="border-round">
					<div class="images-left-panel views-field round-img<?php echo $color?>-newgeneral">
					<img src="<?php echo $imgsrc;?>" border="0"  alt="#" style="height:120px;width:300px;"/>
					<?php
					if(empty($revs['review_img']) || !file_exists($reviewImg))
					{
					?>
					<h6 style="padding-left:80px; margin-top:-38px;width:205px;"><?php echo $revs['cat_name']?></h6>
					<h6 style="text-align:center;margin-top:-80px;background:none;padding-left:40px;"><?php echo $revs['review_title']?></h6>
					<?php
					}
					else
					{
					 ?>
					  <h6 style="padding-left:80px; margin-top:-37px;width:205px;"><?php echo $revs['cat_name']?></h6>
					 <?php
					}
				    ?> 
					</div>
					<div class="top-image-panel"><img src="<?php echo $catsrc;?>" alt="#"  border="0" style="width:53px;height:53px;background-color:#ffffff"/></div>
					<div class="notes-panel middle-text">
					  <div class="internal-panel">
						<div class="panel">
						  <p style=" position: relative; top: -50%"><a style="color: #383838; font-family: 'CalibriRegular';font-size: 18px;line-height: 28px;text-decoration:none;" href="#"><?php echo $revs['review_opinion']?></a></p>
						</div>
					  </div>
					</div>
					<div class="rate-panel" align="right"><img src="<?php echo $rateimg;?>" alt="#" class="rate-img" border="0" /></div>
				  </div></a>
				  <div class="clear"></div>
				
				<?php
				  }
				}
				?>	
		
<?php include ("footer.php")?>
</div> 	
