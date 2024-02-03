<?php
namespace Controller;
use Model\Post as P;
class Post{
    public function createPost($req){
        $output = ['status'=>false];

        //Remove white space and other chars from the begining and end of each input string
        $title = ucwords(trim($req["title"]));
        $content = trim($req["content"]);

        //Check for required fields
        if(empty($title)){ 
            $output['error'] = ['title' => 'The Title field must not be empty'];
            return $output;
        }
        if(empty($content)){ 
            $output['error'] = ['content' => 'The Blog post Must have a conntent'];
            return $output;
        }

        // handle file only if it was uploaded.
        if(!empty($req['FILES']['fimage']['name'])){
            $File = $req["FILES"];
            $target_dir = ASSET_PATH."img/posts/";
            $target_dir_url = ASSET_URL.'img/posts/';
            $allowed_types = ['image/jpeg','image/jpg','image/png'];

            $file_ext = pathinfo($File['fimage']['name'],PATHINFO_EXTENSION);
            $filetype = $File['fimage']['type'];// get the meme_type
            //Define the name to store our image with
            $filename_arr = str_word_count(strtolower($title),1);//return all words in array
            $filename = array_splice($filename_arr,0,3); // get the first 3 arrays from the word array
            $filename = implode('_', $filename).'_'.time().'.'.$file_ext; //Join the array with _ and concatenate with timestamp and file extension
            
            $upload_path = $target_dir.$filename;

            if(!in_array($filetype, $allowed_types)){
                $output['error'] = ['type_error'=>'Invalid file type: only '.implode(',',$allowed_types).' are allowed.'];
                return $output;
            }

            //check if the file upload path exists and create it if it doesn't
            if(!is_dir($target_dir) && !file_exists($target_dir)){
                mkdir($target_dir, recursive:true);
            }
            //Attempt to upload the file
            if(!move_uploaded_file($File['fimage']['tmp_name'],$upload_path)){
                $output['error'] = ['upload_error'=> 'Unable to upload Post Image'];
                return $output;
            }
        }

        // Store data in the database
        $data = [
            'title'=> $title,
            'content'=> $content,
            'image' => (isset($filename)) ? $target_dir_url.$filename : null,
            'user_id' => $_SESSION['user']['id'],
        ];
        $Post = new p();
        $nPost = $Post->create($data);
        if(!$nPost){
            $output['error'] = ['sql_error'=>"Oops! Unable to create post"];
            return $output;
        }

        $output['status'] = true;
        $output['data'] = ['post' => $nPost];
        return $output;
    }

    public function getAllWithUser(Array $by = [], $columns = ['*'],$user_columns = ['*']){
        $post = new P();
        $records = $post->getWithUser($by,$columns,$user_columns);
        if($records){
           
            return $records;
        }
    }
}