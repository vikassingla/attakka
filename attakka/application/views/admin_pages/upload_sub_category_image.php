 <?php   $sub_category_id =  $this->uri->segment(3);?>
<!-- CSS -->
<link rel="stylesheet" href="uploadifyit/uploadify.css" type="text/css" />
<!-- Javascript -->
<script type="text/javascript" src="uploadifyit/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="uploadifyit/swfobject.js"></script>
<script type="text/javascript" src="uploadifyit/jquery.uploadify.v2.1.4.min.js"></script>
<script type="text/javascript">

var sub_category_id = '<?php echo $sub_category_id; ?>';

$(document).ready(function() {
	
	//alert('I am ready to use uploadify!');
	$("#file_upload").uploadify({
		'uploader': '<?php echo base_url(); ?>/uploadifyit/uploadify.swf',
		'script': '<?php echo base_url(); ?>/sub_category/move_file_on_server',
		'cancelImg': '<?php echo base_url(); ?>/uploadifyit/cancel.png',
		'folder': 'uploads',
		'auto': false, // use for auto upload
		'multi': true,
		'queueSizeLimit': 10,
		'onQueueFull': function(event, queueSizeLimit) {
			alert("Please don't put anymore files in me! You can upload " + queueSizeLimit + " files at once");
			return false;
		},
		'onComplete': function(event, ID, fileObj, response, data) {
			// you can use here jQuery AJAX method to send info at server-side.
			
			$.post("<?php echo base_url(); ?>/sub_category/upload_insert", { name: fileObj.name , sub_category_id:sub_category_id }, function(info) {
				alert(info); // alert UPLOADED FILE NAME
			});
		}
	});


	
});

</script>
<form id="form1" name="form1" action="">

<br/>
<h2>Upload image for the sub category:  <?php echo $category_detail['sub_category_name']; ?></h2><br/>


<input type="file" id="file_upload" name="file_upload" />
<div   style="margin-left:60px; font:'Times New Roman', Times, serif; ">
<a href="javascript:$('#file_upload').uploadifyUpload();">Upload File</a>
&nbsp;&nbsp;&nbsp;<a href="sub_category/category_image_list/<?php echo $sub_category_id;?>">After upload view image</a>
</div>
<br/><br/>
</form>
