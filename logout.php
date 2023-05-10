<?php
// ربط قاعدة البيانات
include_once('../database/connect.php');
session_start();
// حذف جلسة
session_unset();
// تدمير جلسة
session_destroy();

// إعادة توجيه لصفحة تسجيل الدخول
header('location:c-login.php');

?>