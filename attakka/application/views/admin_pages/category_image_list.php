
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
				<a href="category/add_category">Add Category</a>
            </div>    
            <br/>
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Category Image List </h2>
                        
						
					</div>
					<!-- End Box Head -->
                    
                    
                   <?php $this->load->view('admin_pages/upload_category_image');?>

					<!-- Table -->
					<div class="table">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
                            	<th>S.no</th>									
								<th>Category Image</th>	
                                <th>View full size image</th>							
								<th width="110" class="ac">Operation</th>
							</tr>
                            
                            <?php
							//pr($site_data);
							if(!empty($site_data))
							{
								
								foreach($site_data as $site_data_detail)
								{
							
							?>
                            
							<tr>	
                                <td><?php echo ++$offset;?></td>							
								<td>
                                <img height="142"  width="233" src="uploads/<?php echo $site_data_detail['category_image_name'];?>" />
                                </td>
                                <td>
                                
                                <a href="uploads/<?php echo $site_data_detail['category_image_name'];?>" target="_blank" >View</a>
                                
                                </td>
                                
                                
								<td>
                                
                               
                                
                                
                                <?php 
								if($site_data_detail['category_image_status']==0)
								{
								?>	
                                <a href="category/active_inactive_category_image/<?php echo $site_data_detail['category_image_id'];?>/1/<?php echo $this->uri->segment(3);?>"title="Active">Active</a>
                                <?php
								}
								
								if($site_data_detail['category_image_status']==1)
								{
								?>
                                <a href="category/active_inactive_category_image/<?php echo $site_data_detail['category_image_id'];?>/0/<?php echo $this->uri->segment(3);?>" >Inactive</a>
                                <?php
								}?>
                                
                                	
                                </td>
							</tr>
                            
                            <?php
							
								}
							
								}							?>
                            
                            
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
									echo $site_data_pagination;
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