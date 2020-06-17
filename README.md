# sneakinandcomment
Lazy login and comment

## About the Application

This is just for fun Laravel web application that allows anyone to login with username, no password required(Hahaha, that's right - you can impersonate as someone else just by knowing username).
On the login screen, when you enter username and click 'sneak in' it checks if username exists in database as a valid user - logs the user in else, a new user will be created and login would be performed with that user.
Logged-in user can post comments and like any comment.

## How to run the application

1. Set .env file with DB config
2. Run `php artisan migrate` to run migration
3. Run `php artisan db:seed` to run seeders
4. Run the application and try to login with existing or new user. It's fun.