<?php
// ('akbar@pinki',akbarali.m.khorajiya)
// error_reporting(0);
include_once "config/ajaxFunction.php";
    // session_start();
    $site_url = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/";
    
    if(empty($_SESSION['user_name']) && empty($_SESSION['user_email']))
    {
        header('location:'.$site_url);
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets\fontawesome\css\all.css" />
    <link rel="stylesheet" href="assets\css\style.css">
    <script src="<?php echo $site_url;?>assets\js\jquery.min.js"></script>
</head>

<body>
    <div id="wrapper">
        <?php
            include "includes\sidebar.php";
        ?>

        <!-- Content-Bar -->

        <div class="content-wrapper">

            <div class="navbar">
                <button class="btn btn-light btn-sm" id="logout"><i class="fa-solid fa-power-off"></i> Logout</button>
                <h5 class="profile-text ml-10"><b><?php echo $_SESSION['user_name'];?></b></h5>
                <img class="profile-image" src="assets\images\user.png" alt="">
            </div>