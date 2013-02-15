
<body>
<div id="main-wrapper">
<div align="center"><a href=""><img src="images/logo-big.png" alt="#" border="0" /></a></div>
<div class="white-wrapper">
<div style="padding:15px;">
<div class="red-color-heading">Send a <span class="black-color-heading">Message</span>

<div align="right"><a href="message/message_list">Message List</a></div>

</div>
<div class="clear"></div>
<div id="left-panelform">
<form method="post" method="post" enctype="multipart/form-data"> 
<span style="color:green"><?php if(isset($message)) { echo $message;  }?></span>

<span style="color:green">

<?php 

	if($this->session->flashdata('add'))
	{
		 $msg = $this->session->flashdata('add');
		 display_error($msg,"Notice:");
	}
?>

</span>


<input type="hidden" name="operation" value="send_message">




<div class="formpanel-text form-text">email:</div>
<div class="inputpanel-right"><input value="<?php echo $this->input->post('to_email');?>" type="text" class="input" name="to_email" style="width:275px;" />
<span style="color:red"><?php if(isset($err['to_email'])) { echo $err['to_email'];  }?></span>
</div>
<div class="clear"></div>




<div class="formpanel-text form-text">subject:</div>
<div class="inputpanel-right"><input value="<?php echo $this->input->post('subject');?>" type="text" class="input" name="subject" style="width:275px;" />
<span style="color:red"><?php if(isset($err['subject'])) { echo $err['subject'];  }?></span>
</div>
<div class="clear"></div>




<div id="right-panelform"><div class="formpanel-text-right form-text">Message:</div>
  <div class="inputpanel-right2"> <textarea name="message" rows="3" class="textarea" style="width:270px;"><?php echo $this->input->post('message');?></textarea> 
  
  <span style="color:red"><?php if(isset($err['message'])) { echo $err['message'];  }?></span>

  
  </div>
  <div class="clear"></div>
 

<div><img src="images/line-flip.png" alt="#" /></div>
<div class="clear"></div>
<div align="center"><span style="margin-bottom:20px;">
<input name="Submit" type="submit" class="submit-buttons-round" value="Submit" />
&nbsp;
<input name="Clear" type="reset" class="clear-button" value="Clear" />
</span></div>
</form>
<br/><br/>
</div></div>
<div class="clear"></div>