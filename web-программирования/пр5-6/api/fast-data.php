<?php
usleep(350000);
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: public, max-age=60');
$data = [
    'products' => [
        ['name' => 'Ноутбук StudyBook 14', 'category' => 'Ноутбуки', 'price' => 62990],
        ['name' => 'Клавиатура TypeOne', 'category' => 'Периферия', 'price' => 3490],
        ['name' => 'Мышь Pointer Air', 'category' => 'Периферия', 'price' => 2190],
    ],
    'stats' => ['count' => 3, 'stock' => 41],
    'notice' => 'Оптимизированный стенд: один запрос вместо трёх.'
];
echo json_encode($data, JSON_UNESCAPED_UNICODE);
