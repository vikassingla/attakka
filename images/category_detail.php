<?php include("header.php");
$cat_id=$_GET['cat_id'];

$sql="select cat_id, cat_name from tbl_category where cat_id=".$cat_id;
//echo $sql;
$rs=mysql_query($sql);
$row=mysql_fetch_array($rs);

?>
<div class="internal-wrapper">
<div style="margin-top:100px;position:relative">
<?php
$sql1="select rev_img from tbl_review_image where rev_cat_id=".$cat_id." order by RAND()";
//echo $sql1;
$rs1=mysql_query($sql1);
$row1=mysql_fetch_array($rs1);
if($row1['rev_img']=="")
{
	$src="images/norevimage.jpg";
}
else
{
	$src="review_images/".$row1['rev_img'];
}		
?>
  <img src="<?php echo $src?>" alt="" class="image-border" />
  <h7 style="padding-left:10px;"><?php echo $row['cat_name']?></h7>
  
  </div>
			 
			 <div style="margin-top:40px; margin-bottom:20px;" ><img src="images/banner/banner-ad2.png" alt="#"  class="image-border"/></div>
			 
			 <div class="clear"></div>
             
             <!--slider content-->
             <script type="text/javascript">
/* RSID: */
var s_account="applebrglobal"
</script>


<script type="text/javascript" src="global/metrics/js/s_code_h.js"></script>


<div id="main" data-hires="true" style="z-index:15000;">
		<div class="productbrowser content grey-back-new" id="pb-mac">
         <div class="pb-pageindicator roundedbottom" id="pb-pi-mac"><div>
		<b class="caret"></b>
		<a class="page">Bairros</a>
		<a class="page"> Comida</a>
		<a class="page">Preços</a>
		
	</div></div>
	<!--<div class="pb-slider">
		<div class="pb-slide">
			<ul class="ul-slider">
				<li class="pb-macbookair"><a href="restaurant-categories-Bairros.html">Copacabana</a></li>
				<li class="pb-macbookpro"><a href="#">Ipanema</a></li>
				<li class="pb-macmini"><a href="#">Tijuca</a></li>
				<li class="pb-imac"><a href="#">Barra</a></li>
				<li class="pb-macpro"><a href="#">Leblom</a></li>
				<li class="pb-macosx"><a href="#">Botafogo</a></li>
                <li class="pb-macosx"><a href="#">Flamengo</a></li>
                <li class="pb-macosx"><a href="#">Humaita</a></li>
                <li class="pb-macosx"><a href="#">Urca</a></li>
			</ul>

			<ul class="ul-slider">
				<li class="pb-ilife"><a href="#">Tailandesa</a></li>
				<li class="pb-iwork"><a href="#">Japonesa</a></li>
				<li class="pb-safari"><a href="#">Italiana</a></li>
				<li class="pb-aperture"><a href="#">Portuguesa</a></li>
				<li class="pb-finalcut"><a href="#">Kilo</a></li>
				<li class="pb-logicpro"><a href="#">Pizzaria</a></li>
                <li class="pb-logicpro"><a href="#">Rodizio</a></li>
                <li class="pb-logicpro"><a href="#">Churrascaria</a></li>
                <li class="pb-logicpro"><a href="#">Chinesa</a></li>
                <li class="pb-logicpro"><a href="#">Brasileira</a></li>
			</ul>

			<ul class="ul-slider">
				<li class="pb-keyboard"><a href="#">Pe sujo</a></li>
				<li class="pb-magicmouse"><a href="#">Caro Demais</a></li>
				<li class="pb-magictrackpad"><a href="#"> Na conta</a></li>
				
			</ul>

			
		</div>
	</div>-->

	
</div>
<script src="global/scripts/productbrowser.js" type="text/javascript" charset="utf-8"></script>

	<!--/showcase-->


  </div>
             <!--slider content-->
             
             
             <div class="clear"></div>
             
               <div class="bestfive-panel">
  <h12>Best Five</h12>
</div>

       <div class="worsefive-panel-new">
  <h14>worse Five</h14>
</div>

<div class="clear"></div>

 <div id="left-panel-restaurantcategories"><iframe src="scroller-left-restaurant.php?cat_id=<?php echo $cat_id?>" allowtransparency="0" width="470" height="520" frameborder="0" scrolling="no"></iframe></div>
 
  <div id="right-panel-restaurantcategories"><iframe src="scroller-right-restaurant.php?cat_id=<?php echo $cat_id?>" allowtransparency="0" width="465" height="520" frameborder="0" scrolling="no"></iframe></div> 	
  <div class="clear"></div>
  <div class="grey-round-bar heading-black">
  <div style="padding-left:5px;"><a style="text-decoration:none;" class="black-button" href="#">HOT</a> <a style="text-decoration:none; padding-right:20px;" class="heading-black" href="#">NEW</a> <a style="text-decoration:none; padding-right:20px;" class="heading-black" href="#">RANK</a> <a style="text-decoration:none; padding-right:20px;" class="heading-black" href="#">FANS</a></div> 
  </div>
                
        <div class="clear"></div>
                
                <div class="heading-nov19">
  <h8>Name</h8>
