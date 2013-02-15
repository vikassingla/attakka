<script type="text/javascript" >
	
	function show_message(str)
	{
		if(str==0)
		{
			alert("Please select message type!");
			return false;
		}
		
		var str_arr = str.split("**");		
		var user_id = str_arr[0];
		var messate_type = str_arr[1];
		
		
		if(messate_type==1)
		{
			var send_or_receive = 's';
		}
		
		if(messate_type==2)
		{
			var send_or_receive = 'r';
		}
		var url_str = 'admin/user_message_list/'+user_id+'/'+send_or_receive;
		var url = '<?php echo base_url(); ?>'+url_str;		
		//alert(url);
		window.location.href = url;
		return false;
		
	}

</script>


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
						<h2 class="left">User List </h2>
                        
						
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
                            	<th>S.no</th>									
								<th>Name</th>	
                                <th>Email</th>	
                                <th>Message</th>	
                                <th>View Detail</th>	 
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
								<td><h3><?php  echo $site_data_detail['user_first_name'];?></h3></td>
								
								<td> <h3><?php echo $site_data_detail['user_email'];?></h3> </td>
                               
                               	
								<td>
                              
                                <select id="message" onchange="return show_message(this.value);">
                                    <option  value="0"  >Please select</option>
                                    <option   value="<?php echo $site_data_detail['user_id'];?>**1" >Send Message</option>
                                    <option  value="<?php echo $site_data_detail['user_id'];?>**2" >Receive Message</option>                                    
                                </select>
                              </td>
                                
                                
                                                         
                                
                                
                        <td>    <a href="admin/view_user_deatil/<?php echo $site_data_detail['user_id'];?>"title="Active">View Detail</a>                     </td>
                                    
                                <td>
                                <?php 
								if($site_data_detail['user_status']==0)
								{
								?>	
                                <a href="admin/active_inactive_user/<?php echo $site_data_detail['user_id'];?>/1"title="Active">Active</a>
                                <?php
								}
								
								if($site_data_detail['user_status']==1)
								{
								?>
                                <a href="admin/active_inactive_user/<?php echo $site_data_detail['user_id'];?>/0" >Inactive</a>
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