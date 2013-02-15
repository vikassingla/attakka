
<body>
<div id="main-wrapper">
<div align="center"><img src="images/logo-big.png" alt="#" /></div>
<div class="white-wrapper">
<div style="padding:15px;">
<div class="red-color-heading-management">Sub Category <span class="black-color-heading">Management</span></div>
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
<div class="top-heading-banner"><div align="right"><a href="user/create_sub_category">add sub category</a></div></div>
<div class="white-back">

<table>

<tr>
    <td width="587"><strong>Name</strong></td>
    <td width="221"><strong>Edit</strong></td>
</tr>

<?php 
if(!empty($site_data))
{
	foreach($site_data as $detail)
	{
?>

<tr>
    <td width="587"><?php echo $detail['sub_category_name'];?></td>
    <td width="221">    
   		
        <?php 
		if($detail['creator_id']==$user_id)
		{
		?>
        
         <a href="user/edit_sub_category/<?php echo $detail['sub_category_id']; ?>">Edit</a>   
        
        
        <?php } ?> 
         
    </td>
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




			

