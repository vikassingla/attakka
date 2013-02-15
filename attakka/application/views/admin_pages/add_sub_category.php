<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script> 
<script src="js/custom.js"></script>
<script type="text/javascript">
function validationdfd()
{
    var category_id = $('#category_id').val();	
   var category_name = $('#sub_category_name').val();	
	
	if(category_id=='')
	{
		alert('Please select category ');	
		return false;
	}
	
	
	if(category_name=='')
	{
		alert('Please enter sub category name');	
		return false;
	}
}	
</script>
<!-- Container -->
<div id="container" >
	<div class="shell">		
        
    <?Php 
    if(!empty($error) and $error!="")
      {
         display_error($error,"Error:");
      }
    ?>	
    <?Php 
    if(isset($message) and $message!="")
    {
        display_error($message,"Notice:");
    }
    ?>	
            
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
            

	<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2>Add Sub Category</h2>
					</div>
					<!-- End Box Head -->
                    
					
					<form action="" method="post" id="myForm" enctype="multipart/form-data">                    <input type="hidden" name="operation"  value="add_category">
						<!-- Form -->
						<div class="form">
                        
                        
                        
                        <p class="inline-field">
									<label>Category</label>
									<select id="category_id" name="category_id" class="field size2" style=" width:auto;">
										<option value="">Please select</option>
                                        <?php 
										if(!empty($catgory_list))
										{
											
											foreach($catgory_list as $category_detail)
											{
										
										$select = '';
										
							if($this->input->post("category_id")==$category_detail['category_id'])
							{
								$select = 'selected="selected"';	
							}
										
										
										?>
                                        
 <option <?php echo $select;?>  value="<?php echo $category_detail['category_id'];?>"><?php echo $category_detail['category_name'];?></option>
                                        
                                        
                                        <?php
											}
											
										}
										?>
                                        
									</select>
									
								</p>
                                
                                
                        
                        
                            <p>									
                                <label>Sub Category Name <span>(Required Field)</span></label>
                                <input type="text" class="field size1" name="sub_category_name" id="sub_category_name"  value="<?php echo $this->input->post('sub_category_name');?>"/>
                            </p>	
                                
                                
                                <p>
									
									<label>Sub Category Description </label>
									<textarea class="field size1" rows="10" cols="30" name="sub_category_description" id="sub_category_description"></textarea>
								</p>
                          
                             <p>
									
                                    
                                                                  <p>
									
									<label>Category Rules </label>
									<textarea class="field size1" rows="10" cols="30" name="sub_category_rules" id="sub_category_rules"><?php echo $this->input->post('sub_category_rules');?></textarea>
								</p>

                                    
                                    
                                    
                                    
                                    
									<label>Sub Category Image </label>
									   <input type="file" id="sub_category_image" class="input" name="sub_category_image"/>
								</p>
                                    
                        
                                      
							   
							<input onclick="return validation();" type="submit" class="button" value="Submit"  style="font-size:30px"/>
                           
							
						</div>
						<!-- End Form -->
						
						<!-- Form Buttons -->
						<div class="buttons" align="center">
							
						</div>
						<!-- End Form Buttons -->
					</form>
				</div>
				<!-- End Box -->

			</div>
			<!-- End Content -->
			
			<!-- Sidebar -->
			
			<!-- End Sidebar -->
			
			<div class="cl">&nbsp;</div>			
		</div>
		<!-- Main -->
	</div>
</div>
<!-- End Container -->