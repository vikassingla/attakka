<?php include "header.php"?>
<?php
$msg="";
if(isset($_REQUEST['msg']) && $_REQUEST['msg']=='sudel')
{	
$msg='All the data related to categories, reviews has been deleted successfully.';
echo '<div class="white-wrapper-error" style="margin-left:32%;width:554px;margin-top:20px;float:left;">'.$msg.'</div>';
}	
?>
<div class="internal-wrapper">
<center>
<div style="padding:15px;margin-top:90px;border: none;border-radius: 5px 5px 5px 5px;width:300px;">

<form method="POST" action="main.php">
<input type="submit" name="reset" class="reset" value="" >
</form>
<div class="clear"></div>
</div>
</center>

<div class="clear"></div>

<?php include "footer.php"?>
