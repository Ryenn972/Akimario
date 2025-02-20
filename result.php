<?php

require 'config/database.php';
require 'repository/resultRepository.php';

session_start();

// Je vérifie si un résultat est disponible
if (!isset($_SESSION['result'])) {
    header("Location: quiz.php");
    exit();
}

// Je récupère le résultat
$result = getResultById($_SESSION['result']);

$template = "result";
include "layout.phtml";

//Réinitialise la session après l'affichage
session_destroy();