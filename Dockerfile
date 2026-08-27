FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git curl libpng-dev libjpeg-dev libfreetype6-dev libzip-dev libonig-dev \
    nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql zip mbstring \
    && apt-get clean

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN npm install && npm run build || true

CMD php artisan migrate --force && php artisan config:clear && php artisan serve --host=0.0.0.0 --port=$PORT
