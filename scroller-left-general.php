<?php
include("config.php");
session_start();
//print_r($_SESSION);
$con= mysql_connect(DB_HOST, DB_USER_NAME,DB_PASSWORD); 
if(!$con)
{
		die('Could not connect: ' . mysql_error());
}	
mysql_select_db(DB_NAME);
	
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta content="charset=utf-8">
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

	<link rel="stylesheet" type="text/css" href="css/style-scroller-mms.css" />
	<style>
body{
	margin:0px;
	padding:0px;
}

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
</style>
</head>

<body>

	
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
						$reviewImgsrc='images/red-blank.jpeg';
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
</body>
</html>
