<?php
include_once('../database/connect.php');
if (isset($_POST['add_contact'])) {
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
    $phone = $_POST['phone'];
    $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_SPECIAL_CHARS);
    $message = $_POST['message'];
    $message = filter_var($message, FILTER_SANITIZE_SPECIAL_CHARS);
    $insert_contact = $conn->prepare("INSERT INTO `contact`(`username`,`phone`,`email`,`address`,`message`) VALUES(?,?,?,?,?)");
    $insert_contact->execute([$username, $phone, $email, $address, $message]);
    setcookie('message', 'تم العملية بنجاح', time() + 4);    
}
header('location:../contact.php');
