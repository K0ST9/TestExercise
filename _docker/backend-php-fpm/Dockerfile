FROM php:8.1-fpm

# Add docker-php-extension-installer
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

# Install system dependencies
#RUN install-php-extensions zip pdo_pgsql gd xdebug-^3.1 redis
RUN install-php-extensions zip pdo_pgsql redis

# Install the Composer
RUN install-php-extensions @composer

# Copy project
RUN mkdir -p /var/www/html
WORKDIR /var/www/html
COPY . .

ENV DOCKER_BUILDING=true
# Download Composer dependencies
RUN composer install --no-dev

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]
