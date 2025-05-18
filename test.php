<?php
session_start();

// Загрузка вопросов
$questions = json_decode(file_get_contents('questions.json'), true);

// Проверка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['start_test'])) {
    $_SESSION['username'] = htmlspecialchars(trim($_POST['username']));
    $_SESSION['answers'] = [];
    $_SESSION['current_question'] = 0;
}

$current_question_index = $_SESSION['current_question'] ?? 0;
$username = $_SESSION['username'] ?? '';

if (!$username) {
    header('Location: index.php');
    exit();
}

// Если тест завершён
if ($current_question_index >= count($questions)) {
    header('Location: result.php');
    exit();
}

// Текущий вопрос
$current_question = $questions[$current_question_index];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Прохождение теста</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Тест для: <?php echo htmlspecialchars($username); ?></h2>
    <form action="save_answer.php" method="post">
        <h3><?php echo htmlspecialchars($current_question['question']); ?></h3>
        <?php foreach ($current_question['options'] as $option): ?>
            <?php if ($current_question['type'] == 'single'): ?>
                <div>
                    <input type="radio" name="answer[]" value="<?php echo htmlspecialchars($option); ?>" required>
                    <?php echo htmlspecialchars($option); ?>
                </div>
            <?php else: ?>
                <div>
                    <input type="checkbox" name="answer[]" value="<?php echo htmlspecialchars($option); ?>">
                    <?php echo htmlspecialchars($option); ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <br>
        <input type="submit" value="Ответить">
    </form>
</div>
</body>
</html>
