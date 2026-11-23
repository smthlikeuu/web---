<?php $pageTitle = 'DemoShop — до оптимизации'; ?>
<!DOCTYPE html>
<html lang="ru"><head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
  <link rel="stylesheet" href="base.css"><link rel="stylesheet" href="cards.css"><link rel="stylesheet" href="effects.css">
  <script src="utils.js"></script><script src="slow.js"></script>
</head><body>
<header class="topbar"><strong>DemoShop</strong><nav><a href="#catalog">Каталог</a> <a href="#promo">Подборка</a></nav></header>
<main class="container">
  <section class="hero"><img src="assets/hero-large.bmp" alt="Баннер DemoShop"><div><p class="eyebrow">Лаборатория производительности</p><h1>Версия до оптимизации</h1><p>Эта страница специально собрана неэффективно, чтобы увидеть проблемы в DevTools.</p></div></section>
  <section id="catalog"><h2>Товары</h2><p id="status">Загрузка данных...</p><div id="products" class="grid"></div><div id="stats" class="stats"></div><div id="notice" class="notice"></div></section>
  <div class="spacer"></div>
  <section id="promo" class="promo"><h2>Подборка недели</h2><img src="assets/promo-large.bmp" alt="Подборка недели"></section>
</main></body></html>
