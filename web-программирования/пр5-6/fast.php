<?php $pageTitle = 'DemoShop — после оптимизации'; ?>
<!DOCTYPE html>
<html lang="ru"><head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Учебная оптимизированная версия DemoShop для исследования скорости загрузки.">
  <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
  <link rel="stylesheet" href="app.min.css">
  <script src="fast.js" defer></script>
</head><body>
<header class="topbar"><strong>DemoShop</strong><nav><a href="#catalog">Каталог</a> <a href="#promo">Подборка</a></nav></header>
<main class="container">
  <section class="hero">
    <img src="assets/hero-optimized.svg" width="1200" height="675" alt="Баннер DemoShop" decoding="async" fetchpriority="high">
    <div><p class="eyebrow">Лаборатория производительности</p><h1>Версия после оптимизации</h1><p>Меньше переданных данных, меньше запросов и понятное кэширование.</p></div>
  </section>
  <section id="catalog"><h2>Товары</h2><p id="status">Загрузка данных...</p><div id="products" class="grid"></div><div id="stats" class="stats"></div><div id="notice" class="notice"></div></section>
  <div class="spacer"></div>
  <section id="promo"><h2>Подборка недели</h2><img src="assets/promo-optimized.svg" width="1200" height="675" loading="lazy" decoding="async" alt="Подборка недели"></section>
</main></body></html>
