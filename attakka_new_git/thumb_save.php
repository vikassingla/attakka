<?php 

// $image, $maxHeight, $maxWidth 

$pinfo = pathinfo($image); 
$tmb_name = $pinfo['dirname'].'/'.'atmb_'.$pinfo['filename'].'.'.$pinfo['extension']; 
if(!isset($maxWidth)){ 
    $maxWidth = 100; 
} 
if(!isset($maxHeight)){ 
    $maxHeight = 100; 
} 

switch(strtolower(substr($image, -3))) { 
case "jpg" : 
    $fileType = "jpeg"; 
    $imageCreateFunction = "imagecreatefromjpeg"; 
    $imageOutputFunction = "imagejpeg"; 
    break; 
case "jpeg" : 
    $fileType = "jpeg"; 
    $imageCreateFunction = "imagecreatefromjpeg"; 
    $imageOutputFunction = "imagejpeg"; 
    break; 
case "png" : 
    $fileType = "png"; 
    $imageCreateFunction = "imagecreatefrompng"; 
    $imageOutputFunction = "imagepng"; 
    break; 
case "gif" : 
    $fileType = "gif"; 
    $imageCreateFunction = "imagecreatefromgif"; 
    $imageOutputFunction = "imagegif"; 
    break; 
} 

$size = GetImageSize($image); 
$originalWidth = $size[0]; 
$originalHeight = $size[1]; 

$x_ratio = $maxWidth / $originalWidth; 
$y_ratio = $maxHeight / $originalHeight; 

// check that the new width and height aren't bigger than the original values. 
// the new values are higher than the original, don't resize or we'll lose quality 
if (($originalWidth <= $maxWidth) && ($originalHeight <= $maxHeight)) {  
    $newWidth = $originalWidth; 
    $newHeight = $originalHeight; 
} else if (($x_ratio * $originalHeight) < $maxHeight) { 
    $newHeight = ceil($x_ratio * $originalHeight); 
    $newWidth = $maxWidth; 
} else { 
    $newWidth = ceil($y_ratio * $originalWidth); 
    $newHeight = $maxHeight; 
} 

$src = $imageCreateFunction($image); 
$dst = imagecreatetruecolor($newWidth, $newHeight); 
// Resample 
imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight); 

// Save image 
$imageOutputFunction($dst, $tmb_name); 

ImageDestroy($src); 
ImageDestroy($dst); 

?>
