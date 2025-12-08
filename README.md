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

## API

Files in `_dev/api` contain example requests for API.

## Tests

Run `php artisan test` to execute the tests.

### Larastan

Larastan is set to level 5.

Run `composer larasatan` to check the code.

*Do or do not, there is no try.*

---

## Poznamky

- Ako zaklad som pouzil svoj vlastny Laravel project template (https://github.com/NebsterSK/laravel-template) kde mam predinstalovane a prednastavene package a postupy, ktore vzdy pouzivam.
- Branche a commity som z GitHubu schvalne nemazal a nesquachoval keby ste sa chceli pozriet, pouzil som Git Flow.
- Rozdelenim SASS / CSS suborov som nacrtol ako by som riesil responsivitu. Realne som sa tomu ale nevenoval kedze to nebolo v scope zadania.
- Pri praci som pouzil Copilota (Prevazne na inline doplnanie kodu.), ktoreho mam ako plugin v PHPStorme. Agent mode som vyuzil pri pisani testov, zaprve aby som s nimi nestratil tolko casu a zadruhe niesom este zbehly v Pest syntaxi, doteraz som pouzival PHPUnit.

### Na ktorej planete som?

Nesnazil som sa realne zistit, na ktorej presne planete som, ale isiel by som na to nasledovne:

1. Kedze som pristal na pusti, je jasne planeta musi mat `water_surface < 100`.
2. Vyfiltroval by som planety, ktorych `terrain obsahuje desert`.
3. Vyfiltroval by som planety, ktorych `climate obsahuje arid, temperate alebo hot`.
4. Sice nie exaktne ale za to velmi rychlo by som vedel porovnat aku gravitaciu citim a nasledne vyfiltrovat planety s podobnou `gravity`.
5. Asi najpresnejsie co viem zistit: **zmeral by som kolko hodin trva jeden den** a vyfiltroval planety podla `rotation_period`.

### Ciele

Nesplnil som ciele 3.2 a 3.3.

1. ~~to create an artisan command, that will sync the list of all known planets and
their residents~~ (imagine there may be millions of them)
2. ~~to create a simple paginated listing of the planets, where user can filter planets
   by diameter, rotation period and gravity (this is the only task that requires the
   UI, but please keep it simple, don’t waste your time on the visuals at all, no
   JavaScript is required)~~
3. ~~to create a REST (or GraphQL) API endpoint containing the aggregated data
   about the planets:~~
   1. ~~List of names of 10 largest planets~~
   2. Distribution of the terrain (imagine a pie chart indicating how many %
   planets have specific terrain)
   3. Distribution of the species living in all planets (using Planet->Resident
   relation)
4. ~~to create a REST (or GraphQL) API endpoint for creating a new record in the
   logbook (propose what attributes each record should/could have)~~

### Straveny cas

- Sobota 5 hodin
- Nedela 5 hodin
- Pondelok 4 hodiny

**Celkovo: 14 hodin**