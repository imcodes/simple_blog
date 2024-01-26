<?php
namespace Model;

class User extends BaseModel{
    protected $tableName = 'users';

    public function create(Array $data){}

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