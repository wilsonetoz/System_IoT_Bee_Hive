FROM php:7.4-apache

WORKDIR /var/www/html

# Instalar extensões PHP necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instalar dependências para o Composer (unzip, git)
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/* # Limpa caches APT

# Instalar Composer globalmente no contêiner
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Configurar o DocumentRoot do Apache para a pasta onde seus arquivos web estão
# Isso redirecionará todas as requisições web para dentro de web_system_codes/sources/
# Configurar o DocumentRoot do Apache para a pasta onde seus arquivos web estão
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/web_system_codes/sources\n\
    <Directory /var/www/html/web_system_codes/sources>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf
# Habilitar o módulo rewrite do Apache
RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]