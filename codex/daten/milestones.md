# Milestones für Ideenberater

Dieser Zeitplan beschreibt die wichtigsten Schritte zur Umsetzung des Projekts
bis zur einsatzbereiten Anwendung.

## 1. Projektinitialisierung
- Repository-Struktur anlegen (codex/daten)
- Konzept- und Dokumentationsdateien erstellen

## 2. Grundlegende Infrastruktur
- `docker-compose.yml` erstellen
- Basis-Dockerfile für PHP/Apache vorbereiten
- Beispiel-Nginx-Config anlegen

## 3. PHP-Webanwendung
- `index.php` mit Eingabeformular
- `request.php` für API-Aufrufe
- `config.php` / `.env` mit Token-Verwaltung
- Einfache Gestaltung (HTML/CSS)

## 4. Installationsskript (`install.sh`)
- Prüfung und Installation von Abhängigkeiten
- Benutzerabfragen (Domain, Token, E-Mail)
- Klonen des Repos und Start des Containers
- Einrichtung von Nginx und SSL

## 5. Tests & Optimierung
- Funktionstests der API-Anbindung
- Validierung der Nginx- und SSL-Konfiguration
- Bereitstellung auf Testserver

## 6. Erweiterungen (optional)
- Logging und Exportfunktionen
- Sprachumschaltung
- Einfache Authentifizierung

## 7. Dokumentation finalisieren
- Ausführliche Nutzerdoku
- Hinweise für Updates und Wartung

Der aktuelle Fokus liegt auf **Milestone 1**.
