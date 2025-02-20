<?php

require 'config/database.php';
require 'repository/questionsRepository.php';
require 'repository/answerRepository.php';

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}


// Je cherche à déterminer la question actuelle
if (!isset($_SESSION['current_question'])) {
    $question = getFirstQuestion();
    $_SESSION['current_question'] = $question['id'];
    
} else {
    $question = getQuestionById($_SESSION['current_question']);
}

// Si une réponse a été donnée
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['response'])) {
    $response = (int) $_POST['response'];
    $answer = getNextStep($_SESSION['current_question'], $response);
    
    if($answer) {
        if ($answer['id_next_question']) {
            $_SESSION['current_question'] = $answer['id_next_question'];
        } else {
            $_SESSION['result'] = $answer['id_result'];
            header("Location: result.php");
            exit();
        }
    }
}

$template = "quiz";
include "layout.phtml";