  
<?php include("header.php");?>
    <style>
    .black_overlay{
        display: none;
        position: fixed;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index:1001;
        -moz-opacity: 0.8;
        opacity:.80;
        overflow:auto;
        filter: alpha(opacity=80);
    }
    .white_content {
        display: none;
        position: fixed;
        top: 25%;
        left: 25%;
        width: 50%;
        height: 300px;
        padding: 16px;
        border: 10px solid #DD7356;
        background-color: white;
        z-index:1002;
        overflow: scroll;
        color: #727272;
		font-family: 'CalibriRegular';
		font-size: 16px;
		line-height: 23px;
    }
    #cross
    {
		display: none;
        position: fixed;
        top: 20%;
        left: 76%;
        z-index:1002;
        overflow: auto;
	}	
</style>
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
function showfulltext(id)
{
	{

//alert(scores);
//alert(date2);
//$("#dvLoading").show();
if(id!='')
{
$.ajax({
url: 'review_full.php?review_id='+id,
success: function(data) {
//alert(data);
$("#light").css("display","block");
$("#cross").css("display","block");
//$("#dvLoading").hide();
$("#fade").css("display","block");
$('#light').html(data);
}

});
}
}
			
}	
function showfullopinion(id)
{
	{

//alert(scores);
//alert(date2);
//$("#dvLoading").show();
if(id!='')
{
$.ajax({
url: 'review_opin_full.php?review_id='+id,
success: function(data) {
//alert(data);
$("#light").css("display","block");
$("#cross").css("display","block");
//$("#dvLoading").hide();
$("#fade").css("display","block");
$('#light').html(data);
}

});
}
}
			
}	
function cross()
{
//alert(data);
$("#light").css("display","none");
$("#cross").css("display","none");
$("#fade").css("display","none");		
}	
</script>
<?php 
if(empty($_GET))
{
	print '
	<script>
	window.location.href="all_category.php";
	</script>
	';
}	
else
{
	$rev_id=$_GET['review_id'];
	$exist=checkReviewId($rev_id);	
	if($exist=="0")
	{
		print '
		<script>
		window.location.href="all_category.php";
		</script>
		';
	}
	else
	{
	$detail=reviewDetail($rev_id);		//
	if($detail['review_img']!="" && file_exists('review_images/'.$detail['review_img']))
	{
		$ban_img='review_images/'.$detail['review_img'];
		$display='style="background-color:black; color:#fff; font:14px arial; padding:5px 10px; border-radius:10px;margin-top:3px;display:none;"';
	}	
	else
	{
		//$ban_img='images/norevimage.jpg';
		$ban_img='images/red-blank1.jpeg';
		 $display='style="background-color:black; color:#fff; font:14px arial; padding:5px 10px; border-radius:10px;margin-top:3px;display:block;"';
	}	
	$rate=rate($rev_id);
	}	
	
}	
$user=$detail['review_created_by'];
$owner=user_detail($user);
$thumb_w='';
$thumb_h='';

if($owner['facebook_id']=="")
{
	if($owner['profile_image']!='' && file_exists("uploads/".$owner['profile_image']))
	{
		$src3="uploads/".$owner['profile_image'];
		$src3width=190;
	}
	else
	{
		$src3="images/no_img.png";
		$src3width=190;
	}		
}
else
{
	if($owner['profile_image']!='' && file_exists("uploads/".$owner['profile_image']))
	{
		$src3="uploads/".$owner['profile_image'];
		$src3width=190;
	}
	else
	{
		//$src3="http://graph.facebook.com/".$row['facebook_id']."/picture?width=60&height=60";
		$src3="http://graph.facebook.com/".$owner['facebook_id']."/picture?width=200&height=130";
		
		list($width, $height, $type, $attr) = @getimagesize($src3);
		$src3width=($width-10);															   
		/*$newheight = 127;
		$newwidth = 219;        
													   
		if ($width>$newwidth || $height>$newheight)
		{
			   $thumb_w=$newwidth;
			   $thumb_h=$newheight;
			   
			   if ($thumb_w/$width*$height>$thumb_h) 
			   {
					   $thumb_w = round($thumb_h*$width/$height); 
			   }
			   else 
			   {
					   $thumb_h = round($thumb_w*$height/$width);
			   }
		} 
		else
		{
			   $thumb_w=$width;
			   $thumb_h=$height;
		}  		
		
		$thumb_w='width:'.$thumb_w.'px;';
		$thumb_h='height:'.$thumb_h.'px;';	*/	
	}	
}
$freview=firstopinion($rev_id, $owner['user_id']);
//echo '<pre>';
//print_r($freview);die;
if($freview)
{
	$frate=$freview['review_rate'];
	if($freview['review_rate']=="-0")
	{
		$frate=0;
	}	
	$frimg="images/rate/bigrate$frate.png";
}
else
{
	$frimg="images/rate/no-rate.png";
	$freview['review_opinion']="No Opinion by owner";
	$freview['review_description']="No description by owner";
}	
?>

