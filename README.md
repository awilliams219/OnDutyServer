rcOnDuty
========

Server software for the OnDuty mobile application

## Dependencies

- docker
- docker-compose
- PHP 7.1 or later with pdo_pgsql extension

## Installation

Copy app/config/paramaters.yml.dist to app/config/parameters.yml and configure as needed.

Run `composer update` from the project directory.

Bring everything up with `docker-compose up -d`

On the host machine, run `alias symfony="DATABASE_HOST=127.0.0.1 bin/console"`.

Then run `symfony doctrine:schema:update --force` from the project directory. 

## Symfony Console

Execute bin/console commands on the host machine using `symfony {command}`.  If this stops working, rerun the alias command from the installation section.

## Usage
 
Access the app on localhost.  Nothing lives in root yet.  Use api paths and REST actions:

 - GET http://localhost/api/apparatus/
 - POST http://localhost/api/apparatus/status/1
 - DELETE http://localhost/api/apparatus/1
 
 No security yet.  It's coming later.
 
 
## Docker

The docker-compose file will set up and link the following docker images:
 - nginx:alpine (latest)
 - php:alpine (latest, at least 7.1) with mcrypt, intl, mbstring, and pdo_pgsql extensions
 - postgresql:alpine (latest)
 
 