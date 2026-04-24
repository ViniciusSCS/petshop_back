FROM php:7.4-cli

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip unzip git curl \
    libzip-dev libonig-dev \
    && docker-php-ext-install zip pdo_mysql mbstring exif \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia projeto
COPY ./back/ /var/www/

# Permissões básicas
RUN chown -R www-data:www-data /var/www

# Dependências
RUN composer install --no-dev --optimize-autoloader

# 🧠 IMPORTANTE: garantir storage e bootstrap
RUN mkdir -p storage/framework/{cache,sessions,views} \
    storage/logs \
    bootstrap/cache

RUN chown -R www-data:www-data storage bootstrap/cache

# 🔐 Passport keys (garantia inicial)
RUN php artisan passport:keys --force || true

# Porta Render
EXPOSE 10000

CMD ["/var/www/docker/entrypoint.sh"]