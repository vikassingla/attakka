<?php
include("header.php");

?>
<script type="text/javascript">
function moderator(i)
{
	document.getElementById("mod").value=i;
	//alert(document.getElementById("mod").value);
	if(i==1)
	{
		document.getElementById("mode1").style.background="-moz-linear-gradient(center top , #eb594e 0%, #c12419 100%) repeat scroll 0 0 transparent";
		document.getElementById("mode1").style.border="1px solid #c12419";
		document.getElementById("mode").style.background="-moz-linear-gradient(center top , #454545 0%, #303030 100%) repeat scroll 0 0 transparent";
		document.getElementById("mode").style.border="1px solid #303030";
	}
	else
	{
		document.getElementById("mode").style.background="-moz-linear-gradient(center top , #eb594e 0%, #c12419 100%) repeat scroll 0 0 transparent";
		document.getElementById("mode").style.border="1px solid #c12419";
		document.getElementById("mode1").style.background="-moz-linear-gradient(center top , #454545 0%, #303030 100%) repeat scroll 0 0 transparent";
		document.getElementById("mode1").style.border="1px solid #303030";
	}	
}	
function upload_file()
{
	document.form1.action='image_crop/uploadfile.php';
	document.form1.target='frmiframe';
	document.getElementById('uploadfile').value='yes';
	document.form1.submit();
}
function upload_new_file()
{
	document.getElementById('uploadimageopt').checked=true;
	document.form1.action='image_crop/uploadfile.php';
	document.form1.target='frmiframe';
	document.getElementById('uploadfile').value='';
	document.getElementById('uploadfilenew').value='newfile';
	document.form1.submit();
}
function show_croper(name)
{
	document.getElementById('popup_cover_corp').style.display='block';
	document.getElementById('editCoverPicturebodyfrm').src = 'crop_coverimage_view.php?file='+name;
}
function show_croper2(name)
{
	document.getElementById('popup_cover_corp').style.display='block';
	document.getElementById('editCoverPicturebodyfrm').src = 'crop_image_view.php?file='+name;
}
function use_default_image()
{
	var name = document.getElementById('b990_image').value;
	document.getElementById('popup_cover_corp').style.display='block';

	document.getElementById('editCoverPicturebodyfrm').src = 'crop_image_view.php?file='+name;

}

</script>
<link href="scripts/jQuery-Impromptu/jquery-impromptu.css" rel="stylesheet" type="text/css" />
		<link href="scripts/fineuploader/fineuploader.css" rel="stylesheet" type="text/css" />
		<link href="scripts/Jcrop/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" src="scripts/jquery-1.8.3.min.js"></script>
		<!--
		<script type="text/javascript" src="scripts/jQuery-Impromptu/jquery-impromptu.js"></script>
		<script type="text/javascript" src="scripts/fineuploader/jquery.fineuploader-3.0.min.js"></script>
		<script type="text/javascript" src="scripts/Jcrop/jquery.Jcrop.min.js"></script>
		<script type="text/javascript" src="scripts/jquery-uberuploadcropper.js"></script>
		-->
<style>
.qq-upload-list li.qq-upload-success {
    background-color: #5DA30C;
    color: #FFFFFF;
    margin-bottom: 5px;
    margin-top: 5px;
    width: 240px;
}
</style>
<script type="text/javascript">
			$(function() {
				
				$('#UploadImages').uberuploadcropper({
					//---------------------------------------------------
					// uploadify options..
					//---------------------------------------------------
					fineuploader: {
						//debug : true,
						request	: { 
							// params: {}
							endpoint: 'upload.php' 
						},						
						validation: {
							//sizeLimit	: 0,
							allowedExtensions: ['jpg','jpeg','png','gif']
							
						}
					},
					//---------------------------------------------------
					//now the cropper options..
					//---------------------------------------------------
					jcrop: {
						aspectRatio  : 1, 
						allowSelect  : true, //can reselect
						allowResize  : true,  //can resize selection
						setSelect    : [ 0, 0, 250, 214 ], //these are the dimensions of the crop box x1,y1,x2,y2
						minSize      : [ 990, 214 ], //if you want to be able to resize, use these
						maxSize      : [ 500, 500 ]
					},
					//---------------------------------------------------
					//now the uber options..
					//---------------------------------------------------
					folder           : 'uploads/', // only used in uber, not passed to server
					cropAction       : 'crop.php', // server side request to crop image
					onComplete       : function(e,imgs,data){ 
						var $PhotoPrevs = $('#PhotoPrevs');
						var name="";
						for(var i=0,l=imgs.length; i<l; i++){
							
							name=imgs[i].filename+","+name;
							//alert(imgs[i].filename);
							$PhotoPrevs.append('<img style="height:100px;" src="uploads/'+ imgs[i].filename +'?d='+ (new Date()).getTime() +'" />&nbsp;&nbsp;<input type="hidden" name="catimg" value="'+name+'">');
							
						}
					}
				});
				
			});
		</script>
