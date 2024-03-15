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
        $insert_param = ':'.implode(', :',array_keys($data));
        // $insert_values = "'".implode("','",array_values($data))."'";
        $sql = "INSERT INTO {$this->getTableName()} ({$insert_columns}) VALUES({$insert_param})";
        $stm = $this->db->prepare($sql);
        foreach ($data as $column => $value){
            $stm->bindValue(":$column", $value);
        }
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

    public function update(Array $data, $id){
        // $update_columns = implode(",",array_keys($data));
        $set_columns = '';
        foreach($data as $key => $value){
            $set_columns .= "$key = :$key";
            $set_columns .= ($key !== array_key_last($data)) ? "," : "";
        }

        $sql = "UPDATE {$this->getTableName()} SET $set_columns  WHERE id = :id";
        $stm = $this->db->prepare($sql);
        // die($sql);
        foreach ($data as $column => $value){
            $stm->bindValue(":$column", $value);
        }
        $stm->bindValue(':id',$id);
        return ($stm->execute()) ? true : false;
    }

public function delete($id){
    $sql = "DELETE FROM {$this->getTableName()} where id = $id";
    $smt = $this->db->prepare($sql);
    return ($smt->execute()) ? true : false;
}    

/**
 * @param $by receives an associative array where the key is the database to column and the value is an indexed array
 * eg: ['id'=>[4],'created_at'=['2023-01-24','<'],'username'=>[('user1','user2'),in]]
 * @param $compare: Holds the comparison between the two search statements Accepted values ['and' | 'or']. Default: and
 * @param $columns: Takes array of columns to be returned by search query default is [*]
 * @return Array,Bool: Returns an array of data if found or false if not found.
 */
public function search(Array $by, $compare = 'and', Array $columns = ['*']):Array|Bool{
    $columns = implode(', ',$columns);
    $whereClause = '';
    foreach($by as $key => $value){
        $operator = (isset($value[1])) ? $value[1] : '=';
        $searchStr = (strtolower($operator) === 'like')? "%{$value[0]}%" : $value[0];
        $whereClause .= "$key $operator '$searchStr'";
        if(array_key_last($by) != $key){
            $whereClause .= " $compare ";
        }
    }
    $sql = "SELECT $columns FROM {$this->getTableName()} WHERE $whereClause";
    // die($sql);
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    if(!$posts){
        log_error($stmt->errorInfo());
        return false;
    }
    return $posts;
}
//['title'=>['value','='],'content'=>['keyword','<']]
//SELECT * FROM TABLE WHERE column LIKE %keyword% and

    /**
     * @param Array $by
     * @param $columns
     * @return Bool|Array returns false if error occurs or record found, otherwise returns array of data
     */
    public function find(Array $by = [], Array $columns = ['*']):Array|Bool{
        if(empty($by)){ return false;}

        $columns = implode(',', $columns);
        $query = "SELECT {$columns} FROM {$this->getTableName()} WHERE ";
        foreach ($by as $key => $value){
            $query .= "{$key} = {$value}";
        }

        $stm = $this->db->prepare($query);
        $result = $stm->execute();
        return ($result) ? $stm->fetchAll(\PDO::FETCH_ASSOC) : false;
    }

    public function findById($id, Array $columns = ['*']){
        $data = $this->find(['id' => $id],$columns);
        return ($data) ? $data[0] : false;
    }

    public function exists($column, $value){
        $query = "SELECT $column FROM {$this->getTableName()} WHERE $column = ?";
        $stm = $this->db->prepare($query);
        $stm->execute([$value]);
        $result = $stm->rowCount();

        return (bool)$result;

    }
}