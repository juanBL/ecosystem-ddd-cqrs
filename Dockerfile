ARG PHP_VERSION=8.2
ARG XDEBUG_EXT_VERSION=3.2.0
ARG PHP_EXT_INSTALLER_VERSION=1.2.57
ARG COMPOSER_VERSION=2.3.7
ARG NGINX_VERSION=stable

#### Base image ####
FROM mlocati/php-extension-installer:${PHP_EXT_INSTALLER_VERSION} AS php-extension-installer
FROM php:${PHP_VERSION}-fpm-alpine AS base

COPY --from=php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN apk --update upgrade \
        && apk add --no-cache autoconf fcgi automake make gcc g++ bash rabbitmq-c linux-headers \
        && rm -rf /tmp/*

RUN install-php-extensions \
        apcu\
        amqp\
        bcmath\
        opcache\
        intl\
        zip\
        redis\
        pdo_mysql
RUN curl -sS https://get.symfony.com/cli/installer | bash -s - --install-dir /usr/local/bin

RUN curl -L https://raw.githubusercontent.com/renatomefi/php-fpm-healthcheck/v0.5.0/php-fpm-healthcheck -o /usr/local/bin/php-fpm-healthcheck \
        && chmod +x /usr/local/bin/php-fpm-healthcheck

COPY deployments/docker/php/php.ini $PHP_INI_DIR/conf.d/php.ini
COPY deployments/docker/php/opcache-runtime.ini $PHP_INI_DIR/conf.d/opcache.ini
COPY deployments/docker/php/fpm.conf /usr/local/etc/php-fpm.d/zz-docker.conf
COPY deployments/docker/php/apcu.ini $PHP_INI_DIR/conf.d/apcu.ini

#### Builder image ####
FROM composer:${COMPOSER_VERSION} AS composer
FROM base AS builder

COPY --from=composer /usr/bin/composer /usr/local/bin

#### Development image ####
FROM builder AS development

ARG XDEBUG_EXT_VERSION
ARG USER_ID=1000

COPY deployments/docker/php/opcache-development.ini $PHP_INI_DIR/conf.d/opcache.ini
COPY deployments/docker/php/xdebug.ini $PHP_INI_DIR/conf.d

RUN install-php-extensions \
        xdebug-${XDEBUG_EXT_VERSION}

RUN adduser -D -u $USER_ID default

#### Installer image ####
FROM builder AS installer

COPY . .
COPY composer.json .
COPY composer.lock .
COPY Makefile .
COPY etc etc
RUN mkdir -p .git/

RUN composer install \
        --no-interaction \
        --no-progress \
        # --no-dev \
        --ignore-platform-reqs \
        --classmap-authoritative \
        && chown -R www-data: .

#### Create shared target ####
FROM base AS shared-ecosystem

COPY --from=installer /var/www/html /var/www/html

RUN mkdir -p /var/www/html/var/cache/test && chown www-data:www-data /var/www/html/var/cache/test
RUN mkdir -p /var/www/html/var/log && chown www-data:www-data /var/www/html/var/log

##################################
#     all-in-one image           #
##################################
FROM shared-ecosystem AS all-in-one

###################################
#      api images        #
###################################
FROM shared-ecosystem AS runtime-api-backend

RUN ln -s /var/www/html/apps/api /var/www/html/apps/current-app
