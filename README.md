## Short Link Platform

## Run
```bash
cd docker/
docker-compose -f docker-compose.dev.yml up -d
docker-compose -f docker-compose.dev.yml exec -u docker slp_workspace bash
composer install
cp .env.example .env
npm i
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan passport:install
```