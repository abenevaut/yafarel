# Yet another YAF framework

## Description

This is a simple YAF framework to start a new project.

## Setup PHP YAF extension
```
[yaf]
;
; https://www.php.net/manual/fr/yaf.configuration.php
;
yaf.use_spl_autoload=On
yaf.cache_config=<On / Off>
yaf.use_namespace=On
yaf.environ=<recommanded: local or production - this choice impact `app.ini` sections>
```

## Setup Http server
See example at https://www.php.net/manual/en/class.yaf-router.php

## Setup the framework
```
cp app.ini.example app.ini
composer install
```

### Setup the database

Note that you can have multiple database connections.
The main one should be named `default`.

#### MySQL
```
database.<db name>.driver = "mysql"
database.<db name>.host = "<host>"
database.<db name>.database = "<database>"
database.<db name>.username = "<username>"
database.<db name>.password = "<password>"
```

#### SQLite
```
// <string: db name> could be "default" or "whatever"
database.<db name>.driver = "mysql"
database.<db name>.database = "<path to database.sqlite>"
```

## Command line interface

Convenient commands to help you in terminal.
Wink to @laravel

### Commands list
```
php artisan migrate
php artisan db:seed
```

## Testing
```
vendor/bin/phpunit
```
