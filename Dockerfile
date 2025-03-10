FROM php:8.3.3-fpm-alpine
LABEL authors="flori"

COPY --from=composer:2.1.9 /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache \
	bash \
	curl \
	git \
	libzip-dev \
	unzip \
	zip \
	&& docker-php-ext-install \
	pdo_mysql \
	zip \
	&& rm -rf /var/cache/apk/*

# Add xdebug
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS
RUN apk add --update linux-headers
RUN pecl install xdebug-3.3.2
RUN apk del -f .build-deps

COPY ./ /var/www/html/

RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

# Run composer install to install the dependencies
RUN composer install --no-interaction

EXPOSE 80
EXPOSE 9003

# Entrypoint script
RUN mkdir -p /docker/php
ADD docker/php/entrypoint.sh /docker/php/entrypoint.sh
RUN chmod +x /docker/php/entrypoint.sh

ADD docker/php/conf.d/php.ini /usr/local/etc/php/
ADD docker/php/conf.d/www.conf /usr/local/etc/php-fpm.d/

ENTRYPOINT ["/docker/php/entrypoint.sh"]
