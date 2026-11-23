<?php
session_start();

$message = "";
$savedName = $_SESSION["name"] ?? "";
$savedGroup = $_COOKIE["group"] ?? "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["save_profile"])) {
    $name = trim($_POST["name"] ?? "");
    $group = trim($_POST["group"] ?? "");

    if ($name === "" || $group === "") {
        $message = "Заполните имя и группу.";
    } else {
        $_SESSION["name"] = $name;
        setcookie("group", $group, time() + 86400, "/");
        $savedName = $name;
        $savedGroup = $group;
        $message = "Данные сохранены.";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["save_note"])) {
    $note = trim($_POST["note"] ?? "");

    if ($note === "") {
        $message = "Введите текст заметки.";
    } else {
        $author = $_SESSION["name"] ?? "Гость";
        $line = $author . ": " . $note . PHP_EOL;
        file_put_contents(__DIR__ . "/notes.txt", $line, FILE_APPEND | LOCK_EX);
        $message = "Заметка добавлена.";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой учебный кабинет</title>
    <style>
        body{font-family:Arial,sans-serif;max-width:780px;margin:36px auto;padding:0 18px;background:#f2f5f7;color:#243746}
        main{background:#fff;border:1px solid #d6e0e6;border-radius:12px;padding:26px}
        label{display:block;margin:14px 0 6px;font-weight:700}
        input{width:100%;box-sizing:border-box;padding:10px;border:1px solid #aebdc8;border-radius:6px;font:inherit}
        button{margin-top:14px;padding:10px 16px;border:0;border-radius:6px;background:#245b7b;color:#fff;font:inherit;font-weight:700;cursor:pointer}
        .notice{padding:10px;background:#edf5ef;border-left:4px solid #45825b}
        pre{white-space:pre-wrap;background:#f7f9fa;padding:14px;border:1px solid #d6e0e6;border-radius:6px}
    </style>
</head>
<body>
<main>
    <h1>Мой учебный кабинет</h1>
    <?php if ($message !== ""): ?>
        <p class="notice"><?= htmlspecialchars($message, ENT_QUOTES, "UTF-8") ?></p>
    <?php endif; ?>

    <h2>Профиль</h2>
    <form method="post">
        <label for="name">Имя:</label>
        <input id="name" type="text" name="name" value="<?= htmlspecialchars($savedName, ENT_QUOTES, "UTF-8") ?>">
        <label for="group">Группа:</label>
        <input id="group" type="text" name="group" value="<?= htmlspecialchars($savedGroup, ENT_QUOTES, "UTF-8") ?>">
        <button type="submit" name="save_profile" value="1">Сохранить профиль</button>
    </form>

    <h2>Новая заметка</h2>
    <form method="post">
        <label for="note">Текст заметки:</label>
        <input id="note" type="text" name="note">
        <button type="submit" name="save_note" value="1">Добавить заметку</button>
    </form>

    <h2>Сохраненные заметки</h2>
    <?php
    $notesPath = __DIR__ . "/notes.txt";
    if (file_exists($notesPath)) {
        $notes = file_get_contents($notesPath);
        echo "<pre>" . htmlspecialchars($notes, ENT_QUOTES, "UTF-8") . "</pre>";
    } else {
        echo "<p>Заметок пока нет.</p>";
    }
    ?>
</main>
</body>
</html>
