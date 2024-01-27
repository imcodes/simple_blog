<?php require_once "../vendor/autoload.php";
use Controller\Auth\Register;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $Register = new Register();
    $result = $Register->register($_REQUEST);
    $msg = implode(',',$result['msg']);
        
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <?php require_once "../core/inc/_header_script.php"; ?>
    <link rel="stylesheet" href="../assets/css/auth.css">

</head>
<body>
    <div class="container  w-75">
        <div class="auth-header">
            <div class="logo">
                <img class='white-mono' src="<?= SITE_LOGO ?>" alt="Official Logo">
            </div>
            <h1 data-answer="mytitle" class="auth-title mb-2 mt-1">Member Registration</h1>
        </div>
        
        <form action="#" method="post" name="Register-Form">
            <div class='alert alert-warning'>
                <?php
            if($msg === "Please fill all required fileds" || "Username already taken"){
                echo $msg;
            }
                ?>
            </div>
            <div class="row mx-2">
                <div class="form-group col-12 col-md-4">
                    <label for="fname"><i class="fa-regular fa-user"></i> Full Name <span>*</span></label>
                    <input type="text" id="fname" name="fname" value="<?= (isset($_POST['fname'])) ? $_POST['fname'] : '' ?>" required placeholder="first-name">
                </div>
                <div class="form-group col-12 col-md-4">
                <label for="mname"><i class="fa-regular fa-user"></i> Middle Name </label>
                    <input type="text" value='<?= (isset($_POST['mname'])) ? $_POST['mname'] : '' ?>' id="mname" name="mname" placeholder="middle-names">
                </div>
                <div class="form-group col-12 col-md-4">
                <label for="lname"><i class="fa-regular fa-user"></i> Last Name <span>*</span></label>
                    <input type="text" value="<?= (isset($_POST['lname'])) ? $_POST['lname'] : '' ?>" id="lname" name="lname" required placeholder="surname">
                </div>
            </div>

           

            <div class="row mx-2">
                <div class="col-12 col-md-6 form-group">
                    <label for="username">Username <span>*</span></label>
                    <input type="text" id="username" name="username" value="<?= (isset($_POST['username'])) ? $_POST['username'] : '' ?>" required placeholder="Enter username">
                </div>
                <div class="col-12 col-md-6 form-group">
                <div class='bg-warning'>
                <?php
            if($msg === "Email already taken"){
                echo $msg;
            }
                ?>
            </div>
             <label for="email">Email <span>*</span></label>
                    <input type="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>" id="email" name="email" required placeholder="example@domain.com">
                </div>
            </div>
            <div class='text-danger'>
                <?php
            if($msg === "Password Mismatch"){
                echo $msg;
            }
                ?>
            </div>
            <div class="row mx-2"> 
            
                <div class="col-12 col-md-6 form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="<?= (isset($_POST['password'])) ? $_POST['password'] : '' ?>"required placeholder="Enter Password">
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label for="c-password">Confirm Password</label>
                    <input type="password" name="c-password" id="c-password" required value="<?= (isset($_POST['c-password'])) ? $_POST['c-password'] : '' ?>" placeholder="Repeat Password">
                </div>
            </div>

            <div class="action-group my-4">
                <button class="btn w-50" type="submit">Register &rarr;</button>&nbsp;
                <button class="btn w-50" type="reset">Clear</button>
            </div>
            <div class="mb-1 text-center">
                <span class="col-12 col-md-4 small-text">Already have an account <a href="../auth" title="Click here to login">Login here</a></span>
            </div>

        </form>
    </div>

    <?php require_once('../core/inc/_footer_script.php'); ?>
</body>
</html>