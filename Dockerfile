FROM php:7.4-cli

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    libzip-dev libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Código
COPY ./back/ /var/www/

# Permissões
RUN chown -R www-data:www-data /var/www

# dependências
RUN composer install --no-dev --optimize-autoloader

# storage obrigatório Laravel
RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

RUN chown -R www-data:www-data storage bootstrap/cache

# NÃO roda passport aqui (IMPORTANTE)
EXPOSE 10000

# ENTRYPOINT seguro
CMD ["bash", "-c", "php artisan config:cache && php artisan migrate --force && php artisan passport:install --force || true && php artisan serve --host=0.0.0.0 --port=10000"]