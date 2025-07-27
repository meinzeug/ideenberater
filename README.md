# 💡 Konzept: Ideenberater (PHP-Version, einfach & dockerisiert)

## 🎯 Ziel
Einfaches PHP-Webinterface auf eigener Domain (z. B. `ideenberater.domain.org`), das OpenRouter nutzt, um KI-basierte Vorschläge für Softwareideen zu liefern.  
Die App wird komplett per `install.sh` eingerichtet, inklusive Docker-Container, Nginx-Reverse-Proxy und SSL.

---

## 🔁 Installationsprozess (`install.sh`)

### 1. Voraussetzung prüfen
- Ist `docker` und `docker-compose` vorhanden?
- Ist `nginx` vorhanden?
- Falls nicht → automatische Installation via Paketmanager (`apt`, `dnf`, etc.)

### 2. Benutzerabfrage
- Domain (z. B. `ideenberater.domain.org`)
- OpenRouter-Token
- E-Mail-Adresse für SSL (Let's Encrypt)

### 3. GitHub-Repo klonen
- Repo wird z. B. nach `/opt/ideenberater` heruntergeladen

### 4. Docker-Container starten
- Docker-Container enthält:
  - Apache + PHP
  - PHP-Webanwendung (Indexseite mit Formular)
- Container wird über Port 8080 oder 8000 bereitgestellt

### 5. Nginx konfigurieren (Reverse Proxy)
- Neue Nginx-Site wird erstellt:
  - Weiterleitung von `ideenberater.domain.org` → localhost:8080 (Docker)
  - SSL via Certbot (Let's Encrypt)
- Certbot-Setup + Auto-Renewal

---

## 🌐 Funktionen der App (PHP)

### index.php
- Eingabefeld: *„Beschreibe dein Problem“*
- Button: *„Beraten lassen“*
- Ergebnis: KI-Antwort mit Vorschlägen für passende Softwareideen

### request.php
- Nimmt POST-Daten entgegen
- Sendet Anfrage an OpenRouter-API (mit Token)
- Gibt KI-Antwort im HTML zurück

### .env oder config.php
- Speicherung des OpenRouter-Tokens

---

## 📦 Technologie-Stack

| Bereich        | Technologie         |
|----------------|---------------------|
| Webserver      | Apache (im Docker)  |
| Sprache        | PHP (kein Framework)|
| KI-API         | OpenRouter          |
| Container      | Docker              |
| Reverse Proxy  | Nginx               |
| SSL            | Certbot (Let's Encrypt) |
| Domain         | Beliebige via `install.sh` |

---

## 🔐 Sicherheit & Betrieb

- HTTPS dank Let's Encrypt (Auto-Renewal via Cron)
- Zugriff auf PHP nur über Nginx + SSL
- Docker-Isolierung für die PHP-App
- Updates durch `git pull && docker-compose restart` möglich

---

## ✅ Vorteile dieses Ansatzes

- Kein Node.js, kein Python → minimale Abhängigkeiten
- PHP ist schnell, einfach und überall einsetzbar
- KI-Funktionalität über einfache API
- Automatisierte Einrichtung für Nicht-Admins geeignet

---

## 🔧 Erweiterbar (optional)

- Logging der Anfragen
- Markdown- oder PDF-Export der KI-Antwort
- Sprachumschaltung (DE/EN)
- Simple Authentifizierung (z. B. per Passwort)

---
