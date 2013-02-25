<?php
include("config.php");
session_start();
//print_r($_SESSION);
if($_GET['cat_id'])
{
 $cat_id=$_GET['cat_id'];
 //echo $cat_id;
}	
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta content="charset=utf-8">
	
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

	<link rel="stylesheet" type="text/css" href="css/style-scroller.css" />
	<style>
body{
	margin:0px;
	padding:0px;
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


.red-border-new-170ct{
width:291px;
height:89px;
float:left;
z-index:1;
background: url("images/redborder-small-new.png") no-repeat;
margin-bottom:10px;

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
 
.clear{
	clear:both;
}

</style>
</head>
<body class="loading">
<div id="ca-container" class="ca-container">
	<div class="ca-wrapper">
	<div class="ca-item ca-item-1">
			<div class="ca-item-main">	
<?php
$best1=getBest($cat_id, 'desc');
if(count($best1)>0)
{
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
		$src="images/norevimage.jpg";
	}
?>
	
				<div class="red-border-new-170ct">
					<div class="views-field subcategoryhorror-new17oct-black">
					<img alt="#" src="<?php echo $src?>" style="width:300px;height:84px;">
						<div class="nametop-heading-box-horror1stnov"><?php echo $best['review_title']?></div>
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
	
</body>
</html>
