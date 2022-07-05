FROM php:8-fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql sockets
RUN curl -sS https://getcomposer.org/installer​ | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .
RUN composer install

# Copy crontab file to the relevant directory
RUN cat crontab >> /etc/crontabs/root
RUN printf "\n" >> /etc/crontabs/root

# Openrc config
RUN apk add --no-cache tini openrc busybox-initscripts

# Give execution rights on the cron job
RUN chmod 0644 /etc/crontabs/root

# Create the log file to be able to run tail
RUN touch /var/log/cron.log

# Run cron
CMD crond
