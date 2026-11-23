<?php
require __DIR__ . '/admin_guard.php';
require __DIR__ . '/db.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}
$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($id !== false && $id !== null) {
    $stmt = $pdo->prepare('DELETE FROM products WHERE id = :id');
    $stmt->execute(['id' => $id]);
}
header('Location: index.php');
exit;
