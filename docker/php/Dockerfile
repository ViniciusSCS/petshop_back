FROM php:7.4-fpm

WORKDIR /var/www

RUN rm -rf /var/www/html

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    apt-utils \
    libonig-dev

RUN docker-php-ext-install zip pdo_mysql mbstring exif
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

# habilita instalação do Redis
RUN pecl install redis \
    && docker-php-ext-enable redis

RUN docker-php-ext-configure pcntl --enable-pcntl \
  && docker-php-ext-install \
    pcntl

RUN mkdir -p /usr/src/php/ext/redis; \
	curl -fsSL https://pecl.php.net/get/redis --ipv4 | tar xvz -C "/usr/src/php/ext/redis" --strip 1; \
	docker-php-ext-install redis;

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia apenas o conteúdo do backend (pasta back/) para o container
COPY ./back/ /var/www/

# Cria o grupo e o usuário 'laravel'
RUN groupadd -g 1000 laravel
RUN useradd -u 1000 -ms /bin/bash -g laravel laravel

# Garante permissões adequadas para os arquivos
RUN chown -R laravel:laravel /var/www && chmod -R 755 /var/www

# Instala as dependências do Composer
RUN composer install --no-interaction --optimize-autoloader

#RUN groupadd -g 1000 laravel
#RUN useradd -u 1000 -ms /bin/bash -g laravel user

EXPOSE 9000

CMD ["php-fpm"]
