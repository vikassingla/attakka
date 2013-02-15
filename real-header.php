<?php
require("config.php");
session_start();
$con= mysql_connect(DB_HOST, DB_USER_NAME,DB_PASSWORD); 
if(!$con)
{
	die('Could not connect: ' . mysql_error());
}	
mysql_select_db(DB_NAME);
require("xajax/xajax_library.php");
$objXajax= new Xajax();
$objXajax->registerFunction("friend");
$objXajax->registerFunction("favorites");
$objXajax->registerFunction("upvote");
$objXajax->registerFunction("downvote");
$objXajax->registerFunction("uporder");
$objXajax->registerFunction("downorder");
$objXajax->registerFunction("uporder_refresh");
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
$sql="select user_firstname, user_lastname,user_country, account_image, profile_image, facebook_id from tbl_user where user_id=".$_SESSION['user_id'];
$rs=mysql_query($sql);
$row=mysql_fetch_array($rs);
if($row['facebook_id']=="")
{
	if($row['account_image']!='')
	{
		$src="uploads/".$row['account_image'];
	}
	else
	{
		$src="images/red_img.png";
	}		
}
else
{
	if($row['account_image']!='')
	{
		$src="uploads/".$row['account_image'];
	}
	else
	{
		$src="http://graph.facebook.com/".$row['facebook_id']."/picture?width=60&height=60";
	}	
}	
if($row['facebook_id']=="")
{
	if($row['profile_image']!='')
	{
		$src1="uploads/".$row['profile_image'];
	}
	else
	{
		$src1="images/no_img.png";
	}		
}
else
{
	if($row['account_image']!='')
	{
		$src1="uploads/".$row['profile_image'];
	}
	else
	{
		$src1="http://graph.facebook.com/".$row['facebook_id']."/picture?width=60&height=60";
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
$name=explode("/", $_SERVER['REQUEST_URI']);
$pname=explode(".",$name[4]);
$page=($pname[0]);
if($page=="user_page")
{
	$page="User Information";
}	
else if($page=="create_rev")
{
	$page="Create a Review";
}
else if($page=="create_review")
{
	$page="Create a Review";
}
else if($page=="create_category")
{
	$page="Create Category";
}
else if($page=="sub_cat")
{
	$page="Suggest Sub-category";
}
else if($page=="all_category")
{
	$page="Category";
}
else if($page=="edit_user_profile")
{
	$page="Edit Profile";
}
else if($page=="general_category")
{
	$page="General";
}
else if($page=="infowall")
{
	$page="Infowall";
}
else if($page=="category_detail")
{
	$sql="select cat_name from tbl_category where cat";
}
if($_SESSION['user_id']=="")
{
	header('Location:login.php?msg3=plzlogin');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<!-- title -->
<title><?php echo $page?></title>

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
	<script type="text/javascript">
		document.write('<style type="text/css">.productbrowser { opacity:0; }<\/style>');
		if (AC.Detector.isCSSAvailable('transition')) {
			document.write('<link rel="stylesheet" href="global/styles/reveal.css" type="text/css" />');
		}
	</script>
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
      <div id="dropmenu1" class="dropmenudiv" style="position:absolute; z-index:2;"> <a href="infowall.php" title="Info Wall">- Info Wall</a>
<a href="movies-categories.html" title="Movies">- Movies</a>
<a href="categories.html" title="General">- General</a> </div>
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
	
<div class="views-field topuser-img"><a href="edit_user_profile.php"><img alt="" src="<?php echo $src?>" style="width:60px;height:60px;"></a></div>
<div class="name-panel top-user-name"><a href="user_page.php"><?php echo $row['user_firstname']." ".$row['user_lastname']?></a><br />
 <div class="suggestionsBox" id="suggestions" style="display: none;margin-left:100px"> <img src="images/arrow1.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
 <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
 </div>

</div></div>

