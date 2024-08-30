<?php
// Настройки подключения к базе данных
$host = 'localhost';  // Хост базы данных
$dbname = 'chat_app'; // Имя базы данных
$username = 'root';   // Имя пользователя MySQL (по умолчанию root)
$password = '';       // Пароль пользователя MySQL (по умолчанию пустой)

// Подключение к базе данных
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Устанавливаем режим обработки ошибок
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Если подключение не удалось, выводим сообщение об ошибке
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>
