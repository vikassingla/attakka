<?php
require("config.php");
session_start();
require("xajax/xajax_library.php");
$objXajax= new Xajax();
$objXajax->registerFunction("friend");
$objXajax->registerFunction("favorites");
$objXajax->registerFunction("upvote");
$objXajax->registerFunction("downvote");
$objXajax->registerFunction("uporder");
$objXajax->registerFunction("downorder");
$objXajax->registerFunction("moderator");
$objXajax->registerFunction("uporder_refresh");
$objXajax->registerFunction("moderator_refresh");
$objXajax->registerFunction("bannerFavorites");
$objXajax->processRequests();
function favorites($catid)
{
	$objResponse = new xajaxResponse();
	//$objResponse->addAlert($catid);
	$user_id=$_SESSION['user_id'];
	$sql21="select fav_id from tbl_favorites where cat_id='$catid' and user_id='$user_id'";
	$rs21=mysql_query($sql21);
	$row21=mysql_fetch_array($rs21);
	if(mysql_num_rows($rs21)>0)
	{
		$sql22="delete from tbl_favorites where fav_id=".$row21['fav_id'];
		mysql_query($sql22);
		$script='document.getElementById("favorites").src="images/vote/add_to_fav.png";';
	}
	else
	{
		$sql23="insert into tbl_favorites (cat_id, user_id) values ('$catid', '$user_id')";
		mysql_query($sql23);
		$last_insert_id3=mysql_insert_id();
		if($last_insert_id3)
		{
			$script='document.getElementById("favorites").src="images/vote/add_to_fav1.png";';
		}	
	}	
	$objResponse->addScript($script);
	return $objResponse->getXML();
}
function moderator($catid)
{
	$objResponse = new xajaxResponse();
	//$objResponse->addAlert($catid);
	$user_id=$_SESSION['user_id'];
	$sql21="select moderator_id from tbl_moderator where moderator_cat_id='$catid' and moderator_user_id='$user_id'";
	//$objResponse->addAlert($sql21);
	$rs21=mysql_query($sql21);
	$row21=mysql_fetch_array($rs21);
	//$objResponse->addAlert(mysql_num_rows($rs21));
	if(mysql_num_rows($rs21)>0)
	{
		$sql22="delete from tbl_moderator where moderator_id=".$row21['moderator_id'];
		//$objResponse->addAlert($sql22);
		mysql_query($sql22);
		$script='document.getElementById("mod").src="images/vote/apply_mod.png";';
	}
	else
	{
		$sql23="insert into tbl_moderator (moderator_cat_id, moderator_user_id) values ('$catid', '$user_id')";
		mysql_query($sql23);
		$last_insert_id3=mysql_insert_id();
		if($last_insert_id3)
		{
			$script='document.getElementById("mod").src="images/vote/apply_mod1.png";';
		}	
	}	
	//$objResponse->addAlert($script);
	$objResponse->addScript($script);
	$objResponse->addScript('xajax_moderator_refresh();');
	//$objResponse->addScript($script);
	return $objResponse->getXML();
}
function friend($catid)
{
	$objResponse = new xajaxResponse();
	//$objResponse->addAlert($catid);
	$user_id=$_SESSION['user_id'];
	$sql24="select fan_id from tbl_fan where cat_id='$catid' and user_id='$user_id'";
	//$objResponse->addAlert($sql24);
	$rs24=mysql_query($sql24);
	$row24=mysql_fetch_array($rs24);
	if(mysql_num_rows($rs24)>0)
	{
		$sql25="delete from tbl_fan where fan_id=".$row24['fan_id'];
		mysql_query($sql25);
		$script='document.getElementById("fan").src="images/vote/become_fan.png";';
	}
	else
	{
		$sql26="insert into tbl_fan (cat_id, user_id) values ('$catid', '$user_id')";
		mysql_query($sql26);
		$last_insert_id4=mysql_insert_id();
		if($last_insert_id4)
		{
			$script='document.getElementById("fan").src="images/vote/become_fan1.png";';
		}	
	}	
	$objResponse->addScript($script);
	return $objResponse->getXML();
}
function bannerFavorites($catid)
{

	$objResponse = new xajaxResponse();
	//$objResponse->addAlert($catid);
	$user_id=$_SESSION['user_id'];
	$sql21="select fav_id from tbl_favorites where cat_id='$catid' and user_id='$user_id'";
	$rs21=mysql_query($sql21);
	$row21=mysql_fetch_array($rs21);
	if(mysql_num_rows($rs21)>0)
	{
		$sql22="delete from tbl_favorites where fav_id=".$row21['fav_id'];
		mysql_query($sql22);
		$script='document.getElementById("bannerfav").src="images/big_star.png"';
	}
	else
	{
		$sql23="insert into tbl_favorites (cat_id, user_id) values ('$catid', '$user_id')";
		mysql_query($sql23);
		$last_insert_id3=mysql_insert_id();
		if($last_insert_id3)
		{
			$script='document.getElementById("bannerfav").src="images/yellow_star.png"';
		}	
	}	
	$objResponse->addScript($script);
	return $objResponse->getXML();
	
	
	
	
}
function upvote($catid)
{
	$objResponse = new xajaxResponse();
	//$objResponse->addAlert($catid);
	$user_id=$_SESSION['user_id'];
	$sql27="select vote_id,vote from tbl_vote where cat_id='$catid' and user_id='$user_id'";
	//$objResponse->addAlert($sql24);
	$rs27=mysql_query($sql27);
	$row27=mysql_fetch_array($rs27);
	
	if(mysql_num_rows($rs27)>0)
	{
		if($row27['vote']=="0")
		{
			$sql32="update tbl_vote set vote=1 where vote_id=".$row27['vote_id'];
			mysql_query($sql32);
			$script='document.getElementById("upvote").src="images/vote/like1.png";';
			$script.='document.getElementById("downvote").src="images/vote/unlike.png";';
		}	
		else
		{
			$sql28="delete from tbl_vote where vote_id=".$row27['vote_id'];
			mysql_query($sql28);
			$script='document.getElementById("upvote").src="images/vote/like.png";';
		}
	}
	else
	{
		$sql29="insert into tbl_vote (cat_id, user_id, vote) values ('$catid', '$user_id', 1)";
		mysql_query($sql29);
		$last_insert_id5=mysql_insert_id();
		if($last_insert_id5)
		{
			$script='document.getElementById("upvote").src="images/vote/like1.png";';
		}	
	}	
	$objResponse->addScript($script);
	return $objResponse->getXML();
}
function downvote($catid)
{
	$objResponse = new xajaxResponse();
	//$objResponse->addAlert($catid);
	$user_id=$_SESSION['user_id'];
	$sql30="select vote_id,vote from tbl_vote where cat_id='$catid' and user_id='$user_id'";
	//$objResponse->addAlert($sql30);
	$rs30=mysql_query($sql30);
	$row30=mysql_fetch_array($rs30);
	//$objResponse->addAlert(mysql_num_rows($rs30));
	if(mysql_num_rows($rs30)>0)
	{
		if($row30['vote']=="1")
		{
			$sql33="update tbl_vote set vote=0 where vote_id=".$row30['vote_id'];
			//$objResponse->addAlert($sql33);
			mysql_query($sql33);
			$script='document.getElementById("downvote").src="images/vote/unlike1.png";';
			$script.='document.getElementById("upvote").src="images/vote/like.png";';
		}	
		else
		{
			$sql31="delete from tbl_vote where vote_id=".$row30['vote_id'];
			mysql_query($sql28);
			$script='document.getElementById("downvote").src="images/vote/unlike.png";';
		}	
	}
	else
	{
		$sql29="insert into tbl_vote (cat_id, user_id, vote) values ('$catid', '$user_id', 0)";
		mysql_query($sql29);
		$objResponse->addAlert($sql29);
		$last_insert_id6=mysql_insert_id();
		$objResponse->addAlert($last_insert_id6);
		if($last_insert_id6)
		{
			$script='document.getElementById("downvote").src="images/vote/unlike1.png";';
		}	
	}
	$objResponse->addScript($script);
	return $objResponse->getXML();
}
function uporder($rid, $id)
{
	$objResponse = new xajaxResponse();
	//$objResponse->addAlert($id);
	$rid1=($rid-1);
	$id1=($id-1);
	$sql34="update tbl_review_image set rev_rank=$id where rev_id=$rid1";
	//$objResponse->addAlert($sql34);
	mysql_query($sql34);
	$sql35="update tbl_review_image set rev_rank=$id1 where rev_id=$rid";
	//$objResponse->addAlert($sql34);
	mysql_query($sql35);	
	$objResponse->addScript('xajax_uporder_refresh();');
	return $objResponse->getXML();
}
function uporder_refresh()
{
	$objResponse = new xajaxResponse();
	$cat_id = $_GET['cat_id'];
	
	$sql18="select rev_id, rev_img from tbl_review_image where rev_cat_id=".$cat_id." order by rev_rank";
	
	$rs18=mysql_query($sql18);
	$n=mysql_num_rows($rs18);
	$i=1;
	$data='';
	while($row18=mysql_fetch_array($rs18))
	{
		$data.='<div class="info-image-left views-field"><img src="review_images/'.$row18['rev_img'].'" style="height:113px;width:276px;" alt="#" /></div>';
		$data.='<div class="box-rating" style="margin-top:6px">'.$i.'<sup style="font-size:6px;">o</sup></div>';
		$data.='<div class="arrow-up">';
		if($i>1)
		{
			$data.='<a href="javascript:void(0);" onclick="xajax_uporder('.$row18['rev_id'].','.$i.')">';
			$data.='<img src="images/arrow-up.png" alt="#" style="margin-bottom:20px;" />';
			$data.='<input type="hidden" name="pos[]" value='.$row18['rev_id'].'>';
			$data.='</a>';
		}
		if($i<$n)
		{
			$data.='<a href="javascript:void(0);" onclick="xajax_downorder('.$row18['rev_id'].','.$i.')">';
			$data.='<img src="images/arrow-down.png" alt="#" style="margin-bottom:20px;" />';
			$data.='<input type="hidden" name="pos[]" value='.$row18['rev_id'].'>';
			$data.='</a>';
		
		}
		$data.='</div>';
		$data.='<div class="clear"></div>';
			
			$i++;
	}
	$objResponse->addAssign('wallPicDiv','innerHTML',$data);
	return $objResponse->getXML();
}
/*function uporder_refresh()
{
	$objResponse = new xajaxResponse();
	$cat_id = $_GET['cat_id'];
	
	$sql18="select rev_id, rev_img from tbl_review_image where rev_cat_id=".$cat_id." order by rev_rank";
	
	$rs18=mysql_query($sql18);
	$n=mysql_num_rows($rs18);
	$i=1;
	$data='';
	while($row18=mysql_fetch_array($rs18))
	{
		$data.='<div class="info-image-left views-field"><img src="review_images/'.$row18['rev_img'].'" style="height:113px;width:276px;" alt="#" /></div>';
		$data.='<div class="box-rating" style="margin-top:6px">'.$i.'<sup style="font-size:6px;">o</sup></div>';
		$data.='<div class="arrow-up">';
		if($i>1)
		{
			$data.='<a href="javascript:void(0);" onclick="xajax_uporder('.$row18['rev_id'].','.$i.')">';
			$data.='<img src="images/arrow-up.png" alt="#" style="margin-bottom:20px;" />';
			$data.='<input type="hidden" name="pos[]" value='.$row18['rev_id'].'>';
			$data.='</a>';
		}
		if($i<$n)
		{
			$data.='<a href="javascript:void(0);" onclick="xajax_downorder('.$row18['rev_id'].','.$i.')">';
			$data.='<img src="images/arrow-down.png" alt="#" style="margin-bottom:20px;" />';
			$data.='<input type="hidden" name="pos[]" value='.$row18['rev_id'].'>';
			$data.='</a>';
		
		}
		$data.='</div>';
		$data.='<div class="clear"></div>';
			
			$i++;
	}
	$objResponse->addAssign('wallPicDiv','innerHTML',$data);
	return $objResponse->getXML();
}*/
function moderator_refresh()
{
	$objResponse = new xajaxResponse();
	$cat_id = $_GET['cat_id'];
	$sql53="select moderator_id, moderator_user_id from tbl_moderator where moderator_cat_id=".$cat_id." order by moderator_id desc limit 0,3";
	//$objResponse->addAlert($sql53);
	$rs53=mysql_query($sql53);
	$data1='';
	while($row53=mysql_fetch_array($rs53))
	{
		$sql54="select user_firstname, user_lastname, account_image, facebook_id from tbl_user where user_id=".$row53['moderator_user_id'];
		$rs54=mysql_query($sql54);
		$row54=mysql_fetch_array($rs54);
		if($row54['facebook_id']=="")
		{
			if($row54['account_image']!='' && file_exists("uploads/".$row54['account_image']))
			{
				$srcg="uploads/".$row54['account_image'];
			}
			else
			{
				$srcg="images/red_img.png";
			}		
		}
		else
		{
			if($row54['account_image']!='' && file_exists("uploads/".$row54['account_image']))
			{
				$srcg="uploads/".$row54['account_image'];
			}
			else
			{
				$srcg="http://graph.facebook.com/".$row54['facebook_id']."/picture?width=112&height=80";
			}	
		}	

		
		$data1.='<div class="user-image-left views-field"><img src="'.$srcg.'" alt="#" style="height:80px;width:112px;"/></div>';
		$data1.='<div class="name-text">'.$row54['user_firstname'].' '.$row54['user_lastname'].'</div>';
		$data1.='<div class="clear"></div>';
	}
	$objResponse->addAssign('moder','innerHTML',$data1);
	return $objResponse->getXML();
}
function downorder($rid,$id)
{
	$objResponse = new xajaxResponse();
	//$objResponse->addAlert($id);
	$rid1=($rid+1);
	$id1=($id+1);
	$sql34="update tbl_review_image set rev_rank=$id where rev_id=$rid1";
	//$objResponse->addAlert($sql34);
	mysql_query($sql34);
	$sql35="update tbl_review_image set rev_rank=$id1 where rev_id=$rid";
	//$objResponse->addAlert($sql35);
	mysql_query($sql35);	
	$objResponse->addScript('xajax_uporder_refresh();');
	return $objResponse->getXML();
}
?>
<?php
if(isset($_SESSION['user_id']))
{
	$sql="select user_firstname, user_lastname,user_country, account_image, profile_image, facebook_id from tbl_user where user_id=".@$_SESSION['user_id'];
}

