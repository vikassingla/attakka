<?php include("header.php");
if($_GET['cat_id'])
{
 $cat_id=$_GET['cat_id'];
}	
$sql="select cat_id, cat_parent_id, cat_img, cat_name from tbl_category where cat_id=".$cat_id;
$rs=mysql_query($sql);
$row=mysql_fetch_array($rs);
if($row['cat_parent_id']==0)
{
	$sql1="select rev_img from tbl_review_image where rev_cat_id=".$cat_id." ORDER BY RAND() LIMIT 0,1";
	//echo $sql1;
	$rs1=mysql_query($sql1);
	if(mysql_num_rows($rs)>0)
	{
	$row1=mysql_fetch_array($rs1);
	$src="review_images/".$row1['rev_img'];
	}
	else
	{
		$src="images/norevimage.jpg";
	}	
}
else
{
	$src="cat_images/".$row['cat_img'];
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
<div style="float:right;margin-top:10px;"><a href="create_category.php"><img src="images/vote/new_category.png"></a></div>
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
		      <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id']?>"> 
		      <h4 style="padding-left:10px;width:968px;top:234px;"> REVIEW : <?php echo $row['cat_name']?></h4></div>
			  <div class="clear"></div>
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
		
			  <div class="form-panel-create-review"><div style="margin-bottom:20px;"><textarea rows="5" class="textarea" style="width:760px;" placeholder="Title Opinion" name="opintitle" onkeyup="emptyfield('form1_opintitle_errorloc')" onkeydown="emptyfield('form1_opintitle_errorloc')"></textarea>
			<div class="error" id="form1_opintitle_errorloc" style="visibility:hidden;">Please enter valid Password</div>
			  </div>
			  <div style="margin-bottom:20px;"><textarea placeholder="Title Review" name="revtitle" rows="15" class="textarea" style="width:760px;" onkeyup="emptyfield('form1_revtitle_errorloc')" onkeydown="emptyfield('form1_revtitle_errorloc')"></textarea>
			 <div class="error" id="form1_revtitle_errorloc" style="visibility:hidden;">Please enter valid Password</div>
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
frmvalidator.addValidation("opintitle","maxlen=20", "Maximum length for Title Opinion is 20");

frmvalidator.addValidation("revtitle","req","Please enter Title Review");

frmvalidator.addValidation("rate","selone","Please rate your review.");

</script>
