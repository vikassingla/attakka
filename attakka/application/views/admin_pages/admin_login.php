
<!-- Container -->
<div id="container" >
	<div class="shell">		
	
        
				<?Php 
				if(!empty($error) and $error!=""){
				display_error($error,"Error:");
      			  }
				?>	
		<?Php 
        if(isset($message) and $message!=""){
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
						<h2>Admin Login Panel</h2>
					</div>
					<!-- End Box Head -->
					
					<form action="" method="post">
                    
                    <input type="hidden" name="operation"  value="login_admin">
						
						<!-- Form -->
						<div class="form">
								<p>
									
									<label>Email <span>(Required Field)</span></label>
									<input type="text" class="field size1" name="admin_email"  value="<?php echo $this->input->post('admin_email');?>"/>
								</p>	
                                
                                <p>
								
									<label>Password <span>(Required Field)</span></label>
									<input type="password" class="field size1" name="admin_password" value="<?php echo $this->input->post('admin_password');?>" />
								</p>	
							   
							<input type="submit" class="button" value="Login"  style="font-size:30px"/>
                           &nbsp;&nbsp;&nbsp;&nbsp;
                           <a href="admin/forget_password">Forget Password</a>
							
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