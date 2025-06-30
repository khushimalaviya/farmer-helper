# Step 1: Use an official PHP image with Apache web server
FROM php:8.1-apache

# Step 2: Set the working directory in the container
WORKDIR /var/www/html

# Step 3: Install system dependencies (for Laravel)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Step 4: Install Composer (PHP package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Step 5: Copy the Laravel application to the container
COPY . .

# Step 6: Install Laravel dependencies using Composer
RUN composer install --optimize-autoloader --no-dev

# Step 7: Set the correct permissions for the storage and cache directories
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Step 8: Expose port 80 (Apache web server)
EXPOSE 80

# Step 9: Enable Apache mod_rewrite for Laravel routes
RUN a2enmod rewrite

# Step 10: Start Apache in the foreground
CMD ["apache2-foreground"]
