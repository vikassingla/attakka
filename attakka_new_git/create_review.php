<?php include("header.php");
/*echo "<pre>";
print_r($_POST);*/
extract($_POST);
if(empty($_POST))
{
	print '
	<script>
	window.location.href="all_category.php";
	</script>
	';
}
if($hidcatid)
{
$cat_id=$hidcatid;
$exist=isCreategoryIdExist($cat_id);
if($exist)
{
	print '
	<script>
	window.location.href="all_category.php";
	</script>
	';
}
 $rname=$catinput;	
$exist1=isReviewExist($rname, $cat_id);
if($exist1==0)
{
	print '
	<script>
	window.location.href="create_rev.php?cat_id='.$cat_id.'";
	</script>
	';
}
$rinfo=reviewInfo($rname, $cat_id);
if($rinfo['review_img']!="")
{
	$src="review_images/".$row1['rev_img'];
}
else
{
	$src="images/norevimage.jpg";
}	
}

?>
<script>
function emptyfield(divid)
{
//alert(divid);
document.getElementById(divid).innerHTML = '';
}

</script>
<script>
function checkbox(obj)
{
if(obj.checked)
{
	
	document.getElementById("form1_rate_errorloc").innerHTML="";
}
else
{
	document.getElementById("form1_rate_errorloc").innerHTML="Please rate your review";
}		
}
</script>
<script>

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
<div class="internal-wrapper" style="position:static;">
<?php
if (isset($_GET['msg'])=='susub')
{	
$msg='Your review has been successfully submitted.';
echo '<div class="white-wrapper-error" style="margin-left:24%;width:554px;margin-top:10px;float:left;">'.$msg.'</div>
<div style="margin-top:20px;float:left;position:relative;"> ';
}
else
echo '<div style="margin-top:20px;float:left;position:relative;"> ';
?>
<img src="<?php echo $src?>" alt="" class="image-border" />
		      <form name="form1" action="main.php" method="POST" id="form1">
		      <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $cat_id?>"> 
		      <input type="hidden" name="review_id" id="review_id" value="<?php echo $rinfo['review_id']?>">
		      <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id']?>"> 
		      <h4 style="padding-left:10px;width:968px;top:234px;"> REVIEW : <?php echo $rinfo['review_title']?></h4></div>
		   
			  <div class="clear"></div>
			  <div style="float:right;display:none" id="cover" onMouseOver=" document.getElementById('center').style.visibility = 'visible'" onMouseOut="document.getElementById('cover').style.display = 'none'">
			      <img src="images/edit_icon.png" align="right" alt="edit" title="edit" id="editconverpicture" style="margin-top: -270px; position: relative;margin-right:35px;border:none;" onclick="changeCoverPicture();">
			      </div>
			  <div style="border:1 px solid black;height:120px">
			  <div class="icon-rate-left"><div><img src="images/rate/rate-5.png" alt="#" /></div>
			  <div align="center"><input name="rate" id="rate" type="radio" value="-5" onclick="checkbox(this);"/></div></div>
		
		
		<div class="icon-rate"><div><img src="images/rate/rate-4.png" alt="#" /></div>
			  <div align="center"><input name="rate" id="rate" type="radio" value="-4" onclick="checkbox(this);"/></div></div>
		
		<div class="icon-rate"><div><img src="images/rate/rate-3.png" alt="#" /></div>
			 <div align="center"><input name="rate" id="rate" type="radio" value="-3" onclick="checkbox(this);"/></div></div>
		
		<div class="icon-rate"><div><img src="images/rate/rate-2.png" alt="#" /></div>
			 <div align="center"><input name="rate" id="rate" type="radio" value="-2" onclick="checkbox(this);"/></div></div>
		
		<div class="icon-rate"><div><img src="images/rate/rate-1.png" alt="#" /></div>
			 <div align="center"><input name="rate" id="rate" type="radio" value="-1" onclick="checkbox(this);"/></div></div>
		
		
		<div class="icon-rate"><div><img src="images/rate/rate-0.png" alt="#" /></div>
			<div align="center"><input name="rate" id="rate" type="radio" value="0" onclick="checkbox(this);"/></div></div>
		
		
		<div class="icon-rate"><div><img src="images/rate/rate-1plus.png" alt="#" /></div>
			<div align="center"><input name="rate" id="rate" type="radio" value="1" onclick="checkbox(this);"/></div></div>
		
		
		<div class="icon-rate"><div><img src="images/rate/rate-2plus.png" alt="#" /></div>
			  <div align="center"><input name="rate" id="rate" type="radio" value="2" onclick="checkbox(this);"/></div></div>
		
		<div class="icon-rate"><div><img src="images/rate/rate-3plus.png" alt="#" /></div>
			  <div align="center"><input name="rate" id="rate" type="radio" value="3" onclick="checkbox(this);"/></div></div>
		
		
		<div class="icon-rate"><div><img src="images/rate/rate-4plus.png" alt="#" /></div>
			<div align="center"><input name="rate" id="rate" type="radio" value="4" onclick="checkbox(this);"/></div></div>
		
		<div class="icon-rate"><div><img src="images/rate/rate-5plus.png" alt="#" /></div>
			  <div align="center"><input name="rate" id="rate" type="radio" value="5" onclick="checkbox(this);"/></div></div>
			<div class="clear"></div>
			  <div class="error" id="form1_rate_errorloc" style="visibility:hidden;text-align:center;">Please enter valid Password</div>
			  </div>

				<div class="clear"></div>
		
			  <div class="form-panel-create-review"><div style="margin-bottom:20px;"><textarea rows="5" class="textarea" style="width:760px;" placeholder="Your Opinion" name="opintitle" onkeyup="emptyfield('form1_opintitle_errorloc')" onkeydown="emptyfield('form1_opintitle_errorloc')"></textarea>
			<div class="error" id="form1_opintitle_errorloc" style="visibility:hidden;">Please enter valid Password</div>
			  </div>
			  <div style="margin-bottom:20px;"><textarea placeholder="Description" name="destitle" id="destitle" rows="15" class="textarea" style="width:760px;" onkeyup="emptyfield('form1_destitle_errorloc')" onkeydown="emptyfield('form1_destitle_errorloc')"></textarea>
			 <div class="error" id="form1_destitle_errorloc" style="visibility:hidden;">Please enter valid Password</div>
			  </div>
			  <div class="clear"></div>
			  <div style="margin-bottom:20px;"><input name="create_review" type="Submit" class="submit-buttons-round" value="Submit" /> &nbsp; <input name="Clear" type="reset" class="clear-button" value="Clear" />
			 
			   </div>
			  			  </div>
			  			  </form>
			  			  
	<?php include "footer.php"?>
<script language="javascript" type="text/javascript">
var frmvalidator  = new Validator("form1");
frmvalidator.EnableOnPageErrorDisplay();
frmvalidator.EnableMsgsTogether();
frmvalidator.addValidation("opintitle","req","Please enter Title Opinion");

frmvalidator.addValidation("destitle","req","Please enter Title Review");

frmvalidator.addValidation("rate","selone","Please rate your review.");

</script>
