# Etapa 1: Build dos assets com Node + PHP base
FROM php:8.3-fpm-alpine AS node-builder

WORKDIR /app

RUN apk add --no-cache nodejs npm

COPY package*.json vite.config.js ./
RUN npm install

COPY resources ./resources
COPY public ./public
RUN npm run build

# Etapa 2: App PHP final
FROM php:8.3-fpm-alpine

# Dependências para build de extensões
RUN apk add --no-cache \
    bash \
    curl \
    sqlite-dev \
    libzip-dev \
    libpng-dev \
    oniguruma-dev \
    autoconf \
    g++ \
    make \
    pkgconf \
    re2c \
    linux-headers \
    libxml2-dev

# Instala extensões nativas do PHP para Laravel
RUN docker-php-ext-install \
    pdo \
    pdo_sqlite \
    mbstring \
    zip \
    bcmath

# Instala a extensão Redis via PECL
RUN pecl install redis && docker-php-ext-enable redis

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia o projeto
COPY . .

# Copia os assets compilados
COPY --from=node-builder /app/public/build ./public/build

# Permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

USER www-data

CMD ["php-fpm"]
