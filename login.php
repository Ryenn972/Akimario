<?php

include "config/database.php";
include "repository/userRepository.php";
include "repository/answerRepository.php";
include "repository/questionsRepository.php";

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
            echo 'Connecté !';
            // Redirection vers la page top secrète
            //header("Location: secret.php");
            //exit;
        }
        else{
            $error = "Identifiant ou mot de passe incorrect";
        }
    }
    else{
         $error = "Identifiant ou mot de passe incorrect";
    }
    
    //2 comparer le hash avec le mdp saisi dans le form 
        //si c'est ok, on créer la session
        //si pas ok, on affiche une erreur 
    
   
}

$template = "index";
include "layout.phtml";