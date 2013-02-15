
<!-- Container -->
<div id="container">
	<div class="shell">		
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
            
            <div  align="right">
				<!--<a href="category/add_category">Add Category</a>-->
            </div>    
            <br/>
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">User Detail </h2>
                        
						
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							                      
                        
            <tr>	
            
            <td><h3><strong>First name</strong>:</h3></td>                                						
            <td><h3><?php echo $user_detail['user_first_name']." ".$user_detail['user_last_name'];?></h3></td>
            
            </td>
            
            
            </tr>
            
            <tr>	
            
            <td><h3><strong>Last name</strong>:</h3></td>                                						
            <td><h3><?php echo $user_detail['user_last_name'];?></h3></td>
            
            </td>
            
            
            </tr>
            
            
            
            <tr>	
            
            <td><h3><strong>Email</strong>:</h3></td>                                						
            <td><h3><?php echo $user_detail['user_email'];?></h3></td>
            
            </td>
            
            
            </tr>
            
            
              
            <tr>	
            
            <td><h3><strong>Country</strong>:</h3></td>                                						
            <td><h3><?php echo $user_detail['user_country'];?></h3></td>
            
            </td>
            
            
            </tr>
            
             <tr>	
            
            <td><h3><strong>Region</strong>:</h3></td>                                						
            <td><h3><?php echo $user_detail['user_region'];?></h3></td>
            
            </td>
            
            
            </tr>
            
            
             <tr>	
            
            <td><h3><strong>Status</strong>:</h3></td>                                						
            <td><h3><?php if($user_detail['user_status']==1) { echo "Active"; }else{ echo "Inactive";}?></h3></td>
            
            </td>
            
            
            </tr>
            
            
                <tr>	
            
            <td><h3><strong>Registration date time</strong>:</h3></td>                                						
            <td><h3><?php echo $user_detail['user_created_date_time'];?></h3></td>
            
            </td>
            
            
            </tr>
                
                          
                            
                            
						</table>
						
						
						<!-- Pagging -->
						<div class="paggingwew" align="right" style="font-size:24px;">
							<!--<div class="left">Showing 1-12 of 44</div>
							<div class="right">
								<a href="#">Previous</a>
								<a href="#">1</a>
								<a href="#">2</a>
								<a href="#">3</a>
								<a href="#">4</a>
								<a href="#">245</a>
								<span>...</span>
								<a href="#">Next</a>
								<a href="#">View all</a>
							</div>-->
                            <?php
									
							?>
						</div>
						<!-- End Pagging -->
						
					</div>
					<!-- Table -->
                    
					
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