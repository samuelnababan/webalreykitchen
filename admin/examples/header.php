<?php
session_start();
error_reporting(0);
require 'koneksi.php';
$id = $_SESSION['admin_id']; 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Admin AlreyKitchen</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="dashboard.php" class="simple-text">
                Alrey Kitchen
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">
                <i class="nc-icon nc-circle-09"></i>
                    <p>Profile</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="tbl_cake.php">
                <i class="nc-icon nc-notes"></i>
                    <p>Table Product</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="add_cake.php">
                <i class="nc-icon nc-simple-add"></i>
                    <p>Add product</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="tbl_category.php">
                <i class="nc-icon nc-notes"></i>
                    <p>Table category</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="add_category.php">
                <i class="nc-icon nc-simple-add"></i>
                    <p>Add category</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="tbl_transaction.php">
                <i class="nc-icon nc-notes"></i>
                    <p>Order</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="https://dashboard.sandbox.midtrans.com/"  target="_blank">
                <i class="nc-icon nc-notes"></i>
                    <p>Midtrans Payment</p>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        
                        <ul class="nav navbar-nav ml-auto">
                        <?php if ($id): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php" onclick="return confirm('Anda yakin akan Logout?')">
                                    <span class="no-icon">Log out</span>
                                </a>
                            </li>
                            <?php else: ?>
                                <li class="nav-item">
                                <a class="nav-link" href="login.php">
                                    <span class="no-icon">Log in</span>
                                </a>
                            </li>
                            <?php endif ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->