<?php
namespace Traits;

trait Connection{
    protected static $db;

    public static function connect(){
        // global $DNS;
        try{
            //PDO connection
            self::$db = new \PDO(DNS,USER,PASSWORD);
            return self::$db;
        }
        catch(\Exception $e){
            error_log($e->getMessage()."\r\n",3,ROOT_PATH.'/error.txt');
            die('Unable to establish database connection');
        }
    }
}