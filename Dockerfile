# Dockerfile für Ideenberater
FROM php:8.2-apache

# Aktivieren der notwendigen PHP-Erweiterungen
RUN docker-php-ext-install curl

# Kopiere PHP-Code ins Webverzeichnis
COPY php/ /var/www/html/

# Aktivieren von mod_rewrite (optional)
RUN a2enmod rewrite

# Setze Berechtigungen
RUN chown -R www-data:www-data /var/www/html
