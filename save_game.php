<?php

include "config/database.php";
include "repository/gameRepository.php";
include "repository/userRepository.php";

session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$resultId = $_POST['result_id'] ?? null;

if ($resultId) {
    $user = getUserByPseudo($_SESSION["user"]);

    if ($user) {
        createGame($user["id"], $resultId);
        header("Location: game_history.php"); // Redirection vers l'historique
        exit;
    } else {
        $errorMessage = "Utilisateur non trouvé.";
    }
}

// Si pas de résultat, on renvoie vers la page de jeu (ou autre)
header("Location: index.php");
exit;