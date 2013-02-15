<div id="login-wrapper">
<div align="center"><img src="images/logo-big.png" alt="#" /></div>
<div class="white-wrapper">
<div style="padding:15px;">
<div class="red-color-heading">Receive  <span class="black-color-heading">Message Detail</span>
<span style="font-size:16px;"><a href="message/message_list/r">Back</a></span>


</div>
<div class="clear"></div>
<span style="color:green">
<?php if(isset($message)) { echo $message;  }?>
<?php 
if($this->session->flashdata('add')) {
  echo  $msg = $this->session->flashdata('add');
}?>
</span>
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="operation" value="registration">
<div  class="form-panel form-text">From email:</div>
<div class="input-panel">
<?php 
$user_detail = $this->user_model->get_user_detail_by_user_id($message_detail['sender_id'],"tbl_user");
echo $user_detail["user_email"];
?>
</div>
<div class="clear"></div>

<div  class="form-panel form-text">Subject:</div>
<div class="input-panel"><?php echo $message_detail['subject'];?>
</div>
<div class="clear"></div>

<div  class="form-panel form-text">Message :</div>
<div class="input-panel"><?php echo $message_detail['message'];?>
</div>
<div class="clear"></div>


<div  class="form-panel form-text">Send date time:</div>
<div style="width:287px; float:left;"><?php echo $message_detail['date_time'];?>
</div>


<a href="message/reply_message/<?php echo $message_detail['message_id'];?>">Reply</a>

<div class="form-panel"><img src="images/space.gif" alt="#" /></div>
<div class="input-panel">

 </div>
<div class="clear"></div>
</form>
</div>
</div>
<div class="clear"></div>