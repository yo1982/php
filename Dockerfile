# Use the official PHP 7.4 image as the base image
FROM php:7.4-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the PHP application files to the container
COPY . /var/www/html

# Install Redis extension for PHP
RUN pecl install redis && docker-php-ext-enable redis

# Enable Apache rewrite module
RUN a2enmod rewrite

# Expose port 80 for HTTP traffic
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]

