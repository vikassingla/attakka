<?php include("header.php");
//echo '<pre>';
extract($_POST);
//echo 'sdsdsdsds'.$hidcatid;die;
if(empty($_POST))
{
	print '
	<script>
	window.location.href="all_category.php";
	</script>
	';
}
if(isset($hidcatid))
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
	//echo '<pre>';
	//print_r($rinfo);die;
	if($rinfo['review_img']!="" && file_exists('review_images/'.$rinfo['review_img']))
	{
		$src="review_images/".$rinfo['review_img'];
	}
	else
	{
		//$src="images/norevimage.jpg";
		$src="images/red-blank1.jpeg";
	}	
}
else
{
		print '
		<script>
		window.location.href="all_category.php";
		</script>
		';
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


function upload_file()
{
    document.getElementById('bgMain').style.display='block';
    //document.getElementById('popup_cover_corp').style.display='block';
	document.form_rev.action='image_crop/uploadfile_review.php';
	document.form_rev.target='frmiframe';
	document.getElementById('uploadfile').value='yes';
	document.form_rev.submit();
}

function show_croper(name)
{
	document.getElementById('popup_cover_corp').style.display='block';
	document.getElementById('b990_image').value='new'+name;
	document.getElementById('editCoverPicturebodyfrm').src = 'crop_reviewcover.php?file='+name;
}

function show_other_image(name)
{
	document.getElementById('review_cover').innerHTML = '<img src="review_images/'+name+'">';

}

function close_popup_cover_corp()
{ 
	document.getElementById('popup_cover_corp').style.display="none";
	document.getElementById('bgMain').style.display="none";
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
              <div id="review_cover">
	          <img  src="<?php echo @$src?>" alt="" class="image-border" style="width:980px;height:260px;"/>
	          </div>
		      <form name="form_rev" action="main.php" method="POST" id="form_rev"  enctype="multipart/form-data" onsubmit="return validateFileds();">
		      <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $cat_id?>"> 
		      <input type="hidden" name="review_id" id="review_id" value="<?php echo $rinfo['review_id']?>">
		      <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id']?>"> 
		      <?php
		      if($rinfo['review_img']=="" || !file_exists('review_images/'.$rinfo['review_img']))
		      {
				  $display='style="background-color:black; color:#fff; font:14px arial; padding:5px 10px; border-radius:10px;margin-top:3px;display:block;"';
			  ?>
		      <h4 style="text-align:center;padding-left:10px;width:968px;top:234px;background:none;margin-top:-117px;color:#000000; font:30px castrella;"> REVIEW : <?php echo $rinfo['review_title']?></h4></div>
		      <?php
		      }
		      else
		      {
				  $display='style="background-color:black; color:#fff; font:14px arial; padding:5px 10px; border-radius:10px;margin-top:3px;display:none;"';
			  ?>
			   <h4 style="padding-left:10px;width:968px;top:234px;"> REVIEW : <?php echo $rinfo['review_title']?></h4></div>
			  <?php
			  } 
			  ?>
			  <div class="clear"></div>
			  <div style="float:right;display:block" id="cover" >
			  
			  <div class="inputWrapper" style="position: absolute;right: 1080px;top: 100px;background:none;">
				<div <?php echo $display;?>>Upload</div>
					<input class="fileInput" onchange="upload_file();" type="file" multiple="multiple" name="file" >
				</div>
			   </div>
			   
			   	
			   
			  <div style="border:1 px solid black;height:120px">
			  <div class="icon-rate-left"><div><img src="images/rate/rate-5.png" alt="#" /></div>
			  <div align="center"><input name="rate[]" id="rate1" type="radio" value="-5" /></div></div>
			  
			  
		
		
		
		<div class="icon-rate"><div><img src="images/rate/rate-4.png" alt="#" /></div>
			  <div align="center"><input name="rate[]" id="rat2" type="radio" value="-4" /></div></div>
		
		<div class="icon-rate"><div><img src="images/rate/rate-3.png" alt="#" /></div>
			 <div align="center"><input name="rate[]" id="rate3" type="radio" value="-3" /></div></div>
		
		<div class="icon-rate"><div><img src="images/rate/rate-2.png" alt="#" /></div>
			 <div align="center"><input name="rate[]" id="rate4" type="radio" value="-2" /></div></div>
		
		<div class="icon-rate"><div><img src="images/rate/rate-1.png" alt="#" /></div>
			 <div align="center"><input name="rate[]" id="rate5" type="radio" value="-1" /></div></div>
		
		
		<div class="icon-rate"><div><img src="images/rate/rate-0.png" alt="#" /></div>
			<div align="center"><input name="rate[]" id="rate6" type="radio" value="0" /></div></div>
		
		
		<div class="icon-rate"><div><img src="images/rate/rate-1plus.png" alt="#" /></div>
			<div align="center"><input name="rate[]" id="rate7" type="radio" value="1" /></div></div>
		
		
		<div class="icon-rate"><div><img src="images/rate/rate-2plus.png" alt="#" /></div>
			  <div align="center"><input name="rate[]" id="rate8" type="radio" value="2" /></div></div>
		
		<div class="icon-rate"><div><img src="images/rate/rate-3plus.png" alt="#" /></div>
			  <div align="center"><input name="rate[]" id="rate9" type="radio" value="3" /></div></div>
		
		
		<div class="icon-rate"><div><img src="images/rate/rate-4plus.png" alt="#" /></div>
			<div align="center"><input name="rate[]" id="rate10" type="radio" value="4" /></div></div>
		
		<div class="icon-rate"><div><img src="images/rate/rate-5plus.png" alt="#" /></div>
			  <div align="center"><input name="rate[]" id="rate11" type="radio" value="5" /></div></div>
			<div class="clear"></div>
			  <div class="error" id="form_rev_rate_errorloc" style="visibility:hidden;text-align:center;">Please enter valid Password</div>
			  </div>

				<div class="clear"></div>
		
			  <div class="form-panel-create-review"><div style="margin-bottom:20px;"><textarea rows="5" class="textarea" style="width:760px;" placeholder="Your Opinion" name="opintitle" id="opintitle" onkeyup="emptyfield('form_rev_opintitle_errorloc')" onkeydown="emptyfield('form_rev_opintitle_errorloc')"></textarea>
			<div class="error" id="form_rev_opintitle_errorloc" style="visibility:hidden;">Please enter valid Password</div>
			  </div>
			  <div style="margin-bottom:20px;"><textarea placeholder="Description" name="destitle" id="destitle" rows="15" class="textarea" style="width:760px;" onkeyup="emptyfield('form_rev_destitle_errorloc')" onkeydown="emptyfield('form_rev_destitle_errorloc')"></textarea>
			 <div class="error" id="form_rev_destitle_errorloc" style="visibility:hidden;">Please enter valid Password</div>
			  </div>
			  <div class="clear"></div>
			  <div style="margin-bottom:20px;"><input name="create_review" type="Submit" class="submit-buttons-round" value="Submit" /> &nbsp; <input name="Clear" type="reset" class="clear-button" value="Clear" />
			 
			   </div>
			   </div>
			   
			    <input type="hidden" name="uploadfile" id="uploadfile" value="">
				<input type="hidden" name="uploadfilenew" id="uploadfilenew" value="">
				<input type="hidden" name="b990_image" id="b990_image" value="">
				<input type="hidden" name="p250_image" id="p250_image" value="">
				
				<div id="PhotoPrevs" style="float:left;width:150px;">
				</div>
				<div id="PhotoPrevs1" style="float:left;width:120px;">
				</div>

			 </form>
			  
<iframe id="frmiframe" frameborder="0" width="0" height="0" src="image_crop/uploadfile_review.php" name="frmiframe" scrolling="no"></iframe>
<div class="popup_bg" id="bgMain" style="display:none;"></div>
<div id="popup_cover_corp" class="popup" style="display: none; width: 1024px; height:auto; margin: 0px auto; position: absolute; top: 50px; z-index: 99999; left:180px;">
	<div class="popup-header">
	<div class="formpanel-text-rightCategory form-text" style="float:left;margin-top: 10px;width: 350px; font-family: 'CalibriRegular';margin-left:350px;font-size: 30px;">Review Image Selection</div>
		<a class="close pull-right" style="float:right;" onclick="close_popup_cover_corp();"> </a>
	</div>
	<div id="crop_core_body" class="bodycontent" style="min-height:350px;">
		<iframe id="editCoverPicturebodyfrm" frameborder="0" name="editCoverPicturebodyfrm" style="  height: 500px;     margin-left: -9px;     width: 1101px;overflow:hidden;"></iframe>
	</div>
</div>
			  			  
<?php include "footer.php"?>
<script language="javascript" type="text/javascript">

	
	
function validateFileds()
{	
	//alert('fsdfdsfsdfsdfsd');return false;
	var opin=document.getElementById('opintitle').value;
	var checkboxs=document.getElementsByName("rate[]");
    var is_checked=false;
    for(var i=0;i<checkboxs.length;i++)
    {
        if(checkboxs[i].checked)
        {
            is_checked=true;
        }
    }
	if(document.getElementById('opintitle').value=="")
	{
		alert('please enter your opinion title');
		document.getElementById('opintitle').focus();
		return false;
	}
	else if(document.getElementById('destitle').value=="")
	{
		alert('please enter your review description');
		document.getElementById('destitle').focus();
		return false;
	}
	else if(!is_checked)
	{
		alert('please check the rating for review');
		return false;
	}
	else if(opin.length>150)
	{
		alert('You can enter only maximum of 150 words.');
		document.getElementById('opintitle').focus();
		return false;
	}
	else
	{
		document.form_rev.action='main.php';
		document.form_rev.target='';	
		document.form_rev.submit();
		return true;
	}
}




</script>
