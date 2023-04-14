<?php

namespace Tests\Feature;

use Tests\TestCase;
use Yaf\Request\Simple;

class AuthTest extends TestCase
{
    public function testToDisplayLogin()
    {
        $response = $this->get('/auth/login');

        $this->assertSame('Login', $this->getView()->content);
    }
}
