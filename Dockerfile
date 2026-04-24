FROM php:7.4-cli

WORKDIR /var/www

# =========================
# Dependências
# =========================
RUN apt-get update && apt-get install -y \
    git curl unzip zip \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    libzip-dev libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# =========================
# Composer
# =========================
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# =========================
# Código
# =========================
COPY ./back/ /var/www/

RUN chown -R www-data:www-data /var/www

# =========================
# Dependências Laravel
# =========================
RUN composer install --no-dev --optimize-autoloader

# =========================
# Estrutura Laravel
# =========================
RUN mkdir -p \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

RUN chown -R www-data:www-data storage bootstrap/cache

# =========================
# Passport (evita erro de key)
# =========================
RUN php artisan passport:keys --force || true

# =========================
# Porta
# =========================
EXPOSE 10000

# =========================
# START CONTROLADO
# =========================
CMD sh -c "\
php artisan migrate --force || true && \
php artisan db:seed --force || true && \
php artisan serve --host=0.0.0.0 --port=10000 \
"