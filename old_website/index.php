<?php
include "config.php";
session_start();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">


<!-- basic meta tags -->
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="index, follow" />



<!-- title -->
<title>ATTAKKA</title>




<!-- stylesheets -->
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/chromestyle.css" />

<link rel="stylesheet" href="css/style-fresh.css" type="text/css" media="screen" />

<link rel="stylesheet" href="css/style1.css" type="text/css" media="screen"/>




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

<script type='text/javascript' src='http://freshartcreations.com/Attakka/HTML/jquery/jquery.js?ver=1.7.2'></script>
<script type='text/javascript' src='http://freshartcreations.com/Attakka/HTML/jquery/jquery.prettyPhoto.js?ver=3.4'></script>
<script type='text/javascript' src='http://freshartcreations.com/Attakka/HTML/jquery/custom.js?ver=3.4'></script>
<script type='text/javascript' src='/chromejs/chrome.js'></script>



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


</head>

<body id='top' class="home blog" >


<?php
if(isset($_POST['Search_x']))
	{
	$_SESSION['search'] = $_POST['search_box'];
	}

?>

<!-- container novi--><!-- container novi--><!-- container novi--><!-- container novi--><!-- container novi--><!-- container novi-->

    
<?php
if ($_SESSION['is_open'] != True) {
?>
<div id="main-wrapper">
<div class="internal-wrapper" style="padding-top:0px;">
  <div id="right-panel" style = "padding-right:20px;"><img src="images/intro-icon.png" alt="#" class="intro-icon" /> <a href="#" class="top-links">intro video</a> <img src="images/login-icon.png" alt="#" class="login-icon" /> <a href="/login.php" class="top-links-login">Login</a> <img src="images/register-icon.png" alt="#" class="register-icon" /> <a href="/register.php" class="top-links-register">Register</a></div>
  <div class="clear"></div>

<div class="logo"><a href="/index.php"><img src="/images/logo-attakka.png" alt="#" border="0" /></a></div>
  <div class="clear"></div>

  <form method="post" action="search.php" class = "search-back">
    <input name="search" type="text" class="search-input" value="Search" />
    <input type="image" name="Search" src="/images/search-btrn.png" alt="#" style="margin-top:19px;" border="0" />
    <a href="/Create-a-review.php"><img src="/images/review-btrn.png" alt="#" style="margin-top:19px;" border="0" /></a>
	</form>


	
</div>
  
 </div>
  
<?php
}
else
{
$email = $_SESSION['email'];
$sql="SELECT * FROM member_info WHERE email='$email'";
$result=mysql_query($sql);

$row = mysql_fetch_assoc($result);
$name = $_SESSION['name'];
$region = $_SESSION['region'];
$surname = $_SESSION['surname'];
$picture_path = $_SESSION['picture_path'];
?>
<div id="container" >
<div style="width:990px; margin:0px auto 0px auto;">
<div class="name-panel top-user-name" style="float:right;"><?php echo $name." ".$surname ?><br />
  <?php echo $region ?></div>
    <div class="topuser-img" style="float:right;"><img alt="" src="<?php echo $picture_path; ?>"></div>
<div id="right-panel-user" style="float:right;">
      <div class="chromestyle" id="chromemenu" style="width:auto; min-width:240px; background:none;">
        <ul style = "background:none;">
          <li style = "background:none;"><a href="#" rel="dropmenu1"><img src="images/fav-icon.png" alt="#" style="margin-top:3px; margin-right:5px;" border="0"/> favorites</a></li>
          <li style = "background:none;"><a href="/logout.php" title="Offerings"><img src="images/logout-btrn.png" alt="#" style="margin-top:3px; margin-right:5px;" border="0"/> LogOUT</a></li>
        </ul>
      </div>
      <!--1st drop down menu -->
      <div id="dropmenu1" class="dropmenudiv" style="position:absolute; z-index:2;"> <a href="infowall.html" title="Info Wall">- Info Wall</a>
<a href="movies-categories.html" title="Movies">- Movies</a>
<a href="categories.html" title="General">- General</a> </div>
      <script type="text/javascript">

cssdropdown.startchrome("chromemenu")

</script>
      <!-- END Menu -->
	</div>
</div>
</div>
  <div class="clear"></div>
<div class="internal-wrapper" style="margin-top:85px; padding-top:40px; padding-left:55px;">

<div class="logo"><a href="/index.php"><img src="/images/logo-attakka.png" alt="#" border="0" /></a></div>
  <div class="clear"></div>

  <form method="post" action="search.php" class = "search-back">
    <input name="search" type="text" class="search-input" value="Search" />
    <input type="image" name="Search" src="/images/search-btrn.png" alt="#" style="margin-top:19px;" border="0" />
    <a href="/Create-a-review.php"><img src="/images/review-btrn.png" alt="#" style="margin-top:19px;" border="0" /></a>
	</form>

</div>

<?php
}
?>

<!-- container novi--><!-- container novi--><!-- container novi--><!-- container novi--><!-- container novi--><!-- container novi-->



