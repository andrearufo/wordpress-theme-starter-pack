#!/bin/bash

# Let's start 🚀
echo "🚀 Let's start building with TailPress!"

# Check if Docker is running 🐳
if ! docker info >/dev/null 2>&1; then
  echo "🙈 Error: Docker is not running..." >&2
  exit 1
fi
echo "🐳 Docker is running! Proceeding..."

# Check if required commands are available 🔍
for cmd in docker composer yarn; do
  if ! command -v $cmd &> /dev/null; then
    echo "❌ Error: $cmd is not installed. Please install it and try again."
    exit 1
  fi
done
echo "✅ All required commands are available."

# Check if project has already been initialized 🔒
if [ -f init.lock ]; then
  echo "🔒 Error: This project has already been initialized!" >&2
  exit 1
fi
echo "🔓 No initialization lock found. Continuing..."

# Confirm installation 🔍
read -p "🛠️ Are you sure you want to continue? (Y/n) " -n 1 -r
echo
if [[ -z "$REPLY" || "$REPLY" =~ ^[Yy]$ ]]; then
  echo "✅ Proceeding with initialization..."
else
  echo "❌ Initialization cancelled."
  exit 1
fi

# Copy the .env file if it doesn't exist 🗂️
if [ -f .env ]; then
  echo "ℹ️ .env file already exists. Skipping copy."
else
  cp .env.example .env
  echo "✅ .env file created from .env.example."
fi

# Load THEME_NAME from .env 🔍
THEME_NAME=$(grep -E "^THEME_NAME=" .env | cut -d '=' -f 2 | xargs)
if [ -z "$THEME_NAME" ]; then
  echo "❌ Error: THEME_NAME is not set in .env. Please configure it and try again."
  exit 1
fi
echo "🎨 Using theme: $THEME_NAME"

# Set permissions 🔒
chmod -R 777 ./_volumes
echo "✅ Permissions set for ./_volumes."

# Start the containers 🛳️
docker compose build --no-cache --force-rm
docker compose up -d
echo "✅ Docker containers started successfully."

# Create the TailPress theme in a temporary directory inside the container
echo "📦 Creating new TailPress theme in temporary directory..."
docker compose exec web bash -c "
  export PATH=\$PATH:\$HOME/.composer/vendor/bin:\$HOME/.config/composer/vendor/bin &&
  composer global require jeffreyvanrossum/tailpress-installer &&
  tailpress new wp-content/themes/$THEME_NAME/temp --no-interaction
"

# Sync files from container to host
echo "🔄 Syncing files from container to host..."
docker cp web:/var/www/html/wp-content/themes/$THEME_NAME/temp ./temp

# Move files from temp to the final destination on the host
echo "🚚 Moving files..."
mv temp/* ./
rm -rf temp

# Clean up TailPress Installer (optional)
echo "🧹 Cleaning up TailPress Installer..."
docker compose exec web bash -c "
  composer global remove jeffreyvanrossum/tailpress-installer
"

# Install Yarn dependencies locally 🧶
if [ -f "package.json" ]; then
  echo "🧶 Installing Yarn dependencies locally..."
  rm package-lock.json
  yarn install
  if [ $? -eq 0 ]; then
    echo "✅ Yarn dependencies installed successfully."
  else
    echo "❌ Error: Failed to install Yarn dependencies."
    exit 1
  fi
else
  echo "ℹ️ No package.json found in $THEME_DIR. Skipping Yarn installation."
fi

# Create lock file 🔒
touch init.lock
echo "🔒 Initialization lock file created."

# Print completion message 🎉
echo "🚀 Initialization completed! Happy coding with TailPress!"
