<?php
session_start(); 

include_once('database/connect.php');
?>
<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الخدمات</title>
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <?php
    if (isset($_COOKIE['message'])) {
        echo $_COOKIE['message'];
    }
    ?>
</head>

<body>
    <!-- start header -->
    <header>
        <!-- start navbar section -->
        <nav>
            <div class="container">
                <div class="content">
                    <div class="right-sec">
                        <!-- start brand sec  -->
                        <div class="brand">
                            <a href="index.php">
                                <img src="assets/images/logo-ar.png" alt="">
                            </a>
                        </div>
                        <!-- end brand sec -->
                        <ul>
                            <li><a href="index.php"><i class="fa fa-home"></i><span>الرئيسية</span></a></li>
                            <li><a href="category.php"><i class="fa fa-windows"></i><span>التصنيفات</span></a></li>
                            <li><a href="about.php"><i class="fa fa-commenting"></i><span>من نحن</span></a></li>
                            <li><a href="contact.php"><i class="fa fa-commenting"></i><span>تواصل معنا</span></a></li>
                        
                        </ul>
                    </div>
                    <div class="left-sec">
                        <a href="admin/login.php" id="tr"><i class="fa fa-user"></i></a>
                        <?php 
                            if(isset($_SESSION['customer'])) {
                                echo '<a href="logout.php" id="tr"><i class="fa fa-minus"></i></a>' ;
                            } else {
                                echo '<a href="c-login.php" id="tr"><i class="fa fa-plus"></i></a>' ;
                            }
                        ?>       
                    </div>

       
                </div>
            </div>
        </nav>
        <!-- end navbar section -->
    </header>
    <!-- end header -->
    <!-- start main -->
    <main>