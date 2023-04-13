# Yet another YAF framework

Simple PHP YAF starter pack to run app and test it.

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

## Setup the framework
```
cp app.ini.example app.ini
composer install
```

## Testing

- note `yaf.environ` is defined to `testing`

```
vendor/bin/phpunit
```
