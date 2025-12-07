# Planets Explorer

This old system connected to the internet will help you find out where in the universe you are located.

## Setup

1. Copy `.env.example` to `.env`
2. Run `composer install`
3. Run `php artisan key:generate`
4. Fill the `.env` file with your database credentials
5. Run `php artisan migrate --seed`
6. Run `mpm install`
7. Run `npm run build`

## Sync command

Command `php artisan sync` in `app/Console/Commands/SyncCommand.php` will sync Planets & Residents data from external API and store them in your database.

## Logbook API

File `_dev/logbook.http` contains example requests for Logbook API.

*May the Force be with you!*

## Tests

Run `php artisan test` to execute the tests.