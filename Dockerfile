FROM php:8.2-apache

# Install dependencies dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev libpng-dev libonig-dev libxml2-dev libicu-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd intl

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set Apache DocumentRoot ke folder public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Update konfigurasi Apache agar pakai DocumentRoot yang baru
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# Copy project ke dalam container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader

# Expose port 80
EXPOSE 80
