<?php
require_once "../init.php";
//check if the user is logged in, if not, redirect to login
validateLogin(); //

//Get the page name from the url params
$default_page = "dashboard.php";
$page_name = (isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'].".php" : $default_page;
$page_name = 'pages/'.$page_name;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= SITE_FAVICON ?>" type="image/x-icon">
    <?php require_once "../core/inc/_header_script.php"; ?>
    <link rel="stylesheet" href="<?= ASSET_URL.'css/dashboard.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/css/dropify.min.css">
    <!-- Datatable -->
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/r-2.5.0/datatables.min.css" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
    
    <main class='d-flex' style="min-height:100vh;">
    <!-- Side Navigation -->
        <aside class="d-none d-md-block sidenav pt-3 bg-header">
            <div class="logo ms-3">
                <img class='white-mono' src="<?= SITE_LOGO ?>" alt="Official Logo">
            </div>
            <ul class='nav flex-column gap-2 mt-3'>
                <li class="nav-item"><a class="nav-link link-light link-opacity-75-hover" href="<?= SITE_URL.'dashboard'?>"><i class="lni lni-dashboard"></i> <span class="ms-2 link-title">Dashboard</span></a></li>
                <li class="nav-item "><a class="nav-link link-light link-opacity-75-hover" href="<?= SITE_URL.'dashboard?page=manage-post'?>"><i class="lni lni-list"></i> <span class="ms-2 link-title">Manage Post</span></a></li>
                <li class="nav-item "><a class="nav-link link-light link-opacity-75-hover" href="<?= SITE_URL.'dashboard?page=profile'?>"><i class="lni lni-user"></i> <span class="ms-2 link-title">Profile</span></a></li>
                <li class="nav-item "><a class="nav-link link-light link-opacity-75-hover" href="<?= SITE_URL.'auth/logout.php'?>"><i class='fa-solid fa-arrow-right-from-bracket'></i> <span class="ms-2 link-title">Logout</span></a></li>
            </ul>
        </aside>

        <div class="flex-fill">
            <!-- Top Navigation -->
            <Nav class="bg-dark shadow-sm py-3 px-3">
                <div class="container">
                    <div class="d-flex justify-content-between">
                    <button class="mobile-icon btn btn-link text-white"><i class="lni lni-menu"></i></button>

                    <div class="nav justify-content-end gap-3">
                        <a class="link-light nav-item" data-bs-custom-class="custom-tooltip" data-bs-placement="left" data-bs-title="Visit Home" data-bs-toggle="tooltip" href="<?= SITE_URL ?>"><i class="lni lni-home"></i></a> 
                        <span class=''>Hi, <?= ucwords($_SESSION['user']['username']) ?> </span>
                    </div>
                    </div>
                </div>
            </Nav>

            <!-- Main Content -->
            <div class="container">
                <?php include_once $page_name; ?>
            </div>
        </div>
    </main>

    <?php require_once "../core/inc/_footer_script.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();
    </script>

<script src="https://cdn.tiny.cloud/1/esmy1m490b80wgrof2310i27745h16qblysc1xt4339ns830/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Datatable Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/r-2.5.0/datatables.min.js"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: 'textarea.tiny-editor',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
</script>
</body>
</html>