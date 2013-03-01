<?php
include("header.php");
//print "<pre>";
//print_r($_SESSION);
?>
<script type="text/javascript">

function upload_file()
{
    document.getElementById('bgMain').style.display='block';
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
				try
				{
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
				}
				catch(err)
				{
				  //Handle errors here
				}
				
			});
		
		
		</script>
		<script>
		var count_neigh=1;
		function selectChanged(newvalue) 
		{
			
			for(i=1;i<=3;i++)
			{
				var input = document.createElement('input');
				input.name = 'neigh_input[]';
				input.id = 'neigh_input'+i;
				input.className = 'input';
				if(newvalue=="Regional")
				{
					document.getElementById("filter_neigh").style.display="block";
					document.getElementById('filter_neigh').appendChild(input);
					document.getElementById(input.id).style.width='90px';
					document.getElementById(input.id).style.marginRight='5px';
					if(i==1)
					{
						document.getElementById(input.id).style.marginLeft='55px';
					}
					count_neigh++;
				}
				else
				{
					var removeEle=document.getElementById(input.id);
					var appendDiv=document.getElementById('filter_neigh');
					appendDiv.removeChild(removeEle);
					document.getElementById("filter_neigh").style.display="none";
					count_neigh=1;
					//count_neigh--;
				
				}
				
			}
			var oImg=document.createElement("img");
			oImg.setAttribute('src', 'images/plus.png');
			oImg.setAttribute('height', '24px');
			oImg.setAttribute('align', 'middle');
			oImg.setAttribute('onclick', 'create_more(\'filter_neigh\');');
			oImg.id = 'img_neigh';
			if(newvalue=="Regional")
			{
				document.getElementById('filter_neigh').appendChild(oImg);
			}
			else
		    {
				var removeEle=document.getElementById(oImg.id);
				var appendDiv=document.getElementById('filter_neigh');
				appendDiv.removeChild(removeEle);
			}
					
		}
		var filter_cnt=1;
		var custom_check=0;
		function create_filter()
		{
			//alert("hi");
			var newDiv=document.createElement('div');
			var inputFilter = document.createElement('input');
			var containerDiv=document.createElement('div');
			containerDiv.className='clear';
			newDiv.className='formpanel-text form-text';
			inputFilter.className='input';
			newDiv.id='filter_label'+filter_cnt;
			inputFilter.id='filter_input'+filter_cnt;
			inputFilter.name='filter_input[]';
			newDiv.innerHTML='Filter Name';
			document.getElementById('filter_div').appendChild(newDiv);
			document.getElementById('filter_div').appendChild(inputFilter);
			document.getElementById('filter_label' + filter_cnt).setAttribute('style','margin-top: 15px;min-height:21px;');
			document.getElementById('filter_input' + filter_cnt).setAttribute('style','margin-top:10px;margin-bottom:25px;');
			for(i=1;i<4;i++)
			{
				var getFilterLen=document.getElementsByName('filter_input[]').length-1;
				var input = document.createElement('input');
				input.name = 'custom_filter'+getFilterLen+'[]';
				input.id = 'custom_filter'+filter_cnt;
				input.className = 'input';
				document.getElementById('filter_div').appendChild(input);
				document.getElementById(input.id).style.width='90px';
				if(i>1 && i<=4)
				{
					document.getElementById(input.id).style.marginLeft='5px';
				}
				filter_cnt++;
			}
			custom_check++;
			var oImg=document.createElement("img");
			oImg.setAttribute('src', 'images/plus.png');
			oImg.setAttribute('height', '24px');
			oImg.setAttribute('align', 'middle');
			oImg.setAttribute('onclick', 'create_more(\'filter_div\');');
			oImg.id = 'img_neigh';
			
			
		
			document.getElementById('filter_div').appendChild(oImg);
			document.getElementById('filter_div').appendChild(containerDiv);
		}
		function create_more(divid)
		{
			//document.getElementById('cat_referance').value);return false;
			var getFilterLen=document.getElementsByName('filter_input[]').length-1;
			for(i=1;i<=3;i++)
			{
				var input = document.createElement('input');
				if(divid=='filter_div')
				{
					
					input.id = 'custom_filter'+filter_cnt;
					input.name = 'custom_filter'+getFilterLen+'[]';
				}
				else
				{
					input.id = 'neigh_input'+count_neigh;
					input.name = 'neigh_input[]';
				}
				
				input.className = 'input';
				document.getElementById(divid).style.display="block";
				document.getElementById(divid).appendChild(input);
				document.getElementById(input.id).style.width='90px';
				document.getElementById(input.id).style.marginRight='5px';
				document.getElementById(input.id).style.marginTop='5px';
				if(i==1 && divid=='filter_neigh')
				{
					document.getElementById(input.id).style.marginLeft='55px';
				}
				filter_cnt++;
				count_neigh++;
			}
		}
		function remove_more()
		{
			if(document.getElementById('cat_referance').value!='Regional' && count_neigh>3)
			{
				for(i=4;i<count_neigh;i++)
				{
					var input = document.createElement('input');
					input.name = 'neigh_input[]';
					input.id = 'neigh_input'+i;
					input.className = 'input';
					
					var removeEle=document.getElementById(input.id);
					var appendDiv=document.getElementById('filter_neigh');
					appendDiv.removeChild(removeEle);
				}
				count_neigh=1;
			}
		}
		var insertFil=1;
		function insertFilter()
		{
		  var divCon=document.createElement('div');
		  var divquse1=document.createElement('div');
		  var divquse2=document.createElement('div');
		  var divquse3=document.createElement('div');
		  var divFilterContent=document.createElement('div');
		  var divFilterSearch=document.createElement('div');
		  var input = document.createElement("input");
		  //var input1 = document.createElement("input");



		  //var divAddFilter=document.createElement('div');
		  
		  var divFilterContentInput=document.createElement('input');
		  var divquse1Span=document.createElement('span');
		  var divquse2Span=document.createElement('span');
		  var divquse3Span=document.createElement('span');
		  
		 
		  var divquse1Img=document.createElement('img');
		  var divquse2anch=document.createElement('a');
		  //var divAddFilteranch=document.createElement('a');
		  var divquse3Img=document.createElement('img');
		  
		  divCon.className='blog';
		  divquse1.className='qus';
		  divquse2.className='qus';
		  divquse3.className='qus';
		  divquse2anch.className='tag';
		  divFilterContent.className='textbox';
		  divFilterSearch.className='lable_outer';
		  divFilterContentInput.className='appendIt';
		  //divAddFilter.className='add_filter';
		  
		  divquse1Span.innerHTML='What filter would you like to apply for this category:';
		  divquse2Span.innerHTML='Filter:';
		  divquse3Span.innerHTML='Subfilters';
		  divquse2anch.innerHTML=' ';
		 // divAddFilteranch.innerHTML='Add Another Filter';
		  
		  divquse1Img.setAttribute('src', 'images/qus.png');
		  divquse3Img.setAttribute('src', 'images/qus.png');
		  
		  
		  
		  divCon.id='filter_main'+insertFil;
		  divquse2anch.id='filterAnchor'+insertFil;
		  divFilterContent.id='filter_content'+insertFil;
		  divFilterContent.name='filter_content'+insertFil+'[]';
		  divFilterContentInput.id='filter_textbox'+insertFil;
		  divFilterContentInput.name='filter_textbox'+insertFil+'[]';
		  divFilterSearch.id='filter_options_div'+insertFil;
		  input.id='txtval_hidden'+insertFil;
		  input.name = 'txtval_hidden'+insertFil+'[]';
		  //input1.id='txtval_filterhidden'+insertFil;
		  //input1.name = 'txtval_filterhidden'+insertFil+'[]';
		  
		  
		  //divConId.setAttribute('style','display:block;');
		  //filterInput.setAttribute('style','border:none;width:40px;height:22px;padding-left:5px;');
		  
		  
		  divquse1.appendChild(divquse1Span);
		  divquse1.appendChild(divquse1Img);
		  divquse2.appendChild(divquse2Span);
		  divquse2.appendChild(divquse2anch);
		  divquse3.appendChild(divquse3Span);
		  divquse3.appendChild(divquse3Img);
		  divFilterContent.appendChild(divFilterContentInput);
		  //divAddFilter.appendChild(divAddFilteranch);
		  
		  
		  
		  
		  divCon.appendChild(divquse1);
		  divCon.appendChild(divquse2);
		  divCon.appendChild(divquse3);
		  divCon.appendChild(divFilterContent);
		  divCon.appendChild(divFilterSearch);
		  //divCon.appendChild(input1);
		  divCon.appendChild(input);
		
		  
		  //divCon.appendChild(divAddFilter);
		  document.getElementById('allFilterDiv').appendChild(divCon);
		  
		  input.setAttribute("type", "hidden");
		  //input1.setAttribute("type", "hidden");
		  document.getElementById('filter_textbox'+insertFil).setAttribute ('onkeyup','autoComplete(this.id)');
		  document.getElementById('filter_options_div'+insertFil).setAttribute('style','display:none;');
		  document.getElementById('filterAnchor'+insertFil).setAttribute ('onclick','removeFilter.call(this)');
		  document.getElementById('filterAnchor'+insertFil).setAttribute ('style','display:none;');
		  document.getElementById('filter_textbox'+insertFil).setAttribute('style','border:none;width:40px;height:22px;padding-left:5px;');
		  
		  insertFil++;
		}
		</script>
