<?php
    //اسم قاعدة البيانات 
    $db_name = "mysql:host=localhost;dbname=services";
    //اسم المستخدم لقاعدة البيانات 
    $username = "root";
    //كلمة المرور لقاعدة البيانات 
    $password = "";
// ربط قاعدة البيانات مع الموقع
    $conn = new PDO($db_name, $username, $password);
?>