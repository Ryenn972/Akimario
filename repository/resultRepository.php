<?php

function getResultById(int $id){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT * FROM result WHERE id = ?");
    
    $query->execute([$id]);
    
    return $query->fetch();
}