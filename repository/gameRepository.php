<?php

function createGame($userId, $resultId){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("INSERT INTO game (game_date, id_users, id_result) VALUES (NOW(),?,?)");
    
    $query->execute([$userId, $resultId]);
}

function getGameHistoryByUserId($userId){
    
    $pdo = getConnexion();
    
    $query = $pdo -> prepare("SELECT game_date, result.name FROM game JOIN result ON game.id_result = result.id WHERE game.id_users = ? ORDER BY game.game_date DESC");
    
    $query->execute([$userId]);
    
    return $query->fetchAll();
}