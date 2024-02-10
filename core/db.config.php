<?php

# DEFINING CONSTANTS FOR OUR LOCAL DATABASE CONNECTION
/* define('DRIVER','mysql');
define('HOST','localhost'); //sql host server
define('PORT','3306');
define('USER','root'); //sql user connection username
define('PASSWORD',''); //sql user connection password
define('DBNAME','demo_blogdb'); //Database name */

# DEFINING CONSTANTS FOR OUR REMOTE DATABASE CONNECTION
define('DRIVER','mysql');
define('HOST','newsreader-mysql-db-service-newsreader-db.a.aivencloud.com'); //sql host server
define('PORT','11657');
define('USER','avnadmin'); //sql user connection username
define('PASSWORD','AVNS__GH0OFaxCje-LY6Wv6L'); //sql user connection password
define('DBNAME','demo_blogdb'); //Database name


define('DNS',DRIVER.":host=".HOST.";port=".PORT.";dbname=".DBNAME); //Database name
//$DNS = DRIVER.":host=".HOST.";dbname=".DBNAME;
//$DNS = "mysql:host=localhost;dbname=demo_blog";

