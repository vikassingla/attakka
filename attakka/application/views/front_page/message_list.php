<div id="main-wrapper">
<div align="center"><img src="images/logo-big.png" alt="#" /></div>
<div class="white-wrapper">
<div style="padding:15px;">
<div class="red-color-heading-management">
<?php
 $condition = $this->uri->segment(3);
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


<?php echo $m;?> Message <span class="black-color-heading">List</span>


<div align="right" style="font-size:16px">
<a href="message/message_list/s">Send Message List</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="message/message_list/r">Receive Message List</a>

</div>


</div>


<div class="clear"></div>
<div align="center" style="color:green;" >

	<?php 
        if($this->session->flashdata('add')) {
			     $msg = $this->session->flashdata('add');
				 display_error($msg,"Notice:");
	         }?>
		
        
        
</div>

<!--box1 -->
<div class="top-heading-banner">

<div align="center">

<!--<a href="user/create_category">add category</a>--></div></div>
<div class="white-back">

<table>

<tr>
    <td width="587"><strong><?php echo $to_from; ?> email</strong></td>
    <td width="587"><strong>Subject</strong></td>
    <td width="221"><strong>Message</strong></td>
    
    <?php if($this->uri->segment(3)=='r'){?>
    <td width="221"><strong>Reply</strong></td>
    <?php } ?>
    
</tr>

<?php 



if(!empty($site_data))
{
	foreach($site_data as $detail)
	{
?>

<tr>
    <td width="587"><?php 
	if($to_from=="From")
	{
		$user_detail = $this->user_model->get_user_detail_by_user_id($detail['sender_id'],"tbl_user");
		echo $user_detail["user_email"];
	}else{
		echo $detail['to_email'];
	}
	?></td>
    <td width="587"><?php echo $detail['subject'];?></td>
    <td width="221">  
      
      <?php if($this->uri->segment(3)=='r'){?>
      
   		 <a href="message/receive_message_detail/<?php echo $detail['message_id']; ?>">Detail</a>   
      <?php }else{?>   
       <a href="message/send_message_detail/<?php echo $detail['message_id']; ?>">Detail</a>   
      <?php } ?>
         
    </td>
     <?php 
	 if($this->uri->segment(3)=='r'){
	?>
    <td width="221">   
     <a href="message/reply_message/<?php echo $detail['message_id']; ?>">Reply</a> 
   </td>
   <?php
	 }
   ?>
     
</tr>

<?php 
	}
}
?>

</table>
<div align="right" style="font-size:20px;">
<?php
  echo $site_data_pagination;
?>
</div>
<div class="clear"></div>
</div>

<!--box1 -->
<div class="clear"></div>
