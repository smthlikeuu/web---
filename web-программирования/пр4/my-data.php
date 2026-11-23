<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$name = $_SESSION['user_name'] ?? '';
$role = $_SESSION['role'] ?? 'user';
?>
<!doctype html><html lang="ru"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Мои данные — DemoShop</title><link rel="stylesheet" href="style.css"><link rel="stylesheet" href="shop.css"></head><body>
<div class="container"><h1>Мои данные</h1><p>Здравствуйте, <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>.</p>
<?php if ($role === 'admin'): ?><p>Ваша роль: администратор.</p><p><a class="btn" href="index.php">Управление товарами</a></p>
<?php else: ?><p>Ваша роль: пользователь.</p><p><a class="btn" href="catalog.php">Открыть каталог</a></p><?php endif; ?>
<p><a href="logout.php">Выйти</a></p></div></body></html>
