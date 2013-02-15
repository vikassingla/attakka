<div class="footer-text">
    <a href="" class="footer-text">Home</a> &nbsp;|&nbsp;
    <a href="about_us" class="footer-text">About Us</a> &nbsp;|&nbsp; 
    <a href="terms_and_condition" class="footer-text">Terms &amp; Conditions</a> &nbsp;|&nbsp; 
    
    <?php 
 

$session_data =  get_session_data();

 if(isset($session_data['user_loged_in'])) { ?>
 
  <a href="user/log_out" class="footer-text">Logout</a> 
  &nbsp;|&nbsp;     
    <a href="user/dashboard" class="footer-text" >Dashboard</a>
 
 <?php }else{?>
    
    <a href="user" class="footer-text" >Login</a> &nbsp;|&nbsp;     
    <a href="user/registration" class="footer-text" >Register</a>
    
  <?php 
 }
  ?>  
    
</div>
<div class="footer-text">&copy; <?php echo date("Y");?> Attakka, All rights reserved.</div>