<div id="main-wrapper" style="padding-top:100px;">
<?php
	if (isset($_GET['msg'])=='alexist')
	{	
		$msg='This category already exist. Please use a different name.';
		echo '<div class="white-wrapper-error" style="margin-left:20%;width:554px">'.$msg.'</div>';
	}
?>					
<div class="white-wrapper">
	<div style="padding:15px;">
		<div class="red-color-heading">Create a <span class="black-color-heading">Category</span></div>
			<div class="clear"></div>
			<div id="left-panelform">
			<form name="form1" id="form1" action="main.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
			<div style="float:left;height:50px;">
				<div class="formpanel-text form-text">Category Name: </div>
				<div class="inputpanel-rightCategory"><input name="catname" id="catname" type="text" class="input" style="width:263px;" onkeyup="emptyfield('form1_catname_errorloc')" onkeydown="emptyfield('form1_catname_errorloc')"/></div>
				<div class="error" id="form1_catname_errorloc" style="visibility:hidden;">Please enter valid Password</div>
			</div>
			<div class="clear"></div>
			<div style="float:left;height:60px;height:auto;">
				<div class="formpanel-text form-text">Category Image :<br/>
				(990px X 272px)</div>
				<div class="inputpanel-rightCategory">
				<div id="wrapper" style="margin-bottom:20px;">
			<!--
						<div id="UploadImages">
						</div>
			-->		
				<input type="hidden" name="uploadfile" id="uploadfile" value="">
				<input type="hidden" name="uploadfilenew" id="uploadfilenew" value="">
				<input type="hidden" name="b990_image" id="b990_image" value="">
				<input type="hidden" name="p250_image" id="p250_image" value="">
				<div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">
				<div >Upload</div>
					<input onchange="upload_file();" type="file" multiple="multiple" name="file" style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 118px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0;">
				</div>	
				<div id="PhotoPrevs" style="float:left;width:150px;">
				</div>
				<div id="PhotoPrevs1" style="float:left;width:120px;">
				</div>
				<br>
				<div id="imageoptions" style="display:none;margin-top:5px;width:275px;float:left;">
					<input type="radio" name="setimage" id="setdefaultopt" onclick="use_default_image();"> Use same image for Mosaic<br>
					
					<input  type="radio" name="setimage" id="uploadimageopt" onclick=""> Upload New
					<input onchange="upload_new_file();" type="file" multiple="multiple" name="uploadnewfile" style="float: left;     margin-left: -105px;     opacity: 0;     position: absolute;     width: 10px;cursor:pointer;">

				</div>
				
					</div>
				</div>
				<div class="error" id="form1_catimage_errorloc" style="visibility:hidden;">Please enter valid Password</div>
			</div>
			<div class="clear"></div>	
						<div style="float:left;height:50px;">
				<div class="formpanel-text form-text">Is your category:</div>
				<div class="inputpanel-rightCategory">
					<select name="cat_referance"  class="input" style="width:200px;">
						<option>Regional</option>
						<option>Global</option>
					</select>
				</div>
			</div>
			<div class="clear"></div>
			<div style="float:left;height:50px;">
				<div class="formpanel-text form-text">Review Defaults: </div>
				<div class="inputpanel-rightCategory"><input name="defreview" id="defreview" type="text" class="input" style="width:263px;" onkeyup="emptyfield('form1_defreview_errorloc')" onkeydown="emptyfield('form1_defreview_errorloc')"/></div>
				<div class="error" id="form1_defreview_errorloc" style="visibility:hidden;">Please enter valid Password</div>
			</div>
			
			<div class="clear"></div>
			<div class="clear"></div>
			<div class="clear"></div>
			</div>
			<div id="right-panelform"><div class="formpanel-text-rightCategory form-text">Category Rules:</div>
			<div class="inputpanel-rightCategory2"> <textarea name="catrules" rows="8" class="textarea" style="width:270px;" onkeyup="emptyfield('form1_catrules_errorloc')" onkeydown="emptyfield('form1_catrules_errorloc')"></textarea> 
			<div class="error" id="form1_catrules_errorloc" style="visibility:hidden;">Please enter valid Password</div>
			</div>

			<div id="right-panelform"><div class="formpanel-text-rightCategory form-text"> Category Descripition:</div>
			<div class="inputpanel-rightCategory2"> <textarea name="catdes" rows="8" class="textarea" style="width:270px;" onkeyup="emptyfield('form1_catdes_errorloc')" onkeydown="emptyfield('form1_catdes_errorloc')"></textarea> 
			<div class="error" id="form1_catdes_errorloc" style="visibility:hidden;">Please enter valid Password</div>
			</div>
			</div>
			</div>
			<div class="clear"></div>
			<div class="form-text" style="float:left;margin-left:20px;">Do you want to apply for Moderator (MOD)?   </div><input type="button" id="mode" name="mode" value="YES" class="button-form-new" style="margin-left:40px;" onclick="moderator(1)"><input type="button" class="button-form-new" name="mode1" id="mode1" value="N0" onclick="moderator(0)">
			<input type="hidden" name="mod" id="mod">
			<div class="clear"></div>
			<div><img src="images/line-flip.png" alt="#" /></div>
			<div class="clear"></div>
			<div align="center"><span style="margin-bottom:20px;">
			<input name="create_cat" type="submit" class="submit-buttons-round" value="Submit" />
			&nbsp;
			<input name="Clear" type="reset" class="clear-button" value="Clear" />
			</span></div>
			</form>

