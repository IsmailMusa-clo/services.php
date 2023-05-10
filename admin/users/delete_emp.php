<?php
session_start();
include('../../database/connect.php');
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_attach = $conn->prepare("DELETE FROM `users` WHERE id = ?");
    $delete_attach->execute([$delete_id]);
    setcookie('message', 'تم العملية بنجاح', time() + 4);
    header('location:index.php');
}
