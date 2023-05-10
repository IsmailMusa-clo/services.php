<?php
session_start();
$client_username = $_SESSION['id'];
if (!isset($client_username)) {
    header('location:../login.php');
};
?>