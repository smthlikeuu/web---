<?php
$fullName = "";
$specialty = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = trim($_POST["fullName"] ?? "");
    $specialty = trim($_POST["specialty"] ?? "");

    if ($fullName === "" || $specialty === "") {
        $message = "Заполните оба поля.";
    } else {
        $safeFullName = htmlspecialchars($fullName, ENT_QUOTES, "UTF-8");
        $safeSpecialty = htmlspecialchars($specialty, ENT_QUOTES, "UTF-8");
        $message = "Студент: $safeFullName. Специальность: $safeSpecialty.";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Карточка студента</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 720px; margin: 40px auto; padding: 0 20px; color: #263746; background: #f3f6f8; }
        main { background: #fff; border: 1px solid #d8e0e5; border-radius: 12px; padding: 28px; }
        label { display: block; margin: 16px 0 6px; font-weight: 700; }
        input { width: 100%; box-sizing: border-box; padding: 10px 12px; border: 1px solid #aebdc8; border-radius: 6px; font: inherit; }
        button { margin-top: 20px; padding: 11px 18px; border: 0; border-radius: 6px; background: #245b7b; color: white; font: inherit; font-weight: 700; cursor: pointer; }
        .result { margin-top: 20px; padding: 12px; background: #edf5ef; border-left: 4px solid #45825b; }
    </style>
</head>
<body>
<main>
    <h1>Карточка студента</h1>
    <form method="post">
        <label for="fullName">Фамилия и имя:</label>
        <input id="fullName" type="text" name="fullName" value="<?= htmlspecialchars($fullName, ENT_QUOTES, "UTF-8") ?>">

        <label for="specialty">Специальность:</label>
        <input id="specialty" type="text" name="specialty" value="<?= htmlspecialchars($specialty, ENT_QUOTES, "UTF-8") ?>">

        <button type="submit">Сохранить карточку</button>
    </form>

    <?php if ($message !== ""): ?>
        <p class="result"><?= $message ?></p>
    <?php endif; ?>
</main>
</body>
</html>
