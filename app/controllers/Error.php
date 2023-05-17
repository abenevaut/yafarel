<?php

use App\Facades\ExceptionHandler;
use App\Infrastructure\ControllerAbstract;

class ErrorController extends ControllerAbstract
{
    public function errorAction(\Throwable $exception)
    {
        $view = ExceptionHandler::report($exception);

        $this->getResponse()->clearBody();
        $this->getResponse()->setBody($view);

        return false;
    }
}
