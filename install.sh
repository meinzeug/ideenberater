#!/bin/bash
# Installationsskript für Ideenberater
set -e

if [ "$EUID" -ne 0 ]; then
    echo "Bitte als root ausführen." >&2
    exit 1
fi

read -r -p "Domain (z.B. ideenberater.domain.org): " DOMAIN
read -r -p "OpenRouter Token: " TOKEN
read -r -p "E-Mail für Let's Encrypt: " EMAIL
# Optionale Authentifizierung
read -r -p "Einfache Authentifizierung einrichten? [y/N]: " SET_AUTH
if [[ $SET_AUTH =~ ^[Yy]$ ]]; then
    read -r -p "Benutzername: " AUTH_USER
    read -r -s -p "Passwort: " AUTH_PASS
    echo
    AUTH_ENABLED="yes"
fi

# Pakete installieren
export DEBIAN_FRONTEND=noninteractive
apt-get update

# Bestehende Docker-Pakete entfernen, um Konflikte zu vermeiden
apt-get remove -y docker docker-engine docker.io containerd runc 2>/dev/null || true

# Docker Repository einrichten
install -m 0755 -d /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | gpg --dearmor -o /etc/apt/keyrings/docker.gpg
echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" > /etc/apt/sources.list.d/docker.list
apt-get update

# Docker aus dem offiziellen Repository installieren
apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# Weitere benötigte Pakete installieren
apt-get install -y nginx certbot python3-certbot-nginx git
if [ "$AUTH_ENABLED" = "yes" ]; then
    apt-get install -y apache2-utils
fi

# Repository klonen
git clone https://github.com/ideenberater/ideenberater.git /opt/ideenberater
cd /opt/ideenberater

# .env aus Vorlage erstellen
cp .env.example .env
sed -i "s|DEIN_TOKEN_HIER|$TOKEN|" .env

# Docker starten
docker compose up -d

# Nginx konfigurieren
cp nginx/ideenberater.conf /etc/nginx/sites-available/ideenberater.conf
sed -i "s/ideenberater.example.org/$DOMAIN/" /etc/nginx/sites-available/ideenberater.conf
if [ "$AUTH_ENABLED" = "yes" ]; then
    htpasswd -bc /etc/nginx/.htpasswd_ideenberater "$AUTH_USER" "$AUTH_PASS"
    sed -i "/proxy_set_header X-Forwarded-Proto \$scheme;/a \    auth_basic \"Geschuetzt\";\n    auth_basic_user_file /etc/nginx/.htpasswd_ideenberater;" /etc/nginx/sites-available/ideenberater.conf
fi
ln -s /etc/nginx/sites-available/ideenberater.conf /etc/nginx/sites-enabled/
nginx -s reload

# SSL Zertifikat
certbot --nginx -d "$DOMAIN" --non-interactive --agree-tos -m "$EMAIL"

# Cronjob für Auto-Renewal des Zertifikats einrichten
(crontab -l 2>/dev/null; echo "0 3 * * * certbot renew --quiet && systemctl reload nginx") | crontab -
