<?php include("header.php");?>
<script>
function showCat(str)
{	
document.getElementById('loading').style.display="block";
if (str=="")
  {
  document.getElementById("subcat").innerHTML="";
  return;
  }
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
		document.getElementById('loading').style.display="none";
    document.getElementById("subcat").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getcat.php?cat="+str,true);
xmlhttp.send();
}
</script>
<script>
function showAdd()
{
	window.location="create_category.php";
}
function showSubAdd(pid)
{
	document.getElementById("wrapper1").style.display="block";
	document.getElementById("cat_name").value=pid;
}

</script>
<script>
function addRecord()
{
	
	var term_name = document.getElementById("catname").value;	
	//alert(term_name);
	if(term_name == '')						
	{
		document.getElementById('propspectDiv').innerHTML='Enter a valid Name';	
		document.getElementById('propspectDiv').className="error";					
		return;
	}
	else
	{
		document.getElementById('propspectDiv').removeClass="error";			
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
				document.getElementById('propspectDiv').innerHTML=xmlhttp.responseText;
				document.getElementById("catname").value="";
				document.getElementById("wrapper").style.display="none";
				location.reload(); 
				
			}
		}
		xmlhttp.open("GET","data.php?cat="+term_name,true);
		xmlhttp.send();
	}
}

</script>
<script>
function addSubRecord()
{
	
	var subcatname = document.getElementById("subcatname").value;	
	var catname = document.getElementById("cat_name").value;
	//alert(subcatname+","+catname);
	if(subcatname == '')						
	{
		document.getElementById('propspectDiv1').innerHTML='Enter a valid Name';	
		document.getElementById('propspectDiv1').className="error";					
		return;
	}
	else
	{
		document.getElementById('propspectDiv1').removeClass="error";			
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
				document.getElementById('propspectDiv1').innerHTML=xmlhttp.responseText;
				document.getElementById("subcatname").value="";
				document.getElementById("wrapper1").style.display="none";
				location.reload(); 
				
			}
		}
		xmlhttp.open("GET","subdata.php?catname="+catname+"&subcatname="+subcatname,true);
		xmlhttp.send();
	}
}

function showAllCat(val)
{
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
	
	xmlhttp.open("GET","cat_data.php?type="+val,true);

	xmlhttp.send();
	
}

function showCatbytxt(val)
{
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
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById('catlist').innerHTML=xmlhttp.responseText;
			document.getElementById('catlist').style.display='block';
		
		}
	}
	
	xmlhttp.open("GET","cat_data.php?type=bytxt&cat="+val,true);

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
	showCat(id);
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
			<div style="margin-top:35px;margin-left:100px;">   
			
			<div id="img" name="img" style="display:none">
			<?
			{
				$sql="select cat_img from tbl_category where cat_id=".$_GET['cat'];
				echo $sql;
			?>
			<img src="">
			<?
			}
			?>
			</div>
				<form name="form1" id="form1" action="main.php" method="POST">
					<div style="float:left;height:50px;">
					<div class="formpanel-text form-text">Select a category:</div>
					<div class="inputpanel-rightCategory">
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
							<input onclick="showAllCat('bytxt');" onkeyup="showCatbytxt(this.value);" type="text" name="catinput" id="catinput" value="--select--" style=" border: medium none;     float: left;     height: 30px;     width: 218px;padding-left:4px;">
							<img src="images/select.png" style="float:right;margin-right:2px;margin-top:5px;" onclick="showAllCat('all');">
						</div>
						<div id="catlist" style="display:none; border-bottom: 1px solid #E4E2E2;     border-left: 1px solid #E4E2E2;     border-right: 1px solid #E4E2E2;     float: left;     height:auto;     width: 248px;background-color:#fff;z-index:100;margin-top: 33px;     position: absolute;"></div>
					
					</div>
					<div id="loading" style="display:none"><img src="images/ajax.gif"></div>
				</div>
				<div><input type="button" name="add" id="add" onclick="showAdd()" value="Add Category" class="submit-buttons-rec"></div>
			</div>
			<div id="wrapper" style="margin-top:35px;margin-left:100px;display:none;">
				<div class="formpanel-text form-text">Category Name:</div>
				<input type="text" id="catname" value="" class="input" style="width:237px;margin-right:30px;" >
				<input type="button" value="Submit" onclick="addRecord()" class="submit-buttons-rec" />
				<div id="propspectDiv"></div>
			</div>
			<div style="float:left;height:auto;margin-left:100px;margin-top:10px" name="subcat" id="subcat"></div>
			<div class="clear"></div>
		</div>
	</div>	


<?php include "footer.php"?>
</div>
