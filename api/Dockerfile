FROM php:8.3


WORKDIR usr/src/app


RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo_mysql
COPY . .

RUN composer install
RUN php artisan key:generate
RUN php artisan jwt:secret

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host", "0.0.0.0"]
