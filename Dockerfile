FROM php:8.2-apache

# Install ekstensi dan dependensi PHP
RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev libpng-dev libonig-dev libxml2-dev libicu-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd intl

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# Copy source project
COPY . /var/www/html/

# Set writable permission
RUN mkdir -p /var/www/html/writable/cache \
 && chmod -R 775 /var/www/html/writable


# Set working directory
WORKDIR /var/www/html

# Ubah DocumentRoot ke folder public/
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install

# Expose port
EXPOSE 80
