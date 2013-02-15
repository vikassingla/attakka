<?php
/**echo "<pre>";
print_r($_REQUEST);*/
include("config.php");
session_start();
//print_r($_SESSION);
$con= mysql_connect(DB_HOST, DB_USER_NAME,DB_PASSWORD); 
if(!$con)
{
die('Could not connect: ' . mysql_error());
}	
mysql_select_db(DB_NAME);
$sql5="SELECT rev_img FROM tbl_review_image where rev_cat_id=".$_GET['cat']." ORDER BY RAND() LIMIT 0,1" ;
//echo $sql5;
$rs5=mysql_query($sql5);

if(mysql_num_rows($rs5)>0)
{
	$row5=mysql_fetch_array($rs5);
	$src="review_images/".$row5['rev_img'];
}	
else
{
	$src="images/noimg.jpg";
}	
print '
<form name="form2" id="form2" action="main.php" method="POST">
	<input type="hidden" name="catid" id="catid" value="'.$_GET['cat'].'"> 
	<div>
	<div class="clear"></div>
	<div style="padding-bottom:20px;">
	<img src="'.$src.'" style="width:710px;margin-left:-80px;">
	</div>
	<div class="clear"></div>
	<div class="formpanel-text form-text">Select a Subctegory:</div>
	<div class="inputpanel-rightCategory">';
		@$sql1="select cat_id, cat_name from tbl_category where cat_parent_id=".$_GET['cat']." order by cat_id desc";
		//echo $sql;
		$rs1=mysql_query($sql1);		
		print'		
		<select name="subcat" id="subcat" class="input" style="width:250px" onchange="showSubCat(this.value)">';

		if(mysql_num_rows($rs1)>0)
		{
		$sql1="select cat_id, cat_name from tbl_category where cat_parent_id=".$_GET['cat']." order by cat_id desc";

		$rs1=mysql_query($sql1);

		while($row1=mysql_fetch_assoc($rs1))
		{
		?>

		<option value=<?php echo $row1['cat_id'];?>><?php echo $row1['cat_name']; ?> </option>;

		<?	
		}
		print '<option value="none">None</option>';
		}	

		else
		{
		print '<option value="none">None</option>';
		}	
		print'</select>';	

	print '	</div>
	<div style="float:left;"><input type="button" name="add" id="add" onclick="showSubAdd('.$_GET['cat'].')" value="Add Subcategory" class="submit-buttons-rec" style="width:140px"></div>
	</div>

</div>
	<div id="wrapper1" style="margin-top:15px;margin-left:0px;display:none;width:564px;float:left">
	<div class="formpanel-text form-text">Sub-category Name:</div>
	<input type="hidden" name="cat_name" id="cat_name" >
	<input type="text" id="subcatname" name="subcatname" class="input" style="width:237px;margin-right:-50px;">
	<input type="button" value="Submit" onclick="addSubRecord()" class="submit-buttons-rec" style="float:right"/>
	<div id="propspectDiv1"></div>
	</div>
		</div>
	<div style="float:left;min-height:50px;clear:both;margin-top:20px;">

	<div class="formpanel-text form-text" style="float:left">Title Opinion:</div>
	<div class="inputpanel-rightCategory">
	<textarea name="revtitle" id="revtitle" rows="8" class="textarea" style="width:270px;" ></textarea> 
	</div>
	</div>

	<div style="float:left;min-height:50px;clear:both;margin-top:20px">

	<div class="formpanel-text form-text" style="float:left;">Title Review:</div>
	<div class="inputpanel-rightCategory">
	<textarea name="revcom" id="revcom" rows="8" class="textarea" style="width:270px;" ></textarea> 
	</div>

	<br/>
	<div class="clear"></div>
	<div class="formpanel-text form-text" style="float:left;">Rate:</div>

	<div style="width:520px;">
	<div class="icon-rate-left"><div><img src="images/rate/rate-5.png" alt="#" /></div>
	<div align="center"><input name="rate" type="radio" value="-5" /></div></div>


	<div class="icon-rate"><div><img src="images/rate/rate-4.png" alt="#" /></div>
	<div align="center"><input name="rate" type="radio" value="-4" /></div></div>

	<div class="icon-rate"><div><img src="images/rate/rate-3.png" alt="#" /></div>
	<div align="center"><input name="rate" type="radio" value="-3" /></div></div>

	<div class="icon-rate"><div><img src="images/rate/rate-2.png" alt="#" /></div>
	<div align="center"><input name="rate" type="radio" value="-2" /></div></div>

	<div class="icon-rate" style="margin-left:155px"><div><img src="images/rate/rate-1.png" alt="#" /></div>
	<div align="center"><input name="rate" type="radio" value="-1" /></div></div>

	<div class="icon-rate" ><div><img src="images/rate/rate-0.png" alt="#" /></div>
	<div align="center"><input name="rate" type="radio" value="0" /></div></div>


	<div class="icon-rate"><div><img src="images/rate/rate-1plus.png" alt="#" /></div>
	<div align="center"><input name="rate" type="radio" value="1" /></div></div>


	<div class="icon-rate"><div><img src="images/rate/rate-2plus.png" alt="#" /></div>
	<div align="center"><input name="rate" type="radio" value="2" /></div></div>

	<div class="icon-rate" style="margin-left:200px"><div><img src="images/rate/rate-3plus.png" alt="#" /></div>
	<div align="center"><input name="rate" type="radio" value="3" /></div></div>


	<div class="icon-rate" ><div><img src="images/rate/rate-4plus.png" alt="#" /></div>
	<div align="center"><input name="rate" type="radio" value="4" /></div></div>

	<div class="icon-rate"><div><img src="images/rate/rate-5plus.png" alt="#" /></div>
	<div align="center"><input name="rate" type="radio" value="5" /></div></div>
	<div class="clear"></div>
	<div style="float:left;min-height:50px;clear:both;margin-top:20px">
	</div>
	<input type="submit" class="submit-buttons-round" name="review" value="Submit Review" style="width:140px">

	</div>
</form>
<script type="text/javascript">
var frmvalidator  = new Validator("form2");
frmvalidator.EnableOnPageErrorDisplay();
frmvalidator.EnableMsgsTogether();
frmvalidator.addValidation("revtitle","req","Please enter Title Review");
frmvalidator.addValidation("revcom","req","Please enter Title Opinion");
frmvalidator.addValidation("rate","selone","Please rate your review.");
</script>
';

?>
