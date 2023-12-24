#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

until nc -z -w5 database-mysql 3306; do
  echo "Waiting for MySQL server to be ready..."
  sleep 1
done

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env.example .env
else
    echo "env file exists."
fi

role=${CONTAINER_ROLE:-app}

if [ "$role" = "app" ]; then
    php artisan migrate
    php artisan key:generate
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear

    # only first time when run script and migrate table
    # php artisan db:seed

    # npm install
    # npm run build

    php artisan serve --port=$PORT --host=0.0.0.0 --env=.env
    exec docker-php-entrypoint "$@"
elif [ "$role" = "queue" ]; then
    echo "Running the queue ... "
    php /var/www/artisan queue:work --verbose --tries=3 --timeout=180
fi
