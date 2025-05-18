<?php
session_start();
require_once 'database.php';

// Проверка авторизации
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Получение результатов тестов
$conn = getDBConnection();
$query = "SELECT username, percentage, created_at FROM results ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #2b5876;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .logout-button {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Результаты пользователей</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Имя пользователя</th>
                    <th>Баллы (%)</th>
                    <th>Время прохождения</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['percentage']); ?>%</td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Нет данных о прохождении тестов.</p>
    <?php endif; ?>

    <a href="logout.php" class="logout-button">Выйти</a>
</div>
</body>
</html>
