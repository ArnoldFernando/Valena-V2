#!/usr/bin/env bash
set -euo pipefail

# Usage:
# chmod +x deploy-app.sh
# ./deploy-app.sh <repo_url> <domain>
# Example:
# ./deploy-app.sh https://github.com/yourname/Valena-V2.git valena.example.com

REPO_URL="${1:-}"
DOMAIN="${2:-}"
APP_DIR="/var/www/valena"
PHP_FPM_SOCK="/run/php/php8.3-fpm.sock"

if [[ -z "$REPO_URL" || -z "$DOMAIN" ]]; then
  echo "Usage: $0 <repo_url> <domain>"
  exit 1
fi

sudo mkdir -p /var/www
if [[ ! -d "$APP_DIR/.git" ]]; then
  sudo git clone "$REPO_URL" "$APP_DIR"
fi

sudo chown -R "$USER":"$USER" "$APP_DIR"
cd "$APP_DIR"

git fetch --all
git pull --rebase

cp -n .env.example .env || true

composer install --no-dev --optimize-autoloader

# Configure these before running in production:
# APP_NAME, APP_ENV, APP_DEBUG, APP_URL
# DB_DATABASE, DB_USERNAME, DB_PASSWORD
# MAIL_* values if needed

php artisan key:generate --force
php artisan migrate --force
php artisan storage:link || true

npm ci
npm run build

php artisan config:cache
php artisan route:cache
php artisan view:cache

sudo chown -R www-data:www-data storage bootstrap/cache
sudo find storage bootstrap/cache -type d -exec chmod 775 {} \;
sudo find storage bootstrap/cache -type f -exec chmod 664 {} \;

# Nginx site config
sudo tee /etc/nginx/sites-available/valena > /dev/null <<EOF
server {
    listen 80;
    server_name $DOMAIN;
    root $APP_DIR/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:$PHP_FPM_SOCK;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    client_max_body_size 10M;
}
EOF

sudo ln -sf /etc/nginx/sites-available/valena /etc/nginx/sites-enabled/valena
sudo rm -f /etc/nginx/sites-enabled/default
sudo nginx -t
sudo systemctl reload nginx

# Free SSL certificate
sudo certbot --nginx -d "$DOMAIN" --non-interactive --agree-tos -m admin@"$DOMAIN" --redirect || true

echo "Deployment completed for $DOMAIN"
echo "Next: open the app and verify admin QR upload + checkout flow."
