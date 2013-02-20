<?
include("config.php");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

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
$cname=explode("?",$pname[1]);


?>
	<script type="text/javascript">
	function emptyfield(divid)
{
//alert(divid);
document.getElementById(divid).innerHTML = '';
}
	</script>
	<script type="text/javascript">
    // placeholder polyfill
    $(document).ready(function(){
        function add() {
            if($(this).val() == ''){
                $(this).val($(this).attr('placeholder')).addClass('placeholder');
            }
        }

        function remove() {
            if($(this).val() == $(this).attr('placeholder')){
                $(this).val('').removeClass('placeholder');
            }
        }

        // Create a dummy element for feature detection
        if (!('placeholder' in $('<input>')[0])) {

            // Select the elements that have a placeholder attribute
            $('input[placeholder], textarea[placeholder]').blur(add).focus(remove).each(add);

            // Remove the placeholder text before the form is submitted
            $('form').submit(function(){
                $(this).find('input[placeholder], textarea[placeholder]').each(remove);
            });
        }
    });
</script>
<link rel="stylesheet" href="css/style-fresh.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="front-end/images/favicon.ico" type="image/x-icon">

<title><?php echo $page?></title>
<script type="text/javascript" src="js/gen_validatorv4.js" language="JavaScript"></script>
</head>
<body>
<div id="main-wrapper">
<div align="center"><a href="index.php"><img src="images/logo-big.png" alt="" /></a></div>

