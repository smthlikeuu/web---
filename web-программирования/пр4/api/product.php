<?php
header('Content-Type: application/json; charset=UTF-8');
require dirname(__DIR__) . '/db.php';
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($id === false || $id === null) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Некорректный ID товара.'], JSON_UNESCAPED_UNICODE);
    exit;
}
$stmt = $pdo->prepare('SELECT id, price, stock FROM products WHERE id = :id');
$stmt->execute(['id' => $id]);
$product = $stmt->fetch();
if (!$product) {
    http_response_code(404);
    echo json_encode(['ok' => false, 'error' => 'Товар не найден.'], JSON_UNESCAPED_UNICODE);
    exit;
}
echo json_encode([
    'ok' => true,
    'product' => [
        'id' => (int)$product['id'],
        'price' => (float)$product['price'],
        'stock' => (int)$product['stock'],
    ],
], JSON_UNESCAPED_UNICODE);
