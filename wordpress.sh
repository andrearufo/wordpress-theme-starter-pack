#!/bin/bash

# Controllo dello stato del database
echo "⏳ Waiting for database to be ready..."
until docker compose exec db mysqladmin ping -h db --silent; do
    echo "🛠️ Database not ready. Retrying..."
    sleep 3
done
echo "✅ Database is ready!"

# Variabili
SITE_URL="http://localhost:${DOCKER_WORDPRESS_PORT}"
ADMIN_USER="admin"
ADMIN_PASSWORD="adminpassword"
ADMIN_EMAIL="admin@example.com"
SITE_TITLE="My WordPress Site"

# Controlla se WordPress è già installato
echo "🔍 Checking if WordPress is installed..."
if ! docker compose run --rm cli core is-installed --allow-root; then
    echo "⚙️ Installing WordPress..."

    # Configurazione wp-config.php
    docker compose run --rm cli config create \
        --dbname="${DB_MYSQL_DATABASE}" \
        --dbuser="${DB_MYSQL_USER}" \
        --dbpass="${DB_MYSQL_PASSWORD}" \
        --dbhost="db:${DOCKER_DB_PORT}" \
        --skip-check --allow-root

    # Installazione WordPress
    docker compose run --rm cli core install \
        --url="$SITE_URL" \
        --title="$SITE_TITLE" \
        --admin_user="$ADMIN_USER" \
        --admin_password="$ADMIN_PASSWORD" \
        --admin_email="$ADMIN_EMAIL" \
        --allow-root

    echo "✅ WordPress installed successfully!"

    # Installazione e attivazione plugin
    PLUGINS=("akismet" "hello-dolly")
    echo "📦 Installing plugins..."
    for PLUGIN in "${PLUGINS[@]}"; do
        docker compose run --rm cli plugin install $PLUGIN --activate --allow-root
    done

    echo "✅ Plugins installed and activated."
else
    echo "🎉 WordPress is already installed."
fi

# Controlla lo stato dei plugin
echo "🔍 Checking plugin status..."
docker compose run --rm cli plugin status --allow-root
