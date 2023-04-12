<?php

$projectPath = dirname(dirname(__FILE__));

define('PROJECT_PATH',  $projectPath);

(new \Yaf\Application("{$projectPath}/app.ini"))
    ->bootstrap()
    ->run();
