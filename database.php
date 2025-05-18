<?php
function getDBConnection() {
    $servername = "localhost";
    $username = "root"; // стандартный пользователь в XAMPP
    $password = "";     // без пароля
    $dbname = "my_app_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }
    return $conn;
}
?>
