FROM php:8.2-apache

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev libpng-dev libonig-dev libxml2-dev libicu-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd intl

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# Salin source code ke direktori server
COPY . /var/www/html/

# Set folder kerja
WORKDIR /var/www/html/

# Set permission folder writable
RUN mkdir -p writable/cache \
 && chmod -R 775 writable \
 && chown -R www-data:www-data writable

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

EXPOSE 80
