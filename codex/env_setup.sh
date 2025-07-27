#!/usr/bin/env bash
# Setup environment for the Ideenberater project
# Installs required packages and useful debugging tools

set -e

# Update package lists
sudo apt-get update

# Base utilities
sudo apt-get install -y git curl build-essential vim nano less lsof net-tools

# Docker and docker-compose
sudo apt-get install -y docker.io docker-compose

# Nginx and Certbot for reverse proxy and SSL
sudo apt-get install -y nginx certbot python3-certbot-nginx

# PHP runtime
sudo apt-get install -y php php-cli php-fpm php-curl

# Enable Docker service
sudo systemctl enable --now docker

# Print versions for verification
docker --version
docker-compose --version
nginx -v
php -v
