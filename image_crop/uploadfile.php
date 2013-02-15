<?php
session_start();

if(isset($_POST['uploadfile']) && $_POST['uploadfile']=='yes')
{
	
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$extension = end(explode(".", $_FILES["file"]["name"]));
	
	if ((($_FILES["file"]["type"] == "image/gif") 	|| ($_FILES["file"]["type"] == "image/jpeg") 	|| ($_FILES["file"]["type"] == "image/png") 	|| ($_FILES["file"]["type"] == "image/pjpeg")) 	&& in_array($extension, $allowedExts) )
	{

		$fname = $_FILES["file"]["name"];
		$ftype = $_FILES["file"]["type"];
		$ftname = $_FILES["file"]["tmp_name"];
		$fname = date('mdyhis').$fname;
		if(move_uploaded_file($ftname,      "../uploads/" . $fname ))
		{
			$_SESSION['upload_file'] = $fname;
			print '<script>parent.show_croper("'.$fname.'");</script>';
		}
		
	}
	else
	{
		echo "Invalid file";
	}	
	  
	  
}
if(isset($_POST['uploadfilenew']) && $_POST['uploadfilenew']=='newfile')
{
	
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$extension = end(explode(".", $_FILES["uploadnewfile"]["name"]));
	
	if ((($_FILES["uploadnewfile"]["type"] == "image/gif") 	|| ($_FILES["uploadnewfile"]["type"] == "image/jpeg") 	|| ($_FILES["uploadnewfile"]["type"] == "image/png") 	|| ($_FILES["uploadnewfile"]["type"] == "image/pjpeg")) 	&& in_array($extension, $allowedExts) )
	{

		$fname = $_FILES["uploadnewfile"]["name"];
		$ftype = $_FILES["uploadnewfile"]["type"];
		$ftname = $_FILES["uploadnewfile"]["tmp_name"];
		$fname = date('mdyhis').$fname;
		if(move_uploaded_file($ftname,      "../uploads/" . $fname ))
		{
			$_SESSION['upload_file'] = $fname;
			print '<script>parent.show_croper2("'.$fname.'");</script>';
		}
		
	}
	else
	{
		echo "Invalid file";
	}	
	  
	  
}
if(isset($_POST['cropefile']) && $_POST['cropefile']='yes')
{
	$upload_path = '../uploads/';
	$target_path = '../review_images/';
	$crop_x = $_POST['crop_x'];
	$crop_y = $_POST['crop_y'];
	$crop_width = $_POST['crop_width'];
	$crop_height = $_POST['crop_height'];
	$img_width = $_POST['img_width'];
	$img_height = $_POST['img_height'];
	
	$src = $upload_path.$_POST['filename'];
	$name = 'new'.$_POST['filename'];
	$dst = $upload_path.$name;
	
	image_resize($src, $dst, $img_width, $img_height, $crop=0);
	
	if(isset($_POST['small_image']))
	{
		$thumb = 'thumb_';
	}
	else
	{
		$thumb = '';
	}
	
	
	$source_image = $upload_path.$name;
	$target_image = $target_path.$thumb.$name;
	
	
	$crop_area = array('top' => $crop_y, 'left' => $crop_x, 'height' => $crop_height, 'width' => $crop_width);
	
	cropImageBySelectedArea($source_image, $target_image, $crop_area);
	
	print '<script>parent.show_options("'.$name.'");</script>';

}

function image_resize($src, $dst, $width, $height, $crop=0)
{
	if(!list($w, $h) = getimagesize($src)) return false;

	$type = strtolower(substr(strrchr($src,"."),1));
	if($type == 'jpeg') $type = 'jpg';
		switch($type){
		case 'bmp': $img = imagecreatefromwbmp($src); break;
		case 'gif': $img = imagecreatefromgif($src); break;
		case 'jpg': $img = imagecreatefromjpeg($src); break;
		case 'png': $img = imagecreatefrompng($src); break;
		default : return false;
	}

	// resize
	if($crop){
	if($w < $width or $h < $height) return false;
		$ratio = max($width/$w, $height/$h);
		$h = $height / $ratio;
		$x = ($w - $width / $ratio) / 2;
		$w = $width / $ratio;
	}
	else{
	if($w < $width and $h < $height)
	{
		$ratio = $width/$w;
		$width = $width;
		$height = $h * $ratio;
		$x=0;
	}
	else
	{
	$ratio = $width/$w;
	$width = $width;
	$height = $h * $ratio;
	$x = 0;
	}
	}

	$new = imagecreatetruecolor($width, $height);

	// preserve transparency
	if($type == "gif" or $type == "png"){
	imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
	imagealphablending($new, false);
	imagesavealpha($new, true);
	}

	imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);

	switch($type){
	case 'bmp': imagewbmp($new, $dst); break;
	case 'gif': imagegif($new, $dst); break;
	case 'jpg': imagejpeg($new, $dst); break;
	case 'png': imagepng($new, $dst); break;
	}
	return true;
}	

function cropImageBySelectedArea($source_image, $target_image, $crop_area)
{
	// detect source image type from extension
	$source_file_name = basename($source_image);
	$source_image_type = substr($source_file_name, -3, 3);
	
	// create an image resource from the source image  
	switch(strtolower($source_image_type))
	{
		case 'jpg':
			$original_image = imagecreatefromjpeg($source_image);
			break;
			
		case 'gif':
			$original_image = imagecreatefromgif($source_image);
			break;

		case 'png':
			$original_image = imagecreatefrompng($source_image);
			break;    
		
		default:
			trigger_error('cropImage(): Invalid source image type', E_USER_ERROR);
			return false;
	}
	
	// create a blank image having the same width and height as the crop area
	// this will be our cropped image
	$cropped_image = imagecreatetruecolor($crop_area['width'], $crop_area['height']);
	
	// copy the crop area from the source image to the blank image created above
	imagecopy($cropped_image, $original_image, 0, 0, $crop_area['left'], $crop_area['top'], 
			  $crop_area['width'], $crop_area['height']);
	
	// detect target image type from extension
	$target_file_name = basename($target_image);
	$target_image_type = substr($target_file_name, -3, 3);
	
	// save the cropped image to disk
	switch(strtolower($target_image_type))
	{
		case 'jpg':
			imagejpeg($cropped_image, $target_image, 100);
			break;
			
		case 'gif':
			imagegif($cropped_image, $target_image);
			break;

		case 'png':
			imagepng($cropped_image, $target_image, 0);
			break;    
		
		default:
			trigger_error('cropImage(): Invalid target image type', E_USER_ERROR);
			imagedestroy($cropped_image);
			imagedestroy($original_image);
			return false;
	}
	
	// free resources
	imagedestroy($cropped_image);
	imagedestroy($original_image);
	
	return true;
}	


?>
