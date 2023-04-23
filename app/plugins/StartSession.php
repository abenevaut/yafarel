<?php

use App\Facades\Log;
use App\Facades\Session;
use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class StartSessionPlugin extends Plugin_Abstract
{
    public function routerShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        if (!$request->isCli() && $request->getModuleName() !== 'Artisan') {
            Session::start();
            Log::pushProcessor(function ($record) use ($request) {
                $record->extra['sessionId'] = Session::sessionId();
                $record->extra['userId'] = Session::userId();

                return $record;
            });
        }
    }
}
