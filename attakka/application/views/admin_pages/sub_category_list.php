
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
				<a href="sub_category/add_category">Add Sub Category</a>
            </div>    
            <br/>
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Sub Category List </h2>               
						
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>	
                            	<th>S.no</th>								
								<th>Sub Category Name</th>
                                 <th>Created by</th>		
                                <th>Upload Image</th>							
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
								<td><h3><?php echo $site_data_detail['sub_category_name'];?></h3></td>
                                
                                 <td><h3><?php 
								
								if($site_data_detail['created_by']==1)
								{
									echo "Admin";
								}
								
								
								if($site_data_detail['created_by']==2)
								{
									//echo "Admin";
									
									// creator_id 
									
								$user_detail = $this->user_model->get_user_detail_by_user_id($site_data_detail['creator_id'],"tbl_user");
								
								
								
								
								echo ucfirst($user_detail['user_first_name'])." ".ucfirst($user_detail['user_last_name']);
								
								}
								
								?></h3></td>
                                
                                
                                
                                
                                
								
                                <td>       <a href="sub_category/category_image_list/<?php echo $site_data_detail["sub_category_id"];?>" class="ico edit">Upload</a>                         </td>
                                
                                
                                <td>
                                <?php 
								if($site_data_detail['sub_category_status']==0)
								{
								?>	
                                <a href="sub_category/active_inactive/<?php echo $site_data_detail['category_id'];?>/1"title="Active">Active</a>
                                <?php
								}
								
								if($site_data_detail['sub_category_status']==1)
								{
								?>
                                <a href="sub_category/active_inactive/<?php echo $site_data_detail['category_id'];?>/0" >Inactive</a>
                                <?php
								}?>
                                
                                
                                	<a href="sub_category/edit_category/<?php echo $site_data_detail["sub_category_id"];?>" class="ico edit">Edit</a>
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