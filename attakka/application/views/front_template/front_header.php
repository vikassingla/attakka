<?php  
$session_data =  get_session_data();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<!-- basic meta tags -->
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="index, follow" />
<!-- title -->
<title><?php if(isset($title)) { echo $title;}?></title>
<base href="<?php echo base_url();?>">
<!-- stylesheets -->
<link rel="stylesheet" href="css/style-fresh.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
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
<script type='text/javascript' src='jquery/jquery.js?ver=1.7.2'></script>
<script type='text/javascript' src='jquery/jquery.prettyPhoto.js?ver=3.4'></script>
<script type='text/javascript' src='jquery/custom.js?ver=3.4'></script>
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

