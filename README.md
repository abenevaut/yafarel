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
yaf.environ = <recommanded: local or testing or production - this choice impact `app.ini` sections>
```

## Setup Http server
See example at https://www.php.net/manual/en/class.yaf-router.php

## Setup the framework
```
cp app.ini.example app.ini
composer install
```

## Command line interface
```
php artisan "request_uri=/<controller>/<method>"
php artisan "request_uri=/<module>/<controller>/<method>"
```

## Testing
```
vendor/bin/phpunit
```
