<?php
session_start();
include('../../database/connect.php');
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
    $delete_order->execute([$delete_id]);
    setcookie('message', 'تم العملية بنجاح', time() + 4);
    header('location:index.php');
}
