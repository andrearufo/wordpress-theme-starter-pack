#!/bin/bash

# Percorso base di WordPress
WP_PATH="/var/www/html"

# Carica le variabili d'ambiente dal file .env
export $(grep -v '^#' .env | xargs)

# Variabili estratte da .env
DB_NAME="${DB_MYSQL_DATABASE:-wordpress}"
DB_USER="${DB_MYSQL_USER:-wordpress}"
DB_PASS="${DB_MYSQL_PASSWORD:-wordpress}"
DB_HOST="db:${DOCKER_DB_PORT:-3306}"
SITE_URL="http://localhost:${DOCKER_WORDPRESS_PORT:-8000}"
ADMIN_USER="${WP_ADMIN_USER:-admin}"
ADMIN_PASSWORD="${WP_ADMIN_PASSWORD:-password}"
ADMIN_EMAIL="${WP_ADMIN_EMAIL:-admin@example.com}"
SITE_TITLE="${WP_SITE_TITLE:-My WordPress Site}"

# Controllo dello stato del database
echo "⏳ Waiting for database to be ready..."
until docker compose exec db mysqladmin ping -h db --silent; do
    echo "🛠️ Database not ready. Retrying..."
    sleep 3
done
echo "✅ Database is ready!"

# Pulizia database
echo "🗑️ Cleaning database..."
docker compose exec db mysql -u${DB_USER} -p${DB_PASS} -e "DROP DATABASE IF EXISTS ${DB_NAME}; CREATE DATABASE ${DB_NAME};"

# Rimuovi wp-config.php esistente
echo "🗑️ Checking and removing existing wp-config.php..."
docker compose exec web bash -c "if [ -f $WP_PATH/wp-config.php ]; then rm -f $WP_PATH/wp-config.php; fi"
if [ $? -eq 0 ]; then
    echo "✅ Existing wp-config.php removed."
else
    echo "⚠️ wp-config.php not found or could not be removed. Continuing..."
fi

# Debug: Verifica se il file esiste ancora
echo "🔍 Debugging wp-config.php removal..."
docker compose exec web ls -l $WP_PATH/wp-config.php

# Creazione del file wp-config.php
echo "⚙️ Creating wp-config.php..."
docker compose run --rm cli config create \
    --dbname="${DB_NAME}" \
    --dbuser="${DB_USER}" \
    --dbpass="${DB_PASS}" \
    --dbhost="${DB_HOST}" \
    --path=$WP_PATH \
    --skip-check --allow-root
if [ $? -eq 0 ]; then
    echo "✅ wp-config.php created successfully."
else
    echo "❌ Error: Failed to create wp-config.php."
    exit 1
fi

# Installazione WordPress
echo "⚙️ Installing WordPress..."
docker compose run --rm cli core install \
    --url="$SITE_URL" \
    --title="$SITE_TITLE" \
    --admin_user="$ADMIN_USER" \
    --admin_password="$ADMIN_PASSWORD" \
    --admin_email="$ADMIN_EMAIL" \
    --path=$WP_PATH \
    --allow-root
if [ $? -eq 0 ]; then
    echo "✅ WordPress installed successfully."
else
    echo "❌ Error: Failed to install WordPress."
    exit 1
fi

# Installazione e attivazione plugin
PLUGINS=("bottom-admin-toolbar" "disable-comments" "force-regenerate-thumbnails" "intuitive-custom-post-order" "limit-login-attempts-reloaded" "redirection" "show-current-template" "wp-mail-smtp")
echo "📦 Installing plugins..."
for PLUGIN in "${PLUGINS[@]}"; do
    docker compose run --rm cli plugin install "$PLUGIN" --activate --allow-root
    if [ $? -ne 0 ]; then
        echo "❌ Error: Failed to install or activate plugin $PLUGIN."
    else
        echo "✅ Plugin $PLUGIN installed and activated."
    fi
done

# Configurazione del plugin SMTP
SMTP_HOST="${SMTP_HOST:-mailpit}"
SMTP_PORT="${SMTP_PORT:-1025}"
SMTP_FROM_EMAIL="${SMTP_FROM_EMAIL:-noreply@localhost}"
SMTP_FROM_NAME="${SMTP_FROM_NAME:-WordPress}"

echo "📧 Configuring WP Mail SMTP plugin (Other SMTP)..."
docker compose run --rm cli option update wp_mail_smtp \
    "{\"mailer\":\"smtp\",\"from_email\":\"$SMTP_FROM_EMAIL\",\"from_name\":\"$SMTP_FROM_NAME\",\"smtp\":{\"host\":\"$SMTP_HOST\",\"port\":$SMTP_PORT,\"encryption\":\"none\",\"auth\":false}}" \
    --format=json --allow-root
if [ $? -eq 0 ]; then
    echo "✅ SMTP plugin configured successfully with Other SMTP."
else
    echo "❌ Error: Failed to configure SMTP plugin."
    exit 1
fi

# Controlla lo stato dei plugin
echo "🔍 Checking plugin status..."
docker compose run --rm cli plugin status --allow-root

echo "🚀 WordPress setup completed!"
