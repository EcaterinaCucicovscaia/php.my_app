<?php
session_start();
require_once 'database.php'; // подключение к БД

if (!isset($_SESSION['answers'], $_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$questions = json_decode(file_get_contents('questions.json'), true);
$answers = $_SESSION['answers'];
$username = $_SESSION['username'];

$score = 0;

foreach ($questions as $index => $question) {
    $correct = $question['correct'];
    $user_answer = $answers[$index];

    sort($correct);
    sort($user_answer);

    if ($correct == $user_answer) {
        $score++;
    }
}

$total_questions = count($questions);
$percentage = ($score / $total_questions) * 100;

// Сохраняем результат в БД
$conn = getDBConnection();

$stmt = $conn->prepare("INSERT INTO results (username, score, total_questions, percentage) VALUES (?, ?, ?, ?)");
$stmt->bind_param("siid", $username, $score, $total_questions, $percentage);
$stmt->execute();
$stmt->close();

session_destroy(); // очищаем сессию после теста
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результаты теста</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Поздравляем, <?php echo htmlspecialchars($username); ?>!</h2>
    <p>Вы ответили правильно на <?php echo $score; ?> из <?php echo $total_questions; ?> вопросов.</p>
    <p>Ваш результат: <?php echo round($percentage, 2); ?>%</p>
    <a href="index.php">Вернуться на главную</a>
</div>
</body>
</html>
