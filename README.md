# Time-Tracker :rocket:

> NOT READY FOR PRODUCTION

Is a **learning purpose** application developed with laravel in the backend following a hexagonal architecture appliying SOLID and good practises. And a Vue.js SPA on the front. 
Time-Tracker is a simple app that is able to track task and show it on a minimal UI.

![Time-Tracker](https://user-images.githubusercontent.com/7170812/96763817-fee23280-13d9-11eb-9d77-01bf83d26e63.png) 
## Setting up
1. cp .env.example .env
2. docker-compose up -d
3. docker exec time-tracker-php-fpm composer install
4. docker exec time-tracker-php-fpm php artisan key:generate
5. docker exec time-tracker-php-fpm php artisan migrate
6. npm install
7.  npm run watch
8. http://localhost

## Troubleshooting
- You can change docker service's ports on .env file
- Make sure all files and directories have the correct permissions. 

## Test
- docker exec time-tracker-php-fpm composer test
