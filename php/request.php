<?php
// request.php - Sendet die Anfrage an die OpenRouter-API und gibt die Antwort aus
session_start();
$lang = $_SESSION['lang'] ?? 'de';
$translations = include __DIR__ . '/lang.php';
$t = $translations[$lang];

$config = include __DIR__ . '/config.php';
$token = $config['OPENROUTER_TOKEN'] ?? '';
$endpoint = $config['OPENROUTER_ENDPOINT'] ?? 'https://openrouter.ai/api/v1/chat/completions';

if (!$token || $token === 'DEIN_TOKEN_HIER') {
    die($t['error_token_missing']);
}

$problem = $_POST['problem'] ?? '';
if (!$problem) {
    die($t['error_no_input']);
}

$ch = curl_init($endpoint);

$model = $config['OPENROUTER_MODEL'] ?? 'gpt-3.5-turbo';
$systemMessage = $t['system_message'] ?? 'Du bist ein hilfreicher Ideenberater.';
$data = [
    'model' => $model,
    'messages' => [
        ['role' => 'system', 'content' => $systemMessage],
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
    die($t['error_request'] . ' ' . curl_error($ch));
}
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($httpCode !== 200) {
    die($t['error_api'] . ' HTTP ' . $httpCode);
}
curl_close($ch);

$answer = json_decode($response, true);
$jsonError = json_last_error();
if ($jsonError !== JSON_ERROR_NONE) {
    die($t['error_invalid_json'] . ' ' . json_last_error_msg());
}
$suggestion = $answer['choices'][0]['message']['content'] ?? $t['error_no_answer'];

// Anfrage und Antwort protokollieren
$logDir = dirname(__DIR__) . '/logs';
if (!is_dir($logDir)) {
    mkdir($logDir, 0775, true);
}
$logFile = $logDir . '/requests.log';
$logEntry = date('c') . ' | INPUT: ' . str_replace(["\n", "\r"], ' ', $problem)
    . ' | OUTPUT: ' . str_replace(["\n", "\r"], ' ', $suggestion) . PHP_EOL;
file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);

// Antwort exportieren
$exportDir = __DIR__ . '/exports';
if (!is_dir($exportDir)) {
    mkdir($exportDir, 0775, true);
}
$timestamp = date('Ymd_His');
$exportFile = $exportDir . '/idea_' . $timestamp . '.md';
file_put_contents($exportFile, "# Idee\n\n" . $suggestion);

// Zusätzlich als PDF speichern
require_once __DIR__ . '/lib/fpdf.php';
$pdfFile = $exportDir . '/idea_' . $timestamp . '.pdf';
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, $suggestion);
$pdf->Output('F', $pdfFile);
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($t['title'] . ' ' . $t['answer']); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($t['answer']); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($suggestion)); ?></p>
    <p>
        <a href="exports/<?php echo basename($exportFile); ?>" download><?php echo htmlspecialchars($t['download_markdown']); ?></a>
        |
        <a href="exports/<?php echo basename($pdfFile); ?>" download><?php echo htmlspecialchars($t['download_pdf']); ?></a>
    </p>
    <a href="index.php"><?php echo htmlspecialchars($t['new_request']); ?></a>
</body>
</html>
