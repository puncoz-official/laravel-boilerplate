FROM nginx:latest

LABEL maintainer="Puncoz Nepal <info@puncoz.com>"

#RUN set -x ; \
#    groupadd -g  www-data ; \
#    adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1

RUN apt-get update \
    && apt-get install -y logrotate bash tzdata

# Create 'messages' file used from 'logrotate'
RUN touch /var/log/messages

# Copy 'logrotate' config file
COPY ./logrotate.conf /etc/logrotate.d/nginx

# Set upstream conf and remove the default conf
RUN echo "upstream laravel-upstream { server app:9000; }" > /etc/nginx/conf.d/upstream.conf \
    && rm /etc/nginx/conf.d/default.conf

EXPOSE 80
