<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <!-- jQuery -->
    <script type="text/javascript" src="image_crop/jquery-1.6.2.js"></script>
    
    <!-- jQuery-Ui -->
    <link rel="stylesheet" type="text/css" href="image_crop/jquery-ui.css" />
    <script type="text/javascript" src="image_crop/jquery-ui.js"></script>
    
    <!-- SHJS - Syntax Highlighting for JavaScript -->
    <script type="text/javascript" src="image_crop/sh_main.min.js"></script>
    <script type="text/javascript">$(document).ready(function(){sh_highlightDocument();});</script>
    
    <!-- jrac - jQuery Resize And Crop -->
    <link rel="stylesheet" type="text/css" href="image_crop/style.jrac.css" />
    <script type="text/javascript" src="image_crop/jquery.jrac.js"></script>

    <!-- This page business -->
    <script type="text/javascript">
      <!--//--><![CDATA[//><!--
      $(document).ready(function(){
        // Apply jrac on some image.
        $('.pane img').jrac({
          'crop_width': 250,
          'crop_height': 214,
          'crop_x': 100,
          'crop_y': 100,
          'image_width': 1024,
          'viewport_onload': function() {
            var $viewport = this;
            var inputs = $viewport.$container.parent('.pane').find('.coords input:text');
            var events = ['jrac_crop_x','jrac_crop_y','jrac_crop_width','jrac_crop_height','jrac_image_width','jrac_image_height'];
            for (var i = 0; i < events.length; i++) {
              var event_name = events[i];
              // Register an event with an element.
              $viewport.observator.register(event_name, inputs.eq(i));
              // Attach a handler to that event for the element.
              inputs.eq(i).bind(event_name, function(event, $viewport, value) {
                $(this).val(value);
              })
              // Attach a handler for the built-in jQuery change event, handler
              // which read user input and apply it to relevent viewport object.
              .change(event_name, function(event) {
                var event_name = event.data;
                $viewport.$image.scale_proportion_locked = $viewport.$container.parent('.pane').find('.coords input:checkbox').is(':checked');
                $viewport.observator.set_property(event_name,$(this).val());
              });
            }
           /* $viewport.$container.append('<div>Image natual size: '
              +$viewport.$image.originalWidth+' x '
              +$viewport.$image.originalHeight+'</div>')*/
          }
        })
         
        // React on all viewport events.
        .bind('jrac_events', function(event, $viewport) {
          var inputs = $(this).parents('.pane').find('.coords input');
          inputs.css('background-color',($viewport.observator.crop_consistent())?'chartreuse':'salmon');
        });

		  
        
      });
      //--><!]]>
      
function close_popup_cover_corp1()
{ 

	
	parent.document.getElementById('tbox_overlay').style.display="none";
	parent.document.getElementById('popup_cover_corp').style.display="none";
	parent.document.getElementById('bigloaderimg_cover').style.display="none";
	parent.document.getElementById('editCoverBodyHolder').style.display="block";
	parent.document.getElementById('bigloaderimg_cover1').style.display="none";
	parent.document.getElementById('editCoverBodyHolder1').style.display="block";
	
	
	var  divUfc = parent.document.getElementById("crop_core_body");
	var  frm = parent.document.getElementById("editCoverPicturebodyfrm");
	
	divUfc.removeChild(frm);	
}
      
function setProfilePhoto()
{
	document.getElementById('profilefrm').submit();
}      
function show_options(name)
{
	parent.document.getElementById('popup_cover_corp').style.display="none";
	parent.show_other_image2(name);
}       
 
 </script>
<style>

.jrac_viewport {
  position: relative;
  overflow: hidden;
  border:1px solid #ccc;
  width:1024px;
  height:315px;
  background-image: url('images/viewport_background.gif');
}

/*///////////////////////////////////////// crop ///////////////////////////////////////////*/
.crop_img{
	width:860px;
	height:auto;
	float:left;
	overflow:hidden;
	margin-left:40px;
	margin-bottom:5px;
	}
.crop_zoom{
	float:left;
	margin-left:40px;
	margin-top:5px;
	}
.crop_zoom img{
	border:none;
	margin-right:10px;
	}
.crop_heading{
	width:890px;
	height:auto;
	
	font-size: 16px;
	font-family: Tahoma, Geneva, sans-serif;
	color:#FAB01F;
	font-weight:bold;
	margin-bottom:10px;
	}

.crop_detail{
	font-size: 12px;
	font-family: Tahoma, Geneva, sans-serif;
	color:#666666;
	width:450px;
	height:auto;
	float:left;
	clear:both;
	}
.crop_button{
	float:left;
	}
.crop_button a{
	color:#fff;
	font:12px Tahoma, Geneva, sans-serif;
	color:#fff;
	width:144px;
	height:15px;
	text-align:center;
	background:url(images/profile_photo1.png) no-repeat;
	padding:8px 0px;
	float:left;
	font-weight:bold;
	}


</style>
</head>
<body>

	<div style="margin-bottom:15px;" class="crop_heading">
	     Upload your banner picture
	</div>
    <div class="pane clearfix">
      <img  src="uploads/<?php print @$_GET['file'];?>" alt="Loulou form Sos Chats Geneva" />


	<iframe id="cropeimageiframe" frameborder="0" width="0" src="image_crop/uploadfile.php" height="0" src="image_crop/uploadfile.php" name="cropeimageiframe" ></iframe>

     <form name="profilefrm" id="profilefrm" target="cropeimageiframe" method="post" action="image_crop/uploadfile.php">
      <table class="coords" style="display:none;">
        <tr><td><input type="text" id="crop_x" name="crop_x" /></td></tr>
        <tr><td><input type="text" id="crop_y" name="crop_y"/></td></tr>
        <tr><td><input type="text" id="crop_width" name="crop_width"/></td></tr>
        <tr><td><input type="text" id="crop_height" name="crop_height"/></td></tr>
        <tr><td><input type="text" id="img_width" name="img_width" /></td></tr>
        <tr><td><input type="text" id="img_height" name="img_height"/></td></tr>
    
      </table>   
      
	  <input type="hidden" name="cropefile" id="cropefile" value="yes">    
	  <input type="hidden" name="small_image" id="small_image" value="yes">    
	  <input type="hidden" name="filename" id="filename" value="<?php print @$_GET['file']; ?>">    
          
     </form>
     
	<div style="float:left;width:920px;margin-top:10px;">
		<div  class="crop_detail">
			To crop this image, drag the region below and then click "Set as profile photo".
		</div>
		<div style="float:left;width:464px;">
		
			<div id="zoom_in" style="float:left;margin-left:5px;width:85px;height:85px;background:url(images/zoom_in.png);background-size:85px 85px;cursor:pointer;"></div>
			<div id="zoom_out" style="float:left;width:85px;height:85px;background:url(images/zoom_out.png);background-size:85px 85px;cursor:pointer;"></div>
		
			<div id="cancel" style="float:right;width:73px;height:33px;background:url(images/cancel.png);background-size:73px 33px;cursor:pointer;" onclick="close_popup_cover_corp1();"></div>
			<div class="crop_button" style="float:right;"><a href="#" style="text-decoration:none;" onclick="setProfilePhoto();">Crop</a></div>
		
		</div>
	</div>
    
    
    
     
     
    </div>
  </body>
</html>
