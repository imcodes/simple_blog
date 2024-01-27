<?php require_once "../init.php";
    use Traits\Connection;
    validateLoginRedirect('../dashboard'); //Redirect to dashboard when Logged in
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pword'])){
    $useremail = $_POST['useremail'];
    $pword = $_POST['pword'];
    //$phash = md5($pword);

    //connect to database
    $conn = Connection::connect();
    //find user
    $qry = $conn->query("SELECT username,email,password,id FROM users WHERE username = '$useremail' or email = '$useremail'");
    $user = $qry->fetch();
    if(!$user){
        $err = "<div class='alert alert-warning'>Incorrect User Credentials</div>";
    }else{
        if(!password_verify($pword,$user['password'])){
            $err = "<div class='alert alert-warning'>Incorrect Password</div>";
        } else{
            //The password is correct then open a session
          
            $_SESSION['user'] = $user;

            header('location:../dashboard');
        }
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= SITE_FAVICON ?>" type="image/x-icon">
    <title>User Login</title>
    <?php require_once "../core/inc/_header_script.php"; ?>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>
    <div class="container login">
        <div class="auth-header">
            <div class="logo">
                <img class='white-mono' src="<?= SITE_LOGO ?>" alt="Official Logo">
            </div>
            <h1 class="auth-title mb-2 mt-1">Member Login</h1>
        </div>

        <?php
        if(isset($err) && !empty($err)) echo $err;
        if(isset($msg) && !empty($msg)) echo $msg;
         ?>

        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group mb-1">
                <label for="useremail">Username/Email</label>
                <input type="text" value="<?= (isset($_POST['useremail'])) ? $_POST['useremail'] : '' ?>" class="input" id="useremail" name="useremail" placeholder="Enter Your username or email">
            </div>

            <div class="form-group mb-1">
                <label for="pword">Password</label>
                <input type="password" id="pword" name="pword" placeholder="Enter Password" required>
            </div>

            <div class="action-group mb-1">
                <button class="btn" type="submit">Login &rarr;</button>
                <span class="small-text">Don't have an account <a href="register" title="Click here to create a free account">Register here</a></span>
            </div>

            <p class="small-text text-center">Forgotten Password? <a href="#">Reset Password</a></p>
        </form>
    </div>

    <?php require_once "../core/inc/_footer_script.php"; ?>
</body>
</html>
