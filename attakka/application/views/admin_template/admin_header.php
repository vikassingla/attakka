<?php  
$session_data =  get_session_data();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                    "http://www.w3.org/TR/html4/loose.dtd">
                    
  <html>                  
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title><?php if(isset($title)) { echo $title;}?></title>	
    <base href="<?php echo base_url();?>" >
    <link rel="stylesheet" href="css/style_admin.css" type="text/css" media="all" />
</head>
<body>

             
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
			<h1><a href="#">attakka</a></h1>
            
			<div id="top-navigation">
            <?php if(isset($session_data['admin_loged_in'])) { ?>
				Welcome <a href="admin/profile_setting"><strong><?php echo $session_data['admin_first_name']." ".$session_data['admin_last_name'];?></strong></a>
				<span>|</span>			
				<a href="admin/profile_setting">Profile Settings</a>
				<span>|</span>
                <?php 
			}
				?>
           
               <?php if(isset($session_data['admin_loged_in'])) { ?>    
				<a href="admin/log_out">Log out</a>
                   <?php 
			}else{
				?>
                	<a href="admin">Log in</a>
                 <?php 
			}
				?>
			</div>
            
		</div>
		<!-- End Logo + Top Nav -->
        
		<!-- Main Nav -->
		<div id="navigation">
           <?php if(isset($session_data['admin_loged_in'])) { ?>
			<ul>
			    <li><a href="admin/dashboard" class="active"><span>Dashboard</span></a></li>
			    <li><a href="category"><span>Category List</span></a></li>
			    <li><a href="sub_category"><span>Sub Category List</span></a></li>
                <li><a href="admin/user_list"><span>User List</span></a></li>	
			    <li><a href="admin/review_list"><span>Review List</span></a></li>	
  			    <li><a href="banner"><span>Banner List</span></a></li>			 		  
			</ul>
            <?php } ?>
		</div>
		<!-- End Main Nav -->
	</div>
</div>
<!-- End Header -->
