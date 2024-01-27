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
    $d_msg = (is_array($msg)) ? '<ol><li>'.implode('</li><li>', $msg).'</li></ol>' : $msg;
    $display = <<<D
        <div class="alert alert-$type">$d_msg</div>
    D;

    return $display;
}