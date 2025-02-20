<?php

session_start();
require 'config/database.php';
require 'repository/questionsRepository.php';
require 'repository/answerRepository.php';
require 'repository/resultRepository.php';


if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}








// // Je cherche à déterminer la question actuelle
// if (!isset($_SESSION['current_question'])) {
//     $question = getFirstQuestion();
//     $_SESSION['current_question'] = $question['id'];
    
// } else {
//     $question = getQuestionById($_SESSION['current_question']);
// }

// // Si une réponse a été donnée
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['response'])) {
//     $response = (int) $_POST['response'];
//     $answer = getNextStep($_SESSION['current_question'], $response);
    
//     if($answer) {
//         if ($answer['id_next_question']) {
//             $_SESSION['current_question'] = $answer['id_next_question'];
//         } else {
//             $_SESSION['result'] = $answer['id_result'];
//             header("Location: result.php");
//             exit();
//         }
//     }
// }

// Déterminer la question actuelle
if (!isset($_SESSION['current_question'])) {
    // Si aucune question n'est définie, on récupère la première
    $question = getFirstQuestion();
    $_SESSION['current_question'] = $question['id'];
} else {
    // Sinon, on récupère la question actuelle depuis la session
    $question = getQuestionById($_SESSION['current_question']);
}

// Si une réponse a été donnée via le formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['response'])) {
    $response = (int) $_POST['response'];

    // Récupérer l'étape suivante en fonction de la réponse donnée
    $answer = getNextStep($_SESSION['current_question'], $response);

    if ($answer) {
        if (!empty($answer['id_next_question'])) {
            // Si une prochaine question existe, on met à jour la session
            $_SESSION['current_question'] = $answer['id_next_question'];
        } elseif (!empty($answer['id_result'])) {
            // Si un résultat est atteint, on le stocke dans la session et on redirige
            $_SESSION['result'] = $answer['id_result'];
            header("Location: result.php");
            exit();
        }
    }

    // Redirection pour éviter le re-soumission du formulaire
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


$template = "quiz";
include "layout.phtml";