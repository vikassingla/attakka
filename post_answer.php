<?php include("header.php");
if($_GET['dis_id'])
{
 $dis_id=$_GET['dis_id'];
}	
$sql51="select dis_id, dis_subject, created_by, created_date from tbl_discuss where dis_id=".$dis_id;
//echo $sql51;
$rs51=mysql_query($sql51);
$row51=mysql_fetch_array($rs51);
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
<div class="internal-wrapper" STYLE="position:static">
<?php
if (isset($_GET['msg'])=='susub')
{	
$msg='Your review has been successfully submitted.';
echo '<div class="white-wrapper-error" style="margin-left:15%;width:554px;margin-top:100px;float:left;">'.$msg.'</div>
<div style="margin-top:20px;float:left;position:relative;"> ';
}
else
echo '<div style="margin-top:10px;float:left;position:relative;"> ';
?>

			<div class="right-panel-discuss top-text-discuss" style="text-align:center;margin-right:160px;border:none; margin-right: 256px;margin-top:30px;">SUBJECT: <span class="movie-name-text"><?php echo $row51['dis_subject']?></span></div>
		      <form name="form1" action="reply_topic.php" method="POST" id="form1">
		      <input type="hidden" name="dis_id" id="dis_id" value="<?php echo $dis_id?>"> 
		      <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id']?>"> 
			  <div class="clear"></div>
		
		
			  <div style="margin-bottom:20px;"><textarea placeholder="Your Reply" name="reply" rows="15" class="textarea" style="width:760px;border-radius: 15px;width: 990px;" onkeyup="emptyfield('form1_reply_errorloc')" onkeydown="emptyfield('form1_revtitle_errorloc')"></textarea>
			 <div class="error" id="form1_reply_errorloc" style="visibility:hidden;">Please enter valid Password</div>
			  </div>
			  <div class="clear"></div>
			  <div style="margin-bottom:20px;"><input name="post_reply" type="Submit" class="submit-buttons-round" value="Submit" /> &nbsp; <input name="Clear" type="reset" class="clear-button" value="Clear" />
			 
			   </div>
			  			  </div>
			  			  </form>
	<?php include "footer.php"?>
<script language="javascript" type="text/javascript">
var frmvalidator  = new Validator("form1");
//frmvalidator.EnableOnPageErrorDisplay();
frmvalidator.EnableMsgsTogether();
frmvalidator.addValidation("reply","req","Please enter your reply");
</script>
