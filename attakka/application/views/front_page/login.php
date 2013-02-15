

<body>
<div id="login-wrapper">
<div align="center"><img src="images/logo-big.png" alt="#" /></div>
<div class="white-wrapper">
<div style="padding:15px;">
<div class="red-color-heading">Create <span class="black-color-heading">A LOGIN</span></div>
<div class="clear"></div>

<span style="color:green"><?php if(isset($message)) { echo $message;  }?></span>

<span style="color:red"><?php if(isset($error)) { echo $error;  }?></span>

<form method="post">
<input type="hidden" name="operation" value="login">




<div  class="form-panel form-text">Email:</div>
<div class="input-panel"><input name="user_email" id="user_email" type="text"  class="input" style="width:350px;" value="<?php echo $this->input->post('user_email');?>" /><span style="color:red"><?php if(isset($err['user_email'])) { echo $err['user_email'];  }?></span>
</div>
<div class="clear"></div>

<div  class="form-panel form-text">Password:</div>
<div class="input-panel"><input name="user_password" id="user_password" type="password" class="input" style="width:350px;" value="<?php echo $this->input->post('user_password');?>" /><span style="color:red"><?php if(isset($err['user_password'])) { echo $err['user_password'];  }?></span>
</div>
<div class="clear"></div>



<div class="form-panel"><img src="images/space.gif" alt="#" /></div>
<div class="input-panel">

  <input name="Submit" type="submit" class="submit-buttons-round" value="Login In" style="text-decoration:none;" />&nbsp;&nbsp;&nbsp;
  
<a href="<?php if(isset($loginUrl)) { echo $loginUrl;}?>"><img src="images/fb_login.jpg"></a>
  
  <br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="user/forget_password">Forget Password</a></div>







<div class="clear"></div>
</form>
</div>
</div>
<div class="clear"></div>














			