<div id="main-wrapper" style="padding-top:100px;">

<?php
	if (isset($_GET['msg'])=='alexist')
	{	
		$msg='This category already exist. Please use a different name.';
		echo '<div class="white-wrapper-error" style="margin-left:20%;width:554px">'.$msg.'</div>';
	}
	else if (isset($_GET['msg1'])=='servererr')
	{	
		$msg='There was some problem with server. Please try again';
		echo '<div class="white-wrapper-error" style="margin-left:20%;width:554px">'.$msg.'</div>';
	}
?>					
<div class="white-wrapper">
<?php /*$get=getAllFilterOption(); 
echo "<pre>";
 print_r($get);*/?>
	<div style="padding:15px;float:left;">
		<div class="red-color-heading">Create a <span class="black-color-heading">Category</span></div>
		
			<div id="left-panelform">
			<form name="form1" id="form1" action="main.php" method="post" enctype="multipart/form-data" onsubmit="return validateCategory();">	
			<!--<div id="rightMain" style="float:right;width:430px;height:auto;border:1px solid #000;padding:5px;box-shadow:2px 2px 4px #444;-moz-box-shadow:2px 2px 4px #444;-webkit-box-shadow:2px 2px 4px #444;min-height:342px;">
			
			<div class="blog1" style="display:block;">
			    <div class="qus"><span>What filter would you like to apply for this category:</span><img src="images/qus.png" /></div>
			    <input type="text" name="searchfilter" id="searchfilter" class="drop_down" value="-- Please Select --" 
			    onfocus='if(this.value=="-- Please Select --") { this.value="";}' onblur='if(this.value=="") { this.value="-- Please Select --";}' style="margin-top:36px;" >
			    <img src="images/select_arrow.png" style="position:relative;z-index:10; top:74px; right:134px;" onclick="autoCompleteList();">
		            <div class="lable_outer" style="margin-right: 40px;display:none;" id="filter_srdiv" ></div>
			    <input type="hidden"  name="hidT[]">
		       </div>
			
			<div id="allFilterDiv">
				
			
			</div>
			
			<div class="add_filter"><a href="javascript:void(0);" onclick="autoCompleteList();insertFilter();">Add Another Filter</a></div>
			
			
			
			
			
			</div>-->
			<!--	<div style="width:410px; float:left; margin:0px 10px; padding-bottom:10px; border-bottom:2px solid #000;">
					Category Filters
				</div>
				<div class="formpanel-text-rightCategory form-text" style="margin-left:10px;margin-top:15px;min-height:34px;width:350px">What filter would you like to apply for this category</div>
					<select name="store_filters" id="store_filters" class="input" style="width:200px;clear:both;float:left;margin-left:10px;" >
						<option value="">-- Please Select --</option>
						<option value="Regional" >Regional</option>
						<option value="Global" >Global</option>
					</select>
				<div class="formpanel-text-rightCategory form-text" style="margin-left:10px;margin-top:15px;min-height:34px;width:100%;"><a href="javascript:void(0);" style="color:#515252;text-decoration:none;float:left;" onclick="create_filter();">Add another filter</a></div>
				<div id="filter_div" class="inputpanel-rightCategory" style="width:415px;"></div>
			-->	
			
			<?php
			if(!isset($_GET['msgerror']) && $_GET['msgerror']!='formerr')
			{
				unset($_SESSION['catnameval']);
			}
			?>

			
		<div style="float:left;width:460px;">
			<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
			<div style="float:left;height:50px;">
				<div class="formpanel-text form-text">Category Name: </div>
				<div class="inputpanel-rightCategory"><input name="catname" id="catname" type="text" class="input" style="width:263px;" value="<?php if(isset($_SESSION['catnameval'])) {echo $_SESSION['catnameval'];}?>"/></div>
				<div class="error" id="form1_catname_errorloc" style="visibility:visible;">
				<?php
				if(isset($_GET['msgerror']) && $_GET['msgerror']=='formerr')
				{
					if(isset($_SESSION['catnameerr']))
					{
						echo $_SESSION['catnameerr'];
					}
					unset($_SESSION['catnameerr']);
					
				}
				unset($_SESSION['catnameval']);
				?>
				</div>
			</div>
			<div class="clear"></div>
			
			
			
			<div style="float:left;height:60px;height:auto;">
				<div class="formpanel-text form-text">Category Image :<br/>
				(1000px X 400px)</div>
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

				
					</div>
				</div>
				<div class="error" id="form1_catimage_errorloc" style="visibility:hidden;">Please enter valid Password</div>
			</div>
			<div class="clear"></div>	
						<div style="float:left;height:50px;">
				<div class="formpanel-text form-text">Is your category:</div>
				<div class="inputpanel-rightCategory">
					<select name="cat_referance"  class="drop_down" style="width:200px;" id="cat_referance"  onchange = "remove_more();selectChanged(this.value);">
						<option value="">-- Please Select --</option>
						<option value="Regional" >Regional</option>
						<option value="Global" >Global</option>
					</select>
				</div>
			</div>
			<div class="clear"></div>
			
			
			
			<div id="filter_neigh" style="display:none">
				<div class="formpanel-text form-text" style="min-height: 21px;">Filter Name:</div>
				<div class="inputpanel-rightCategory"><input name="neighbour" id="neighbour" type="text" class="input" style="width:200px;margin-bottom:5px;" value="Neighbour" readonly="true"/></div>
			</div>
			<div class="clear"></div>
			

			<div class="clear"></div>

			<div id="filter_div" class="inputpanel-rightCategory"></div>
			<div class="clear"></div>
					
			
			<?php
			if(!isset($_GET['msgerror']) && $_GET['msgerror']!='formerr')
			{
				unset($_SESSION['catruleval']);
			}
			?>

			<div id="right-panelform"><div class="formpanel-text-rightCategory form-text">Category Rules:</div>
			<div class="inputpanel-rightCategory2"> <textarea name="catrules" id="catrules" rows="8" class="textarea" style="width:270px;"><?php if(isset($_SESSION['catruleval'])) {echo $_SESSION['catruleval'];}?></textarea> 
			<div class="error" id="form1_catrules_errorloc" style="visibility:visible;">
			<?php
				if(isset($_GET['msgerror']) && $_GET['msgerror']=='formerr')
				{
					if(isset($_SESSION['catruleserr']))
					{
						echo $_SESSION['catruleserr'];
					}
					unset($_SESSION['catruleserr']);
				}
				unset($_SESSION['catruleval']);
				?>
			</div>
			</div>

			<div id="right-panelform"><div class="formpanel-text-rightCategory form-text"> Category Descripition:</div>
			<?php
			if(!isset($_GET['msgerror']) && $_GET['msgerror']!='formerr')
			{
				unset($_SESSION['catdesval']);
			}
			?>
			<div class="inputpanel-rightCategory2"> <textarea name="catdes" id="catdes" rows="8" class="textarea" style="width:270px;" ><?php if(isset($_SESSION['catdesval'])) {echo $_SESSION['catdesval'];}?></textarea> 
			<div class="error" id="form1_catdes_errorloc" style="visibility:visible;">
			<?php
				if(isset($_GET['msgerror']) && $_GET['msgerror']=='formerr')
				{
					if(isset($_SESSION['catdeserr']))
					{
						echo $_SESSION['catdeserr'];
					}
					unset($_SESSION['catdeserr']);
					
				}
				
				?>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class="clear"></div>
			<div><img src="images/line-flip.png" alt="#" /></div>
			<div class="clear"></div>
			</div>
			
			
			<div align="center" style="width:100%;float:left;"><span style="margin-bottom:20px;">
			<input name="create_cat" type="submit" class="submit-buttons-round" value="Submit" />
			&nbsp;
			<input name="Clear" type="reset" class="clear-button" value="Clear" />
			</span></div>
			
			
			</form>

