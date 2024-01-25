<?php
namespace Traits;

trait Connection{
    protected static $pdo;

    public static function connect(){
        // global $DNS;
        try{
            //PDO connection
            self::$pdo = new \PDO(DNS,USER,PASSWORD);
            return self::$pdo;
        }
        catch(\Exception $e){
            error_log($e->getMessage()."\r\n",3,ROOT_PATH.'/error.txt');
            die('Unable to establish database connection');
        }
    }
}