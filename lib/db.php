<?php

$pdo = new PDO("mysql:host=127.0.0.1;dbname=app", 'username', 'password');

if (!$pdo->query("SELECT 1")->execute()) {
    die('No database connection');
}
