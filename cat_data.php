<?php

require("config.php");
session_start();
$con= mysql_connect(DB_HOST, DB_USER_NAME,DB_PASSWORD); 
if(!$con)
{
	die('Could not connect: ' . mysql_error());
}	
mysql_select_db(DB_NAME);

if(isset($_GET['type']) && $_GET['type']=='all')
{
	$sql="select cat_id, cat_name from tbl_category where cat_active=1 and cat_parent_id=0 order by cat_id desc";
	$rs=mysql_query($sql);
	if(mysql_num_rows($rs)>0)
	{
		while($row=mysql_fetch_array($rs))
		{
			print '<div id="catnamediv'.$row['cat_id'].'" style="background-color:#fff;color: #515252;    padding-left: 4px; padding-top: 4px;  font-family: \'CalibriRegular\';     font-size: 14px; border-bottom: 1px solid #E4E2E2;  float: left;     height:21px;     width: 244px;cursor:pointer;" onmouseover="setCatColor('.$row['cat_id'].');" onmouseout="hideCatColor('.$row['cat_id'].');" onclick="setCatText(\''.$row['cat_name'].'\','.$row['cat_id'].');">'.$row['cat_name'].'</div>';
		}

	}
	else
	{
		print '<div style="background-color:#fff;color: #515252;    padding-left: 4px; padding-top: 4px;  font-family: \'CalibriRegular\';     font-size: 14px; border-bottom: 1px solid #E4E2E2;  float: left;     height:21px;     width: 244px;cursor:pointer;" >No data found.</div>';
		
	}
}
else
{
	if(isset($_GET['cat']))
	{
		$cat = $_GET['cat'];
		$sql="select cat_id, cat_name from tbl_category where cat_name like '%$cat%' and cat_active=1 and cat_parent_id=0 order by cat_id desc";
	}
	else
	{
		$sql="select cat_id, cat_name from tbl_category where cat_active=1 and cat_parent_id=0 order by cat_id desc";
	}
	$rs=mysql_query($sql);
	if(mysql_num_rows($rs)>0)
	{
		while($row=mysql_fetch_array($rs))
		{
			print '<div id="catnamediv'.$row['cat_id'].'" style="background-color:#fff;color: #515252;    padding-left: 4px; padding-top: 4px;  font-family: \'CalibriRegular\';     font-size: 14px; border-bottom: 1px solid #E4E2E2;  float: left;     height:21px;     width: 244px;cursor:pointer;" onmouseover="setCatColor('.$row['cat_id'].');" onmouseout="hideCatColor('.$row['cat_id'].');" onclick="setCatText(\''.$row['cat_name'].'\','.$row['cat_id'].');">'.$row['cat_name'].'</div>';
		}

	}
	else
	{

		print '<div style="background-color:#fff;color: #515252;    padding-left: 4px; padding-top: 4px;  font-family: \'CalibriRegular\';     font-size: 14px; border-bottom: 1px solid #E4E2E2;  float: left;     height:21px;     width: 244px;cursor:pointer;" >No data found.</div>';
	}
	
}
?>
