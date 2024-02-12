# Use the official PHP 7.4 image from Docker Hub
FROM php:7.4-apache

# Install the PHP extensions we need
RUN apt update && apt install -y zip && docker-php-ext-install pdo_mysql mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer.json and composer.lock files
COPY composer.* /var/www/html/

# Install PHP dependencies
RUN composer install

# Copy application source
COPY . /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache service
CMD ["apache2-foreground"]
