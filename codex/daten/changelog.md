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

## [2025-07-27] Projektinitialisierung abgeschlossen
- `.gitignore` hinzugefügt
- `shellcheck` und `env_setup.sh` getestet
- `request.php` prüft Token und API-Status

## [2025-07-27] Fehlerbehandlung verbessert
- `request.php` prüft jetzt JSON-Fehler und bricht bei ungültiger Antwort ab.

## [2025-07-27] Logging hinzugefügt
- Nutzeranfragen und Antworten werden jetzt in `logs/requests.log` gespeichert.
- Dokumentation angepasst (Verzeichnisstruktur und PHP-Ablauf).

## [2025-07-27] Beispiel-Env-Datei
- `.env` in `.env.example` umbenannt
- `.gitignore` angepasst, um Beispieldatei einzuschließen
- Dokumentation entsprechend aktualisiert

## [2025-07-27] Modell konfigurierbar
- `OPENROUTER_MODEL` in `.env.example` aufgenommen
- `config.php` und `request.php` verwenden nun diese Variable
- README und docs ergänzt
