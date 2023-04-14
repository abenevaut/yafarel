<?php

namespace Tests\Feature;

use Tests\TestCase;
use Yaf\Request\Simple;

class AuthTest extends TestCase
{
    public function testToDisplayLoginForm()
    {
        $response = $this->get('/auth');

        $this->assertSame('LoginForm', $this->getView()->content);
    }

    public function testToLogin()
    {
        $response = $this->post('/auth/login', ['username' => 'admin', 'password' => 'password']);

        $this->assertSame('Login', $this->getView()->content);
        $this->assertSame('admin', $this->getView()->username);
        $this->assertSame('password', $this->getView()->password);
    }

    public function testToLogout()
    {
        $response = $this->post('/auth/logout');

        $this->assertSame('Logout', $this->getView()->content);
    }
}