</div>

<iframe id="frmiframe" frameborder="0" width="0" height="0" src="image_crop/uploadfile.php" name="frmiframe" scrolling="no"></iframe>
<div class="popup_bg" id="bgMain" style="display:none;"></div>
<div id="popup_cover_corp" class="popup" style="display: none; width: 1024px; height:auto; margin: 0px auto; position: absolute; top: 50px; z-index: 99999; left:180px;">
	<div class="popup-header">
	<div class="formpanel-text-rightCategory form-text" style="float:left;margin-top: 10px;width: 350px; font-family: 'CalibriRegular';margin-left:350px;font-size: 30px;">Category Image Selection</div>
		<a class="close pull-right" style="float:right;" onclick="close_popup_cover_corp();"> </a>
	</div>
	<div id="crop_core_body" class="bodycontent" style="min-height:350px;">
		<iframe id="editCoverPicturebodyfrm" frameborder="0" name="editCoverPicturebodyfrm" style="  height: 500px;     margin-left: -9px;     width: 1101px;overflow:hidden;"></iframe>
	</div>
</div>
</div>
</div>

<script language="javascript" type="text/javascript">

function close_popup_cover_corp()
{ 
	document.getElementById('bgMain').style.display='none';
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
function closeMain()
{
	document.form1.action='main.php';
	document.form1.target='';	
	document.form1.submit();
}
var oldfile;
function show_other_image2(name)
{
	
	var bigimg = name.slice(0,6);
	//alert(bigimg);
	if(bigimg =='newnew')
	{
		bigimg = name.substring(3);
	}
	else
	{
		var bigimg = name.split('newold');
		bigimg = bigimg[1];
		bigimg = bigimg;
	}	
	
	
	//alert(bigimg);
	document.getElementById('PhotoPrevs').innerHTML = '<img src="review_images/'+bigimg+'" width="135" height="60">';
	document.getElementById('PhotoPrevs1').innerHTML = '<img src="review_images/thumb_'+name+'" width="120" height="60">';
	document.getElementById('p250_image').value=name;
	//document.getElementById('b990_image').value=n;
	document.form1.action='main.php';
	document.form1.target='';
}


function autoCompleteList()
{
	
	var autoval=$('#form1').serialize();
	var autoval_url="get_filters.php";
	$('#filter_srdiv').toggle();
	//alert(autoval  +   autoval_url);return false;
	if(autoval!="")
	{
		 $.ajax({
			type:"POST",
			url: autoval_url,
			data:autoval,
			dataType:'html',
			success:function(response)
			{
				if(response!="")
				{
					if(document.getElementById('filter_srdiv').style.display=='block')
					{
						//setTimeout('document.getElementById(\'filter_srdiv\').style.display=\'none\'',9000);
					}
					//alert(document.getElementById('filter_content').innerHTML);
					$('#filter_srdiv').html('<span>'+response+'</span>');
				}
			},
			error:function (response)
			{
				alert('error');
			}
		});	
	}	
}



function autoComplete(idd)
{
	//alert(" ID IS "+currentId);return false;
	//alert(" ID IS "+idd);return false;
	var getId=idd.match(/\d+/);
	var newId='#'+idd;
	//alert(newId);
	var filId='filter_content'+getId;
	//var txtBoxValue=document.getElementById('filter_textbox'+getId).value;
	//alert(autoval  +   autoval_url);
	//alert(newId);return false;
	var autoval=$('#form1').serialize();
	var autoval_url="get_alloptions.php?get_all_option=1&current_id="+getId;
	//alert(autoval  +   autoval_url);return false;
	if(autoval!="")
	{
		 $.ajax({
			type:"POST",
			url: autoval_url,
			data:autoval,
			dataType:'html',
			success:function(response)
			{
				//alert(response);return false;
				if(response=="")
				{
				   $('#filter_options_div'+getId).css('display','none');
				}
				else{
				   $('#filter_options_div'+getId).css('display','block');
				}
				$('#filter_options_div'+getId).html(response);
			},
			error:function (response)
			{
				alert('error');
			}
		});	
	  }
	  
	  
	$('.appendIt').keypress(function(e) {
	setTimeout(function(){
	var txtBox=document.getElementById('filter_textbox'+getId).value;
	var newTextVal=txtBox.replace(",","");
	if(newTextVal=="")
	{
		
	}
	else
	{
		if(e.which == 44) 
		{
			//alert('FILTER ID '+filId);
			//alert('TEXT VALUE ID '+txtBoxValue);return false;
			appendFilter(filId,newTextVal);
		}
	}
	 }, 800);
	
	});
}

function getFilterOptions(val)
{
	//alert('sadsadsadsda');
	var getCur=insertFil-1;
	var arrId=getCur-1;
	//alert(typeof(arrId));
	document.getElementById('filter_srdiv').style.display='none';
	document.getElementById('searchfilter').value=val;
	document.getElementById('filterAnchor'+getCur).innerHTML=val;
	document.getElementById('filterAnchor'+getCur).style.display='block';
	//var txtBoxFilterHidden='txtval_filterhidden'+getCur+'[]';
	//alert(txtBoxFilterHidden);
	document.getElementsByName('hidT[]')[arrId].value+=val+',';
	//document.getElementById('filter_main').style.display='block';
	//$('#filter_content').find('span').remove();
	/*var ofsetText=document.getElementById('filter_textbox').offsetLeft;
	var divEle=document.getElementById('filter_options_div').offsetLeft
	var getPer=Math.round(30/100*ofsetText);
	alert(ofsetText);
	alert(divEle);
	$('#filter_content').find('span').each(function() {
					       
		alert($(this).text());			       
	});
	*/
	
}
var appCnt=0;
function addFilterOption(val,currentId)
{
	//alert("ID IS "+currentId.id);
	var idNew=currentId.id;
	var getId=idNew.match(/\d+/);
	var getCur=insertFil-1;
	var filterContent=document.getElementById('filter_content'+getId);
	//alert(filterContent);
	//alert(fillid);
	document.getElementById('filter_options_div'+getId).style.display='none';
	$('#filter_content'+getId).append('<span class="tag" style="cursor:pointer;" onclick="removeFilterOption.call(this);">'+val+'</span>');
	document.getElementById('filter_textbox'+getId).value='';
	//alert('HIIIIII SUZUKKA');
	var txtBoxHidden='txtval_hidden'+getId+'[]';
	hiddenVal1=document.getElementsByName(txtBoxHidden).value;
	var hiddenVal='';
	$('#filter_content'+getId).find('span').each(function() {
		//var cnt=0;
		hiddenVal+=$(this).text()+',';
		//appCnt++;
		//document.getElementsByName(txtBoxHidden)[cnt].value=$(this).text();
		//cnt++;
		//document.getElementsByName(txtBoxHidden).value=hiddenVal;
		
	});
	 document.getElementsByName(txtBoxHidden)[0].value=hiddenVal;
	//alert(appCnt);

	//newVal=hiddenVal.substring(0,hiddenVal.length-1);
	/*var nn=hiddenVal.split(",");
	alert(nn);
	alert(nn.length);
	if(nn.length==2)
	{
	  //var valhid=nn.length-1;
	  document.getElementsByName(txtBoxHidden)[0].value=nn;
	}
	else if(nn.length>2)
	{
		var ctt=1;
	   for(i=1;i<=nn.length-1;i++)
	   {
		alert(document.getElementsByName(txtBoxHidden));
	       var valnew=document.getElementsByName(txtBoxHidden)[ctt].value=nn;
	       ctt++;
	   }
	}
	//alert('VALUE IS '+newVal);
	//hiddenVal1=hiddenVal;
        //alert('VALUE OF HIDDEN BOX IS '+hiddenVal1);
	//document.getElementById(txtBoxHidden).value=hiddenVal;
        //txtval_hidden1
	//filterContent.removeChild(filterContent.childNodes[3]);
	*/
}
function appendFilter(filterContentId,txtBoxVal)
{
   //alert(txtBoxVal);
   var filterContent=document.getElementById(filterContentId);
   filterContent.innerHTML+='<span class="tag" style="cursor:pointer;" onclick="removeFilterOption.call(this);">'+txtBoxVal+'</span>';
  // alert(filterContent.innerHTML);
}
function removeFilterOption()
{
	//var idRemove=$(this).attr('id');
	//alert($(this));return false;
	$(this).remove();
	//var filterContent=document.getElementById('filter_content');
	//filterContent.removeChild(filterContent.childNodes[3]);
}

function removeFilter()
{
	//var idRemove=$(this).attr('id');
	//alert($(this));return false;
	//$(this).remove();
	$(this).parent().parent().remove();
	insertFil--;
	alert(insertFil);
	//var filterContent=document.getElementById('filter_content');
	//filterContent.removeChild(filterContent.childNodes[3]);
}



function closeDiv()
{
	//alert(document.getElementById('filter_textbox').value);
	if(document.getElementById('filter_textbox').value=="")
	{
		document.getElementById('filter_options_div').style.display='none';
	}
}
function validateCategory()
{

	if(document.getElementById("catname").value.trim()=="")
	{
		alert('Please enter Category name');
		document.getElementById("catname").focus();
		return false;
	}
	else if(document.getElementById("catrules").value.trim()=="")
	{
		alert('Please enter category rules');
		document.getElementById("catrules").focus();
		return false;
	}
	else if(document.getElementById("catdes").value.trim()=="")
	{
		alert('Please enter category description');
		document.getElementById("catdes").focus();
		return false;
	}
	else
	{
		close_popup_cover_corp();
		closeMain();
		//return true;
	}
	
}
</script>
<?php include("footer.php")?>

<!--<div id="catlist" style="display:none; border-bottom: 1px solid #E4E2E2;     border-left: 1px solid #E4E2E2;     border-right: 1px solid #E4E2E2;     float: left;     height:auto;     width: 248px;background-color:#fff;z-index:100;margin-top: 33px;     position: absolute;"></div>-->
