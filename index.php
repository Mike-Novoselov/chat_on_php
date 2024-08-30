<?php
session_start(); // Инициализация сессии

include 'db.php';

// Проверка, установлен ли в сессии username
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Если имя пользователя не установлено, перенаправляем на форму для ввода имени
    header("Location: set_username.php");
    exit;
}

// Если пользователь отправил сообщение
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];

    // Подготовка и выполнение SQL-запроса для добавления сообщения в базу данных
    $stmt = $pdo->prepare("INSERT INTO messages (username, message) VALUES (:username, :message)");
    $stmt->execute(['username' => $username, 'message' => $message]);

    // Получаем все сообщения из базы данных, чтобы обновить историю сообщений
    $messages = $pdo->query("SELECT * FROM messages ORDER BY timestamp DESC")->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Если форма не отправлена, просто получаем все сообщения для отображения
    $messages = $pdo->query("SELECT * FROM messages ORDER BY timestamp DESC")->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Chat</title>
    <style>
        /* Простой стиль для чата */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .chat-box {
            width: 60%;
            max-width: 600px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow-y: auto;
            max-height: 400px;
            border-radius: 5px;
        }

        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            background: #e2e2e2;
        }

        .message .username {
            font-weight: bold;
        }

        .message .timestamp {
            font-size: 0.8em;
            color: #777;
            margin-left: 10px;
        }

        form {
            width: 60%;
            max-width: 600px;
            display: flex;
            flex-direction: column;
        }

        textarea {
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1em;
        }

        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #007bff;
            color: white;
            font-size: 1em;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .logout-button {
            margin-top: 10px;
            background: #ff4b4b;
        }

        .logout-button:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>

<div class="chat-box">
    <?php foreach ($messages as $message): ?>
        <div class="message">
            <span class="username"><?= htmlspecialchars($message['username']) ?>:</span>
            <span><?= htmlspecialchars($message['message']) ?></span>
            <span class="timestamp"><?= $message['timestamp'] ?></span>
        </div>
    <?php endforeach; ?>
</div>

<form action="index.php" method="post">
    <textarea name="message" placeholder="Введите ваше сообщение" required></textarea>
    <button type="submit">Отправить</button>
</form>

<!-- Кнопка для смены имени -->
<form action="logout.php" method="post">
    <button type="submit" class="logout-button">Сменить имя</button>
</form>

</body>
</html>
