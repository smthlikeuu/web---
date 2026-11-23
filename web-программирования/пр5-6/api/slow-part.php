<?php
usleep(350000);
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
$part = $_GET['part'] ?? '';
$products = [
    ['name' => 'Ноутбук StudyBook 14', 'category' => 'Ноутбуки', 'price' => 62990],
    ['name' => 'Клавиатура TypeOne', 'category' => 'Периферия', 'price' => 3490],
    ['name' => 'Мышь Pointer Air', 'category' => 'Периферия', 'price' => 2190],
];
if ($part === 'products') {
    echo json_encode(['products' => $products], JSON_UNESCAPED_UNICODE);
} elseif ($part === 'stats') {
    echo json_encode(['count' => 3, 'stock' => 41], JSON_UNESCAPED_UNICODE);
} elseif ($part === 'notice') {
    echo json_encode(['message' => 'Учебный стенд: сравните waterfall до и после оптимизации.'], JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Неизвестная часть'], JSON_UNESCAPED_UNICODE);
}
