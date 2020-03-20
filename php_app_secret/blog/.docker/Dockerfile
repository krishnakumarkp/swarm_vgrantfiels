FROM php:7.4-apache 
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo pdo_mysql

COPY . /srv/app
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /srv/app && a2enmod rewrite