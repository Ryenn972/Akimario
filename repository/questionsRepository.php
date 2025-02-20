<?php

function getFirstQuestion(){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM questions WHERE first_question = 1");
    
    $query->execute();
    
    return $query->fetch();
}

function getCurrentQuestions(){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM questions WHERE first_question = ?");
    
    $query->execute();
    
    return $query->fetch();
}