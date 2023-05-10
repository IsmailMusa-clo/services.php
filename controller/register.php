<?php

include_once('../database/connect.php');

if (isset($_POST['register'])) {
    $error = "";
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE username = ? AND email = ?");
    $select_user->execute([$username, $email]);
    if ($select_user->rowCount() > 0) {
        $error = "هذا المستخدم موجود مسبقاً";
    } else {
        if ($username != '' && $email != '' && $password != '' && $image!='') {
            $insert_user = $conn->prepare("INSERT INTO `users`(username,email,avatar,password) VALUES(?,?,?,?)");
            $insert_user->execute([$username, $email, $image, $password]);
            move_uploaded_file($image_tmp_name, $image_folder);
            setcookie('message', 'تم العملية بنجاح', time() + 4);
            header('location:../admin/login.php');
        } else {
            echo $username. $email. $password. $image;
            setcookie('message','الرجاء تعبئة الحقول', time() + 4);
            // header('location:../admin/register.php');
        }
    }
}
