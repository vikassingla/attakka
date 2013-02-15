
<body>
<div id="main-wrapper">
<div align="center"><a href=""><img src="images/logo-big.png" alt="#" border="0" /></a></div>
<div class="white-wrapper">
<div style="padding:15px;">
<div class="red-color-heading">Edit <span class="black-color-heading">Sub category</span>
<div align="right"><a href="user/sub_category_list">Sub Category List</a></div>


</div>
<div class="clear"></div>
<div id="left-panelform">
<form method="post" method="post" enctype="multipart/form-data"> 
<span style="color:green"><?php if(isset($message)) { echo $message;  }?></span>

<input type="hidden" name="operation" value="create_sub_category">

<div class="formpanel-text form-text">category:</div>
<div class="inputpanel-rightCategory">

  <select    style="width:200px;" name="category_id">
  <option  value="">Please select category</option>
  <?php
  if(!empty($catgory_list))
  {
	  
	  foreach($catgory_list as $category_detail)
	  {
		  $select = "";
		  if($this->input->post('category_id')!="")
		  {
			  if( $category_detail['category_id']==$this->input->post('category_id')  )
			  {
				$select = 'selected="selected"';  
			  }
		  }else{
				
			 if( $category_detail['category_id']==$sub_catgory_data['category_id'])
			  {
				$select = 'selected="selected"';  
			  }
			  
				
		  }
		  
 	
		?>
  
 		 <option <?php echo $select;?> value="<?php echo $category_detail['category_id'];?>"><?php echo $category_detail['category_name'];?></option>
    
    <?php
	  }
	
	  }
	  
	
	?>
    
  </select>
  
 
  <br/>
  <span style="color:red"><?php if(isset($err['category_id'])) { echo $err['category_id'];  }?></span>

</div>
<div class="clear"></div>


<div class="formpanel-text form-text">Subcategory Name:</div>
<div class="inputpanel-right"><input value="<?php echo $sub_catgory_data['sub_category_name'];?>" type="text" class="input" name="sub_category_name" style="width:275px;" />

<span style="color:red"><?php if(isset($err['sub_category_name'])) { echo $err['sub_category_name'];  }?></span>


</div>
<div class="clear"></div>
<div class="formpanel-text form-text">Sub Category  Image:</div>
<div class="inputpanel-right"><input type="file" class="input" name="sub_category_image"/>


<?php 
 $image_path = "upload_image/".$sub_catgory_data['sub_category_image'];		
	if(file_exists($image_path))
	{?>
<a target="_blank" href="<?php echo $image_path;?>" >View</a>
	
	<?php 
	}
?>


<span style="color:red"><?php if(isset($err['sub_category_image'])) { echo $err['sub_category_image'];  }?></span>
</div>
<div class="clear"></div>


<div class="formpanel-text form-text">Is your category:</div>
<div class="inputpanel-rightCategory">
  <select   class="input" style="width:200px;" name="sub_category_type">
    <option value="1" <?php if($this->input->post('sub_category_type')==1) {?> selected="selected" <?php }else{ if($sub_catgory_data['sub_category_type']==1) { echo 'selected="selected"'; } } ?>>Regional</option>
     <option value="2" <?php if($this->input->post('sub_category_type')==2) {?> selected="selected" <?php }else{ if($sub_catgory_data['sub_category_type']==2) { echo 'selected="selected"'; } } ?>>Globla</option>
  </select>
</div>
<div class="clear"></div>






<div class="form-text" style="float:left;">Do you want to aply for Moderator (MOD)?   </div><yes-button-form-new" style="margin-left:40px;"><input type="radio"  <?php if($this->input->post('apply_moderator')==1) {?>  checked="checked" <?php } else{ if($sub_catgory_data['apply_moderator']==1) { echo 'checked="checked"'; } } ?> value="1" name="apply_moderator">Yes 
<input type="radio" name="apply_moderator" value="0" <?php if(isset($_POST['apply_moderator']) and $_POST['apply_moderator']==0) {?>  checked="checked" <?php }else{ if($sub_catgory_data['apply_moderator']==0) { echo 'checked="checked"'; } } ?>>No
<div class="clear"></div>

</div>


<div id="right-panelform"><div class="formpanel-text-right form-text">Description:</div>
  <div class="inputpanel-right2"> <textarea name="sub_category_description" rows="3" class="textarea" style="width:270px;"><?php echo $sub_catgory_data['sub_category_description'];?></textarea> 
  
  <span style="color:red"><?php if(isset($err['sub_category_description'])) { echo $err['sub_category_description'];  }?></span>

  
  </div>
  <div class="clear"></div>
  <div id="right-panelform"><div class="formpanel-text-right form-text">Rules:</div>
  <div class="inputpanel-right2"> <textarea name="sub_category_rules" rows="1" class="textarea" style="width:270px;"><?php echo $sub_catgory_data['sub_category_rules'];?></textarea>  
  
<span style="color:red">
	<?php if(isset($err['sub_category_rules'])) { echo $err['sub_category_rules'];  }?>
</span> 

  </div>
</div>





</div>
<div class="clear"></div>

<div><img src="images/line-flip.png" alt="#" /></div>
<div class="clear"></div>
<div align="center"><span style="margin-bottom:20px;">
<input name="Submit" type="submit" class="submit-buttons-round" value="Submit" />
&nbsp;
<input name="Clear" type="reset" class="clear-button" value="Clear" />
</span></div>
</form>

</div></div>
<div class="clear"></div>