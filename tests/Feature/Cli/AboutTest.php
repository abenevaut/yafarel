<?php

namespace Tests\Feature\Cli;

use Tests\TestCase;

class AboutTest extends TestCase
{
    public function testToShowDescription()
    {
        $response = $this->get('/cli/about/index');

        $this->assertSame(0, $response->response_code);
        $this->assertSame('Yet another YAF framework', $this->getView()->content);
    }
}
