<?php  
	$session_data =  get_session_data();
	$image_path = base_url()."user_profile_image/".$session_data['user_image_name'];
	//pr($session_data);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<!-- title -->
<title><?php if(isset($title)) { echo $title;}?></title>
<base href="<?php echo base_url();?>">

<style>
.chromestyle {

    width: 142%;
	margin-right:10px;
}

</style>
<script src="js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
/* <![CDATA[ */
$(document).ready(function(){
	$("#tabs li").click(function() {
		//	First remove class "active" from currently active tab
		$("#tabs li").removeClass('active');

		//	Now add class "active" to the selected/clicked tab
		$(this).addClass("active");

		//	Hide all tab content
		$(".tab_content").hide();

		//	Here we get the href value of the selected tab
		var selected_tab = $(this).find("a").attr("href");

		//	Show the selected tab content
		$(selected_tab).fadeIn();

		//	At the end, we add return false so that the click on the link is not executed
		return false;
	});
});
/* ]]> */
</script>
<!--dropdown menu-->
<script type="text/javascript" src="chromejs/chrome.js"></script>
<link rel="stylesheet" type="text/css" href="css/chromestyle.css" />
<!--dropdown menu end-->

<!-- stylesheets -->
<link rel="stylesheet" href="css/style-fresh.css" type="text/css" media="screen" />
</head>


<body>
<div id="container"><div class="internal-wrapper-top"><div id="logo"><a href=""><img src="images/internal-logo.png" alt="#" border="0" /></a></div>

<div id="search-panel">  <input name="textfield" type="text" class="search-input-internal" value="Search" /> 
  <a href="javascript:void(0);"><img src="images/search-icon.png" alt="#" border="0" /></a>
  <a href="javascript:void(0);"><img src="images/review-icon.png" alt="#" border="0" /></a></div>

<div id="right-panel-user">
      <div class="chromestyle" id="chromemenu">
        <ul>
          <li><a href="#" rel="dropmenu1"><img src="images/fav-icon.png" alt="#" style="margin-top:3px; margin-right:5px;" border="0"/> favorites</a></li>
          <li>
          <a href="<?php if(!$session_data['FB_logout']){ echo site_url('user/log_out');}else{ if($session_data['FB_logout']){ echo $session_data['FB_logout']; } } ?>" title="Offerings"><img src="images/logout-btrn.png" alt="#" style="margin-top:3px; margin-right:5px;" border="0"/> LogOUT</a>
          
          
          </li>
           
           
        </ul>
      </div>
      <!--1st drop down menu -->
      <div id="dropmenu1" class="dropmenudiv" style="position:absolute; z-index:2;"> 

    <a href="user/favorite/1" title="Movies">- Movies</a>
    <a href="user/favorite/2" title="General">- General</a>
    <a href="user/favorite/3" title="Info Wall">- Info Wall</a>


</div>


      <!--1st drop down menu -->
      <div id="dropmenu1" class="dropmenudiv" style="position:absolute; z-index:2;"> 

<!--<a href="user/category_list" title="category">Category</a> 
<a href="user/sub_category_list" title="sub category">Sub Category</a> 
<a href="user/topic" title="topic">Topic</a> 
<a href="user/review" title="review">Review</a> -->
</div>



<script type="text/javascript">
cssdropdown.startchrome("chromemenu")
</script>
      <!-- END Menu -->
	</div>
<div class="views-field topuser-img">
<?php 
 $session_data['user_image_name'];
if($session_data['user_image_name']!="")
{
	 $image_path = "user_profile_image/".$session_data['user_image_name'];		
	if(file_exists($image_path))
	{?>
    
  <a href="user/edit_profile" >  <img src="create_thumbnail_image.php?file=<?php echo $image_path;?>&maxw=87&maxh=84"  border="0" /></a>
<!--<a href="user/edit_profile" ><img alt="" src="<?php echo $image_path;?>"></a>-->
	<?php 
	}
}else{
?>
<!--<a href="user/edit_profile"><img alt="" src="images/user-pic.png"></a>-->


  <a href="user/edit_profile" >  <img src="create_thumbnail_image.php?file=images/user-pic-big.png&maxw=87&maxh=84"  border="0" /></a>

<?php } ?>


</div>
<div class="name-panel top-user-name"><?php echo ucfirst($session_data['user_first_name'])." ".ucfirst($session_data['user_last_name']); ?><br />
  <?php echo ucfirst($session_data['user_country']);?>
  
  
  </div>
  
 <div align="right" style=" margin-top:-4px;">
  <a href="user/dashboard" class="top-links-register">Dashboard</a>

  
  </div>
</div></div>