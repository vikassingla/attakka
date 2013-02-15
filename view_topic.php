<?php  include("header.php");
if($_GET['dis_id'])
{
 $dis_id=$_GET['dis_id'];
}	
$adjacents = 3;
$query = "SELECT COUNT(*) as num FROM tbl_answer where dis_id=".$_GET['dis_id'];
$total_pages = mysql_fetch_array(mysql_query($query));
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
		//echo $lastpage;					//last page minus 1
$sql48="select dis_id, dis_subject, created_by, created_date from tbl_discuss where dis_id=".$dis_id;
//echo $sql48;
$rs48=mysql_query($sql48);
$row48=mysql_fetch_array($rs48);
$sql49="select ans_id,dis_id,user_id,created_date, answer from tbl_answer where dis_id=".$dis_id." order by dis_id desc LIMIT $start, $limit";
//echo $sql49;
$rs49=mysql_query($sql49);
$pagination = "";
		if($lastpage > 1)
		{	
			$pagination .= "<div class=\"pagination\">";
			//previous button
			if ($page > 1) 
				$pagination.= "<a href=\"view_topic.php?dis_id=".$dis_id."&page=$prev\">&laquo; </a>";
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
						$pagination.= "<a href=\"view_topic.php?dis_id=".$dis_id."&page=$counter\">$counter</a>";					
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
							$pagination.= "<a href=\"view_topic.php?dis_id=".$dis_id."&page=$counter\">$counter</a>";					
					}
					$pagination .= "<span class=\"elipses\">...</span>";
					$pagination.= "<a href=\"view_topic.php?dis_id=".$dis_id."&page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"view_topic.php?dis_id=".$dis_id."&page=$lastpage\">$lastpage</a>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<a href=\"view_topic.php?dis_id=".$dis_id."&page=1\">1</a>";
					$pagination.= "<a href=\"view_topic.php?dis_id=".$dis_id."&page=2\">2</a>";
					$pagination .= "<span class=\"elipses\">...</span>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"view_topic.php?dis_id=".$dis_id."&page=$counter\">$counter</a>";					
					}
					$pagination .= "<span class=\"elipses\">...</span>";
					$pagination.= "<a href=\"view_topic.php?dis_id=".$dis_id."&page=$lpm1\">$lpm1</a>";
					$pagination.= "<a href=\"view_topic.php?dis_id=".$dis_id."&page=$lastpage\">$lastpage</a>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<a href=\"view_topic.php?dis_id=".$dis_id."&page=1\">1</a>";
					$pagination.= "<a href=\"view_topic.php?dis_id=".$dis_id."&page=2\">2</a>";
					$pagination .= "<span class=\"elipses\">...</span>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<span class=\"current\">$counter</span>";
						else
							$pagination.= "<a href=\"view_topic.php?dis_id=".$dis_id."&page=$counter\">$counter</a>";					
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination.= "<a href=\"view_topic.php?dis_id=".$dis_id."&page=$next\"> &raquo;</a>";
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
<style>
.panel-three a
{
	color:#000;
	text-decoration:none;
}	
.panel-three a:hover
{
	color:#B71A0F;
	text-decoration:none;
}
</style>
<div class="internal-wrapper"><div style="padding:15px;margin-top:96px;border: 1px solid #CCCCCC;border-radius: 5px 5px 5px 5px;box-shadow: 1px 2px 2px #DADADA;">
<div class="red-color-heading-management top-heading-panel" style="width:980px;">Subject: <span class="black-color-heading"><?php echo $row48['dis_subject']?></span></div>

<div class="clear"></div>
 <div class="panel-three top-heading-discuss" style="width:65px; float:left;margin-bottom:10px;">Pages: </div><div style="float:left;width:300px;"><?php echo $pagination?></div>
 <div class="panel-three top-heading-discuss" style="width:170px; float:right;margin-bottom:10px;"><a href="post_answer.php?dis_id=<?php echo $dis_id?>">POST YOUR REPLY</a> </div>
<div class="clear"></div>

<div class="red-bar-discuss"><div class="box-one-discuss1 top-white-heading"><div class="padding-left15px">Sr. No.</div> </div>

<div class="box-two-discuss2 top-white-heading"><div class="padding-left15px">Comment By:-</div></div>

<div class="box-three-discuss3 top-white-heading" align="center">Comment</div>
<div class="box-four-discuss4 top-white-heading"><div class="padding-left15px">Posting On</div></div>

</div>


<div class="clear"></div>

<?php
$i=1;
while($row49=mysql_fetch_array($rs49))
{
	$sql50="select user_id, user_firstname, user_lastname, facebook_id, account_image from tbl_user where user_id=".$row49['user_id'];
	//echo $sql50;
	$rs50=mysql_query($sql50);
	$row50=mysql_fetch_array($rs50);
	if($row50['facebook_id']=="")
{
	if($row50['account_image']!='')
	{
		$srcf="uploads/".$row50['account_image'];
	}
	else
	{
		$srcf="images/red_img.png";
	}		
}
else
{
	if($row50['account_image']!='')
	{
		$srcf="uploads/".$row50['account_image'];
	}
	else
	{
		$srcf="http://graph.facebook.com/".$row50['facebook_id']."/picture?width=60&height=60";
	}	
}	
?>
<div class="box-one-discuss1 pink-back-left1">
<div class="padding-left15px box-internal-text2"><?php echo $i?></div>
</div>

<div class="box-two-discuss2 pink-back-left1">
	<div class="padding-left15px"><div class="image-panel-discuss">
	
		<img src="<?php echo $srcf?>" alt="#" class="image-border-new" style="height:60px;width:60px;"/>
	</div>
	<div class="content-panel-discuss box-internal2-text" style="margin-left:25px;font-size:18px;color:#000;font-family: 'CalibriRegular';line-height:45px;"><?php echo $row50['user_firstname']." ".$row50['user_lastname'] ?></div>

</div></div>
<div class="box-three-discuss3 pink-back-left1 box-internal-text" align="center"><?php echo $row49['answer']?></div>
<div class="box-four-discuss4 pink-back-left1"><div class="padding-left15px box-internal-text2"><?php echo humanTiming(strtotime($row49['created_date']))." ago"?></div>

</div>



<div class="clear"></div>
<?php
$i++;
}
?>
</div>

<?php  include("footer.php");?>
</div>
