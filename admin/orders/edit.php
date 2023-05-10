<?php
session_start();
include('../../database/connect.php');
if (isset($_GET['update'])) {
    $update_id = $_GET['update'];
    $select_order = $conn->prepare("SELECT `status` FROM `orders` WHERE id = ?");
    $select_order->execute([$update_id]);
    if ($select_order->rowCount() > 0) {
        while ($fetch_order= $select_order->fetch(PDO::FETCH_ASSOC)) {
            if ($fetch_order['status'] == 'pending') {
                $update_order = $conn->prepare("UPDATE `orders` SET `status` =? WHERE id = ?");
                $update_order->execute(['paid', $update_id]);
            } else {
                $update_order = $conn->prepare("UPDATE `orders` SET `status` =? WHERE id = ?");
                $update_order->execute(['pending', $update_id]);
            }
        }
        setcookie('message', 'تم العملية بنجاح', time() + 4); 
    }
    
    header('location:index.php');
}
