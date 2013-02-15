<?php include("header.php");
if (isset($_GET['cat_id']))
{
	$cat_id=$_GET['cat_id'];
}	
$adjacents = 3;
$query1 = "SELECT COUNT(*) as num FROM tbl_discuss where dis_cat_id=".$_GET['cat_id'];
//echo $query1;
$total_pages = mysql_fetch_array(mysql_query($query1));
$total_pages = $total_pages['num'];
//echo $total_pages;
$limit = 5; 								//how many items to show per page
$page = $_GET['page'];
if($page) 
	$start = ($page - 1) * $limit; 			//first item to display on this page
else
	$start = 0;		
	if ($page == 0) $page = 1;
	//echo $pageno;					//if no page var is given, default to 1.
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 = $lastpage - 1;	
$sql42="select cat_name from tbl_category where cat_id=".$cat_id;
$rs42=mysql_query($sql42);
$row42=mysql_fetch_array($rs42);
$sql44="select dis_id, dis_cat_id, dis_subject, created_by, modified_date from tbl_discuss where dis_cat_id=".$cat_id." order by dis_id desc LIMIT $start, $limit";
$rs44=mysql_query($sql44);
$pagination = "";
		if($lastpage > 1)
		{	
			$pagination .= "<div class=\"pagination\">";
			//previous button
			if ($page > 1) 
				$pagination.= "<a href=\"discuss_it.php?cat_id=".$cat_id."&page=$prev\">&laquo; </a>";
			else
				$pagination.= "<span class=\"disabled\">&laquo; </span>";	
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"discuss_it.php?cat_id=".$cat_id."&page=$counter\">$counter</a>";					
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"discuss_it.php?cat_id=".$cat_id."&page=$counter\">$counter</a>";					
					}
					$pagination .= "<span class=\"elipses\">...</span>";
					$pagination.= "<a href=\"discuss_it.php?cat_id=".$cat_id."&page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"discuss_it.php?cat_id=".$cat_id."&page=$lastpage\">$lastpage</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href=\"discuss_it.php?cat_id=".$cat_id."&page=1\">1</a>";
					$pagination.= "<a href=\"discuss_it.php?cat_id=".$cat_id."&page=2\">2</a>";
					$pagination .= "<span class=\"elipses\">...</span>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"discuss_it.php?cat_id=".$cat_id."&page=$counter\">$counter</a>";					
					}
					$pagination .= "<span class=\"elipses\">...</span>";
					$pagination.= "<a href=\"discuss_it.php?cat_id=".$cat_id."&page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"discuss_it.php?cat_id=".$cat_id."&page=$lastpage\">$lastpage</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<a href=\"discuss_it.php?cat_id=".$cat_id."&page=1\">1</a>";
					$pagination.= "<a href=\"discuss_it.php?cat_id=".$cat_id."&page=2\">2</a>";
					$pagination .= "<span class=\"elipses\">...</span>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"discuss_it.php?cat_id=".$cat_id."&page=$counter\">$counter</a>";					
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination.= "<a href=\"discuss_it.php?cat_id=".$cat_id."&page=$next\"> &raquo;</a>";
			else
				$pagination.= "<span class=\"disabled\"> &raquo;</span>";
			$pagination.= "</div>\n";		
		}
function humanTiming ($time)
{

    $time = time() - $time; // to get the time since that moment

    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}

?>
<div class="internal-wrapper"><div style="padding:15px;margin-top:96px;border: 1px solid #CCCCCC;border-radius: 5px 5px 5px 5px;box-shadow: 1px 2px 2px #DADADA;">
<div class="red-color-heading-management top-heading-panel">Discussion <span class="black-color-heading">Board</span></div>
<div class="right-panel-discuss top-text-discuss">Name : <span class="movie-name-text"><?php echo $row42['cat_name']?></span></div>

<div class="clear"></div>
 
<a href="new_topic.php?cat_id=<?php echo $cat_id?>"><div class="panel-one top-heading-discuss"><img src="images/topic-icon.png" alt="#"  border="0" style="margin-bottom:-5px; margin-right:10px;" />Start New Topic</div></a>

<a href="#"><div class="panel-two top-heading-discuss"><img src="images/favorites-icon.png" alt="#" style="margin-bottom:-5px; margin-right:10px;" border="0" />Add to Favorites</div></a>
<div class="panel-three top-heading-discuss" style="width:65px; float:left;">Pages: </div><div><?php echo $pagination?></div>
<div class="clear"></div>

<div class="red-bar-discuss"><div class="box-one-discuss top-white-heading"><div class="padding-left15px">Subject</div> </div>

<div class="box-two-discuss top-white-heading"><div class="padding-left15px">Started by</div></div>

<div class="box-three-discuss top-white-heading" align="center">Replies</div>
<div class="box-four-discuss top-white-heading"><div class="padding-left15px">Latest Posting</div></div>

</div>


<div class="clear"></div>

<?php
while($row44=mysql_fetch_array($rs44))
{
	$sql45="select user_id, user_firstname, user_lastname, facebook_id, account_image from tbl_user where user_id=".$row44['created_by'];
	$rs45=mysql_query($sql45);
	$row45=mysql_fetch_array($rs45);
	if($row45['facebook_id']=="")
{
	if($row45['account_image']!='')
	{
		$srce="uploads/".$row45['account_image'];
	}
	else
	{
		$srce="images/red_img.png";
	}		
}
else
{
	if($row45['account_image']!='')
	{
		$srce="uploads/".$row45['account_image'];
	}
	else
	{
		$srce="http://graph.facebook.com/".$row45['facebook_id']."/picture?width=36&height=36";
	}	
}	
$sql47="select count(ans_id) as answer from tbl_answer where dis_id=".$row44['dis_id'];
$rs47=mysql_query($sql47);
$row47=mysql_fetch_array($rs47);
?>
<div class="box-one-discuss pink-back-left">
<div class="padding-left15px box-internal-text2"><a href="view_topic.php?dis_id=<?php echo $row44['dis_id']?>"><?php echo $row44['dis_subject']?></a></div>
</div>

<div class="box-two-discuss pink-back-left">
	<div class="padding-left15px"><div class="image-panel-discuss">
		<img src="<?php echo $srce?>" alt="#" class="image-border-new" style="height:36px;width:36px;"/>
	</div>
	<div class="content-panel-discuss box-internal-text"><?php echo $row45['user_firstname']." ".$row45['user_lastname'] ?></div>

</div></div>
<div class="box-three-discuss pink-back-left box-internal-text2" align="center"><?php echo $row47['answer']?></div>
<div class="box-four-discuss pink-back-left"><div class="padding-left15px box-internal-text2"><?php echo humanTiming(strtotime($row44['modified_date']))." ago"?></div>

</div>



<div class="clear"></div>
<?php
}
?>

<div class="clear"></div>
</div>
<?php include("footer.php")?>

