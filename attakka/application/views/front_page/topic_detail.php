<body>
<div id="main-wrapper">
<div align="center"><img src="images/logo-big.png" alt="#" /></div>
<div class="white-wrapper" >
<div style="padding:15px;">
<div class="red-color-heading">Detail of <span class="black-color-heading">Topic</span>
<div align="right"><a href="user/topic">Topic List</a></div>

</div>
<div class="clear"></div>
<span style="color:green"><?php if(isset($message)) { echo $message;  }?></span>
<div id="left-panelform" style="min-height:350px;">
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="operation" value="create_category_by_user">
<div class="formpanel-text form-text">category:</div>
<div class="inputpanel-rightCategory">
  <?php echo get_category_name($topic_data['category_id'])?>

 </span>
  <br/>
  <span style="color:red"><?php if(isset($err['category_id'])) { echo $err['category_id'];  }?></span>
  <span id="Loading" style="display:none;"><img src="images/loader.gif"></span>

</div>
<div class="clear"></div>




<div class="formpanel-text form-text">Sub category:</div>
<div class="inputpanel-rightCategory">
<span id="ajax_result">
  <?php echo get_sub_category_name($topic_data['sub_category_id'])?>
  </span>
  <br/>
  <span style="color:red"><?php if(isset($err['sub_category_id'])) { echo $err['sub_category_id'];  }?></span>

</div>
<div class="clear"></div>




<div class="formpanel-text form-text">Topic Title: </div>
<div class="inputpanel-rightCategory"><?php echo $topic_data['topic_title'];?>
<span style="color:red"><?php if(isset($err['topic_title'])) { echo $err['topic_title'];  }?></span>
</div>
<div class="clear"></div>



<div class="formpanel-text form-text">Topic Image Link: </div>
<div class="inputpanel-rightCategory"><?php echo $topic_data['topic_image_link'];?>

 <span style="color:red"><?php if(isset($err['topic_image_link'])) { echo $err['topic_image_link'];  }?></span> 
 
</div>
<div class="clear"></div>


<div class="formpanel-text form-text">Topic Video Link: </div>
<div class="inputpanel-rightCategory"><?php echo $topic_data['topic_video_link'];?>

 <span style="color:red"><?php if(isset($err['topic_video_link'])) { echo $err['topic_video_link'];  }?></span> 
 
</div>
<div class="clear"></div>

<div class="formpanel-text form-text">Topic Description: </div>
<div class="inputpanel-rightCategory"><?php echo $topic_data['topic_description'];?>

 <span style="color:red"><?php if(isset($err['topic_video_link'])) { echo $err['topic_video_link'];  }?></span> 
 
</div>
<div class="clear"></div>


  

<div><img src="images/line-flip.png" alt="#" /></div>
<div class="clear"></div>
<div align="center"><!--<span style="margin-bottom:20px;">
<input name="Submit" type="submit" class="submit-buttons-round" value="Submit" />
&nbsp;
<input name="Clear" type="reset" class="clear-button" value="Clear" />
</span>--></div>

</form>
</div></div>
<div class="clear"></div>
<script type="text/javascript" src="js/jquery-latest.js"></script>
<script type="text/javascript">
function sub_category(category_id)
{
	
	//alert(category_id);
	
	if(category_id=="")
	{
		alert("Please select category");
		return false;
	}
	var name = "sanjay";
	var dataString = "category_id="+category_id;
	
	$('#Loading').show();
	
	$.ajax({
			type: "POST",
			url: "user/ajax_sub_category_list",
			data: dataString,
			success: function(t){			
				//alert(t);	
				$('#Loading').hide();  
				document.getElementById("ajax_result").innerHTML= t;	
				//alert("success");
				return false;
				
			  },
			  error: function(){
				alert('failure');
			
				return false;
			  }
			});	
		
		
		
		return false;
	
	
	
	
	
}


</script>



			

