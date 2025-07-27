# Brain

Dies ist das Arbeitsgedächtnis für das Projekt **Ideenberater**.
Hier werden Fragen, Beobachtungen und wichtige Notizen festgehalten.

## 2025-07-27
- Initiale Projektstruktur angelegt.
- Konzept, Dokumentation und Milestones erstellt.
- Nächster Schritt: Arbeits-Prompt definieren und erste Code-Dateien planen.
- Setup-Skript `env_setup.sh` erstellt, um Entwicklungsumgebung mit Docker, Nginx und PHP auszustatten.

## 2025-07-27 (Fortsetzung)
- Erste Implementierung der Basisinfrastruktur begonnen.
- Dockerfile und docker-compose.yml erstellt.
- Einfaches PHP-Frontend (index.php, request.php, config.php) angelegt.
- Beispielhafte Nginx-Konfiguration und Installationsskript hinzugefügt.

## 2025-07-27 (Codex Lauf)
- Installationsskript verbessert (Root-Prüfung, noninteractive apt).
- Git-URL angepasst.
- Indexseite mit einfachem CSS versehen.

## 2025-07-27 (Codex Lauf Fortsetzung)
- Cronjob für Zertifikatsrenewal in install.sh ergänzt.
- shellcheck Hinweise umgesetzt (read -r, Variablen in Anführungszeichen).

## 2025-07-27 (Codex Lauf Zusatz)
- `.gitignore` hinzugefügt, um `.env` und Editor-Dateien auszuschließen.
- `shellcheck` ausgeführt, keine Warnungen.
- `env_setup.sh` getestet; meldet systemd Fehler im Container, aber Pakete werden installiert.
- `request.php` prüft nun Token und HTTP-Status und gibt Fehlermeldungen aus.

## 2025-07-27 (Codex Lauf Weiter)
- Fehlerbehandlung in `request.php` verbessert: prüft jetzt JSON-Decodierung und meldet Fehler.
- Versuch, Container zu starten scheitert, da Docker-Daemon hier nicht läuft.
