# Utilise l'image officielle PHP avec Apache
FROM php:8.2-apache

# Installe les extensions PHP nécessaires (par exemple, mysqli pour MySQL)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copie le code de ton site dans le dossier /var/www/html du conteneur
COPY . /var/www/html/

# Expose le port 80 (le port par défaut pour Apache)
EXPOSE 80

# Définir le document root (facultatif, selon ton architecture de fichiers)
WORKDIR /var/www/html

# Active le mod_rewrite d'Apache si nécessaire (pour les URL rewriting par exemple)
RUN a2enmod rewrite
