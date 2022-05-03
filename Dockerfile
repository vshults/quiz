FROM php:8.1-fpm

RUN mkdir -p /var/www/html
WORKDIR /var/www/html

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
    libzip-dev \
    git \
    curl \
    libonig-dev \
    locales \
    nodejs \
    npm \
    zlib1g-dev \
    libicu-dev \
    supervisor \
    g++ \
    --no-install-recommends \
    && rm -r /var/lib/apt/lists/* \
    && sed -i 's/# ru_RU.UTF-8 UTF-8/ru_RU.UTF-8 UTF-8/' /etc/locale.gen \
    && locale-gen
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /var/www/html/
RUN composer install

RUN chown -R www-data:www-data /var/www/html/public
RUN chown -R www-data:www-data /var/www/html/storage

EXPOSE 9000
CMD ["php-fpm"]
