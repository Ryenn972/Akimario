<?php

include "config/database.php";
include "repository/userRepository.php";
include "repository/gameRepository.php";

session_start();

if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}

// Récupérer les infos de l'utilisateur connecté
$user = getUserByPseudo($_SESSION["user"]);
$games = getGameHistoryByUserId($user["id"]);

if (!empty($_POST)) {

    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    if (!password_verify($old_password, $user["password"])) {
        
        $errorMessage = "Ancien mot de passe incorrect.";
        
    } elseif ($new_password !== $confirm_password) {
        
        $errorMessage = "Les nouveaux mots de passe ne correspondent pas.";
        
    } else {
        // (Regex comme dans signup.php)
        $regexUpper = "/[A-Z]+/";
        $regexLower = "/[a-z]+/";
        $regexNb = "/[0-9]+/";
        $regexSpe = "/(?=.*[\W_]).*/";

        if (preg_match($regexUpper, $new_password) && preg_match($regexLower, $new_password) && preg_match($regexNb, $new_password) && preg_match($regexSpe, $new_password) && strlen($new_password) >= 8) {
            
            // Hachage du nouveau mot de passe
            $passwordHash = password_hash($new_password, PASSWORD_DEFAULT);
            
            // Mettre à jour le mot de passe dans la base
            updateUserPassword($user["id"], $passwordHash);

            $successMessage = "Mot de passe modifié avec succès.";
            
        } else {
            $errorMessage = "Le nouveau mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
        }
    }
}
$template = "account";
include "layout.phtml";