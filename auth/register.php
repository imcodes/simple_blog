<?php require_once "../init.php";
use Controller\Auth\Register;
validateLoginRedirect('../'); //Redirect to dashboard when Logged in
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $Register = new Register();
    $result = $Register->register($_REQUEST);
    $isSuccess = $result['status'];
    $reg_data =(!$isSuccess) ? $result['msg'] : $result['data'];
    //Clear the form data on success
    $_POST = ($isSuccess) ? [] : $_POST;
        
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= SITE_FAVICON ?>" type="image/x-icon">
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
            
                <?php
                $msg='';
            if(isset($reg_data)){
                $general_err = (!$isSuccess && array_key_exists('required',$reg_data))? $reg_data['required'] : '';
                if(!$isSuccess && empty($general_err)) {
                   $msg = display_message('Please Correct the errors on the form','danger');
                }elseif($isSuccess){
                    $msg = display_message('Registration Successfull!','success');
                    
                }else{
                    $msg = display_message($general_err,'danger');
                }

                echo "<div class='row'><div class='col-8 offset-2'>$msg</div></div>";
            }
                ?>
            <div class="row mx-2 my-3">
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

           

            <div class="row mx-2 my-3">
                <div class="col-12 col-md-6 form-group">
                    <label for="username">Username <span>*</span></label>
                    <input type="text" id="username" name="username" value="<?= (isset($_POST['username'])) ? $_POST['username'] : '' ?>" required placeholder="Enter username">
                    <?= (isset($reg_data['username']) ) ? "<span class='text-danger'>{$reg_data['username']}" : ''?>
                </div>

                <div class="col-12 col-md-6 form-group">
                    <label for="email">Email <span>*</span></label>
                    <input type="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>" id="email" name="email" required placeholder="example@domain.com">
                    <?= (isset($reg_data['email']) ) ? "<span class='text-danger'>{$reg_data['email']}" : ''?>
                </div>
            </div>
            
            <div class="row mx-2 my-3"> 
            
                <div class="col-12 col-md-6 form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="<?= (isset($_POST['password'])) ? $_POST['password'] : '' ?>"required placeholder="Enter Password">
                    <?= (isset($reg_data['password']) ) ? "<span class='text-danger'>{$reg_data['password']}" : ''?>
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