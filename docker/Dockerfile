FROM php:8.3-apache

ENV APACHE_RUN_USER php
ENV APACHE_RUN_GROUP php
ENV APACHE_SERVER_NAME localhost
ENV APACHE_DOCUMENT_ROOT /home/php/app/public
ENV APACHE_LOG_DIR /var/log/apache2

RUN set -x \
    && groupadd --gid 1000 php \
    && useradd --uid 1000 --gid php -m php

RUN apt-get update && \
    apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip unzip && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql mysqli

RUN rm -rf /etc/apache2/sites-*/ \
    && chown -R php:php /var/run/apache2 /var/log/apache2 /var/lock/apache2 /var/lib/apache2 \
    && apt-get purge -y --auto-remove \
    && rm -r /var/lib/apt/lists/*

COPY default.conf /etc/apache2/sites-enabled/
COPY ports.conf /etc/apache2/ports.conf

WORKDIR /home/php/app

RUN a2enmod rewrite \
    && chown php.php -R /home/php

USER php

EXPOSE 8080

CMD ["apache2-foreground"]
