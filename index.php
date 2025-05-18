<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['username'] = trim($_POST['username']);
    header('Location: test.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .admin-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Добро пожаловать!</h2>

    <form method="post" action="">
        <input type="text" name="username" placeholder="Введите ваше имя" required style="padding: 10px; border-radius: 8px; border: 1px solid #ccc;">
        <br><br>
        <input type="submit" value="Пройти тест">
    </form>

    <br>

    <!-- Кнопка Войти как администратор -->
    <a href="login.php" class="admin-button">Войти как администратор</a>
</div>
</body>
</html>
