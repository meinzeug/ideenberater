<?php
// index.php - Einfaches Formular für den Ideenberater mit Sprachumschaltung
session_start();
$lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'de';
if (!in_array($lang, ['de', 'en'])) {
    $lang = 'de';
}
$_SESSION['lang'] = $lang;
$translations = include __DIR__ . '/lang.php';
$t = $translations[$lang];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($t['title']); ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2em; }
        textarea { width: 100%; max-width: 500px; }
        button { padding: 0.5em 1em; }
    </style>
</head>
<body>
    <p><a href="?lang=de">DE</a> | <a href="?lang=en">EN</a></p>
    <h1><?php echo htmlspecialchars($t['title']); ?></h1>
    <form action="request.php" method="post">
        <label for="problem"><?php echo htmlspecialchars($t['prompt']); ?></label><br>
        <textarea name="problem" id="problem" cols="50" rows="5" placeholder="<?php echo htmlspecialchars($t['prompt']); ?>" required></textarea><br>
        <button type="submit"><?php echo htmlspecialchars($t['button']); ?></button>
    </form>
</body>
</html>