</div>

<div class="notes-panelnov19">
  <h10>Notes</h10>
</div>

<div class="rates-panelnov19">
  <h11>Rates</h11>
</div>
                
                
                <div class="clear"></div>
                
                    <!--row 1-->
			 <div class="border-round">
			  <div class="images-left-panel views-field round-img-worst"><img src="images/rest-img1.png"  border="0" alt="#" /><div class="top-shadow-back" style="padding-left:14px; margin-top:-67px;">Savoy Hotel </div></div>
			  <div class="notes-panel middle-text"><div class="internal-panel" style="margin-top:20px;">
<div class="panel">
<p style=" position: relative; top: -50%"> The Savoy Hotel's Thames Foyer (restaurant and tea room), located on the Strand in central London. It was the first luxury hotel in Britain, </p>
</div>
</div> </div>

<div class="rate-panel" align="right"><img src="images/rate/rate2.png" alt="#" class="rate-img" border="0"  /></div>
			  	  
  </div>
<!--row 1-->
		<div class="clear"></div>
		
		
		
			<!--row 2-->
			 <div class="border-round">
			  <div class="images-left-panel views-field round-img-best"><img src="images/rest-img2.png"  alt="#" /><div class="top-shadow-back" style="padding-left:14px; margin-top:-67px;">Montenegro, Budva, main beach</div></div>
			  <div class="notes-panel middle-text"><div class="internal-panel">
<div class="panel" >
<p style=" position: relative; top: -50%"> Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.  Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero.</p>
</div>
</div> </div>

<div class="rate-panel" align="right"><img src="images/rate/rate4.png" alt="#" class="rate2plus" /></div>
			  	  
  </div>
<!--row 2-->
		<div class="clear"></div>
		
		<!--row 3-->
			 <div class="border-round">
			  <div class="images-left-panel views-field round-img-grey"><img src="images/rest-img3.png"  alt="#" /><div class="top-shadow-back" style="padding-left:14px; margin-top:-67px;">Naviglio Grande canal</div></div>
			  <div class="notes-panel middle-text"><div class="internal-panel" >
<div class="panel">
<p style=" position: relative; top: -50%"> Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. </p>
</div>
</div> </div>

<div class="rate-panel" align="right"><img src="images/rate/rate-review0-new.png" alt="#" class="rate-img" /></div>
			  	  
  </div>
<!--row 3-->

<div class="clear"></div>


<!--row 4-->
			 <div class="border-round">
			  <div class="images-left-panel views-field round-img-worst"><img src="images/rest-img4.png"  alt="#" /><div class="top-shadow-back" style="padding-left:14px; margin-top:-67px;">Bar restaurant Caffe'Letterario</div></div>
			  <div class="notes-panel middle-text"><div class="internal-panel">
<div class="panel">
<p style=" position: relative; top: -50%"> Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem.</p>
</div>
</div> </div>

<div class="rate-panel" align="right"><img src="images/rate/rate4-new.png" alt="#" class="rate-img" /></div>
			  	  
  </div>
<!--row 4-->

<div class="clear"></div>

<!--row 5-->
			 <div class="border-round">
			  <div class="images-left-panel views-field round-img-best"><img src="images/rest-img5.png"  alt="#" /><div class="top-shadow-back" style="padding-left:14px; margin-top:-67px;">Asahi Japanese Restaurant</div></div>
			  <div class="notes-panel middle-text"><div class="internal-panel" style="margin-top:15px;">
<div class="panel">
<p style=" position: relative; top: -50%"> Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. </p>
</div>
</div> </div>

<div class="rate-panel" align="right"><img src="images/rate/rate4.png" alt="#" class="rate-img" /></div>
			  	  
  </div>
<!--row 5-->


<!--row 6-->
			 <div class="border-round">
			  <div class="images-left-panel views-field round-img-best"><img src="images/rest-img6.png"  alt="#" /><div class="top-shadow-back" style="padding-left:14px; margin-top:-67px;">Mural in Washington</div></div>
			  <div class="notes-panel middle-text"><div class="internal-panel" >
<div class="panel">
<p style=" position: relative; top: -50%">Mural illustrating American clergyman, activist, and prominent leader in the African-American Civil Rights Movement Martin Luther King, Jr., in a restaurant in an African-American neighborhood of Washington. </p>
</div>
</div> </div>

<div class="rate-panel" align="right"><img src="images/rate/rate1plus.png" alt="#" class="rate-img" /></div>
			  	  
  </div>
<!--row 6-->
</div>
                
                
           
            
            <div class="clear"></div>
<?php include ("footer.php")?>

