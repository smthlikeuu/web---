<?php
session_start();
require __DIR__ . '/db.php';

$name = '';
$email = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $passwordRepeat = $_POST['password_repeat'] ?? '';

    if ($name === '') $errors[] = 'Введите имя.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Введите корректный e-mail.';
    if (strlen($password) < 6) $errors[] = 'Пароль должен содержать не менее 6 символов.';
    if ($password !== $passwordRepeat) $errors[] = 'Пароли не совпадают.';

    if (!$errors) {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);

        if ($stmt->fetch()) {
            $errors[] = 'Пользователь с таким e-mail уже зарегистрирован.';
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash) VALUES (:name, :email, :password_hash)');
            $stmt->execute(['name' => $name, 'email' => $email, 'password_hash' => $passwordHash]);
            header('Location: login.php?registered=1');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>DemoShop — регистрация</title><link rel="stylesheet" href="style.css"><link rel="stylesheet" href="shop.css"></head><body>
<div class="container form-page"><h1>Регистрация</h1>
<?php if ($errors): ?><div class="error-box"><?php foreach ($errors as $error): ?><p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endforeach; ?></div><?php endif; ?>
<form method="post">
<label>Имя<input type="text" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>" autocomplete="name" required></label>
<label>E-mail<input type="email" name="email" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>" autocomplete="email" required></label>
<label>Пароль<input type="password" name="password" autocomplete="new-password" required></label>
<label>Повторите пароль<input type="password" name="password_repeat" autocomplete="new-password" required></label>
<button type="submit" class="btn">Зарегистрироваться</button></form>
<p>Уже есть аккаунт? <a href="login.php">Войти</a></p><p><a href="catalog.php">Вернуться в каталог</a></p></div></body></html>
