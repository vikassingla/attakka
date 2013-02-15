
<!-- Container -->
<div id="container">
	<div class="shell">		
		<?php 
        if($this->session->flashdata('add')) {
			     $msg = $this->session->flashdata('add');
				 display_error($msg,"Notice:");
	         }
			 
			 $user_info = get_user_detail_by_user_id($review_detail['creator_id']);
			 
			 
			 ?>
		
		
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
						<h2 class="left">Review Detail </h2>
                        
						
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">				        
            <tr>	
            
            <td><h3><strong>Name</strong>:</h3></td>                                						
            <td><h3><?php echo ucfirst($user_info['user_first_name'])." ".ucfirst($user_info['user_last_name']);?></h3></td>
            
            </td>
            
            
            </tr>
            
          
            
            <tr>	
                <td><h3><strong>Email</strong>:</h3></td>                                						
                <td><h3><?php echo $user_info['user_email'];?></h3></td>
                </td>
            </tr>
            
             <tr>	
                <td><h3><strong>Topic</strong>:</h3></td>                                						
                <td><h3>
				<?php				
				// category_or_subcategory 
						
						if($review_detail['category_or_subcategory']==1)
						{ // get category name
							echo get_sub_category_name($review_detail['topic_id']);
							// echo get_category_name($site_data_detail['topic_id']);
						}
						
						if($review_detail['category_or_subcategory']==2)
						{ // get sub category name						
							echo get_sub_category_name($review_detail['topic_id']);
							//echo get_category_name($site_data_detail['topic_id']);
							
						}
				
				?></h3></td>
                </td>
            </tr>

		  <tr>	
                <td><h3><strong>Rate</strong>:</h3></td>                                						
                <td><h3>
				<?php				
				// category_or_subcategory 
						
						echo $review_detail['rate'];
				
				?></h3></td>
                </td>
            </tr>


			  <tr>	
                <td><h3><strong>Review Title:</strong>:</h3></td>                                						
                <td><h3>
				<?php				
				// category_or_subcategory 
						
						echo $review_detail['review_title'];
				
				?></h3></td>
                </td>
            </tr>
         
            
         
			  <tr>	
                <td><h3><strong>Review Description:</strong>:</h3></td>                                						
                <td><h3>
				<?php				
				// category_or_subcategory 
						
						echo $review_detail['review_description'];
				
				?></h3></td>
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