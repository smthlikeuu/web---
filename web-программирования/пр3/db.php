<?php
$host = '127.0.0.1';
$port = '3306';
$db = 'demoshop';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // В учебной версии не раскрываем пользователю учетные данные или подробности окружения.
    exit('Не удалось подключиться к базе данных. Проверьте, что MySQL запущен и параметры db.php верны.');
}
