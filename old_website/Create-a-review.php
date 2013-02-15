<?php
include "config.php";
session_start();

if ($_SESSION['is_open'] != "True")
{
	header( 'Location: /not-logged-in.html' ) ;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">



<!-- title -->
<title>ATTAKKA</title>

<style>
.chromestyle {

    width: 142%;
	margin-right:10px;
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


	
<?php

if (isset($_POST['Submit_x']))

{

	//get values from textareas
	$title_id = 115;
	$user_id = $_SESSION['user_id'];
	$title_opinion = $_POST['opinion'];
	$title_review = $_POST['review'];
	$rate = $_POST['rate'];
	
	$sql ="insert into reviews (title_opinion, title_review, title_id, member_id, rate) values('$title_opinion', '$title_review', $title_id, '$user_id', '$rate')";
	$result=mysql_query($sql);	
}


?>	
<div id="container"><div class="internal-wrapper-top"><div id="logo"><a href="index.php"><img src="/images/internal-logo.png" alt="#" border="0" /></a></div>

<div id="search-panel">  <input name="textfield" type="text" class="search-input-internal" value="Search" /> 
  <a href="review.php"><img src="/images/search-icon.png" alt="#" border="0" /></a>
  <a href="Create-a-review.php"><img src="/images/review-icon.png" alt="#" border="0" /></a></div>

<div id="right-panel-user">
      <div class="chromestyle" id="chromemenu">
        <ul>
          <li><a href="#" rel="dropmenu1"><img src="images/fav-icon.png" alt="#" style="margin-top:3px; margin-right:5px;" border="0"/> favorites</a></li>
          <li><a href="logout.php" title="Offerings"><img src="images/logout-btrn.png" alt="#" style="margin-top:3px; margin-right:5px;" border="0"/> LogOUT</a></li>
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

<div class="views-field topuser-img"><img alt="" src="<?php echo $_SESSION['picture_path'] ?>"></div>

<div class="name-panel top-user-name"><?php echo $_SESSION['name']." ".$_SESSION['surname']; ?><br />
  <?php echo $_SESSION['region']; ?></div>
</div></div>
<div class="internal-wrapper">
<div style="margin-top:100px;">    <img src="/images/batman-banner.png" alt="" class="image-border" />
		      
		      <h4 style="padding-left:10px;"> REVIEW : Batman</h4></div>
			  
		
<div class="clear"></div>
			  
		<form method="post" action="">
						
			
			<div class="icon-rate-left"><div><img src="images/rate/rate-5.png" alt="#" /></div>
			  <div align="center"><input name="rate" type="radio" value="-5" /></div></div>
		
			<div class="icon-rate"><div><img src="images/rate/rate-4.png" alt="#" /></div>
			  <div align="center"><input name="rate" type="radio" value="-4" /></div></div>
		
			<div class="icon-rate"><div><img src="images/rate/rate-3.png" alt="#" /></div>
			  <div align="center"><input name="rate" type="radio" value="-3" /></div></div>
		
			<div class="icon-rate"><div><img src="images/rate/rate-2.png" alt="#" /></div>
			  <div align="center"><input name="rate" type="radio" value="-2" /></div></div>
		
			<div class="icon-rate"><div><img src="images/rate/rate-1.png" alt="#" /></div>
			  <div align="center"><input name="rate" type="radio" value="-1" /></div></div>
		
			<div class="icon-rate"><div><img src="images/rate/rate-0.png" alt="#" /></div>
			  <div align="center"><input name="rate" type="radio" value="0" /></div></div>
		
			<div class="icon-rate"><div><img src="images/rate/rate-1plus.png" alt="#" /></div>
			  <div align="center"><input name="rate" type="radio" value="1" /></div></div>
		
			<div class="icon-rate"><div><img src="images/rate/rate-2plus.png" alt="#" /></div>
			  <div align="center"><input name="rate" type="radio" value="2" /></div></div>
		
			<div class="icon-rate"><div><img src="images/rate/rate-3plus.png" alt="#" /></div>
			  <div align="center"><input name="rate" type="radio" value="3" /></div></div>
		
		
			<div class="icon-rate"><div><img src="images/rate/rate-4plus.png" alt="#" /></div>
			  <div align="center"><input name="rate" type="radio" value="4" /></div></div>
		
			<div class="icon-rate"><div><img src="images/rate/rate-5plus.png" alt="#" /></div>
			  <div align="center"><input name="rate" type="radio" value="5" /></div></div>
			  
			  
				<div class="clear"></div>
		
			  <div class="form-panel-create-review"><div style="margin-bottom:20px;">
			  <textarea name="opinion" rows="5" class="textarea" style="width:760px;">Title Opinion</textarea>
			  </div>
			  <div style="margin-bottom:20px;"><textarea name="review" rows="15" class="textarea" style="width:760px;">Title Review</textarea>
			  </div>
			  <div class="clear"></div>
			  <div style="margin-bottom:20px;"><input name="Submit" type="image" src="images/submitbutton.png" /> &nbsp;
			  <input name="reset" type="image" src="images/clear-btrn.gif" /></div>
			  </div>
		</form>
		


 

<div class="clear"></div>
<div class="footer-panel-left-internal">
<div class="footer-text"><a href="/index.php" class="footer-text">Home</a> &nbsp;|&nbsp; <a href="/about-us.html" class="footer-text">About Us</a> &nbsp;|&nbsp; <a href="terms-conditions.html" class="footer-text">Terms &amp; Conditions</a> &nbsp;|&nbsp; <a href="login.php" class="footer-text" >Login</a> &nbsp;|&nbsp;     Register</div>
<div class="footer-text">© 2012 Attakka, All rights reserved.</div>

</div>
<div class="footer-panel-right"><a href="#"><img src="/images/facebook-icon.png" alt="#" border="0" /></a> <a href="#"><img src="/images/twitter-icon.png" alt="#" border="0" /></a> <a href="#"><img src="images/gplus-icon.png" alt="#"  border="0"/></a></div>



</div>

<?php

?>


</body>
</html>













			

