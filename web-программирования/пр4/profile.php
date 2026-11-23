<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$name = $_SESSION['user_name'] ?? '';
$email = $_SESSION['user_email'] ?? '';
$role = $_SESSION['role'] ?? 'user';
?>
<!DOCTYPE html>
<html lang="ru"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>DemoShop — профиль</title><link rel="stylesheet" href="style.css"><link rel="stylesheet" href="shop.css"></head><body>
<div class="container"><h1>Личный кабинет</h1>
<p><strong>Имя:</strong> <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></p>
<p><strong>E-mail:</strong> <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></p>
<p><strong>Роль:</strong> <?= htmlspecialchars($role, ENT_QUOTES, 'UTF-8') ?></p>
<p><a class="btn" href="catalog.php">Перейти в каталог</a></p>
<?php if ($role === 'admin'): ?>
    <p>У вас есть административный доступ.</p>
    <p><a href="admin.php">Открыть панель администратора</a></p>
<?php else: ?>
    <p>Вы вошли как обычный пользователь. Можно просматривать каталог.</p>
<?php endif; ?>
<p><a href="logout.php">Выйти</a></p></div></body></html>
