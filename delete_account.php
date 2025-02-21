<?php

include "config/database.php";
include "repository/userRepository.php";

session_start();

if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['delete_account'])) {
    $userId = $_SESSION['user_id'];
    
    deleteUser($userId);
    
    session_unset();
    session_destroy();
    
    header("Location: index.php");
    exit();
}