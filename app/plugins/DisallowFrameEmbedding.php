<?php

class DisallowFrameEmbeddingPlugin extends \Yaf\Plugin_Abstract
{
	public function dispatchLoopShutdown(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response) {
        if ($response instanceof \Yaf\Response\Http) {
            $response->setHeader('X-Frame-Options', 'DENY');
        }
	}
}
