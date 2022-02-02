<?php
$servername = "localhost";
$database = "columbus";
$username = "root";
$password = "";
// Создаем соединение
$mysqli = new mysqli($servername, $username, $password, $database);
// Проверяем соединение
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
$mysqli->set_charset("utf8mb4");