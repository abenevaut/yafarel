<?php

use App\Facades\Log;
use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class LogRequestPlugin extends Plugin_Abstract
{
    public function dispatchLoopStartup(Request_Abstract $request, Response_Abstract $response)
    {
        Log::pushProcessor(function ($record) use ($request) {
            $record->extra['request'] = [
                'module' => $request->getModuleName(),
                'controller' => $request->getControllerName(),
                'action' => $request->getActionName(),
                'method' => $request->getMethod(),
                'uri' => $request->getRequestUri(),
            ];

            return $record;
        });
    }
}
