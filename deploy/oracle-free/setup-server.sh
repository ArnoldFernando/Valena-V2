#!/usr/bin/env bash
set -euo pipefail

# Run as ubuntu user with sudo privileges.
# This installs Nginx, PHP, MySQL, Composer, Node, and Certbot.

sudo apt-get update
sudo apt-get upgrade -y

sudo apt-get install -y nginx git unzip curl software-properties-common ca-certificates lsb-release gnupg

# PHP 8.3
sudo add-apt-repository ppa:ondrej/php -y
sudo apt-get update
sudo apt-get install -y \
  php8.3 php8.3-fpm php8.3-cli php8.3-common php8.3-mysql php8.3-mbstring \
  php8.3-xml php8.3-curl php8.3-zip php8.3-bcmath php8.3-intl php8.3-gd

# MySQL
sudo apt-get install -y mysql-server
sudo systemctl enable mysql
sudo systemctl start mysql

# Composer
cd /tmp
curl -sS https://getcomposer.org/installer -o composer-setup.php
php composer-setup.php
sudo mv composer.phar /usr/local/bin/composer
composer --version

# Node.js 22.x
curl -fsSL https://deb.nodesource.com/setup_22.x | sudo -E bash -
sudo apt-get install -y nodejs
node -v
npm -v

# Certbot for free SSL
sudo apt-get install -y certbot python3-certbot-nginx

echo "Server setup complete."
