<?php
namespace Model;
use PDO;

class Post extends BaseModel{
    protected $tableName = 'posts';
    protected $relation = 'users';

    public function getWithUser(Array $by = [], $columns = ['*'],$user_columns = ['*']){
        $postColumns = implode(',', $columns);

        if (!str_contains( $postColumns, 'user_id') && !in_array('*', $columns) ) {
            $postColumns .= ', user_id';
        }
        $userColumns = implode(',', $user_columns);

        $sql = "SELECT {$postColumns} FROM {$this->getTableName()}";
        $sql .= (!empty($by)) ? " WHERE {$by[0]} = '{$by[1]}'":"";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(!$posts){
            log_error($stmt->errorInfo());
            return false;
        }
        $data = [];
        foreach( $posts as $post ){
            $sql = "SELECT {$userColumns} FROM {$this->relation} WHERE id = '{$post['user_id']}'";
    
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$user){
                $post['user'] = null;
                $data[] = $post;
                continue;
            }
            $post['author'] = $user['username'];
            $post['userInfo'] = $user;
            $data[] = $post;
        }

        return $data;
    }

    public function searchWithUser( Array $by, $compare = 'and', $columns = ['*'],$user_columns = ['*'] ):Array|Bool {
        $userColumns = implode(', ', $user_columns);
        //Always ensure that we get the user_id column in the search due to the relationship
        if (!in_array('*', $columns) && !in_array('user_id',$columns) ) {
            array_push($columns,'user_id');
        }
        $posts = $this->search($by,$compare,$columns);
        if(!$posts){
            return false;
        }
        //Get the related relationship
        $data = [];
        foreach( $posts as $post ){
            $sql = "SELECT {$userColumns} FROM {$this->relation} WHERE id = '{$post['user_id']}'";
    
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$user){
                $post['user'] = null;
                $data[] = $post;
                continue;
            }
            $post['author'] = $user['username'];
            $post['userInfo'] = $user;
            $data[] = $post;
        }

        return $data;

    }

    /* {
        [
            'id' => 1,
            'title' = > 'whatever the title is',
            'user' => [
                'id'=> 1,
                'fname' => 'first name',
                'sname' => 'surname'
            ]
        ],
        [
            'id' => 1,
            'title' = > 'whatever the title is',
            'userid'=> 1,
            'fname' => 'first name',
            'sname' => 'surname'
            
        ]
    } */


}