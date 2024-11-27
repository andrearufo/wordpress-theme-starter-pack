#!/bin/bash

# Let's start 🚀
echo "🚀 Let's start building!"

# Check if Docker is running 🐳
if ! docker info >/dev/null 2>&1; then
  echo "🙈 Error: Docker is not running..." >&2
  exit 1
fi
echo "🐳 Docker is running! Proceeding..."

# Check if required commands are available 🔍
for cmd in docker wget unzip composer; do
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
read -p "🛠️ Are you sure you want to continue? (y/n) " -n 1 -r
echo
if [[ ! $REPLY =~ ^[Yy]$ ]]; then
  echo "❌ Initialization cancelled."
  exit 1
fi
echo "✅ Proceeding with initialization..."

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

# Download the Bathe master pack 📦
if wget https://github.com/wp-bathe/bathe/archive/master.zip; then
  echo "🎉 Master pack downloaded successfully."
else
  echo "❌ Error: Failed to download the master pack. Exiting."
  exit 1
fi

# Unzip the master pack and move contents to root 📂
unzip master.zip

if [ -d bathe-main ]; then
  mv bathe-main/* ./
  rm -rf bathe-main
  echo "✅ Extracted and moved contents of 'bathe-main' to the root."
else
  echo "❌ Error: Expected folder 'bathe-main' not found. Exiting."
  exit 1
fi

# Remove the zip file 🧹
rm master.zip
echo "🧹 Zip file removed."

# Create lock file 🔒
touch init.lock
echo "🔒 Initialization lock file created."

# Check if the container is running 🚦
if ! docker compose ps | grep -q "web.*Up"; then
  echo "❌ Error: The 'web' container is not running. Exiting."
  exit 1
fi
echo "✅ The 'web' container is running."

# # Install Composer dependencies inside the container 🧩
# COMPOSER_DIR="/var/www/html/wp-content/themes/$THEME_NAME"
# echo "🧩 Installing Composer dependencies in $COMPOSER_DIR..."
# docker compose exec web bash -c "cd $COMPOSER_DIR && composer install"
# if [ $? -eq 0 ]; then
#   echo "✅ Composer dependencies installed successfully."
# else
#   echo "❌ Error: Failed to install Composer dependencies."
#   exit 1
# fi

# Install Yarn dependencies locally 🧶
if [ -f package.json ]; then
  echo "🧶 Installing Yarn dependencies locally..."
  yarn install
  if [ $? -eq 0 ]; then
    echo "✅ Yarn dependencies installed successfully."
  else
    echo "❌ Error: Failed to install Yarn dependencies."
    exit 1
  fi
else
  echo "ℹ️ No package.json found. Skipping Yarn installation."
fi

# Print completion message 🎉
echo "🚀 Initialization completed! Happy coding!"
