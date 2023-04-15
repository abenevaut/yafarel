<?php

use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;
use Yaf\Response\Http;

class RestrictCliExecutionToCliModulePlugin extends Plugin_Abstract
{
	public function routerShutdown(Request_Abstract $request, Response_Abstract $response) {

//        var_dump($request);

        if ($request->isCli() && $request->getModuleName() !== 'Cli') {
            throw new \Exception('Module not found');
        }
	}
}
