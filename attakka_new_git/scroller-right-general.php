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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/style-scroller-mms-right-general.css" />
<style>
body{
	margin:0px;
	padding:0px;
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
</head>
<body>
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
						$reviewImgsrc='images/norevimage.jpg';
					}
					else
					{
						$reviewImgsrc='review_images/'.$gb['review_img'];
					}
					if(empty($gb['cat_img']) || !file_exists($catImg))
					{
						$catImgsrc='images/norevimage.jpg';
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
					<div class="views-field subcategoryhorror-new17oct-black">
						<img alt="#" src="<?php echo $reviewImgsrc?>" style="width:300px;height:83px;">
						<div class="nametop-heading-box-horror8thnov"><?php echo $catName;?></div>
						<div class="top-image-panel-general"><img src="<?php echo $catImgsrc?>" alt="#" style="width:53px;height:53px;"/></div>
					</div>
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
</body>
</html>
