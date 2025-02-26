<?php

include "config/database.php";
include "repository/userRepository.php";


// Démarrage du système de session
session_start();

// Si le form a été soumis ($_POST n'est pas vide)
if(!empty($_POST)){
    
    // Appel de la fonction qui permet d'aller cherche le mdp haché d'un user par son email
    $user = getUserByEmail($_POST["email"]);
    
    if($user){
        
        // Si l'utilisateur a saisi les bons identifiants et mots de passe
        if(password_verify($_POST['password'], $user["password"])){
            
            // Création d'une session
            $_SESSION["user"] = $user["pseudo"];
            
            // Redirection vers la page d'accueil
            header("Location: index.php");
            exit;
        }
        else{
            $error = "Identifiant ou mot de passe incorrect";
        }
    }
    else{
         $error = "Identifiant ou mot de passe incorrect";
    }
}

$template = "login";
include "layout.phtml";