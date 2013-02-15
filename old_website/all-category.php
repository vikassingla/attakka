<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">



<!-- title -->
<title>ATTAKKA</title>
<style>
.chromestyle {
    margin-left: -37px;
    width: 142%;
}

</style>

<!--dropdown menu-->
<script type="text/javascript" src="chromejs/chrome.js"></script>

<link rel="stylesheet" type="text/css" href="css/chromestyle.css" />
<!--dropdown menu end-->

<!-- stylesheets -->
<link rel="stylesheet" href="css/style-fresh.css" type="text/css" media="screen" />


</head>


<body>
<div id="container">
	<div class="internal-wrapper-top">
		<div id="logo">
			<a href="index.php"><img src="images/internal-logo.png" alt="#" border="0" /></a>
		</div>

		<div id="search-panel">  <input name="textfield" type="text" class="search-input-internal" value="Search" /> 
			<a href="review.php"><img src="images/search-icon.png" alt="#" border="0" /></a>
			<a href="Create-a-review.php"><img src="images/review-icon.png" alt="#" border="0" /></a>
		</div>

		<?php
		if ($_SESSION['is_open'] != 'True'){
		?>      
 			<div id="right-panel" style = "margin-top:25px;">   
				<img src="images/login-icon.png" alt="#" class="login-icon" /> <a href="/login.php" class="top-links-login" >Login</a> 
				<img src="images/register-icon.png" alt="#" class="register-icon" /> <a href="/register.php" class="top-links-register">Register</a>
			</div>
			<div class="clear"></div>

		<?php
		}
		else{ 
		?>	
			<div id="right-panel-user">
				<div class="chromestyle" id="chromemenu">
					<ul>
						<li>
						<a href="#" rel="dropmenu1"><img src="images/fav-icon.png" alt="#" style="margin-top:3px; margin-right:5px;" border="0"/> favorites</a>
						</li>
						<li>
						<a href="logout.php" title="Offerings"><img src="images/logout-btrn.png" alt="#" style="margin-top:3px; margin-right:5px;" border="0"/> LogOUT</a>
						</li>
					</ul>
				</div>
      <!--1st drop down menu -->
				<div id="dropmenu1" class="dropmenudiv" style="position:absolute; z-index:2;"> 
					<a href="infowall.html" title="Info Wall">- Info Wall</a>
					<a href="movies-categories.html" title="Movies">- Movies</a>
					<a href="categories.html" title="General">- General</a> 
				</div>
				<script type="text/javascript">
					cssdropdown.startchrome("chromemenu")
				</script>
      <!-- END Menu -->
			</div>


		<div class="views-field topuser-img">
			<img alt="" src="<?php echo $_SESSION['picture_path'] ?>">
		</div>

		<div class="name-panel top-user-name"><?php echo $_SESSION['name']." ".$_SESSION['surname']; ?><br />
			<?php echo $_SESSION['region']; ?>
		</div>
  
		<?php
		}
		?>
  
	</div>
</div>

<div class="internal-wrapper">
	<div style="margin-top:100px;">    
		<img src="images/mosic-top-banner.png" alt="" height="273" class="image-border" />
		<h2 style="padding-left:10px;">mosaic</h2>
	</div>
	<div style="margin-top:10px; margin-bottom:20px;">
		<img src="images/banner/banner-ad1.png" alt="#" width="995" class="image-border" />
	</div>
	<div class="red-round-bar">
		<div style="padding:5px;"><img src="images/hot-btrn.png" alt="#" style="float:left; margin-right:10px;" />  
			<img src="images/new-btrn.png" alt="#" style="float:left;margin-right:10px;" />  
			<img src="images/favorites-btrn.png" style="float:left" alt="#" />  
			<a href="/Create-category.php"><img src="images/createa-category-btrn.png" alt="#" style="float:right" border="0" /></a>
		</div>
	</div>
	<div class="clear"></div>
			  
	<?php
		include 'config.php';
		//sql statement, take info from database
		$sql_all_cat="SELECT * FROM category";
		$result_all_cat=mysql_query($sql_all_cat);
		 
		//set up counter
		$counter =1;
			  
		while($rows=mysql_fetch_array($result_all_cat)){
			$category_image = $rows['category_image'];
			$category_name = $rows['category_name'];
				  
			//checking the counter
			if ($counter % 4 == 0){
				$div_class="views-field view-image-right";
			}
			else{
				$div_class="views-field view-image";
				}
				  
			//display results
			echo "
			<div class='".$div_class."'><img alt='".$category_name."' src='images/".$category_image."'>
			<div class='categories-black-op-box'><h3 style='color:#fff; text-align:center; width:240px; opacity:1; position:absolute; float:left; z-index:99; margin-top:0px;'>".$category_name ."</h3></div>
			</div>
			";
					
			$counter ++;
			}
	?>

<div class="clear"></div>

<div class="footer-panel-left-internal">
	<div class="footer-text"><a href="index.php" class="footer-text">Home</a> &nbsp;|&nbsp; <a href="about-us.html" class="footer-text">About Us</a> &nbsp;|&nbsp; <a href="terms-conditions.html" class="footer-text">Terms &amp; Conditions</a> &nbsp;|&nbsp; <a href="login.php" class="footer-text" >Login</a> &nbsp;|&nbsp; Register
	</div>
	<div class="footer-text">© 2012 Attakka, All rights reserved.</div>
</div>

<div class="footer-panel-right">
	<a href="#"><img src="images/facebook-icon.png" alt="#" border="0" /></a> 
	<a href="#"><img src="images/twitter-icon.png" alt="#" border="0" /></a> 
	<a href="#"><img src="images/gplus-icon.png" alt="#"  border="0"/></a>
</div>
  
</div>
</body>
</html>