# Hello

### Installation Process
* First install all the dependencies via `composer install`.
* Copy `.env.example` and rename to `.env`.
* Set database information properly and run migration with seed `php artisan migrate --seed`.
* The seeding process will create some dummy user with one admin and 100 of products.
* You can find postman collection and environment variables in `/database/postman-collections` directory.

#### Special Note
** We have a env variable called `CACHE_MINUTES`. It is optional to use this variable to control caching memory time.
