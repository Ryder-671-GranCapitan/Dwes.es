FROM php:8.3-apache
RUN apt-get update && apt-get install -y libpq-dev
COPY ./vhosts/* /etc/apache2/sites-available/
RUN docker-php-ext-install mysqli && docker-php-ext-install pdo_mysql && docker-php-ext-install pgsql && docker-php-ext-install pdo_pgsql
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN a2ensite dwes.conf
RUN a2ensite examen.conf
EXPOSE 80
EXPOSE 9003
