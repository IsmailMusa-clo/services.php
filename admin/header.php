<?php
include_once('../../controller/auth_admin.php');
include_once("../../database/connect.php");
$select_user = $row = '';
$type = $_SESSION['type'];
$email = $_SESSION['email'];
if ($type == 'admin') {
    // فحص من جدول الأدمن
    $select_user = $conn->prepare("SELECT name,avatar FROM `admin` WHERE email = ? ");
    $select_user->execute([$email]);
    if ($select_user->rowCount() > 0) {
        while ($row = $select_user->fetch(PDO::FETCH_ASSOC)) {
            $name = $row['name'];
            $avatar = $row['avatar'];
        }
    }
} else {
    // فحص من جدول الموظفين
    $select_user = $conn->prepare("SELECT username,avatar FROM `users` WHERE email = ? ");
    $select_user->execute([$email]);
    if ($select_user->rowCount() > 0) {
        while ($row = $select_user->fetch(PDO::FETCH_ASSOC)) {
            $name = $row['username'];
            $avatar = $row['avatar'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <!-- meta links -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>لوحة التحكم</title>

    <!-- روابط الستايل -->
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- السايد الجانبي فيه روابط الصفحات الجانبية -->
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" style="direction:ltr;text-align:right" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../home/index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"> Admin <sup>2</sup></div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../home/index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Utilities Collapse Menu -->
            <!-- روابط صفحات الأدمن -->
            <?php
            if ($type == 'admin') {
            ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>الموظفين</span>
                    </a>
                    <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">الموظفين:</h6>
                            <!--رابط صفحة عرض جدول بيانات الموظفين-->
                            <a class="collapse-item" href="../users/index.php">عرض الموظفين</a>
                            <!--رابط صفحة إضافة بيانات الموظف-->
                            <a class="collapse-item" href="../users/create.php">إضافة موظف</a>
                        </div>
                    </div>
                </li>
            <?php
            } else {
            }
            if ($type == 'admin') {
            ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>التصنيفات</span>
                    </a>
                    <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">التصنيفات:</h6>
                            <!--رابط صفحة عرض جدول بيانات التصنيفات-->
                            <a class="collapse-item" href="../categories/index.php">عرض التصنيفات</a>
                            <!--رابط صفحة إضافة بيانات النصنيف-->
                            <a class="collapse-item" href="../categories/create.php"> إضافة تصنيف</a>
                        </div>
                    </div>
                </li>
            <?php
            } else {
            }
            if ($type == 'admin') {
            ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>الخدمات</span>
                    </a>
                    <div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">الخدمات:</h6>
                            <!--رابط صفحة عرض جدول بيانات الخدمات-->
                            <a class="collapse-item" href="../services/index.php">عرض الخدمات</a>
                            <!--رابط صفحة إضافة بيانات الخدمة-->
                            <a class="collapse-item" href="../services/create.php"> إضافة خدمة</a>
                        </div>
                    </div>
                </li>
            <?php
            } else {
            }
            if ($type == 'admin') {
            ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities4" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>طلبات التواصل</span>
                    </a>
                    <div id="collapseUtilities4" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">الطلبات:</h6>
                            <!--رابط صفحة عرض جدول بيانات الطلبات-->
                            <a class="collapse-item" href="../contact/index.php">عرض الطلبات</a>
                        </div>
                    </div>
                </li>
            <?php
            }          if ($type == 'admin') {
                ?>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#add_admin" aria-expanded="true" aria-controls="collapseUtilities">
                            <i class="fas fa-fw fa-folder"></i>
                            <span>اضافة مدير</span>
                        </a>
                        <div id="add_admin" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">المدراء:</h6>
                                <!--رابط صفحة عرض جدول بيانات الطلبات-->
                                <a class="collapse-item" href="../home/add-admin.php">اضافة مدير</a>
                                <a class="collapse-item" href="../home/admin.php">عرض المدراء</a>
                            </div>
                        </div>
                    </li>
                <?php
                }else {
            }
            ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities5" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>طلبات الخدمات</span>
                </a>
                <div id="collapseUtilities5" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">الطلبات:</h6>
                        <!--رابط صفحة عرض جدول بيانات الطلبات-->
                        <a class="collapse-item" href="../orders/index.php">عرض الطلبات</a>
                    </div>
                </div>
            </li>
            <?php
            if ($type != 'admin') {
            ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities6" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>البروفايل</span>
                    </a>

                    <div id="collapseUtilities6" class="collapse" aria-labelledby="headingUtilities6" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">تعديل البروفايل:</h6>
                            <!--رابط صفحة تعديل بيانات -->
                            <a class="collapse-item" href="../users/profile.php"> تعديل البيانات</a>
                        </div>
                    </div>
                </li>
            <?php
            }
            ?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="index.php" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $name ?></span>
                                <img class="img-profile rounded-circle" src="../../controller/uploaded_img/<?= $avatar ?>">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <?php
                            if ($type != 'admin') {
                            ?>
                                <!-- Dropdown - User Information -->
                                    <a class="dropdown-item" href="../../admin/users/profile.php">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <div class="dropdown-divider"></div>
                            <?php
                            }
                            ?>
                                    <a class="dropdown-item" href="../../controller/logout.php">
                                        <!--  زر تسجيل الخروج -->
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">