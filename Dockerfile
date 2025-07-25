FROM php:8.1-apache

RUN docker-php-ext-install pdo_mysql

RUN a2enmod rewrite

COPY . /var/www/html/bankmanager/

RUN echo "<VirtualHost *:80>\n" \
     "    DocumentRoot /var/www/html/bankmanager/public\n" \
     "    <Directory /var/www/html/bankmanager/public>\n" \
     "        Options Indexes FollowSymLinks\n" \
     "        AllowOverride All\n" \
     "        Require all granted\n" \
     "    </Directory>\n" \
     "    ErrorLog ${APACHE_LOG_DIR}/error.log\n" \
     "    CustomLog ${APACHE_LOG_DIR}/access.log combined\n" \
     "</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

CMD ["apache2-foreground"]