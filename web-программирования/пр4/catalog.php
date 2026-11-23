<?php
session_start();
require __DIR__ . '/db.php';
$stmt = $pdo->query('SELECT id, name, category, price, stock FROM products ORDER BY id DESC');
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>DemoShop — каталог</title><link rel="stylesheet" href="style.css"><link rel="stylesheet" href="shop.css"></head><body>
<div class="container">
<div class="topbar"><h1>DemoShop</h1><div>
<?php if (isset($_SESSION['user_id'])): ?>
<a href="profile.php">Личный кабинет</a> · <a href="logout.php">Выйти</a>
<?php else: ?>
<a href="login.php">Войти</a> · <a href="register.php">Регистрация</a>
<?php endif; ?>
</div></div>
<h2>Каталог товаров</h2>
<?php if (!$products): ?><p>Товары пока не добавлены.</p><?php else: ?>
<div class="product-grid">
<?php foreach ($products as $product): ?>
<article class="product-card">
<p class="badge"><?= htmlspecialchars($product['category'], ENT_QUOTES, 'UTF-8') ?></p>
<h3><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></h3>
<p class="price"><?= number_format((float)$product['price'], 2, ',', ' ') ?> руб.</p>
<p>Остаток: <?= (int)$product['stock'] ?> шт.</p>
<a class="btn" href="product.php?id=<?= (int)$product['id'] ?>">Подробнее</a>
</article>
<?php endforeach; ?>
</div><?php endif; ?>
</div></body></html>
