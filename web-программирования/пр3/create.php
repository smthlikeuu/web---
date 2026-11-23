<?php
require __DIR__ . '/admin_guard.php';
require __DIR__ . '/db.php';
$name = '';
$category = '';
$price = '';
$stock = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $price = str_replace(',', '.', trim($_POST['price'] ?? ''));
    $stock = trim($_POST['stock'] ?? '');

    if ($name === '') $errors[] = 'Введите название товара.';
    if ($category === '') $errors[] = 'Введите категорию.';
    if ($price === '' || !is_numeric($price) || (float)$price < 0) $errors[] = 'Цена должна быть числом не меньше 0.';
    $stockIsValid = filter_var($stock, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);
    if ($stock === '' || $stockIsValid === false) $errors[] = 'Остаток должен быть целым числом не меньше 0.';

    if (!$errors) {
        $stmt = $pdo->prepare('INSERT INTO products (name, category, price, stock) VALUES (:name, :category, :price, :stock)');
        $stmt->execute(['name' => $name, 'category' => $category, 'price' => (float)$price, 'stock' => (int)$stock]);
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Добавление товара</title><link rel="stylesheet" href="style.css"></head><body>
<div class="container form-page"><h1>Добавление товара</h1>
<?php if ($errors): ?><div class="error-box"><?php foreach ($errors as $error): ?><p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endforeach; ?></div><?php endif; ?>
<form method="post">
<label>Название<input type="text" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>"></label>
<label>Категория<input type="text" name="category" value="<?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?>"></label>
<label>Цена<input type="text" name="price" inputmode="decimal" value="<?= htmlspecialchars($price, ENT_QUOTES, 'UTF-8') ?>"></label>
<label>Остаток<input type="number" name="stock" min="0" step="1" value="<?= htmlspecialchars($stock, ENT_QUOTES, 'UTF-8') ?>"></label>
<button type="submit" class="btn">Сохранить</button> <a href="index.php">Отмена</a>
</form></div></body></html>
