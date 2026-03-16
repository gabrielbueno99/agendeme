# Usamos a imagem oficial do PHP com FPM (FastCGI Process Manager)
FROM php:8.2-fpm

# Instala dependências do sistema e extensões PHP necessárias para MySQL e Strings
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql zip

# Copia o Composer da imagem oficial para dentro do nosso container
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www