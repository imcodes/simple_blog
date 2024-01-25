<?php
# DEFINING CONSTANTS FOR OUR DATABASE CONNECTION
define('DRIVER','mysql');
define('HOST','localhost'); //sql host server
define('USER','root'); //sql user connection username
define('PASSWORD',''); //sql user connection password
define('DBNAME','demo_blogdb'); //Database name
define('DNS',DRIVER.":host=".HOST.";dbname=".DBNAME); //Database name
//$DNS = DRIVER.":host=".HOST.";dbname=".DBNAME;
//$DNS = "mysql:host=localhost;dbname=demo_blog";

