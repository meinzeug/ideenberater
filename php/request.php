<?php
// request.php - Sendet die Anfrage an die OpenRouter-API und gibt die Antwort aus

$config = include __DIR__ . '/config.php';
$token = $config['OPENROUTER_TOKEN'] ?? '';
$endpoint = $config['OPENROUTER_ENDPOINT'] ?? 'https://openrouter.ai/api/v1/chat/completions';

if (!$token || $token === 'DEIN_TOKEN_HIER') {
    die('API-Token fehlt. Bitte in config.php oder .env hinterlegen.');
}

$problem = $_POST['problem'] ?? '';
if (!$problem) {
    die('Keine Eingabe erhalten.');
}

$ch = curl_init($endpoint);

$model = $config['OPENROUTER_MODEL'] ?? 'gpt-3.5-turbo';
$data = [
    'model' => $model,
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
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($httpCode !== 200) {
    die('API Fehler: HTTP ' . $httpCode);
}
curl_close($ch);

$answer = json_decode($response, true);
$jsonError = json_last_error();
if ($jsonError !== JSON_ERROR_NONE) {
    die('Ungültige Antwort von der API: ' . json_last_error_msg());
}
$suggestion = $answer['choices'][0]['message']['content'] ?? 'Keine Antwort erhalten.';

// Anfrage und Antwort protokollieren
$logDir = dirname(__DIR__) . '/logs';
if (!is_dir($logDir)) {
    mkdir($logDir, 0775, true);
}
$logFile = $logDir . '/requests.log';
$logEntry = date('c') . ' | INPUT: ' . str_replace(["\n", "\r"], ' ', $problem)
    . ' | OUTPUT: ' . str_replace(["\n", "\r"], ' ', $suggestion) . PHP_EOL;
file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);

// Antwort als Markdown exportieren
$exportDir = __DIR__ . '/exports';
if (!is_dir($exportDir)) {
    mkdir($exportDir, 0775, true);
}
$exportFile = $exportDir . '/idea_' . date('Ymd_His') . '.md';
file_put_contents($exportFile, "# Idee\n\n" . $suggestion);
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
    <p><a href="exports/<?php echo basename($exportFile); ?>" download>Markdown herunterladen</a></p>
    <a href="index.php">Neue Anfrage</a>
</body>
</html>
