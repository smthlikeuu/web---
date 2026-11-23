<?php
session_start();
require __DIR__ . '/db.php';
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($id === false || $id === null) {
    http_response_code(400);
    exit('Некорректный ID товара.');
}
$stmt = $pdo->prepare('SELECT id, name, category, price, stock FROM products WHERE id = :id');
$stmt->execute(['id' => $id]);
$product = $stmt->fetch();
if (!$product) {
    http_response_code(404);
    exit('Товар не найден.');
}
?>
<!DOCTYPE html>
<html lang="ru"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></title><link rel="stylesheet" href="style.css"><link rel="stylesheet" href="shop.css"></head><body>
<div class="container product-page">
<p><a href="catalog.php">← Назад в каталог</a></p>
<p class="badge"><?= htmlspecialchars($product['category'], ENT_QUOTES, 'UTF-8') ?></p>
<h1><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></h1>
<p class="price" id="product-price"><?= number_format((float)$product['price'], 2, ',', ' ') ?> руб.</p>
<p>Остаток: <strong id="product-stock"><?= (int)$product['stock'] ?></strong> шт.</p>
<button class="btn" id="refresh-product" data-id="<?= (int)$product['id'] ?>">Обновить цену и остаток без перезагрузки</button>
<p id="ajax-status" role="status" aria-live="polite"></p>
</div>
<script>
const button = document.getElementById('refresh-product');
const price = document.getElementById('product-price');
const stock = document.getElementById('product-stock');
const status = document.getElementById('ajax-status');
button.addEventListener('click', async () => {
    status.textContent = 'Получаем свежие данные...';
    try {
        const response = await fetch('api/product.php?id=' + encodeURIComponent(button.dataset.id), {
            headers: { 'Accept': 'application/json' }
        });
        const data = await response.json();
        if (!response.ok || !data.ok) throw new Error(data.error || 'Не удалось получить данные.');
        price.textContent = new Intl.NumberFormat('ru-RU', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(Number(data.product.price)) + ' руб.';
        stock.textContent = String(data.product.stock);
        status.textContent = 'Данные обновлены без перезагрузки страницы.';
    } catch (error) {
        status.textContent = 'Ошибка: ' + error.message;
    }
});
</script>
</body></html>
