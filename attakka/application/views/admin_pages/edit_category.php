<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script> 
<script src="js/custom.js"></script>


<script type="text/javascript">
function validationdfd()
{

   var category_name = $('#category_name').val();	
	if(category_name=='')
	{
		alert('Please category name');	
		return false;

	}
	
	var dataString = 'category_name= '+ category_name  ;


	$.ajax({

		type: "POST",
		url: "category/ajax_check_category",
		data: dataString,
		success: function(t)
		{
			alert(t);
			//return false;
			if(t==1)
			{
				alert("category name already exits");
				return false;	
			}
			
			
			if(t==0)
			{
				return true;	
			}
			
			
		},
		error: function()
		  {
			// alert('failure');
		
		     return false;
		  }

		});	

	

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
						<h2>Edit Category</h2>
					</div>
					<!-- End Box Head -->
					
					<form action="" method="post" id="myForm" enctype="multipart/form-data">
                    
                    <input type="hidden" name="operation"  value="edit_category">
						
						<!-- Form -->
						<div class="form">
								<p>									
									<label>Category Name <span>(Required Field)</span></label>
									<input type="text" class="field size1" name="category_name" id="category_name"  value="<?php echo $category_data['category_name'];?>"/>
								</p>	
                                
                                
                                <p>
									
									<label>Category Description </label>
									<textarea class="field size1" rows="10" cols="30" name="category_description" id="category_description"><?php echo $category_data['category_description'];?></textarea>
								</p>
                                
                                                                 <p>
									
									<label>Category Rules </label>
									<textarea class="field size1" rows="10" cols="30" name="category_rules" id="category_rules"><?php echo $category_data['category_rules'];?></textarea>
								</p>

                                
                                
                                 <p>
									
									<label>Category Image </label>
									   <input type="file" id="category_image" class="input" name="category_image"/>
						<?php 


	 $image_path = "upload_image/".$category_data['category_image'];		
	if(file_exists($image_path))
	{?>
      <a target="_blank" href="<?php echo $image_path; ?>" >View</a>
                            
      <?php
	}
	  
	  ?>
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