# Usa l'immagine ufficiale di PHP 8.4 con FPM
FROM php:8.4-fpm-bookworm

# Installa le dipendenze di sistema
RUN apt-get update && apt-get install -y \
    apt-transport-https \
    libpq-dev \
    openssl \
    unzip \
    zip \
    git \
    curl \
    # libzip-dev \
    libxml2-dev \
    libonig-dev

# Aggiungi il repository Sury per PHP
# RUN curl -sSLo /usr/share/keyrings/debsuryorg-archive-keyring.gpg https://packages.sury.org/php/apt.gpg \
    # && sh -c 'echo "deb [signed-by=/usr/share/keyrings/debsuryorg-archive-keyring.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'
    
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installa le estensioni PHP
RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring xml

RUN php -m | grep mbstring


# Imposta la directory di lavoro
WORKDIR /app

# Copia i file del progetto
COPY . /app

# Installa le dipendenze di Composer
RUN composer install

# Installa API Platform
RUN composer require api-platform/laravel

# Esponi la porta 9000 per PHP-FPM
EXPOSE 9000

# Avvia PHP-FPM
CMD ["php-fpm"]