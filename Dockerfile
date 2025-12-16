# ---------- PHP deps (composer) ----------
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --no-scripts --no-progress

# ---------- Frontend build (vite) ----------
FROM node:20-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY resources/ resources/
COPY vite.config.* postcss.config.* tailwind.config.* ./
# если используешь laravel-mix — подстрой под себя
RUN npm run build

# ---------- App runtime (php-fpm) ----------
FROM php:8.3-fpm-alpine AS app

WORKDIR /var/www/html

# системные зависимости + PHP extensions
RUN apk add --no-cache \
      bash git curl icu-dev oniguruma-dev libzip-dev \
      freetype-dev libpng-dev libjpeg-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo_mysql mbstring zip bcmath intl gd opcache \
    && rm -rf /tmp/*

# php.ini / opcache (опционально)
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# код приложения
COPY . .

# vendor + built assets
COPY --from=vendor /app/vendor/ ./vendor/
COPY --from=assets /app/public/build/ ./public/build/

# права на storage/cache
RUN chown -R www-data:www-data storage bootstrap/cache

USER www-data

# ВАЖНО: кеши лучше собирать на деплое, но можно и тут (если .env есть в рантайме)
CMD ["php-fpm"]
