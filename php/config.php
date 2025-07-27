<?php
// config.php - Einfache Konfigurationsdatei
return [
    // OpenRouter API Token eintragen
    'OPENROUTER_TOKEN' => getenv('OPENROUTER_TOKEN') ?: 'DEIN_TOKEN_HIER',
    // Optional anderer Endpoint
    'OPENROUTER_ENDPOINT' => getenv('OPENROUTER_ENDPOINT') ?: 'https://openrouter.ai/api/v1/chat/completions',
];
