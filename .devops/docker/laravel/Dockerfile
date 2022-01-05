FROM php:8.1-fpm-alpine

LABEL MAINTAINER="Puncoz Nepal <info@puncoz.com>"

# Start as root
USER root

RUN apk add --update --no-cache \
    curl git bash git-bash-completion \
    libzip-dev zip unzip \
    freetype-dev libpng-dev libjpeg-turbo-dev \
    py-pip supervisor \
    postgresql-dev \
    tzdata \
    nodejs npm yarn

RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
      && pecl install redis \
      && docker-php-ext-enable redis \
      && apk del pcre-dev ${PHPIZE_DEPS} \
      && rm -rf /tmp/pear

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-configure exif --enable-exif

RUN docker-php-ext-configure zip && \
        docker-php-ext-install zip pdo pdo_pgsql pcntl bcmath gd exif && \
        php -m | grep -q 'zip'

###########################################################################
# Non-root user:
###########################################################################

# Add a non-root user to prevent files being created with root permissions on host machine.
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

ARG DOCKER_USER
ARG USER_HOME=/home/${DOCKER_USER}

RUN set -xe; \
    addgroup -g ${PGID} -S ${DOCKER_USER} && \
    adduser -u ${PUID} --disabled-password ${DOCKER_USER} -G ${DOCKER_USER} -s /bin/bash

###########################################################################
# User Aliases
###########################################################################

USER ${DOCKER_USER}

COPY ./conf/aliases.sh /home/${DOCKER_USER}/aliases.sh

RUN echo "" >> ~/.bashrc && \
    echo "# Load Custom Aliases" >> ~/.bashrc && \
    echo "source ~/aliases.sh" >> ~/.bashrc && \
    echo "" >> ~/.bashrc

CMD ["/bin/sh", "-l"]

###########################################################################
# Composer:
###########################################################################

USER root

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

###########################################################################
# Crontab
###########################################################################

USER root

# preserve new line crontrab needs line end
#RUN echo "" >> /etc/crontabs/${DOCKER_USER} && \
#    echo '* * * * * ${DOCKER_USER} /usr/bin/php /var/www/artisan schedule:run >> /dev/null 2>&1' >> /etc/crontabs/${DOCKER_USER}
#
#RUN chmod -R 644 /etc/crontabs


###########################################################################
# SUPERVISOR:
###########################################################################

USER root

COPY  ./conf/supervisord.conf /etc/supervisord.conf
COPY  ./conf/supervisord.d/*.conf /etc/supervisor.d/
RUN mkdir /var/log/supervisor  && touch /var/log/supervisor/supervisord.log

#
#--------------------------------------------------------------------------
# Final Touch
#--------------------------------------------------------------------------
#

COPY ./conf/laravel.ini /usr/local/etc/php/conf.d
COPY ./conf/laravel.pool.conf /usr/local/etc/php-fpm.d/

# Set default work directory
WORKDIR /var/www

COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
#CMD ["supervisord -c /etc/supervisord.conf"]
#CMD ["php-fpm"]
ENTRYPOINT ["/entrypoint.sh"]

EXPOSE 9000
