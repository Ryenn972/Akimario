<?php

function getConnexion():object
{
    $pdo = new PDO('mysql:host=db.3wa.io;port=3306;dbname=ryennmithcatan_sprint_php_brouillon1;charset=utf8', 'ryennmithcatan', 'ab09fc793df41efc7e15ac8eacb44015');
    
    return $pdo;
}
