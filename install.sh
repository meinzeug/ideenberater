#!/bin/bash
# Installationsskript für Ideenberater
set -e

if [ "$EUID" -ne 0 ]; then
    echo "Bitte als root ausführen." >&2
    exit 1
fi

read -p "Domain (z.B. ideenberater.domain.org): " DOMAIN
read -p "OpenRouter Token: " TOKEN
read -p "E-Mail für Let's Encrypt: " EMAIL

# Pakete installieren
export DEBIAN_FRONTEND=noninteractive
apt-get update
apt-get install -y docker.io docker-compose nginx certbot python3-certbot-nginx git

# Repository klonen
git clone https://github.com/ideenberater/ideenberater.git /opt/ideenberater
cd /opt/ideenberater

# .env erstellen
cat > .env <<EOF2
OPENROUTER_TOKEN=$TOKEN
OPENROUTER_ENDPOINT=https://openrouter.ai/api/v1/chat/completions
EOF2

# Docker starten
docker-compose up -d

# Nginx konfigurieren
cp nginx/ideenberater.conf /etc/nginx/sites-available/ideenberater.conf
sed -i "s/ideenberater.example.org/$DOMAIN/" /etc/nginx/sites-available/ideenberater.conf
ln -s /etc/nginx/sites-available/ideenberater.conf /etc/nginx/sites-enabled/
nginx -s reload

# SSL Zertifikat
certbot --nginx -d $DOMAIN --non-interactive --agree-tos -m $EMAIL
