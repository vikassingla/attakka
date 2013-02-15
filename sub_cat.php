<?php 
	include("header.php");
	$cat_id=$_GET['cat_id'];
?>
<script type="text/javascript">
function moderator(i)
{
	document.getElementById("mod").value=i;
	//alert(document.getElementById("mod").value);
	if(i==1)
	{
		document.getElementById("mode1").style.background="-moz-linear-gradient(center top , #eb594e 0%, #c12419 100%) repeat scroll 0 0 transparent";
		document.getElementById("mode1").style.border="1px solid #c12419";
		document.getElementById("mode").style.background="-moz-linear-gradient(center top , #454545 0%, #303030 100%) repeat scroll 0 0 transparent";
		document.getElementById("mode").style.border="1px solid #303030";
	}
	else
	{
		document.getElementById("mode").style.background="-moz-linear-gradient(center top , #eb594e 0%, #c12419 100%) repeat scroll 0 0 transparent";
		document.getElementById("mode").style.border="1px solid #c12419";
		document.getElementById("mode1").style.background="-moz-linear-gradient(center top , #454545 0%, #303030 100%) repeat scroll 0 0 transparent";
		document.getElementById("mode1").style.border="1px solid #303030";
	}	
}	
</script>

<div id="main-wrapper" style="padding-top:100px;">
<div class="white-wrapper">
<div style="padding:15px;">
<div class="red-color-heading">Sugest a <span class="black-color-heading">Subcategory</span></div>
<div class="clear"></div>
<form name="form2" id="form2" action="main.php" method="post" enctype="multipart/form-data">
<div id="left-panelform">
<input type="hidden" name="cat_id" value="<?php echo $cat_id?>">
<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>">
<div style="float:left;height:80px;">
	<div class="formpanel-text form-text">Subcategory Name:</div>
	<div class="inputpanel-right"><input type="text" class="input" style="width:275px;" name="subcatname" id="subcatname" onkeyup="emptyfield('form1_subcatname_errorloc')" onkeydown="emptyfield('form1_subcatname_errorloc')"/>
		<div class="error" id="form1_subcatname_errorloc" style="visibility:hidden;">Please enter valid Password</div>
	</div>
</div>
<div class="clear"></div>
<div style="float:left;height:50px;">
<div class="formpanel-text form-text">Submit  Image:<br/>
(1000 X 300)
</div>
<div class="inputpanel-right" style="margin-bottom:none;"><input type="file" name="subcatimg" id="subcatimg" class="input" id="subcatimg"/></div>
<div class="error" id="form1_subcatimg_errorloc" style="visibility:hidden;">Please enter valid Password</div>
</div>
<div class="clear"></div>
<div class="form-text" style="float:left;">Do you want to apply for Moderator (MOD)?   </div><input type="button" id="mode" name="mode" value="YES" class="button-form-new" style="margin-left:40px;" onclick="moderator(1)"><input type="button" class="button-form-new" name="mode1" id="mode1" value="N0" onclick="moderator(0)">
<input type="hidden" name="mod" id="mod">
<div class="clear"></div>
</div>
<div id="right-panelform">
<div style="float:left;height:110px;">
<div class="formpanel-text-right form-text">Description:</div>
  <div class="inputpanel-right2"> <textarea name="subcatdes" id="subcatdes" rows="3" class="textarea" style="width:270px;" onkeyup="emptyfield('form1_subcatdes_errorloc')" onkeydown="emptyfield('form1_subcatdes_errorloc')"></textarea>
  <div class="error" id="form1_subcatdes_errorloc" name="form1_subcatdes_errorloc" style="visibility:hidden;">Please enter valid Password</div> 
  </div>
  </div>
  <div class="clear"></div>
  
  <div style="float:left;height:80px;">
  <div id="right-panelform"><div class="formpanel-text-right form-text">Rules:</div>
  <div class="inputpanel-right2"> <textarea name="subcatrules" id="subcatrules" rows="1" class="textarea" style="width:270px;" onkeyup="emptyfield('form1_subcatrules_errorloc')" onkeydown="emptyfield('form1_subcatrules_errorloc')"></textarea> 
  <div class="error" id="form1_subcatrules_errorloc" name="form1_subcatrules_errorloc" style="visibility:hidden;">Please enter valid Password</div>
  </div>
  </div>
</div>

</div>
<div class="clear"></div>

<div><img src="images/line-flip.png" alt="#" /></div>
<div class="clear"></div>
<div align="center"><span style="margin-bottom:20px;">
<input name="createsubcat" type="submit" class="submit-buttons-round" value="Submit" />
&nbsp;
<input name="Clear" type="button" class="clear-button" value="Clear" onclick="document.location.reload(true)" />
</span></div>
</form>

</div></div>

<div class="clear"></div>

<script language="javascript" type="text/javascript">
var frmvalidator  = new Validator("form2");
frmvalidator.EnableOnPageErrorDisplay();
frmvalidator.EnableMsgsTogether();
frmvalidator.addValidation("subcatname","req","Please enter Category name");
frmvalidator.addValidation("subcatname","maxlen=50", "Maximum length for Sub Category Name is 50");

frmvalidator.addValidation("subcatimg","req_file","Please upload an image for Subcategory");
frmvalidator.addValidation("subcatimg","file_extn=jpg;gif;png","Allowed files types are: jpg;gif;png");

frmvalidator.addValidation("subcatrules","req","Please enter your rules");

frmvalidator.addValidation("subcatdes","req","Please enter your description");
  
 

</script>
<?php include("footer.php")?>
