<?php
include("config.php");
session_start();
   $db = new mysqli(DB_HOST, DB_USER_NAME,DB_PASSWORD,DB_NAME);
	
	if(!$db) {
	
		echo 'Could not connect to the database.';
	} else {
	
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			
			if(strlen($queryString) >0) {

				$query = $db->query("SELECT cat_name FROM tbl_category WHERE cat_name LIKE '$queryString%' LIMIT 10");
				$query1 = $db->query("SELECT review_title FROM tbl_review WHERE review_title LIKE '$queryString%' LIMIT 10");
				if($query) {
				echo '<ul>';
				
					while ($result = $query ->fetch_object()) {
	         			echo '<li onClick="fill(\''.addslashes($result->cat_name).'\');">'.$result->cat_name.'</li>';
	         		}
	         		while ($result = $query1 ->fetch_object()) {
	         			echo '<li onClick="fill(\''.addslashes($result->review_title).'\');">'.$result->review_title.'</li>';
	         		}
				echo '</ul>';
					
				} else {
					echo 'OOPS we had a problem :(';
				}
			}
			else 
			{
			
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>
