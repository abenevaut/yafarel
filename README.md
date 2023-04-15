# Yet another YAF framework

## Description

This is a simple YAF framework to start a new project.

## Setup PHP YAF extension
```
[yaf]
;
; https://www.php.net/manual/fr/yaf.configuration.php
;
yaf.use_spl_autoload = On
yaf.cache_config = <On / Off>
yaf.use_namespace = On
yaf.environ = <recommanded: local or production - this choice impact `app.ini` sections>
```

## Setup Http server
See example at https://www.php.net/manual/en/class.yaf-router.php

## Setup the framework
```
cp app.ini.example app.ini
composer install
```

### Setup the database
#### MySQL
```
// <string: db name> could be "default" or "whatever"
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
```
php artisan "request_uri=/<controller>/<method>"
php artisan "request_uri=/<module>/<controller>/<method>"
```

### Commands list
```
php artisan request_uri="/cli/about/index"
```

## Testing
```
vendor/bin/phpunit
```
