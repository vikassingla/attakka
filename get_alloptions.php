<?php
include('config.php');

if($_GET['get_all_option']==1)
{
    //echo '<pre>';print_r($_POST);die;
    $curr=$_GET['current_id']-1;
    $currId=$_GET['current_id'];
    //echo "THE ID IS ".$currId;die;
    $currentId='filter_content'.$_GET['current_id'];
    $textVal=$_POST['filter_textbox'.$currId][0];
   // echo "THE TEXT VALUE IS ".$textVal;die;
	$resPonse=getAllFilterOption($textVal);
	$optionArr=explode(",", $resPonse);
	$res='<div class="links">';
	if(count($optionArr)>0)
	{
		//echo '<pre>';
		//print_r($optionArr);die;
		foreach($optionArr as $fn)
		{
			if(!empty($textVal))
			{
				if (stripos($fn,$textVal) === 0){
					$fil_val=$fn;
					$res.='<a href="javascript:void(0);" onclick="addFilterOption(this.innerHTML,'.$currentId.');">'.$fn.'</a>';	
				}
			}
		}
		/*if(empty($fil_val))
		{
			$res.='<span style="font-size: 10px; color: #000000;float:left;">No record found.</span>';
		}*/
	}
	/*else
	{
		$res.='<span style="font-size: 10px; color: #000000;float:left;">No record found.</span>';
	}*/
	if(empty($fil_val))
	{
	    $res='';
	}
	echo $res;
}
