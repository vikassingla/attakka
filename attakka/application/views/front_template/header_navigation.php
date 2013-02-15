

<body id='top' class="home blog" >
<div id="main-wrapper">
  <div id="right-panel">
        <img src="images/intro-icon.png" alt="#" class="intro-icon" />
        <a href="#" class="top-links">intro video</a> 
        <img src="images/login-icon.png" alt="#" class="login-icon" />
        
 <?php  
$session_data =  get_session_data();
if(isset($session_data['user_loged_in'])) { ?>
 
  <a href="<?php if(!$session_data['FB_logout']){ echo site_url('user/log_out');}else{ if($session_data['FB_logout']){ echo $session_data['FB_logout']; } } ?>" class="top-links-login">Logout</a> 
   <img src="images/register-icon.png" alt="#" class="register-icon" /> 
   <a href="user/dashboard" class="top-links-register">Dashboard</a>
 
 <?php }else{?>
        
        <a href="user" class="top-links-login">Login</a> 
        <img src="images/register-icon.png" alt="#" class="register-icon" /> 
        <a href="user/registration" class="top-links-register">Register</a> 
    <?php } ?>    
        
   </div>
  <div class="clear"></div>  
 
  

