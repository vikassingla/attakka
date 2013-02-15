<?php include("header.php");
$sql="select cat_id, cat_name, cat_img from tbl_category where cat_parent_id=0";
//echo $sql;
$rs=mysql_query($sql);
?>
<div class="internal-wrapper">
<div style="margin-top:100px;">    <img src="images/mosic-top-banner.png" alt="" height="273" class="image-border" />
		      
		      <h2 style="padding-left:10px;">mosaic</h2></div>
			  <div style="margin-top:10px; margin-bottom:20px;"><img src="images/banner/banner-ad1.png" alt="#" width="995" class="image-border" /></div>
			  <div class="grey-round-bar-newnov19" style="margin-top:5px; padding-left:5px;">
			<a style="text-decoration:none;" class="black-button" href="#">HOT</a> <a style="text-decoration:none; padding-right:20px;" class="heading-black" href="#">NEW</a> <a style="text-decoration:none; padding-right:20px;" class="heading-black" href="#">FAVORITES</a> <a href="create_category.php" class="heading-black" style="width:150px; float:right;">CREATE A CATEGORY</a></div>
		
			  <div class="clear"></div>
		<?php 
		    while($row=mysql_fetch_array($rs))
		    {
				if($row['cat_img']=="")
				{
					$src1="images/no-img.jpg";
				}
				else
				{
					$src1="uploads/".$row['cat_img'];
				}	
				print 
				'<div class="views-field view-image"><a href="category_detail.php?cat_id='.$row['cat_id'].'"><img alt="" src="'.$src1.'" style="height:214px;width:250px;"><h3>'.$row['cat_name'].'</h3></a></div>';
			}
		?>
	<div class="clear"></div>
<div class="footer-panel-left-internal">
<div class="footer-text"><a href="index.php" class="footer-text">Home</a> &nbsp;|&nbsp; <a href="about-us.html" class="footer-text">About Us</a> &nbsp;|&nbsp; <a href="terms-conditions.html" class="footer-text">Terms &amp; Conditions</a> &nbsp;|&nbsp; <a href="login.html" class="footer-text" >Login</a> &nbsp;|&nbsp;     Register</div>
<div class="footer-text">© 2012 Attakka, All rights reserved.</div>

</div>
<div class="footer-panel-right"><a href="#"><img src="images/facebook-icon.png" alt="#" border="0" /></a> <a href="#"><img src="images/twitter-icon.png" alt="#" border="0" /></a> <a href="#"><img src="images/gplus-icon.png" alt="#"  border="0"/></a></div>
</div>
</body>
</html>
