#Steps
1. Pull this repo.
2. Run `docker-compose up -d` if you run using docker or you can just copy folder `/var/www/html`
2. Run `php artisan migrate:refresh --seed`
3. Run `php artisan passport:install`

#PART B
1. The anwser of question one is first you need to run `php artisan migrate:refresh --seed` the database will created including database schema and dummy data.
2. Go to this URL `http://0.0.0.0:89/login` and login as admin. Please access to database and login using user ID number 1. You can test the user CRUD here `http://0.0.0.0:89/admin/user`.
3. Login as admin and go to this page `http://0.0.0.0:89/admin/listing`.
4. The API you can test using Postman and import this file `Laravel.postman_collection.json`. Then you can edit the body request base on your test cases.

#PART C
- Please refer this file `part-c.php`.