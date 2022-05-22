FROM php:8.1-fpm-alpine3.14

WORKDIR /app


ENV \
    PECL_EXTENSIONS="redis" \
    PHP_EXTENSIONS="bcmath pdo pdo_mysql sockets"

RUN \
  apk update \
      && apk add autoconf g++ make \
      && echo "Install pecl extensions: $PECL_EXTENSIONS"  \
      && pecl install $PECL_EXTENSIONS  \
      && docker-php-ext-enable $PECL_EXTENSIONS  \
      && mkdir -p /usr/src/php/ext/ \
      && cd /usr/src/php/ext/ \
      && echo $(echo $PECL_EXTENSIONS | sed -E 's/\-[^ ]+//g') \
      && echo "Install PHP extensions: $PHP_EXTENSIONS"  \
      && docker-php-ext-install -j "$(nproc)" $PHP_EXTENSIONS > /dev/null \
      && mkdir /usr/local/etc/php/conf.d/disabled \
      && echo "Install Composer" \
      && curl -sSL https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


COPY ./php.ini /usr/local/etc/php/php.ini
#COPY ./opcache.ini /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini
#COPY ./xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY ./www.conf /usr/local/etc/php-fpm.d/www.conf

COPY . .

RUN adduser -u 1005 -s /bin/sh -D -H deploy \
    && chown -R deploy:deploy /app

USER deploy

EXPOSE 9000

ENTRYPOINT ["php-fpm"]
