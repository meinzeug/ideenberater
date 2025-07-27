# Konzept: Ideenberater

Das Projekt "Ideenberater" ist eine leichtgewichtige PHP-Webanwendung, die
mithilfe der OpenRouter-API kreative Vorschläge für Softwareideen generiert.
Die Anwendung läuft in einem Docker-Container (Apache + PHP) und wird per
Nginx als Reverse Proxy unter einer beliebigen Domain bereitgestellt. Die
Installation erfolgt automatisiert über ein Skript `install.sh`, das den
kompletten Server einrichtet, inklusive SSL via Let's Encrypt.

## Ziel
* Schnelle Bereitstellung einer webbasierten Ideenberatung.
* Minimale Abhängigkeiten: nur Docker, Nginx, PHP.
* Vollautomatische Installation inkl. Zertifikatsverwaltung.

## Hauptkomponenten
1. **PHP-Webapp**
   - `index.php`: Formular für Nutzereingaben
   - `request.php`: Weiterleitung der Anfrage an die OpenRouter-API und
     Rückgabe der Antwort
   - `.env.example` dient als Vorlage für `.env`
   - `config.php` liest den Token aus der erstellten `.env`

2. **Docker-Umgebung**
   - Container mit Apache und PHP
   - Bereitstellung des Webverzeichnisses

3. **Installationsskript** (`install.sh`)
   - Prüft und installiert erforderliche Pakete (Docker, docker-compose,
     nginx, certbot)
   - Fragt Domain, OpenRouter-Token und E-Mail für SSL ab
   - Klont das Repository (z. B. nach `/opt/ideenberater`)
   - Startet den Docker-Container
   - Richtet Nginx als Reverse Proxy ein
   - Erstellt und erneuert SSL-Zertifikate

4. **Nginx-Konfiguration**
   - Weiterleitung der externen Domain auf den internen Docker-Port
   - TLS-Verschlüsselung via Let's Encrypt

## Besonderheiten
* Kein Einsatz von Node.js oder komplexen Frameworks.
* Updates sind über `git pull` und Neustart des Containers möglich.
* Optionale Erweiterungen: Logging (bereits umgesetzt), Markdown-Exportfunktionen (umgesetzt), Spracheinstellungen,
  einfache Authentifizierung.
