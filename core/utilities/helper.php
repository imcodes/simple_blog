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

function logout(){
    if(isUserLoggedIn()){
        unset($_SESSION['user']);
        header("location:../auth");//redirect to login page
        exit();
    }
    return;
}