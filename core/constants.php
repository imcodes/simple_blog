<?php
// Require Database Constants
require_once "db.config.php";

define('ROOT_PATH',realpath(dirname(__DIR__)));
define('ROOT_DIR',basename(dirname(__DIR__)));
define('ASSET_DIR',ROOT_DIR."/assets/");
define('ASSET_URL',"/".ROOT_DIR."/assets/");

if($_SERVER['HTTP_HOST'] === 'localhost'){
    define('SITE_URL','http://'.$_SERVER['HTTP_HOST'].'/'.ROOT_DIR.'/');
}else{
    define('SITE_URL','http://'.$_SERVER['HTTP_HOST'].'/');
}

define('SITE_LOGO',ASSET_URL."img/logo.png");
define('SITE_FAVICON',ASSET_URL."img/logo.png");
