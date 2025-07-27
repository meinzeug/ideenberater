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
│   └── config.php (.env)
└── nginx/
    └── ideenberater.conf
```

## PHP-Ablauf
1. Nutzer ruft `index.php` auf und gibt sein Problem ein.
2. Das Formular sendet die Eingabe via POST an `request.php`.
3. `request.php` liest den OpenRouter-Token aus `config.php` und stellt eine
   HTTP-Anfrage an die OpenRouter-API.
4. Die Antwort wird im Browser ausgegeben (HTML). Optional könnte hier auch
   eine Markdown- oder PDF-Exportfunktion eingebunden werden.

## OpenRouter-API
- Endpoint: wird über die Konfiguration festgelegt.
- Authentifizierung: Bearer-Token aus `.env` bzw. `config.php`.
- Rückgabe: JSON mit den KI-Vorschlägen, die in `request.php` gerendert werden.

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
- Export der KI-Antwort als Markdown oder PDF.
- Sprachumschaltung (DE/EN) über GET-Parameter oder Session.
- Einfache Authentifizierung per htpasswd oder ähnlichem Mechanismus.
