<?php
$name = trim($_GET["name"] ?? "");
$safeName = htmlspecialchars($name, ENT_QUOTES, "UTF-8");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GET — первая форма</title>
</head>
<body>
    <h1>Первая GET-форма</h1>
    <form method="get">
        <label for="name">Ваше имя:</label>
        <input id="name" type="text" name="name" value="<?= $safeName ?>">
        <button type="submit">Отправить</button>
    </form>
    <?php if ($name !== ""): ?>
        <p>Здравствуйте, <?= $safeName ?>!</p>
    <?php endif; ?>
</body>
</html>
