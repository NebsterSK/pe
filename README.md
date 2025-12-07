# Planets Explorer

This old system connected to the internet will help you find out where in the universe you are located.

## Setup

1. Copy `.env.example` to `.env`
2. `php artisan key:generate`
3. Fill the `.env` file with your database credentials
4. `php artisan migrate --seed`

## Sync command

Command `php artisan sync` in `app/Console/Commands/SyncCommand.php` will fetch Planets & Residents data from external API and store them in your database.

## Logbook API

File `_dev/logbook.http` contains example requests for Logbook API.

__May the Force be with you!__