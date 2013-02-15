
<body>
<div id="login-wrapper">
<div align="center"><img src="images/logo-big.png" alt="#" /></div>
<div class="white-wrapper">
<div style="padding:15px;">
<div class="red-color-heading">Create <span class="black-color-heading">A Account</span></div>
<div class="clear"></div>

<span style="color:green"><?php if(isset($message)) { echo $message;  }?></span>

<form method="post">
<input type="hidden" name="operation" value="registration">

<div  class="form-panel form-text">First Name:</div>
<div class="input-panel"><input name="user_first_name" id="user_first_name" type="text"  class="input" style="width:350px;" value="<?php echo $this->input->post('user_first_name');?>" /><span style="color:red"><?php if(isset($err['user_first_name'])) { echo $err['user_first_name'];  }?></span>
</div>
<div class="clear"></div>

<div  class="form-panel form-text">Last Name:</div>
<div class="input-panel"><input name="user_last_name" id="user_last_name" type="text" class="input" style="width:350px;" value="<?php echo $this->input->post('user_last_name');?>" /><span style="color:red"><?php if(isset($err['user_last_name'])) { echo $err['user_last_name'];  }?></span>
</div>
<div class="clear"></div>

<div  class="form-panel form-text">Password :</div>
<div class="input-panel"><input name="user_password" id="user_password" type="password" class="input" style="width:350px;" value=""/><span style="color:red"><?php if(isset($err['user_password'])) { echo $err['user_password'];  }?></span>
</div>
<div class="clear"></div>


<div  class="form-panel form-text">Email ID:</div>
<div style="width:287px; float:left;"><input name="user_email" id="user_email" type="text" class="input" style="width:280px;" value="<?php echo $this->input->post('user_email');?>"/><span style="color:red"><?php if(isset($err['user_email'])) { echo $err['user_email'];  }?></span>
 </div>



<div class="clear"></div>
<div  class="form-panel form-text">Country :</div>
<div class="input-panel"><input  id="user_country" name="user_country" type="text" class="input" style="width:150px;" <?php if($this->input->post('user_country')=="") { ?> value="New York" <?php }else{ ?> value="<?php echo $this->input->post('user_country');?>" <?php } ?> />

<span style="color:red"><?php if(isset($err['user_country'])) { echo $err['user_country'];  }?></span>


</div>

<div class="clear"></div>
<div  class="form-panel form-text">Region :</div>
<div class="input-panel"><input name="user_region" id="user_region" type="text" class="input" style="width:150px;" <?php if($this->input->post('user_region')=="") { ?> value="Russian" <?php }else{ ?> value="<?php echo $this->input->post('user_region');?>" <?php } ?> />
<br/>
<span style="color:red"><?php if(isset($err['user_region'])) { echo $err['user_region'];  }?></span>
</div>
<div class="clear"></div>
<div class="form-panel"><img src="images/space.gif" alt="#" /></div>
<div class="input-panel blue-text"><input <?php if($this->input->post('agree')!="") { ?> checked="checked" <?php } ?> name="agree" type="checkbox" value="1" /> I agree to the <u><a href="terms_and_condition" class="blue-text">Terms & Conditions</a></u> 
<br/>
<span style="color:red"><?php if(isset($err['agree'])) { echo $err['agree'];  }?></span>

</div>
<div class="clear"></div>
<div class="form-panel"><img src="images/space.gif" alt="#" /></div>
<div class="input-panel">

  <input name="Submit" type="submit" class="submit-buttons-round" value="Submit" style="text-decoration:none;" /></div>
<div class="clear"></div>
</form>
</div>
</div>
<div class="clear"></div>