FROM php:8.1-apache

# Installer les extensions PHP nécessaires pour Symfony
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libonig-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
        zip \
        pdo \
        pdo_mysql \
        intl \
        gd \
        mbstring

# Installer Composer avec plus de mémoire
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1

# Configurer Apache
RUN a2enmod rewrite
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Copier le code
WORKDIR /var/www/html
COPY composer.json composer.lock ./

# Installer les dépendances SANS --no-dev d'abord
RUN composer install --no-scripts --no-autoloader

# Copier le reste du code
COPY . .

# Finaliser composer et cache
RUN composer dump-autoload --optimize
RUN php bin/console cache:clear --env=prod --no-debug || true

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80