<?php

namespace Tests;

use Yaf\Request\Http;
use Yaf\Response_Abstract as HttpResponse;

trait YafUnit
{
    public function get(string $uri): HttpResponse
    {
        $request = new Http('/');

        return $this
            ->getApplication()
            ->getDispatcher()
            ->dispatch($request);
    }

//    public function assertSuccess(HttpResponse $response): void
//    {
//        $this->assertSame(200, $response[0]);
//    }
}
