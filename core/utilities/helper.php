<?php
function isUserLoggedIn(){
    if(!isset($_SESSION["user"]) || !isset( $_SESSION["user"]['id'])){
        return false;
    }

    return true;
}

function validateLogin(){
    if(!isUserLoggedIn()){
        header("location:../auth");
        exit();
    }

    return;
}

/**
 * @param mixed $redirectTo //url for redirction
 * @param boolean $when //Redirect when True if user is loged in or False if user is not loged in
 */
function validateLoginRedirect($redirectTo, $when = true){
    if(isUserLoggedIn() === $when){
        header("location:$redirectTo");
        exit();
    }

    return;
}

function logout(){
    if(isUserLoggedIn()){
        unset($_SESSION['user']);
        header("location:../auth");//redirect to login page
        exit();
    }
    return;
}

function log_error($msg){
    error_log($msg."\r\n",3,ROOT_PATH.'/error.txt') ;
}

function display_message(Array|String $msg, $type = 'warning'){
    //$alert_type = $type == 'error'?'warning':'success';
    $d_msg = (is_array($msg)) ? '<h6>Oops! We have some error.</h6><ol><li>'.implode('</li><li>', $msg).'</li></ol>' : $msg;
    $display = <<<D
        <div class="my-3 alert alert-$type alert-dismissible" role="alert">
        $d_msg
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    D;

    return $display;
}

/**
 * @return Bool|Array if successfull otherwise returns an array of errors
 */
function handleFileUpload(
    Array $File, 
    String $target_dir, 
    String $filename = '', 
    Array $allowed_types = ['image/jpeg','image/jpg','image/png'],
    String $deleteOld = null
):Bool|Array{
    // $File = $req["FILES"];
    
    $file_ext = pathinfo($File['name'],PATHINFO_EXTENSION);
    $filetype = $File['type'];// get the meme_type

    //use the uploaded filename if the filename argument is empty
    $filename = (empty($filename)) ? $File['name'] : $filename;
    $upload_path = $target_dir.$filename;
    

    if(!in_array($filetype, $allowed_types)){
        $output = ['type_error'=>'Invalid file type: only '.implode(',',$allowed_types).' are allowed.'];
        return $output;
    }

    //check if the file upload path exists and create it if it doesn't
    if(!is_dir($target_dir) && !file_exists($target_dir)){
        mkdir($target_dir, recursive:true);
    }
    //Attempt to upload the file
    if(!move_uploaded_file($File['tmp_name'],$upload_path)){
        $output = ['upload_error'=> 'Unable to upload Post Image'];
        return $output;
    }

    if(!is_null($deleteOld) && !empty($deleteOld) && file_exists($deleteOld)){
        try{
            unlink($deleteOld);
        }catch(Exception $e){
            log_error("Unable to unlink an old filepath '$deleteOld'");
        }
    }

    return true;
}