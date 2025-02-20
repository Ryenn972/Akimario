<?php

function getNextStep(int $questionId, int $response){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM answer WHERE id_questions = ? AND response = ?");
    
    $query->execute([$questionId, $response]);
    
    return $query->fetch();
}