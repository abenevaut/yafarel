<?php

namespace Tests;

use Yaf\Response_Abstract as HttpResponse;

interface YafTestCase
{
    public function getApplication(): Application;

    public function getView(): ViewSimple;

    public function get(string $uri): HttpResponse;
}
