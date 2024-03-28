FROM chialab/php:8.2-fpm

# Set the working directory inside the container
WORKDIR /app


####################################
#####                         ######
#####      NGINX SECTION      ######
#####                         ######
####################################

# Install dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor

# Copy Nginx server block
COPY ./docker/site.conf /etc/nginx/sites-available/default
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY ./docker/php.ini /etc/php/7.4/fpm/conf.d/99-php.ini
COPY ./docker/index.php /app/public/index.php

# Clean Up!
RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

####################################
#####                         ######
#####       USER SECTION      ######
#####                         ######
####################################

ARG UID=1000
ARG USERNAME=appuser
RUN useradd -G www-data -o -u ${UID} -ms /bin/bash ${USERNAME}

RUN mkdir -p /var/cache/nginx

RUN touch \
    /var/run/supervisord.pid \
    /var/run/nginx.pid

RUN chown -R ${USERNAME}:${USERNAME} \
    /var/cache/nginx \
    /var/log/nginx \
    /etc/nginx/conf.d \
    /var/lib/nginx \
    /var/run/supervisord.pid \
    /var/run/nginx.pid \
    /app

RUN sed -i '/user www-data;/d' /etc/nginx/nginx.conf

USER ${USERNAME}

####################################
#####                         ######
#####     LARAVEL SECTION     ######
#####                         ######
####################################

# Copy the local code to the container
COPY --chown=${USERNAME} . /app

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set ownership and permissions
RUN chgrp -R www-data storage bootstrap/cache
RUN chmod -R ug+rwx storage bootstrap/cache

# Expose port 80
EXPOSE 80

# Start supervisord to manage processes
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
