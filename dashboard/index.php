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
    <link rel="shortcut icon" href="<?= SITE_FAVICON ?>" type="image/x-icon">
    <?php require_once "../core/inc/_header_script.php"; ?>
    <title>Dashboard</title>
</head>
<body>
    <Nav class="bg-success py-3 px-3">
        <div class="container">
            <div class="d-flex justify-content-between">
            <button class="mobile-icon btn btn-link text-white"><i class="lni lni-menu"></i></button>

            <div class="d-flex justify-content-around">
                <a class="text-white mr-3 p-2" href="<?= SITE_URL ?>"><i class="lni lni-home"></i></a> 
                <span class='p-2'>Hi, <?= ucwords($_SESSION['user']['username']) ?> </span>
            </div>
            </div>
        </div></Nav>
    <main class='d-flex' style="min-height:90vh;">
        <aside class="sidenav bg-success" style="min-hight:90%;">
            <ul class='text-white d-flex flex-column justify-content-evenly' style="list-style:none;">
                <li><a href="#"><i class="lni lni-dashboard"></i> Dashboard</a></li>
                <li><a href="#"><i class="lni lni-list"></i> Manage Post</a></li>
                <li><a href="#"><i class="lni lni-user"></i> Profile</a></li>
                <li><a href="#"><i class='fa-solid fa-arrow-right-from-bracket'></i> logout</a></li>
            </ul>
        </aside>
        <div class="container flex-grow-3 bg-dark shadow"></div>
    </main>
</body>
</html>