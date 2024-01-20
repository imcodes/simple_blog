<?php 
// require_once "core/constants.php";
require_once "vendor/autoload.php";

use Connect\Connect;
use \Model\User;
$user = new User();
$post = new Model\Post();
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
    <?php var_dump($post->getAll());?>
<?php require_once "core/inc/_footer_script.php"; ?>
</body>
</html>