<div id="contentwrap">

		<div id="feature_wrap">

			<div id="featured" class=''>

							<div class="featured featured1">
					<a href="http://freshartcreations.com/Attakka/HTML/categories.html">
						<span class='feature_excerpt'>
							<span class='sliderheading'></span></span>				</a>
					<div style="background:url(images/general-bar.png) no-repeat; width:700px; height:370px;">
					<div class="leftpanel-content">General</div>

					<div class="content-panel-new">
				<div class="homepanel-left"><img src="/images/the-possession.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-four.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/prometheus.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-two.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/hujan.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-three.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/diablo3.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-one.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/batman-img.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/homerate-5.png" alt="#" /></div>

				</div>
					</div>
			  				</div>


							<div class="featured featured2">
					<a href="http://freshartcreations.com/Attakka/HTML/movies-categories.html">
						<span class='feature_excerpt'>
							<span class='sliderheading'></span></span>				</a>
					<div style="background:url(images/movie-bar.png) no-repeat; width:700px; height:370px;">
					<div class="leftpanel-content">Movie</div>
					
					<div class="content-panel-new">
				<div class="homepanel-left"><img src="/images/the-possession.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-four.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/prometheus.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-two.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/hujan.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-three.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/diablo3.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-one.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/batman-img.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/homerate-5.png" alt="#" /></div>
				
				</div>
					</div>
			  				</div>
							
							
							
							
							
							<div class="featured featured3">
					<a href="#">
						<span class='feature_excerpt'>
							<span class='sliderheading'></span></span>				</a>
					<div style="background:url(images/books-bar.png) no-repeat; width:700px; height:370px;">
					<div class="leftpanel-content">Books</div>
					
					<div class="content-panel-new">
				<div class="homepanel-left"><img src="/images/the-possession.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-four.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/prometheus.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-two.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/hujan.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-three.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/diablo3.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-one.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/batman-img.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/homerate-5.png" alt="#" /></div>
				
				</div>
					</div>
			  				</div>
							
							
							
							
							
							
							<div class="featured featured4">
					<a href="#">
						<span class='feature_excerpt'>
							<span class='sliderheading'></span></span>				</a>
					<div style="background:url(images/indie-bar.png) no-repeat; width:700px; height:370px;">
					<div class="leftpanel-content">Indie Bands</div>
					
					<div class="content-panel-new">
				<div class="homepanel-left"><img src="/images/the-possession.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-four.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/prometheus.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-two.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/hujan.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-three.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/diablo3.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-one.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/batman-img.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/homerate-5.png" alt="#" /></div>
				
				</div>
					</div>
			  				</div>
							

		<div class="featured featured5">
					<a href="http://freshartcreations.com/Attakka/HTML/consul.html">
						<span class='feature_excerpt'>
							<span class='sliderheading'></span></span>				</a>
			<div style="background:url(images/consul-bar.png) no-repeat; width:700px; height:370px;">
				<div class="leftpanel-content">Consul</div>
					
				<div class="content-panel-new">
				<div class="homepanel-left"><img src="/images/the-possession.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-four.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/prometheus.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-two.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/hujan.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-three.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/diablo3.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-one.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/batman-img.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/homerate-5.png" alt="#" /></div>
				
				</div>
			</div>
		</div>
							
				<div class="featured featured6">
					<a href="http://freshartcreations.com/Attakka/HTML/Moderator-Page.html">
						<span class='feature_excerpt'>
							<span class='sliderheading'></span></span>				</a>
					<div style="background:url(images/moderate-bar.png) no-repeat; width:700px; height:370px;">
					<div class="leftpanel-content">Autority</div>

					<div class="content-panel-new">
				<div class="homepanel-left"><img src="/images/the-possession.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-four.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/prometheus.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-two.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/hujan.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-three.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/diablo3.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/rate-one.png" alt="#" /></div>
				<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/batman-img.png" alt="#" /></div>
				<div class="homepanel-right"><img src="/images/homerate-5.png" alt="#" /></div>

				</div>
					</div>
			  </div>

				<div class="featured featured7">
					<a href="/all-category.php">
						<span class='feature_excerpt'>
							<span class='sliderheading'></span></span>				</a>
					<div style="background:url(images/black-city.png) no-repeat; width:700px; height:370px;">
					<div class="leftpanel-content">MOSAIC</div>
					
					<div class="content-panel-right">
				<div class="homepanel-left"><img src="/images/the-possession.png" alt="#" /></div>
							<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/prometheus.png" alt="#" /></div>
							<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/hujan.png" alt="#" /></div>
							<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/diablo3.png" alt="#" /></div>
								<div class="clear"></div>
				<div class="homepanel-left"><img src="/images/batman-img.png" alt="#" /></div>
				
					  </div>
					</div>
			  </div>
						
		</div><!-- end #featured --> 
		
		<span class='bottom_right_rounded_corner ie6fix'></span>
		<span class='bottom_left_rounded_corner ie6fix'></span>	
		
	
	</div><!-- end featuredwrap -->
	
</div>

<div class="clear"></div>
<div id="footer-wrapper">
  <div class="footer-panel-left">
    <div class="footer-text"><a href="/index.php" class="footer-text">Home</a> &nbsp;|&nbsp; <a href="http://freshartcreations.com/Attakka/HTML/about-us.html" class="footer-text">About Us</a> &nbsp;|&nbsp; <a href="http://freshartcreations.com/Attakka/HTML/terms-conditions.html" class="footer-text">Terms &amp; Conditions</a> &nbsp;|&nbsp; <a href="/login.php" class="footer-text" >Login</a> &nbsp;|&nbsp;     Register</div>
    <div class="footer-text">© 2012 Attakka, All rights reserved.</div>
  </div>
  <div class="footer-panel-right"><a href="#"><img src="/images/facebook-icon.png" alt="#" border="0" /></a> <a href="#"><img src="images/twitter-icon.png" alt="#" border="0" /></a> <a href="#"><img src="/images/gplus-icon.png" alt="#"  border="0"/></a></div>
</div>
</body>

</html>