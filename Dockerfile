FROM php:8.1-apache

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Activer mod_rewrite pour Symfony
RUN a2enmod rewrite

# Configurer Apache pour Symfony
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Copier le code
WORKDIR /var/www/html
COPY . .

# Installer les dépendances et optimiser
RUN composer install --no-dev --optimize-autoloader
RUN php bin/console cache:clear --env=prod

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80