<body>
<div id="login-wrapper">
<div align="center"><img src="images/logo-big.png" alt="#" /></div>
<div class="white-wrapper">
<div style="padding:15px;">
<div class="red-color-heading">Forget <span class="black-color-heading">Password</span></div>
<div class="clear"></div>
<span style="color:green"><?php if(isset($message)) { echo $message;  }?></span>
<span style="color:red"><?php if(isset($error)) { echo $error;  }?></span>
<form method="post">
<input type="hidden" name="operation" value="login">

<div  class="form-panel form-text">Email ID:</div>
<div style="width:287px; float:left;"><input value="<?php echo $this->input->post('user_email');?>" name="user_email" id="user_email" type="text" class="input" style="width:280px;" /><span style="color:red"><?php if(isset($err['user_email'])) { echo $err['user_email'];  }?></span> </div>
<div class="clear"></div>
<br/>

<div class="form-panel"><img src="images/space.gif" alt="#" /></div>
<div class="input-panel">

 <input name="Submit" type="submit" class="submit-buttons-round" value="Submit" style="text-decoration:none;" />&nbsp;&nbsp;&nbsp;<a href="user">Login</a></div>
<div class="clear"></div>
</form>
</div>
</div>
<div class="clear"></div>














			

