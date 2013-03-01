<?php
include('config.php');

if(isset($_POST['searchfilter']))
{ 
	$resPonse=getAllFilters();
	$res='<div class="links" style="border-bottom:1px solid #ccc;">';
	if(count($resPonse)>0)
	{
		foreach($resPonse as $fn)
		{
			$explode_fn=explode('_',$fn);
			$res.='<a href="javascript:void(0);" onclick="getFilterOptions(this.innerHTML);">'.$explode_fn[1].'</a>';	
		}
	}
	else
	{
		$res.='<span style="font-size: 10px; color: #000000;">No record found for this keyword.</span>';
	}
	$res.='</div><div class="mainlink">
		<a href="javascript:void(0);" onclick="">Create New</a>
	</div>';
	echo $res;
}

?>
