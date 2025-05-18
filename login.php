<?php
session_start();
require_once 'database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $conn = getDBConnection();
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Неверный логин или пароль.';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход администратора</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Вход администратора</h2>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="post" action="login.php">
        <div style="margin-bottom: 20px;">
            <input type="text" name="username" placeholder="Имя пользователя" required style="padding: 10px; width: 80%; border-radius: 8px; border: 1px solid #ccc;">
        </div>
        <div style="margin-bottom: 20px;">
            <input type="password" name="password" placeholder="Пароль" required style="padding: 10px; width: 80%; border-radius: 8px; border: 1px solid #ccc;">
        </div>
        <input type="submit" value="Войти">
    </form>

    <br>
    <a href="index.php">Вернуться на главную</a>
</div>
</body>
</html>
