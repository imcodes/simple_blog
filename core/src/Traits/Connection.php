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
            log_error($e->getMessage());
            die('Unable to establish database connection');
        }
    }
}