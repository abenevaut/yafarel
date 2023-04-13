<?php

namespace Tests\Unit\Plugins;

use Mockery;
use Tests\TestCase;

class DisallowFrameEmbeddingTest extends TestCase
{
	public function testToDispatchLoopShutdown()
    {
        $request = Mockery::mock(\Yaf\Request_Abstract::class);
        $response = new \Yaf\Response\Http();

        (new \DisallowFrameEmbeddingPlugin())
            ->dispatchLoopShutdown($request, $response);

        $this->assertSame('DENY', $response->getHeader('X-Frame-Options'));
	}
}
