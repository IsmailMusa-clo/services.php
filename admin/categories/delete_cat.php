<?php
session_start();
include('../../database/connect.php');
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $user = $conn->prepare("SELECT image FROM `catagories` WHERE id = ?");
    $user->execute([$delete_id]);
    // unlink('../../controller/uploaded_img/' . $user['image']);
    $delete_cat = $conn->prepare("DELETE FROM `catagories` WHERE id = ?");
    $delete_cat->execute([$delete_id]);
    setcookie('message', 'تم العملية بنجاح', time() + 4);
    header('location:index.php');
}
