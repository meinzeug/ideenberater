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

## 2025-07-27 (Codex Lauf Zusätzlich)
- Logging für Nutzeranfragen umgesetzt.
- Neue Datei `logs/requests.log` fängt Problem und Antwort auf.
- Dokumentation entsprechend ergänzt.

## 2025-07-27 (Codex Lauf erneut)
- `.env` soll nicht versioniert werden. Um Nutzern ein Beispiel zu geben, habe ich die Datei in `.env.example` umbenannt.
- `.gitignore` angepasst, damit `.env.example` im Repo verbleibt, aber echte `.env` Dateien weiterhin ignoriert werden.
- Dokumentation aktualisiert (README, docs.md, Konzept, Milestones).

## 2025-07-27 (Codex Lauf weiter)
- Erweiterung der Konfiguration um `OPENROUTER_MODEL`.
- PHP-Skripte angepasst, sodass das Modell über die Umgebung gesteuert werden kann.
- Dokumentation und README entsprechend ergänzt.

## 2025-07-27 (Codex Lauf erneut)
- Markdown-Export umgesetzt.
- Neue Ablage `php/exports/` erzeugt und in `.gitignore` eingetragen.
- README, docs und Konzept aktualisiert.

## 2025-07-27 (Codex Lauf Sprache)
- Sprachumschaltung zwischen DE und EN implementiert.
- Neue Datei php/lang.php mit Übersetzungen.
- index.php und request.php angepasst.
- Dokumentation aktualisiert.

## 2025-07-27 (Codex Lauf Systemnachricht)
- Der System-Prompt der API wurde mehrsprachig ausgeführt.
- Übersetzung `system_message` in lang.php ergänzt.
- request.php nutzt nun diese Übersetzung.

## 2025-07-27 (Codex Lauf Auth)
- Installationsskript erweitert, um optional Basic Auth per htpasswd einzurichten.
- nginx-Konfiguration kommentiert, install.sh fügt Einträge bei Bedarf ein.
- Dokumentation und README aktualisiert.

## 2025-07-28 (Codex Lauf)
- Idee: Fehlermeldungen sollen ebenfalls zweisprachig sein.
- Neue Keys in `lang.php` für diverse Fehlermeldungen angelegt.
- `request.php` nutzt diese Texte jetzt für `die()`-Ausgaben.
- README und docs entsprechend ergänzt.

## 2025-07-28 (Codex Lauf PDF)
- Erweiterung: Export der Antwort als PDF.
- FPDF-Bibliothek integriert und Download-Link ergänzt.
- Dokumentation und README auf aktuellen Stand gebracht.

## 2025-07-28 (Codex Lauf Placeholder)
- Kleines UI-Update: Eingabefeld in `index.php` besitzt nun einen Platzhalter
  und ist als Pflichtfeld markiert.
