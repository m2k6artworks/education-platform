# Dockerfile for Laravel with PHP 8.2 and Composer
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y     build-essential     libpng-dev     libjpeg-dev     libonig-dev     libxml2-dev     zip     unzip     curl     git     libpq-dev     libzip-dev     libicu-dev     libcurl4-openssl-dev     vim     cron     && docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl intl

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

# Change current user to www
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]