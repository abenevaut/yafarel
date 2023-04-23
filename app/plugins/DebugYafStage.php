<?php

use App\Facades\Log;
use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;
use Yaf\Response\Http;

class DebugYafStagePlugin extends Plugin_Abstract
{
    public function routerStartup(Request_Abstract $request, Response_Abstract $response)
    {
        /* avant le routage, l'utilisateur peut faire quelques ré-écritures d'URL */
        Log::debug('routerStartup');
    }

    public function routerShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        /* le routage est terminé, l'utilisateur peut vérifier l'identifiant */
        Log::debug("routerShutdown");
    }

    public function dispatchLoopStartup(Request_Abstract $request, Response_Abstract $response)
    {
        Log::debug("dispatchLoopStartup");
    }

    public function preDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        Log::debug("preDispatch");
    }

    public function postDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        Log::debug("postDispatch");
    }

    public function dispatchLoopShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        /* Dernier partie : l'utilisateur peut s'identifier ou implémenter l'interface */
        Log::debug("dispatchLoopShutdown");
    }
}
