<?php
require __DIR__ . '/admin_guard.php';
require __DIR__ . '/db.php';

$stmt = $pdo->query(
    'SELECT id, name, category, price, stock
     FROM products
     ORDER BY id DESC'
);
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DemoShop — товары</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>DemoShop — товары</h1>
    <p><a class="btn" href="create.php">Добавить товар</a></p>

    <?php if (!$products): ?>
        <p>В базе пока нет товаров.</p>
    <?php else: ?>
        <table>
            <thead><tr><th>ID</th><th>Название</th><th>Категория</th><th>Цена</th><th>Остаток</th><th>Действия</th></tr></thead>
            <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= (int)$product['id'] ?></td>
                    <td><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($product['category'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= number_format((float)$product['price'], 2, ',', ' ') ?> руб.</td>
                    <td><?= (int)$product['stock'] ?></td>
                    <td class="actions">
                        <a href="edit.php?id=<?= (int)$product['id'] ?>">Изменить</a>
                        <form action="delete.php" method="post" onsubmit="return confirm('Удалить этот товар?');">
                            <input type="hidden" name="id" value="<?= (int)$product['id'] ?>">
                            <button type="submit" class="link-button">Удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
