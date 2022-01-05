FROM nginx:1.21-alpine

LABEL MAINTAINER="Puncoz Nepal <info@puncoz.com>"

#COPY ./nginx.conf /etc/nginx/

RUN set -x ; \
    addgroup -g 82 -S www-data ; \
    adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1
# 82 is the standard uid/gid for "www-data" in Alpine

RUN apk update \
    && apk upgrade \
    && apk add --no-cache logrotate openssl bash

# Create 'messages' file used from 'logrotate'
RUN touch /var/log/messages

# Copy 'logrotate' config file
COPY ./conf/logrotate.conf /etc/logrotate.d/nginx

# Set upstream conf and remove the default conf
RUN echo "upstream php-upstream { server laravel:9000; }" > /etc/nginx/conf.d/upstream.conf \
    && rm /etc/nginx/conf.d/default.conf

# Generate SSL
RUN mkdir -p /etc/nginx/certificates
#RUN chmod
RUN openssl req -x509 -nodes -days 365 -subj "/C=CA/ST=QC/O=Company, Inc./CN=mydomain.com" \
    -addext "subjectAltName=DNS:mydomain.com" -newkey rsa:2048 -keyout /etc/nginx/certificates/cert.key \
    -out /etc/nginx/certificates/cert.crt;
RUN chmod 400 /etc/nginx/certificates

#COPY ./default.conf /etc/nginx/sites-available/

# Bring in tzdata so users could set the timezones through the environment
#RUN apk add --no-cache tzdata

EXPOSE 80 443