<script type="text/javascript">
function giveReview()
{
	var autoval=$('#hidcatid').val();
	var review_id="<?php if(isset($_GET['review_id'])) { echo $_GET['review_id'];}?>";
	var autoval_url="give_review.php?cat_val="+autoval+"&review_id="+review_id;
	var txtVal=$('#catinput').val();
	$('#filter_srdiv').toggle();
	//alert(autoval  +   autoval_url);return false;
	if(autoval!="")
	{
		 $.ajax({
			type:"GET",
			url: autoval_url,
			data:autoval,
			dataType:'html',
			success:function(response)
			{
				//alert(response);
				if(response==0)
				{
					document.formcreaterev.submit(); 
				}
				else if(response>0)
				{
					alert('You have already reviewed '+txtVal);
				}
			},
			error:function (response)
			{
				alert('error');
			}
		});	
	}
}
</script>
		
<div class="internal-wrapper">

<div style="margin-top:100px;position:relative;">
	 <a onclick="giveReview();" style="float:left;cursor:pointer;position:absolute;top:5px;margin-left:10px;z-index:10"><img src="images/review-btrn.png" alt="" style="float:right;padding:5px 30px 0px 0px;" /></a>
  <div id="review_cover">
	          <img  src="<?php echo $ban_img?>" alt="" class="image-border" style="width:980px;height:260px;"/>
	          </div>
