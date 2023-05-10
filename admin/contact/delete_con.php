<?php
session_start();
include('../../database/connect.php');
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_cat = $conn->prepare("DELETE FROM `contact` WHERE id = ?");
    $delete_cat->execute([$delete_id]);
    setcookie('message', 'تم العملية بنجاح', time() + 4);
    header('location:index.php');
}
