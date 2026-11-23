<?php
$products = [
    ['name' => 'NovaBook 14', 'price' => 74990],
    ['name' => 'CodeBook 15', 'price' => 68990],
    ['name' => 'StudyBook Air', 'price' => 57990],
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>DemoShop — технический стенд</title>
    <link rel="stylesheet" href="base.css">
    <link rel="stylesheet" href="cards.css">
    <script src="blocking.js"></script>
    <script src="missing.js"></script>
</head>
<body>
<header class="site-header">
    <div class="wrap">
        <h1>DemoShop</h1>
        <nav>
            <a href="index.php">Главная</a>
            <a href="catalog.php">Каталог</a>
            <a href="broken-page.php">Доставка</a>
        </nav>
    </div>
</header>
<main class="wrap">
    <section class="hero">
        <div>
            <p class="eyebrow">Учебный стенд</p>
            <h2>Ноутбуки для учебы и программирования</h2>
            <p>На этой странице специально оставлены технические ошибки.</p>
        </div>
        <img src="missing-banner.webp" alt="Ноутбуки DemoShop">
    </section>
    <section>
        <h2>Популярные модели</h2>
        <div class="grid">
        <?php foreach ($products as $product): ?>
            <article class="card">
                <h3><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                <p><?= number_format($product['price'], 0, ',', ' ') ?> руб.</p>
                <button class="stock-btn">Проверить остаток</button>
            </article>
        <?php endforeach; ?>
        </div>
        <p id="stock-result"></p>
    </section>
</main>
<script src="app.js"></script>
</body>
</html>
