#Time-Tracker

Approaching way to use ports and adapters architecture on Laravel.
For this example I don't use an ORM, Eloquent is not recommended because
is coupled with the framework, for production purpose is recommend Doctrine.

## Setting up
1. docker-compose up -d
2. docker exec time-tracker-php-fpm cp .env-example .env
3. docker exec time-tracker-php-fpm composer install
4. docker exec time-tracker-php-fpm php artisan key:generate
5. docker exec time-tracker-php-fpm php artisan migrate
6. npm install
7.  npm run watch
8. http://localhost

## Troubleshooting
- You can change docker service's ports on .env file
- Make sure all files and directories have the correct permissions. 

##Test
- docker exec time-tracker-php-fpm composer test
