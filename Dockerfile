FROM php:8.2-apache

# Install mysqli and gd if needed
RUN docker-php-ext-install mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Configure PHP settings for legacy scan compatibility
RUN echo "short_open_tag = On" >> /usr/local/etc/php/conf.d/docker-php-ext-custom.ini \
 && echo "date.timezone = Asia/Bangkok" >> /usr/local/etc/php/conf.d/docker-php-ext-custom.ini \
 && echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-custom.ini \
 && echo "error_reporting = E_ALL & ~E_NOTICE & ~E_DEPRECATED" >> /usr/local/etc/php/conf.d/docker-php-ext-custom.ini \
 && echo "upload_max_filesize = 50M" >> /usr/local/etc/php/conf.d/docker-php-ext-custom.ini \
 && echo "post_max_size = 50M" >> /usr/local/etc/php/conf.d/docker-php-ext-custom.ini

WORKDIR /var/www/html
