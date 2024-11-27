# Usa l'immagine di WordPress come base
FROM wordpress:latest

# Installa unzip per Composer
RUN apt-get update && apt-get install -y --no-install-recommends unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Installa Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Mantieni il CMD originale dell'immagine WordPress
CMD ["apache2-foreground"]
