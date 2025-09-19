FROM php:8.1-apache

# Cài extension + locale
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
    zip \
    locales \
    && docker-php-ext-install pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Generate locale en_US.UTF-8
RUN sed -i 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/' /etc/locale.gen \
    && locale-gen

ENV LANG en_US.UTF-8  
ENV LANGUAGE en_US:en  
ENV LC_ALL en_US.UTF-8

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Bật rewrite
RUN a2enmod rewrite
RUN sed -i 's|AllowOverride None|AllowOverride All|g' /etc/apache2/apache2.conf


# Sửa Apache DocumentRoot thành public/
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
 && sed -i 's|/var/www/|/var/www/html/public|g' /etc/apache2/apache2.conf

COPY ./src /var/www/html
RUN chown -R www-data:www-data /var/www/html

# docker exec -it fuel_app bash
# cd /var/www/html
