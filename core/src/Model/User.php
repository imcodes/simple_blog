<?php
namespace Model;

class User extends BaseModel{
    protected $tableName = 'users';

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

    public function update($userId,Array $data){}

    public function delete($userId){}

    public function findById($userId){}

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