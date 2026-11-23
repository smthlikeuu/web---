<?php
session_start();

$name = trim($_SESSION["name"] ?? "");
$technology = $_COOKIE["technology"] ?? "";
$comment = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $technology = trim($_POST["technology"] ?? "");
    $comment = trim($_POST["comment"] ?? "");

    if ($name === "" || $comment === "") {
        $message = "Имя и комментарий обязательны.";
    } else {
        $_SESSION["name"] = $name;
        if ($technology !== "") {
            setcookie("technology", $technology, time() + 3600, "/");
        }
        $safeName = htmlspecialchars($name, ENT_QUOTES, "UTF-8");
        $safeTechnology = htmlspecialchars($technology, ENT_QUOTES, "UTF-8");
        $line = $name . " — " . $comment . PHP_EOL;
        file_put_contents(__DIR__ . "/comments.txt", $line, FILE_APPEND | LOCK_EX);
        $message = "Комментарий сохранен.";
    }
}

$commentsPath = __DIR__ . "/comments.txt";
$comments = file_exists($commentsPath) ? file_get_contents($commentsPath) : "";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Моя дисциплина</title>
    <style>
        body{font-family:Arial,sans-serif;max-width:760px;margin:36px auto;padding:0 18px;background:#f2f5f7;color:#243746}
        main{background:#fff;border:1px solid #d6e0e6;border-radius:12px;padding:26px}
        label{display:block;margin:14px 0 6px;font-weight:700}
        input,textarea{width:100%;box-sizing:border-box;padding:10px;border:1px solid #aebdc8;border-radius:6px;font:inherit}
        textarea{min-height:100px}
        button{margin-top:14px;padding:10px 16px;border:0;border-radius:6px;background:#245b7b;color:#fff;font:inherit;font-weight:700;cursor:pointer}
        .notice{padding:10px;background:#edf5ef;border-left:4px solid #45825b}
        pre{white-space:pre-wrap;background:#f7f9fa;padding:14px;border:1px solid #d6e0e6;border-radius:6px}
    </style>
</head>
<body>
<main>
    <h1>Моя дисциплина</h1>
    <form method="post">
        <label for="name">Имя</label>
        <input id="name" name="name" type="text" value="<?= htmlspecialchars($name, ENT_QUOTES, "UTF-8") ?>">
        <label for="technology">Любимая web-технология</label>
        <input id="technology" name="technology" type="text" value="<?= htmlspecialchars($technology, ENT_QUOTES, "UTF-8") ?>">
        <label for="comment">Комментарий</label>
        <textarea id="comment" name="comment"><?= htmlspecialchars($comment, ENT_QUOTES, "UTF-8") ?></textarea>
        <button type="submit">Сохранить</button>
    </form>

    <?php if ($message !== ""): ?>
        <p class="notice"><?= htmlspecialchars($message, ENT_QUOTES, "UTF-8") ?></p>
    <?php endif; ?>

    <h2>Сохраненное состояние</h2>
    <p>Имя в Session: <?= htmlspecialchars($name, ENT_QUOTES, "UTF-8") ?: "не задано" ?></p>
    <p>Технология в Cookie: <?= htmlspecialchars($technology, ENT_QUOTES, "UTF-8") ?: "не задана" ?></p>

    <h2>Комментарии из файла</h2>
    <?php if (file_exists($commentsPath)): ?>
        <pre><?= htmlspecialchars($comments, ENT_QUOTES, "UTF-8") ?></pre>
    <?php else: ?>
        <p>Комментариев пока нет.</p>
    <?php endif; ?>
</main>
</body>
</html>
