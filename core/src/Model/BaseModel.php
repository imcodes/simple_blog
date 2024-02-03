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
     * @return Array|Bool
     */

     public function create(Array $data):Array|Bool{
        $insert_columns = implode(',',array_keys($data));
        $insert_values = "'".implode("','",array_values($data))."'";
        $sql = "INSERT INTO {$this->getTableName()} ({$insert_columns}) VALUES({$insert_values})";
        $stm = $this->db->prepare($sql);
        if($stm->execute()){
            $get_model_sql = "SELECT * FROM {$this->getTableName()} WHERE id = {$this->db->lastInsertId()}";
            $stm = $this->db->prepare($get_model_sql);
            $stm->execute();
            return $stm->fetch();
        }else{
            log_error($stm->errorInfo());
            return false;
        }
    }

    public function find(Array $by = [], Array $columns = ['*']){
        if(empty($by)){ return false;}

        $columns = implode(',', $columns);
        $query = "SELECT {$columns} FROM {$this->getTableName()} WHERE ";
        foreach ($by as $key => $value){
            $query .= "{$key} = {$value}";
        }

        $stm = $this->db->prepare($query);
        $result = $stm->execute()->fetchAll();
        return $result;
    }

    public function exists($column, $value){
        $query = "SELECT $column FROM {$this->getTableName()} WHERE $column = ?";
        $stm = $this->db->prepare($query);
        $stm->execute([$value]);
        $result = $stm->rowCount();

        return (bool)$result;

    }
}