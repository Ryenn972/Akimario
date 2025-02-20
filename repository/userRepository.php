<?php

function createUser(string $email, string $pseudo, string $password){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("INSERT INTO users (pseudo, email, password) VALUES (?,?,?)");
    
    $query->execute([$pseudo, $email, $password]);
}

// Fonction me permettant de chercher si un compte avec ce pseudo ou cette adresse mail existe déjà
function userExists($email, $pseudo) {
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT COUNT(*) FROM users WHERE email = ? OR pseudo = ?");
    
    $query->execute([$email, $pseudo]);
    
    // fetchColumn() me permet de ne récupérer qu'une seule colonne et de vérifier si la fonction COUNT renvoie un résultat positif
    return $query->fetchColumn() > 0;
}

function getUserByEmail(string $email){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM users WHERE email = ?");
    
    $query->execute([$email]);
    
    return $query->fetch();
}

function getUserByName(string $name){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT email FROM users WHERE pseudo = ?");
    
    $query->execute([$name]);
    
    return $query->fetch();
}


function getIdByName(string $name){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT id FROM users WHERE pseudo = ?");
    
    $query->execute([$name]);
    
    return $query->fetch();
}