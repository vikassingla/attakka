<?php
 $condition = $this->uri->segment(4);
if($condition=='s')
{
	$to_from = "To";
	$m = "Send";	
}else if($condition=='r'){

	// $this->db->where("receiver_id",$user_id);
	$to_from = "From";
	$m = "Receive";	
	
}else{
	$to_from = "To";
	$m = "Send";	
}
		
?>

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
            
            
            <h2>	message list of  <?php echo $user_full_name ;?>  </h2><br/>
            
            
                         
                        <div align="right" style="font-size:16px">
<a href="admin/user_message_list/<?php echo $this->uri->segment(3);?>/s">Send Message List</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="admin/user_message_list/<?php echo $this->uri->segment(3);?>/r">Receive Message List</a>

</div>
           
            
              
            <br/>
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left"><?php echo $m; ?> Message List </h2>
                        
						
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
                            	<th>S.no</th>									
								<th><?php echo $to_from; ?>email</th>                       
                                <th>Subject</th>                                  
                                <th>Message</th>                                								
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
								<td><h3>
     <?php 
	if($to_from=="From")
	{
		$user_detail = $this->user_model->get_user_detail_by_user_id($site_data_detail['sender_id'],"tbl_user");
		echo $user_detail["user_email"];
	}else{
		echo $site_data_detail['to_email'];
	}
	?></h3></td>
                                
                                
                                
                               
                                <td><?php echo $site_data_detail['subject'];?>  </td>
                                <td>   <?php if($this->uri->segment(4)=='r'){?>
      
   		 <a href="admin/receive_message_detail/<?php echo $this->uri->segment(3);?>/<?php echo $site_data_detail['message_id']; ?>">Detail</a>   
      <?php }else{?>   
       <a href="admin/send_message_detail/<?php echo $this->uri->segment(3);?>/<?php echo $site_data_detail['message_id']; ?>">Detail</a>   
      <?php } ?> </td>
                               
                                
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