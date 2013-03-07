<?php
include("config.php");
session_start();
$con= mysql_connect(DB_HOST, DB_USER_NAME,DB_PASSWORD); 
if(!$con)
{
		die('Could not connect: ' . mysql_error());
}	
mysql_select_db(DB_NAME);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<!-- basic meta tags -->
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="index, follow" />



<!-- title -->
<title>ATTAKKA</title>

<script type="text/javascript" src="chromejs/chrome.js"></script>
<link rel="stylesheet" type="text/css" href="css/chromestyle.css" />


<!-- stylesheets -->
<link rel="stylesheet" href="css/style-fresh.css" type="text/css" media="screen" />
<link rel="stylesheet" href="global/styles/base.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

<link rel="stylesheet" href="css/style1.css" type="text/css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="css/style3.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script>
function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#search').addClass('load');
			$.post("autosuggest.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >10) {
					//alert(data.length);
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#search').removeClass('load');
				}
				else
				{
					$('#suggestions').fadeOut();
				}	
			});
		}
	}

function fill(thisValue) {
	$('#search').val(thisValue);
	setTimeout("$('#suggestions').fadeOut();", 600);
}
function checkIsChrome()
{
	var isChrome = window.chrome;
	if(isChrome) {
	  document.getElementById("imgLogo").style.marginTop="0px";
	} 
}
</script>
<script type="text/javascript"> 
      $(document).ready( function() {
        $('#msgacc').delay(4000).fadeOut();
      });
    </script>
<style>
#result {
	height:20px;
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}
#country{
	padding:3px;
	border:1px #CCC solid;
	font-size:17px;
}
.suggestionsBox {
	position: absolute;
	left: 0px;
	top:10px;
	margin: 26px 0px 0px 0px;
	width: 200px;
	padding:0px;
	background-color: #000;
	border-top: 3px solid #000;
	color: #fff;
	left:158px;
	z-index: 1000;
}
.suggestionList {
	margin: 0px;
	padding: 0px;
}
.suggestionList ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
	color:#C51700;
	bacground-color:#000;
}
.suggestionList ul li:hover {
	background-color: #FC3;
	color:#000;
}
ul {
	font-family:CalibriRegular;
	font-size:15px;
	color:#000;
	padding:0;
	margin:0;
}

