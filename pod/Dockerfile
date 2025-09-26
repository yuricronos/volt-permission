FROM php:8.4-fpm-alpine 

# RUN apk update 
RUN apk add libzip-dev zip unzip libpng-dev libjpeg-turbo-dev freetype-dev oniguruma-dev \
       && docker-php-ext-configure zip \
       && docker-php-ext-configure gd --with-freetype --with-jpeg \
       && docker-php-ext-install -j$(nproc) zip gd \
       && apk add postgresql-dev libzip-dev \
       && docker-php-ext-install pdo pdo_pgsql pgsql \
       && docker-php-ext-enable opcache \
       && apk add --no-cache $PHPIZE_DEPS linux-headers \
       && pecl install xdebug \
       && docker-php-ext-enable xdebug \
       && apk del $PHPIZE_DEPS linux-headers \
       && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
       && php -r "if (hash_file('sha384', 'composer-setup.php') === 'ed0feb545ba87161262f2d45a633e34f591ebb3381f2e0063c345ebea4d228dd0043083717770234ec00c5a9f9593792') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }" \
       && php composer-setup.php \
       && php -r "unlink('composer-setup.php');" \
       && mv /var/www/html/composer.phar ~/composer \
       && ln -s ~/composer /usr/local/bin/composer \
       && composer global require laravel/installer \
       && ln -s /root/.composer/vendor/bin/laravel /usr/local/bin/laravel \
       # && apk add --no-cache bash curl build-base libssl3 tar xz git nodejs npm \
       && rm -rf /var/cache/apk/* 
       # && curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | /bin/bash 

# EXPOSE 9000 8000 4200
EXPOSE 9000

CMD ["php-fpm"]