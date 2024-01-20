<?php
namespace Model;
use Traits\Connection;
class BaseModel{
    use Connection;
        protected $tableName;

    public function __construct(){
        $this->db(); //establish and return the connection
    }

    public function db(){
        return Connection::connect();
    }

    public function getTableName(){
        return $this->tableName;
    }

    //Method to get all items
    public function getAll(Int $limit = 100,Array $fields = []){
        $field = (count($fields) > 0) ? implode(',',$fields) : '*';
        $sql = "SELECT $field FROM {$this->getTableName()} LIMIT $limit";
        $stm = $this->db()->query($sql);
        $result = $stm->fetchAll();
        return $result;
    }
}