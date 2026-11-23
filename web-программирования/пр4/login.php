<?php
session_start();
require __DIR__ . '/db.php';

if (isset($_SESSION['user_id'])) {
    header('Location: profile.php');
    exit;
}

$email = '';
$error = '';
$registered = isset($_GET['registered']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT id, name, email, password_hash, role FROM users WHERE email = :email LIMIT 1');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int)$user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        header('Location: profile.php');
        exit;
    }
    $error = 'Неверный e-mail или пароль.';
}
?>
<!DOCTYPE html>
<html lang="ru"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>DemoShop — вход</title><link rel="stylesheet" href="style.css"><link rel="stylesheet" href="shop.css"></head><body>
<div class="container form-page"><h1>Вход</h1>
<?php if ($registered): ?><div class="success-box">Регистрация завершена. Теперь войдите в систему.</div><?php endif; ?>
<?php if ($error !== ''): ?><div class="error-box"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
<form method="post">
<label>E-mail<input type="email" name="email" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>" autocomplete="email" required></label>
<label>Пароль<input type="password" name="password" autocomplete="current-password" required></label>
<button type="submit" class="btn">Войти</button></form>
<p>Нет аккаунта? <a href="register.php">Зарегистрироваться</a></p><p><a href="catalog.php">Вернуться в каталог</a></p></div></body></html>
