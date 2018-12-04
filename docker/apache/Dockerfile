FROM php:7.1.2-apache

LABEL Description="This is a custom PHP7 Apache image for ATP"
LABEL maintainer="Antoine NGUYEN"

# system
USER root
ENV LANG='fr_FR.UTF-8' \
    LANGUAGE='fr_FR.fr' \
    LC_ALL='fr_FR.UTF-8' \
    TZ='Europe/Paris'
RUN apt-get update && apt-get install -y \
    dos2unix \
    gettext-base \
    libcurl4-gnutls-dev \
    libfreetype6-dev \
    libjpeg-dev \
    libxml2-dev \
    libxslt-dev \
    libpng-dev \
    libmcrypt-dev \
    wget \
    git \
    vim \
 && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
 && docker-php-ext-install mysqli pdo pdo_mysql curl xml xsl gd mcrypt mbstring soap zip \
 ## APCu
 && pecl install apcu-5.1.8 \
 && docker-php-ext-enable apcu

# composer
COPY php /usr/local/bin
RUN chmod +x /usr/local/bin/composer-setup.sh \
    && /usr/local/bin/composer-setup.sh \
    && rm /usr/local/bin/composer-setup.sh

# nodejs & npm & yarn
RUN curl -sL https://deb.nodesource.com/setup_7.x | bash - \
 && apt-get install -y nodejs \
 && npm install --global yarn

# entrypoint
COPY docker-entrypoint.sh /
RUN chmod +x /docker-entrypoint.sh
ENTRYPOINT ["/docker-entrypoint.sh"]

CMD ["apache2-foreground"]

# wait-for-it
COPY wait-for-it /usr/local/bin
RUN chmod +x /usr/local/bin/wait-for-it.sh


RUN a2enmod rewrite proxy proxy_ajp proxy_balancer lbmethod_byrequests headers deflate
COPY etc /usr/local/etc/php/
RUN rm /var/log/apache2/error.log && ln -s /dev/stdout /var/log/apache2/error.log