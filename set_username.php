<?php
session_start(); // Инициализация сессии

// Если пользователь уже установил имя, перенаправляем его на чат
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Если форма отправлена, сохраняем имя пользователя в сессии и перенаправляем в чат
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['username'] = $_POST['username'];
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Введите имя</title>
    <style>
        /* Простой стиль для формы ввода имени */
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

        .form-box {
            width: 300px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1em;
        }

        button {
            width: 100%;
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
    </style>
</head>
<body>

<div class="form-box">
    <form action="set_username.php" method="post">
        <h2>Введите ваше имя</h2>
        <input type="text" name="username" placeholder="Ваше имя" required>
        <button type="submit">Сохранить</button>
    </form>
</div>

</body>
</html>