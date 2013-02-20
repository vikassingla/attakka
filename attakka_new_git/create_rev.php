<?php include("header.php");
$cat_id=$_GET['cat_id'];
$exist=isCreategoryIdExist($cat_id);
if($exist)
{
	print '
	<script>
	window.location.href="all_category.php";
	</script>
	';
}

?>


<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>

function showAllCat(val,id1)
{
	//alert("VALUE IS "+val);return false;
	//document.getElementById('catlist').style.display='none';
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			
			document.getElementById('catlist').innerHTML=xmlhttp.responseText;
			
			if(document.getElementById('catlist').style.display=='none')
			{
				document.getElementById('catlist').style.display='block';
			}
			else
			{
				document.getElementById('catlist').style.display='none';
			}		
		}
	}
	if(val == 'bytxt')
	{
		if(	document.getElementById('catinput').value='--select--')
		{
			document.getElementById('catinput').value='';
		}
	}
	
	xmlhttp.open("GET","cat_data.php?cat_id="+id1+"&type=all",true);

	xmlhttp.send();
	
}

function showCatbytxt(val,id1)
{
	//alert('sdssd'+val);return false;
	document.getElementById('catlist').style.display='none';
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		//alert(xmlhttp.responseText);return false;
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById('catlist').innerHTML=xmlhttp.responseText;
			document.getElementById('catlist').style.display='block';
		
		}
	}
	
	xmlhttp.open("GET","cat_data.php?cat_id="+id1+"&type=bytxt&reviewtitle="+val,true);

	xmlhttp.send();
	
}
function setCatColor(id)
{
	document.getElementById('catnamediv'+id).style.backgroundColor='#ccc';
}
function hideCatColor(id)
{
	document.getElementById('catnamediv'+id).style.backgroundColor='#fff';
}
function setCatText(val,id)
{
	document.getElementById('catlist').style.display='none';
	document.getElementById('catinput').value=val;
	//showCat(id);
}

function setCatTextNew(val)
{
	document.getElementById('catlist').style.display='none';
	document.getElementById('catinput').value=val;
}
function addReview()
{
	
	
	if(document.getElementById('catinput').value=="" || document.getElementById('catinput').value=='--select--')
	{
		alert('Plese Select the '+catname+' you want to review'); 
	}
	var rname=document.getElementById('catinput').value;
	rname=rname.toLowerCase();
	window.location.href="create_review.php?cat_id="+<?php echo $cat_id;?>+"&rname="+rname;
}
function addNewReview(txtval,catid)
{
	var txtVal=$('#catinput').val();
	var autoval=$('#form1').serialize();
	var autoval_url="create_newreview.php?create_flag=1";
	var getCatid=$('#hidcatid').val();
	//var autoval_url="get_alloptions.php?get_all_option=1&current_id="+getId;
	//$('#filter_srdiv').toggle();
	//alert(autoval);return false;
	if(autoval!="")
	{
		 $.ajax({
			type:"GET",
			url: autoval_url,
			data:autoval,
			dataType:'html',
			success:function(response)
			{
				//showAllCat('bytxt',getCatid);
				//document.getElementById('catinput').value
				document.getElementById('catnamediv100001').style.display='none';
			},
			error:function (response)
			{
				//alert('error');
			}
		});	
	}	
	
}

function checkReview()
{
	var catname='';
	var catname="<?php if(isset($cat_id)) { $catName=getCategoryDetail($cat_id); echo  $catName['cat_name'];}?>";
	
	var txtVal=$('#catinput').val();
	$.trim(txtVal);
	if(txtVal=="" || txtVal=='--select--')
	{
		alert('Plese Select the '+catname+' you want to review'); 
		return false;
	}
	else
	{
		var autoval=$('#form1').serialize();
		var autoval_url="check_review.php?check_flag=1";
		var getCatid=$('#hidcatid').val();
		 $.ajax({
			type:"GET",
			url: autoval_url,
			data:autoval,
			dataType:'html',
			success:function(response)
			{
				//alert(response);return false;
				if(response=='review not exist')
				{
					
				}
				else
				{
					if(response==0)
					{
						document.form1.submit();
					}
					else
					{
						alert('You have already reviewed '+txtVal);
					}
				}
			},
			error:function (response)
			{
				//alert('error');
			}
		});	
	}	
	
}

</script>

<div id="login-wrapper" style="width:750px;">
	<div style="margin-top:150px;">
	<?php
	if (isset($_GET['msg'])=='susub')
	{	
	$msg='Your review has been successfully submitted.';
	echo '<div class="white-wrapper-error" style="margin-left:15%;width:554px">'.$msg.'</div>';
	}
	?>
		<div class="white-wrapper" style="padding-bottom:15px;">
			<div class="red-color-heading"><span>Create a REVIEW</span></div> 
			<div style="margin-top:35px;margin-left:30px;">   
			
			<div id="img" name="img" style="display:none">
			<?
			{
				$sql="select cat_img from tbl_category where cat_id=".$_GET['cat'];
				//echo $sql;
			?>
			<img src="">
			<?
			}
			?>
			</div>
				<form name="form1" id="form1" action="create_review.php" method="POST">
					<div style="float:left;height:50px;">
					<?php if(isset($cat_id)) { $catName=getCategoryDetail($cat_id);}?>
					<div class="formpanel-text form-text" style="width:250px;">Which <?php echo $catName['cat_name'];?> would you like to review</div>
					<div class="inputpanel-rightCategory" style="width:400px;">
					<?php 
					/*
					$sql="select cat_id, cat_name from tbl_category where cat_active=1 and cat_parent_id=0 order by cat_id desc";
					$rs=mysql_query($sql);
				 	print'		
					<select name="cat" id="cat" class="input" style="width:250px" onchange="showCat(this.value)">';
					print '<option value="0" >--select--</option>';
					while($row=mysql_fetch_assoc($rs))
					{
					print '<option value="'.$row['cat_id'].'" onclick="showCat(this.value)">'.$row['cat_name'].'</option>';
					}
					print'</select>';
					*/
					?>
						<div id="catCantainer" style="border:solid 1px #E4E2E2;width:248px;height:31px;float:left;">
							<input onclick="showAllCat('bytxt','<?php echo $cat_id?>');" onkeyup="showCatbytxt(this.value, '<?php echo $cat_id?>');" type="text" name="catinput" id="catinput" value="--select--" style=" border: medium none;     float: left;     height: 30px;     width: 218px;padding-left:4px;">
							
						</div>
						<input type="button" value="Add Review" onclick="checkReview();" class="submit-buttons-rec" style="display:block;float:right;"/>
						<div id="catlist" style="display:none; border-bottom: 1px solid #E4E2E2;     border-left: 1px solid #E4E2E2;     border-right: 1px solid #E4E2E2;     float: left;     height:auto;     width: 248px;background-color:#fff;z-index:100;margin-top: 33px;     position: absolute;"></div>
						<input type="hidden" name="hidcatid" id="hidcatid" value="<?php if(isset($cat_id)) {echo $cat_id;}?>">
					</form>
					</div>
					<div id="loading" style="display:none"><img src="images/ajax.gif"></div>
				</div>
				
			</div>
			
			<div class="clear"></div>
		</div>
	</div>	


<?php include "footer.php"?>

