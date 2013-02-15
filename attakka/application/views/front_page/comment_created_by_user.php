
<body>
<div class="internal-wrapper">
<div style="margin-top:100px;">    <img src="images/batman-banner.png" alt="" class="image-border" />

<span style="color:green"><?php if(isset($message)) { echo $message;  }?></span>


		 <form method="post" enctype="multipart/form-data">
         <input type="hidden" name="operation"  value="review_created_by_user"    >
		      <h4 style="padding-left:10px;"> Create Comment on the topic: <?php echo $topic_data["topic_title"];?></h4></div>
              <br/><br/>  
             Create Comment on the topic: <?php echo $topic_data["topic_title"];?>
			  <div class="clear"></div>
        		
			  <div class="form-panel-create-review"><div style="margin-bottom:20px;"><textarea  rows="5" class="textarea" name="comment_title" style="width:760px;" placeholder="Title Opinion" name="demo-comment"><?php echo $this->input->post('comment_title');?></textarea>
			
             <br/>  
              <span style="color:red"><?php if(isset($err['comment_title'])) { echo $err['comment_title'];  }?></span>
            
              </div>
			  <div style="margin-bottom:20px;"><textarea placeholder="Description Comment" name="comment_description" rows="15" class="textarea" style="width:760px;"><?php echo $this->input->post('comment_description');?></textarea>
                  <br/>  
              <span style="color:red"><?php if(isset($err['comment_description'])) { echo $err['comment_description'];  }?></span>
              
			  </div>
			  <div class="clear"></div>
			  <div style="margin-bottom:20px;"><input name="Submit" type="Submit" class="submit-buttons-round" value="Submit" /> &nbsp; <input name="Clear" type="Submit" class="clear-button" value="Clear" /></div>
			  
              </form>
              
              </div>
<div class="clear"></div>