<?php
session_start();
$_SESSION["visits"] = ($_SESSION["visits"] ?? 0) + 1;
$visits = (int) $_SESSION["visits"];
?>
<!doctype html>
<html lang="ru"><head><meta charset="utf-8"><title>Счетчик Session</title></head><body>
<h1>Счетчик Session</h1>
<p>Страница открыта в этой сессии: <?= $visits ?> раз.</p>
<p><a href="session_demo.php">Обновить счетчик</a></p>
<p><a href="session_logout.php">Завершить Session</a></p>
</body></html>
