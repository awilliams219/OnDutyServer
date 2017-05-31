rcOnDuty
========

Server software for the OnDuty mobile application

Run `composer update` from the app dir.

Bring everything up with `docker-compose up &`

Execute bin/console commands on the local machine with `DATABASE_HOST=127.0.0.1 bin/console {command}`.  

Alias it if you're feeling froggy:  `alias symfony="DATABASE_HOST=127.0.0.1 bin/console`.  Then just run `symfony {command}`
 
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
 
 