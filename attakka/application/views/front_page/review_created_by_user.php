
<body>
<div class="internal-wrapper">
<div style="margin-top:100px;">    <img src="images/batman-banner.png" alt="" class="image-border" />

<span style="color:green"><?php if(isset($message)) { echo $message;  }?></span>

<span style="color:red; font-size:24px;"><?php if(isset($err['error'])) { echo $err['error'];  }?></span>




		 <form method="post" enctype="multipart/form-data">
         <input type="hidden" name="operation"  value="review_created_by_user"    >
		      <h4 style="padding-left:10px;"> Create Review on the topic: <?php
	    if($this->uri->segment(4)=='s')
		{
		 echo $topic_data["sub_category_name"];
		}
		
		if($this->uri->segment(4)=='m')
		{
		 echo $topic_data["category_name"];
		}
			  
			  
			  ?></h4></div>
              <br/><br/>  
             Create Review on the topic: <?php 
			 
			 
		if($this->uri->segment(4)=='s')
		{
			 
			 echo $topic_data["sub_category_name"];
		}
		
		
		if($this->uri->segment(4)=='m')
		{
			 
			 echo $topic_data["category_name"];
		}
		
			 ?>
			  <div class="clear"></div>
              
            
              
			  <div class="icon-rate-left"><div><img src="images/rate/rate-5.png" alt="#" /></div>
			  <div align="center"><input <?php if($this->input->post('review_rate')==-5) {?>  checked="checked" <?php } ?> name="review_rate" type="radio" value="-5" /></div></div>
		
		
		<div class="icon-rate"><div><img src="images/rate/rate-4.png" alt="#" /></div>
			  <div align="center"><input name="review_rate" <?php if($this->input->post('review_rate')==-4) {?>  checked="checked" <?php } ?>   type="radio" value="-4" /></div></div>
		
		<div class="icon-rate"><div><img src="images/rate/rate-3.png" alt="#" /></div>
			  <div align="center"><input name="review_rate" type="radio" value="-3" <?php if($this->input->post('review_rate')==-3) {?>  checked="checked" <?php } ?>  /></div></div>
		
		<div class="icon-rate"><div><img src="images/rate/rate-2.png" alt="#" /></div>
			  <div align="center"><input <?php if($this->input->post('review_rate')==-2) {?>  checked="checked" <?php } ?>  name="review_rate" type="radio" value="-2" /></div></div>
		
		<div class="icon-rate"><div><img src="images/rate/rate-1.png" alt="#" /></div>
			  <div align="center"><input name="review_rate" type="radio" value="-1" <?php if($this->input->post('review_rate')==-1) {?>  checked="checked" <?php } ?>  /></div></div>
		
		
		<div class="icon-rate"><div><img src="images/rate/rate-0.png" alt="#" /></div>
			  <div align="center"><input <?php if($this->input->post('review_rate')==0) {?>  checked="checked" <?php } ?>  name="review_rate" type="radio" value="0" /></div></div>
		
		
		<div class="icon-rate"><div><img src="images/rate/rate-1plus.png" alt="#" /></div>
			  <div align="center"><input <?php if($this->input->post('review_rate')==1) {?>  checked="checked" <?php } ?>  name="review_rate" type="radio" value="1" /></div></div>
		
		
		<div class="icon-rate"><div><img src="images/rate/rate-2plus.png" alt="#" /></div>
			  <div align="center"><input name="review_rate" type="radio" value="2" <?php if($this->input->post('review_rate')==2) {?>  checked="checked" <?php } ?>  /></div></div>
		
		<div class="icon-rate"><div><img src="images/rate/rate-3plus.png" alt="#" /></div>
			  <div align="center"><input <?php if($this->input->post('review_rate')==3) {?>  checked="checked" <?php } ?>  name="review_rate" type="radio" value="3" /></div></div>
		
		
		<div class="icon-rate"><div><img src="images/rate/rate-4plus.png" alt="#" /></div>
			  <div align="center"><input  <?php if($this->input->post('review_rate')==4) {?>  checked="checked" <?php } ?>  name="review_rate" type="radio" value="4" /></div></div>
		
		<div class="icon-rate"><div><img src="images/rate/rate-5plus.png" alt="#" /></div>
			  <div align="center"><input <?php if($this->input->post('review_rate')==5) {?>  checked="checked" <?php } ?>  name="review_rate" type="radio" value="5" /></div></div>
            <br/>  
              <span style="color:red"><?php if(isset($err['review_rate'])) { echo $err['review_rate'];  }?></span>

              
              
				<div class="clear"></div>
		
			  <div class="form-panel-create-review"><div style="margin-bottom:20px;"><textarea rows="5" class="textarea" name="review_title" style="width:760px;" placeholder="Title Opinion" name="demo-comment"><?php echo $this->input->post('review_title');?></textarea>
			
             <br/>  
              <span style="color:red"><?php if(isset($err['review_title'])) { echo $err['review_title'];  }?></span>
            
              </div>
			  <div style="margin-bottom:20px;"><textarea placeholder="Title Review" name="review_description" rows="15" class="textarea" style="width:760px;"><?php echo $this->input->post('review_description');?></textarea>
                  <br/>  
              <span style="color:red"><?php if(isset($err['review_description'])) { echo $err['review_description'];  }?></span>
              
			  </div>
			  <div class="clear"></div>
			  <div style="margin-bottom:20px;"><input name="Submit" type="Submit" class="submit-buttons-round" value="Submit" /> &nbsp; <input name="Clear" type="Submit" class="clear-button" value="Clear" /></div>
			  
              </form>
              
              </div>
<div class="clear"></div>