<?php

namespace Tests;

use Yaf\Application;
use Yaf\Response_Abstract as HttpResponse;
use Yaf\View\Simple as ViewSimple;

interface YafTestCase
{
    public function getApplication(): Application;

    public function getView(): ViewSimple;

    public function get(string $uri): HttpResponse;
}