$rs=mysql_query($sql);
$rown=mysql_fetch_array($rs);
if($rown['facebook_id']=="")
{
	if($rown['account_image']!='')
	{
		$src="uploads/".$rown['account_image'];
		
		if(file_exists($src))
		{
			$src="uploads/".$rown['account_image'];
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
	if($rown['account_image']!='')
	{
		$src="uploads/".$rown['account_image'];
		if(file_exists($src))
		{
			$src="uploads/".$rown['account_image'];
		}
		else
		{
			$src="http://graph.facebook.com/".$rown['facebook_id']."/picture?width=60&height=60";
		}
	}
	else
	{
		$src="http://graph.facebook.com/".$rown['facebook_id']."/picture?width=60&height=60";
	}	
}	

$thumb_w='';
$thumb_h='';

if($rown['facebook_id']=="")
{
	if($rown['profile_image']!='')
	{
		$src1="uploads/".$rown['profile_image'];
		if(file_exists($src1))
		{
			$src1="uploads/".$rown['profile_image'];
		}
		else
		{
			$src1="images/no_img.png";
		}
	}
	else
	{
		$src1="images/no_img.png";
	}		
}
else
{
	if($rown['profile_image']!='')
	{
		$src1="uploads/".$rown['profile_image'];
	}
	else
	{
		//$src1="http://graph.facebook.com/".$row['facebook_id']."/picture?width=60&height=60";
		$src1="http://graph.facebook.com/".$rown['facebook_id']."/picture?type=large";
		
		list($width, $height, $type, $attr) = @getimagesize($src1);
															   
		$newheight = 200;
		$newwidth = 200;        
													   
		if ($width>$newwidth || $height>$newheight)
		{
			   $thumb_w=$newwidth;
			   $thumb_h=$newheight;
			   
			   if ($thumb_w/$width*$height>$thumb_h) 
			   {
					   $thumb_w = round($thumb_h*$width/$height); 
			   }
			   else 
			   {
					   $thumb_h = round($thumb_w*$height/$width);
			   }
		} 
		else
		{
			   $thumb_w=$width;
			   $thumb_h=$height;
		}  		
		
		$thumb_w='width:'.$thumb_w.'px;';
		$thumb_h='height:'.$thumb_h.'px;';		
	}	
}		

function request_URI() {
    if(!isset($_SERVER['REQUEST_URI'])) {
        $_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'];
        if($_SERVER['QUERY_STRING']) {
            $_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
        }
    }
    return $_SERVER['REQUEST_URI'];
}

$_SERVER['REQUEST_URI'] = request_URI();
if($_SERVER['HTTP_HOST'] == "localhost")
{
	$name=explode("/", $_SERVER['REQUEST_URI']);
	if($_SESSION['user_id']=="")
	{
		header('Location:login.php?rpage='.$name[2]);
	}
	$pname=explode(".",$name[2]);
}
else
{
	$name=explode("/", $_SERVER['REQUEST_URI']);
	if($_SESSION['user_id']=="")
	{
		header('Location:login.php?rpage='.$name[1]);
	}
	$pname=explode(".",$name[1]);
}


$page1=($pname[0]);

if($page1=="user_page")
{
	$page1="User Information";
}	
else if($page1=="create_rev")
{
	$page1="Create a Review";
}
else if($page1=="create_review")
{
	$page1="Create a Review";
}
else if($page1=="create_category")
{
	$page1="Create Category";
}
else if($page1=="sub_cat")
{
	$page1="Suggest Sub-category";
}
else if($page1=="all_category")
{
	$page1="Category";
}
else if($page1=="edit_user_profile")
{
	$page1="Edit Profile";
}
else if($page1=="general_category")
{
	$page1="General";
}
else if($page1=="infowall")
{
	$page1="Infowall";
}
else if($page1=="category_detail")
{
	$sql="select cat_name from tbl_category where cat";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<!-- title -->

<title><?php echo $page1?></title>

<style>
.chromestyle {
 width: 142%;
 margin-right:10px;
}

p {
  margin: 0 0 20px 0;
}
#page-wrap { 
  width: 1005px; 
  margin: auto;
}
.spacer { 
  height:170px; 
}
table {
  border-collapse: collapse;
}
th { 
  background-color: lightgrey; 
  padding: 10px; 
  width: 200px; 
  text-align: left;
}
tr:nth-child(odd) {
  background: #eee;
}
td { 
  padding: 10px; 
  width: 200px; 
}

.some-other-area {  line-height: 2;
}
.title-div {
    margin: 75px 0 0;
    padding: 0;
	z-index:15000;
	
}
 .floatingHeader {
      position: fixed;
      top: 0;
      visibility: hidden;
    }
	</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
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

</script>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<script type="text/javascript" src="chromejs/chrome.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/chromestyle.css" />
<!--dropdown menu end-->
<!--slider-files-->
	<link rel="stylesheet" href="global/styles/base.css" type="text/css" />
	<link rel="stylesheet" href="global/styles/productbrowser-style27-nov.css" type="text/css" />
	
	
	<script type="text/javascript">
	function emptyfield(divid)
{
//alert(divid);
document.getElementById(divid).innerHTML = '';
}
	</script>
	
<!--slider-files-->
<!-- stylesheets -->
<link rel="stylesheet" href="css/style-fresh.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="front-end/images/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="js/gen_validatorv4.js" language="JavaScript"></script>
<style>
span a
{
	color:#ffffff;
	font:15px 'CalibriRegular';
}	
</style>

<script type="text/javascript" src="chromejs/chrome.js"></script>
<link rel="stylesheet" type="text/css" href="css/chromestyle.css" />

</head>
<body>
<?php print $objXajax->getjavascript(SITE_URL."xajax",'xajax.js')?>
<div id="container"><div class="internal-wrapper-top"><div id="logo"><a href="index.php"><img src="images/internal-logo.png" alt="#" border="0" /></a></div>

<div id="search-panel">  <input name="search" id="search" onkeyup="suggest(this.value);" onblur="fill();"  type="text" class="search-input-internal" value="" /> 

  <a href="review.html"><img src="images/search-icon.png" alt="#" border="0" /></a>
  <a href="create_rev.php"><img src="images/review-icon.png" alt="#" border="0" /></a>

  </div>

<div id="right-panel-user">
      <div class="chromestyle" id="chromemenu">
        <ul>
          <li><a href="#" rel="dropmenu1"><img src="images/fav-icon.png" alt="#" style="margin-top:3px; margin-right:5px;" border="0"/> favorites</a></li>
          <li><a href="logout.php" title="Offerings"><img src="images/logout-btrn.png" alt="#" style="margin-top:3px; margin-right:5px;" border="0"/> LogOUT</a></li>
        </ul>
      </div>
      
      <!--1st drop down menu -->
      <div id="dropmenu1" class="dropmenudiv" style="position:absolute; z-index:2;"> 
		<!--
		<a href="infowall.php" title="Info Wall">- Info Wall</a>
		<a href="movies-categories.html" title="Movies">- Movies</a>
		<a href="general_category.php" title="General">- General</a>
		-->
		
		<?php
		
			if(isset($_SESSION['user_id']))
			{
				$user_id = $_SESSION['user_id'];
			}
			else
			{
				$user_id = 0;
			}
		
			$sql="select a.* from tbl_category a, tbl_favorites b 
				where a.cat_active=1 and 
				a.`cat_id`=b.`cat_id` and 
				b.user_id = $user_id
				order by a.cat_id desc";
			$rs=mysql_query($sql);
			if(mysql_num_rows($rs)>0)
			{
				while($row=mysql_fetch_array($rs))
				{
					print '<a href="category_detail.php?cat_id='.$row['cat_id'].'" title="'.$row['cat_name'].'">- '.$row['cat_name'].'</a>';
				}

			}
			else
			{
				print '<a href="#">- No category found.</a>';
			}
		?>
 </div>
      <script type="text/javascript">
cssdropdown.startchrome("chromemenu")
</script>
      <!-- END Menu -->
	</div>
	<style>
	.name-panel top-user-name a
	{
		color:black;
	}	
	name-panel top-user-name a:hover
	{
		color:#C21C23;
	}	
	<style>
.suggestionList1
 {
    color: #C51700;
    margin-left: 430px;
    margin-top: 80px;
    width: 305px;
    z-index: 1000;
}
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
	top:40px;
	margin: 15px 0px 0px 0px;
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
.name-panel top-user-name a
{
	color:black;
	text-decoration:none;
}	
	</style>
	
<div class="views-field topuser-img"><a href="user_page.php"><img alt="" src="<?php echo $src;?>" style="width:60px;height:60px;"></a></div>
<div class="name-panel top-user-name"><a href="user_page.php"><?php echo $rown['user_firstname']." ".$rown['user_lastname']?></a><br />
 <div class="suggestionsBox" id="suggestions" style="display: none;margin-left:267px"> <img src="images/arrow1.png" style="position: relative; top: -13px; left: 10px;" alt="upArrow" />
 <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
 </div>

</div></div>

