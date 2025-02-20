<?php

function getNextStep(int $question, int $response){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM answer WHERE id_questions = ? AND response = ?");
    
    $query->execute([$question, $response]);
    
    return $query->fetch();
}