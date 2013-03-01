<?php
include('config.php');
if(isset($_POST['searchfilter']))
{
	//die('ddddddddd'); 
	$filter_name=$_POST['searchfilter'];
	$sql="select filter_id,filter_name from  tbl_category_filters where filter_name like '%$filter_name%'";
	$result=mysql_query($sql);
	if(mysql_num_rows($result)>0)
	{
		while($row=mysql_fetch_assoc($result))
		{
			$res[]=$row['filter_id'].'_'.$row['filter_name'];
		}	
	}
	echo $res;
}

?>
