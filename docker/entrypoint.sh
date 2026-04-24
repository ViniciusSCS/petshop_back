#!/bin/bash

set -e

echo "🔧 Ajustando permissões..."
chown -R www-data:www-data storage bootstrap/cache

echo "🧬 Rodando migrations..."
php artisan migrate --force

echo "🌱 Seed (opcional - só primeira vez)"
php artisan db:seed --force || true

echo "🔐 Verificando Passport keys..."
php artisan passport:keys --force || true

echo "🚀 Subindo servidor..."
php artisan serve --host=0.0.0.0 --port=10000