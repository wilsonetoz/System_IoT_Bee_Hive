FROM php:7.4-apache

WORKDIR /var/www/html

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/* # Limpa caches APT

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/web_system_codes\n\
    <Directory /var/www/html/web_system_codes>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]