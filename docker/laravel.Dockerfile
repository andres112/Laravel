# Laravel Dockerfile
# =========================
# docker build -t laravel-base -f laravel.Dockerfile .
# Run Laravel container only, otherwise use docker-compose from each project
# docker run -d --name laravel-tasklist -p 8080:80 -v ${pwd}/tasklist:/var/www/html laravel-base

# Initialize laravel project
# ========================
# docker exec -u www-data -it laravel-tasklist bash
# composer create-project laravel/laravel .
# php artisan key:generate

# =========================
# Base image
# =========================
FROM php:8.3-apache

# =========================
# System dependencies
# =========================
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    vim \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# =========================
# PHP extensions
# =========================
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip

# =========================
# Enable Apache modules
# =========================
RUN a2enmod rewrite headers

# =========================
# Set Apache document root
# Laravel serves from /public
# =========================
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
ENV HOME=/var/www/html

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# =========================
# Install Composer (official)
# =========================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# =========================
# Set working directory
# =========================
WORKDIR /var/www/html

# =========================
# Permissions (important for Laravel)
# =========================
RUN chown -R www-data:www-data /var/www/html

# =========================
# Expose port
# =========================
EXPOSE 80

# =========================
# Start Apache
# =========================
CMD ["apache2-foreground"]
