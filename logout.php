<?php
session_start();
session_destroy(); // Удаляем сессию
header("Location: set_username.php"); // Перенаправляем на страницу ввода имени
exit;
?>