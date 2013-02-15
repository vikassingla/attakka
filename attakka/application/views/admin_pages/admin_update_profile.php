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
        
        <?php 
if($this->session->flashdata('add')) {
			     $msg = $this->session->flashdata('add');
			   display_error($msg,"Notice:");
				 
	         }?>

        
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
            

	<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2>Admin Profile Update</h2>
					</div>
					<!-- End Box Head -->
					
					<form action="" method="post" >
                    
                    <input type="hidden" name="operation"  value="admin_update_profile">
						
						<!-- Form -->
						<div class="form">
								<p>									
									<label>First Name <span>(Required Field)</span></label>
									<input type="text" class="field size1" name="admin_first_name" id="admin_first_name"  value="<?php echo $admin_data['admin_first_name'];?>"/>
								</p>	
                                
                                
                                <p>									
									<label>Last Name <span>(Required Field)</span></label>
									<input type="text" class="field size1" name="admin_last_name" id="admin_last_name"  value="<?php echo $admin_data['admin_last_name'];?>"/>
								</p>
                                
                                 <p>									
									<label>Mobile number <span>(Required Field)</span></label>
									<input type="text" class="field size1" name="admin_mobile_no" id="admin_mobile_no"  value="<?php echo $admin_data['admin_mobile_no'];?>"/>
								</p>
                                
                                 <p>									
									<label>Email <span>(Required Field)</span></label>
									<input type="text" class="field size1" name="admin_email" id="admin_email"  value="<?php echo $admin_data['admin_email'];?>"/>
								</p>	
                                
                                
                                 <p>									
									<label>Password <span></span></label>
									<input type="password" class="field size1" name="admin_password" id="admin_password"  value=""/>
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