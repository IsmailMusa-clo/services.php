<?php
include_once('../database/connect.php');
if (isset($_POST['add_order'])) {
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
    $phone = $_POST['phone'];
    $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_SPECIAL_CHARS);
    $emp_id = $_POST['emp_id'];
    $emp_id = filter_var($emp_id, FILTER_SANITIZE_NUMBER_INT);
    $price ="";
     $select_emp = $conn->prepare("SELECT * FROM `users` where id=?");
    $select_emp->execute([$emp_id]);
    if ($select_emp->rowCount() > 0) {
        while ($fetch_emp = $select_emp->fetch(PDO::FETCH_ASSOC)) {
            $price=$fetch_emp['service_price'];
        }
    }
    $insert_order = $conn->prepare("INSERT INTO `orders`(`username`,`phone`,`email`,`address`,`emp_id`,`price`,`status`) VALUES(?,?,?,?,?,?,?)");
    $insert_order->execute([$username, $phone, $email, $address, $emp_id,$price,'pending']);
    setcookie('message', 'تم العملية بنجاح', time() + 4);
}
header('location:../index.php');
