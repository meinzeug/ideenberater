# Changelog

## [2025-07-27]
- Initiale Dateien in `codex/daten/` angelegt:
  - `konzept.md`
  - `docs.md`
  - `milestones.md`
  - `brain.md`
  - `changelog.md`
  - `prompt.md` (wird im Anschluss generiert)

## [2025-07-27] Added env_setup script
- `env_setup.sh` in `codex/` legt Entwicklungswerkzeuge und Abhängigkeiten an.

## [2025-07-27] Basisinfrastruktur
- `docker-compose.yml` und `Dockerfile` hinzugefügt
- PHP-Verzeichnis mit `index.php`, `request.php` und `config.php` erstellt
- Beispiel `.env` angelegt
- Nginx-Konfiguration `nginx/ideenberater.conf` erstellt
- `install.sh` als Installationsskript angelegt

## [2025-07-27] Verbesserungen
- Installationsskript erweitert: Root-Prüfung, noninteractive apt, Repository-URL angepasst
- Indexseite mit minimalem CSS versehen

## [2025-07-27] Weitere Verbesserungen
- Cronjob in install.sh für automatisches Zertifikats-Renewal eingerichtet.
  - shellcheck Hinweise umgesetzt (read -r, Quotes)
