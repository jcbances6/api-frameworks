FROM php:8.2-cli

WORKDIR /var/www/html

# System deps for common PHP extensions and Laravel tooling
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libpng-dev \
        libonig-dev \
        libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts

COPY . .

# Run Laravel's package discovery after the app files are available
RUN php artisan package:discover --ansi

# Ensure storage and cache directories are writable
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=${PORT}

