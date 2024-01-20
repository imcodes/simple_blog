<?php
include_once "config.php";
define('ROOT_PATH',realpath(dirname(__DIR__)));
define('ROOT_DIR',basename(dirname(__DIR__)));
define('ASSET_DIR',ROOT_DIR."/assets/");
define('ASSET_URL',"/".ROOT_DIR."/assets/");

if($_SERVER['HTTP_HOST'] === 'localhost'){
    define('SITE_URL',$_SERVER['HTTP_HOST'].'/'.ROOT_DIR.'/');
}else{
    define('SITE_URL',$_SERVER['HTTP_HOST'].'/');
}
define('SITE_LOGO',ASSET_URL."img/logo.png");
