<?php

function createUser(string $email, string $pseudo, string $password){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("INSERT INTO users (pseudo, email, password) VALUES (?,?,?)");
    
    $query->execute([$pseudo, $email, $password]);
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