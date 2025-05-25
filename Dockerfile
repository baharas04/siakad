FROM php:8.2-apache

# Install dependencies dan ekstensi PHP yang dibutuhkan (termasuk intl)
RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev libpng-dev libonig-dev libxml2-dev libicu-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd intl

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Jalankan composer install (gunakan --no-interaction agar non-interaktif)
RUN composer install --no-interaction --optimize-autoloader

# Expose port 80
EXPOSE 80
