<?php

set_time_limit(0);
ini_set('memory_limit', '256M');

define('PROJECT_PATH', getcwd());

$app = new \Yaf\Application(PROJECT_PATH . '/app.ini');
$app->bootstrap();

// Init a request for cli mode, Like
//      php ./application/Cli.php "request_uri=/cli/crontab/sendmailtorepayment"
//          module:cli, controller:crontab, action:sendMailToPayment
//      php ./application/Cli.php "request_uri=/cli/daemon/backup"
//          module:cli, controller:daemon, action:backup
$request = new \Yaf\Request\Simple();

$app->getDispatcher()->dispatch($request);
