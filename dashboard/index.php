<?php
require_once "../init.php";
//check if the user is logged in, if not, redirect to login
validateLogin(); //
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>HI, <?= $_SESSION['user']['username'] ?> WELCOME TO YOUR DASHBOARD
</body>
</html>