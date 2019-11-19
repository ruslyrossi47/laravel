FROM php:7.1-apache
COPY php.ini /usr/local/etc/php/
RUN apt-get update \
  && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libjpeg-dev libpng-dev zip libmcrypt-dev \
  && docker-php-ext-install pdo_mysql mysqli mbstring iconv mcrypt zip \
  && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
  && docker-php-ext-install -j$(nproc) gd \
  && a2enmod rewrite
