<?php

include "config/database.php";
include "repository/userRepository.php";

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$template = "index";
include "layout.phtml";