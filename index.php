<?php

include "config/database.php";
include "repository/userRepository.php";

// Démarrage du système de session
session_start();


$template = "index";
include "layout.phtml";