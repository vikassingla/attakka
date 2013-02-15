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
include 'config.php';
?>
<a href = "index.php"><div align="center"><img src="images/logo-attakka.png" alt="#" /></div></a>

<div class="internal-wrapper">
  <div style="margin-top:10px; margin-bottom:20px;"><img src="images/banner/banner-ad2.png" alt="#"  class="image-border"/></div>
  <div class="grey-round-bar">
    <div class="images-left-panel heading-black">Image</div>
    <div class="notes-panel heading-black">Name</div>
    <div class="rate-panel heading-black" style="padding-left:10px;">Type</div>
  </div>
  <div class="clear"></div>
  <!--row 1-->
		  <?php
		  $search=$_POST['search'];
$sql4="SELECT * FROM category WHERE category_name LIKE'%$search%' ORDER BY category_id DESC";
$result4 = mysql_query($sql4) or die ('Error: '.mysql_error ());
while($rows=mysql_fetch_array($result4)){

$category_name= $rows['category_name'];
$category_image= $rows['category_image'];
$category_type= $rows['category_type'];

?>

  <a href="Infowall-Review.html">
  <div class="border-round">
    <div class="images-left-panel views-field round-img" style="width:100px;"><img src="images/<? echo $category_image; ?>" border="0"  alt="#" />
    </div>
    <div class="notes-panel middle-text">
      <div class="internal-panel">
        <div class="panel">
          <p style=" position: relative; top: -50%">
<?php echo "<div class='red-color-heading'>".$category_name."</div>";

?>
		  </p>
        </div>
      </div>
    </div>
    <div class="rate-panel" style="text-align:left; margin:40px 0px 0px 150px;" align="right"><span class='black-color-heading' style="font-size:14px; text-align:center;"><?php echo $category_type;?></span></div>
  </div></a>
  <?php
  }
  ?>
  <!--row 9-->
  <div class="clear"></div>
  <div class="footer-panel-left-internal">
   <div class="footer-text"><a href="index.html" class="footer-text">Home</a> &nbsp;|&nbsp; <a href="about-us.html" class="footer-text">About Us</a> &nbsp;|&nbsp; <a href="terms-conditions.html" class="footer-text">Terms &amp; Conditions</a> &nbsp;|&nbsp; <a href="login.html" class="footer-text" >Login</a> &nbsp;|&nbsp;     Register</div>
<div class="footer-text">© 2012 Attakka, All rights reserved.</div>
  </div>
  <div class="footer-panel-right"><a href="#"><img src="images/facebook-icon.png" alt="#" border="0" /></a> <a href="#"><img src="images/twitter-icon.png" alt="#" border="0" /></a> <a href="#"><img src="images/gplus-icon.png" alt="#"  border="0"/></a></div>
</div>





<script txpe="text/javascript">
document.title="<?php echo "Search results ".$search; ?>"
</script>


</body>
</html>
