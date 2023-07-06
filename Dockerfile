FROM php:7.4-apache

# Install necessary packages
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git

# Install and enable mysqli
RUN docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli

# Install and enable mcrypt
RUN apt-get install -y libmcrypt-dev \
    && pecl install mcrypt-1.0.4 \
    && docker-php-ext-enable mcrypt
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable apache modules
RUN a2enmod rewrite headers
# Copy apache configuration file
COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf

# Enable site
RUN a2ensite 000-default

COPY ./ /var/www/html/

# Expose port 80
EXPOSE 80