<?php

include "config/database.php";
include "repository/userRepository.php";

session_start();


$template = "index";
include "layout.phtml";