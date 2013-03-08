<?php 
session_start();
include "config.php";
$sql="select review_description from tbl_review_map where review_map_id=".$_GET['review_id'];
$rs=mysql_query($sql);
$row=mysql_fetch_array($rs);
echo $row['review_description'];
?>
