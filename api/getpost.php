<?php
require_once '../init.php';
use Controller\Post;
extract( $_GET );//Extract all the array keys as variables
if(!isset($q)){
    
    
}
$PostController = new Post();
$data = $PostController->getAllWithUser();
if($data){
    echo json_encode($data);
}else{
    echo json_encode(array("status"=> "error"));
}