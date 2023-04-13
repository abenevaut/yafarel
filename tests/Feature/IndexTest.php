<?php

namespace Tests\Feature;

use Tests\TestCase;
use Yaf\Request\Simple;

class IndexTest extends TestCase
{
    public function testToDisplayIndex()
    {
        $response = $this->get('/');

//        $this->assertSuccess($response);
        $this->assertSame('Hello World', $this->getView()->content);
    }
}
