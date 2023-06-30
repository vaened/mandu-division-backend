FROM php:8.1.6-fpm-alpine
WORKDIR /app

RUN wget https://github.com/FriendsOfPHP/pickle/releases/download/v0.7.9/pickle.phar \
    && mv pickle.phar /usr/local/bin/pickle \
    && chmod +x /usr/local/bin/pickle

ENV COMPOSER_VERSION 2.3.7

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=$COMPOSER_VERSION

RUN apk --update upgrade \
    && apk add --no-cache autoconf automake make gcc g++ bash icu-dev libzip-dev \
    && docker-php-ext-install -j$(nproc) \
        bcmath \
        opcache \
        intl \
        zip \
        pdo_mysql

RUN pickle install apcu@5.1.21

RUN apk add git

RUN docker-php-ext-enable \
        apcu \
        opcache

COPY etc/infrastructure/php/mandu.ini /usr/local/etc/conf.d

RUN mkdir -p /opt/home
RUN chmod 777 /opt/home
ENV HOME /opt/home
