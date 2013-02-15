
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
				<a href="banner/add_banner">Add Banner</a>
            </div>    
            <br/>
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Banner List </h2>
                        
						
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
                            	<th>S.no</th>									
								<th>Banner Title</th>
                                <th>View</th>
                                
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
								<td><h3><?php echo $site_data_detail['banner_title'];?></h3></td>
                                
                               
								<td>    
                                
                                
                                
                                       
                                <a href="banner_image/<?php echo $site_data_detail['banner_image_name'];?>" target="_blank" >View</a>
                          
                                
                                
                                
                                
                                                        </td>
                                <td>
                                <?php 
								if($site_data_detail['banner_status']==0)
								{
								?>	
                                <a href="banner/active_inactive/<?php echo $site_data_detail['banner_id'];?>/1"title="Active">Active</a>
                                <?php
								}
								
								if($site_data_detail['banner_status']==1)
								{
								?>
                                <a href="banner/active_inactive/<?php echo $site_data_detail['banner_id'];?>/0" >Inactive</a>
                                <?php
								}?>
                                
                                
                                	<a href="banner/edit_banner/<?php echo $site_data_detail["banner_id"];?>" class="ico edit">Edit</a>
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