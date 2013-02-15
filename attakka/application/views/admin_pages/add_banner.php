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
						<h2>Add Banner</h2>
					</div>
					<!-- End Box Head -->
					<form action="" method="post" id="myForm" enctype="multipart/form-data">
                     <input type="hidden" name="operation"  value="add_category">
						<!-- Form -->
						<div class="form">
								<p>									
									<label>Banner Title <span>(Required Field)</span></label>
									<input type="text" class="field size1" name="banner_title" id="banner_title"  value="<?php echo $this->input->post('banner_title');?>"/>
								</p>	
                                
                                
                                <p>									
									<label>Banner Price <span>(Required Field)</span></label>
									<input   readonly="readonly" type="text" class="field size1" name="banner_price" id="banner_price"  value="10"/>
								</p>	
                                	<label>Banner Image <span>(Required Field)</span> </label>
									   <input type="file" id="banner_image_name" class="input" name="banner_image_name"/>
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