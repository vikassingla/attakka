<?php
$host="localhost"; // Host name 
$username="attakka"; // Mysql username 
$password="1attakka2"; // Mysql password 
$db_name="attakka"; // Database name 
$tbl_name="member_info"; // Table name


// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$home_link="http://aubih.edu.ba/pad_application";
?>