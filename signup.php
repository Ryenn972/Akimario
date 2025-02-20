<?php

include "config/database.php";
include "repository/userRepository.php";

// Si le form a été soumis = création du compte 
if(!empty($_POST)){
    // Vérifier que le mot de pass est fort
    $password = $_POST["password"];
    $regexUpper = "/[A-Z]+/";
    $regexLower = "/[a-z]+/";
    $regexNb = "/[0-9]+/";
    $regexSpe = "/(?=.*[\W_]).*/";
    
    if(preg_match($regexUpper, $password) && preg_match($regexLower, $password) && preg_match($regexNb, $password) && preg_match($regexSpe, $password) && strlen($password) >= 8){
        
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
            //appeler la fonction qui va insérer un utilisateur
            createUser($_POST["email"], $_POST["pseudo"], $passwordHash);
            echo 'Compte créé !';
            
            header("Location:home.php");
            exit;
        
        
    }
    
}

$template = "signup";
include "layout.phtml";