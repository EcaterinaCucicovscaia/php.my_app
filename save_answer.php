<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
    $answer = $_POST['answer'];
    $_SESSION['answers'][] = $answer;
    $_SESSION['current_question']++;
    header('Location: test.php');
    exit();
} else {
    // Если ответ не выбран, перенаправляем на тот же вопрос
    header('Location: test.php');
    exit();
}
?>
