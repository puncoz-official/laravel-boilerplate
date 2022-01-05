#! /bin/sh

supervisord -c /etc/supervisord.conf
        exec php-fpm \
             & exec /usr/sbin/crond -f -l 8
