<?php
$name = "";
$group = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $group = trim($_POST["group"] ?? "");

    if ($name === "" || $group === "") {
        $message = "Заполните оба поля.";
    } else {
        $safeName = htmlspecialchars($name, ENT_QUOTES, "UTF-8");
        $safeGroup = htmlspecialchars($group, ENT_QUOTES, "UTF-8");
        $message = "Здравствуйте, $safeName! Ваша группа: $safeGroup.";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Анкета студента</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 720px; margin: 40px auto; padding: 0 20px; color: #263746; background: #f3f6f8; }
        main { background: #fff; border: 1px solid #d8e0e5; border-radius: 12px; padding: 28px; }
        label { display: block; margin: 16px 0 6px; font-weight: 700; }
        input { width: 100%; box-sizing: border-box; padding: 10px 12px; border: 1px solid #aebdc8; border-radius: 6px; font: inherit; }
        input:focus { outline: 3px solid #d9e9f5; border-color: #32729b; }
        button { margin-top: 20px; padding: 11px 18px; border: 0; border-radius: 6px; background: #245b7b; color: white; font: inherit; font-weight: 700; cursor: pointer; }
        .result { margin-top: 20px; padding: 12px; background: #edf5ef; border-left: 4px solid #45825b; }
    </style>
</head>
<body>
<main>
    <h1>Анкета студента</h1>
    <form method="post">
        <label for="name">Имя:</label>
        <input id="name" type="text" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES, "UTF-8") ?>">

        <label for="group">Группа:</label>
        <input id="group" type="text" name="group" value="<?= htmlspecialchars($group, ENT_QUOTES, "UTF-8") ?>">

        <button type="submit">Отправить</button>
    </form>

    <?php if ($message !== ""): ?>
        <p class="result"><?= $message ?></p>
    <?php endif; ?>
</main>
</body>
</html>
