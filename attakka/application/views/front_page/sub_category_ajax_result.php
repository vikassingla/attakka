
 <select   class="input" style="width:200px;" name="sub_category_id">
  <option  value="">Please select sub category</option>
  <?php
  if(!empty($sub_catgory_list))
  {
	  
	  foreach($sub_catgory_list as $sub_category_detail)
	  {
		  $select = "";
		  if($this->input->post('sub_category_id')!="")
		  {
			  if( $sub_category_detail['sub_category_id']==$this->input->post('sub_category_id')  )
			  {
				$select = 'selected="selected"';  
			  }
		  }
		  
 	
		?>
  
 		 <option <?php echo $select;?> value="<?php echo $sub_category_detail['sub_category_id'];?>"><?php echo $sub_category_detail['sub_category_name'];?></option>
    
    <?php
	  }
	
	  }
	?>
    
  </select>