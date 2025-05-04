# Etapa 1: Build de assets con Node
FROM node:20 AS node-builder

WORKDIR /app

COPY package*.json ./
RUN npm install
# copia todo el codigo fuente al contenedor
COPY . .
RUN npm run build

# Etapa 2: PHP para Laravel
FROM php:8.2-cli

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www

# Copiar archivos del proyecto
COPY . .

# Copiar build de Vite (public/build)
COPY --from=node-builder /app/public/build ./public/build

# Instalar dependencias PHP
RUN composer install --optimize-autoloader

# Copiar el archivo .env si no existe
RUN cp .env.example .env || true

# Generar la clave de la app
RUN php artisan key:generate

# Dar permisos a carpetas necesarias
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Exponer puerto para artisan serve
EXPOSE 8000

# Comando de inicio (usando el servidor de desarrollo integrado)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
