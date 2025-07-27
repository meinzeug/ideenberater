#!/usr/bin/env bash
# Setup environment for the Ideenberater project
# Installs required packages and useful debugging tools

set -e

# Update package lists
sudo apt-get update

# Base utilities
sudo apt-get install -y git curl build-essential vim nano less lsof net-tools

# Docker aus dem offiziellen Repository
sudo apt-get remove -y docker docker-engine docker.io containerd runc 2>/dev/null || true
sudo install -m 0755 -d /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list
sudo apt-get update
sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# Nginx and Certbot for reverse proxy and SSL
sudo apt-get install -y nginx certbot python3-certbot-nginx

# PHP runtime
sudo apt-get install -y php php-cli php-fpm php-curl

# Enable Docker service
sudo systemctl enable --now docker

# Print versions for verification
docker --version
docker compose version
nginx -v
php -v
