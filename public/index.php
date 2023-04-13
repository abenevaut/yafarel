<?php

define('PROJECT_PATH', dirname(dirname(__FILE__)));

(new \Yaf\Application(PROJECT_PATH . '/app.ini'))
    ->bootstrap()
    ->run();
