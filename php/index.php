<?php
// index.php - Einfaches Formular für den Ideenberater
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ideenberater</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2em; }
        textarea { width: 100%; max-width: 500px; }
        button { padding: 0.5em 1em; }
    </style>
</head>
<body>
    <h1>Ideenberater</h1>
    <form action="request.php" method="post">
        <label for="problem">Beschreibe dein Problem:</label><br>
        <textarea name="problem" id="problem" cols="50" rows="5"></textarea><br>
        <button type="submit">Beraten lassen</button>
    </form>
</body>
</html>
