<!-- echo password_hash('akbarali123@',PASSWORD_DEFAULT); -->

<?php
    session_start();
    $site_url = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/";
    
    if(!empty($_SESSION['user_name']) && !empty($_SESSION['user_email']))
    {
        header('location:'.$site_url.'dashboard.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS Login</title>
    <link rel="stylesheet" href="assets\css\style.css">
    <link rel="stylesheet" href="assets\fontawesome\css\all.css"/>
</head>
<body>
    <div class="main">
        <div class="login-container">
            <div class="logo">
                <img src="assets\images\logo.png" alt="">
            </div>
            <h2 class="mb-30 mt-10">SIGN IN</h2>
            <div class="alert alert-danger">
                
            </div>
            <form id="loginform" method="post">
                <div class="input-grp mb-30">                
                    <input type="email" placeholder="Email Address" name="email" id="email" >
                    <i class="fa fa-envelope email"></i>
                    <!-- <small id="emailvalid"
                           class="form-text text-muted invalid-feedback">
                        Your email must be a valid email
                    </small>                     -->
                </div>
                <div class="input-grp">                    
                    <input type="password" placeholder="Password" name="password" id="password" >
                    <i class="fa-solid fa-eye password"></i>
                    <!-- <h5 id="passwordcheck"
                        style="color: red;">
                        **Username is missing
                    </h5> -->
                </div>
                <div class="mt-30">                    
                    <!-- <input type="submit" class="btn btn-primary" name="signin" id="signin" value="SIGN IN"> -->
                    <button class="btn btn-primary btn-block">SIGN IN</button>
                    <!-- <i class="fa fa-users"></i> -->
                </div>
            </form>
        </div>
    </div>


    <script src="<?php echo $site_url;?>assets\js\jquery.min.js"></script>
    <script src="<?php echo $site_url;?>assets\js\custom.js"></script>
</body>
</html>
