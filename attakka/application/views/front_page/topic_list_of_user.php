
<body>
<div id="main-wrapper">
<div align="center"><img src="images/logo-big.png" alt="#" /></div>
<div class="white-wrapper">
<div style="padding:15px;">
<div class="red-color-heading-management">Topic <span class="black-color-heading">List</span></div>
<div class="clear"></div>
<div align="center" style="color:green;" >
<?php 

	if($this->session->flashdata('add'))
	{
		 $msg = $this->session->flashdata('add');
		 display_error($msg,"Notice:");
	}
?>
		
        
        
</div>

<!--box1 -->
<div class="top-heading-banner"><div align="right"><a href="user/post_topic">Post new topic</a></div></div>
<div class="white-back">

<table>

<tr>
    <td width="587"><strong>Name</strong></td>
    <td width="221"><strong>Detail</strong></td>
    <td width="221"><strong>Review</strong></td>
    <td width="221"><strong>Comment</strong></td>
</tr>

<?php 
if(!empty($site_data))
{
	foreach($site_data as $detail)
	{
?>

<tr>
    <td width="587" height="50"><?php echo $detail['topic_title'];?></td>
    <td width="221">    
   		 <a href="user/topic_detail/<?php echo $detail['topic_id']; ?>">View</a>   
    </td>
    <td width="587"><?php echo $this->topic_model->get_total_review($detail['topic_id']);?></td>
    <td width="587"><?php echo 0;?></td>
</tr>

<?php 
	}
}
?>






</table>
<div align="right" style="font-size:20px;">
<?php
  echo $site_data_pagination;
?>
</div>






<div class="clear"></div>




</div>

<!--box1 -->


<div class="clear"></div>




			

