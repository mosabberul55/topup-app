To run this project you need to follow this steps:
1. rum composer install
2. Create a .env file from .env.example and configure your database credintials. (make sure QUEUE_CONNECTION=database)
3. run php artisan migrate
4. run php artisan db:seed. (this will generate 600000 dummy data so it take 1-2 munutes)
5. run php artisan serve