</div></div>

<iframe id="frmiframe" frameborder="0" width="0" height="0" src="image_crop/uploadfile.php" name="frmiframe" ></iframe>
<div id="popup_cover_corp" class="popup" style="display: none; width: 1024px; height:500px; margin: 0px auto; position: absolute; top: 50px; z-index: 99999; left:180px;">
	<div class="popup-header">
		<a class="close pull-right" style="float:right;" onclick="close_popup_cover_corp();"> </a>
	</div>
	<div id="crop_core_body" class="bodycontent" style="min-height:350px;">
		<iframe id="editCoverPicturebodyfrm" frameborder="0" name="editCoverPicturebodyfrm" style="  height: 490px;     margin-left: -9px;     width: 1101px;"></iframe>
	</div>
</div>
<div id="popup_cover_corp" class="popup" style="display: none; width: 1024px; height:500px; margin: 0px auto; position: absolute; top: 50px; z-index: 99999; left:180px;">
	<div class="popup-header">
		<a class="close pull-right" style="float:right;" onclick="close_popup_cover_corp();"> </a>
	</div>
	<div id="crop_core_body" class="bodycontent" style="min-height:350px;">
		<iframe id="editCoverPicturebodyfrm" frameborder="0" name="editCoverPicturebodyfrm" style="  height: 490px;     margin-left: -9px;     width: 1101px;"></iframe>
	</div>
</div>


<script language="javascript" type="text/javascript">
function close_popup_cover_corp()
{ 
	parent.document.getElementById('popup_cover_corp').style.display="none";
}
function show_other_image(name)
{
	document.getElementById('PhotoPrevs').innerHTML = '<img src="review_images/'+name+'" width="135" height="60">';
	document.getElementById('imageoptions').style.display='block';
	document.getElementById('b990_image').value=name;
	document.form1.action='main.php';
	document.form1.target='';	
	
}
function show_other_image2(name)
{
	document.getElementById('PhotoPrevs1').innerHTML = '<img src="review_images/thumb_'+name+'" width="120" height="60">';
	document.getElementById('imageoptions').style.display='block';
	document.getElementById('p250_image').value=name;
	document.form1.action='main.php';
	document.form1.target='';
}



var frmvalidator  = new Validator("form1");
//frmvalidator.EnableOnPageErrorDisplay();
frmvalidator.EnableMsgsTogether();
frmvalidator.addValidation("catname","req","Please enter Category name");
frmvalidator.addValidation("catname","alpha_s", "Please enter alphabet only");
frmvalidator.addValidation("catname","maxlen=50", "Maximum length for Category Name is 50");

frmvalidator.addValidation("catrules","req","Please enter your rules");

frmvalidator.addValidation("catdes","req","Please enter your description");
</script>
<?php include("footer.php")?>
</div>
