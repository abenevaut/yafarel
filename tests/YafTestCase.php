<?php

namespace Tests;

use Yaf\Response_Abstract as HttpResponse;

interface YafTestCase
{
    public function get(string $uri): HttpResponse;

//    public function assertSuccess(HttpResponse $response): void;
}
