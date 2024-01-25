<?php 
require_once "init.php";
use \Model\User;
$user = new User();
$post = new Model\Post();
$userlist = $user->getAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awesome Blog</title>
    <?php require_once "core/inc/_header_script.php"; ?>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <?php require_once "core/inc/nav.php"; ?>
    <?php foreach($userlist as $u){
        echo "<li> User: ".$u["username"]." pword: ".$u["password"]."</li>";
    }?>
<?php require_once "core/inc/_footer_script.php"; ?>
</body>
</html>