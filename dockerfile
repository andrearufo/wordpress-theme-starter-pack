# Usa l'immagine di WordPress come base
FROM wordpress:latest

# Installa le dipendenze necessarie (gnupg2, curl, nodejs, yarn)
RUN apt-get update \
    && apt-get install -y --no-install-recommends gnupg2 curl ca-certificates \
    && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
    && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get update \
    && apt-get install -y --no-install-recommends nodejs yarn \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Installa Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Mantieni il CMD originale dell'immagine WordPress
CMD ["apache2-foreground"]
