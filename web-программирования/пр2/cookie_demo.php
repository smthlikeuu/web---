<?php
session_start();

$message = "";
$cookieValue = $_COOKIE["demo_cookie"] ?? "";

if (isset($_GET["set"])) {
    setcookie("demo_cookie", "Cookie создан", time() + 3600, "/");
    $message = "Cookie установлен. Обновите страницу, чтобы получить его в $_COOKIE.";
}

if (isset($_GET["delete"])) {
    setcookie("demo_cookie", "", time() - 3600, "/");
    $message = "Команда удаления Cookie отправлена. Обновите страницу.";
}
?>
<!doctype html>
<html lang="ru"><head><meta charset="utf-8"><title>Демонстрация Cookie</title></head><body>
<h1>Демонстрация Cookie</h1>
<p>Текущее значение: <?= htmlspecialchars($cookieValue ?: "не получено", ENT_QUOTES, "UTF-8") ?></p>
<p><?= htmlspecialchars($message, ENT_QUOTES, "UTF-8") ?></p>
<p><a href="cookie_demo.php?set=1">Создать Cookie</a> | <a href="cookie_demo.php?delete=1">Удалить Cookie</a></p>
</body></html>