<div style="float:right;display:block" id="cover" >
			  
			  <div class="inputWrapper" style="margin-top:-270px;margin-right:35px;background:none;">
				<div <?php echo $display;?>>Upload</div>
					<input class="fileInput" onchange="upload_file();" type="file" multiple="multiple" name="file" >
				</div>
			   </div>
 <?php
 if($detail['review_img']=="" || !file_exists('review_images/'.$detail['review_img']))
 {
 ?>
 <h7 style="text-align:center;margin-top:-100px;color: #000000; position: absolute; top: 231px; z-index: 10;width:970px;background:none;font-family:Castellar;font-size:50px;text-decoration:underline;"><?php echo $detail['review_title']?></h7>
 <?php
  }
  else
  {
   ?>
  <h7 style="padding-left:10px; color: #FFFFFF; position: absolute; top: 231px; z-index: 10;width:970px;"><?php echo $detail['review_title']?></h7>
  <?php
   }
   ?>
 <div class="rate-icontop" align="right"><img src="<?php echo $rate?>" alt="" class="rate-shadow" /></div>
  </div>
  <div class="clear"></div>
  <div style="padding-bottom:10px; padding-top:20px;"><img src="images/fusion-banner.png" alt="" /></div>
  <div class="clear"></div>
  <div class="grey-round-bar heading-black topheading-CRITICA" align="center">
			  CRITICA MOR
  </div>
			   <div class="clear"></div>
			  
			  	<!--row 1-->
			 <div class="border-round">
             <form name ="formcreaterev" id="formcreaterev" action="create_review.php" method="post">
				<input type="hidden" name="hidcatid" id="hidcatid" value="<?php echo $detail['review_cat_id'];?>">
				<input type="hidden" name="catinput" id="catinput" value="<?php echo $detail['review_title'];?>">
             </form>
             <div class="views-field round-imgred13-2012" style="marlgin-bottom:10px; margin-left:10px;"><img src="<?php echo $src3?>"  alt="" style="width:200px;height:130px"/><div class="nametop-heading-box-review" style="margin-top: -24px;width: <?php echo $src3width?>px"><?php echo $owner['user_firstname']." ". substr($owner['user_lastname'],0,1)."."?> </div></div>
             
             <div class="message-box-back">
             <div style="padding:15px;">
               <div class="panel-left-new middle-text-review-new13-2012">
               <?php echo $freview['review_opinion']?>
               </div>
             <div class="rate-panel-right-new13-2012"><img src="<?php echo $frimg?>" alt="#" class="rate-img-new-new13-2012" style="margin-top:-7px" /></div>
             
             </div>
             
             </div>
             
             <div class="clear"></div>
             
             <div class="middle-text-review-small" style="padding:15px;">
              <?php if(strlen($freview['review_description'])>350)
              {
				  echo substr($freview['review_description'],0,350)."...<a href='javascript:void(0)' onclick='showfulltext(".$freview['review_map_id'].")'>Read More</a> ";
				}
				else
				{
					echo $freview['review_description'];
				}	
              ?>
              
             <!--<img src="images/arrow-down-grey.png" alt="#" style="margin-bottom:-5px;" />--></div>

			<div class="clear"></div>

			<div class="border-round-reviewnew"><div style="padding:5px;"><div class="button-right-new"><a href="#" class="comentar-btrn">comentar</a></div> 
			<div class="grey-panelnew13-2012"><img src="images/left-arrow-new.png" alt="#" />&nbsp;<img src="images/right-arrownew.png" alt="#" /></div>
			<div class="footer-panel-right13-2012"><img src="images/star-icon.png" alt="#" /> <img src="images/facebook-icon.png" alt="#" />  <img src="images/twitter-icon.png" alt="#" />  <img src="images/gplus-icon.png" alt="#" /></div>

			</div>
			</div>
             
			</div>
			<!--row 1-->
			
			
			<!--you-may-panel-->
    
    <div class="youmaypanelnov20"><h12>YOU MAY ALSO LIKE</h12></div>
    
    	<div class="clear"></div>
	<!--	
  <div style="margin-bottom:10px;"><iframe src="images-scroller-inside.html" allowtransparency="0" frameborder="0" height="115px" width="1045px"></iframe></div>
		 -->
		 <div class="clear"></div>
    
    <!--you-may-panel-->
    
    <!--buttons-top--> 
    <div class="grey-round-barnew19nov"><div style="padding:5px;width:1000px;"><a style="text-decoration:none;" class="black-button" href="#">HOT</a><a href="#" class="grey-buttonnov19">NEW</a> <a href="#" class="grey-buttonnov19" style="margin-right:86px;">Favorites</a> <a href="#" class="grey-buttonnov19">Positive 12</a> <a href="#" class="grey-buttonnov19">Negative 30</a> <a href="#" class="grey-buttonnov19" style="margin-right:80px;">Negative 60</a> <a href="#"  class="grey-buttonnov19" >reviews 25</a> <a href="#" class="black-button">opinions 112</a></div></div>
     <!--buttons-top--> 
     <?php 
     $rec=allRecOp($rev_id,$owner['user_id']);
     //echo '<pre>';
     //print_r($rec);die;
     if(count($rec)>0)
     {
    foreach($rec as $cmt)
    {
		$crate=$cmt['review_rate'];
		if($crate=="-0")
		{
			$crate=0;
		}	
		$cimg="images/rate/bigrate$crate.png";
		//echo $cmt['created_by'];
		$cuser=user_detail($cmt['created_by']);
		if($cuser['facebook_id']=="")
		{
			if($cuser['profile_image']!='')
			{
				$srcc="uploads/".$cuser['profile_image'];
				if(file_exists($srcc))
				{
					$srcc="uploads/".$cuser['profile_image'];
				}
				else
				{
					$srcc="images/no_img.png";
				}
			}
			else
			{
				$srcc="images/no_img.png";
			}		
		}
		else
		{
			if($cuser['profile_image']!='')
			{
				$srcc="uploads/".$cuser['profile_image'];
			}
			else
			{
				//$src3="http://graph.facebook.com/".$row['facebook_id']."/picture?width=60&height=60";
				$srcc="http://graph.facebook.com/".$cuser['facebook_id']."/picture?type=large";
				
				list($width, $height, $type, $attr) = @getimagesize($src3);
															   
				$newheight = 127;
				$newwidth = 219;        
															   
				if ($width>$newwidth || $height>$newheight)
				{
					   $thumb_w=$newwidth;
					   $thumb_h=$newheight;
					   
					   if ($thumb_w/$width*$height>$thumb_h) 
					   {
							   $thumb_w = round($thumb_h*$width/$height); 
					   }
					   else 
					   {
							   $thumb_h = round($thumb_w*$height/$width);
					   }
				} 
				else
				{
					   $thumb_w=$width;
					   $thumb_h=$height;
				}  		
				
				$thumb_w='width:'.$thumb_w.'px;';
				$thumb_h='height:'.$thumb_h.'px;';		
				}	
			}
			?>
			<div class="border-round">
             <div class="views-field round-imgred13-2012" style="marlgin-bottom:10px; margin-left:10px;"><img src="<?php echo $srcc?>"  alt="" style="width:219px;height:127px;"/><div class="nametop-heading-box-review"><?php echo $cuser['user_firstname']." ".substr($cuser['user_lastname'], 0, 1)."."?> </div></div>
             
             <div class="message-box-back">
             <div style="padding:15px;">
               <div class="panel-left-new middle-text-review-new13-2012">
               <?php echo $cmt['review_opinion']?>
               </div>
             <div class="rate-panel-right-new13-2012"><img src="<?php echo $cimg?>" alt="#" class="rate-img-new-new13-2012" style="margin-top:-7px" /></div>
             
             </div>
             
             </div>
             
             <div class="clear"></div>
             
             <div class="middle-text-review-small" style="padding:15px;">
             <?php if(strlen($cmt['review_description'])>350)
              {
				  echo substr($cmt['review_description'],0,350)."...<a href='javascript:void(0)' onclick='showfulltext(".$cmt['review_map_id'].")'>Read More</a> ";
				}
				else
				{
					echo $cmt['review_description'];
				}	
              ?>
             <!--<img src="images/arrow-down-grey.png" alt="#" style="margin-bottom:-5px;" />--></div>

			<div class="clear"></div>

			<div class="border-round-reviewnew"><div style="padding:5px;"><div class="button-right-new"><a href="#" class="comentar-btrn">comentar</a></div> 
			<div class="grey-panelnew13-2012"><img src="images/left-arrow-new.png" alt="#" />&nbsp;<img src="images/right-arrownew.png" alt="#" /></div>
			<div class="footer-panel-right13-2012"><img src="images/star-icon.png" alt="#" /> <img src="images/facebook-icon.png" alt="#" />  <img src="images/twitter-icon.png" alt="#" />  <img src="images/gplus-icon.png" alt="#" /></div>

			</div>
			</div>
             
			</div>
     <!--
     
     <div class="images-left-panel-review13-2012 views-field review-new"><img src="<?php //echo $srcc?>" style="width:219px;height:127px;" alt="#" /><div class="nametop-heading-box-review"><?php //echo $cuser['user_firstname']." ".substr($cuser['user_lastname'], 0, 1)."."?></div></div>
     
     <div class="message-box-back-big">
             <div style="padding:15px;">
               <div class="panel-left-new middle-text-review-new13-2012new"><?php //echo $cmt['review_opinion']?></div>
             <div class="rate-panel-right-new13-2012"><img src="<?php// echo $cimg?>" alt="#" class="rate-img-new-new13-2012new" /></div>
             
             </div>
             
             </div>
     -->
     <!--row2-->
     <div class="clear"></div>
    <?php
	}
	}
	else
	{
		echo "No review till";
	}	
    ?>
   
   </div>
   
 <?php include("footer.php")?>
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
<div id="light" class="white_content"> 

</div>
<div style="display:none" id="cross">
	<a href="javascript:void(0)" onclick="cross()"><img src="images/cross-icon.png"></a>
</div>
    <div id="fade" class="black_overlay"></div>
