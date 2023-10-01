FROM puncoz/laravel:8.2

LABEL maintainer="Puncoz Nepal <info@puncoz.com>"

# Add a non-root user to prevent files being created with root permissions on host machine.
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}
ARG WWWUSER=laravel
ENV APP_DIR="/var/www"

RUN groupadd --force -g ${PGID} ${WWWUSER}
RUN useradd -ms /bin/bash --no-user-group -g ${PGID} -u ${PUID} ${WWWUSER}

###########################################################################
# User Aliases
###########################################################################
USER ${WWWUSER}

COPY --chown=${WWWUSER}:${WWWUSER} ./aliases.sh /home/${WWWUSER}/aliases.sh

RUN echo "" >> ~/.bashrc && \
    echo "# Load Custom Aliases" >> ~/.bashrc && \
    echo "source ~/aliases.sh" >> ~/.bashrc && \
    echo "" >> ~/.bashrc

CMD ["/bin/sh", "-l"]

#
#--------------------------------------------------------------------------
# Final Touch
#--------------------------------------------------------------------------
#
USER root

WORKDIR ${APP_DIR}

COPY ./supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./laravel.ini /usr/local/etc/php/conf.d/99-laravel.ini

COPY ./start-container /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container
ENTRYPOINT ["start-container"]

EXPOSE 9000
