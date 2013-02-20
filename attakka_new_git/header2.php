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

$sql="select user_firstname, user_lastname,user_country, account_image, profile_image, facebook_id from tbl_user where user_id=".$_SESSION['user_id'];
//echo $sql;
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
/*echo "<pre>"; 
print_r($row);*/
?>
<?php
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
//echo $_SERVER['REQUEST_URI'];
$name=explode("/", $_SERVER['REQUEST_URI']);
//print_r($name[4]);
$pname=explode(".",$name[1]);
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
	</style>
<!--dropdown menu-->

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
}
.suggestionList ul li:hover {
	background-color: #FC3;
	color:#000;
}
ul {
	font-family:CalibriRegular;
	font-size:15px;
	color:#FFF;
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
</head>


<body>
<div id="container"><div class="internal-wrapper-top"><div id="logo"><a href="index.php"><img src="images/internal-logo.png" alt="#" border="0" /></a></div>

<div id="search-panel">  <input name="search" id="search" onkeyup="suggest(this.value);" onblur="fill();"  type="text" class="search-input-internal" value="" /> 
  <a href="review.html"><img src="images/search-icon.png" alt="#" border="0" /></a>
  <a href="create_rev.php"><img src="images/review-icon.png" alt="#" border="0" /></a></div>

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
	</style>
<div class="views-field topuser-img"><a href="edit_user_profile.php"><img alt="" src="<?php echo $src?>" style="width:60px;height:60px;"></a></div>
<div class="name-panel top-user-name"><?php echo $row['user_firstname']." ".$row['user_lastname']?><br />
<?php
if($page=='user_page')
{
}
else
{
	echo ' <a href="user_page.php">DASHBOARD</a>';
}
?>	
 <div class="suggestionsBox" id="suggestions" style="display: none;margin-left:100px"> <img src="images/arrow1.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
 </div>

</div></div>
