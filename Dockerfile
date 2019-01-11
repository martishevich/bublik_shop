FROM php:7.2-apache 

RUN apt-get update
RUN docker-php-ext-install pdo_mysql
RUN apt-get install zlib1g-dev
RUN docker-php-ext-install zip
RUN apt-get install unzip nano

RUN apt-get install -y sendmail

RUN apt-get install -y libpng-dev libjpeg-dev

RUN docker-php-ext-configure gd \
    --with-png-dir=/usr/lib/ \
    --with-jpeg-dir=/usr/lib/ \
    --with-gd

RUN docker-php-ext-install gd

RUN apt-get install -y \
    libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
	&& docker-php-ext-enable imagick

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN a2enmod rewrite

COPY php-entrypoint.sh /var/php-entrypoint.sh
RUN chmod 0777 -R /var/php-entrypoint.sh

#ENTRYPOINT ["sh", "/var/php-entrypoint.sh"]

#CMD ['php-apache']