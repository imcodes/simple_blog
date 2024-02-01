<?php
namespace Model;
use Traits\Connection;
class BaseModel{
    use Connection;
        protected $tableName;
        public $db;

    public function __construct(){
        $this->db = $this->db(); //establish and return the connection
         
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
        $stm = $this->db->query($sql);
        $result = $stm->fetchAll();
        return $result;
    }

    /**
     * Method to create a new user.
     */

     public function create(Array $data){
        $insert_columns = implode(',',array_keys($data));
        $insert_values = "'".implode("','",array_values($data))."'";
        $sql = "INSERT INTO {$this->getTableName()} ({$insert_columns}) VALUES({$insert_values})";
        $stm = $this->db->prepare($sql);
        if($stm->execute()){
            $get_user_sql = "SELECT * FROM {$this->getTableName()} WHERE id = {$this->db->lastInsertId()}";
            $stm = $this->db->prepare($get_user_sql);
            $stm->execute();
            return $stm->fetch();
        }
    }
}