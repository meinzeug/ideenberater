<?php
// request.php - Sendet die Anfrage an die OpenRouter-API und gibt die Antwort aus

$config = include __DIR__ . '/config.php';
$token = $config['OPENROUTER_TOKEN'] ?? '';
$endpoint = $config['OPENROUTER_ENDPOINT'] ?? 'https://openrouter.ai/api/v1/chat/completions';

$problem = $_POST['problem'] ?? '';
if (!$problem) {
    die('Keine Eingabe erhalten.');
}

$ch = curl_init($endpoint);

$data = [
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        ['role' => 'system', 'content' => 'Du bist ein hilfreicher Ideenberater.'],
        ['role' => 'user', 'content' => $problem]
    ]
];

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token
    ],
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data)
]);

$response = curl_exec($ch);
if ($response === false) {
    die('Fehler bei der Anfrage: ' . curl_error($ch));
}
curl_close($ch);

$answer = json_decode($response, true);
$suggestion = $answer['choices'][0]['message']['content'] ?? 'Keine Antwort erhalten.';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ideenberater Antwort</title>
</head>
<body>
    <h1>Antwort</h1>
    <p><?php echo nl2br(htmlspecialchars($suggestion)); ?></p>
    <a href="index.php">Neue Anfrage</a>
</body>
</html>
