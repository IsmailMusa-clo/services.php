<?php
// ربط قاعدة البيانات
include_once('../database/connect.php');
// فتح جلسة session
session_start();
// فحص اذا المستخدم قام بضغط على زر تسجيل الدخول
if (isset($_POST['login'])) {
    // الايميل
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    // الباسسورد
    $password = $_POST['password'];
    // نوع المستخدم
    $type = $_POST['type'];
    $select_user = $row = '';
    // فحص اذا كان نوع المستخدم أدمن أو موظف
    if ($type == 'admin') {
        // فحص من جدول الأدمن
        $select_user = $conn->prepare("SELECT * FROM `admin` WHERE email = ? ");
        $select_user->execute([$email]);
        
    } else {
        // فحص من جدول الموظفين
        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? ");
        $select_user->execute([$email]);
    }
    // فحص إذا كان هناك استعلام قادم بتوافق كلمة المرور والايميل
    if ($select_user->rowCount() > 0) {
        while ($row = $select_user->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $row['password'])) {
                setcookie('message', 'تم تسجيل الدخول', time() + 4);
                $_SESSION['email'] = $row['email'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['type'] = $type;
                header('location:../admin/home/index.php');
            } else {
                echo "<script>alert('register not done')</script>";
                setcookie('message', 'كلمة المرور خاطئة', time() + 4);
                header('location:../admin/home/index.php');
            }
        }
    } else {
        setcookie('message', 'هناك خطأ في اسم المستخدم او كلمة المرور', time() + 4);
        header('location:../admin/login.php');
    }
} else {
    header('location:../admin/login.php');
}

?>
