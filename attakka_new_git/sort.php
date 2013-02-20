<?php
  require("config.php");
session_start();
$con= mysql_connect(DB_HOST, DB_USER_NAME,DB_PASSWORD); 

if(!$con)
{
	die('Could not connect: ' . mysql_error());
}	
mysql_select_db(DB_NAME);
$direction=$_REQUEST['direction'];
$index=$_REQUEST['index'];
function move_up()
{ 
      $display_order = $_GET['rev_id']; // Get the article we are moving up
      $prev_article = ($_GET['rev_id'] - 1); // Get the article we are swapping with
      $connection = db_connect();        
      $query = "UPDATE tbl_review_image SET rev_rank = '($display_order - 1)' WHERE rev_rank = '$display_order'";        
      $result = mysql_query($query);
        if (!$result)
        {
          return false;
        }
        else
        {
          return true;
        }        
    }  
  $query = 'SELECT rev_id, rev_img FROM tbl_review_image where rev_cat_id=1 ORDER BY rev_rank ASC';
  $result = mysql_query($query) or die(mysql_error().': '.$query);
  if(mysql_num_rows($result)) {
  
?>
			  <div class="top-heading-info">Vote for the best wallpic</div>
			  <form name="form1" id="form1" action="main.php" method="POST"> 
			  <?php
			  $sql18="select rev_id, rev_img from tbl_review_image where rev_cat_id=1";
			 // echo $sql18;
			  $rs18=mysql_query($sql18);
			  $n=mysql_num_rows($rs18);
			  $i=1;
			  
			  while($row18=mysql_fetch_array($rs18))
			{
			  
			  ?>
			  <div class="info-image-left views-field"><img src="review_images/<?php echo $row18['rev_img']?>" style="height:113px;width:276px;" alt="#" /></div>
			  <div class="box-rating" style="margin-top:6px"><?php echo $i?><sup style="font-size:6px;">o</sup></div>
			 
			  <div class="arrow-up">
			   <?php if($i>1)
			   {
				   ?>
			  
			  <a href='?direction=up&rev_id=<?php echo $i?>'><img src="images/arrow-up.png" alt="#" title="<?php echo $i?>" style="margin-bottom:20px;" />
			  </a>
			  <?php 
			  }
			   if($i<$n)
			   {
				   ?>
 <a href='?direction=dn&rev_id=<?php echo $i?>'><img src="images/arrow-down.png" alt="#" title="<?php echo $i?>" /></a>
<?php
		}
		?></div>
<div class="clear"></div>
			<?php
			$i++;
			}?>
<?php } else { ?>
  
  <p>Sorry!  There are no items in the system.</p>
  
<?php } ?>
