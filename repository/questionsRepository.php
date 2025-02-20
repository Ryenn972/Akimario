<?php

function getFirstQuestion(){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM questions WHERE first_question = 1");
    
    $query->execute();
    
    return $query->fetch();
}

function getQuestionById(int $id){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM questions WHERE id = ?");
    
    $query->execute([$id]);
    
    return $query->fetch();
}