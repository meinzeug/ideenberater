# Dokumentation

Dieses Dokument beschreibt die wichtigsten Technologien, Module und Abläufe
im Projekt **Ideenberater**.

## Technologieübersicht

| Bereich        | Technologie                     |
|----------------|---------------------------------|
| Webserver      | Apache (Docker)                 |
| Sprache        | PHP (ohne Framework)            |
| KI-API         | OpenRouter                      |
| Container      | Docker, docker-compose          |
| Reverse Proxy  | Nginx                           |
| SSL            | Certbot (Let's Encrypt)         |

## Verzeichnisstruktur (geplant)

```
/opt/ideenberater
├── docker-compose.yml
├── php/
│   ├── index.php
│   ├── request.php
│   └── config.php (.env.example / .env)
├── logs/
│   └── requests.log
└── nginx/
    └── ideenberater.conf
```

## PHP-Ablauf
1. Nutzer ruft `index.php` auf und gibt sein Problem ein.
2. Das Formular sendet die Eingabe via POST an `request.php`.
3. `request.php` liest den OpenRouter-Token aus `config.php` und stellt eine
   HTTP-Anfrage an die OpenRouter-API.
4. Die Antwort wird im Browser ausgegeben (HTML).
5. Anfrage und Antwort werden in `logs/requests.log` protokolliert.
6. Die Antwort wird zusätzlich als Markdown-Datei im Verzeichnis `php/exports/` gespeichert.

## OpenRouter-API
- Endpoint: wird über die Konfiguration festgelegt.
- Authentifizierung: Bearer-Token aus `.env` (angelegt aus `.env.example`) bzw. `config.php`.
- Rückgabe: JSON mit den KI-Vorschlägen, die in `request.php` gerendert werden.
- Modellauswahl über `OPENROUTER_MODEL` möglich (Standard: `gpt-3.5-turbo`).

## Installationsskript (`install.sh`)
Das Skript führt folgende Schritte aus:
1. Pakete prüfen und ggf. installieren.
2. Parameter (Domain, Token, Mail) abfragen.
3. Repository nach `/opt/ideenberater` klonen.
4. Docker-Container per `docker-compose up -d` starten.
5. Nginx-Site anlegen und aktivieren.
6. SSL-Zertifikat via Certbot erstellen.
7. Cronjob für Auto-Renewal einrichten.

## Erweiterungsmöglichkeiten
- Logging der Nutzeranfragen in einer Datei oder Datenbank.
- PDF-Export der KI-Antwort.
- Sprachumschaltung (DE/EN) über GET-Parameter oder Session (bereits umgesetzt).
- Einfache Authentifizierung per htpasswd oder ähnlichem Mechanismus.

## Entwicklungsumgebung
Für lokale Tests steht das Skript `codex/env_setup.sh` bereit. Es installiert Docker, Nginx, PHP und weitere Tools. Anschließend können die Container mit `docker-compose up -d` gestartet werden.
