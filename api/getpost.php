<?php
require_once '../init.php';
use Controller\Post;
//extract( $_GET );//Extract all the array keys as variables
$PostController = new Post();
if(isset($_REQUEST['q'])){
    $q = $_REQUEST['q'];
    $data = $PostController->getSearchWithUser([
        'title'=>[$q,'like'],
        'content' => [$q,'like']
    ],'or');
    
}else{
    //Get all post records
    $data = $PostController->getAllWithUser();
}

echo ($data) ? json_encode($data) : json_encode(array("status"=> "error"));

// if($data){
//     echo json_encode($data);
// }else{
//     echo json_encode(array("status"=> "error"));
// }
