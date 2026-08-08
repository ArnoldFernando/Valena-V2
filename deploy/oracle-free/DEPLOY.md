# Free Deployment Guide (Oracle Cloud Always Free)

This project can be deployed for free on an Oracle Cloud Ubuntu VM.

## 1) Create free VM
- Ubuntu 22.04 or 24.04
- Open inbound ports: 22, 80, 443
- Attach a public IP

## 2) SSH into server
- ssh ubuntu@YOUR_SERVER_IP

## 3) Install dependencies
- cd /tmp
- curl -O https://raw.githubusercontent.com/YOUR_USERNAME/YOUR_REPO/main/deploy/oracle-free/setup-server.sh
- chmod +x setup-server.sh
- ./setup-server.sh

Alternative: copy this repository first and run script from project folder.

## 4) Deploy app
- cd /tmp
- curl -O https://raw.githubusercontent.com/YOUR_USERNAME/YOUR_REPO/main/deploy/oracle-free/deploy-app.sh
- chmod +x deploy-app.sh
- ./deploy-app.sh https://github.com/YOUR_USERNAME/YOUR_REPO.git yourdomain.com

## 5) Update environment values
Edit .env in /var/www/valena:
- APP_NAME=Valena
- APP_ENV=production
- APP_DEBUG=false
- APP_URL=https://yourdomain.com
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=valena
- DB_USERNAME=valena_user
- DB_PASSWORD=strong_password_here

Then run:
- cd /var/www/valena
- php artisan config:cache

## 6) Database preparation
Create DB and user in MySQL:
- sudo mysql
- CREATE DATABASE valena CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
- CREATE USER 'valena_user'@'localhost' IDENTIFIED BY 'strong_password_here';
- GRANT ALL PRIVILEGES ON valena.* TO 'valena_user'@'localhost';
- FLUSH PRIVILEGES;
- EXIT;

Then migrate:
- cd /var/www/valena
- php artisan migrate --force

## 7) Storage symlink for uploads
- cd /var/www/valena
- php artisan storage:link

This is required for uploaded files such as the admin GCash QR image.

## 8) Background workers (optional)
If you later use queues/scheduler, configure systemd services.

## 9) Update app after changes
- cd /var/www/valena
- git pull --rebase
- composer install --no-dev --optimize-autoloader
- npm ci && npm run build
- php artisan migrate --force
- php artisan optimize:clear
- php artisan config:cache
