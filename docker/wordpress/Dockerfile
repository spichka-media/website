FROM wordpress:6.7.2-php8.3

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod proxy proxy_http proxy_wstunnel rewrite
