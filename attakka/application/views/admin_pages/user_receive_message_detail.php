<!-- Container -->
<div id="container">
	<div class="shell">		
		<?php 
        if($this->session->flashdata('add')) {
			     $msg = $this->session->flashdata('add');
				 display_error($msg,"Notice:");
	         }
			 
			 ?>
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			<!-- Content -->
			<div id="content">
            <div  align="center">
			<h2>	<?php echo $user_full_name ;?> Receive message detail </h2><br/>
            </div>    
            <br/>
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Receive Message Detail </h2>
					</div>
					<!-- End Box Head -->	
					<!-- Table -->
					<div class="table">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">				        
            <tr>	
            <td><h3><strong>From email:</strong>:</h3></td>                                						
            <td><h3>
            <?php 
$user_detail = $this->user_model->get_user_detail_by_user_id($message_detail['sender_id'],"tbl_user");
echo $user_detail["user_email"];
?>
            </h3></td>
            </td>
            </tr>
            <tr>	
                <td><h3><strong>Subject:</strong>:</h3></td>                                						
                <td><h3><?php echo $message_detail['subject'];?></h3></td>
                </td>
            </tr>
             <tr>	
                <td><h3><strong>Message :</strong>:</h3></td>  
                <td><h3><?php echo $message_detail['message'];?></h3></td>                              						
            </tr>
            <tr>	
                <td><h3><strong> Send date time:   </strong>:</h3></td>  
                <td><h3><?php echo $message_detail['date_time'];?></h3></td>                              						
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