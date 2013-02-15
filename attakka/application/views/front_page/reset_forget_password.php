

<body>
<div id="login-wrapper">
<div align="center"><img src="images/logo-big.png" alt="#" /></div>
<div class="white-wrapper">
<div style="padding:15px;">
<div class="red-color-heading">Reset <span class="black-color-heading">Password</span></div>
<div class="clear"></div>

<span style="color:green"><?php if(isset($message)) { echo $message;  }?></span>

<span style="color:red"><?php if(isset($error)) { echo $error;  }?></span>

<form method="post">
<input type="hidden" name="operation" value="login">



<div  class="form-panel form-text">Password:</div>
<div class="input-panel"><input name="user_password" id="user_password" type="password"  class="input" style="width:350px;" value="" /><span style="color:red"><?php if(isset($err['user_password'])) { echo $err['user_password'];  }?></span>
</div>
<div class="clear"></div>

<div  class="form-panel form-text">Confirm Password:</div>
<div class="input-panel"><input name="confirm_user_password" id="confirm_user_password" type="password" class="input" style="width:350px;" value="" /><span style="color:red"><?php if(isset($err['confirm_user_password'])) { echo $err['confirm_user_password'];  }?></span>
</div>
<div class="clear"></div>


<div class="form-panel"><img src="images/space.gif" alt="#" /></div>
<div class="input-panel">

  <a href=""><input name="Submit" type="submit" class="submit-buttons-round" value="Submit" style="text-decoration:none;" /></a>&nbsp;&nbsp;&nbsp;<a href="user">Login</a></div>
<div class="clear"></div>
</form>
</div>
</div>
<div class="clear"></div>














			

