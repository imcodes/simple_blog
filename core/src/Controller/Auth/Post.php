<?php
namespace Controller;
use Model\Post as P;
class Post{
    public function createPost($req){
        $output = ['status'=>false];

        $title = $req["title"];
        $content = $req["content"];

        // handle file
        $File = $req["FILE"];
        $target_dir = ASSET_DIR."img/posts/";
        $target_dir_url = ASSET_URL.'img/posts/';
        $allowed_types = ['jpeg','jpg','png'];

        $filetype = $File['fimage']['type'];
        $filename = $File['fimage']['name'];

        $upload_path = $target_dir.$filename;

        if(!in_array($filetype, $allowed_types)){
            $output['error'] = ['type_error'=>'Invalid file type: only '.implode(',',$allowed_types).' are allowed.'];
            return $output;
        }

        //check if the file upload path exists and create it if it doesn't
        if(is_dir($target_dir) && !file_exists($target_dir)){
            mkdir($target_dir,0, true);
        }
        //Attempt to upload the file
        if(!move_uploaded_file($File['fimage']['tmp_name'],$upload_path)){
            $output['error'] = ['upload_error'=> 'Unable to upload Post Image'];
            return $output;
        }

        // Store data in the database
        $data = [
            'title'=> $title,
            'content'=> $content,
            'image' => $target_dir_url.$filename,
            'user_id' => $_SESSION['user']['id'],
        ];
        $Post = new p();
        $nPost = $Post->create($data);
        $output['data'] = ['post' => $nPost];
    }
}