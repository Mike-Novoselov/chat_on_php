# chat_on_php
Создание простого чата на PHP с использованием MySQL и XAMPP
1. Структура базы данных MySQL

``` sql

CREATE DATABASE chat_app;

USE chat_app;

CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

```
