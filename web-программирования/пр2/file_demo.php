<?php
$path = __DIR__ . "/message.txt";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $text = trim($_POST["text"] ?? "");
    if ($text === "") {
        $message = "Введите текст перед сохранением.";
    } else {
        file_put_contents($path, $text, LOCK_EX);
        $message = "Содержимое файла обновлено.";
    }
}

$fileText = file_exists($path) ? file_get_contents($path) : "";
?>
<!doctype html>
<html lang="ru"><head><meta charset="utf-8"><title>Файловый ввод-вывод</title></head><body>
<h1>Файловый ввод-вывод</h1>
<form method="post"><label for="text">Текст для файла:</label><br><textarea id="text" name="text" rows="4" cols="45"></textarea><br><button type="submit">Записать</button></form>
<p><?= htmlspecialchars($message, ENT_QUOTES, "UTF-8") ?></p>
<h2>Содержимое message.txt</h2>
<?php if (file_exists($path)): ?><pre><?= htmlspecialchars($fileText, ENT_QUOTES, "UTF-8") ?></pre><?php else: ?><p>Файл пока не создан.</p><?php endif; ?>
</body></html>
