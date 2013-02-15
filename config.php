<?php
if($_SERVER['HTTP_HOST'] == "localhost")
{
define("SITE_URL" ,	"http://localhost/attakka/development/attaka/");
define("SITE_PATH"	 ,	"/var/www/attaka/development/attaka/");
define("ADMIN_SITE_URL" ,	"http://localhost/attakka/development/attaka/admin");
define("DB_HOST"	 ,	"192.168.1.35");
define("DB_USER_NAME"	 ,	"shaveta");
define("DB_PASSWORD"	 ,	"shaveta");
define("DB_NAME"	 ,	"attaka");
}
else
{
define("SITE_URL" ,	"http://attakka.testebeta.com.br/");
define("SITE_PATH"	 ,	"/home/attakka/public_html/");
define("DB_HOST"	 ,	"localhost");
define("DB_USER_NAME"	 ,	"attakka");
define("DB_PASSWORD"	 ,	"1ATTakka2Y");
define("DB_NAME"	 ,	"attakka");
}?>
