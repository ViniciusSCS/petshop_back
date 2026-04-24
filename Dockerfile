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

# Permissões
RUN chown -R www-data:www-data /var/www

# Instala dependências
RUN composer install --no-dev --optimize-autoloader

# Porta do Render
EXPOSE 10000

# Start (AQUI É A CHAVE)
CMD php artisan serve --host=0.0.0.0 --port=10000