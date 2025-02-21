<?php

require 'config/database.php';
require 'repository/resultRepository.php';
include "repository/userRepository.php";
include "repository/gameRepository.php";

session_start();

// Je vérifie si un résultat est disponible
if (!isset($_SESSION['result'])) {
    header("Location: quiz.php");
    exit();
}

// Je récupère le résultat
$result = getResultById($_SESSION['result']);

// Je récupère l'utilisateur connecté
if (isset($_SESSION["user"])) {
    $user = getUserByPseudo($_SESSION["user"]);

    if ($user && isset($_SESSION['result'])) {
        createGame($user["id"], $_SESSION['result']);
    }
}

$template = "result";
include "layout.phtml";

//Réinitialise le jeu après l'affichage
unset($_SESSION['current_question']);