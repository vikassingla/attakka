<?php
include('config.php');

if($_GET['getfilter']==1)
{ 
	$filter_name=$_POST['searchfilter'];
	$resPonse=getAllFilterOption($filter_name);
	$implode_res=explode(',',$resPonse);
	
	if(count($implode_res)>0)
	{
		$cnt=1;
		foreach($implode_res as $ims)
		{
			$res.='<span id="span'.$cnt.'" class="tag" style="cursor:pointer;" onclick="document.getElementById(\'filter_content\').removeChild(document.getElementById(\'filter_content\').childNodes[3]);">'.$ims.'</span>';	
			$cnt++;
		}
	}
	else
	{
		$res.='<span class="tag" style="cursor:pointer;">No Option Available.</span>';	
	}
	echo $res;
}
