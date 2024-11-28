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
ADMIN_USER="${WP_ADMIN_USER}"
ADMIN_PASSWORD="${WP_ADMIN_PASSWORD}"
ADMIN_EMAIL="${WP_ADMIN_EMAIL}"
SITE_TITLE="${WP_SITE_TITLE}"
WP_PATH="/var/www/html"

# Controlla se i file di WordPress sono presenti
echo "🔍 Checking if WordPress core files are present..."
if ! docker compose exec web ls -A $WP_PATH | grep -q "wp-login.php"; then
    echo "⚙️ Downloading WordPress core files..."
    docker compose run --rm cli core download --path=$WP_PATH --allow-root
    echo "✅ WordPress core files downloaded successfully."
else
    echo "🎉 WordPress core files are already present."
fi

# Controlla se WordPress è già installato
echo "🔍 Checking if WordPress is installed..."
if ! docker compose run --rm cli core is-installed --path=$WP_PATH --allow-root; then
    echo "⚙️ Installing WordPress..."

    # Configurazione wp-config.php
    docker compose run --rm cli config create \
        --dbname="${DB_MYSQL_DATABASE}" \
        --dbuser="${DB_MYSQL_USER}" \
        --dbpass="${DB_MYSQL_PASSWORD}" \
        --dbhost="db:${DOCKER_DB_PORT}" \
        --path=$WP_PATH \
        --skip-check --allow-root

    # Installazione WordPress
    docker compose run --rm cli core install \
        --url="$SITE_URL" \
        --title="$SITE_TITLE" \
        --admin_user="$ADMIN_USER" \
        --admin_password="$ADMIN_PASSWORD" \
        --admin_email="$ADMIN_EMAIL" \
        --path=$WP_PATH \
        --allow-root

    echo "✅ WordPress installed successfully!"

    # Installazione e attivazione plugin
    PLUGINS=("bottom-admin-toolbar" "disable-comments" "force-regenerate-thumbnails" "intuitive-custom-post-order" "limit-login-attempts-reloaded" "redirection" "show-current-template")
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
