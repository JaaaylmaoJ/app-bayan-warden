FROM php:8.2.3-fpm-alpine

WORKDIR /var/www/html

ADD  https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions  /usr/local/bin/
RUN chmod uga+x /usr/local/bin/install-php-extensions && sync \
# && echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories \
 && apk add -X https://dl-cdn.alpinelinux.org/alpine/v3.16/main -u alpine-keys \
 && apk --no-cache add shadow su-exec git openssh-client


RUN install-php-extensions \
  ffi \
  apcu \
  opcache \
  memcached \
  zip \
  bcmath \
  intl \
  mbstring \
  curl
  #iconv \
  #json \
  #xml \

RUN install-php-extensions pdo_mysql
RUN install-php-extensions pdo_pgsql
RUN install-php-extensions mysqli

# Install composerred
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --version=2.5.8 \
    --install-dir=/usr/bin

RUN install-php-extensions xdebug

# Cleanup apk cache
RUN rm -rf /var/cache/apk/* \
 && rm -rf /tmp/*

RUN docker-php-ext-configure pcntl --enable-pcntl \
  && docker-php-ext-install \
    pcntl

#COPY ./docker-entrypoint.sh /usr/local/bin/
#RUN chmod 775 /usr/local/bin/docker-entrypoint.sh \
#&& ln -s     /usr/local/bin/docker-entrypoint.sh /

#RUN useradd -G www-data,root -u $uid -d /home/$user $user
#RUN mkdir -p /home/$user/.composer && \
 #   chown -R $user:$user /home/$user

#USER $user

#ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php-fpm"]