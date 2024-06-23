# Use an official PHP runtime as a parent image
FROM php:8.1-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Ensure correct permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Install any needed packages specified in composer.json
# Uncomment the next lines if you are using Composer
# COPY composer.json /var/www/html
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# RUN composer install

# Expose port 80
EXPOSE 80

# The default command to run
CMD ["apache2-foreground"]
