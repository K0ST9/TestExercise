FROM registry.fraktal.wattdev.ru/common/php-8.1-common:latest as php_base

FROM php_base as php_main
ARG ENV
ARG AUHT_JSON_TMP
ENV COMPOSER_AUTH=${AUHT_JSON_TMP}
COPY project .
RUN chown -R www-data:www-data storage bootstrap
WORKDIR /var/www/html
RUN composer install --no-dev
CMD php artisan migrate 
    # && \
    # php-fpm -y /usr/local/etc/php-fpm.conf -R

FROM nginx:stable-alpine as nginx
WORKDIR /var/www/html/

COPY --from=php_main /var/www/html/public .