.load{
background-image:url(image/loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
	position:relative;
}

</style>
<!-- scripts -->

<!-- Internet Explorer 6 PNG Transparency Fix for all elements with class 'ie6fix' -->	
<!--[if IE 6]>
<script type='text/javascript' src='http://www.kriesi.at/themes/newscast/wp-content/themes/newscast/js/dd_belated_png.js'></script>
<script>DD_belatedPNG.fix('.ie6fix');</script>
<style>#footer ul li a, .sidebar ul li a {zoom:1;} #head #searchform, #head #searchform div {position:static;}
</style>
<![endif]-->

<!--[if IE 8]>
	<style>	 .search-back {
    background: url("../images/search-back.png") no-repeat scroll 0 0 transparent;
    float: left;
    height: 66px;
    margin-top: 10px;
    width: 960px;
}
</style>
<![endif]-->

<meta name='robots' content='noindex,nofollow' />

<!--<script type='text/javascript' src='jquery/jquery.js?ver=1.7.2'></script>
<script type='text/javascript' src='jquery/jquery.prettyPhoto.js?ver=3.4'></script>
<script type='text/javascript' src='jquery/custom.js?ver=3.4'></script>-->




<!-- Debugging help, do not remove -->
<meta name="Framework" content="Kpress" />
<meta name="Theme Version" content="2.0" />
<meta name="Framework Version" content="2.1" />
<meta name="CMS Version" content="3.4" />




	
<!-- meta tags, needed for javascript -->
<meta name="autorotate" content="1" />
<meta name="autorotateDelay" content="5" />
<meta name="autorotateSpeed" content="500" />
<meta name="temp_url" content="http://www.kriesi.at/themes/newscast/wp-content/themes/newscast" />
  <script>

    // placeholder polyfill
    $(document).ready(function(){
        function add() {
            if($(this).val() == ''){
                $(this).val($(this).attr('placeholder')).addClass('placeholder');
            }
        }

        function remove() {
            if($(this).val() == $(this).attr('placeholder')){
                $(this).val('').removeClass('placeholder');
            }
        }

        // Create a dummy element for feature detection
        if (!('placeholder' in $('<input>')[0])) {

            // Select the elements that have a placeholder attribute
            $('input[placeholder], innput[placeholder]').blur(add).focus(remove).each(add);

            // Remove the placeholder text before the form is submitted
            $('form').submit(function(){
                $(this).find('input[placeholder], input[placeholder]').each(remove);
            });
        }
    });
</script>
<script>
function closepopup(id)
{
	document.getElementById(id).style.display="none";
}	
</script>
</head>


<body id='top' class="home blog" >
<div id="main-wrapper">
  <div id="right-panel" style="width:365px;"><img src="images/intro-icon.png" alt="#" class="intro-icon" /> <a href="#" class="top-links">intro video</a> 
<?php
	if(@$_SESSION['user_id']!="")
	{
		$getUserDetail=getUserDetail();
		if(count( $getUserDetail)>0)
		{
		// $src= $getUserDetail['account_image'];
			if($getUserDetail['facebook_id']=="")
			{
				if($getUserDetail['account_image']!='')
				{
					$src="uploads/".$getUserDetail['account_image'];
				if(file_exists($src))
				{
					$src="uploads/".$getUserDetail['account_image'];
				}
				else
				{
					$src="images/red_img.png";
				}

				}
				else
				{
					$src="images/red_img.png";
				}		
			}
			else
			{
				if($getUserDetail['account_image']!='')
				{
					$src="uploads/".$getUserDetail['account_image'];
				if(file_exists($src))
				{
					$src="uploads/".$getUserDetail['account_image'];
				}
				else
				{
					$src="http://graph.facebook.com/".$getUserDetail['facebook_id']."/picture?width=60&height=60";
				}
				}
				else
				{
					$src="http://graph.facebook.com/".$getUserDetail['facebook_id']."/picture?width=60&height=60";
				}	
			 }	
		  }	  
	?>
  <a href="logout.php" title="Logout" class="top-links"><img src="images/logout-btrn.png" alt="#" style="margin-top:3px; margin-right:5px;" border="0"/> Logout</a>
  <div class="views-field topuser-img" style="margin:0px 0px 0px 0px;"><a href="user_page.php"><img alt="" src="<?php echo $src?>" style="width:60px;height:60px;"></a></div>
	<div class="name-panel top-user-name" style="margin-top:0px;"><a href="user_page.php"><?php echo $getUserDetail['user_firstname']." ".$getUserDetail['user_lastname']?></a><br /></div>
  <?php
  	}
  else
  {
	?>
	<img src="images/login-icon.png" alt="#" class="login-icon" /> <a href="login.php" class="top-links-login">Login</a> <img src="images/register-icon.png" alt="#" class="register-icon" /> <a href="register.php" class="top-links-register">Register</a>
 <?php 
	}
 ?>
  </div>
  <div class="clear"></div>
	<?php
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
	{
		
		$style='style="margin-top:-40px;margin-left:-110px;"';
	}
	else
	{
		 $style='style="margin-top:28px;margin-left:-110px;"'; 
	}
   ?>
   
	<div class="logo"><a href="index.php"><img id="imgLogo" src="images/logo-attakka1.png" alt="#" border="0" <?php echo $style;?> /></a></div>
  <div class="clear"></div>
  <div class="search-back" style="margin-top:-16px;">
  <form action="main.php" method="POST" style="background:none;">
    <input name="search" id="search" onkeyup="suggest(this.value);" onblur="fill();" type="text" class="search-input" placeholder="Search"/>
 <input type="button" class="search" value="" > <a href="create_rev.php"><img src="images/review-btrn.png" alt="#" style="margin-top:19px;" border="0" /></a></div>

	<?php
			if (isset($_GET['msg'])=='veracc')
			{
				$msg1='A verification link has been sent to your email. Please click there to login and activate your account.<a href="javascript:void(0)" onclick=closepopup("msgacc")><img src="images/cancel1.png" style=" float: right;
   margin-right: 8px; margin-top: 3px;"></a>';
				echo '<div id="msgacc" class="white-wrapper-error" style="width:800px;margin-left:80px;margin-bottom:17px;">'.$msg1.'</div>';
			}
			
			$sql9="select cat_id from tbl_category group by cat_id ORDER BY cat_id DESC limit 0,4";
			//echo $sql;die;
			$rs9=mysql_query($sql9);
			//echo mysql_num_rows($rs);

?>
 
  <div id="site_content" style="margin-top:0px;padding-left:15px;">
      <ul id="images" style="margin:auto;">
        <li><a href="general_category.php">
						<span class='feature_excerpt'>
							<span class='sliderheading'></span></span>				
					<div style="background:url(images/general-bar.png) no-repeat; width:700px; height:370px;">
					<div class="leftpanel-content">GENERAL</div>
					
					<?php	
				$sql12="select review_id, review_img, review_title from tbl_review ORDER BY review_id DESC limit 0,5";
				//echo $sql11;
				$rs12=mysql_query($sql12);
				
				print '<div class="content-panel-new">';
				while($row12=mysql_fetch_assoc($rs12))
				{
					if($row12['review_img']!="" && file_exists('review_images/'.$row12['review_img']))
					{
						$src='review_images/'.$row12['review_img'];
					}
					else
					{
						$src="images/red-blank1.jpeg";
					}
				$sql14="SELECT count(review_rate) as num,SUM(review_rate) as rate FROM tbl_review_map where review_id=".$row12['review_id'];
				//echo $sql14;
				$rs14=mysql_query($sql14);
				$row14=mysql_fetch_array($rs14);
				if($row14['num']=="0")
				{
					$img10="images/rate/no-rate2.png";
				}
				else
				{	
					$rate2=$row14['rate'];
					$no2=$row14['num'];
					//echo $rate." ".$no;
					$avg_rate2=ceil($rate2/$no2);
					if($avg_rate2=="-0")
					{
						$avg_rate2="0";
					}
					//echo $avg_rate;
					$img10="images/rate/smallrate".$avg_rate2.".png";
					
				}	
				?>
				<div class="homepanel-left"><img src="<?php echo $src?>" alt="#" />
				<?php
				if(empty($row12['review_img']) || !file_exists('review_images/'.$row12['review_img']))
				{
				?>
				<p style="padding-left:48px; margin-top:-38px;background:none;text-align:center;color:black;font-size:14px;width:275px;font-weight:bold;"><?php echo $row12['review_title']?></p>
				<?php
			     }
			     else
			     {
			     ?>
					<div class="nametop-heading-box-horror-small1" style="top:34px;"><?php echo $row12['review_title']?></div>
				 <?php
			      }	
			      ?>
				</div>
				<div class="homepanel-right"><img src="<?php echo $img10;?>" /></div>
				<div class="clear"></div>
				<?php
				}
				?>
				</div>
				</div>
				</a>
				</li>
				<?php
				while($row9=mysql_fetch_assoc($rs9))
				{
				$sql4="select cat_name,cat_banner_img from tbl_category where cat_id=".$row9['cat_id'];
				$rs4=mysql_query($sql4);
				$row4=mysql_fetch_array($rs4);
				if(file_exists('uploads/'.$row4['cat_banner_img']))
				{
					$image='uploads/'.$row4['cat_banner_img'];
				}
				else
				{
					$image="images/red-blank1.jpeg";
				}		
				?>
				<li>
					<a href="category_detail.php?cat_id=<?php echo $row9['cat_id']?>">
					<span class='feature_excerpt'>
					<span class='sliderheading'>
				 </span>
				 </span>				
					<div style="background:url(<?php echo $image?>) no-repeat; width:700px; height:370px;position:relative">
					<div class="leftpanel-content" style="position:absolute;z-index:10;top:330px;width:100%;margin-top:0px;width:100%;"><?php echo $row4['cat_name']?></div>
				 
				
				<?php	
				$sql15="select review_id, review_img, review_title from tbl_review where review_cat_id=".$row9['cat_id']." ORDER BY review_id DESC limit 0,5";
				//echo $sql15;
				$rs15=mysql_query($sql15);
				if(mysql_num_rows($rs15)>0)
				{
					
					print '<div class="content-panel-new">';
					while($row15=mysql_fetch_assoc($rs15))
					{
					if($row15['review_img']!="" && file_exists('review_images/'.$row15['review_img']))
					{
						$src1='review_images/'.$row15['review_img'];
					}
					else
					{
						$src1="images/red-blank1.jpeg";
					}
					$sql17="SELECT count(review_rate) as num,SUM(review_rate) as rate FROM tbl_review_map where review_id=".$row15['review_id'];
					$rs17=mysql_query($sql17);
					if(mysql_num_rows($rs17)>0)
					{
						$row17=mysql_fetch_array($rs17);
					}
					if($row17['num']=="0")
					{
						$img11="images/rate/no-rate2.png";
					}
					else
					{	
						$rate1=$row17['rate'];
						$no1=$row17['num'];
						//echo $rate." ".$no;
						$avg_rate1=ceil($rate1/$no1);
						if($avg_rate1=="-0")
						{
							$avg_rate1="0";
						}
						//echo $avg_rate;
						$img11="images/rate/smallrate".$avg_rate1.".png";
					}	
					?>
					
					<div class="homepanel-left"><img src="<?php echo $src1?>" alt="#" />
					<?php
					if(empty($row15['review_img']) || !file_exists('review_images/'.$row15['review_img']))
					{
					 ?>
					<p style="padding-left:48px; margin-top:-38px;background:none;text-align:center;color:black;font-size:13px;width:275px;font-weight:bold;"><?php echo $row15['review_title']?></p>
				    <?php
				    }
				    else
				    {
					 ?>	
					<div class="nametop-heading-box-horror-small1"><?php echo $row15['review_title']?></div>
					<?php
					}
				   ?>
					</div>
						<div class="homepanel-right"><img src="<?php echo $img11?>" />
					</div>
						<div class="clear">
					</div>
					<?php
					}
				}
				else
				{
					
				}	
				?>
				</li>
				<?php

				}
				?>
				<li>
				</a>
					<a href="all_category.php">
					<span class='feature_excerpt'>
					<span class='sliderheading'>
					</span>
					</span>				
					<div style="background:url(images/black-city.png) no-repeat; width:700px; height:370px;">
					<div class="leftpanel-content">MOSAIC</div>
					
					<div class="content-panel-new">
					<?php
					$sql10="select cat_id, cat_name, cat_banner_img from tbl_category group by cat_id ORDER BY cat_id DESC limit 0,5";
					//echo $sql;
					$rs10=mysql_query($sql10);
					if(mysql_num_rows($rs10)>0)
					{
						while($row10=mysql_fetch_assoc($rs10))
						{
						
							$src="review_images/".$row10['cat_banner_img'];
							$sql13="select count(b.review_rate) as num, sum(b.review_rate) as sum from tbl_review a, tbl_review_map b where a.review_id=b.review_id and review_cat_id=".$row10['cat_id'];
							$rs13=mysql_query($sql13);
							$row13=mysql_fetch_array($rs13);
							if($row13['num']=="0")
							{
								$img12="images/rate/no-rate2.png";
							}
							else
							{	
								$rate=$row13['sum'];
								$no=$row13['num'];
								//echo $rate." ".$no;
								$avg_rate=ceil($rate/$no);
								if($avg_rate=="-0")
								{
									$avg_rate="0";
								}
								//echo $avg_rate;
								$img12="images/rate/smallrate$avg_rate.png";
							}
							//echo $rate;
							?>
							<div class="homepanel-left">
								<img src="<?php echo $src?>" alt="#" />
								<div class="nametop-heading-box-horror-small1">
								<?php echo $row10['cat_name']?>
							</div>
							</div>
							<div class="homepanel-right">
								<img src= <?php echo $img12?> />
							</div>
							<div class="clear">
								</div>
							<?php
							}
						}
					?>
					</div>
					</div>
					</a>
					</li>
				</ul>
				 </div>
			</div>
			<div class="clear"></div>
			<div id="footer-wrapper">
			  <div class="footer-panel-left">
				<div class="footer-text"><a href="index.php" class="footer-text">Home</a> &nbsp;|&nbsp; <a href="about-us.html" class="footer-text">About Us</a> &nbsp;|&nbsp; <a href="terms-conditions.html" class="footer-text">Terms &amp; Conditions</a> &nbsp;|&nbsp; <a href="login.php" class="footer-text" >Login</a> &nbsp;|&nbsp;    <a href="register.php" class="footer-text" > Register</a></div>
				<div class="footer-text">© 2012 Attakka, All rights reserved.</div>
			  </div>
			  <div class="footer-panel-right"><a href="#"><img src="images/facebook-icon.png" alt="#" border="0" /></a> <a href="#"><img src="images/twitter-icon.png" alt="#" border="0" /></a> <a href="#"><img src="images/gplus-icon.png" alt="#"  border="0"/></a></div>
			</div>
			<div class="suggestionsBox" id="suggestions" style="display: none;margin-left:60px;margin-top:225px;"> <img src="images/arrow1.png" style="position: relative; top: -12px; left: 6px;" alt="upArrow" />
			 <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
			  <script type="text/javascript" src="js/jquery.js"></script>
			  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
			  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
			  <script type="text/javascript" src="js/jquery.kwicks-1.5.1.js"></script>
			  <script type="text/javascript">
				$(document).ready(function() {
				  $('#images').kwicks({
					max : 600,
					spacing : 2
				  });
				  $('ul.sf-menu').sooperfish();
				});
				<?php
				if(isset($_SESSION['user_id']))
				{
				   ?>
				   checkIsChrome();
				   <?php
				}
				?>
			  </script>
			</body>
			</html>
